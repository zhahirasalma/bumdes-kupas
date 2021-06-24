<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DaftarSetor;
use App\Models\BankSampah;
use Auth;

class DaftarSetorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $daftar_setor = DaftarSetor::select('setoran_anggota_bank_sampah.id', 'setoran_anggota_bank_sampah.nama', 
                            'setoran_anggota_bank_sampah.tanggal_transaksi', 
                            'setoran_anggota_bank_sampah.uraian')
                        ->LEFTJOIN('bank_sampah', 'bank_sampah.id', '=', 'setoran_anggota_bank_sampah.id_bank_sampah')
                        ->JOIN('users', 'users.id', '=', 'bank_sampah.id_users')
                        ->where('users.id', Auth::user()->id)
                        ->get();
        // return response()->json($daftar_setor);
        return view('bankSampah.layanan.daftar_setor.index', compact('user', 'daftar_setor'));
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
        $user = Auth::user();

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
        
        $daftar_setor = $request->all();
        $daftar_setor['id_bank_sampah']=BankSampah::where('id_users', Auth::user()->id)->value('id');
        DaftarSetor::create($daftar_setor);
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

    // public function getHistori(){
    //     // $datenow = Carbon::now(); 

    //     $auth = Auth::user();
    //     $id = $auth->id_user;

    //     $histori = Order::where('id_user',$id)
    //                     ->get();

    //     return response()->json([
    //         'status' => 'Success',
    //         'size'  => sizeof($histori),
    //         'data' => [
    //             'histori' => $histori
    //         ],
    //     ]);
    // }
}

//tampilin histori transaksi warga minus id login
//tampilin histori transaksi bank sampah minus id login
//openstreetmap
//button pengambilan connect db
//login logout
//registrasi OKE
//daftar setor per id login minus id login