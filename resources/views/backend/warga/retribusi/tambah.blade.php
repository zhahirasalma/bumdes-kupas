@extends('backend.layout.master')
@section('title')
Tambah Data Transaksi Retribusi
@endsection

<head>
    <link rel=”stylesheet” href="{{asset('swal/sweetalert.css')}}">
    <script src="{{asset('swal/sweetalert.js')}}"></script>
</head>

@section('content')
<div class="row">
    <div class="col">
        <div class="card bg-secondary shadow">
            <div class="card-header bg-white border-0">
                <div class="row align-items-center">
                    <div class="col-8">
                        <h3 class="mb-0">Form Tambah</h3>
                    </div>
                </div>
            </div>
            <div class="card-body">
                @csrf
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-control-label" for="input-nama">Nama Warga</label>
                            <select name="id_users" id="id_users" onChange="updateTagihan()" class="form-control">
                                <option value="">Pilih nama warga...</option>
                                @foreach($user as $u)
                                <option value="{{$u->id}}" @if (old('id_users')==$u->id )
                                    selected="selected"
                                    @endif>
                                    {{$u->nama}} - {{$u->nik}}</option>
                                @endforeach
                            </select>
                            <span class="text-danger error-id_users">Nama harus dipilih</span>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-control-label" for="input-nama">Nama Kolektor</label>
                            <input type="text" name="nama_kolektor" id="nama_kolektor"
                                class="form-control form-control-alternative" placeholder="Nama Kolektor"
                                value="{{ old('nama_kolektor')}}">
                            <span class="text-danger error-nama_kolektor">Nama kolektor harus diisi</span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-control-label" for="jumlah_tagihan">Jumlah Tagihan</label>
                            <input type="text" id="jumlah_tagihan" class="form-control form-control-alternative"
                                placeholder="Jumlah Tagihan" disabled>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-control-label" for="input-first-name">Bulan Tagihan</label>
                            <select name="bulan_tagihan" id="bulan_tagihan" class="form-control">
                                <option value="">Pilih bulan...</option>
                                <option value="Januari" @if (old('bulan_tagihan') !='' ) selected="selected" @endif>
                                    Januari</option>
                                <option value="Februari" @if (old('bulan_tagihan') !='' ) selected="selected" @endif>
                                    Februari</option>
                                <option value="Maret" @if (old('bulan_tagihan') !='' ) selected="selected" @endif>
                                    Maret</option>
                                <option value="April" @if (old('bulan_tagihan') !='' ) selected="selected" @endif>
                                    April</option>
                                <option value="Mei" @if (old('bulan_tagihan') !='' ) selected="selected" @endif>
                                    Mei</option>
                                <option value="Juni" @if (old('bulan_tagihan') !='' ) selected="selected" @endif>
                                    Juni</option>
                                <option value="Juli" @if (old('bulan_tagihan') !='' ) selected="selected" @endif>
                                    Juli</option>
                                <option value="Agustus" @if (old('bulan_tagihan') !='' ) selected="selected" @endif>
                                    Agustus</option>
                                <option value="September" @if (old('bulan_tagihan') !='' ) selected="selected" @endif>
                                    September</option>
                                <option value="Oktober" @if (old('bulan_tagihan') !='' ) selected="selected" @endif>
                                    Oktober</option>
                                <option value="November" @if (old('bulan_tagihan') !='' ) selected="selected" @endif>
                                    November</option>
                                <option value="Desember" @if (old('bulan_tagihan') !='' ) selected="selected" @endif>
                                    Desember</option>
                            </select>
                            <span class="text-danger error-bulan_tagihan">Bulan tagihan harus diisi</span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-control-label" for="input-first-name">Tanggal
                                Transaksi</label>
                            <input type="date" name="tanggal_transaksi" id="tanggal_transaksi"
                                class="form-control form-control-alternative" placeholder="Tanggal Transaksi"
                                value="{{ old('tanggal_transaksi')}}">
                            <span class="text-danger error-tanggal_transaksi">Tanggal harus diisi</span>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-control-label" for="input-first-name">Keterangan</label>
                            <select name="keterangan" id="keterangan" class="form-control form-control-alternative"
                                placeholder="Keterangan pembayaran">
                                <option value="">Pilih...</option>
                                <option value="sudah_bayar" @if (old('keterangan')=='sudah_bayar' ) selected="selected"
                                    @endif>
                                    sudah bayar</option>
                                <option value="belum_bayar" @if (old('keterangan')=='belum_bayar' ) selected="selected"
                                    @endif>belum bayar</option>
                            </select>
                            <span class="text-danger error-keterangan">Keterangan harus diisi</span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <button class="btn btn-success" type="submit" onClick="tambah()">Tambah</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .error-id_users,
    .error-nama_kolektor,
    .error-bulan_tagihan,
    .error-tanggal_transaksi,
    .error-keterangan {
        display: none;
    }

