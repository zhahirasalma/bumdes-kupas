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
                    Bank Sampah</h2>
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
                                        <form action="{{route('daftar_setor.store')}}" method="POST">
                                            @csrf
                                            <div class="pl-lg-4">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label class="form-control-label" for="input-nama">Nama Anggota</label>
                                                            <input type="text" name="nama" id="nama" class="form-control form-control-alternative"
                                                                placeholder="Nama Anggota" value="">
                                                            @if ($errors->has('nama'))
                                                            <span
                                                                class="text-danger">{{ $errors->first('nama') }}</span>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label class="form-control-label" for="input-tanggal">Tanggal Setor</label>
                                                            <input type="date" name="tanggal_transaksi" id="tanggal_transaksi" class="form-control form-control-alternative"
                                                                placeholder="Tanggal" value="">
                                                            @if ($errors->has('tanggal_transaksi'))
                                                            <span
                                                                class="text-danger">{{ $errors->first('tanggal_transaksi') }}</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label class="form-control-label"
                                                                for="input-uraian">Uraian</label>
                                                            <input type="text" id="uraian" name="uraian"
                                                                class="form-control form-control-alternative"
                                                                placeholder="Uraian" value="">
                                                            @if ($errors->has('uraian'))
                                                            <span
                                                                class="text-danger">{{ $errors->first('uraian') }}</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <button class="btn btn-primary" type="submit">Tambah</button>
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
                <a class="btn btn-primary" href="{{route('daftar_setor.index')}}">
                    <i class="fas fa-times fa-fw"></i>
                    Tutup Halaman
                </a>
            </div>
            <div class="divider-custom"></div>
        </div>
    </div>
</header>
@endsection
