@extends('backend.layout.master')
@section('title')
Konversi Harga Sampah
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
                    <a href="{{route('konversi.create')}}" class="btn btn-success">Tambah</a>
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
                        <th scope="col">Jenis Sampah</th>
                        <th scope="col">Harga Sampah</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($konversi as $konversi)
                    <tr>
                        <th scope="row">
                            {{$loop->iteration}}
                        </th>
                        <td>
                            {{$konversi->jenis_sampah}}
                        </td>
                        <td>
                            @currency($konversi->harga_konversi)
                        </td>
                        <td>
                            <form action="{{ route('konversi.destroy', $konversi->id) }}" method="POST">
                                <a href="{{ route('konversi.edit', $konversi->id) }}"
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
