@extends('backend.layout.master')
@section('title')
Edit Konversi Sampah
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
                <form action="{{route('konversi.update', $konversi->id)}}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="pl-lg-4">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label">Jenis Sampah</label>
                                    <input type="text" name="jenis_sampah" class="form-control form-control-alternative"
                                        placeholder="Jenis Sampah" value="{{$konversi->jenis_sampah}}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label">Harga Sampah</label>
                                    <input type="text" name="harga_konversi"
                                        class="form-control form-control-alternative" placeholder="Harga Sampah"
                                        value="{{$konversi->harga_konversi}}">
                                </div>
                            </div>
                        </div>
                        <button class=" btn btn-primary" type="submit">Ubah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
