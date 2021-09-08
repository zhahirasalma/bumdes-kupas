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
            { data: 'jenis_sampah', name:'jenis_sampah', visible:true},
            { data: 'harga_konversi', name:'harga_konversi', visible:true},
            { data: 'berat', name:'berat', visible:true},
            { data: 'harga_total', name:'harga_total', visible:true},
            { data: 'action', name:'action', visible:true},
        ],

    });
    });   

</script>
@endpush
