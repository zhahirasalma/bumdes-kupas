@extends('backend.layout.master')
@section('title')
Edit Data Transaksi Bank Sampah
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
                <form action="{{route('transaksi.update', $transaksi->id)}}" method="POST">
                @csrf
                @method('PUT')
                    <div class="pl-lg-4">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-nama">Bank Sampah</label>
                                    <input type="text" name="id_users" class="form-control form-control-alternative"
                                        placeholder="Bank Sampah" value="{{$transaksi->id_users}}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-nama">Tanggal Transaksi</label>
                                    <input type="date" name="tanggal_transaksi"
                                        class="form-control form-control-alternative" placeholder="Tanggal Transaksi"
                                        value="{{$transaksi->tanggal_transaksi}}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-nama">Keterangan</label>
                                    <input type="text" name="keterangan" class="form-control form-control-alternative"
                                        placeholder="Keterangan" value="{{$transaksi->keterangan}}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-first-name">Jenis Sampah</label>
                                    <input type="text" name="id_konversi"
                                        class="form-control form-control-alternative" placeholder="Jenis Sampah"
                                        value="{{$transaksi->id_konversi}}">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-first-name">Berat</label>
                                    <input type="number" name="berat"
                                        class="form-control form-control-alternative" placeholder="Jenis Sampah"
                                        value="{{$transaksi->berat}}">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-first-name">Harga Total</label>
                                    <input type="text" name="harga_total"
                                        class="form-control form-control-alternative" placeholder="Jenis Sampah"
                                        value="{{$transaksi->harga_total}}">
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-success" type="submit">Ubah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
