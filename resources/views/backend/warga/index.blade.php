@extends('backend.layout.master')
@section('title')
Daftar Warga
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
                        <a href="{{route('warga.create')}}" class="btn btn-success">Tambah</a>
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
                            <th scope="col">NIK</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Email</th>
                            <th scope="col">Kategori</th>
                            <th scope="col">No Telp</th>
                            <th scope="col">Detail Alamat</th>
                            <th scope="col">Lokasi</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($warga as $w)
                        <tr>
                            <th scope="row">
                                {{$loop->iteration}}
                            </th>
                            <td>
                                {{ $w->NIK != 'null' ? $w->NIK : ''  }}
                            </td>
                            <td>
                                {{ $w->user->nama != 'null' ? $w->user->nama : ''  }}
                            </td>
                            <td>
                                {{ $w->user->email != 'null' ? $w->user->email : ''  }}
                            </td>
                            <td>
                                {{ $w->kategori->jenis_sampah != 'null' ? $w->kategori->jenis_sampah : ''  }}
                            </td>
                            <td>
                                {{ $w->no_telp != 'null' ? $w->no_telp : ''  }}
                            </td>
                            <td>
                                {{ $w->detail_alamat != 'null' ? $w->detail_alamat : ''  }},
                                {{ $w->dukuh != 'null' ? $w->dukuh : ''  }},</br>
                                {{ $w->desa->desa != 'null' ? $w->desa->desa : ''  }},
                                {{ $w->kecamatan->kecamatan != 'null' ? $w->kecamatan->kecamatan : ''  }},
                                {{ $w->kota->kota != 'null' ? $w->kota->kota : ''  }}
                            </td>
                            <td>
                                @if ($w->latitude != null && $w->longitude != null)
                                <a target="_blank"
                                    href="https://maps.google.com/?q={{$w->latitude}},{{$w->longitude}}">Klik alamat</a>
                                @endif
                            </td>
                            <td>
                                <form action="{{ route('warga.destroy', $w->id) }}" method="POST">
                                    <a href="{{ route('warga.edit', $w->id) }}" class="btn btn-success btn-sm"
                                        data-toggle="tooltip" data-placement="top" data-original-title="Edit"><i
                                            class="far fa-edit"></i></a>
                                    <a class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top"
                                        data-original-title="Delete" onClick="deleteConfirm({{$w->id}})">
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
        <form method="post" id="form-import" action="{{url('/admin/import-warga')}}" enctype="multipart/form-data"
            class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Import Data Warga</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{method_field('PUT')}}
                {{csrf_field()}}
                <div class="row">
                    <div class="col-md-12">
                        <p>Import data warga sesuai format contoh berikut.<br /><a
                                href="{{url('')}}/excel-warga.xlsx"><i class="fas fa-download"></i> File Contoh
                                Excel
                                Warga</a></p>
                    </div>
                    <div class="col-md-12">
                        <label>File Excel Warga</label><br>
                        <input type="file" name="excel-warga" required><br>
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
                    url: "warga/" + id,
                    method: "post",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "_method": "DELETE",
                        id: id
                    },
                    success: function (data) {
                        window.location.href = "/admin/warga"
                    },
                    error: function () {
                        Swal.fire({
                            title: 'Gagal!',
                            text: 'Data tidak dapat di hapus!',
                            icon: 'warning',
                        });
                        window.location.href = "/admin/warga"
                    }
                });
            }
        })
    }

</script>
@endpush
