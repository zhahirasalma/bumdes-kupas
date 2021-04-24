@extends('backend.layout.master')
@section('title')
Kategori Sampah
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
                        <a href="{{route('kategori_sampah.create')}}" class="btn btn-success">Tambah</a>
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
                            <th scope="col">Harga Retribusi</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($kategori as $kategori)
                        <tr>
                            <th scope="row">
                                {{$loop->iteration}}
                            </th>
                            <td>
                                {{$kategori->jenis_sampah != null ? $kategori->jenis_sampah : ''}}
                            </td>
                            <td>
                                @if ($kategori->harga_retribusi != null) @currency($kategori->harga_retribusi)
                                @else
                                @endif
                            </td>
                            <td>
                                <form action="{{ route('kategori_sampah.destroy', $kategori->id) }}" method="POST">
                                    <a href="{{ route('kategori_sampah.edit', $kategori->id) }}"
                                        class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top"
                                        data-original-title="Edit"><i class="far fa-edit"></i></a>
                                    <a class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top"
                                        data-original-title="Delete" onClick="deleteConfirm({{$kategori->id}})">
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
        <form method="post" id="form-import" action="{{url('/admin/import-kategori')}}" enctype="multipart/form-data"
            class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Import Data Kategori</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{method_field('PUT')}}
                {{csrf_field()}}
                <div class="row">
                    <div class="col-md-12">
                        <p>Import data kategori sampah sesuai format contoh berikut.<br /><a
                                href="{{url('')}}/excel-kategori.xlsx"><i class="fas fa-download"></i> File Contoh Excel
                                Kategori</a></p>
                    </div>
                    <div class="col-md-12">
                        <label>File Excel Kategori</label><br>
                        <input type="file" name="excel-kategori" required>
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
@endsection

@push('script')
<script>
    $(document).ready(function () {
        var table = $('#tabel').DataTable({

        });
    });

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
                    url: "kategori_sampah/" + id,
                    method: "post",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "_method": "DELETE",
                        id: id
                    },
                    success: function (data) {
                        Swal.fire({
                            title: 'Berhasil!',
                            text: 'Data berhasil di hapus!',
                            icon: 'success',
                        });
                        window.location.href = "/admin/kategori_sampah"
                    },
                    error: function () {
                        Swal.fire({
                            title: 'Gagal!',
                            text: 'Data tidak dapat di hapus!',
                            icon: 'warning',
                        });
                        window.location.href = "/admin/kategori_sampah"
                    }
                });
            }
        })
    }

</script>
@endpush
