@extends('backend.layout.master')
@section('title')
Tambah Users
@endsection


@section('content')
<div class="col-xl-12">
    <div class="card bg-secondary shadow">
        <div class="card-header bg-white border-0">
            <div class="col-8">
                <h3 class="mb-0">Form Tambah</h3>
            </div>
        </div>
        <div class="row align-items-center">
            <div class="card-body">
                <form action="{{route('users.store')}}" method="POST">
                    @csrf
                    <div class="pl-lg-4">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-nama">Nama</label>
                                    <input type="text" name="nama" class="form-control form-control-alternative"
                                        placeholder="Nama" value="">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-first-name">Email</label>
                                    <input type="email" name="email" class="form-control form-control-alternative"
                                        placeholder="Email" value="">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-first-name">Password</label>
                                    <input type="password" name="password" class="form-control form-control-alternative"
                                        placeholder="Password" value="">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-first-name">Role</label>
                                    <select name="role" class="form-control form-control-alternative"
                                        placeholder="Role">
                                        <option value="admin">admin</option>
                                        <option value="educator">educator</option>
                                        <option value="warga">warga</option>
                                        <option value="bank_sampah">bank_sampah</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <button class=" btn btn-success" type="submit">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