</style>
@endsection

@push('script')
<script type="text/javascript">
    function updateTagihan() {
        let user = $('#id_users').val()
        if (user != '' && user != null) {
            $.ajax({
                url: "{{url('')}}/admin/get-tagihan/" + user,
                success: function (res) {
                    $.each(res, function (index, tagihan) {
                        $('#jumlah_tagihan').val(tagihan.harga_retribusi)
                    })
                },
            });
        }
    }

    function tambah() {
        var id_users = $('#id_users').val()
        var nama_kolektor = $('#nama_kolektor').val()
        var bulan_tagihan = $('#bulan_tagihan').val()
        var tanggal_transaksi = $('#tanggal_transaksi').val()
        var keterangan = $('#keterangan').val()
        var alamat = $('#alamat').val()
        var jumlah_tagihan = $('#jumlah_tagihan').val()
        var error = false;

        if (id_users === '') {
            error = true;
            $('.error-id_users').show()
        }

        if (nama_kolektor === '') {
            error = true;
            $('.error-nama_kolektor').show()
        }

        if (bulan_tagihan === '') {
            error = true;
            $('.error-bulan_tagihan').show()
        }

        if (tanggal_transaksi === '') {
            error = true;
            $('.error-tanggal_transaksi').show()
        }

        if (keterangan === '') {
            error = true;
            $('.error-keterangan').show()
        }

        if (!error) {
            $.ajax({
                url: "{{route('retribusi.store')}}",
                method: 'post',
                data: {
                    "_token": "{{ csrf_token() }}",
                    id_users: id_users,
                    nama_kolektor: nama_kolektor,
                    jumlah_tagihan: jumlah_tagihan,
                    bulan_tagihan: bulan_tagihan,
                    tanggal_transaksi: tanggal_transaksi,
                    keterangan: keterangan,
                    alamat: alamat
                },
                success: function (res) {
                    Swal.fire({
                        title: 'Berhasil!',
                        text: 'Data berhasil di tambahkan!',
                        icon: 'success',
                    }).then((result) => {
                        if (result.value) {
                            window.location.href = "/admin/retribusi"
                        }
                    });
                },
                error: function (xhr, status, error) {
                    var err = eval("(" + xhr.responseText + ")");
                    var text = err.errors;
                    var msg0 = ' ';

                    if (text.nama_kolektor) {
                        msg0 = text.nama_kolektor[0];
                    }

                    Swal.fire({
                        title: 'Gagal!',
                        text: msg0,
                        icon: 'warning',
                    });
                }
            })
        }
    }

    $('#id_users').select2({
        allowClear: true,
        placeholder: "Pilih nama warga...",
        theme: 'bootstrap4',
    });
    $('#bulan_tagihan').select2({
        allowClear: true,
        placeholder: "Pilih bulan...",
        theme: 'bootstrap4',
    });
    $('#keterangan').select2({
        allowClear: true,
        placeholder: "Pilih keterangan...",
        theme: 'bootstrap4',
    });

</script>
@endpush
