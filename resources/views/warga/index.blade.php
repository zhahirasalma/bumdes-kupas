@extends('frontend.layout.master')
@section('title')
Warga
@endsection
@section('content')

<head>
    <link rel=”stylesheet” href="{{asset('swal/sweetalert.css')}}">
    <script src="{{asset('swal/sweetalert.js')}}"></script>
</head>

<!-- Masthead-->
<header class="masthead bg-primary text-secondary text-center">
    <div class="container d-flex align-items-center flex-column">
        <!-- Masthead Avatar Image-->
        <img class="masthead-avatar mb-5" src="{{asset('template/assets/img/logo_kupas.png')}}" alt="" />
        <!-- Masthead Heading-->
        <h1 class="masthead-heading text-uppercase mb-0"><span>HALO {{ Auth::user()->nama }}</span></h1>
        <!-- Icon Divider-->
        <div class="divider-custom divider-light">
            <div class="divider-custom-line"></div>
        </div>
        <!-- Masthead Subheading-->
        @foreach($warga as $b)
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
                <div class="portfolio-item mx-auto" data-toggle="modal" data-target="#portfolioModal1">
                    <div
                        class="card portfolio-item-caption d-flex align-items-center justify-content-center h-100 w-100">
                        <div class="portfolio-item-caption-content text-center text-white"><i
                                class="fas fa-plus fa-3x"></i></div>
                    </div>
                    <img class="img-fluid" src="{{asset('template/assets/img/portfolio/retribusi.png')}}" alt="" />
                    <h3 class="portfolio-modal-subtitle text-center text-secondary text-uppercase mb-0">Jumlah Tagihan
                    @foreach($retribusi as $r)
                    @if($r->user->id==Auth::user()->id)
                        {{ $r->jumlah_tagihan != 'null' ? $r->jumlah_tagihan : ''  }}</p>
                    @endif
                    @endforeach
                    </h3>
                    <h3 class="portfolio-modal-subtitle text-center text-secondary mb-0">
                    </h3>

                </div>
            </div>
            <!-- Portfolio Item 2-->
            @foreach($pengambilan as $pengambilan)
                <!-- <p action="/konfirmasistatus" method="post" id="statusForm{{$pengambilan->id}}">
                @csrf -->
                <div class="col-md-6 col-lg-4 mb-5 align-items-center justify-content-center h-100 w-100">
                    <input type="checkbox" data-id="{{$pengambilan->id}}" class="toggle-switch" checked data-toggle="toggle"
                        data-width="307" data-height="240" data-onstyle="danger" data-offstyle="success"
                        data-on="Belum Terambil" data-off="Terambil" {{$pengambilan->status ? 'checked' : ''}}></input>
                    <label class="text-center">Geser ke kanan bila hari ini sampah belum
                        terambil.</label>
                    <h3 class="portfolio-modal-subtitle text-center text-secondary text-uppercase mb-0">Tombol
                        Pengambilan
                    </h3>
                </div>
                <!-- <div class="col-md-6 col-lg-4 mb-5 align-items-center justify-content-center h-100 w-100">
                    <input name="id" type="hidden" value="{{$pengambilan->id}}">
                    <input name="status" type="checkbox" class="toggle-switch" checked data-toggle="toggle"
                        data-width="307" data-height="240" data-onstyle="danger" data-offstyle="success"
                        data-on="Belum Terambil" data-off="Terambil"
                        onchange="document.getElementById('statusForm{{$pengambilan->id}}').submit()"
                        {{isset($project['status']) && $project['status'] == '1' ? 'checked' : ''}} ></input>
                    <label class="text-center">Geser ke kanan bila hari ini sampah belum
                        terambil.</label>
                    <h3 class="portfolio-modal-subtitle text-center text-secondary text-uppercase mb-0">Tombol
                        Pengambilan
                    </h3>
                </div> -->
            
            @endforeach
        </div>
    </div>
    </div>
</section>

<!-- Portfolio Modals-->
<!-- Portfolio Modal 1-->
<div class="portfolio-modal modal fade" id="portfolioModal1" tabindex="-1" role="dialog"
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
                            <!-- Portfolio Modal - Title-->
                            <h4 class="portfolio-modal-title text-secondary text-uppercase mb-0"
                                id="portfolioModal1Label">Jumlah Tagihan</h4>
                            <!-- Icon Divider-->
                            <div class="divider-custom">
                                <div class="divider-custom-line"></div>
                            </div>
                            <!-- Portfolio Modal - Table-->
                            <!-- <img class="img-fluid rounded mb-5"
                                    src="{{asset('template/assets/img/portfolio/cabin.png')}}" alt="" /> -->
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
                                                            <th>Jumlah Transaksi</th>
                                                            <th>Keterangan</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                        <tr>
                                                            <!-- <th scope="row"></th>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td> -->
                                                        </tr>

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Portfolio Modal - Text-->
                            <p class="mb-5">History transaksi retribusi warga
                            </p>
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
</div>

@endsection

@push('script')
<script>
    $(function () {
        $('.toggle-switch').change(function () {
            var status = $(this).prop('checked') == true ? 1 : 0;
            var id = $(this).data('id');
            $.ajax({
                type: "GET",
                dataType: "json",
                url: '{{route('konfirmasistatus')}}',
                data: {
                    'status': status,
                    'id': id
                },
                success: function (data) {
                    Swal.fire({
                        title: 'Berhasil!',
                        text: 'Status berhasil diubah!',
                        icon: 'success',
                        confirmButtonColor: "#3085d6",
                        confirmButtonText: "OK",
                    })
                },
                error: function (error) {
                    Swal.fire({
                        title: 'Gagal!',
                        text: 'Tidak dapat mengubah status',
                        icon: 'warning',
                    });
                }
            });
        });
    });

</script>
@endpush
