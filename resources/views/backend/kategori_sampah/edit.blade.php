@extends('backend.layout.master')
@section('title')
Edit Kategori Sampah
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
                <form action="{{route('kategori_sampah.update', $kategori->id)}}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="pl-lg-4">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-nama">Jenis Sampah</label>
                                    <input type="text" name="jenis_sampah" class="form-control form-control-alternative"
                                        placeholder="Jenis Sampah" value="{{$kategori->jenis_sampah}}">
                                    @if ($errors->has('jenis_sampah'))
                                    <span class="text-danger">{{ $errors->first('jenis_sampah') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-first-name">Harga Retribusi</label>
                                    <input type="text" name="harga_retribusi"
                                        class="form-control form-control-alternative" placeholder="Harga Retribusi"
                                        value="{{$kategori->harga_retribusi}}">
                                    @if ($errors->has('harga_retribusi'))
                                    <span class="text-danger">{{ $errors->first('harga_retribusi') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <button class=" btn btn-success" type="submit">Ubah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
