<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DaftarSetor;
use App\Models\BankSampah;
use App\Models\KonversiSampah;
use Carbon\carbon;
use Auth;
use Datatables;

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
                            'setoran_anggota_bank_sampah.tanggal_transaksi', 'setoran_anggota_bank_sampah.id_konversi', 
                            'setoran_anggota_bank_sampah.berat', 'setoran_anggota_bank_sampah.harga_total')
                        ->LEFTJOIN('bank_sampah', 'bank_sampah.id', '=', 'setoran_anggota_bank_sampah.id_bank_sampah')
                        ->JOIN('users', 'users.id', '=', 'bank_sampah.id_users')
                        ->where('users.id', Auth::user()->id)
                        ->get();
        $konversi = KonversiSampah::select('id', 'jenis_sampah', 'harga_konversi')
                    // ->join('konversi', 'konversi.id', '=', 'setoran_anggota_bank_sampah.id_konversi')
                    // ->where('id', 'setoran_anggota_bank_sampah.id_konversi')
                    ->get();
        $filter_nama = DaftarSetor::select('id', 'nama')->get();
        // dd($daftar_setor);
        return view('bankSampah.layanan.daftar_setor.index', compact('user', 'daftar_setor', 'konversi', 'filter_nama'));
    }

    public function getData(Request $request){
        $user = Auth::user();
        $daftar_setor = DaftarSetor::select('setoran_anggota_bank_sampah.id', 'setoran_anggota_bank_sampah.nama', 
                            'setoran_anggota_bank_sampah.tanggal_transaksi', 'setoran_anggota_bank_sampah.id_konversi',
                            'setoran_anggota_bank_sampah.berat', 'setoran_anggota_bank_sampah.harga_total')
                        ->LEFTJOIN('bank_sampah', 'bank_sampah.id', '=', 'setoran_anggota_bank_sampah.id_bank_sampah')
                        ->JOIN('users', 'users.id', '=', 'bank_sampah.id_users')
                        ->where('users.id', Auth::user()->id)
                        ->get();
        
        $filter_nama = DaftarSetor::select('id', 'nama')->get();
        if(request()->ajax()) {
            $konversi = KonversiSampah::select('id', 'jenis_sampah', 'harga_konversi')
                    ->where('id', '$daftar_setor->id_konversi')
                    ->get();
            return datatables()->of($daftar_setor, $konversi)
            ->addColumn('action', function($row){
                $btn = '<a href="'.route('daftar_setor.edit',$row->id, 'edit').'" class="btn btn-success btn-sm" data-toggle="tooltip" 
                        data-placement="top" data-original-title="Edit"><i class="far fa-edit"></i></a>';
                $btn = $btn.'<form action="'.route('daftar_setor.destroy',$row->id).'"<a href="" <button class="btn btn-danger btn-sm" 
                        data-toggle="tooltip" data-placement="top" data-original-title="Delete" type="submit">
                        <i class="far fa-trash-alt"></i></button></a></form>';
                return $btn;
            })
            ->addColumn('nama', function($row){
                return $row['nama'];
            })
            ->addColumn('tanggal_transaksi', function($row){
                return $row['tanggal_transaksi'];
            })
            ->addColumn('jenis_sampah', function($row){
                return KonversiSampah::select('jenis_sampah')
                ->where('id', $row->id_konversi)
                ->value('jenis_sampah');
            })
            ->addColumn('harga_konversi', function($row){
                return KonversiSampah::select('harga_konversi')
                ->where('id', $row->id_konversi)
                ->value('harga_konversi');
            })
            ->addColumn('berat', function($row){
                return $row['berat'];
            })
            ->addColumn('harga_total', function($row){
                return $row['harga_total'];
            })
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }
        //    menjalankan search
        if($request->input('search.value')!=null){
            $data = $data->where(function($q)use($request){
                $q->whereRaw('LOWER(setoran_anggota_bank_sampah.nama) like ? ',['%'.strtolower($request->input('search.value')).'%'])
                ->orWhereRaw('LOWER(setoran_anggota_bank_sampah.tanggal_transaksi) like ? ',['%'.strtolower($request->input('search.value')).'%'])
                ->orWhereRaw('LOWER(konversi.jenis_sampah) like ? ',['%'.strtolower($request->input('search.value')).'%'])
                ->orWhereRaw('LOWER(konversi.harga_konversi) like ? ',['%'.strtolower($request->input('search.value')).'%'])
                ->orWhereRaw('LOWER(setoran_anggota_bank_sampah.berat) like ? ',['%'.strtolower($request->input('search.value')).'%'])
                ->orWhereRaw('LOWER(setoran_anggota_bank_sampah.harga_total) like ? ',['%'.strtolower($request->input('search.value')).'%'])
                ;
            });
        }
        // dd($row->daftar_setor->nama);
        // return view('bankSampah.layanan.daftar_setor.index');
    }

    public function lihatdata(){
        $user = Auth::user();
        $daftar_setor = DaftarSetor::select('setoran_anggota_bank_sampah.id', 'setoran_anggota_bank_sampah.nama', 
                            'setoran_anggota_bank_sampah.tanggal_transaksi', 
                            'setoran_anggota_bank_sampah.berat', 'setoran_anggota_bank_sampah.harga_total')
                        ->LEFTJOIN('bank_sampah', 'bank_sampah.id', '=', 'setoran_anggota_bank_sampah.id_bank_sampah')
                        ->JOIN('users', 'users.id', '=', 'bank_sampah.id_users')
                        ->where('users.id', Auth::user()->id)
                        ->get();
        $konversi = KonversiSampah::select('id', 'jenis_sampah', 'harga_konversi')
                    ->where('konversi.id', 'id_konversi')
                    ->get();
        $filter_nama = DaftarSetor::select('id', 'nama')->get();
        return response()->json(['data sukses']);
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $bank_sampah = BankSampah::select('id')->get();
        $konversi = KonversiSampah::select('id', 'jenis_sampah', 'harga_konversi')->get();
        return view('bankSampah.layanan.daftar_setor.tambah', compact('bank_sampah', 'konversi'));
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
            'id_konversi.required' => 'Jenis sampah wajib diisi.',
            'berat.required' => 'Berat wajib diisi'
        ];

        $validator = $request->validate([
            'nama' => 'required',
            'tanggal_transaksi' => 'required',
            'id_konversi' => 'required',
            'berat' => 'required',
        ], $messages);
        
        $daftar_setor = $request->all();
        $id_bank_sampah=BankSampah::where('id_users', Auth::user()->id)->value('id');
        $data = array();
        foreach ($daftar_setor['row'] as $i) {
            $data[] = [
                'nama' => $daftar_setor['nama'],
                'id_bank_sampah' =>  $id_bank_sampah,
                'tanggal_transaksi' =>  $daftar_setor['tanggal_transaksi'],
                'id_konversi' => (int)$i['id_konversi'],
                'berat' => $i['berat'],
                'harga_total' => $i['harga'] * $i['berat'],
                'created_at' => Carbon::now(),
            ];
        }
        DaftarSetor::insert($data);
        return response()->json($daftar_setor);
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
        $konversi = KonversiSampah::select('id', 'jenis_sampah', 'harga_konversi')->get();
        return view('bankSampah.layanan.daftar_setor.edit', compact('daftar_setor', 'konversi'));
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
        ];

        $validator = $request->validate([
            'nama' => 'required',
            'tanggal_transaksi' => 'required',
        ], $messages);

        $daftar_setor = DaftarSetor::find($id);
        $input = $request->all();
        $input['id_bank_sampah'] = BankSampah::where('id_users', Auth::user()->id)->value('id');
        $konversi = KonversiSampah::where('id', $request['id_konversi'])->value('harga_konversi');
        $input['harga_total'] = $konversi * $request->berat;
        
        $daftar_setor->update($input);
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

    public function data(Request $request)
    {
    	$orderBy = 'setoran_anggota_bank_sampah.id';
        switch($request->input('order.0.column')){
            case "1":
                $orderBy = 'setoran_anggota_bank_sampah.nama';
                break;
            // case "2":
            //     $orderBy = 'setoran_anggota_bank_sampah.tanggal_transaksi';
            //     break;
            // case "3":
            //     $orderBy = 'konversi.jenis_sampah';
            //     break;
            // case "4":
            //     $orderBy = 'konversi.harga_konversi';
            //     break;
            // case "5":
            //     $orderBy = 'setoran_anggota_bank_sampah.berat';
            //     break;
            // case "6":
            //     $orderBy = 'setoran_anggota_bank_sampah.harga_total';
            //     break;
        }

        $data = DaftarSetor::all();

        //filter by kategory
        // if($request->input('filter') != "all"){
        //     $data = $data->where('retribusi_warga.bulan_tagihan', $request->filter);
        // }else{
        //     $data;
        // }

        //menjalankan search
        // if($request->input('search.value')!=null){
        //     $data = $data->where(function($q)use($request){
        //         $q->whereRaw('LOWER(setoran_anggota_bank_sampah.nama) like ? ',['%'.strtolower($request->input('search.value')).'%'])
        //         ->orWhereRaw('LOWER(setoran_anggota_bank_sampah.tanggal_transaksi) like ? ',['%'.strtolower($request->input('search.value')).'%'])
        //         ->orWhereRaw('LOWER(konversi.jenis_sampah) like ? ',['%'.strtolower($request->input('search.value')).'%'])
        //         ->orWhereRaw('LOWER(konversi.harga_konversi) like ? ',['%'.strtolower($request->input('search.value')).'%'])
        //         ->orWhereRaw('LOWER(setoran_anggota_bank_sampah.berat) like ? ',['%'.strtolower($request->input('search.value')).'%'])
        //         ->orWhereRaw('LOWER(setoran_anggota_bank_sampah.harga_total) like ? ',['%'.strtolower($request->input('search.value')).'%'])
        //         ;
        //     });
        // }
        
        // $recordsFiltered = $data->get()->count();
        // if($request->input('length')!=-1) $data = $data->skip($request->input('start'))->take($request->input('length'));
        // $data = $data->orderBy($orderBy,$request->input('order.0.dir'))->get();
        // $recordsTotal = $data->count();
        // return response()->json([
        //     'draw'=>$request->input('draw'),
        //     'recordsTotal'=>$recordsTotal,
        //     'recordsFiltered'=>$recordsFiltered,
        //     'data'=>$data
        // ]);
    }

}
