@extends('backend.layout.master')
@section('title')
Detail Transaksi Bank Sampah
@endsection


@section('content')
<div class="row">
    <div class="col">
        <div class="card shadow">
            <div class="card-header border-0">
                <div class="row align-items-center">
                    <div class="col"><span>
                            <h3 class="mb-0">Detail Transaksi Bank Sampah @if (!empty($detail[0]->user->nama))
                                {{$detail[0]->user->nama}}
                                @else
                                ' '
                                @endif </h3>
                        </span>
                    </div>
                    <div class="col text-right">
                        <a href="{{ route('export-transaksi', $detail[0]->id_bank_sampah) }}" class="btn btn-success">Unduh Data</a>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <!-- Projects table -->
                <table class="table align-items-center table-flush" id="tabel">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Tanggal Transaksi</th>
                            <th scope="col">Jenis Sampah</th>
                            <th scope="col">Harga Konversi (per kg)</th>
                            <th scope="col">Berat (kg)</th>
                            <th scope="col">Harga Total</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($detail as $d)
                        <tr>
                            <th scope="row">
                                {{$loop->iteration}}
                            </th>
                            <td>
                                {{$d->tanggal_transaksi}}
                            </td>
                            <td>
                                {{$d->konversi->jenis_sampah}}
                            </td>
                            <td>
                                {{$d->konversi->harga_konversi}}

                            </td>
                            <td>
                                {{$d->berat}}
                            </td>
                            <td>
                                @currency($d->harga_total)

                            </td>
                            <td>
                                <form action="{{ route('delete-transaksi', $d->id) }}" method="POST">
                                    <a href="{{ route('transaksi.edit', $d->id) }}" class="btn btn-success btn-sm"
                                        data-toggle="tooltip" data-placement="top" data-original-title="Edit"><i
                                            class="far fa-edit"></i></a>
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top"
                                        data-original-title="Delete" type="submit"><i
                                            class="far fa-trash-alt"></i></button>
                            </td>
                            </form>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
