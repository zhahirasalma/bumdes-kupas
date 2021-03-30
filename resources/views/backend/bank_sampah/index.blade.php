@extends('backend.layout.master')
@section('title')
Daftar Bank Sampah
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
                        <a href="{{route('bank_sampah.create')}}" class="btn btn-success">Tambah</a>
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
                            <th scope="col">Nama</th>
                            <th scope="col">No Telp</th>
                            <th scope="col">Email</th>
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
                                {{$data->user->email}}
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
                                    <a class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top"
                                        data-original-title="Delete" onClick="deleteConfirm({{$data->id}})">
                                        <i class="far fa-trash-alt" style="color: white;"></i></a>
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
</div>
<div class="modal fade" id="modal-import">
    <div class="modal-dialog modal-lg">
        <form method="post" id="form-import" action="{{url('/admin/import-bankSampah')}}" enctype="multipart/form-data"
            class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Import Data Bank Sampah</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{method_field('PUT')}}
                {{csrf_field()}}
                <div class="row">
                    <div class="col-md-12">
                        <p>Import data bank sampah sesuai format contoh berikut.<br /><a
                                href="{{url('')}}/excel-bankSampah.xlsx"><i class="fas fa-download"></i> File Contoh
                                Excel
                                Bank Sampah</a></p>
                    </div>
                    <div class="col-md-12">
                        <label>File Excel Bank Sampah</label><br>
                        <input type="file" name="excel-bankSampah" required>
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
                    url: "bank_sampah/" + id,
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
                        window.location.href = "/admin/users"
                    },
                    error: function () {
                        Swal.fire({
                            title: 'Gagal!',
                            text: 'Data tidak dapat di hapus!',
                            icon: 'warning',
                        });
                        window.location.href = "/admin/users"
                    }
                });
            }
        })
    }

</script>
@endpush
