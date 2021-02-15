@extends('backend.layout.master')
@section('title')
Tambah Data Warga
@endsection


@section('content')
<div class="col-xl-12">
    <div class="card bg-secondary shadow">
        <div class="card-header bg-white border-0">
            <div class="col-8">
                <h3 class="mb-0">Form Tambah</h3>
            </div>
        </div>
        <div class="row align-items-center">
            <div class="card-body">
                <form action="{{route('warga.store')}}" method="POST">
                    @csrf
                    <div class="pl-lg-4">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-nama">NIK</label>
                                    <input type="text" name="NIK" class="form-control form-control-alternative"
                                        placeholder="NIK" value="{{ old('NIK')}}">
                                    @if ($errors->has('NIK'))
                                    <span class="text-danger">{{ $errors->first('NIK') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-nama">Nama</label>
                                    <select name="id_users" class="form-control">
                                        <option value="">Pilih nama warga...</option>
                                        @foreach($user as $u)
                                        <option value="{{$u->id}}" @if (old('id_users')==$u->id ) selected="selected"
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
                                    <label class="form-control-label" for="input-nama">Kategori</label>
                                    <select name="id_kategori_sampah" class="form-control">
                                        <option value="">Pilih kategori...</option>
                                        @foreach($kategori as $k)
                                        <option value="{{$k->id}}" @if (old('id_kategori_sampah')==$k->id )
                                            selected="selected" @endif>{{$k->jenis_sampah}}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('id_kategori_sampah'))
                                    <span class="text-danger">{{ $errors->first('id_kategori_sampah') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-first-name">No Telepon</label>
                                    <input type="text" name="no_telp" class="form-control form-control-alternative"
                                        placeholder="No Telepon" value="{{ old('no_telp')}}">
                                    @if ($errors->has('no_telp'))
                                    <span class="text-danger">{{ $errors->first('no_telp') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-city">Kota</label>
                                    <select name="id_kota" class="form-control">
                                        <option value="">Pilih kota/kabupaten...</option>
                                        @foreach($kota as $k)
                                        <option value="{{$k->id}}" @if (old('kota')==$k->id ) selected="selected"
                                            @endif>
                                            {{$k->kota}}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('id_kota'))
                                    <span class="text-danger">{{ $errors->first('id_kota') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-country">Kecamatan</label>
                                    <select name="id_kecamatan" class="form-control">
                                        <option value="">Pilih kecamatan...</option>
                                        @foreach($kecamatan as $kc)
                                        <option value="{{$kc->id}}" @if (old('kecamatan')==$kc->id ) selected="selected"
                                            @endif>
                                            {{$kc->kecamatan}}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('id_kecamatan'))
                                    <span class="text-danger">{{ $errors->first('id_kecamatan') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-city">Desa</label>
                                    <select name="id_desa" class="form-control">
                                        <option value="">Pilih desa...</option>
                                        @foreach($desa as $d)
                                        <option value="{{$d->id}}" @if (old('desa')==$d->id ) selected="selected"
                                            @endif>
                                            {{$d->desa}}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('id_desa'))
                                    <span class="text-danger">{{ $errors->first('id_desa') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-country">Dukuh</label>
                                    <input type="text" name="dukuh" class="form-control form-control-alternative"
                                        placeholder="Dukuh" value="{{ old('dukuh')}}">
                                    @if ($errors->has('dukuh'))
                                    <span class="text-danger">{{ $errors->first('dukuh') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="pl-lg-4">
                        <div class="form-group">
                            <label class="form-control-label">Detail Alamat</label>
                            <textarea rows="4" name="detail_alamat" class="form-control form-control-alternative"
                                placeholder="Detail Alamat">{{ old('detail_alamat')}}</textarea>
                            @if ($errors->has('detail_alamat'))
                            <span class="text-danger">{{ $errors->first('detail_alamat') }}</span>
                            @endif
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-nama">Lokasi</label>
                                    <input type="text" name="lokasi" class="form-control form-control-alternative"
                                        placeholder="Lokasi" value="{{ old('lokasi')}}">
                                    @if ($errors->has('lokasi'))
                                    <span class="text-danger">{{ $errors->first('lokasi') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-success" type="submit">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
<script type="text/javascript">
    $('#kategori').select2({
        placeholder: 'Pilih...',
        ajax: {
            url: 'admin/cari',
            dataType: 'json',
            delay: 250,
            processResults: function (data) {
                return {
                    results: $.map(data, function (item) {
                        return {
                            text: item.jenis_sampah,
                            id: item.id
                        }
                    })
                };
            },
            cache: true
        }
    });

</script>
@endpush
