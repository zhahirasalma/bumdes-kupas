<?php

namespace App\Imports;

use App\Models\KonversiSampah;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Validators\Failure;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class KonversiImport implements ToModel, WithValidation, WithHeadingRow, SkipsOnFailure, SkipsOnError
{
    use Importable, SkipsFailures, SkipsErrors;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $now = date('Y-m-d H:i:s');
        return new KonversiSampah([
            'jenis_sampah'=>$row['jenis_sampah'],
            'harga_konversi'=>$row['harga_konversi'],
            'created_at'=>$now,
        ]);
    }

    public function rules(): array
    {
        return [
            'jenis_sampah' => [
                'required', 
                Rule::unique('konversi', 'jenis_sampah')->whereNull('deleted_at')
            ],
            'harga_konversi' => 'required|numeric',
        ];
    }

    public function customValidationMessages()
    {
        return [
            'jenis_sampah.required' => 'Jenis sampah wajib diisi.',
            'jenis_sampah.unique' => 'Jenis sampah sudah ada.',
            'harga_konversi.required' => 'Harga Konversi wajib diisi.',
            'harga_konversi.numeric' => 'Harga Konversi harus berupa angka.',
        ];
    }
}
