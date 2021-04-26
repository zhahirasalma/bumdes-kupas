<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BankSampah;
use App\Models\User;
use App\Models\Kota;
use App\Models\Kecamatan;
use App\Models\Desa;
use App\Models\TransaksiBankSampah;
use App\Imports\BankSampahImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Validation\Rule;
Use Alert;

class BankSampahController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = BankSampah::with('user', 'kota', 'kecamatan', 'desa')->get();
        return view('backend.bank_sampah.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kota = Kota::all();
        $kecamatan = Kecamatan::all();
        $desa = Desa::all();
        return view('backend.bank_sampah.tambah', compact('kota', 'kecamatan', 'desa'));
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
            'nama.required' => 'Nama wajib diisi.',
            'nama.min' => 'Nama minimal 3 huruf.',
            'no_telp.required' => 'No telepon wajib diisi.',
            'no_telp.size' => 'No telepon minimal 11 digit.',
            'no_telp.numeric' => 'No telepon harus angka.',
            'email.required' => 'Email wajib diisi.',
            'email.min' => 'Email minimal 11 huruf.',
            'email.unique' => 'Email sudah terpakai.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 5 huruf.',
            'id_kota.required' => 'Kota wajib diisi.',
            'id_kecamatan.required' => 'Kecamatan wajib diisi.',
            'id_desa.required' => 'Desa wajib diisi.',
            'dukuh.required' => 'Dukuh wajib diisi.',
            'detail_alamat.required' => 'Detail alamat wajib diisi.',
        ];

        $request->validate([
            'nama' => 'required|min:3',
            'no_telp' => 'required|numeric|size:11',
            'email' => ['required','min:10', 'email',
                        Rule::unique('users', 'email')->whereNull('deleted_at')],
            'password' => 'required|min:5',
            'id_kota' => 'required',
            'id_kecamatan' => 'required',
            'id_desa' => 'required',
            'dukuh' => 'required',
            'detail_alamat' => 'required',
        ], $messages);

        $user = new User;
        $user->nama = $request->input('nama');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->role = "bank_sampah";
        if($user){
            $user->save();
        }

        if($user){
            $bank_sampah = new BankSampah;
            $bank_sampah->id_users=$user->id;
            $bank_sampah->no_telp = $request->input('no_telp');
            $bank_sampah->id_kota = $request->input('id_kota');
            $bank_sampah->id_kecamatan = $request->input('id_kecamatan');
            $bank_sampah->id_desa = $request->input('id_desa');
            $bank_sampah->dukuh = $request->input('dukuh');
            $bank_sampah->detail_alamat = $request->input('detail_alamat');
            if($bank_sampah){
                $bank_sampah->save();
            }
            return redirect()->route('bank_sampah.index');  
        }   
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
        $data = BankSampah::find($id);
        $user = User::select('id', 'nama')->where('role', 'bank_sampah')->get();
        $kota = Kota::all();
        $kecamatan = Kecamatan::all()->where('id_kota', Kota::where('id', 
                Banksampah::where('id', $id)->value('id_kota'))->value('id'));
        $desa = Desa::all()->where('id_kecamatan', Kecamatan::where('id', 
                Banksampah::where('id', $id)->value('id_kecamatan'))->value('id'));
        return view('backend.bank_sampah.edit', compact('data', 'user', 'kota', 'kecamatan', 'desa'));
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
            'nama.required' => 'Nama wajib diisi.',
            'nama.min' => 'Nama minimal 3 huruf.',
            'no_telp.required' => 'No telepon wajib diisi.',
            'no_telp.size' => 'No telepon minimal 11 digit.',
            'no_telp.numeric' => 'No telepon harus angka.',
            'email.required' => 'Email wajib diisi.',
            'email.min' => 'Email minimal 11 huruf.',
            'email.unique' => 'Email sudah terpakai.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 5 huruf.',
            'id_kota.required' => 'Kota wajib diisi.',
            'id_kecamatan.required' => 'Kecamatan wajib diisi.',
            'id_desa.required' => 'Desa wajib diisi.',
            'dukuh.required' => 'Dukuh wajib diisi.',
            'detail_alamat.required' => 'Detail alamat wajib diisi.',
        ];

        $request->validate([
            'nama' => 'required|min:3',
            'no_telp' => 'required|numeric',
            'email' => ['required','min:10', 'email',
                        Rule::unique('users', 'email')->ignore($id)->whereNull('deleted_at')],
            'password' => 'required|min:5',
            'id_kota' => 'required',
            'id_kecamatan' => 'required',
            'id_desa' => 'required',
            'dukuh' => 'required',
            'detail_alamat' => 'required',
        ], $messages);

        $bank_sampah = BankSampah::find($id);

        $user = User::where('id', $bank_sampah->id_users)->update([
            'nama' => $request->input('nama'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'role' => "bank_sampah"
        ]);
        
        if($user){
            $bank_sampah->update([
                'no_telp' => $request->input('no_telp'),
                'id_kota' => $request->input('id_kota'),
                'id_kecamatan' => $request->input('id_kecamatan'),
                'id_desa' => $request->input('id_desa'),
                'dukuh' => $request->input('dukuh'),
                'detail_alamat' => $request->input('detail_alamat'),
            ]);
            return redirect()->route('bank_sampah.index'); 
        } 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
        $check = TransaksiBankSampah::where('id_bank_sampah', $id)->exists();

        if($check){
            Alert::warning('Gagal', 'Data bank sampah digunakan di tabel transaksi bank sampah');
        }else{
            $data = BankSampah::find($id);
            $user = User::where('id', $data->id_users);
            $user->delete();
            $data->delete();
            Alert::success('Berhasil', 'Data bank sampah berhasil dihapus');
        }
    }

    public function importBankSampah(Request $request)
    {
        $file = $request->file('excel-bankSampah');
        Excel::import(new BankSampahImport,$file);
        Alert::success('Berhasil', 'Data bank sampah berhasil ditambahkan');
        return redirect()->back();
    }
}
