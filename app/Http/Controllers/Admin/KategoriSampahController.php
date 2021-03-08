<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KategoriSampah;
use App\Imports\KategoriImport;
use Maatwebsite\Excel\Facades\Excel;
Use Alert;

class KategoriSampahController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kategori = KategoriSampah::all();
        return view('backend.kategori_sampah.index', compact('kategori'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.kategori_sampah.tambah');
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
            'harga_retribusi.required' => 'Harga retribusi wajib diisi.',
            'harga_retribusi.numeric' => 'Harga retribusi harus berupa angka.',
        ];

        $request->validate([
            'jenis_sampah' => 'required',
            'harga_retribusi' => 'required|numeric',
        ], $messages);

        KategoriSampah::create($request->all());
        Alert::success('Berhasil', 'Data kategori berhasil ditambahkan');
        return redirect()->route('kategori_sampah.index');  
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
        $kategori = KategoriSampah::find($id);
        return view('backend.kategori_sampah.edit', compact('kategori'));
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
            'harga_retribusi.required' => 'Harga retribusi wajib diisi.',
            'harga_retribusi.numeric' => 'Harga retribusi harus berupa angka.',
        ];

        $request->validate([
            'jenis_sampah' => 'required',
            'harga_retribusi' => 'required|numeric',
        ], $messages);
        
        $kategori = KategoriSampah::find($id);
        $kategori->update($request->all());
        Alert::success('Berhasil', 'Data kategori berhasil diubah');
        return redirect()->route('kategori_sampah.index');  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kategori = KategoriSampah::find($id);
        $kategori->delete();       
        Alert::success('Berhasil', 'Data kategori berhasil dihapus');
        return back();  
    }

    public function importKategori(Request $request)
    {
        $file = $request->file('excel-kategori');
        Excel::import(new KategoriImport,$file);
        Alert::success('Berhasil', 'Data kategori berhasil ditambahkan');
        return redirect()->back();
    }
}
