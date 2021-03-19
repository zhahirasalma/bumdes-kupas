@extends('backend.layout.master')
@section('title')
Tambah Data Transaksi Bank Sampah
@endsection

@section('content')
<div class="row">
    <div class="col">
        <div class="card bg-secondary shadow">
            <div class="card-header bg-white border-0">
                <div class="row align-items-center">
                    <div class="col-8">
                        <h3 class="mb-0">Form Tambah</h3>
                    </div>
                    <div class="col text-right">
                        <button type="submit" id="button-tambah" onClick="kirimData()"
                            class="btn btn-success">Tambah</button>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form id="form" action="{{route('transaksi.store')}}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label" for="input-nama">Bank Sampah</label>
                                <select name="id_users" id="id_users" class="form-control">
                                    <option value="">Pilih nama bank sampah...</option>
                                    @foreach($user as $u)
                                    <option value="{{$u->id}}" @if (old('id_users')==$u->id )
                                        selected="selected"
                                        @endif>
                                        {{$u->nama}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('id_users'))
                                <span class="text-danger">{{ $errors->first('id_users') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label" for="input-nama">Tanggal Transaksi</label>
                                <input type="date" name="tanggal_transaksi" id="tanggal_transaksi"
                                    class="form-control form-control-alternative" placeholder="Tanggal Transaksi"
                                    value="{{old('tanggal_transaksi')}}">
                                @if ($errors->has('tanggal_transaksi'))
                                <span class="text-danger">{{ $errors->first('tanggal_transaksi') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label" for="input-nama">Keterangan</label>
                                <input type="text" name="keterangan" id="keterangan"
                                    class="form-control form-control-alternative" placeholder="Keterangan"
                                    value="{{old('keterangan')}}">
                                @if ($errors->has('keterangan'))
                                <span class="text-danger">{{ $errors->first('keterangan') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <label class="form-control-label" for="input-nama">Deskripsi Sampah</label>
                    <div id="deskripsi">
                        <div class="row align-items-center">
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <select name="id_konversi" id="id_konversi_0" class="form-control"
                                        onChange="updateHarga(0)">
                                        <option value="">Pilih jenis sampah...</option>
                                        @foreach($konversi as $k)
                                        <option value="{{$k->id}},{{$k->harga_konversi}}">
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
                                    <input type="number" name="berat" id="berat_0"
                                        class="form-control form-control-alternative" placeholder="Berat Sampah"
                                        value="1" onChange="updateHarga(0)">
                                    @if ($errors->has('berat'))
                                    <span class="text-danger">{{ $errors->first('berat') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <input type="text" name="harga_total" id="harga_total_0"
                                        class="form-control form-control-alternative" placeholder="Harga total" value=""
                                        disabled>
                                </div>
                            </div>
                            <div class="col-lg-3 ">
                                <div class="form-group">
                                    <button type="button" class="btn btn-success" id="tambah" onClick="add()"><i
                                            class="fas fa-plus"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

<script type="text/javascript">
    var i = 0;

    function sembunyi(id) {
        var row = '#' + id
        $(row).hide()
    };

    function add() {
        i++
        $('#deskripsi').append(`<div  id="row_${i}" class="row align-items-center">
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
        var user = $('#id_users').val()
        var tanggal = $('#tanggal_transaksi').val()
        var keterangan = $('#keterangan').val()
        var row = []
        var kirim = {
            user: user,
            tanggal: tanggal,
            keterangan: keterangan
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
            url: "/admin/transaksi",
            type: "POST",
            data: {
                "_token": "{{ csrf_token() }}",
                id_users: user,
                tanggal_transaksi: tanggal,
                keterangan: keterangan,
                row: row
            },
            success: function (response) {
                window.location.href = "/admin/transaksi"
            },
        });
    };

    function updateHarga(id) {
        var harga = $('#id_konversi_' + id).val()
        var x = harga.split(",")
        var updateharga = x[1]
        total = updateharga * $('#berat_' + i).val();
        $('#harga_total_' + i).val(total)
    };

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
