@extends('backend.layout.master')
@section('title')
Daftar Bank Sampah
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
                    <a href="{{URL::to('admin/bank_sampah/create')}}" class="btn btn-primary">Tambah</a>
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <!-- Projects table -->
            <table class="table align-items-center table-flush">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">No Telp</th>
                        <th scope="col">Email</th>
                        <th scope="col">Password</th>
                        <th scope="col">Kota</th>
                        <th scope="col">Kecamatan</th>
                        <th scope="col">Desa</th>
                        <th scope="col">Dusun</th>
                        <th scope="col">Alamat Detail</th>
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
                            Cek
                        </td>
                        <td>
                            Cek
                        </td>
                        <td>
                            <a href="{{URL::to('admin/bank_sampah/edit')}}" class="text-success" data-toggle="tooltip" data-placement="top"
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
