<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class AdminController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('backend.dashboard.index', compact('user'));
    }

    public function __construct(){
        $this->middleware('auth');
    }

}
