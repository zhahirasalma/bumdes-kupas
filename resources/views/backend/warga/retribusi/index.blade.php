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
                    <a href="{{route('retribusi.create')}}" class="btn btn-success">Tambah</a>
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
                @foreach($retribusi as $r)
                    <tr>
                        <th scope="row">
                            {{$loop->iteration}}
                        </th>
                        <td>
                            {{$r->user->nama}}
                        </td>
                        <td>
                            {{$r->nama_kolektor}}
                        </td>
                        <td>
                            @currency($r->jumlah_tagihan)
                        </td>
                        <td>
                            {{$r->bulan_tagihan}}
                        </td>
                        <td>
                            {{$r->alamat}}
                        </td>
                        <td>
                            {{$r->tanggal_transaksi}}
                        </td>
                        <td>
                            {{$r->keterangan}}
                        </td>
                        <td>
                            <form action="{{ route('retribusi.destroy', $r->id) }}" method="POST">
                                <a href="{{ route('retribusi.edit', $r->id) }}"
                                    class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top"
                                    data-original-title="Edit"><i class="far fa-edit"></i></a>
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
