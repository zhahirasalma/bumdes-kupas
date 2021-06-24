@extends('frontend.layout.master')
@section('title')
History Transaksi Bank Sampah
@endsection
@section('content')

<header class="masthead bg-primary text-secondary text-center">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-12">
                <!-- Portfolio Modal - Title-->
                <h2 class="portfolio-modal-title text-secondary text-uppercase mb-0" id="portfolioModal1Label">History
                    Transaksi</h2>
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
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="default_table" class="table table-striped table-bordered no-wrap">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Tanggal Transaksi</th>
                                                <th>Berat Total Sampah</th>
                                                <th>Harga Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($transaksi as $tr)
                                        @if($tr->user->id==Auth::user()->id)
                                            <tr>
                                                <th scope="row">{{$loop->iteration}}</th>
                                                <td>{{$tr->tanggal_transaksi}}</td>
                                                <td>{{$tr->berat}}</td>
                                                <td>@if ($tr->harga_total != null)
                                                        @currency($tr->harga_total)
                                                    @else
                                                        
                                                    @endif</td>
                                            </tr>
                                        @endif
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="divider-custom"></div>
                <!-- Portfolio Modal - Text-->
                <p class="mb-5">History transaksi adalah data transaksi pengumpulan sampah oleh bank sampah
                    yang telah dilaksanakan selama menjadi anggota bank sampah KUPAS</p>
                <a class="btn btn-primary" href="{{route('bankSampah.index')}}">
                    <i class="fas fa-times fa-fw"></i>
                    Tutup Halaman
                </a>
            </div>
            <div class="divider-custom"></div>
        </div>
    </div>
@endsection
