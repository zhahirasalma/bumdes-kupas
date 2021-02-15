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
                                    <label class="form-control-label" for="input-nama">Nama</label>
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
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-city">Kota</label>
                                    <select name="id_kota" class="form-control" value="{{$data->kota->kota}}">
                                        <option value="">Pilih kota...</option>
                                        @foreach($kota as $kt)
                                        <option value="{{$kt->id}}" {{ $kt->id == $data->id_kota ? 'selected' : '' }}>
                                            {{$kt->kota}}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('id_kota'))
                                    <span class="text-danger">{{ $errors->first('id_kota') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-country">Kecamatan</label>
                                    <select name="id_kecamatan" class="form-control"
                                        value="{{$data->kecamatan->kecamatan}}">
                                        <option value="">Pilih kecamatan...</option>
                                        @foreach($kecamatan as $kc)
                                        <option value="{{$kc->id}}" {{ $kc->id == $data->id_kecamatan ? 'selected' : '' }}>
                                            {{$kc->kecamatan}}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('id_kecamatan'))
                                    <span class="text-danger">{{ $errors->first('id_kecamatan') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-city">Desa</label>
                                    <select name="id_desa" class="form-control" value="{{$data->desa->desa}}">
                                        <option value="">Pilih desa...</option>
                                        @foreach($desa as $d)
                                        <option value="{{$d->id}}" {{ $d->id == $data->id_desa ? 'selected' : '' }}>
                                            {{$d->desa}}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('id_desa'))
                                    <span class="text-danger">{{ $errors->first('id_desa') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-country">Dukuh</label>
                                    <input type="text" name="dukuh" class="form-control form-control-alternative"
                                        placeholder="Kecamatan" value="{{$data->dukuh}}">
                                    @if ($errors->has('dukuh'))
                                    <span class="text-danger">{{ $errors->first('dukuh') }}</span>
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
