@extends('backend.layout.master')
@section('title')
Daftar Warga
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
                    <a href="{{route('warga.create')}}" class="btn btn-success">Tambah</a>
                    <a href="" class="btn btn-success">Tambah dari Excel</a>
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <!-- Projects table -->
            <table class="table align-items-center table-flush" id="tabel">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">NIK</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Kategori</th>
                        <th scope="col">No Telp</th>
                        <th scope="col">Detail Alamat</th>
                        <th scope="col">Lokasi</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($warga as $w)
                    <tr>
                        <th scope="row">
                            {{$loop->iteration}}
                        </th>
                        <td>
                            {{$w->NIK}}
                        </td>
                        <td>
                            {{$w->user->nama}}
                        </td>
                        <td>
                            {{$w->kategori->jenis_sampah}}
                        </td>
                        <td>
                            {{$w->no_telp}}
                        </td>
                        <td>
                            {{$w->detail_alamat}},
                            {{$w->dukuh}},
                            {{$w->desa->desa}},
                            {{$w->kecamatan->kecamatan}},
                            {{$w->kota->kota}}
                        </td>
                        <td>
                            {{$w->lokasi}}
                        </td>
                        <td>
                            <form action="{{ route('warga.destroy', $w->id) }}" method="POST">
                                <a href="{{ route('warga.edit', $w->id) }}"
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

@push('script')
<script>
    $(document).ready(function () {
        var table = $('#tabel').DataTable({
            responsive: true
        });
        new $.fn.dataTable.FixedHeader(table);
    });
</script>
@endpush