@extends('backend.layout.master')
@section('title')
Edit Data Transaksi Bank Sampah
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
                        <h3 class="mb-0">Form Edit</h3>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <input type="hidden" id="id" value="{{$transaksi->id}}">
                <input type="hidden" id="id_bank" value="{{$transaksi->id_bank_sampah}}">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-control-label" for="input-nama">Bank Sampah</label>
                            <select name="id_users" id="id_users" class="form-control">
                                <option value="">Pilih nama bank sampah...</option>
                                @foreach($user as $u)
                                <option value="{{$u->id}}" {{ $u->id == $transaksi->id_users ? 'selected' : '' }}>
                                    {{$u->nama}}</option>
                                @endforeach
                            </select>
                            <span class="text-danger error-users">Pilih salah satu</span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-control-label" for="input-nama">Tanggal Transaksi</label>
                            <input type="date" id="tanggal_transaksi" class="form-control form-control-alternative"
                                placeholder="Tanggal Transaksi" value="{{$transaksi->tanggal_transaksi}}">
                            <span class="text-danger error-tanggal">Tanggal transaksi harus diisi</span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-control-label" for="input-nama">Keterangan</label>
                            <input type="text" name="keterangan" id="keterangan"
                                class="form-control form-control-alternative" placeholder="Keterangan"
                                value="{{$transaksi->keterangan}}">
                            <span class="text-danger error-keterangan">Keterangan harus diisi</span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-control-label" for="input-first-name">Jenis Sampah</label>
                            <select name="id_konversi" id="id_konversi" class="form-control"
                                onChange="updateKonversi()">
                                <option value="">Pilih nama bank sampah...</option>
                                @foreach($konversi as $k)
                                <option value="{{$k->id}}" {{ $k->id == $transaksi->id_konversi ? 'selected' : '' }}>
                                    {{$k->jenis_sampah}}</option>
                                @endforeach
                            </select>
                            <span class="text-danger error-konversi">Pilih salah satu</span>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-control-label" for="input-first-name">Berat</label>
                            <input type="number" name="berat" id="berat" class="form-control form-control-alternative"
                                placeholder="Jenis Sampah" value="{{$transaksi->berat}}" onChange="updateKonversi()">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-control-label" for="input-first-name">Harga Total</label>
                            <input type="text" name="harga_total" id="harga_total"
                                class="form-control form-control-alternative" placeholder="Jenis Sampah"
                                value="{{$transaksi->harga_total}}" disabled>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <button class="btn btn-success" onClick="ubah()" type="submit">Ubah</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .error-users,
    .error-tanggal,
    .error-keterangan,
    .error-konversi,
    .error-berat,
    .error-total {
        display: none;
    }

</style>
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

    function ubah() {
        var user = $('#id_users').val()
        var tanggal = $('#tanggal_transaksi').val()
        var keterangan = $('#keterangan').val()
        var konversi = $('#id_konversi').val()
        var berat = $('#berat').val()
        var total = $('#harga_total').val()
        var id = $('#id').val()
        var id_bank = $('#id_bank').val()
        var error = false;

        if (user === '') {
            error = true;
            $('.error-users').show()
        }

        if (tanggal === '') {
            error = true;
            $('.error-tanggal').show()
        }

        if (konversi === '') {
            error = true;
            $('.error-konversi').show()
        }

        if (!error) {
            $.ajax({
                url: "/admin/transaksi/" + id,
                method: 'post',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "_method": "PUT",
                    id_users: user,
                    tanggal_transaksi: tanggal,
                    keterangan: keterangan,
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
                            window.location.href = "/admin/detail-transaksi/" + id_bank
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
    }

</script>

@push('script')
<script type="text/javascript">
    $('#id_users').select2({
        allowClear: true,
        placeholder: "Pilih nama...",
        theme: 'bootstrap4',
    });

</script>
@endpush
