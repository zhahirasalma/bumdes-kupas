<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DaftarSetor;
use App\Models\Pengambilan;
use App\Models\User;
use App\Models\Warga;
use App\Models\KategoriSampah;
use App\Models\RetribusiWarga;
use Auth;

class WargaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $warga= Warga::all();
        $daftar_setor = DaftarSetor::all();
        $pengambilan= Pengambilan::all();
        $retribusi= RetribusiWarga::all();
        return view('warga.index', compact('warga', 'pengambilan', 'daftar_setor', 'user', 'retribusi'));
    }

    public function konfirmasistatus(Request $request)
    {
        $pengambilan = Pengambilan::find($request->id);
        $pengambilan->status = $request->status;
        $pengambilan->save();

        return response()->json($pengambilan);
    }

    // public function konfirmasistatus(Request $request)
    // {
    //     $status = $request->input('status', Pengambilan::STATUS_pending);
    //     Pengambilan::find($request->id)->updateStatus();
    //     return Pengambilan::STATUS_terambil;
    // }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function __construct(){
        $this->middleware('auth');
    }
}
