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

    // public function index()
    // {
    //     return view('auth.home');
    // }

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

    // public function logout(Request $request)
    // {
    //     $this->guard()->logout();

    //     $request->session()->invalidate();

    //     return redirect('/');
    // }

    // public function login(Request $request)
    // {
    //     $rules = [
    //         'email'                 => 'required|email',
    //         'password'              => 'required|string'
    //     ];
 
    //     $messages = [
    //         'email.required'        => 'Email wajib diisi',
    //         'email.email'           => 'Email tidak valid',
    //         'password.required'     => 'Password wajib diisi',
    //         'password.string'       => 'Password harus berupa string'
    //     ];
 
    //     $validator = Validator::make($request->all(), $rules, $messages);
 
    //     if($validator->fails()){
    //         return redirect()->back()->withErrors($validator)->withInput($request->all);
    //     }
 
    //     $data = [
    //         'email'     => $request->input('email'),
    //         'password'  => $request->input('password'),
    //     ];
    //     Auth::attempt($data);
 
    //     if (Auth::check()) {
    //         $user = $request->user();
    //         if($user->role == "admin"){
    //             $request->session()->put('role',$user->role );
    //             $request->session()->put('nama','SuperAdmin' );
    //             return redirect()->route('admin/dashboard');
    //         }else if($user->role == "educator"){
    //             $request->session()->put('nama',$user->nama);
    //             $request->session()->put('role',$user->role );
    //             return redirect()->route('admin/pengambilan');
    //         }else if($user->role == "warga"){
    //             $request->session()->put('nama',$user->nama);
    //             $request->session()->put('role',$user->role );
    //             return redirect()->route('homewarga');
    //         } else if ($user->role == "bank_sampah") {
    //             $request->session()->put('nama',$user->nama);
    //             $request->session()->put('role',$user->role );
    //             return redirect()->route('homebanksampah');
    //         }
    //     } else {
    //         session([
    //             'error'  => [('Email atau password salah')],
    //         ]);
    //         return redirect()->route('');
    //     }
 
    // }

    // public function login_user(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'email' => 'required|string|email',
    //         'password' => 'required|string',
    //     ]);
    //     $credentials = request(['email', 'password']);
    //     if ($validator->fails()) {    
    //         return response()->json([
    //             'status' => 'Failed',
    //             'message' => $validator->messages()
    //         ],422);
    //     }else{
    //         if(Auth::attempt($credentials)){
    //             $user = $request->user();
    //             $tokenResult = $user->createToken('Personal Access Token');
    //             $token = $tokenResult->token;
    //             $token->save();
                
    //             // if($user->id_role == 4){
    //                 $users = $user->toArray();
    //                 return response()->json([
    //                     'status' => 'Success',
    //                     'token' => $tokenResult->accessToken,
    //                     // 'id_role' =>array_values($users)[0]['id_role'],
    //                 ]);
    //             // }
    //         }else{
    //             return response()->json([   
    //                 'status' => 'Failed',
    //                 'message' => 'Your Credintial are wrong!'
    //             ], 401);
    //         }
    //     }
    // }

    // /**
    //  * Where to redirect users after login.
    //  *
    //  * @var string
    //  */
    // protected $redirectTo = RouteServiceProvider::WARGA;

    // public function logout(Request $request)
    // {
    //     $this->guard()->logout();

    //     $request->session()->invalidate();

    //     $request->session()->regenerateToken();

    //     if ($response = $this->loggedOut($request)) {
    //         return $response;
    //     }

    //     return $request->wantsJson()
    //         ? new JsonResponse([], 204)
    //         : redirect('/');
    // }

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
