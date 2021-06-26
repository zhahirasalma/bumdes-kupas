<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RetribusiWarga;
use App\Models\User;
use App\Models\Warga;
use App\Models\KategoriSampah;
Use Alert;

class TransaksiRetribusiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $retribusi = RetribusiWarga::with('warga', 'user')->get();
        return view('backend.warga.retribusi.index', compact('retribusi'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = User::select('users.id', 'users.nama', 'warga.nik')
                ->join('warga', 'warga.id_users', '=', 'users.id')
                ->where('role', 'warga')
                ->get();
        return view('backend.warga.retribusi.tambah', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $messages = [
            'id_users.required' => 'Nama wajib diisi.',
            'nama_kolektor.required' => 'Nama kolektor wajib diisi.',
            'nama_kolektor.regex' => 'Nama kolektor harus berupa huruf.',
            'bulan_tagihan.required' => 'Bulan Tagihan wajib diisi.',
            'keterangan.required' => 'Keterangan wajib diisi.',
            'tanggal_transaksi.required' => 'Tanggal transaksi wajib diisi.',
        ];
        
        $request->validate([
            'nama_kolektor' => 'required|regex:/^[a-zA-Z]+$/',
            'bulan_tagihan' => 'required',
            'tanggal_transaksi' => 'required',
            'id_users' => 'required'
        ], $messages);
        
        $input = $request->all();
        $input['id_warga'] = Warga::WHERE('id_users', $request['id_users'])->value('id');
        $input['jumlah_tagihan'] = KategoriSampah::where('users.id', $request->id_users)
                    ->join('warga', 'warga.id_kategori_sampah', '=', 'kategori_sampah.id')
                    ->join('users', 'users.id', '=', 'warga.id_users')
                    ->value('kategori_sampah.harga_retribusi');
        RetribusiWarga::create($input);
        Alert::success('Berhasil', 'Data retribusi berhasil ditambahkan');
        return redirect()->route('retribusi.index');  
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
        $retribusi = RetribusiWarga::find($id);
        $user = User::select('id', 'nama')->where('role', 'warga')->get();
        return view('backend.warga.retribusi.edit', compact('retribusi', 'user'));
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
        $messages = [
            'id_users.required' => 'Nama wajib diisi.',
            'nama_kolektor.required' => 'Nama kolektor wajib diisi.',
            'nama_kolektor.regex' => 'Nama kolektor harus berupa huruf.',
            'bulan_tagihan.required' => 'Bulan Tagihan wajib diisi.',
            'keterangan.required' => 'Keterangan wajib diisi.',
            'tanggal_transaksi.required' => 'Tanggal transaksi wajib diisi.',
        ];
        
        $request->validate([
            'nama_kolektor' => 'required|regex:/^[a-zA-Z]+$/',
            'bulan_tagihan' => 'required',
            'keterangan' => 'required',
            'tanggal_transaksi' => 'required',
            'id_users' => 'required'
        ], $messages);

        $retribusi = RetribusiWarga::find($id);
        $input = $request->all();
        $input['id_warga'] = Warga::WHERE('id_users', $request['id_users'])->value('id');
        $input['jumlah_tagihan'] = KategoriSampah::where('users.id', $request->id_users)
                    ->join('warga', 'warga.id_kategori_sampah', '=', 'kategori_sampah.id')
                    ->join('users', 'users.id', '=', 'warga.id_users')
                    ->value('kategori_sampah.harga_retribusi');
        $retribusi->update($input);
        Alert::success('Berhasil', 'Data retribusi berhasil diubah');
        return redirect()->route('retribusi.index');  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $retribusi = RetribusiWarga::find($id);
        $retribusi->delete();
        Alert::success('Berhasil', 'Data retribusi berhasil dihapus');
        return back();  
    }

    public function getTagihan($user_id)
    {
        $tagihan = KategoriSampah::select('kategori_sampah.harga_retribusi')
                    ->join('warga', 'warga.id_kategori_sampah', '=', 'kategori_sampah.id')
                    ->join('users', 'users.id', '=', 'warga.id_users')
                    ->where('users.id', $user_id)->get();
        return response()->json($tagihan);
    }
}
