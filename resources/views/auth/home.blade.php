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
        @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
        </div>
        @endif
        <h2 class="page-section-heading2 text-center text-uppercase text-secondary mb-0">MASUK</h2>
        <h2 class="page-section-sub-heading text-center font-weight-light mb-0">Untuk yang telah memiliki akun</h2>
        <!-- Icon Divider-->
        <br>
        <div class="row justify-content-center">
            <div class="col-lg-8 mx-auto">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="col-lg-4 mx-auto">
                        <div class="form-group">
                            <!-- <label>Name</label> -->
                            <input class="form-control" name="email" for="email" id="email" type="email"
                                placeholder="Email" class="form-control @error('email') is-invalid @enderror"
                                value="{{ old('email') }}"  autocomplete="email" autofocus>
                            @error('email')
                            <span class="text-danger">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            <p class="help-block text-danger"></p>
                        </div>
                    </div>
                    <div class="col-lg-4 mx-auto">
                        <div class="form-group">
                            <!-- <label>Name</label> -->
                            <input class="form-control" name="password" id="password" type="password"
                                placeholder="Kata Sandi" class="form-control @error('password') is-invalid @enderror"
                                autocomplete="current-password">
                            @error('password')
                            <span class="text-danger">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            <p class="help-block text-danger"></p>
                        </div>
                        @if (\Session::has('error'))
                            <div class="alert alert-error text-danger text-center">
                                <strong>{!! \Session::get('error') !!}</strong>
                            </div>
                        @endif
                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Login') }}
                            </button>
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
                    Pelanggan</a>
            </div>
            <div class="form-group col-md-2.5">
                <!-- <label>Name</label> -->
                <a href="/create_bank_sampah" class="btn btn-primary text-uppercase" id="sendMessageButton"
                    type="submit">Daftar Sebagai Bank Sampah</a>
            </div>
        </div>

    </div>
</section>
@endsection
