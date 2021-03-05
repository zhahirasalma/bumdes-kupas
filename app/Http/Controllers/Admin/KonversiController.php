<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KonversiSampah;
use App\Imports\KonversiImport;
use Maatwebsite\Excel\Facades\Excel;
Use Alert;

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
        $messages = [
            'jenis_sampah.required' => 'Jenis sampah wajib diisi.',
            'harga_konversi.required' => 'Harga Konversi wajib diisi.',
            'harga_konversi.numeric' => 'Harga Konversi harus berupa angka.',
        ];

        $validator = $request->validate([
            'jenis_sampah' => 'required',
            'harga_konversi' => 'required|numeric',
        ], $messages);

        KonversiSampah::create($request->all());
        Alert::success('Berhasil', 'Data konversi berhasil ditambahkan');
        return redirect()->route('konversi.index');  
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
        $messages = [
            'jenis_sampah.required' => 'Jenis sampah wajib diisi.',
            'harga_konversi.required' => 'Harga Konversi wajib diisi.',
            'harga_konversi.numeric' => 'Harga Konversi harus berupa angka.',
        ];

        $validator = $request->validate([
            'jenis_sampah' => 'required',
            'harga_konversi' => 'required|numeric',
        ], $messages);

        $konversi = KonversiSampah::find($id);
        $konversi->update($request->all());
        Alert::success('Berhasil', 'Data konversi berhasil diubah');
        return redirect()->route('konversi.index');  
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
        Alert::success('Berhasil', 'Data konversi berhasil dihapus');
        return back();   
    }

    public function importKonversi(Request $request)
    {
        $file = $request->file('excel-konversi');
        Excel::import(new KonversiImport,$file);
        Alert::success('Berhasil', 'Data konversi berhasil ditambahkan');
        return redirect()->back();
    }
}
