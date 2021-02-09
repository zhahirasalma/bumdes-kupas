<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TransaksiBankSampah;
use App\Models\KonversiSampah;
use App\Models\User;
use App\Models\BankSampah;

class TransaksiBankSampahController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transaksi = TransaksiBankSampah::with('bankSampah', 'user', 'konversi')->get();
        return view('backend.bank_sampah.transaksi.index', compact('transaksi'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = User::select('id', 'nama')->where('role', 'bank_sampah')->get();
        $konversi = KonversiSampah::select('id', 'jenis_sampah')->get();
        return view('backend.bank_sampah.transaksi.tambah', compact('user', 'konversi'));
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
            'tanggal_transaksi.required' => 'Tanggal Transaksi wajib diisi.',
            'keterangan.required' => 'Keterangan wajib diisi.',
            'id_konversi.required' => 'Jenis sampah wajib diisi.',
            'berat.required' => 'Berat wajib diisi.',
        ];
        
        $request->validate([
            'id_users' => 'required',
            'tanggal_transaksi' => 'required',
            'keterangan' => 'required',
            'id_konversi' => 'required',
            'berat' => 'required',
        ], $messages);
        
        $input = $request->all();
        $input['id_bank_sampah'] = BankSampah::WHERE('id_users', $request['id_users'])->value('id');

        $hargasampah = KonversiSampah::WHERE('id', $request['id_konversi'])->value('harga_konversi');
        $input['harga_total'] = $request['berat'] * $hargasampah;

        TransaksiBankSampah::create($input);
        return redirect()->route('transaksi.index')
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
        $transaksi = TransaksiBankSampah::find($id);
        $user = User::select('id', 'nama')->where('role', 'bank_sampah')->get();
        $konversi = KonversiSampah::select('id', 'jenis_sampah')->get();
        return view('backend.bank_sampah.transaksi.edit', compact('transaksi', 'user', 'konversi'));
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
            'tanggal_transaksi.required' => 'Tanggal Transaksi wajib diisi.',
            'keterangan.required' => 'Keterangan wajib diisi.',
            'id_konversi.required' => 'Jenis sampah wajib diisi.',
            'berat.required' => 'Berat wajib diisi.',
        ];
        
        $request->validate([
            'id_users' => 'required',
            'tanggal_transaksi' => 'required',
            'keterangan' => 'required',
            'id_konversi' => 'required',
            'berat' => 'required',
        ], $messages);

        $transaksi = TransaksiBankSampah::find($id);
        $input = $request->all();

        $input['id_bank_sampah'] = BankSampah::WHERE('id_users', $request['id_users'])->value('id');
        
        $hargasampah = KonversiSampah::WHERE('id', $request['id_konversi'])->value('harga_konversi');
        $input['harga_total'] = $request['berat'] * $hargasampah;

        $transaksi->update($input);
        return redirect()->route('transaksi.index')
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
        $transaksi = TransaksiBankSampah::find($id);
        $transaksi->delete();
        return redirect()->route('transaksi.index')
                        ->with('success','Data berhasil dihapus');
    }
}
