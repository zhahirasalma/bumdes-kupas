@extends('frontend.layout.master')
@section('title')
Bank Sampah
@endsection
@section('content')

<!-- Masthead-->
<header class="masthead bg-primary text-secondary text-center">
    <div class="container d-flex align-items-center flex-column">
        <!-- Masthead Avatar Image-->
        <img class="masthead-avatar mb-5" src="{{asset('template/assets/img/avataaars.svg')}}" alt="" />
        <!-- Masthead Heading-->
        <h1 class="masthead-heading text-uppercase mb-0">HALO BANK SAMPAH</h1>
        <!-- Icon Divider-->
        <div class="divider-custom divider-light">
            <div class="divider-custom-line"></div>
        </div>
        <!-- Masthead Subheading-->
        <p class="masthead-subheading font-weight-light mb-0">Alamat</p>
    </div>
</header>
<!-- Portfolio Section-->
<section class="page-section portfolio" id="portfolio">
    <div class="container">
        <!-- Portfolio Section Heading-->
        <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">Layanan</h2>
        <!-- Icon Divider-->
        <div class="divider-custom">
            <div class="divider-custom-line"></div>
        </div>
        <!-- Portfolio Grid Items-->
        <div class="row justify-content-center">
            <!-- Portfolio Item 1-->
            <div class="col-md-6 col-lg-4 mb-5">
                <div class="portfolio-item mx-auto">
                    <!-- <div class="portfolio-item-caption d-flex align-items-center justify-content-center h-100 w-100">
                        <div class="portfolio-item-caption-content text-center text-white"><i
                                class="fas fa-plus fa-3x"></i>
                        </div>
                    </div> -->
                    <a href="/historyTransaksi"> <img class="img-fluid" src="{{asset('template/assets/img/portfolio/history-transaksi.png')}}"
                        alt=""/></a>
                    <h3 class="portfolio-modal-subtitle text-center text-secondary text-uppercase mb-0">History
                        Transaksi</h3>

                </div>
            </div>
            <!-- Portfolio Item 2-->
            <div class="col-md-6 col-lg-4 mb-5">
                <div class="portfolio-item mx-auto">
                    <!-- <div class="portfolio-item-caption d-flex align-items-center justify-content-center h-100 w-100">
                        <div class="portfolio-item-caption-content text-center text-white"><i
                                class="fas fa-plus fa-3x"></i></div>
                    </div> -->
                    <a href="daftarSetorBankSampah"><img class="img-fluid" src="{{asset('template/assets/img/portfolio/setoran-anggota.png')}}"
                        alt="" /></a>
                    <h3 class="portfolio-modal-subtitle text-center text-secondary text-uppercase mb-0">Daftar Setoran
                        Anggota</h3>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Portfolio Modals-->
<!-- Portfolio Modal 1-->
<!-- <div class="portfolio-modal modal fade" id="portfolioModal1" tabindex="-1" role="dialog"
    aria-labelledby="portfolioModal1Label" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true"><i class="fas fa-times"></i></span>
            </button>
            <div class="modal-body text-center">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <h2 class="portfolio-modal-title text-secondary text-uppercase mb-0"
                                id="portfolioModal1Label">History Transaksi</h2>
                            <div class="divider-custom">
                                <div class="divider-custom-line"></div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-body">

                                            <div class="table-responsive">
                                                <table id="default_table"
                                                    class="table table-striped table-bordered no-wrap">
                                                    <thead>
                                                        <tr>
                                                            <th>No</th>
                                                            <th>Tanggal Transaksi</th>
                                                            <th>Berat Total Sampah</th>
                                                            <th>Harga Total</th>
                                                            <th>Keterangan</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>1</td>
                                                            <td>2</td>
                                                            <td>3</td>
                                                            <td>4</td>
                                                            <td>5</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <p class="mb-5">History transaksi adalah data transaksi pengumpulan sampah oleh bank sampah
                                yang telah dilaksanakan selama menjadi anggota bank sampah KUPAS</p>
                            <button class="btn btn-primary" data-dismiss="modal">
                                <i class="fas fa-times fa-fw"></i>
                                Tutup Halaman
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> -->
<!-- Portfolio Modal 2-->
<!-- <div class="portfolio-modal modal fade" id="portfolioModal2" tabindex="-1" role="dialog"
    aria-labelledby="portfolioModal2Label" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true"><i class="fas fa-times"></i></span>
            </button>
            <div class="modal-body text-center">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            
                            <h2 class="portfolio-modal-title text-secondary text-uppercase mb-0"
                                id="portfolioModal2Label">Daftar Setoran Anggota</h2>
                        
                            <div class="divider-custom">
                                <div class="divider-custom-line"></div>
                            </div>
                           
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-body">

                                            <div class="table-responsive">
                                                <table id="default_table"
                                                    class="table table-striped table-bordered no-wrap">
                                                    <thead>
                                                        <tr>
                                                            <th>No</th>
                                                            <th>Nama Anggota</th>
                                                            <th>Tanggal Setor</th>
                                                            <th>Uraian</th>
                                                            <th>Aksi</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>1</td>
                                                            <td>2</td>
                                                            <td>3</td>
                                                            <td>4</td>
                                                            <td>
                                                                <a class="text-success" data-toggle="tooltip"
                                                                    data-placement="top" data-original-title="Edit"><i
                                                                        class="far fa-edit"></i></a>
                                                                <a @click="deleteData(item.id)" class="text-danger"
                                                                    data-toggle="tooltip" data-placement="top"
                                                                    data-original-title="Delete"><i
                                                                        class="far fa-trash-alt"></i></a>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <p class="mb-5">Catatan setoran sampah anggota bank sampah ke bank sampah
                            </p>
                            <button class="btn btn-primary" href="/homebankSampah">
                                <i class="fas fa-times fa-fw"></i>
                                Tutup Halaman
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> -->
@endsection
