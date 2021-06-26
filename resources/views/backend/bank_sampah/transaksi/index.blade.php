@extends('backend.layout.master')
@section('title')
Daftar Transaksi Bank Sampah
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
                        <a href="{{route('transaksi.create')}}" class="btn btn-success">Tambah</a>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <!-- Projects table -->
                <table class="table align-items-center table-flush" id="tabel">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama Bank Sampah</th>
                            <th scope="col">Tanggal Transaksi</th>
                            <th scope="col">Harga Total</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($transaksi as $tr)
                        <tr>
                            <th scope="row">
                                {{$loop->iteration}}
                            </th>
                            <td>
                                {{$tr->user->nama != null ? $tr->user->nama : ''}} - {{$tr->bankSampah->dukuh}}
                            </td>
                            <td>
                                {{$tr->tanggal_transaksi != null ? $tr->tanggal_transaksi : ''}}
                            </td>
                            <td>
                                @if ($tr->jumlah != null)
                                @currency($tr->jumlah)
                                @else

                                @endif
                            </td>
                            <td>
                                <form action="{{ route('transaksi.destroy', $tr->id_bank_sampah) }}" method="POST">
                                    <a href="{{ route('detail-transaksi', $tr->id_bank_sampah) }}"
                                        class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top"
                                        data-original-title="Detail"><i class="fas fa-info-circle"></i></a>
                                    <a class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top"
                                        data-original-title="Delete" onClick="deleteConfirm({{$tr->id_bank_sampah}})">
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
                    url: "transaksi/" + id,
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
                        }).then((result) => {
                            if (result.value) {
                                window.location.href = "/admin/transaksi"
                            }
                        });
                    },
                    error: function () {
                        Swal.fire({
                            title: 'Gagal!',
                            text: 'Data tidak dapat di hapus!',
                            icon: 'warning',
                        }).then((result) => {
                            if (result.value) {
                                window.location.href = "/admin/transaksi"
                            }
                        })
                    }
                });
            }
        })
    }

    $(document).ready(function () {
        var table = $('#tabel').DataTable({

        });
    });

</script>
@endpush
