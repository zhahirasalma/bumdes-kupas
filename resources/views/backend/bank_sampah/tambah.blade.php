@extends('backend.layout.master')
@section('title')
Tambah Bank Sampah
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
                <form action="{{route('bank_sampah.store')}}" method="POST">
                    @csrf
                    <div class="pl-lg-4">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-nama">Nama</label>
                                    <select name="id_users" id="id_users" class="form-control">
                                        <option value="">Pilih nama bank sampah...</option>
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
                                    <select name="id_kota" id="kota" onChange="updateKecamatan()" class="form-control">
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
                                    <select name="id_kecamatan" id="kecamatan" onChange="updateDesa()"
                                        class="form-control" disabled>
                                        <option value="">Pilih kecamatan...</option>
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
                                    <label class="form-control-label" for="input-country">Desa</label>
                                    <select name="id_desa" id="desa" class="form-control" disabled>
                                        <option value="">Pilih desa...</option>
                                    </select>
                                    @if ($errors->has('id_desa'))
                                    <span class="text-danger">{{ $errors->first('id_desa') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-city">Dukuh</label>
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
                            <label>Detail Alamat</label>
                            <textarea rows="4" name="detail_alamat" class="form-control form-control-alternative"
                                placeholder="Detail Alamat">{{ old('detail_alamat')}}</textarea>
                            @if ($errors->has('detail_alamat'))
                            <span class="text-danger">{{ $errors->first('detail_alamat') }}</span>
                            @endif
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
    function updateKecamatan() {
        let kota = $("#kota").val()
        $("#kecamatan").children().remove();
        $("#kecamatan").val('');
        $("#kecamatan").append('<option value="">Pilih kecamatan...</option>');
        $("#kecamatan").prop('disabled', true)
        updateDesa();
        if (kota != '' && kota != null) {
            $.ajax({
                url: "{{url('')}}/admin/list-kecamatan/" + kota,
                success: function (res) {
                    $("#kecamatan").prop('disabled', false)
                    let tampilan_option = '';
                    $.each(res, function (index, kecamatan) {
                        tampilan_option +=
                            `<option value="${kecamatan.id}">${kecamatan.kecamatan}</option>`
                    })
                    $("#kecamatan").append(tampilan_option);
                },
            });
        }
    }

    function updateDesa() {
        let kecamatan = $("#kecamatan").val()
        $("#desa").children().remove();
        $("#desa").val('');
        $("#desa").append('<option value="">Pilih desa...</option>');
        $("#desa").prop('disabled', true)
        if (kecamatan != '' && kecamatan != null) {
            $.ajax({
                url: "{{url('')}}/admin/list-desa/" + kecamatan,
                success: function (res) {
                    $("#desa").prop('disabled', false)
                    let tampilan_option = '';
                    $.each(res, function (index, desa) {
                        tampilan_option += `<option value="${desa.id}">${desa.desa}</option>`
                    })
                    $("#desa").append(tampilan_option);
                },
            });
        }
    }

    $('#id_users').select2({
        allowClear: true,
        placeholder: "Pilih nama bank sampah...",
        theme: 'bootstrap4',
    });

    $('#kota').select2({
        allowClear: true,
        placeholder: "Pilih kota/kabupaten...",
        theme: 'bootstrap4',
    });

    $('#kecamatan').select2({
        allowClear: true,
        placeholder: "Pilih kecamatan...",
        theme: 'bootstrap4',
    });

    $('#desa').select2({
        allowClear: true,
        placeholder: "Pilih desa...",
        theme: 'bootstrap4',
    })

</script>
@endpush
