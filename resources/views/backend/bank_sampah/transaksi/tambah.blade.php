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
                <form>
                    <div class="pl-lg-4">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-nama">Nama Bank Sampah</label>
                                    <input type="text" id="nama" class="form-control form-control-alternative"
                                        placeholder="NIK" value="">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-nama">Tanggal Transaksi</label>
                                    <input type="text" id="nama" class="form-control form-control-alternative"
                                        placeholder="Nama" value="">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-first-name">Jenis Sampah</label>
                                    <input type="text" id="input-first-name"
                                        class="form-control form-control-alternative" placeholder="No Telepon" value="">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-nama">Keterangan</label>
                                    <input type="text" id="nama" class="form-control form-control-alternative"
                                        placeholder="Nama" value="">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-first-name">Unduh Transaksi</label>
                                    <input type="text" id="input-first-name"
                                        class="form-control form-control-alternative" placeholder="No Telepon" value="">
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-primary" type="button">Tambah</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection
