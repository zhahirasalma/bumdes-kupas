@extends('backend.layout.master')
@section('title')
Edit Data Transaksi Retribusi
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
                    <form action="{{route('retribusi.update', $retribusi->id)}}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="pl-lg-4">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-nama">Nama Warga</label>
                                        <select name="id_users" id="id_users" class="form-control"
                                            onChange="updateTagihan()">
                                            <option value="">Pilih nama warga...</option>
                                            @foreach($user as $u)
                                            <option value="{{$u->id}}"
                                                {{ $u->id == $retribusi->id_users ? 'selected' : '' }}>
                                                {{$u->nama}}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('id_users'))
                                        <span class="text-danger">{{ $errors->first('id_users') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-nama">Nama Kolektor</label>
                                        <input type="text" name="nama_kolektor"
                                            class="form-control form-control-alternative" placeholder="Nama Kolektor"
                                            value="{{$retribusi->nama_kolektor}}">
                                        @if ($errors->has('nama_kolektor'))
                                        <span class="text-danger">{{ $errors->first('nama_kolektor') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-nama">Jumlah Tagihan</label>
                                        <input type="text" id="jumlah_tagihan"
                                            class="form-control form-control-alternative" placeholder="Jumlah Tagihan"
                                            value="{{$retribusi->jumlah_tagihan}}" disabled>
                                        @if ($errors->has('jumlah_tagihan'))
                                        <span class="text-danger">{{ $errors->first('jumlah_tagihan') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-first-name">Bulan Tagihan</label>
                                        <select name="bulan_tagihan" id="bulan_tagihan" class="form-control">
                                            <option value="">Pilih bulan...</option>
                                            <option value="Januari"
                                                {{ $retribusi->bulan_tagihan == "Januari" ? 'selected' : '' }}>
                                                Januari</option>
                                            <option value="Februari"
                                                {{ $retribusi->bulan_tagihan == "Februari" ? 'selected' : '' }}>
                                                Februari</option>
                                            <option value="Maret"
                                                {{ $retribusi->bulan_tagihan == "Maret" ? 'selected' : '' }}>
                                                Maret</option>
                                            <option value="April"
                                                {{ $retribusi->bulan_tagihan == "April" ? 'selected' : '' }}>
                                                April</option>
                                            <option value="Mei"
                                                {{ $retribusi->bulan_tagihan == "Mei" ? 'selected' : '' }}>
                                                Mei</option>
                                            <option value="Juni"
                                                {{ $retribusi->bulan_tagihan == "Juni" ? 'selected' : '' }}>
                                                Juni</option>
                                            <option value="Juli"
                                                {{ $retribusi->bulan_tagihan == "Juli" ? 'selected' : '' }}>
                                                Juli</option>
                                            <option value="Agustus"
                                                {{ $retribusi->bulan_tagihan == "Agustus" ? 'selected' : '' }}>
                                                Agustus</option>
                                            <option value="September"
                                                {{ $retribusi->bulan_tagihan == "September" ? 'selected' : '' }}>
                                                September</option>
                                            <option value="Oktober"
                                                {{ $retribusi->bulan_tagihan == "Oktober" ? 'selected' : '' }}>
                                                Oktober</option>
                                            <option value="November"
                                                {{ $retribusi->bulan_tagihan == "November" ? 'selected' : '' }}>
                                                November</option>
                                            <option value="Desember"
                                                {{ $retribusi->bulan_tagihan == "Desember" ? 'selected' : '' }}>
                                                Desember</option>
                                        </select>
                                        @if ($errors->has('bulan_tagihan'))
                                        <span class="text-danger">{{ $errors->first('bulan_tagihan') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-first-name">Tanggal
                                            Transaksi</label>
                                        <input type="date" name="tanggal_transaksi"
                                            class="form-control form-control-alternative"
                                            placeholder="Tanggal Transaksi" value="{{$retribusi->tanggal_transaksi}}">
                                        @if ($errors->has('tanggal_transaksi'))
                                        <span class="text-danger">{{ $errors->first('tanggal_transaksi') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-first-name">Keterangan</label>
                                        <select name="keterangan" class="form-control form-control-alternative"
                                            placeholder="Keterangan pembayaran">
                                            <option value="">Pilih...</option>
                                            <option value="sudah_bayar"
                                                {{ $retribusi->keterangan == 'sudah_bayar' ? 'selected' : '' }}>
                                                sudah bayar</option>
                                            <option value="belum_bayar"
                                                {{ $retribusi->keterangan == 'belum_bayar' ? 'selected' : '' }}>belum
                                                bayar
                                            </option>
                                        </select>
                                        @if ($errors->has('keterangan'))
                                        <span class="text-danger">{{ $errors->first('keterangan') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="pl-lg-4">
                            <div class="form-group">
                                <label>Alamat</label>
                                <textarea name="alamat" rows="4" class="form-control form-control-alternative"
                                    placeholder="Alamat">{{$retribusi->alamat}}</textarea>
                                @if ($errors->has('alamat'))
                                <span class="text-danger">{{ $errors->first('alamat') }}</span>
                                @endif
                            </div>
                            <button class="btn btn-success" type="submit">Ubah</button>
                        </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
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

</script>
@endpush
