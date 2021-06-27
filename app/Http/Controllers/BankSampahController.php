<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BankSampah;
use Auth;

class BankSampahController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $bank_sampah = BankSampah::all();
        return view('bankSampah.index', compact('user', 'bank_sampah'));
    }

}
