@extends('backend.layout.master')
@section('title')
Daftar Transaksi Retribusi
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
                    <a href="{{URL::to('admin/retribusi/create')}}" class="btn btn-primary">Tambah</a>
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <!-- Projects table -->
            <table class="table align-items-center table-flush">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama Kolektor</th>
                        <th scope="col">Jumlah Tagihan</th>
                        <th scope="col">Bulan Tagihan</th>
                        <th scope="col">Alamat</th>
                        <th scope="col">Tanggal Transaksi</th>
                        <th scope="col">Keterangan</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">
                            1
                        </th>
                        <td>
                            Cek
                        </td>
                        <td>
                            Cek
                        </td>
                        <td>
                            Cek
                        </td>
                        <td>
                            Cek
                        </td>
                        <td>
                            Cek
                        </td>
                        <td>
                            Cek
                        </td>
                        <td>
                            <a class="text-success" data-toggle="tooltip" data-placement="top"
                                data-original-title="Edit"><i class="far fa-edit"></i></a>
                            <a class="text-danger" data-toggle="tooltip" data-placement="top"
                                data-original-title="Delete"><i class="far fa-trash-alt"></i></a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
