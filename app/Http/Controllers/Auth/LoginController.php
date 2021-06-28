<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Validator,Response;
use Session;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;
    
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    public function login(\Illuminate\Http\Request $request){
        //echo($user);
        
        $messages=[
            'email.required' => 'Email tidak boleh kosong.',
            'email.email' => 'Email tidak valid.',
            'password.min' => 'Kata sandi tidak boleh kurang dari 5 karakter',
            'password.required' => 'Kata sandi tidak boleh kosong.',
        ];
        $validationData = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:5'
        ],$messages);

        if (!auth()->attempt($validationData)) {
            return redirect()->back()->with('error', 'Email atau kata sandi salah!');  
        }
        $user = auth()->user();
        $role = $user->role;


        if($role == 'admin'){
            return redirect('/admin');
        }else if($role == 'educator'){
            return redirect('/educator');
        }else if($role == 'warga'){
            return redirect('/warga');
        }else if($role == 'bank_sampah'){
            return redirect('/bank_sampah');
        }else{
            return redirect('/');
        } 
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        return redirect('/');
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('guest')->except('logout');
    // }
}
