@extends('backend.layout.master')
@section('title')
Tambah Kategori Sampah
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
                                    <label class="form-control-label" for="input-nama">Jenis Sampah</label>
                                    <input type="text" id="jenis_sampah" class="form-control form-control-alternative"
                                        placeholder="Jenis Sampah" value="">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-first-name">Harga Retribusi</label>
                                    <input type="text" id="harga_retribusi"
                                        class="form-control form-control-alternative" placeholder="Harga Retribusi" value="">
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
