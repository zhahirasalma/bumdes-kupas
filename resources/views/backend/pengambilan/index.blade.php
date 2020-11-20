@extends('backend.layout.master')
@section('title')
Daftar Pengambilan Sampah
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
                    <a href="#!" class="btn btn-sm btn-primary">See all</a>
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <!-- Projects table -->
            <table class="table align-items-center table-flush">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama Warga</th>
                        <th scope="col">Nama Educator</th>
                        <th scope="col">Waktu Pengambilan</th>
                        <th scope="col">Status</th>
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
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
