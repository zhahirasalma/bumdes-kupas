@extends('backend.layout.master')
@section('title')
Daftar Transaksi Bank Sampah
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
                    <a href="{{URL::to('admin/transaksi/create')}}" class="btn btn-success">Tambah</a>
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <!-- Projects table -->
            <table class="table align-items-center table-flush">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama Bank Sampah</th>
                        <th scope="col">Tanggal Transaksi</th>
                        <th scope="col">Jenis Sampah</th>
                        <th scope="col">Berat Sampah</th>
                        <th scope="col">Harga Total</th>
                        <th scope="col">Keterangan</th>
                        <th scope="col">Unduh Transaksi</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">
                            1
                        </th>
                        <td>
                            Bank sampah panggung harjo
                        </td>
                        <td>
                            12 Desember 2020
                        </td>
                        <td>
                            Sampah an-organik
                        </td>
                        <td>
                            20 kg
                        </td>
                        <td>
                            Rp. 120.000
                        </td>
                        <td>
                            null
                        </td>
                        <td>
                            <button class="btn btn-outline-success btn-sm" type="button"> Unduh </button>
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
