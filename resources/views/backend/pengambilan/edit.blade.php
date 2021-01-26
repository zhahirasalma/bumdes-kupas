@extends('backend.layout.master')
@section('title')
Edit Pengambilan
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
                <form action="{{route('pengambilan.update', $pengambilan->id)}}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="pl-lg-4">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label">Nama Warga</label>
                                    <input type="text" name="id_users" class="form-control form-control-alternative"
                                        placeholder="Nama Warga" value="{{$pengambilan->id_users}}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label">Waktu Pengambilan</label>
                                    <input type="date" name="waktu_pengambilan"
                                        class="form-control form-control-alternative" placeholder="Waktu Pengambilan"
                                        value="{{$pengambilan->waktu_pengambilan}}">
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
