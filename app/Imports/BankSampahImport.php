<?php

namespace App\Imports;

use App\Models\BankSampah;
use App\Models\User;
use App\Models\Kota;
use App\Models\Kecamatan;
use App\Models\Desa;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class BankSampahImport implements ToCollection, WithHeadingRow, SkipsOnFailure, WithValidation
{
    use Importable, SkipsFailures;
    private $errors = [];
    
    public function collection(Collection $rows)
    {
        $now = date('Y-m-d H:i:s');
        $rows = $rows->toArray();
        foreach ($rows as $row) 
        {
            $validator = Validator::make($row, $this->rules(), $this->customValidationMessages());
            if($validator->fails()){
                $this->errors[] = $validator->errors();
            }else{
                $user = User::create([
                'nama' => $row['nama'],
                'email' => $row['email'],
                'password' => bcrypt($row['password']),
                'role' => 'bank_sampah',
                'created_at'=>$now,
                ]);

                BankSampah::create([
                    'id_users' => $user->id,
                    'no_telp' => $row['no_telp'],
                    'id_kota' => Kota::where("kota", "like", "%".$row['kota']."%")->first()->id,
                    'id_kecamatan' => Kecamatan::where("kecamatan", "like", "%".$row['kecamatan']."%")->first()->id,
                    'id_desa' => Desa::where("desa", "like", "%".$row['desa']."%")->first()->id,
                    'dukuh' => $row['dukuh'],
                    'detail_alamat' => $row['detail_alamat'],
                    'created_at'=>$now,
                ]);
            }
        }
    }

    public function getErrors()
    {
        return $this->errors;
    }

    public function rules(): array
    {
        return [
            'nama' => 'required|min:3',
            'no_telp' => 'required|numeric',
            'email' => ['required','min:10', 'email',
                        Rule::unique('users', 'email')->whereNull('deleted_at')],
            'password' => 'required|min:5',
            'kota' => 'required',
            'kecamatan' => 'required',
            'desa' => 'required',
            'dukuh' => 'required',
            'detail_alamat' => 'required',
        ];
    }

    public function customValidationMessages()
    {
        return [
            'nama.required' => 'Nama wajib diisi.',
            'nama.min' => 'Nama minimal 3 huruf.',
            'no_telp.required' => 'No telepon wajib diisi.',
            'no_telp.size' => 'No telepon minimal 11 digit.',
            'no_telp.numeric' => 'No telepon harus angka.',
            'email.required' => 'Email wajib diisi.',
            'email.min' => 'Email minimal 11 huruf.',
            'email.unique' => 'Email sudah terpakai.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 5 huruf.',
            'kota.required' => 'Kota wajib diisi.',
            'kecamatan.required' => 'Kecamatan wajib diisi.',
            'desa.required' => 'Desa wajib diisi.',
            'dukuh.required' => 'Dukuh wajib diisi.',
            'detail_alamat.required' => 'Detail alamat wajib diisi.',
        ];
    }
}
