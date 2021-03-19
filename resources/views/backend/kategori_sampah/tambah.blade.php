@extends('backend.layout.master')
@section('title')
Tambah Kategori Sampah
@endsection


@section('content')
<div class="row">
    <div class="col">
        <div class="card bg-secondary shadow">
            <div class="card-header bg-white border-0">
                <div class="row align-items-center">
                    <div class="col-8">
                        <h3 class="mb-0">Form Tambah</h3>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form action="{{route('kategori_sampah.store')}}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label">Jenis Sampah</label>
                                <input type="text" name="jenis_sampah" class="form-control form-control-alternative"
                                    placeholder="Jenis Sampah" value="{{old('jenis_sampah')}}">
                                @if ($errors->has('jenis_sampah'))
                                <span class="text-danger">{{ $errors->first('jenis_sampah') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label">Harga Retribusi</label>
                                <input type="text" name="harga_retribusi" class="form-control form-control-alternative"
                                    placeholder="Harga Retribusi" value="{{old('harga_retribusi')}}">
                                @if ($errors->has('harga_retribusi'))
                                <span class="text-danger">{{ $errors->first('harga_retribusi') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <button class="btn btn-success" type="submit">Tambah</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
