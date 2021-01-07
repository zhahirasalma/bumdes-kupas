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
                    <a href="{{URL::to('admin/bank_sampah/create')}}" class="btn btn-success">Tambah</a>
                    <a href="" class="btn btn-success">Import dari Excel</a>
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
                        <th scope="col">Dukuh</th>
                        <th scope="col">Alamat Detail</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($bank_sampah as $value)
                    <tr>
                        <th scope="row">
                            1
                        </th>
                        <td>
                            {{$value->no_telp}}
                        </td>
                        <td>
                            banksampah@gmail.com
                        </td>
                        <td>
                            banksampah
                        </td>
                        <td>
                            {{$value->kota}}
                        </td>
                        <td>
                            {{$value->kecamatan}}
                        </td>
                        <td>
                            {{$value->desa}}
                        </td>
                        <td>
                            {{$value->dukuh}}
                        </td>
                        <td>
                            {{$value->detail_alamat}}
                        </td>
                        <td>
                            <a href="{{URL::to('admin/bank_sampah/edit')}}" class="text-success" data-toggle="tooltip" data-placement="top"
                                data-original-title="Edit"><i class="far fa-edit"></i></a>
                            <a class="text-danger" data-toggle="tooltip" data-placement="top"
                                data-original-title="Delete"><i class="far fa-trash-alt"></i></a>
                        </td>
                    </tr>
                </tbody>
                @endforeach
            </table>
        </div>
    </div>
</div>

@endsection
