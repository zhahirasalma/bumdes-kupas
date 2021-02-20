@extends('frontend.layout.master')
@section('title')
Home
@endsection
@section('content')

<!-- Masthead-->
<header class="masthead bg-primary text-secondary text-center">
    <div class="container d-flex align-items-center flex-column">
        <!-- Masthead Avatar Image-->
        <img class="masthead-avatar" src="{{asset('template/assets/img/logo_kupas.png')}}" alt="" />
        <!-- Masthead Heading-->
        <h1 class="masthead-heading text-uppercase mb-0">KUPAS</h1>
        <!-- Icon Divider-->
        <div class="divider-custom divider-light">
            <div class="divider-custom-line"></div>
        </div>
        <!-- Masthead Subheading-->
        <p class="masthead-subheading font-weight-light mb-0">
            Unit Jasa Pengelolaan Lingkungan desa Panggungharjo yakni Kelompok Usaha Pengelola Sampah (KUPAS)
            merupakan salah satu unit usaha Bumdes Panggung Lestari.
            Kelompok ini menjadi referensi bagi desa desa lain dalam menyelesaikan permasalahan sampah rumah tangga.
        </p>
    </div>
</header>
<section class=" container-color page-section portfolio" id="portfolio">
    <div class="container-color">
        <!-- Portfolio Section Heading-->
        <h2 class="page-section-heading2 text-center text-uppercase text-secondary mb-0">MASUK</h2>
        <h2 class="page-section-sub-heading text-center font-weight-light mb-0">Untuk yang telah memiliki akun</h2>
        <!-- Icon Divider-->
        <br>

        <div class="row justify-content-center">
            <div class="col-lg-8 mx-auto">
                <form id="contactForm" name="sentMessage" novalidate="novalidate">
                    <div class="col-lg-4 mx-auto">
                        <div class="form-group">
                            <!-- <label>Name</label> -->
                            <input class="form-control" id="email" type="email" placeholder="Email" required="required"
                                data-validation-required-message="Masukkan Email" />
                            <p class="help-block text-danger"></p>
                        </div>
                    </div>
                    <div class="col-lg-4 mx-auto">
                        <div class="form-group">
                            <!-- <label>Name</label> -->
                            <input class="form-control" id="password" type="password" placeholder="Kata Sandi"
                                required="required" data-validation-required-message="Masukkan Kata Sandi" />
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="form-group text-center">
                            <a href="/homebankSampah" class="btn btn-primary" id="sendMessageButton"
                                type="submit">Masuk</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="divider-custom"></div>
        <div class="divider-custom"></div>

        <h2 class="page-section-heading2 text-center text-uppercase text-secondary mb-0">REGISTRASI</h2>
        <h2 class="page-section-sub-heading text-center font-weight-light mb-0">Untuk yang belum memiliki akun</h2>
        <!-- Icon Divider-->
        <br>

        <div class="form-row justify-content-center">
            <div class="form-group col-md-2.5">
                <!-- <label>Name</label> -->
                <a href="{{route('registrasi.create')}}" class="btn btn-primary text-uppercase" id="sendMessageButton"
                    type="submit">Daftar Sebagai
                    Warga</a>
            </div>
            <div class="form-group col-md-2.5">
                <!-- <label>Name</label> -->
                <a href="/bank_sampah" class="btn btn-primary text-uppercase" id="sendMessageButton"
                    type="submit">Daftar Sebagai Bank Sampah</a>
            </div>
        </div>

    </div>
</section>
@endsection
