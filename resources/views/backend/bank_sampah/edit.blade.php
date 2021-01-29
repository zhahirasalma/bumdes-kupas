@extends('backend.layout.master')
@section('title')
Edit Data Bank Sampah
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
                <form action="{{route('bank_sampah.update', $data->id)}}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="pl-lg-4">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-nama">Email</label>
                                    <select name="id_users" class="form-control">
                                        <option value="">Pilih nama bank sampah...</option>
                                        @foreach($user as $u)
                                        <option value="{{$u->id}}" {{ $u->id == $data->id_users ? 'selected' : '' }}>
                                            {{$u->nama}}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('id_users'))
                                    <span class="text-danger">{{ $errors->first('id_users') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-first-name">No Telepon</label>
                                    <input type="text" name="no_telp" class="form-control form-control-alternative"
                                        placeholder="No Telepon" value="{{$data->no_telp}}">
                                    @if ($errors->has('no_telp'))
                                    <span class="text-danger">{{ $errors->first('no_telp') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="pl-lg-4">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-city">Kota</label>
                                    <input type="text" name="kota" class="form-control form-control-alternative"
                                        placeholder="City" value="{{$data->kota}}">
                                    @if ($errors->has('kota'))
                                    <span class="text-danger">{{ $errors->first('kota') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-country">Kecamatan</label>
                                    <input type="text" name="kecamatan" class="form-control form-control-alternative"
                                        placeholder="Country" value="{{$data->kecamatan}}">
                                    @if ($errors->has('kecamatan'))
                                    <span class="text-danger">{{ $errors->first('kecamatan') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-country">Desa</label>
                                    <input type="text" name="desa" class="form-control form-control-alternative"
                                        placeholder="Desa" value="{{$data->desa}}">
                                    @if ($errors->has('desa'))
                                    <span class="text-danger">{{ $errors->first('desa') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-city">Dukuh</label>
                                    <input type="text" name="dukuh" class="form-control form-control-alternative"
                                        placeholder="City" value="{{$data->dukuh}}">
                                    @if ($errors->has('dukuh'))
                                    <span class="text-danger">{{ $errors->first('dukuh') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-country">RT</label>
                                    <input type="number" name="RT" class="form-control form-control-alternative"
                                        placeholder="Country" value="{{$data->RT}}">
                                    @if ($errors->has('RT'))
                                    <span class="text-danger">{{ $errors->first('RT') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-country">RW</label>
                                    <input type="number" name="RW" class="form-control form-control-alternative"
                                        placeholder="Postal code" value="{{$data->RW}}">
                                    @if ($errors->has('RW'))
                                    <span class="text-danger">{{ $errors->first('RW') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="pl-lg-4">
                        <div class="form-group">
                            <label>Detail Alamat</label>
                            <textarea rows="4" name="detail_alamat" class="form-control form-control-alternative"
                                placeholder="A few words about you ...">{{$data->detail_alamat}}</textarea>
                            @if ($errors->has('detail_alamat'))
                            <span class="text-danger">{{ $errors->first('detail_alamat') }}</span>
                            @endif
                        </div>
                        <button class=" btn btn-success" type="submit">Ubah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
