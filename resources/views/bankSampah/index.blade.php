@extends('frontend.layout.master')
@section('title')
Bank Sampah
@endsection
@section('content')

<!-- Masthead-->
<header class="masthead bg-primary text-secondary text-center">
    <div class="container d-flex align-items-center flex-column">
        <!-- Masthead Avatar Image-->
        <img class="masthead-avatar mb-0" src="{{asset('template/assets/img/logo_kupas.png')}}" alt="" />
        <!-- Masthead Heading-->
        <h1 class="masthead-heading text-uppercase mb-0">HALO {{ Auth::user()->nama }}</h1>
        <!-- Icon Divider-->
        <div class="divider-custom divider-light">
            <div class="divider-custom-line"></div>
        </div>
        <!-- Masthead Subheading-->
        @foreach($bank_sampah as $b)
        @if($b->user->id==Auth::user()->id)
        <p class="masthead-subheading font-weight-light mb-0">{{ $b->dukuh != 'null' ? $b->dukuh : ''  }},
                                {{ $b->desa->desa != 'null' ? $b->desa->desa : ''  }},
                                {{ $b->kecamatan->kecamatan != 'null' ? $b->kecamatan->kecamatan : ''  }},
                                {{ $b->kota->kota != 'null' ? $b->kota->kota : ''  }}</p>
        @endif
        @endforeach
    </div>
</header>
<!-- Portfolio Section-->
<section class="page-section portfolio" id="portfolio">
    <div class="container">
                @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
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
                    <a href="{{route('history_transaksi.index')}}"> <img class="img-fluid" 
                        src="{{asset('template/assets/img/portfolio/history-transaksi.png')}}"
                        alt=""/></a>
                    <h3 class="portfolio-modal-subtitle text-center text-secondary text-uppercase mb-0">History
                        Transaksi</h3>

                </div>
            </div>
            <!-- Portfolio Item 2-->
            <div class="col-md-6 col-lg-4 mb-5">
                <div class="portfolio-item mx-auto">
                    <a href="{{route('daftar_setor.index')}}"><img class="img-fluid" 
                        src="{{asset('template/assets/img/portfolio/setoran-anggota.png')}}"
                        alt="" /></a>
                    <h3 class="portfolio-modal-subtitle text-center text-secondary text-uppercase mb-0">Daftar Setoran
                        Anggota</h3>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
