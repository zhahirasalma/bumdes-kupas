@extends('frontend.layout.master')
@section('title')
Registrasi Bank Sampah
@endsection
@section('content')

<header class="masthead bg-primary text-secondary text-center">
    <div class="container">
        <!-- Contact Section Heading-->
        <h3 class="page-section-sub-heading text-center text-uppercase text-secondary mb-0">Pendaftaran Bank Sampah
        </h3>
        <!-- Icon Divider-->
        <div class="divider-custom">
            <div class="divider"></div>
        </div>
        <!-- Contact Section Form-->
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <form method="POST" action="{{route('store_bank_sampah')}}">
                    @csrf
                    <form id="contactForm" name="sentMessage" novalidate="novalidate">
                        <div class="col-lg-16">
                            <div class="form-group">
                                <!-- <label>Name</label> -->
                                <input class="form-control @error('nama') is-invalid @enderror" name="nama" id="nama" 
                                    type="text" placeholder="Nama" value="{{ old('nama')}}"/>
                                @error('nama')
                                <span class="text-danger">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-16">
                            <div class="form-group">
                                <!-- <label>Nomor Telepon</label> -->
                                <input class="form-control" name="no_telp" id="no_telp" type="tel"
                                    placeholder="Nomor Telepon Warga" value="{{ old('no_telp')}}" />
                                <p class="help-block text-danger"></p>
                                @error('no_telp')
                                <span class="text-danger">
                                    <strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-16">
                            <div class="form-group">
                                <input class="form-control" name="email" id="email" type="email" placeholder="Email" value="{{ old('email')}}"/>
                                <p class="help-block text-danger"></p>
                                @error('email')
                                <span class="text-danger">
                                    <strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-16">
                            <div class="form-group">
                                <input class="form-control" name="password" id="password" type="password" placeholder="Kata Sandi"/>
                                <p class="help-block text-danger"></p>
                                @error('password')
                                <span class="text-danger">
                                    <strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-16">
                            <div class="form-group">
                                <select class="form-control" name="id_kota" onChange="updateKecamatan()" id="id_kota">
                                    <option value="">Pilih kota...</option>
                                    @foreach($kota as $kota)
                                    <option value="{{$kota->id}}" @if (old('id_kota')==$kota->id ) selected="selected"
                                        @endif>
                                        {{$kota->kota}}</option>
                                    @endforeach
                                </select>
                                @error('id_kota')
                                <span class="text-danger">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-16">
                            <div class="form-group">
                                <select class="form-control" onChange="updateDesa()" name="id_kecamatan" id="id_kecamatan">
                                    <option value="">Pilih kecamatan...</option>
                                </select>
                                @error('id_kecamatan')
                                <span class="text-danger">
                                    <strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6 sol-sm-12">
                                <select class="form-control" name="id_desa" id="id_desa">
                                    <option value="">Pilih desa...</option>
                                </select>
                                @error('id_desa')
                                <span class="text-danger">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group col-md-6 sol-sm-12">
                                <input class="form-control" name="dukuh" id="dukuh" type="text" placeholder="Dukuh" value="{{ old('dukuh')}}" />
                                <p class="help-block text-danger"></p>
                                @error('dukuh')
                                <span class="text-danger">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-16">
                            <div class="form-group">
                                <textarea class="form-control" name="detail_alamat" id="message" rows="3"
                                    placeholder="Masukkan Detail Alamat" value="{{ old('detail_alamat')}}"></textarea>
                                <p class="help-block text-danger"></p>
                                @error('detail_alamat')
                                <span class="text-danger">
                                    <strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-16">
                            <div class="form-group">
                            <select id="jenis_transaksi" name="jenis_transaksi" class="form-control form-control-alternative" 
                                placeholder="Pilih jenis transaksi">
                                <option value="">Pilih jenis transaksi...</option>
                                <option value="tabungan_emas" @if (old('jenis_transaksi')=='tabungan_emas' ) selected="selected" @endif>
                                    Tabungan Emas</option>
                                <option value="sedekah_sampah" @if (old('jenis_transaksi')=='sedekah_sampah' ) selected="selected" @endif>
                                    Sedekah Sampah
                                </option>
                            </select>
                                <p class="help-block text-danger"></p>
                                @error('jenis_transaksi')
                                <span class="text-danger">
                                    <strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>
                        <br />
                        <div id="success"></div>
                        <button type="submit" class="btn btn-primary btn-xl">
                            {{ __('Register') }}
                        </button>
                    </form>
                </form>
            </div>
        </div>
    </div>
</header>
@endsection

@push('script')
<script type="text/javascript">
    function updateKecamatan() {
        let kota = $("#id_kota").val()
        $("#id_kecamatan").children().remove();
        $("#id_kecamatan").val('');
        $("#id_kecamatan").append('<option value="">Pilih kecamatan...</option>');
        $("#id_kecamatan").prop('disabled', true)
        updateDesa();
        if (kota != '' && kota != null) {
            $.ajax({
                url: "{{url('')}}/admin/list-kecamatan/" + kota,
                success: function (res) {
                    $("#id_kecamatan").prop('disabled', false)
                    let tampilan_option = '';
                    $.each(res, function (index, kecamatan) {
                        tampilan_option +=
                            `<option value="${kecamatan.id}">${kecamatan.kecamatan}</option>`
                    })
                    $("#id_kecamatan").append(tampilan_option);
                },
            });
        }
    }

    function updateDesa() {
        let kecamatan = $("#id_kecamatan").val()
        $("#id_desa").children().remove();
        $("#id_desa").val('');
        $("#id_desa").append('<option value="">Pilih desa...</option>');
        $("#id_desa").prop('disabled', true)
        if (kecamatan != '' && kecamatan != null) {
            $.ajax({
                url: "{{url('')}}/admin/list-desa/" + kecamatan,
                success: function (res) {
                    $("#id_desa").prop('disabled', false)
                    let tampilan_option = '';
                    $.each(res, function (index, desa) {
                        tampilan_option += `<option value="${desa.id}">${desa.desa}</option>`
                    })
                    $("#id_desa").append(tampilan_option);
                },
            });
        }
    }

    $(document).ready(function () {
        $('#id_kota').select2({
            allowClear: true,
            placeholder: "Pilih kota/kabupaten...",
            theme: 'bootstrap4',
        });
    })

    $(document).ready(function () {
        $('#id_kecamatan').select2({
            allowClear: true,
            placeholder: "Pilih kecamatan...",
            theme: 'bootstrap4',
        });
    })
    $(document).ready(function () {
        $('#id_desa').select2({
            allowClear: true,
            placeholder: "Pilih desa...",
            theme: 'bootstrap4',
        });
    })

</script>

@endpush
