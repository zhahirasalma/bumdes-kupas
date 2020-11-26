@extends('backend.layout.master')
@section('title')
Tambah Data Warga
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
                                    <label class="form-control-label" for="input-nama">NIK</label>
                                    <input type="text" id="nama" class="form-control form-control-alternative"
                                        placeholder="NIK" value="">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-nama">Nama</label>
                                    <input type="text" id="nama" class="form-control form-control-alternative"
                                        placeholder="Nama" value="">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-first-name">No Telepon</label>
                                    <input type="text" id="input-first-name"
                                        class="form-control form-control-alternative" placeholder="No Telepon" value="">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-nama">Nama Contact Person</label>
                                    <input type="text" id="nama" class="form-control form-control-alternative"
                                        placeholder="Nama" value="">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-first-name">No Telepon Contact
                                        Person</label>
                                    <input type="text" id="input-first-name"
                                        class="form-control form-control-alternative" placeholder="No Telepon" value="">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-nama">Email</label>
                                    <input type="text" id="nama" class="form-control form-control-alternative"
                                        placeholder="Nama" value="">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-first-name">Password</label>
                                    <input type="text" id="input-first-name"
                                        class="form-control form-control-alternative" placeholder="No Telepon" value="">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-city">Kota</label>
                                    <input type="text" id="input-city" class="form-control form-control-alternative"
                                        placeholder="City" value="New York">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-country">Kecamatan</label>
                                    <input type="text" id="input-country" class="form-control form-control-alternative"
                                        placeholder="Country" value="United States">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="pl-lg-4">
                        <div class="form-group">
                            <label>Detail Alamat</label>
                            <textarea rows="4" class="form-control form-control-alternative"
                                placeholder="A few words about you ..."></textarea>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-nama">Lokasi</label>
                                    <input type="text" id="nama" class="form-control form-control-alternative"
                                        placeholder="NIK" value="">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-nama">Keterangan</label>
                                    <input type="text" id="nama" class="form-control form-control-alternative"
                                        placeholder="NIK" value="">
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
