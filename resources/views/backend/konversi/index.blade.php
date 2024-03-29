@extends('backend.layout.master')
@section('title')
Konversi Harga Sampah
@endsection

<head>
    <link rel=”stylesheet” href="{{asset('swal/sweetalert.css')}}">
    <script src="{{asset('swal/sweetalert.js')}}"></script>
</head>

@section('content')
<div class="row">
    <div class="col">
        <div class="card shadow">
            <div class="card-header border-0">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="mb-0">@yield('title')</h3>
                    </div>
                    <div class="col text-right">
                        <a href="{{route('konversi.create')}}" class="btn btn-success">Tambah</a>
                        <button class="btn btn-success" data-toggle="modal" data-target="#modal-import">Import dari
                            Excel</button>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <!-- Projects table -->
                <table class="table align-items-center table-flush" id="tabel">
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
                                {{$konversi->jenis_sampah != null ? $konversi->jenis_sampah : ''}}
                            </td>
                            <td>
                                @if ($konversi->harga_konversi != null) @currency($konversi->harga_konversi)
                                @else
                                @endif
                            </td>
                            <td>
                                <form action="{{ route('konversi.destroy', $konversi->id) }}" method="POST">
                                    <a href="{{ route('konversi.edit', $konversi->id) }}" class="btn btn-success btn-sm"
                                        data-toggle="tooltip" data-placement="top" data-original-title="Edit"><i
                                            class="far fa-edit"></i></a>
                                    <a class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top"
                                        data-original-title="Delete" onClick="deleteConfirm({{$konversi->id}})">
                                        <i class="far fa-trash-alt" style="color: white;"></i></a>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-import">
    <div class="modal-dialog modal-lg">
        <form method="post" id="form-import" action="{{url('/admin/import-konversi')}}" enctype="multipart/form-data"
            class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Import Data Konversi</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{method_field('PUT')}}
                {{csrf_field()}}
                <div class="row">
                    <div class="col-md-12">
                        <p>Import data konversi sampah sesuai format contoh berikut.<br /><a
                                href="{{url('')}}/excel-konversi.xlsx"><i class="fas fa-download"></i> File Contoh Excel
                                Konversi</a></p>
                    </div>
                    <div class="col-md-12">
                        <label>File Excel Konversi</label><br>
                        <input type="file" name="excel-konversi" required></br>
                        <p>*Pastikan isi file sesuai format yang telah dicontohkan.</p>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>

<button style="display: none;" class="modal-success" data-toggle="modal" data-target="#success-modal"></button>
<button style="display: none;" class="btn-error" data-toggle="modal" data-target="#error-modal"></button>
<div class="modal fade" id="error-modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-body">
            @if (isset($errors) && $errors->any())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                {{ $error }}
                @endforeach
            </div>
            @endif

            @if (session()->has('failures'))
            <table class="table table-danger">
                <tr>
                    <th>Baris ke</th>
                    <th>Nama kolom</th>
                    <th>Error</th>
                    <th>Nilai</th>
                </tr>

                @foreach (session()->get('failures') as $validation)
                <tr>
                    <td>{{ $validation->row() }}</td>
                    <td>{{ $validation->attribute() }}</td>
                    <td>
                        <ul>
                            @foreach ($validation->errors() as $e)
                            <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    </td>
                    <td>
                        {{ $validation->values()[$validation->attribute()] }}
                    </td>
                </tr>
                @endforeach
            </table>
            @endif
        </div>
    </div>
</div>
<div class="modal fade" id="success-modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-body">
            @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
            @endif
        </div>
    </div>
</div>
@endsection

@push('script')
<script>
    $(document).ready(function () {
        var table = $('#tabel').DataTable({

        });
    });

    @if(session()->has('failures'))
        $('.btn-error').click();
    @endif

    @if (session('status'))
        $('.modal-success').click();
    @endif

    function deleteConfirm(id) {
        Swal.fire({
            title: 'Harap Konfirmasi',
            text: "Anda tidak dapat mengembalikan data yang telah dihapus!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Lanjutkan'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name=csrf-token]').attr('content')
                    },
                    url: "konversi/" + id,
                    method: "post",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "_method": "DELETE",
                        id: id
                    },
                    success: function (data) {
                        window.location.href = "/admin/konversi"
                    },
                    error: function () {
                        Swal.fire({
                            title: 'Gagal!',
                            text: 'Data tidak dapat di hapus!',
                            icon: 'warning',
                        }).then((result) => {
                            if (result.value) {
                                window.location.href = "/admin/konversi"
                            }
                        });
                    }
                });
            }
        })
    }

</script>
@endpush
