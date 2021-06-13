<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Pengambilan;

class EducatorController extends Controller
{
    public function index(){
        $user = Auth::user();
        $pengambilan = Pengambilan::with('user', 'warga')->get();  
        return view('backend.pengambilan.index', compact('user', 'pengambilan'));
    }

    public function __construct(){
        $this->middleware('auth');
    }
}
