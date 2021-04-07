<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pengambilan;
use App\Models\User;
use App\Models\Warga;
use App\Models\KategoriSampah;
use Carbon\carbon;
use Alert;

class PengambilanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pengambilan = Pengambilan::with('user', 'warga')->get();        
        return view('backend.pengambilan.index', compact('pengambilan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.pengambilan.tambah');
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pengambilan = Pengambilan::find($id);
        $pengambilan->delete();
        Alert::success('Berhasil', 'Data pengambilan berhasil dihapus');
        return back();  
    }

    public function ubahstatus(Request $request)
    {
        $pengambilan = Pengambilan::find($request->id);
        $pengambilan->status = $request->status;
        $pengambilan->save();

        return response()->json($pengambilan);
    }

    public function data(Request $request)
    {
    	$orderBy = 'users.nama';
        switch($request->input('order.0.column')){
            case "1":
                $orderBy = 'users.nama';
                break;
            case "2":
                $orderBy = 'kategori_sampah.jenis_sampah';
                break;
        }
        
        $data = Warga::select('warga.*', 'kategori_sampah.jenis_sampah', 'users.nama')
                    ->join('users', 'users.id', '=', 'warga.id_users')
                    ->join('kategori_sampah', 'kategori_sampah.id', '=', 'warga.id_kategori_sampah')
                    ->LEFTJOIN('pengambilan_sampah', 'pengambilan_sampah.id_warga', '=', 'warga.id')
                    ->whereNULL('pengambilan_sampah.id_warga');
        
        //filter by kategory
        if($request->input('filter') != 0){
            $data = $data->where('warga.id_kategori_sampah', $request->filter);
        }else{
            $data;
        }

        //menjalankan search
        if($request->input('search.value')!=null){
            $data = $data->where(function($q)use($request){
                $q->whereRaw('LOWER(users.nama) like ? ',['%'.strtolower($request->input('search.value')).'%'])
                ->orWhereRaw('LOWER(kategori_sampah.jenis_sampah) like ? ',['%'.strtolower($request->input('search.value')).'%'])
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

    public function tambah(Request $request)
    {        
        $this->validate($request, [
            'id_users' => 'required',
            'waktu' => 'required'
            ]);

        $input= $request->id_users;
        $waktu = $request->waktu;
        $data=array();
        foreach($input as $i){
            $data[] = [
                'id_users' => $i,
                'id_warga' => Warga::WHERE('id_users', $i)->value('id'),
                'waktu_pengambilan' => $waktu,
                'status' => 1,
                'created_at' => Carbon::now(),
            ];
        }
        Pengambilan::insert($data);
        return response()->json(true);
    }

    public function reset(){
        Pengambilan::whereNotNull('id')->delete();
        Alert::success('Berhasil', 'Data pengambilan berhasil dihapus');
        return back(); 
    }
}
