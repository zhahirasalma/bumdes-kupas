@extends('backend.layout.master')
@section('title')
Detail Transaksi Bank Sampah
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
                    <div class="col"><span>
                            <h3 class="mb-0">Detail Transaksi Bank Sampah @if (!empty($detail[0]->user->nama))
                                {{$detail[0]->user->nama}}
                                @else
                                ---
                                @endif </h3>
                        </span>
                    </div>
                    @if (!empty($detail[0]))
                    <div class="col text-right">
                        <a href="{{ route('export-transaksi', $detail[0]->id_bank_sampah) }}"
                            class="btn btn-success">Unduh Data</a>
                    </div>
                    <input type="hidden" id="id_bank" value="{{$detail[0]->id_bank_sampah}}">
                    @else
                    <div class="col text-right">
                        <a href="/admin/transaksi" class="btn btn-danger"><i class="fas fa-arrow-left"></i> Kembali</a>
                    </div>
                    <input type="hidden" id="id_bank" value="kosong">
                    @endif
                </div>
            </div>
            <div class="table-responsive">
                <!-- Projects table -->
                <table class="table align-items-center table-flush" id="tabel">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Tanggal Transaksi</th>
                            <th scope="col">Jenis Sampah</th>
                            <th scope="col">Harga Konversi (per kg)</th>
                            <th scope="col">Berat (kg)</th>
                            <th scope="col">Harga Total</th>
                            <th scope="col">Keterangan</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($detail as $d)
                        <tr>
                            <th scope="row">
                                {{$loop->iteration}}
                            </th>
                            <td>
                                {{$d->tanggal_transaksi != null ? $d->tanggal_transaksi : ''}}
                            </td>
                            <td>
                                {{$d->konversi->jenis_sampah != null ? $d->konversi->jenis_sampah : ''}}
                            </td>
                            <td>
                                @if ($d->konversi->harga_konversi != null)
                                    @currency($d->konversi->harga_konversi)
                                @else
                                    
                                @endif
                            </td>
                            <td>
                                {{$d->berat != null ? $d->berat : ''}}
                            </td>
                            <td>
                                @if ($d->harga_total != null)
                                    @currency($d->harga_total)
                                @else
                                    
                                @endif
                            </td>
                            <td>
                                {{$d->keterangan != null ? $d->keterangan : ''}}
                            </td>
                            <td>
                                <form action="{{ route('delete-transaksi', $d->id) }}" method="POST">
                                    <a href="{{ route('transaksi.edit', $d->id) }}" class="btn btn-success btn-sm"
                                        data-toggle="tooltip" data-placement="top" data-original-title="Edit"><i
                                            class="far fa-edit"></i></a>
                                    <a class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top"
                                        data-original-title="Delete" onClick="deleteConfirm({{$d->id}})">
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
@endsection

@push('script')
<script>
    function deleteConfirm(id) {
        var id_bank = $('#id_bank').val()
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
                    url: "/admin/delete-transaksi/" + id,
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
                        if (id_bank === "kosong") {
                            window.location.href = "/admin/transaksi"
                        } else {
                            window.location.href = "/admin/detail-transaksi/" + id_bank
                        }
                    },
                    error: function () {
                        Swal.fire({
                            title: 'Gagal!',
                            text: 'Data tidak dapat di hapus!',
                            icon: 'warning',
                        });
                        if (id_bank === "kosong") {
                            window.location.href = "/admin/transaksi"
                        } else {
                            window.location.href = "/admin/detail-transaksi/" + id_bank
                        }

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
