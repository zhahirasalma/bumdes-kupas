<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\BankSampah;
use App\Models\Warga;
use App\Models\Kota;
use App\Models\Kecamatan;
use App\Models\Desa;
use App\Models\KategoriSampah;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Validator;
use Auth;
use Alert;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $user = Auth::user();    
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'nama' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:5', 'confirmed'],
            'NIK' => ['required'],
            'no_telp' => ['required','min:10', 'max:13', 'unique:users'],
            'kota' => ['required'],
            'kecamatan' => ['required'],
            'desa' => ['required'],
            'dukuh' => ['required'],
            'detail_alamat',
            'latitude' => ['required'],
            'longitude' => ['required'],
            'id_kategori_sampah' => ['required'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    // protected function create(array $data)
    // {
    //     return User::create([
    //         'nama' => $data['nama'],
    //         'email' => $data['email'],
    //         'password' => Hash::make($data['password']),
    //     ]);
    // }

    public function create(){
        $kategori = KategoriSampah::select('id', 'jenis_sampah')->get();
        $kota = Kota::select('id', 'kota')->get();
        $kecamatan = Kecamatan::select('id', 'kecamatan')->get();
        $desa = Desa::select('id', 'desa')->get();
        return view('warga.register', compact('kategori', 'kota', 'kecamatan', 'desa'));
    }

    public function create_bank_sampah(){
        $kota = Kota::select('id', 'kota')->get();
        $kecamatan = Kecamatan::select('id', 'kecamatan')->get();
        $desa = Desa::select('id', 'desa')->get();
        return view('bankSampah.register', compact('kota', 'kecamatan', 'desa'));
    }

    public function show(){
 
    }

    public function store_bank_sampah (Request $request)
    {
        $messages=[
            'nama.required' => 'Nama tidak boleh kosong.',
            'nama.min' => 'Nama minimal terdiri dari 3 huruf.',
            'nama.string' => 'Nama harus berupa huruf.',
            'email.required' => 'Email tidak boleh kosong.',
            'email.email' => 'Email tidak valid.',
            'email.unique' => 'Email telah digunakan.',
            'password.min' => 'Kata sandi tidak boleh kurang dari 5 karakter',
            'password.required' => 'Kata sandi tidak boleh kosong',
            'no_telp.required' => 'Nomor telepon tidak boleh kosong.',
            'no_telp.min' => 'Nomor telepon minimal terdiri dari 11 angka',
            'no_telp.numeric' => 'Nomor telepon harus berupa angka',
            'id_kota.required' => 'Pilih kota sesuai alamat',
            'id_kecamatan.required' => 'Pilih kecamatan sesuai alamat',
            'id_desa.required' => 'Pilih desa sesuai alamat',
            'dukuh.required' => 'Dukuh tidak boleh kosong'
        ];
        
        $validationData = $request->validate([
            'nama' => 'required|min:3|string',
            'email' => 'required|min:10|email|unique:users',
            'password' => 'required|min:5',
            'no_telp' => 'required|min:11|numeric',
            'id_kota' => 'required',
            'id_kecamatan' => 'required',
            'id_desa' => 'required',
            'dukuh' => 'required'
       ],$messages);

        $user = new User;
        $user->nama = $request->input('nama');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->role="bank_sampah";
        if($user){
            $user->save();
        }

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

        return redirect('/')->with(['success' => 'Masukkan email dan kata sandi di form masuk untuk menuju halaman bank sampah.']);

    }
    public function store_warga(Request $request){
        $messages = [
            'NIK.required' => 'NIK tidak boleh kosong.',
            'NIK.numeric' => 'NIK harus berupa angka.',
            'NIK.min' => 'NIK harus 16 angka.',
            'nama.required' => 'Nama tidak boleh kosong.',
            'nama.min' => 'Nama minimal terdiri dari 3 huruf.',
            'nama.string' => 'Nama harus berupa huruf.',
            'email.required' => 'Email tidak boleh kosong.',
            'email.email' => 'Email tidak valid.',
            'email.unique' => 'Email telah digunakan.',
            'password.min' => 'Kata sandi tidak boleh kurang dari 5 karakter',
            'password.required' => 'Kata sandi tidak boleh kosong',
            'no_telp.required' => 'Nomor telepon tidak boleh kosong.',
            'no_telp.min' => 'Nomor telepon minimal terdiri dari 11 angka',
            'no_telp.numeric' => 'Nomor telepon harus berupa angka',
            'id_kategori_sampah.required' => 'Pilih salah satu kategori sampah',
            'id_kota.required' => 'Kota tidak boleh kosong',
            'id_kecamatan.required' => 'Kecamatan tidak boleh kosong',
            'id_desa.required' => 'Desa tidak boleh kosong',
            'dukuh.required' => 'Dukuh tidak boleh kosong'
        ]; 
        $validationData = $request->validate([
            'NIK' => 'required|min:16|numeric',
            'nama' => 'required|min:3|string',
            'email' => 'required|min:11|email|unique:users',
            'password' => 'required|min:5',
            'no_telp' => 'required|min:11|numeric',
            'id_kategori_sampah' => 'required',
            'id_kota' => 'required',
            'id_kecamatan' => 'required',
            'id_desa' => 'required',
            'dukuh' => 'required',
            'latitude' => 'nullable',
            'longitude' => 'nullable',
       ],$messages
       );

       $user = new User;
       $user->nama = $request->input('nama');
       $user->email = $request->input('email');
       $user->password = bcrypt($request->input('password'));
       $user->role = "warga";
       if($user){
           $user->save();
       }
       
       $warga = new Warga;
       $warga->id_users=$user->id;
       $warga->NIK = $request->input('NIK');
       $warga->no_telp = $request->input('no_telp');
       $warga->id_kota = $request->input('id_kota');
       $warga->id_kecamatan = $request->input('id_kecamatan');
       $warga->id_desa = $request->input('id_desa');
       $warga->dukuh = $request->input('dukuh');
       $warga->detail_alamat = $request->input('detail_alamat');
       $warga->latitude = $request->input('latitude');
       $warga->longitude = $request->input('longitude');
       $warga->id_kategori_sampah = $request->input('id_kategori_sampah');
       if($warga){
        $warga->save();
        }

        return redirect('/')->with(['success' => 'Masukkan email dan kata sandi di form masuk untuk menuju halaman warga.']);
    }
    
}
