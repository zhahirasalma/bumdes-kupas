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
                    <a href="{{route('bank_sampah.create')}}" class="btn btn-success">Tambah</a>
                    <a href="" class="btn btn-success">Import dari Excel</a>
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <!-- Projects table -->
            <table class="table align-items-center table-flush" id="tabel">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama</th>
                        <th scope="col">No Telp</th>
                        <th scope="col">Alamat Detail</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $data)
                    <tr>
                        <th scope="row">
                            {{$loop->iteration}}
                        </th>
                        <td>
                            {{$data->user->nama}}
                        </td>
                        <td>
                            {{$data->no_telp}}
                        </td>
                        <td>
                            {{$data->detail_alamat}},
                            {{$data->dukuh}},
                            {{$data->desa->desa}},
                            {{$data->kecamatan->kecamatan}},
                            {{$data->kota->kota}}
                        </td>
                        <td>
                            <form action="{{ route('bank_sampah.destroy', $data->id) }}" method="POST">
                                <a href="{{ route('bank_sampah.edit', $data->id) }}" class="btn btn-success btn-sm"
                                    data-toggle="tooltip" data-placement="top" data-original-title="Edit"><i
                                        class="far fa-edit"></i></a>
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top"
                                    data-original-title="Delete" type="submit"><i class="far fa-trash-alt"></i></button>
                        </td>
                        </form>
                    </tr>
                </tbody>
                @endforeach
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
