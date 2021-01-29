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
        $kategori = KategoriSampah::select('id', 'jenis_sampah')->get();
        $user = User::select('id', 'nama')->get();
        return view('backend.warga.tambah', compact('kategori', 'user'));
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
            'NIK.required' => 'NIK wajib diisi.',
            'id_users.required' => 'Nama wajib diisi.',
            'id_kategori_sampah.required' => 'Kategori wajib diisi.',
            'id_users.not_in' => 'Pilih nama sesuai daftar.',
            'id_kategori_sampah.not_in' => 'Pilih kategori sesuai daftar.',
            'no_telp.required' => 'No telepon wajib diisi.',
            'nama_cp.required' => 'Nama narahubung wajib diisi.',
            'no_telp_cp.required' => 'No telp narahubung wajib diisi.',
            'kota.required' => 'Kota wajib diisi.',
            'kecamatan.required' => 'Kecamatan wajib diisi.',
            'desa.required' => 'Desa wajib diisi.',
            'dukuh.required' => 'Dukuh wajib diisi.',
            'RT.required' => 'RT wajib diisi.',
            'RW.required' => 'RW wajib diisi.',
            'detail_alamat.required' => 'Detail alamat wajib diisi.',
        ];

        $request->validate([
            'NIK' => 'required',
            'id_users' => 'required|not_in:0',
            'id_kategori_sampah' => 'required|not_in:0',
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
        ], $messages);

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
        $kategori = KategoriSampah::select('id', 'jenis_sampah')->get();
        $user = User::select('id', 'nama')->get();
        return view('backend.warga.edit', compact('w', 'kategori', 'user'));
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
            'NIK.required' => 'NIK wajib diisi.',
            'id_users.required' => 'Nama wajib diisi.',
            'id_kategori_sampah.required' => 'Kategori wajib diisi.',
            'id_users.not_in' => 'Pilih nama sesuai daftar.',
            'id_kategori_sampah.not_in' => 'Pilih kategori sesuai daftar.',
            'no_telp.required' => 'No telepon wajib diisi.',
            'nama_cp.required' => 'Nama narahubung wajib diisi.',
            'no_telp_cp.required' => 'No telp narahubung wajib diisi.',
            'kota.required' => 'Kota wajib diisi.',
            'kecamatan.required' => 'Kecamatan wajib diisi.',
            'desa.required' => 'Desa wajib diisi.',
            'dukuh.required' => 'Dukuh wajib diisi.',
            'RT.required' => 'RT wajib diisi.',
            'RW.required' => 'RW wajib diisi.',
            'detail_alamat.required' => 'Detail alamat wajib diisi.',
        ];

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
        ], $messages);

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
        $data = [];
        
        if ($request->has('q')) {
    		$cari = $request->q;
            $data = KategoriSampah::select('id', 'jenis_sampah')
                    ->where('jenis_sampah', 'LIKE', '%$cari%')
                    ->get();  
            return response()->json($data);
        }
    }
}
