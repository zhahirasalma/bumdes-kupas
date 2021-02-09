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
                    <a href="{{route('transaksi.create')}}" class="btn btn-success">Tambah</a>
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
                        <th scope="col">Berat Sampah (kg)</th>
                        <th scope="col">Harga Total</th>
                        <th scope="col">Keterangan</th>
                        <th scope="col">Unduh Transaksi</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($transaksi as $tr)
                    <tr>
                        <th scope="row">
                            {{$loop->iteration}}
                        </th>
                        <td>
                            {{$tr->user->nama}}
                        </td>
                        <td>
                            {{$tr->tanggal_transaksi}}
                        </td>
                        <td>
                            {{$tr->konversi->jenis_sampah}}
                        </td>
                        <td>
                            {{$tr->berat}}
                        </td>
                        <td>
                            @currency($tr->harga_total)
                        </td>
                        <td>
                            {{$tr->keterangan}}
                        </td>
                        <td>
                            <button class="btn btn-outline-success btn-sm" type="button"> Unduh </button>
                        </td>
                        <td>
                            <form action="{{ route('transaksi.destroy', $tr->id) }}" method="POST">
                                <a href="{{ route('transaksi.edit', $tr->id) }}" class="btn btn-success btn-sm"
                                    data-toggle="tooltip" data-placement="top" data-original-title="Edit"><i
                                        class="far fa-edit"></i></a>
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top"
                                    data-original-title="Delete" type="submit"><i class="far fa-trash-alt"></i></button>
                        </td>
                        </form>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
