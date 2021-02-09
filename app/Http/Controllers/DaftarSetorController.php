<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DaftarSetor;
use App\Models\BankSampah;

class DaftarSetorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $daftar_setor = DaftarSetor::all();
        return view('bankSampah.layanan.daftar_setor.index', compact('daftar_setor'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $bank_sampah = BankSampah::select('id')->get();
        return view('bankSampah.layanan.daftar_setor.tambah', compact('bank_sampah'));
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
            'nama.required' => 'Nama penyetor wajib diisi.',
            'tanggal_transaksi.required' => 'Tanggal setor wajib diisi.',
            'uraian.required' => 'Uraian wajib diisi.',
        ];

        $validator = $request->validate([
            'nama' => 'required',
            'tanggal_transaksi' => 'required',
            'uraian' => 'required',
        ], $messages);

        DaftarSetor::create($request->all());
        return redirect()->route('daftar_setor.index')
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
        $daftar_setor = DaftarSetor::find($id);
        return view('bankSampah.layanan.daftar_setor.edit', compact('daftar_setor'));
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
            'nama.required' => 'Nama penyetor wajib diisi.',
            'tanggal_transaksi.required' => 'Tanggal setor wajib diisi.',
            'uraian.required' => 'Uraian wajib diisi.',
        ];

        $validator = $request->validate([
            'nama' => 'required',
            'tanggal_transaksi' => 'required',
            'uraian' => 'required',
        ], $messages);

        $daftar_setor = DaftarSetor::find($id);
        $daftar_setor->update($request->all());
        return redirect()->route('daftar_setor.index')
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
        $daftar_setor = DaftarSetor::find($id);
        $daftar_setor->delete();       
        return redirect()->route('daftar_setor.index')
                        ->with('success','Data berhasil dihapus'); 
    }
}
