<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Validation\Rule;
Use Alert;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('role', 'admin')->orWhere('role', 'educator')->get();
        return view('backend.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.users.tambah');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $messages = [
            'nama.required' => 'Nama wajib diisi.',
            'nama.min' => 'Nama harus lebih dari 5 karakter.',
            'nama.unique' => 'Nama sudah terdaftar.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Email tidak valid.',
            'email.unique' => 'Email sudah terdaftar.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password harus lebih dari 5 karakter.',
            'role.required' => 'Role wajib diisi.',
            'role.not_in' => 'Pilih role sesuai daftar.',
        ];

        $validator = $request->validate([
            'nama' => ['required','min:5',
                        Rule::unique('users', 'nama')->whereNull('deleted_at')],
            'email' => ['required','min:10', 'email',
                        Rule::unique('users', 'email')->whereNull('deleted_at')],
            'password' => 'required|min:5',
            'role' => 'required|not_in:0',
        ], $messages);
    
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        User::create($input); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $users = User::find($id);
        return view('backend.users.edit', compact('users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $messages = [
            'nama.required' => 'Nama wajib diisi.',
            'nama.min' => 'Nama harus lebih dari 5 karakter.',
            'nama.unique' => 'Nama sudah terdaftar.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Email tidak valid.',
            'email.unique' => 'Email sudah terdaftar.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password harus lebih dari 5 karakter.',
            'role.required' => 'Role wajib diisi.',
            'role.not_in' => 'Pilih role sesuai daftar.',
        ];

        $validator = $request->validate([
            'nama' => ['required','min:5',
                        Rule::unique('users', 'nama')->ignore($id)->whereNull('deleted_at')],
            'email' => ['required','min:10', 'email',
                        Rule::unique('users', 'email')->ignore($id)->whereNull('deleted_at')],
            'password' => 'required|min:5',
            'role' => 'required|not_in:0',
        ], $messages);
        
        $users = User::find($id);
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $users->update($input);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $users = User::find($id);
        $users->delete();
    }
}
