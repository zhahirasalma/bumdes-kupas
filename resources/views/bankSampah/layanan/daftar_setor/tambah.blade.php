@extends('frontend.layout.master')
@section('title')
Tambah Setor Anggota Bank Sampah
@endsection
@section('content')

<header class="masthead bg-primary text-secondary text-center">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-12">
                <!-- Portfolio Modal - Title-->
                <h2 class="portfolio-modal-title text-secondary text-uppercase mb-0" id="portfolioModal1Label">Tambah
                    Data Setoran
                    Anggota</h2>
                <!-- Icon Divider-->
                <div class="divider-custom">
                    <div class="divider-custom-line"></div>
                </div>
                <!-- Portfolio Modal - Table-->
                <!-- <img class="img-fluid rounded mb-5"
                    src="{{asset('template/assets/img/portfolio/cabin.png')}}" alt="" /> -->
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card shadow">
                            <div class="card-header bg-white border-0">
                                <div class="row align-items-center">
                                    <div class="card-body">
                                        <form>
                                            <div class="pl-lg-4">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label class="form-control-label" for="input-nama">Nama
                                                                Anggota</label>
                                                            <input type="text" id="nama"
                                                                class="form-control form-control-alternative"
                                                                placeholder="Nama Anggota" value="">
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label class="form-control-label" for="input-nama">Tanggal
                                                                Setor</label>
                                                            <input type="date" id="nama"
                                                                class="form-control form-control-alternative"
                                                                placeholder="Tanggal" value="">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label class="form-control-label"
                                                                for="input-first-name">Uraian</label>
                                                            <input type="text" id="input-first-name"
                                                                class="form-control form-control-alternative"
                                                                placeholder="Uraian" value="">
                                                        </div>
                                                    </div>
                                                </div>
                                                <button class="btn btn-primary" type="button">Tambah</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="divider-custom"></div>
                <!-- Portfolio Modal - Text-->
                <a class="btn btn-primary" href="/daftarSetorBankSampah">
                    <i class="fas fa-times fa-fw"></i>
                    Tutup Halaman
                </a>
            </div>
            <div class="divider-custom"></div>
        </div>
    </div>
</header>
@endsection
