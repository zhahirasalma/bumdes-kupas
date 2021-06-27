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
            <div class="pl-lg-4">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-control-label" for="input-nama">Tampilkan berdasarkan bulan
                                tagihan</label>
                            <select name="filter_tagihan" id="filter_tagihan" class="form-control filter">
                                <option value="all">Semua transaksi</option>
                                <option value="Januari" @if (old('filter_tagihan') !='' ) selected="selected" @endif>
                                    Januari</option>
                                <option value="Februari" @if (old('filter_tagihan') !='' ) selected="selected" @endif>
                                    Februari</option>
                                <option value="Maret" @if (old('filter_tagihan') !='' ) selected="selected" @endif>
                                    Maret</option>
                                <option value="April" @if (old('filter_tagihan') !='' ) selected="selected" @endif>
                                    April</option>
                                <option value="Mei" @if (old('filter_tagihan') !='' ) selected="selected" @endif>
                                    Mei</option>
                                <option value="Juni" @if (old('filter_tagihan') !='' ) selected="selected" @endif>
                                    Juni</option>
                                <option value="Juli" @if (old('filter_tagihan') !='' ) selected="selected" @endif>
                                    Juli</option>
                                <option value="Agustus" @if (old('filter_tagihan') !='' ) selected="selected" @endif>
                                    Agustus</option>
                                <option value="September" @if (old('filter_tagihan') !='' ) selected="selected" @endif>
                                    September</option>
                                <option value="Oktober" @if (old('filter_tagihan') !='' ) selected="selected" @endif>
                                    Oktober</option>
                                <option value="November" @if (old('filter_tagihan') !='' ) selected="selected" @endif>
                                    November</option>
                                <option value="Desember" @if (old('filter_tagihan') !='' ) selected="selected" @endif>
                                    Desember</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-control-label" for="input-nama">Total Tagihan</label>
                            <input type="text" id="total_tagihan" class="form-control form-control-alternative"
                                placeholder="Total Tagihan" value="{{$retribusi}}" disabled>
                        </div>
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

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
<script>
    let filter = $("#filter_tagihan").val()
    const tabel = $('#tabel').DataTable({
        "pageLength": 10,
        "lengthMenu": [
            [10, 25, 50, 100, -1],
            [10, 25, 50, 100, 'semua']
        ],
        "bLengthChange": true,
        "bFilter": true,
        "bInfo": true,
        "processing": true,
        "bServerSide": true,
        "order": [
            [1, "asc"]
        ],
        "autoWidth": false,
        "ajax": {
            url: "{{route('data-retribusi')}}",
            type: "POST",
            data: function (d) {
                d.filter = filter;
                return d
            }
        },
        columnDefs: [{
                "targets": 0,
                "class": "text-nowrap",
                "sortable": true,
                "render": function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            {
                "targets": 1,
                "class": "text-nowrap",
                "sortable": true,
                "render": function (data, type, row, meta) {
                    return row.nama + " - " + row.nik;
                }
            },
            {
                "targets": 2,
                "class": "text-nowrap",
                "sortable": false,
                "render": function (data, type, row, meta) {
                    return row.nama_kolektor;
                }
            },
            {
                "targets": 3,
                "class": "text-nowrap",
                "sortable": true,
                "render": function (data, type, row, meta) {
                    return row.jumlah_tagihan;
                }
            },
            {
                "targets": 4,
                "class": "text-nowrap",
                "sortable": true,
                "render": function (data, type, row, meta) {
                    return row.bulan_tagihan;
                }
            },
            {
                "targets": 5,
                "class": "text-nowrap",
                "sortable": true,
                "render": function (data, type, row, meta) {
                    return row.tanggal_transaksi;
                }
            },
            {
                "targets": 6,
                "class": "text-nowrap",
                "sortable": false,
                "render": function (data, type, row, meta) {
                    return row.keterangan;
                }
            },
            {
                "targets": 7,
                "class": "text-nowrap",
                "sortable": false,
                "render": function (data, type, row, meta) {
                    return `<td>
                                <form action="{{url('')}}/admin/retribusi/${row.id}" method="POST">
                                    <a href="{{url('')}}/admin/retribusi/${row.id}/edit" class="btn btn-success btn-sm"
                                        data-toggle="tooltip" data-placement="top" data-original-title="Edit"><i
                                            class="far fa-edit"></i></a>
                                    <a class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top"
                                        data-original-title="Delete" onClick="deleteConfirm('${row.id}')">
                                        <i class="far fa-trash-alt" style="color: white;"></i></a>
                                </form>
                            </td>`;
                }
            }
        ]
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

    $('#filter_tagihan').select2({
        allowClear: true,
        theme: 'bootstrap4',
    });

    $(".filter").on('change', function () {
        filter = $("#filter_tagihan").val()
        tabel.ajax.reload()

        $.ajax({
                url: "{{url('')}}/admin/total-retribusi/" + filter,
                success: function (res) {
                    if(res != ''){
                        $('#total_tagihan').val(res[0].total)
                    }else{
                        $('#total_tagihan').val(0)
                    }
                },
            });
    });

</script>
@endpush
