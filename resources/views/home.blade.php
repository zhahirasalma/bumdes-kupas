@extends('frontend.layout.master')
@section('title')
Home
@endsection
@section('content')

<!-- Masthead-->
<header class="masthead bg-primary text-secondary text-center">
    <div class="container d-flex align-items-center flex-column">
        <!-- Masthead Avatar Image-->
        <img class="masthead-avatar mb-5" src="{{asset('template/assets/img/avataaars.svg')}}" alt="" />
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
@endsection
