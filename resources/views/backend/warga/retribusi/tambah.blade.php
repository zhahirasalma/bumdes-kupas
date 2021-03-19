@extends('backend.layout.master')
@section('title')
Tambah Data Transaksi Retribusi
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
                </div>
            </div>
            <div class="card-body">
                <form action="{{route('retribusi.store')}}" method="POST">
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
                                <input type="text" name="nama_kolektor" class="form-control form-control-alternative"
                                    placeholder="Nama Kolektor" value="{{ old('nama_kolektor')}}">
                                @if ($errors->has('nama_kolektor'))
                                <span class="text-danger">{{ $errors->first('nama_kolektor') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label" for="jumlah_tagihan">Jumlah Tagihan</label>
                                <input type="text" id="jumlah_tagihan" class="form-control form-control-alternative"
                                    placeholder="Jumlah Tagihan" disabled>
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
                                    <option value="Januari" @if (old('bulan_tagihan') !='' ) selected="selected" @endif>
                                        Januari</option>
                                    <option value="Februari" @if (old('bulan_tagihan') !='' ) selected="selected"
                                        @endif>
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
                                    <option value="September" @if (old('bulan_tagihan') !='' ) selected="selected"
                                        @endif>
                                        September</option>
                                    <option value="Oktober" @if (old('bulan_tagihan') !='' ) selected="selected" @endif>
                                        Oktober</option>
                                    <option value="November" @if (old('bulan_tagihan') !='' ) selected="selected"
                                        @endif>
                                        November</option>
                                    <option value="Desember" @if (old('bulan_tagihan') !='' ) selected="selected"
                                        @endif>
                                        Desember</option>
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
                                <label class="form-control-label" for="input-first-name">Tanggal
                                    Transaksi</label>
                                <input type="date" name="tanggal_transaksi"
                                    class="form-control form-control-alternative" placeholder="Tanggal Transaksi"
                                    value="{{ old('tanggal_transaksi')}}">
                                @if ($errors->has('tanggal_transaksi'))
                                <span class="text-danger">{{ $errors->first('tanggal_transaksi') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label" for="input-first-name">Keterangan</label>
                                <select name="keterangan" id="keterangan" class="form-control form-control-alternative"
                                    placeholder="Keterangan pembayaran">
                                    <option value="">Pilih...</option>
                                    <option value="sudah_bayar" @if (old('keterangan')=='sudah_bayar' )
                                        selected="selected" @endif>
                                        sudah bayar</option>
                                    <option value="belum_bayar" @if (old('keterangan')=='belum_bayar' )
                                        selected="selected" @endif>belum bayar</option>
                                </select>
                                @if ($errors->has('keterangan'))
                                <span class="text-danger">{{ $errors->first('keterangan') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label">Alamat</label>
                                <textarea name="alamat" rows="4" class="form-control form-control-alternative"
                                    placeholder="Alamat">{{ old('alamat')}}</textarea>
                                @if ($errors->has('alamat'))
                                <span class="text-danger">{{ $errors->first('alamat') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <button class="btn btn-success" type="submit">Tambah</button>
                        </div>
                    </div>
                </form>
            </div>
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
    $('#keterangan').select2({
        allowClear: true,
        placeholder: "Pilih keterangan...",
        theme: 'bootstrap4',
    });

</script>
@endpush
