<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BankSampah;
use App\Models\User;

class BankSampahController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = BankSampah::with('user')->get();
        return view('backend.bank_sampah.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = User::select('id', 'nama')->get();
        return view('backend.bank_sampah.tambah', compact('user'));
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
            'no_telp.required' => 'No telepon wajib diisi.',
            'kota.required' => 'Kota wajib diisi.',
            'kecamatan.required' => 'Kecamatan wajib diisi.',
            'desa.required' => 'Desa wajib diisi.',
            'dukuh.required' => 'Dukuh wajib diisi.',
            'RT.required' => 'RT wajib diisi.',
            'RW.required' => 'RW wajib diisi.',
            'detail_alamat.required' => 'Detail alamat wajib diisi.',
        ];

        $request->validate([
            'id_users' => 'required',
            'no_telp' => 'required',
            'kota' => 'required',
            'kecamatan' => 'required',
            'desa' => 'required',
            'dukuh' => 'required',
            'RT' => 'required',
            'RW' => 'required',
            'detail_alamat' => 'required',
        ], $messages);

        BankSampah::create($request->all());
        return redirect()->route('bank_sampah.index')
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
        $data = BankSampah::find($id);
        $user = User::select('id', 'nama')->get();
        return view('backend.bank_sampah.edit', compact('data', 'user'));
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
            'no_telp.required' => 'No telepon wajib diisi.',
            'kota.required' => 'Kota wajib diisi.',
            'kecamatan.required' => 'Kecamatan wajib diisi.',
            'desa.required' => 'Desa wajib diisi.',
            'dukuh.required' => 'Dukuh wajib diisi.',
            'RT.required' => 'RT wajib diisi.',
            'RW.required' => 'RW wajib diisi.',
            'detail_alamat.required' => 'Detail alamat wajib diisi.',
        ];

        $request->validate([
            'id_users' => 'required',
            'no_telp' => 'required',
            'kota' => 'required',
            'kecamatan' => 'required',
            'desa' => 'required',
            'dukuh' => 'required',
            'RT' => 'required',
            'RW' => 'required',
            'detail_alamat' => 'required',
        ], $messages);

        $data = BankSampah::find($id);
        $data->update($request->all());
        return redirect()->route('bank_sampah.index')
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
        $data = BankSampah::find($id);
        $data->delete();       
        return redirect()->route('bank_sampah.index')
                        ->with('success','Data berhasil dihapus');
    }
}
