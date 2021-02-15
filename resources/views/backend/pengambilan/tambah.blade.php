@extends('backend.layout.master')
@section('title')
Tambah Pengambilan
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
                <form action="{{route('pengambilan.store')}}" method="POST">
                    @csrf
                    <div class="pl-lg-4">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label">Nama Warga</label>
                                    @foreach($warga as $w)
                                    <div class="row">
                                        <div class="col-lg-6" class="form-check">
                                            <label>
                                                <input type="checkbox" name="id_users[]" id="id_users"
                                                    value="{{$w->id}}">
                                                {{$w->nama}}
                                            </label>
                                        </div>
                                    </div>
                                    @endforeach
                                    @if ($errors->has('id_users'))
                                    <span class="text-danger">{{ $errors->first('id_users') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label">Waktu Pengambilan</label>
                                    <input type="date" name="waktu_pengambilan"
                                        class="form-control form-control-alternative" placeholder="Waktu Pengambilan"
                                        value="">
                                    @if ($errors->has('waktu_pengambilan'))
                                    <span class="text-danger">{{ $errors->first('waktu_pengambilan') }}</span>
                                    @endif
                                </div>
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
