<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Warga;
use App\Models\KategoriSampah;
use App\Models\User;
use App\Models\Kota;
use App\Models\Kecamatan;
use App\Models\Desa;
use App\Imports\WargaImport;
use Maatwebsite\Excel\Facades\Excel;
Use Alert;


class WargaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $warga = Warga::with('kategori', 'user', 'kota', 'kecamatan', 'desa')->get();
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
        $kota = Kota::all();
        $kecamatan = Kecamatan::all();
        $desa = Desa::all();
        return view('backend.warga.tambah', compact('kategori', 
                                                'kota', 'kecamatan', 'desa'));
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
            'NIK.unique' => 'NIK tidak boleh sama.',
            'NIK.min' => 'NIK harus 16 digit.',
            'nama.required' => 'Nama wajib diisi.',
            'nama.min' => 'Nama minimal 3 huruf.',
            'email.required' => 'Email wajib diisi.',
            'email.min' => 'Email minimal 11 huruf.',
            'email.unique' => 'Email sudah terpakai.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 5 huruf.',
            'id_kategori_sampah.required' => 'Kategori wajib diisi.',
            'id_kategori_sampah.not_in' => 'Pilih kategori sesuai daftar.',
            'no_telp.required' => 'No telepon wajib diisi.',
            'no_telp.min' => 'No telepon minimal 10 digit.',
            'id_kota.required' => 'Kota wajib diisi.',
            'id_kecamatan.required' => 'Kecamatan wajib diisi.',
            'id_desa.required' => 'Desa wajib diisi.',
            'dukuh.required' => 'Dukuh wajib diisi.',
            'detail_alamat.required' => 'Detail alamat wajib diisi.',
        ];

        $validator = $request->validate([
            'NIK' => 'required|numeric|min:16|unique:warga,NIK',
            'nama' => 'required|min:3|string',
            'email' => 'required|min:10|email|unique:users,email',
            'password' => 'required|min:5',
            'id_kategori_sampah' => 'required|not_in:0',
            'no_telp' => 'required|min:11|numeric',
            'id_kota' => 'required',
            'id_kecamatan' => 'required',
            'id_desa' => 'required',
            'dukuh' => 'required',
            'detail_alamat' => 'required',
            'lokasi' => 'nullable',
        ], $messages);

        $user = new User;
        $user->nama = $request->input('nama');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->role = "warga";
        if($user){
           $user->save();
        }
        
        $warga = new Warga;
        $warga->id_users=$user->id;
        $warga->NIK = $request->input('NIK');
        $warga->no_telp = $request->input('no_telp');
        $warga->id_kota = $request->input('id_kota');
        $warga->id_kecamatan = $request->input('id_kecamatan');
        $warga->id_desa = $request->input('id_desa');
        $warga->dukuh = $request->input('dukuh');
        $warga->detail_alamat = $request->input('detail_alamat');
        $warga->latitude = $request->input('lat');
        $warga->longitude = $request->input('long');
        $warga->id_kategori_sampah = $request->input('id_kategori_sampah');
        if($warga){
           $warga->save();
        }

        Alert::success('Berhasil', 'Data warga berhasil ditambahkan');
        return redirect()->route('warga.index');        
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
        $user = User::select('id', 'nama')->where('role', 'warga')->get();
        $kota = Kota::all();
        $kecamatan = Kecamatan::all()->where('id_kota', Kota::where('id', 
                Warga::where('id', $id)->value('id_kota'))->value('id'));
        $desa = Desa::all()->where('id_kecamatan', Kecamatan::where('id', 
                Warga::where('id', $id)->value('id_kecamatan'))->value('id'));
        return view('backend.warga.edit', compact('w', 'kategori', 'user',
                                            'kota', 'kecamatan', 'desa'));
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
            'NIK.min' => 'NIK harus 16 digit.',
            'nama.required' => 'Nama wajib diisi.',
            'nama.min' => 'Nama minimal 3 huruf.',
            'email.required' => 'Email wajib diisi.',
            'email.min' => 'Email minimal 11 huruf.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 5 huruf.',
            'id_kategori_sampah.required' => 'Kategori wajib diisi.',
            'id_kategori_sampah.not_in' => 'Pilih kategori sesuai daftar.',
            'no_telp.required' => 'No telepon wajib diisi.',
            'no_telp.min' => 'No telepon minimal 10 digit.',
            'id_kota.required' => 'Kota wajib diisi.',
            'id_kecamatan.required' => 'Kecamatan wajib diisi.',
            'id_desa.required' => 'Desa wajib diisi.',
            'dukuh.required' => 'Dukuh wajib diisi.',
            'detail_alamat.required' => 'Detail alamat wajib diisi.',
        ];

        $validate = $request->validate([
            'NIK' => 'required|numeric|min:16',
            'nama' => 'required|min:3|string',
            'email' => 'required|min:10|email',
            'password' => 'required|min:5',
            'id_kategori_sampah' => 'required|not_in:0',
            'no_telp' => 'required|min:11|numeric',
            'id_kota' => 'required',
            'id_kecamatan' => 'required',
            'id_desa' => 'required',
            'dukuh' => 'required',
            'detail_alamat' => 'required',
            'lokasi' => 'nullable',
        ], $messages);

        $warga = Warga::find($id);

        $user = User::where('id', $warga->id_users)->update([
            'nama' => $request->input('nama'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'role' => "warga"
        ]);
        
        $warga->update([
            'NIK' => $request->input('NIK'),
            'no_telp' => $request->input('no_telp'),
            'id_kota' => $request->input('id_kota'),
            'id_kecamatan' => $request->input('id_kecamatan'),
            'id_desa' => $request->input('id_desa'),
            'dukuh' => $request->input('dukuh'),
            'detail_alamat' => $request->input('detail_alamat'),
            'lokasi' => $request->input('lokasi'),
            'id_kategori_sampah' => $request->input('id_kategori_sampah')
        ]);

        Alert::success('Berhasil', 'Data warga berhasil diubah');
        return redirect()->route('warga.index');  
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
        $user = User::where('id', $w->id_users);
        $user->delete();
        $w->delete();
        Alert::success('Berhasil', 'Data warga berhasil dihapus');
        return back(); 
    }

    public function importWarga(Request $request)
    {
        $file = $request->file('excel-warga');
        Excel::import(new WargaImport,$file);
        Alert::success('Berhasil', 'Data warga berhasil ditambahkan');
        return redirect()->back();
    }
}
