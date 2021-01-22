<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Warga;
use App\Models\KategoriSampah;
use App\Models\User;


class WargaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $warga = Warga::with('kategori', 'user')->get();
        return view('backend.warga.index', compact('warga'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.warga.tambah');
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
            'NIK' => 'required',
            'id_users' => 'required',
            'id_kategori_sampah' => 'required',
            'no_telp' => 'required',
            'nama_cp' => 'required',
            'no_telp_cp' => 'required',
            'kota' => 'required',
            'kecamatan' => 'required',
            'desa' => 'required',
            'dukuh' => 'required',
            'RT' => 'required',
            'RW' => 'required',
            'detail_alamat' => 'required',
            'lokasi' => 'required',
        ]);

        Warga::create($request->all());
        return redirect()->route('warga.index')
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
        $w = Warga::find($id);
        return view('backend.warga.edit', compact('w'));
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
            'NIK' => 'required',
            'id_users' => 'required',
            'id_kategori_sampah' => 'required',
            'no_telp' => 'required',
            'nama_cp' => 'required',
            'no_telp_cp' => 'required',
            'kota' => 'required',
            'kecamatan' => 'required',
            'desa' => 'required',
            'dukuh' => 'required',
            'RT' => 'required',
            'RW' => 'required',
            'detail_alamat' => 'required',
            'lokasi' => 'required',
        ]);

        $w = Warga::find($id);
        $w->update($request->all());
        return redirect()->route('warga.index')
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
        $w = Warga::find($id);
        $w->delete();       
        return redirect()->route('warga.index')
                        ->with('success','Data berhasil dihapus'); 
    }

    public function searchKategori(Request $request)
    {
    	if ($request->has('q')) {
    		$cari = $request->q;
    		$data = DB::table('kategori_sampah')->select('id', 'jenis_sampah')->where('jenis_sampah', 'LIKE', '%$cari%')->get();
    		return response()->json($data);
    	}
    }
}
