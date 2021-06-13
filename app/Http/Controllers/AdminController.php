<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\TransaksiBankSampah;
use App\Models\RetribusiWarga;
use App\Models\Pengambilan;

class AdminController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $retribusi = RetribusiWarga::count();
        $transaksi = TransaksiBankSampah::count();
        $terambil = Pengambilan::where('status', 0)->count();
        $belumterambil = Pengambilan::where('status', 1)->count();
        return view('backend.dashboard.index', compact('user', 'retribusi', 'transaksi', 'terambil', 'belumterambil'));
    }

    public function __construct(){
        $this->middleware('auth');
    }

}
