@extends('frontend.layout.master')
@section('title')
Setor Anggota Bank Sampah
@endsection
@section('content')

<header class="masthead bg-primary text-secondary text-center">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-12">
                <!-- Portfolio Modal - Title-->
                <h2 class="portfolio-modal-title text-secondary text-uppercase mb-0" id="portfolioModal1Label">Daftar Setoran
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
                            <div class="card-body">
                                <div class="col text-right">
                                    <a href="{{route('daftar_setor.create')}}" class="btn btn-sm btn-primary">Tambah Data</a>
                                </div>
                                <br>
                                <div class="table-responsive">
                                    <table id="default_table" class="table table-striped table-bordered no-wrap">
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
                                        @foreach($daftar_setor as $daftar_setor)
                                        
                                            <tr>
                                            <th scope="row">
                                                {{$loop->iteration}}
                                            </th>
                                                <td>{{$daftar_setor->nama}}</td>
                                                <td>{{$daftar_setor->tanggal_transaksi}}</td>
                                                <td>{{$daftar_setor->uraian}}</td>
                                                <td>
                                                    <form action="{{ route('daftar_setor.destroy', $daftar_setor->id) }}" method="POST">    
                                                    <a href="{{ route('daftar_setor.edit', $daftar_setor->id) }}"
                                                        class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top"
                                                         data-original-title="Edit"><i class="far fa-edit"></i></a>
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top"
                                                            data-original-title="Delete" type="submit"><i class="far fa-trash-alt"></i></button>
                                                    </form>
                                                </td>
                                            </tr>
                                        
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
                <p class="mb-5">Catatan setoran sampah anggota bank sampah ke bank sampah</p>
                <a class="btn btn-primary" href="{{route('bankSampah.index')}}">
                    <i class="fas fa-times fa-fw"></i>
                    Tutup Halaman
                </a>
            </div>
            <div class="divider-custom"></div>
        </div>
    </div>
    </header>
@endsection
