@extends('backend.layout.master')
@section('title')
Edit Data Bank Sampah
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
                <input type="hidden" id="id" value="{{$data->id}}">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label" for="input-nama">Nama</label>
                                <input type="text" id="nama" class="form-control form-control-alternative"
                                    placeholder="Nama" value="{{ $data->user->nama}}">
                                <span class="text-danger error-nama">Nama harus diisi</span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label" for="input-first-name">No Telepon</label>
                                <input type="text" id="no_telp" class="form-control form-control-alternative"
                                    placeholder="No Telepon" value="{{$data->no_telp}}">
                                <span class="text-danger error-no-telp">No telepon harus diisi</span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label" for="input-nama">Email</label>
                                <input type="email" id="email" class="form-control form-control-alternative"
                                    placeholder="Email" value="{{$data->user->email}}">
                                <span class="text-danger error-email">Email harus diisi</span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label" for="input-first-name">Password</label>
                                <input type="password" id="password" class="form-control form-control-alternative"
                                    placeholder="Password" value="{{$data->user->password}}">
                                    <span class="text-danger error-password">Password harus diisi</span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label" for="input-city">Kota</label>
                                <select name="id_kota" id="kota" onChange="updateKecamatan()" class="form-control"
                                    value="{{$data->kota->kota}}">
                                    <option value="">Pilih kota...</option>
                                    @foreach($kota as $kt)
                                    <option value="{{$kt->id}}" {{ $kt->id == $data->id_kota ? 'selected' : '' }}>
                                        {{$kt->kota}}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger error-kota">Pilih salah satu</span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label" for="input-country">Kecamatan</label>
                                <select name="id_kecamatan" id="kecamatan" onChange="updateDesa()" class="form-control"
                                    value="{{$data->kecamatan->kecamatan}}">
                                    <option value="">Pilih kecamatan...</option>
                                    @foreach($kecamatan as $kc)
                                    <option value="{{$kc->id}}" {{ $kc->id == $data->id_kecamatan ? 'selected' : '' }}>
                                        {{$kc->kecamatan}}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger error-kecamatan">Pilih salah satu</span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label" for="input-city">Desa</label>
                                <select name="id_desa" id="desa" class="form-control" value="{{$data->desa->desa}}">
                                    <option value="">Pilih desa...</option>
                                    @foreach($desa as $d)
                                    <option value="{{$d->id}}" {{ $d->id == $data->id_desa ? 'selected' : '' }}>
                                        {{$d->desa}}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger error-desa">Pilih salah satu</span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label" for="input-country">Dukuh</label>
                                <input type="text" id="dukuh" class="form-control form-control-alternative"
                                    placeholder="Kecamatan" value="{{$data->dukuh}}">
                                <span class="text-danger error-dukuh">Dukuh harus diisi</span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Detail Alamat</label>
                                <textarea rows="4" id="detail_alamat" class="form-control form-control-alternative"
                                    placeholder="Detail alamat">{{$data->detail_alamat}}</textarea>
                                <span class="text-danger error-alamat">Alamat harus diisi</span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <button class=" btn btn-success" onClick="ubah()" type="submit">Ubah</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    .error-nama,
    .error-no-telp,
    .error-email,
    .error-password,
    .error-kota,
    .error-kecamatan,
    .error-desa,
    .error-dukuh,
    .error-alamat {
        display: none;
    }
</style>
@endsection

@push('script')
<script type="text/javascript">
    function ubah() {
        var nama = $('#nama').val()
        var no_telp = $('#no_telp').val()
        var email = $('#email').val()
        var password = $('#password').val()
        var kota = $('#kota').val()
        var kecamatan = $('#kecamatan').val()
        var desa = $('#desa').val()
        var dukuh = $('#dukuh').val()
        var detail_alamat = $('#detail_alamat').val()
        var id = $('#id').val()
        var error = false;

        if (nama === '') {
            error = true;
            $('.error-nama').show()
        }
        
        if (no_telp === '') {
            error = true;
            $('.error-no-telp').show()
        }

        if (email === '') {
            error = true;
            $('.error-email').show()
        }

        if (password === '') {
            error = true;
            $('.error-password').show()
        }

        
        if (kota === '') {
            error = true;
            $('.error-kota').show()
        }

        if (kecamatan === '') {
            error = true;
            $('.error-kecamatan').show()
        }

        if (desa === '') {
            error = true;
            $('.error-desa').show()
        }

        if (dukuh === '') {
            error = true;
            $('.error-dukuh').show()
        }

        if (detail_alamat === '') {
            error = true;
            $('.error-alamat').show()
        }
        if (!error) {
            $.ajax({
                url: "/admin/bank_sampah/" + id,
                method: 'post',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "_method": "PUT",
                    nama: nama,
                    no_telp: no_telp,
                    email: email,
                    password: password,
                    id_kota: kota,
                    id_kecamatan: kecamatan,
                    id_desa: desa,
                    dukuh: dukuh,
                    detail_alamat: detail_alamat,
                },
                success: function (res) {
                    Swal.fire({
                        title: 'Berhasil!',
                        text: 'Data berhasil di ubah!',
                        icon: 'success',
                        confirmButtonColor: "#3085d6",
                        confirmButtonText: "OK",
                    }).then((result) => {
                        if (result.value) {
                            window.location.href = "/admin/bank_sampah"
                        }
                    });
                },
                error: function (xhr, status, error) {
                    var err = eval("(" + xhr.responseText + ")");
                    var text = err.errors;
                    var msg0 = ' '
                    var msg1 = ' '
                    var msg2 = ' '
                    var msg3 = ' '
                    var msg4 = ' '


                    if (text.nama) {
                        msg1 = text.nama[0] + '<br>';
                    }

                    if (text.email) {
                        msg2 = text.email[0] + '<br>';
                    }

                    if (text.password) {
                        msg3 = text.password[0] + '<br>';
                    }

                    if (text.no_telp) {
                        msg4 = text.no_telp[0] + '<br>';
                        console.log(text)
                    }

                    Swal.fire({
                        title: 'Gagal!',
                        html: msg0 + msg1 + msg2 + msg3 + msg4,
                        icon: 'warning',
                    });
                }
            })
        }
    };

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
