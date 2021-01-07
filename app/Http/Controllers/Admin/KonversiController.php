<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KonversiSampah;

class KonversiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $konversi = KonversiSampah::all();
        return view('backend.konversi.index', compact('konversi'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.konversi.tambah');
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
            'jenis_sampah' => 'required',
            'harga_konversi' => 'required',
        ]);

        KonversiSampah::create($request->all());
        return redirect()->route('konversi.index')
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
        $konversi = KonversiSampah::find($id);
        return view('backend.konversi.edit', compact('konversi'));
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
            'jenis_sampah' => 'required',
            'harga_konversi' => 'required',
        ]);

        $konversi = KonversiSampah::find($id);
        $konversi->update($request->all());
        return redirect()->route('konversi.index')
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
        $konversi = KonversiSampah::find($id);
        $konversi->delete();       
        return redirect()->route('konversi.index')
                        ->with('success','Data berhasil dihapus'); 
    }
}
