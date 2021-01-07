@extends('backend.layout.master')
@section('title')
Tambah Data Transaksi Retribusi
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
                <form>
                    <div class="pl-lg-4">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-nama">Nama Kolektor</label>
                                    <input type="text" id="nama" class="form-control form-control-alternative"
                                        placeholder="Nama Kolektor" value="">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-nama">Jumlah Tagihan</label>
                                    <input type="text" id="nama" class="form-control form-control-alternative"
                                        placeholder="Jumlah Tagihan" value="">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-first-name">Bulan Tagihan</label>
                                    <input type="text" id="input-first-name"
                                        class="form-control form-control-alternative" placeholder="Bulan Tagihan" value="">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-first-name">Tanggal Transaksi</label>
                                    <input type="text" id="input-first-name"
                                        class="form-control form-control-alternative" placeholder="Tanggal Transaksi" value="">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-first-name">Keterangan</label>
                                    <input type="text" id="input-first-name"
                                        class="form-control form-control-alternative" placeholder="Keterangan" value="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="pl-lg-4">
                        <div class="form-group">
                            <label>Alamat</label>
                            <textarea rows="4" class="form-control form-control-alternative"
                                placeholder="Alamat"></textarea>
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
