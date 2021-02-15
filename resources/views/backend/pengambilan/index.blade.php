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
                    <a href="{{route('pengambilan.create')}}" class="btn btn-success">Tambah</a>
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
                        <th scope="col">Alamat</th>
                        <th scope="col">Waktu Pengambilan</th>
                        <th scope="col">Status</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pengambilan as $p)
                    <tr>
                        <th scope="row">
                            {{$loop->iteration}}
                        </th>
                        <td>
                            {{$p->user->nama}}
                        </td>
                        <td>
                            {{$p->warga->lokasi}}
                        </td>
                        <td>
                            {{$p->waktu_pengambilan}}
                        </td>
                        <td>
                            <label class="custom-toggle">
                                <input type="checkbox" checked>
                                <span class="custom-toggle-slider rounded-circle" data-label-off="Belum"
                                    data-label-on="Sudah"></span>
                            </label>
                        </td>
                        <td>
                            <form action="{{ route('pengambilan.destroy', $p->id) }}" method="POST">
                                <a href="{{ route('pengambilan.edit', $p->id) }}" class="btn btn-success btn-sm"
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
