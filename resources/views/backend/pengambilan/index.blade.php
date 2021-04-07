@extends('backend.layout.master')
@section('title')
Daftar Pengambilan Sampah
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
                        <button onClick="reset()" type="button" id="button-reset" class="btn btn-danger">Reset
                            data</button>
                        <a href="{{route('pengambilan.create')}}" class="btn btn-success">Tambah</a>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <!-- Projects table -->
                <table class="table align-items-center table-flush" id="tabel">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama Warga</th>
                            <th scope="col">Alamat</th>
                            <th scope="col">Tanggal Pengambilan</th>
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
                                <a target="_blank"
                                    href="https://maps.google.com/?q={{$p->warga->latitude}},{{$p->warga->longitude}}">Klik
                                    alamat</a>
                            </td>
                            <td>
                                {{$p->waktu_pengambilan}}
                            </td>
                            <td>
                                <style>
                                    .toggle.ios,
                                    .toggle-on.ios,
                                    .toggle-off.ios {
                                        border-radius: 20px;
                                    }

                                    .toggle.ios .toggle-handle {
                                        border-radius: 20px;
                                    }

                                </style>
                                <input data-style="ios" data-size="sm" data-id="{{$p->id}}" class="toggle-class"
                                    type="checkbox" data-toggle="toggle" data-onstyle="outline-danger"
                                    data-offstyle="outline-success" data-off="Terambil" data-on="Belum diambil"
                                    {{$p->status ? 'checked' : ''}}>

                            </td>
                            <td>
                                <button class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top"
                                    data-original-title="Delete" onClick="deleteConfirm({{$p->id}})">
                                    <i class="far fa-trash-alt" style="color: white;"></i></button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
@push('script')
<script>
    var table = $('#tabel').DataTable({

    });

    $(function () {
        $('.toggle-class').change(function () {
            var status = $(this).prop('checked') == true ? 1 : 0;
            var id = $(this).data('id');
            $.ajax({
                type: "GET",
                dataType: "json",
                url: '{{route('ubahstatus')}}',
                data: {
                    'status': status,
                    'id': id
                },
                success: function (data) {
                    Swal.fire({
                        title: 'Berhasil!',
                        text: 'Status berhasil diubah!',
                        icon: 'success',
                        confirmButtonColor: "#3085d6",
                        confirmButtonText: "OK",
                    })
                },
                error: function (error) {
                    Swal.fire({
                        title: 'Gagal!',
                        text: 'Tidak dapat mengubah status',
                        icon: 'warning',
                    });
                }
            });
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
                    url: "pengambilan/" + id,
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
                        window.location.href = "/admin/pengambilan"
                    },
                    error: function () {
                        Swal.fire({
                            title: 'Gagal!',
                            text: 'Data tidak dapat di hapus!',
                            icon: 'danger',
                        });
                        window.location.href = "/admin/pengambilan"
                    }
                });
            }
        })
    }

    function reset() {
        Swal.fire({
            title: 'Harap Konfirmasi',
            text: "Anda tidak dapat mengembalikan data yang telah di reset!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Lanjutkan'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: "{{route('reset')}}",
                    success: function () {
                        Swal.fire({
                            title: 'Berhasil!',
                            text: 'Data berhasil di reset!',
                            icon: 'success',
                        });
                        window.location.href = "/admin/pengambilan"
                    },
                    error: function () {
                        Swal.fire({
                            title: 'Gagal!',
                            text: 'Data tidak dapat di reset!',
                            icon: 'warning',
                        });
                        window.location.href = "/admin/pengambilan"
                    }
                });
            }
        })
    }

</script>
@endpush
