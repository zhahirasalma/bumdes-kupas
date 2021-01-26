<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TransaksiBankSampah;
use App\Models\Konversi;
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
        return view('backend.bank_sampah.transaksi.tambah');
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
            'tanggal_transaksi' => 'required',
            'keterangan' => 'required',
            'id_konversi' => 'required',
            'berat' => 'required',
            'harga_total' => 'required',
        ]);
        
        $input = $request->all();
        $input['id_bank_sampah'] = BankSampah::WHERE('id_users', $request['id_users'])->value('id');
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
        return view('backend.bank_sampah.transaksi.edit', compact('transaksi'));
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
            'tanggal_transaksi' => 'required',
            'keterangan' => 'required',
            'id_konversi' => 'required',
            'berat' => 'required',
            'harga_total' => 'required',
        ]);

        $transaksi = TransaksiBankSampah::find($id);
        $input = $request->all();
        $input['id_bank_sampah'] = BankSampah::WHERE('id_users', $request['id_users'])->value('id');
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
