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
        
        $validationData = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        if (!auth()->attempt($validationData)) {
            return redirect('/');
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
