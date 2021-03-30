<?php

namespace App\Exports;

use App\Models\TransaksiBankSampah;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class TransaksiExport implements FromView
{
    private $id_bank_sampah;

    public function __construct(int $id_bank_sampah)
    {
         $this->id_bank_sampah = $id_bank_sampah;
    }
    
    public function view(): View
    {
        return view('backend.bank_sampah.transaksi.download', [
            'detail' => TransaksiBankSampah::with('bankSampah', 'user', 'konversi')
                        ->where('id_bank_sampah', $this->id_bank_sampah)->get()
        ]);
    }
}
