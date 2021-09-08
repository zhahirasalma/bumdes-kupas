@extends('frontend.layout.master')
@section('title')
Detail History Transaksi Bank Sampah
@endsection
@section('content')

<header class="masthead bg-primary text-secondary text-center">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-12">
                <!-- Portfolio Modal - Title-->
                <h2 class="portfolio-modal-title text-secondary text-uppercase mb-0" id="portfolioModal1Label"> Detail History
                    Transaksi</h2>
                <!-- Icon Divider-->
                <div class="divider-custom">
                    <div class="divider-custom-line"></div>
                </div>
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
                                                <th>Jenis Sampah</th>
                                                <th>Harga Konversi (per kg)</th>
                                                <th>Berat Sampah (Kg)</th>
                                                <th>Harga Total</th>
                                                <th>Keterangan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($detail as $dt)
                                        @if($dt->user->id==Auth::user()->id)
                                            <tr>
                                                <th scope="row">{{$loop->iteration}}</th>
                                                <td>{{$dt->tanggal_transaksi}}</td>
                                                <td>{{$dt->konversi->jenis_sampah}} </td>
                                                <td>@if ($dt->konversi->harga_konversi != null)
                                                        @currency($dt->konversi->harga_konversi)
                                                    @else
                                                        
                                                    @endif</td>
                                                <td>{{$dt->berat}}</td>
                                                <td>@if ($dt->harga_total != null)
                                                        @currency($dt->harga_total)
                                                    @else
                                                        
                                                    @endif</td>
                                                <td>{{$dt->keterangan}}</td>
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
