<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TransaksiBankSampah;
use App\Models\User;
use App\Models\BankSampah;
use App\Models\KonversiBankSampah;
use App\Models\RetribusiWarga;
use Auth;
use Carbon\Carbon;

class HistoryTransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $transaksi = TransaksiBankSampah::groupBy('tanggal_transaksi')
                        ->selectRaw('*, sum(harga_total) as harga')
                        ->with('bankSampah', 'user', 'konversi')
                        ->get();
        // $tanggal_transaksi= TransaksiBankSampah::with('tanggal_transaksi');
        // $tgl = \Carbon\Carbon::parse($tanggal_transaksi->tanggal_transaksi)->format('d/m/Y')->get();
        $bank_sampah = BankSampah::all();
        // $tgl = TransaksiBankSampah::with('tanggal_transaksi')->isoFormat('dddd, D MMMM Y')->get();
        return view('bankSampah.layanan.history_transaksi', compact('user', 'transaksi', 'bank_sampah'));
    }

    public function detail(Request $request)
    {
        $user = Auth::user();
        $tanggal_transaksi = $request->tanggal_transaksi;
        // $tgl = \Carbon\Carbon::parse($tanggal_transaksi)->format('d/m/Y');
        $detail = TransaksiBankSampah::with('bankSampah', 'user', 'konversi')
                        ->where('tanggal_transaksi', $tanggal_transaksi)
                        ->get();
        return view('bankSampah.layanan.detail_history', compact('detail'));
    }

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
}
