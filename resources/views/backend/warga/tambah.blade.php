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
                                    <label class="form-control-label" for="input-nama">Nama Contact Person</label>
                                    <input type="text" name="nama_cp" class="form-control form-control-alternative"
                                        placeholder="Nama Contact Person" value="{{ old('nama_cp')}}">
                                    @if ($errors->has('nama_cp'))
                                    <span class="text-danger">{{ $errors->first('nama_cp') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-first-name">No Telepon Contact
                                        Person</label>
                                    <input type="text" name="no_telp_cp" class="form-control form-control-alternative"
                                        placeholder="No Telepon Contact Person" value="{{ old('no_telp_cp')}}">
                                    @if ($errors->has('no_telp_cp'))
                                    <span class="text-danger">{{ $errors->first('no_telp_cp') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-city">Kota</label>
                                    <input type="text" name="kota" class="form-control form-control-alternative"
                                        placeholder="Kota" value="{{ old('kota')}}">
                                    @if ($errors->has('kota'))
                                    <span class="text-danger">{{ $errors->first('kota') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-country">Kecamatan</label>
                                    <input type="text" name="kecamatan" class="form-control form-control-alternative"
                                        placeholder="Kecamatan" value="{{ old('kecamatan')}}">
                                    @if ($errors->has('kecamatan'))
                                    <span class="text-danger">{{ $errors->first('kecamatan') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-city">Desa</label>
                                    <input type="text" name="desa" class="form-control form-control-alternative"
                                        placeholder="Desa" value="{{ old('desa')}}">
                                    @if ($errors->has('desa'))
                                    <span class="text-danger">{{ $errors->first('desa') }}</span>
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
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-city">RT</label>
                                    <input type="number" name="RT" class="form-control form-control-alternative"
                                        placeholder="RT" value="{{ old('RT')}}">
                                    @if ($errors->has('RT'))
                                    <span class="text-danger">{{ $errors->first('RT') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-country">RW</label>
                                    <input type="number" name="RW" class="form-control form-control-alternative"
                                        placeholder="RW" value="{{ old('RW')}}">
                                    @if ($errors->has('RW'))
                                    <span class="text-danger">{{ $errors->first('RW') }}</span>
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
