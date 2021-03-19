@extends('backend.layout.master')
@section('title')
Edit Data Transaksi Bank Sampah
@endsection

@section('content')
<div class="row">
    <div class="col">
        <div class="card bg-secondary shadow">
            <div class="card-header bg-white border-0">
                <div class="col-8">
                    <h3 class="mb-0">Form Edit</h3>
                </div>
            </div>
            <div class="row align-items-center">
                <div class="card-body">
                    <form action="{{route('transaksi.update', $transaksi->id)}}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="pl-lg-4">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-nama">Bank Sampah</label>
                                        <select name="id_users" id="id_users" class="form-control">
                                            <option value="">Pilih nama bank sampah...</option>
                                            @foreach($user as $u)
                                            <option value="{{$u->id}}"
                                                {{ $u->id == $transaksi->id_users ? 'selected' : '' }}>
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
                                        <input type="date" name="tanggal_transaksi"
                                            class="form-control form-control-alternative"
                                            placeholder="Tanggal Transaksi" value="{{$transaksi->tanggal_transaksi}}">
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
                                        <input type="text" name="keterangan"
                                            class="form-control form-control-alternative" placeholder="Keterangan"
                                            value="{{$transaksi->keterangan}}">
                                        @if ($errors->has('keterangan'))
                                        <span class="text-danger">{{ $errors->first('keterangan') }}</span>
                                        @endif
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
                                            <option value="{{$k->id}}"
                                                {{ $k->id == $transaksi->id_konversi ? 'selected' : '' }}>
                                                {{$k->jenis_sampah}}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('id_konversi'))
                                        <span class="text-danger">{{ $errors->first('id_konversi') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-first-name">Berat</label>
                                        <input type="number" name="berat" id="berat"
                                            class="form-control form-control-alternative" placeholder="Jenis Sampah"
                                            value="{{$transaksi->berat}}" onChange="updateKonversi()">
                                        @if ($errors->has('berat'))
                                        <span class="text-danger">{{ $errors->first('berat') }}</span>
                                        @endif
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
                            <button class="btn btn-success" type="submit">Ubah</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
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
