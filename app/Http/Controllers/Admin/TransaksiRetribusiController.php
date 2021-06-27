<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RetribusiWarga;
use App\Models\User;
use App\Models\Warga;
use App\Models\KategoriSampah;
Use Alert;

class TransaksiRetribusiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $retribusi = RetribusiWarga::sum('jumlah_tagihan');
        return view('backend.warga.retribusi.index', compact('retribusi'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = User::select('users.id', 'users.nama', 'warga.nik')
                ->join('warga', 'warga.id_users', '=', 'users.id')
                ->where('role', 'warga')
                ->get();
        return view('backend.warga.retribusi.tambah', compact('user'));
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
            'nama_kolektor.required' => 'Nama kolektor wajib diisi.',
            'nama_kolektor.regex' => 'Nama kolektor harus berupa huruf.',
            'bulan_tagihan.required' => 'Bulan Tagihan wajib diisi.',
            'keterangan.required' => 'Keterangan wajib diisi.',
            'tanggal_transaksi.required' => 'Tanggal transaksi wajib diisi.',
        ];
        
        $request->validate([
            'nama_kolektor' => 'required|regex:/^[a-zA-Z]+$/',
            'bulan_tagihan' => 'required',
            'tanggal_transaksi' => 'required',
            'id_users' => 'required'
        ], $messages);
        
        $input = $request->all();
        $input['id_warga'] = Warga::WHERE('id_users', $request['id_users'])->value('id');
        $input['jumlah_tagihan'] = KategoriSampah::where('users.id', $request->id_users)
                    ->join('warga', 'warga.id_kategori_sampah', '=', 'kategori_sampah.id')
                    ->join('users', 'users.id', '=', 'warga.id_users')
                    ->value('kategori_sampah.harga_retribusi');
        RetribusiWarga::create($input);
        Alert::success('Berhasil', 'Data retribusi berhasil ditambahkan');
        return redirect()->route('retribusi.index');  
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
        $retribusi = RetribusiWarga::find($id);
        $user = User::select('users.id', 'users.nama', 'warga.nik')
                ->join('warga', 'warga.id_users', '=', 'users.id')
                ->where('role', 'warga')
                ->get();
        return view('backend.warga.retribusi.edit', compact('retribusi', 'user'));
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
            'nama_kolektor.required' => 'Nama kolektor wajib diisi.',
            'nama_kolektor.regex' => 'Nama kolektor harus berupa huruf.',
            'bulan_tagihan.required' => 'Bulan Tagihan wajib diisi.',
            'keterangan.required' => 'Keterangan wajib diisi.',
            'tanggal_transaksi.required' => 'Tanggal transaksi wajib diisi.',
        ];
        
        $request->validate([
            'nama_kolektor' => 'required|regex:/^[a-zA-Z]+$/',
            'bulan_tagihan' => 'required',
            'keterangan' => 'required',
            'tanggal_transaksi' => 'required',
            'id_users' => 'required'
        ], $messages);

        $retribusi = RetribusiWarga::find($id);
        $input = $request->all();
        $input['id_warga'] = Warga::WHERE('id_users', $request['id_users'])->value('id');
        $input['jumlah_tagihan'] = KategoriSampah::where('users.id', $request->id_users)
                    ->join('warga', 'warga.id_kategori_sampah', '=', 'kategori_sampah.id')
                    ->join('users', 'users.id', '=', 'warga.id_users')
                    ->value('kategori_sampah.harga_retribusi');
        $retribusi->update($input);
        Alert::success('Berhasil', 'Data retribusi berhasil diubah');
        return redirect()->route('retribusi.index');  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $retribusi = RetribusiWarga::find($id);
        $retribusi->delete();
        Alert::success('Berhasil', 'Data retribusi berhasil dihapus');
        return back();  
    }

    public function getTagihan($user_id)
    {
        $tagihan = KategoriSampah::select('kategori_sampah.harga_retribusi')
                    ->join('warga', 'warga.id_kategori_sampah', '=', 'kategori_sampah.id')
                    ->join('users', 'users.id', '=', 'warga.id_users')
                    ->where('users.id', $user_id)->get();
        return response()->json($tagihan);
    }

    public function data(Request $request)
    {
    	$orderBy = 'retribusi_warga.id_warga';
        switch($request->input('order.0.column')){
            case "1":
                $orderBy = 'users.nama';
                break;
            case "2":
                $orderBy = 'retribusi_warga.nama_kolektor';
                break;
            case "3":
                $orderBy = 'retribusi_warga.jumlah_tagihan';
                break;
            case "4":
                $orderBy = 'retribusi_warga.bulan_tagihan';
                break;
            case "5":
                $orderBy = 'retribusi_warga.tanggal_transaksi';
                break;
            case "6":
                $orderBy = 'retribusi_warga.keterangan';
                break;
        }

        $data = RetribusiWarga::select('retribusi_warga.*', 'users.nama', 'warga.nik')
                    ->join('warga', 'warga.id', '=', 'retribusi_warga.id_warga')
                    ->join('users', 'users.id', '=', 'warga.id_users');

        //filter by kategory
        if($request->input('filter') != "all"){
            $data = $data->where('retribusi_warga.bulan_tagihan', $request->filter);
        }else{
            $data;
        }

        //menjalankan search
        if($request->input('search.value')!=null){
            $data = $data->where(function($q)use($request){
                $q->whereRaw('LOWER(users.nama) like ? ',['%'.strtolower($request->input('search.value')).'%'])
                ->orWhereRaw('LOWER(retribusi_warga.nama_kolektor) like ? ',['%'.strtolower($request->input('search.value')).'%'])
                ->orWhereRaw('LOWER(retribusi_warga.jumlah_tagihan) like ? ',['%'.strtolower($request->input('search.value')).'%'])
                ->orWhereRaw('LOWER(retribusi_warga.bulan_tagihan) like ? ',['%'.strtolower($request->input('search.value')).'%'])
                ->orWhereRaw('LOWER(retribusi_warga.tanggal_transaksi) like ? ',['%'.strtolower($request->input('search.value')).'%'])
                ->orWhereRaw('LOWER(retribusi_warga.keterangan) like ? ',['%'.strtolower($request->input('search.value')).'%'])
                ;
            });
        }
        
        $recordsFiltered = $data->get()->count();
        if($request->input('length')!=-1) $data = $data->skip($request->input('start'))->take($request->input('length'));
        $data = $data->orderBy($orderBy,$request->input('order.0.dir'))->get();
        $recordsTotal = $data->count();
        return response()->json([
            'draw'=>$request->input('draw'),
            'recordsTotal'=>$recordsTotal,
            'recordsFiltered'=>$recordsFiltered,
            'data'=>$data
        ]);
    }

    public function totalRetribusi($filter)
    {
        $total = RetribusiWarga::selectRaw('SUM(jumlah_tagihan) as total')
                ->get();
        
        if($filter != "all"){
            $total = RetribusiWarga::groupBy('bulan_tagihan')
                        ->where('bulan_tagihan', $filter)
                        ->selectRaw('*, sum(jumlah_tagihan) as total')
                        ->get();
        }
        return $total;
    }
}
