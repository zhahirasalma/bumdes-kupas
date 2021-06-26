@extends('backend.layout.master')
@section('title')
Daftar Transaksi Retribusi
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
                        <a href="{{route('retribusi.create')}}" class="btn btn-success">Tambah</a>
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
                            <th scope="col">Nama Kolektor</th>
                            <th scope="col">Jumlah Tagihan</th>
                            <th scope="col">Bulan Tagihan</th>
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
                                {{ $r->user->nama != 'null' ? $r->user->nama : ''  }} - {{ $r->warga->NIK}}
                            </td>
                            <td>
                                {{ $r->nama_kolektor != 'null' ? $r->nama_kolektor : ''  }}
                            </td>
                            <td>
                                @if ($r->jumlah_tagihan != 'null') @currency($r->jumlah_tagihan)
                                @else 
                                @endif
                            </td>
                            <td>
                                {{ $r->bulan_tagihan != 'null' ? $r->bulan_tagihan : ''  }}
                            </td>
                            <td>
                                {{ $r->tanggal_transaksi != 'null' ? $r->tanggal_transaksi : ''  }}
                            </td>
                            <td>
                                {{ $r->keterangan != 'null' ? $r->keterangan : ''  }}
                            </td>
                            <td>
                                <form action="{{ route('retribusi.destroy', $r->id) }}" method="POST">
                                    <a href="{{ route('retribusi.edit', $r->id) }}" class="btn btn-success btn-sm"
                                        data-toggle="tooltip" data-placement="top" data-original-title="Edit"><i
                                            class="far fa-edit"></i></a>
                                    <a class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top"
                                        data-original-title="Delete" onClick="deleteConfirm({{$r->id}})">
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
                    url: "retribusi/" + id,
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
                        window.location.href = "/admin/retribusi"
                    },
                    error: function () {
                        Swal.fire({
                            title: 'Gagal!',
                            text: 'Data tidak dapat di hapus!',
                            icon: 'warning',
                        });
                        window.location.href = "/admin/retribusi"
                    }
                });
            }
        })
    }

</script>
@endpush
