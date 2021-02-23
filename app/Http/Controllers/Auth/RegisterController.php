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
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

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
        $this->middleware('guest');
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
            'lokasi' => ['required'],
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
    //     $this->validate($request,[
    //         'nama' => 'required|min:3|string',
    //         'email' => 'required|min:11|email|unique:users',
    //         'password' => 'required|min:5',
    //         'no_telp' => 'required|min:11|numeric',
            
    //    ],
    //    [
    //        'nama.required' => 'Nama tidak boleh kosong.',
    //        'nama.min' => 'Nama minimal terdiri dari 3 huruf.',
    //        'nama.string' => 'Nama harus berupa huruf.',
    //        'email.required' => 'Email tidak boleh kosong.',
    //        'email.email' => 'Email tidak valid.',
    //        'email.unique' => 'Email telah digunakan.',
    //        'password.min' => 'Kata sandi tidak boleh kurang dari 5 karakter',
    //        'password.required' => 'Kata sandi tidak boleh kosong',
    //        'no_telp.required' => 'Nomor telepon tidak boleh kosong.',
    //        'no_telp.min' => 'Nomor telepon minimal terdiri dari 11 angka',
    //        'no_telp.numeric' => 'Nomor telepon harus berupa angka'
    //    ]);
       $user = new User;
       $user->role="bank_sampah";
       $user->nama = $request->input('nama');
       $user->email = $request->input('email');
       $user->password = $request->input('password');
       if($user){
           $user->save();
       }

        $bank_sampah = new BankSampah;
        $bank_sampah->id_users=$user->id;
        $bank_sampah->no_telp = $request->input('no_telp');
        $bank_sampah->id_kota = $request->input('id_kota');
        $bank_sampah->id_kota = $request->input('id_kecamatan');
        $bank_sampah->id_kota = $request->input('id_desa');
        $bank_sampah->dukuh = $request->input('dukuh');
        $bank_sampah->detail_alamat = $request->input('detail_alamat');
        if($bank_sampah){
            $bank_sampah->save();
        }

        return redirect()->route('bankSampah.index');

    }
    public function store_warga(Request $request){
        $this->validate($request,[
            'nama' => 'required|min:3|string',
            'email' => 'required|min:11|email|unique:users',
            'password' => 'required|min:5',
            'NIK' => 'required|numeric',
            'no_telp' => 'required|min:11|numeric',
            
       ],
       [
           'nama.required' => 'Nama tidak boleh kosong.',
           'nama.min' => 'Nama minimal terdiri dari 3 huruf.',
           'nama.string' => 'Nama harus berupa huruf.',
           'email.required' => 'Email tidak boleh kosong.',
           'email.email' => 'Email tidak valid.',
           'email.unique' => 'Email telah digunakan.',
           'password.min' => 'Kata sandi tidak boleh kurang dari 5 karakter',
           'password.required' => 'Kata sandi tidak boleh kosong',
           'NIK.required' => 'NIK tidak boleh kosong.',
           'NIK.numeric' => 'NIK harus berupa angka.',
           'no_telp.required' => 'Nomor telepon tidak boleh kosong.',
           'no_telp.min' => 'Nomor telepon minimal terdiri dari 11 angka',
           'no_telp.numeric' => 'Nomor telepon harus berupa angka'
       ]);
       $user = new User;
       $user->nama = $request->input('nama');
       $user->email = $request->input('email');
       $user->password = $request->input('password');
       if($user){
           $user->save();
       }
       
       $warga = new Warga;
       $warga->id_users=$user->id;
       $warga->NIK = $request->input('NIK');
       $warga->no_telp = $request->input('no_telp');
       $warga->id_kota = $request->input('id_kota');
       $warga->id_kota = $request->input('id_kecamatan');
       $warga->id_kota = $request->input('id_desa');
       $warga->dukuh = $request->input('dukuh');
       $warga->detail_alamat = $request->input('detail_alamat');
       $warga->lokasi = $request->input('lokasi');
       $warga->id_kategori_sampah = $request->input('id_kategori_sampah');
       if($warga){
        $warga->save();
        }

        return redirect('warga.index');
    }
    
}
