@extends('frontend.layout.master')
@section('title')
Tambah Setor Anggota Bank Sampah
@endsection
@section('content')

<head>
    <link rel=”stylesheet” href="{{asset('swal/sweetalert.css')}}">
    <script src="{{asset('swal/sweetalert.js')}}"></script>
</head>


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
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card shadow">
                            <div class="card-header bg-white border-0">
                                <div class="row align-items-center">
                                    <div class="card-body">
                                        <!-- <form action="{{route('daftar_setor.store')}}" method="POST"> -->
                                            @csrf
                                            <div class="pl-lg-4">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label class="form-control-label" for="input-nama">Nama
                                                                Anggota</label>
                                                            <input type="text" name="nama" id="nama" class="form-control form-control-alternative"
                                                                placeholder="Nama Anggota" value="{{ old('nama')}}">
                                                            @if ($errors->has('nama'))
                                                            <span
                                                                class="text-danger">{{ $errors->first('nama') }}</span>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label class="form-control-label" for="input-tanggal">Tanggal Setor</label>
                                                            <input type="date" name="tanggal_transaksi" id="tanggal_transaksi"
                                                                class="form-control form-control-alternative"
                                                                placeholder="Tanggal" value="{{ old('tanggal_transaksi')}}">
                                                            @if ($errors->has('tanggal_transaksi'))
                                                            <span
                                                                class="text-danger">{{ $errors->first('tanggal_transaksi') }}</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <label class="form-control-label" for="input-nama">Setoran Sampah</label>
                                                        <div id="setoran">
                                                            <div class="row align-items-center">
                                                                <div class="col-lg-3">
                                                                    <div class="form-group">
                                                                        <select name="id_konversi" id="id_konversi_0"
                                                                            class="form-control form-control-alternative" onChange="updateHarga(0)">
                                                                            <option value="">Pilih jenis sampah...</option>
                                                                            @foreach($konversi as $k)
                                                                            <option
                                                                                value="{{$k->id}},{{$k->harga_konversi}}">
                                                                                {{$k->jenis_sampah}}</option>
                                                                            @endforeach
                                                                        </select>
                                                                        @if ($errors->has('id_konversi'))
                                                                        <span
                                                                            class="text-danger">{{ $errors->first('id_konversi') }}</span>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3">
                                                                    <div class="form-group">
                                                                        <input type="number" name="berat" id="berat_0"
                                                                            class="form-control form-control-alternative"
                                                                            placeholder="Berat Sampah" value="1"
                                                                            onChange="updateHarga(0)">
                                                                        @if ($errors->has('berat'))
                                                                        <span
                                                                            class="text-danger">{{ $errors->first('berat') }}</span>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3">
                                                                    <div class="form-group">
                                                                        <input type="text" name="harga_total"
                                                                            id="harga_total_0"
                                                                            class="form-control form-control-alternative"
                                                                            placeholder="Harga total" value="" disabled>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3">
                                                                    <div class="form">
                                                                        <button type="button" class="btn btn-success"
                                                                            id="tambah" onClick="add()"><i
                                                                                class="fas fa-plus"></i></button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <button class="btn btn-primary" type="submit" onClick="kirimData()">Tambah</button>
                                            </div>
                                        <!-- </form> -->
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


<script type="text/javascript">
    var i = 0;

    function sembunyi(id) {
        var row = '#' + id
        $(row).hide()
    };

    function add() {
        i++
        $('#setoran').append(`<div  id="row_${i}" class="row align-items-center">
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <select name="id_konversi" id="id_konversi_${i}" class="form-control" onChange="updateHarga(${i})">
                                        <option value="">Pilih jenis sampah...</option>
                                        @foreach($konversi as $k)
                                        <option value="{{$k->id}},{{$k->harga_konversi}}" >
                                            {{$k->jenis_sampah}}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('id_konversi'))
                                    <span class="text-danger">{{ $errors->first('id_konversi') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <input type="number" name="berat" id="berat_${i}"
                                        class="form-control form-control-alternative" placeholder="Berat Sampah"
                                        value="1" onChange="updateHarga(${i})">
                                    @if ($errors->has('berat'))
                                    <span class="text-danger">{{ $errors->first('berat') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <input type="text" name="harga_total" id="harga_total_${i}"
                                        class="form-control form-control-alternative" placeholder="Harga total"
                                        value="" disabled>
                                </div>
                            </div>
                            <div class="col-lg-3 ">
                                <div class="form-group">
                                    <button id="${i}" type="button" class="btn btn-warning" onClick="sembunyi('row_${i}')"><i
                                            class="fas fa-minus"></i></button>
                                </div>
                            </div>
                        </div>`);

    };

    function kirimData() {
        var nama = $('#nama').val()
        var tanggal = $('#tanggal_transaksi').val()
        var konversi = $('#id_konversi_0').val()
        var total = $('#harga_total').val()
        var berat = $('#berat_0').val()

        var error = false;

        if (!error) {
            var row = []
            var kirim = {
                tanggal: tanggal,
            }
            for (i = 0; i < 10; i++) {
                var x = {}
                if ($('#berat_' + i).length) {
                    x.konversi = $('#id_konversi_' + i).val()
                    var y = x.konversi.split(",")
                    x.berat = $('#berat_' + i).val()
                    x.harga_total = $('#harga_total_' + i).val()
                    x.id_konversi = parseInt(y[0])
                    x.harga = y[1]
                    row.push(x)
                }
            }

            $.ajax({
                url: "/daftar_setor",
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    nama: nama,
                    tanggal_transaksi: tanggal,
                    id_konversi: konversi,
                    berat: berat,
                    row: row
                },
                success: function (res) {
                    Swal.fire({
                        title: 'Berhasil!',
                        text: 'Data berhasil di tambahkan!',
                        icon: 'success',
                    }).then((result) => {
                        if (result.value) {
                            window.location.href = "/daftar_setor"
                        }
                    });
                },
                error: function (xhr, status, error) {
                    var err = eval("(" + xhr.responseText + ")");
                    var text = err.message;
                    
                    Swal.fire({
                        title: 'Gagal!',
                        text: text,
                        icon: 'warning',
                    });
                }
            });
        }

    };

    function updateHarga(id) {
        var harga = $('#id_konversi_' + id).val()
        var x = harga.split(",")
        var updateharga = x[1]
        total = updateharga * $('#berat_' + i).val();
        $('#harga_total_' + i).val(total)
    };

</script>

