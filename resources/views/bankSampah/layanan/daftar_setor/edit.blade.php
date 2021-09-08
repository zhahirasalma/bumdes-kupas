@extends('frontend.layout.master')
@section('title')
Ubah Setor Anggota Bank Sampah
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
                <h2 class="portfolio-modal-title text-secondary text-uppercase mb-0" id="portfolioModal1Label">Ubah
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
                                        <input type="hidden" id="id" value="{{$daftar_setor->id}}">
                                        <input type="hidden" id="id_bank_sampah" value="{{$daftar_setor->id_bank_sampah}}">
                                            @csrf
                                            @method('PUT')
                                            <div class="pl-lg-4">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label class="form-control-label" for="input-nama">Nama Anggota</label>
                                                            <input type="text" name="nama" id="nama" class="form-control form-control-alternative"
                                                                placeholder="Nama Anggota" value="{{$daftar_setor->nama}}">
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
                                                                placeholder="Tanggal" value="{{$daftar_setor->tanggal_transaksi}}">
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
                                                                        <select name="id_konversi" id="id_konversi"
                                                                            class="form-control form-control-alternative"  onChange="updateKonversi()">">
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
                                                                        <input type="number" name="berat" id="berat"
                                                                            class="form-control form-control-alternative"
                                                                            placeholder="Berat Sampah" value="1"
                                                                            onChange="updateKonversi()">
                                                                        @if ($errors->has('berat'))
                                                                        <span
                                                                            class="text-danger">{{ $errors->first('berat') }}</span>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3">
                                                                    <div class="form-group">
                                                                        <input type="text" name="harga_total"
                                                                            id="harga_total"
                                                                            class="form-control form-control-alternative"
                                                                            placeholder="Harga total" value="{{$daftar_setor->harga_total}}" disabled>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <button class="btn btn-primary" type="submit" onClick="ubahData()">Ubah</button>
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
    function updateKonversi() {
            var harga = $('#id_konversi').val()
            if (harga != '' && harga != null) {
                $.ajax({
                    url: "{{url('')}}/admin/get-konversi/" + harga,
                    success: function (res) {
                        total = res * $('#berat').val();
                        $('#harga_total').val(total)
                    },
                });
            }
        };

    function ubahData() {
        var nama = $('#nama').val()
        var tanggal = $('#tanggal_transaksi').val()
        var konversi = $('#id_konversi').val()
        var berat = $('#berat').val()
        var total = $('#harga_total').val()
        var id = $('#id').val()
        var id_bank_sampah = $('#id_bank_sampah').val()

        var error = false;

        if (!error) {
            $.ajax({
                url: "/daftar_setor/" + id,
                method: 'post',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "_method": "PUT",
                    nama: nama,
                    tanggal_transaksi: tanggal,
                    id_bank_sampah: id_bank_sampah,
                    id_konversi: konversi,
                    berat: berat,
                    harga_total: total,
                },
                success: function (data) {
                    Swal.fire({
                        title: 'Berhasil!',
                        text: 'Data berhasil di ubah!',
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
            })
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
