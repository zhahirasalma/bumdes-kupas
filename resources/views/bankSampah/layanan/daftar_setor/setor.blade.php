@extends('frontend.layout.master')
@section('title')
Setor Anggota Bank Sampah
@endsection
@section('content')

<header class="masthead bg-primary text-secondary text-center">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-12">
                <!-- Portfolio Modal - Title-->
                <h2 class="portfolio-modal-title text-secondary text-uppercase mb-0" id="portfolioModal1Label">Daftar
                    Setoran
                    Bank Sampah</h2>
                <!-- Icon Divider-->
                <div class="divider-custom">
                    <div class="divider-custom-line"></div>
                </div>
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card shadow">
                            <div class="card-body">
                                <div class="col text-right">
                                    <a href="{{route('daftar_setor.create')}}" class="btn btn-sm btn-primary">Tambah
                                        Data</a>
                                </div>
                                <div class="col text-left">
                                    <label>Cari berdasarkan...</label>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <select id="filter-nama" class="form-control filter" name="filter_nama"
                                                id="filter_nama">
                                                <option value="">Pilih nama</option>
                                                @foreach($filter_nama as $filter)
                                                <option value="{{$filter->id}}">{{$filter->nama}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <select id="filter-tanggal" class="form-control filter" name="filter_nama"
                                                id="filter_nama">
                                                <option value="">Pilih tanggal</option>
                                                @foreach($filter_nama as $filter)
                                                <option value="{{$filter->id}}">{{$filter->nama}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="table-responsive">
                                    <table id="tabel_setor" class="table table-striped table-bordered no-wrap">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Anggota</th>
                                                <th>Tanggal Setor</th>
                                                <th>Jenis Sampah</th>
                                                <th>Harga Konversi (per kg)</th>
                                                <th>Berat (kg)</th>
                                                <th>Harga Total</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <!-- @foreach($daftar_setor as $daftar_setor)
                                        
                                        <tr>
                                        <th scope="row">
                                            {{$loop->iteration}}
                                        </th>
                                            <td>{{$daftar_setor->nama}}</td>
                                            <td>{{$daftar_setor->tanggal_transaksi}}</td>
                                            @foreach($konversi as $k)
                                            <td>{{$k->jenis_sampah}}</td>
                                            <td>{{$k->harga_konversi}}</td>
                                            @endforeach
                                            <td>{{$daftar_setor->berat}}</td>
                                            <td>{{$daftar_setor->harga_total}}</td>
                                            <td>
                                                <form action="{{ route('daftar_setor.destroy', $daftar_setor->id) }}" method="POST">    
                                                <a href="{{ route('daftar_setor.edit', $daftar_setor->id) }}"
                                                    class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top"
                                                     data-original-title="Edit"><i class="far fa-edit"></i></a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top"
                                                        data-original-title="Delete" type="submit"><i class="far fa-trash-alt"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    
                                    @endforeach -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="divider-custom"></div>
                <!-- Portfolio Modal - Text-->
                <p class="mb-5">Catatan setoran sampah anggota bank sampah ke bank sampah</p>
                <a class="btn btn-primary" href="{{route('bankSampah.index')}}">
                    <i class="fas fa-times fa-fw"></i>
                    Tutup Halaman
                </a>
            </div>
            <div class="divider-custom"></div>
        </div>
    </div>
</header>
@endsection

@push('script')
<script type="text/javascript">
    let filter = $("#filter-nama").val();
    var tabel;

    $(document).ready(function () {
     tabel = $('#tabel_setor').DataTable({
        // "bFilter": true,
        // "bInfo": true,
        // "processing": true,
        // "bServerSide": true,
        // "order": [
        //     [1, "asc"]
        // ],
        // "autoWidth": false,
        // ajax: {
        //     url: "{{route('data-setor')}}",
        //     type: "GET",
        //     data: function (d) {
        //         d.filter = filter;
        //         return d
        //     }
        // },
        // columnDefs: [{
        //         "targets": 0,
        //         "class": "text-nowrap",
        //         "sortable": true,
        //         "render": function (data, type, row, meta) {
        //             return meta.row + meta.settings._iDisplayStart + 1;
        //         }
        //     },
        //     {
        //         "targets": 1,
        //         "class": "text-nowrap",
        //         "sortable": true,
        //         "render": function (data, type, row, meta) {
        //             return row.nama;
        //         }
        //     },
        //     {
        //         "targets": 2,
        //         "class": "text-nowrap",
        //         "sortable": false,
        //         "render": function (data, type, row, meta) {
        //             return row.tanggal_transaksi;
        //         }
        //     },
        //     {
        //         "targets": 3,
        //         "class": "text-nowrap",
        //         "sortable": false,
        //         "render": function (data, type, row, meta) {
        //             return row.id_konversi.jenis_sampah;
        //         }
        //     },
        //     {
        //         "targets": 4,
        //         "class": "text-nowrap",
        //         "sortable": false,
        //         "render": function (data, type, row, meta) {
        //             return row.id_konversi.harga_konversi;
        //         }
        //     },
        //     {
        //         "targets": 5,
        //         "class": "text-nowrap",
        //         "sortable": true,
        //         "render": function (data, type, row, meta) {
        //             return row.berat;
        //         }
        //     },
        //     {
        //         "targets": 6,
        //         "class": "text-nowrap",
        //         "sortable": true,
        //         "render": function (data, type, row, meta) {
        //             return row.harga_total;
        //         }
        //     },
        //     {
        //         "targets": 7,
        //         "class": "text-nowrap",
        //         "sortable": false,
        //         "render": function (data, type, row, meta) {
        //             return `<td>
        //                         <form action="{{url('')}}/daftar_setor/${row.id}" method="POST">
        //                             <a href="{{url('')}}/daftar_setor/${row.id}/edit" class="btn btn-success btn-sm"
        //                                 data-toggle="tooltip" data-placement="top" data-original-title="Edit"><i
        //                                     class="far fa-edit"></i></a>
        //                             <a class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top"
        //                                 data-original-title="Delete" onClick="deleteConfirm('${row.id}')">
        //                                 <i class="far fa-trash-alt" style="color: white;"></i></a>
        //                         </form>
        //                     </td>`;
        //         }
        //     }
        // ]
        processing	: true,
        language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Cari"
                  },
        // dom 		: "<fl<t>ip>",
  			serverSide	: true,
  			stateSave: true,
        ajax		: {
            url : "{{ url('list-data-setor') }}",
            type: "GET",
        },
        columns: [
            { data: 'id', name:'id', visible:false},
            { data: 'nama', name:'nama', visible:true},
            { data: 'tanggal_transaksi', name:'tanggal_transaksi', visible:true},
            { data: 'id_konversi', name:'id_konversi', visible:true},
            // { data: 'jenis_sampah', name:'jenis_sampah', visible:true},
            // { data: 'harga_konversi', name:'harga_konversi', visible:true},
            { data: 'berat', name:'berat', visible:true},
            { data: 'harga_total', name:'harga_total', visible:true},
            { data: 'action', name:'action', visible:true},
        ],

    });
    });

    $('.filter').on('change', function () {
        filter = $("#filter-nama").val();
        tabel.ajax.reload(null, false)
    })

    
        $('.filter_nama').select2({
            allowClear: true,
            placeholder: "Pilih nama anggota...",
            theme: 'bootstrap4',
        });
    })

</script>
@endpush
