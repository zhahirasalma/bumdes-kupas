<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TransaksiBankSampah;
use App\Models\KonversiSampah;
use App\Models\User;
use App\Models\BankSampah;
use Carbon\carbon;
use App\Exports\TransaksiExport;
use Maatwebsite\Excel\Facades\Excel;
use Alert;

class TransaksiBankSampahController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transaksi = TransaksiBankSampah::groupBy('id_bank_sampah')
                        ->selectRaw('*, sum(harga_total) as jumlah')
                        ->with('bankSampah', 'user', 'konversi')
                        ->get();
        return view('backend.bank_sampah.transaksi.index', compact('transaksi'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = User::select('users.id', 'users.nama', 'bank_sampah.dukuh')
                ->join('bank_sampah', 'bank_sampah.id_users', '=', 'users.id')
                ->where('role', 'bank_sampah')
                ->get();
        $konversi = KonversiSampah::all();
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
        ];

        $request->validate([
            'id_users' => 'required',
            'tanggal_transaksi' => 'required',
            'keterangan' => 'nullable',
        ], $messages);

        $input = $request->all();
        $id_bank_sampah = BankSampah::WHERE('id_users', $request['id_users'])->value('id');
        $data = array();
        foreach ($input['row'] as $i) {
            $data[] = [
                'id_users' => $input['id_users'],
                'id_bank_sampah' => $id_bank_sampah,
                'tanggal_transaksi' => $input['tanggal_transaksi'],
                'keterangan' => $input['keterangan'],
                'id_konversi' => (int)$i['id_konversi'],
                'berat' => $i['berat'],
                'harga_total' => $i['harga'] * $i['berat'],
                'created_at' => Carbon::now(),
            ];
        }
        TransaksiBankSampah::insert($data);
        return response()->json(true);
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
        $user = User::select('users.id', 'users.nama', 'bank_sampah.dukuh')
                ->join('bank_sampah', 'bank_sampah.id_users', '=', 'users.id')
                ->where('role', 'bank_sampah')
                ->get();
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
            'id_konversi.required' => 'Jenis Sampah wajib diisi.',
            'berat.required' => 'Berat wajib diisi.',
        ];

        $request->validate([
            'id_users' => 'required',
            'tanggal_transaksi' => 'required',
            'keterangan' => 'nullable',
            'id_konversi' => 'required',
            'berat' => 'required',
        ], $messages);

        $transaksi = TransaksiBankSampah::find($id);
        $input = $request->all();
        $input['id_bank_sampah'] = BankSampah::WHERE('id_users', $request['id_users'])->value('id');

        $konversi = KonversiSampah::where('id', $request['id_konversi'])->value('harga_konversi');
        $input['harga_total'] = $konversi * $request->berat;
        
        $transaksi->update($input);
        Alert::success('Berhasil', 'Data transaksi berhasil diubah');

        $id_bank_sampah = $input['id_bank_sampah'];
        return redirect()->route('detail-transaksi', [$id_bank_sampah]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_bank_sampah)
    {
        $transaksi = TransaksiBankSampah::where('id_bank_sampah', $id_bank_sampah);
        $transaksi->delete();
        Alert::success('Berhasil', 'Data transaksi berhasil dihapus');
        return back();
    }

    public function detail(Request $request)
    {
        $id_bank_sampah = $request->id_bank_sampah;
        $detail = TransaksiBankSampah::with('bankSampah', 'user', 'konversi')
                        ->where('id_bank_sampah', $id_bank_sampah)
                        ->get();
        return view('backend.bank_sampah.transaksi.detail', compact('detail'));
    }

    public function deleteItem($id)
    {
        $transaksi = TransaksiBankSampah::find($id);
        $transaksi->delete();
        return back();
    }

    public function getKonversi($konversi)
    {
        $konversi = KonversiSampah::where('id', $konversi)->value('harga_konversi');
        return response()->json($konversi);
    }

    public function exportExcel(Request $request)
    {   
        $bank_sampah = User::join('bank_sampah', 'bank_sampah.id_users', 'users.id')
                        ->where('bank_sampah.id', $request->id_bank_sampah)
                        ->value('nama');
        $filename = "rekap_transaksi_".$bank_sampah."_".date('Y-m-d-H-i-s').'.xlsx';
        return Excel::download(new TransaksiExport($request->id_bank_sampah), $filename);
    }
}