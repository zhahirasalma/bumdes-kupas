@extends('backend.layout.master')
@section('title')
Edit Data Transaksi Retribusi
@endsection

@section('content')
<div class="col-xl-12">
    <div class="card bg-secondary shadow">
        <div class="card-header bg-white border-0">
            <div class="col-8">
                <h3 class="mb-0">Form Edit</h3>
            </div>
        </div>
        <div class="row align-items-center">
            <div class="card-body">
                <form action="{{route('retribusi.update', $retribusi->id)}}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="pl-lg-4">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-nama">Nama Warga</label>
                                    <select name="id_users" class="form-control">
                                        <option value="">Pilih nama warga...</option>
                                        @foreach($user as $u)
                                        <option value="{{$u->id}}"
                                            {{ $u->id == $retribusi->id_users ? 'selected' : '' }}>
                                            {{$u->nama}}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('id_users'))
                                    <span class="text-danger">{{ $errors->first('id_users') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-nama">Nama Kolektor</label>
                                    <input type="text" name="nama_kolektor"
                                        class="form-control form-control-alternative" placeholder="Nama Kolektor"
                                        value="{{$retribusi->nama_kolektor}}">
                                    @if ($errors->has('nama_kolektor'))
                                    <span class="text-danger">{{ $errors->first('nama_kolektor') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-nama">Jumlah Tagihan</label>
                                    <input type="text" name="jumlah_tagihan"
                                        class="form-control form-control-alternative" placeholder="Jumlah Tagihan"
                                        value="{{$retribusi->jumlah_tagihan}}">
                                    @if ($errors->has('jumlah_tagihan'))
                                    <span class="text-danger">{{ $errors->first('jumlah_tagihan') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-first-name">Bulan Tagihan</label>
                                    <input type="text" name="bulan_tagihan"
                                        class="form-control form-control-alternative" placeholder="Bulan Tagihan"
                                        value="{{$retribusi->bulan_tagihan}}">
                                    @if ($errors->has('bulan_tagihan'))
                                    <span class="text-danger">{{ $errors->first('bulan_tagihan') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-first-name">Tanggal Transaksi</label>
                                    <input type="date" name="tanggal_transaksi"
                                        class="form-control form-control-alternative" placeholder="Tanggal Transaksi"
                                        value="{{$retribusi->tanggal_transaksi}}">
                                    @if ($errors->has('tanggal_transaksi'))
                                    <span class="text-danger">{{ $errors->first('tanggal_transaksi') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-first-name">Keterangan</label>
                                    <select name="keterangan" class="form-control form-control-alternative"
                                        placeholder="Keterangan pembayaran">
                                        <option value="">Pilih...</option>
                                        <option value="sudah_bayar"
                                            {{ $retribusi->keterangan == 'sudah_bayar' ? 'selected' : '' }}>
                                            sudah bayar</option>
                                        <option value="belum_bayar"
                                            {{ $retribusi->keterangan == 'belum_bayar' ? 'selected' : '' }}>belum bayar
                                        </option>
                                    </select>
                                    @if ($errors->has('keterangan'))
                                    <span class="text-danger">{{ $errors->first('keterangan') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="pl-lg-4">
                        <div class="form-group">
                            <label>Alamat</label>
                            <textarea name="alamat" rows="4" class="form-control form-control-alternative"
                                placeholder="Alamat">{{$retribusi->alamat}}</textarea>
                            @if ($errors->has('alamat'))
                            <span class="text-danger">{{ $errors->first('alamat') }}</span>
                            @endif
                        </div>
                        <button class="btn btn-success" type="submit">Ubah</button>
                    </div>
            </div>
            </form>
        </div>
    </div>
</div>
</div>
@endsection
