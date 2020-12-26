@extends('backend.layout.master')
@section('title')
Kategori Sampah
@endsection


@section('content')

<div class="col-xl-12">
    <div class="card shadow">
        <div class="card-header border-0">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="mb-0">@yield('title')</h3>
                </div>
                <div class="col text-right">
                    <a href="{{URL::to('admin/kategori_sampah/create')}}" class="btn btn-primary">Tambah</a>
                    <a href="" class="btn btn-primary">Import dari Excel</a>
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <!-- Projects table -->
            <table class="table align-items-center table-flush">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Jenis Sampah</th>
                        <th scope="col">Harga Retribusi</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
