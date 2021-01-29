@extends('backend.layout.master')
@section('title')
Tambah Data Transaksi Bank Sampah
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
                <form action="{{route('transaksi.store')}}" method="POST">
                    @csrf
                    <div class="pl-lg-4">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-nama">Bank Sampah</label>
                                    <select name="id_users" class="form-control">
                                        <option value="">Pilih nama bank sampah...</option>
                                        @foreach($user as $u)
                                        <option value="{{$u->id}}" @if (old('id_users')==$u->id ) selected="selected"
                                            @endif>
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
                                    <label class="form-control-label" for="input-nama">Tanggal Transaksi</label>
                                    <input type="date" name="tanggal_transaksi"
                                        class="form-control form-control-alternative" placeholder="Tanggal Transaksi"
                                        value="{{old('tanggal_transaksi')}}">
                                    @if ($errors->has('tanggal_transaksi'))
                                    <span class="text-danger">{{ $errors->first('tanggal_transaksi') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-nama">Keterangan</label>
                                    <input type="text" name="keterangan" class="form-control form-control-alternative"
                                        placeholder="Keterangan" value="{{old('keterangan')}}">
                                    @if ($errors->has('keterangan'))
                                    <span class="text-danger">{{ $errors->first('keterangan') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-first-name">Jenis Sampah</label>
                                    <select name="id_konversi" class="form-control">
                                        <option value="">Pilih jenis sampah...</option>
                                        @foreach($konversi as $k)
                                        <option value="{{$k->id}}" @if (old('id_konversi')==$k->id ) selected="selected"
                                            @endif>
                                            {{$k->jenis_sampah}}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('id_konversi'))
                                    <span class="text-danger">{{ $errors->first('id_konversi') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-first-name">Berat</label>
                                    <input type="number" name="berat" class="form-control form-control-alternative"
                                        placeholder="Berat Sampah" value="{{old('berat')}}">
                                    @if ($errors->has('berat'))
                                    <span class="text-danger">{{ $errors->first('berat') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-first-name">Harga Total</label>
                                    <input type="text" name="harga_total" class="form-control form-control-alternative"
                                        placeholder="Harga total" value="">
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-success" type="submit">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
