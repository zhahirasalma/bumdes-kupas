<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pengambilan;
use App\Models\User;
use App\Models\Warga;

class PengambilanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pengambilan = Pengambilan::with('user', 'warga')->get();
        return view('backend.pengambilan.index', compact('pengambilan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $warga = User::select('id', 'nama')->where('role', 'warga')->get();
        return view('backend.pengambilan.tambah', compact('warga'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $messages =[
            'id_users.required' => 'Pilih minimal 1 nama',
            'waktu_pengambilan.required' => "Waktu wajib diisi"
        ];
        
        $request->validate([
            'id_users' => 'required',
            'waktu_pengambilan' => 'required',
        ], $messages);
        
        $input= $request->id_users;
        $data=array();
        foreach($input as $i){
            $data[] = [
                'id_users' => $i,
                'id_warga' => Warga::WHERE('id_users', $i)->value('id'),
                'waktu_pengambilan' => $request->waktu_pengambilan,
                'status' => 1
            ];
        }
        Pengambilan::insert($data);
        return redirect()->route('pengambilan.index')
                        ->with('success','Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pengambilan = Pengambilan::find($id);
        $user = User::select('nama')->join('pengambilan_sampah', 'id_users', '=','users.id')
                ->where('users.id', $id)->get();
        return view('backend.pengambilan.edit', compact('pengambilan', 'user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $messages =[
            'waktu_pengambilan.required' => "Waktu wajib diisi"
        ];
        
        $request->validate([
            'waktu_pengambilan' => 'required',
        ], $messages);

        $pengambilan = Pengambilan::find($id);
        $input = $request->all();
        $input['id_warga'] = Warga::WHERE('id_users', $pengambilan->id_users)->value('id');
        $pengambilan->update($input);
        return redirect()->route('pengambilan.index')
                        ->with('success','Data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pengambilan = Pengambilan::find($id);
        $pengambilan->delete();
        return redirect()->route('pengambilan.index')
                        ->with('success','Data berhasil dihapus');
    }

    public function ubahstatus(Request $request)
    {
        $pengambilan = Pengambilan::find($request->id);
        $pengambilan->status = $request->status;
        $pengambilan->save();
    }
}
