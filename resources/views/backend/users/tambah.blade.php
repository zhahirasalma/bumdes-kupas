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
                                        placeholder="Nama" value="{{ old('nama')}}">
                                    @if ($errors->has('nama'))
                                    <span class="text-danger">{{ $errors->first('nama') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-first-name">Email</label>
                                    <input type="email" name="email" class="form-control form-control-alternative"
                                        placeholder="Email" value="{{ old('email')}}">
                                    @if ($errors->has('email'))
                                    <span class="text-danger">{{ $errors->first('email') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-first-name">Password</label>
                                    <input type="password" name="password" class="form-control form-control-alternative"
                                        placeholder="Password" value="{{ old('password')}}">
                                    @if ($errors->has('password'))
                                    <span class="text-danger">{{ $errors->first('password') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-first-name">Role</label>
                                    <select name="role" class="form-control form-control-alternative"
                                        placeholder="Role">
                                        <option value="">Pilih...</option>
                                        <option value="admin" @if (old('role')=='admin' ) selected="selected" @endif>
                                            admin</option>
                                        <option value="educator" @if (old('role')=='educator' ) selected="selected"
                                            @endif>educator</option>
                                        <option value="warga" @if (old('role')=='warga' ) selected="selected" @endif>
                                            warga</option>
                                        <option value="bank_sampah" @if (old('role')=='bank_sampah' )
                                            selected="selected" @endif>bank_sampah</option>
                                    </select>
                                    @if ($errors->has('role'))
                                    <span class="text-danger">{{ $errors->first('role') }}</span>
                                    @endif
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
