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
        return view('backend.pengambilan.tambah');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_users' => 'required',
            'waktu_pengambilan' => 'required',
        ]);
        
        $input = $request->all();
        $input['id_warga'] = Warga::WHERE('id_users', $request['id_users'])->value('id');
        $input['status'] = "aktif";
        Pengambilan::create($input);
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
        return view('backend.pengambilan.edit', compact('pengambilan'));
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
        $request->validate([
            'id_users' => 'required',
            'waktu_pengambilan' => 'required',
        ]);

        $pengambilan = Pengambilan::find($id);
        $input = $request->all();
        $input['id_warga'] = Warga::WHERE('id_users', $request['id_users'])->value('id');
        $input['status'] = "aktif";
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
}
