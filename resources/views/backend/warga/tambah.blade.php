@extends('backend.layout.master')
@section('title')
Tambah Data Warga
@endsection

<head>
    <link rel=”stylesheet” href="{{asset('swal/sweetalert.css')}}">
    <script src="{{asset('swal/sweetalert.js')}}"></script>
    <!-- leaflet css  -->
    <link rel="stylesheet" href="{{asset('leaflet/leaflet.css')}}" />
    <style>
        /* ukuran peta */
        #mapid {
            height: 50%;
        }

    </style>
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
                @csrf
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-control-label" for="input-nama">NIK</label>
                            <input type="text" id="NIK" class="form-control form-control-alternative" placeholder="NIK"
                                value="{{ old('NIK')}}">
                            <span class="text-danger error-nik">NIK harus diisi</span>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-control-label" for="input-nama">Nama</label>
                            <input type="text" id="nama" class="form-control form-control-alternative"
                                placeholder="Nama" value="{{ old('nama')}}">
                            <span class="text-danger error-nama">Nama harus diisi</span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-control-label" for="input-nama">Email</label>
                            <input type="email" id="email" class="form-control form-control-alternative"
                                placeholder="Email" value="{{ old('email')}}">
                            <span class="text-danger error-email">Email harus diisi</span>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-control-label" for="input-first-name">Password</label>
                            <input type="password" id="password" class="form-control form-control-alternative"
                                placeholder="Password" value="{{ old('password')}}">
                            <span class="text-danger error-password">Password harus diisi</span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-control-label" for="input-nama">Kategori</label>
                            <select name="id_kategori_sampah" id="kategori" class="form-control">
                                <option></option>
                                @foreach($kategori as $k)
                                <option value="{{$k->id}}" @if (old('id_kategori_sampah')==$k->id )
                                    selected="selected" @endif>{{$k->jenis_sampah}}</option>
                                @endforeach
                            </select>
                            <span class="text-danger error-kategori">Pilih salah satu</span>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-control-label" for="input-first-name">No Telepon</label>
                            <input type="text" id="no_telp" class="form-control form-control-alternative"
                                placeholder="No Telepon" value="{{ old('no_telp')}}">
                            <span class="text-danger error-no-telp">No telepon harus diisi</span>
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
                            <span class="text-danger error-kota">Pilih salah satu</span>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-control-label" for="input-country">Kecamatan</label>
                            <select name="id_kecamatan" onChange="updateDesa()" id="kecamatan" class="form-control"
                                disabled>
                                <option value="">Pilih kecamatan...</option>
                            </select>
                            <span class="text-danger error-kecamatan">Pilih salah satu</span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-control-label" for="input-city">Desa</label>
                            <select name="id_desa" id="desa" class="form-control" disabled>
                                <option value="">Pilih desa...</option>
                            </select>
                            <span class="text-danger error-desa">Pilih salah satu</span>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-control-label" for="input-country">Dukuh</label>
                            <input type="text" id="dukuh" class="form-control form-control-alternative"
                                placeholder="Dukuh" value="{{ old('dukuh')}}">
                            <span class="text-danger error-dukuh">Dukuh harus diisi</span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-control-label">Detail Alamat</label>
                            <textarea rows="4" id="detail_alamat" class="form-control form-control-alternative"
                                placeholder="Detail Alamat">{{ old('detail_alamat')}}</textarea>
                            <span class="text-danger error-alamat">Alamat harus diisi</span>
                        </div>
                    </div>
                </div>
                <div class="row" style="display: none;">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-control-label" for="input-nama">Latitude</label>
                            <input type="text" id="lat" name="lat" class="form-control form-control-alternative"
                                placeholder="Lokasi" value="">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-control-label" for="input-nama">Longitude</label>
                            <input type="text" id="long" name="long" class="form-control form-control-alternative"
                                placeholder="Lokasi" value="">
                        </div>
                    </div>
                </div>
                <div>
                    <label class="form-control-label" for="input-nama">Lokasi</label>
                    <div class="row">
                        <div id="search" class="col-lg-4">
                            <input type="text" class="form-control form-control-alternative" name="addr" value=""
                                id="addr" size="58" placeholder="Cari lokasi">
                        </div>
                        <button class="btn btn-success" type="button" onclick="addr_search();">Cari</button>
                    </div> <br>
                    <div class="form-group">
                        <div id="mapid" style="height: 500px;"></div>
                        <span class="text">Klik pada peta untuk memilih</span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <button class="btn btn-success" onClick="tambah()" type="submit">Tambah</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .error-nik,
    .error-nama,
    .error-email,
    .error-password,
    .error-kategori,
    .error-no-telp,
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
<script src="{{asset('leaflet/leaflet.js')}}"></script>
<script type="text/javascript">
    function tambah() {
        var nik = $('#NIK').val()
        var nama = $('#nama').val()
        var email = $('#email').val()
        var password = $('#password').val()
        var kategori = $('#kategori').val()
        var no_telp = $('#no_telp').val()
        var kota = $('#kota').val()
        var kecamatan = $('#kecamatan').val()
        var desa = $('#desa').val()
        var dukuh = $('#dukuh').val()
        var detail_alamat = $('#detail_alamat').val()
        var latitude = $('#lat').val()
        var longitude = $('#long').val()
        var error = false;

        if (nik === '') {
            error = true;
            $('.error-nik').show()
        }

        if (nama === '') {
            error = true;
            $('.error-nama').show()
        }

        if (email === '') {
            error = true;
            $('.error-email').show()
        }

        if (password === '') {
            error = true;
            $('.error-password').show()
        }

        if (kategori === '') {
            error = true;
            $('.error-kategori').show()
        }

        if (no_telp === '') {
            error = true;
            $('.error-no-telp').show()
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
                url: "{{route('warga.store')}}",
                method: 'post',
                data: {
                    "_token": "{{ csrf_token() }}",
                    NIK: nik,
                    nama: nama,
                    email: email,
                    password: password,
                    id_kategori_sampah: kategori,
                    id_kota: kota,
                    id_kecamatan: kecamatan,
                    id_desa: desa,
                    no_telp: no_telp,
                    dukuh: dukuh,
                    detail_alamat: detail_alamat,
                    latitude: latitude,
                    longitude: longitude,
                },
                success: function (res) {
                    Swal.fire({
                        title: 'Berhasil!',
                        text: 'Data berhasil di tambahkan!',
                        icon: 'success',
                        confirmButtonColor: "#3085d6",
                        confirmButtonText: "OK",
                    }).then((result) => {
                        if (result.value) {
                            window.location.href = "/admin/warga"
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

                    if (text.NIK) {
                        msg0 = text.NIK[0];
                    }

                    if (text.nama) {
                        msg1 = text.nama[0];
                    }

                    if (text.email) {
                        msg2 = text.email[0];
                    }

                    if (text.password) {
                        msg3 = text.password[0];
                    }

                    if (text.no_telp) {
                        msg4 = text.no_telp[0];
                    }

                    Swal.fire({
                        title: 'Gagal!',
                        html: msg0 + '<br>' + msg1 + '<br>' + msg2 + '<br>' + msg3 + '<br>' +
                            msg4,
                        icon: 'warning',
                    });
                }
            })
        }
    };

    $(document).ready(function () {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition);
        } else {
            alert("Geolocation is not supported by this browser.");
        }
    });

    var lat = "-7.797068";
    var long = "110.370529";
    var mymap = L.map('mapid').setView([lat, long], 13);

    function showPosition(position) {
        var lat = position.coords.latitude;
        var long = position.coords.longitude;
        // set lokasi latitude dan longitude, lokasinya posisi user
        //setting maps menggunakan api mapbox bukan google maps, daftar dan dapatkan token      
        L.tileLayer(
            'https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibmFiaWxjaGVuIiwiYSI6ImNrOWZzeXh5bzA1eTQzZGxpZTQ0cjIxZ2UifQ.1YMI-9pZhxALpQ_7x2MxHw', {
                attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
                maxZoom: 20,
                id: 'mapbox/streets-v11', //menggunakan peta model streets-v11 kalian bisa melihat jenis-jenis peta lainnnya di web resmi mapbox
                tileSize: 512,
                zoomOffset: -1,
                accessToken: 'your.mapbox.access.token'
            }).addTo(mymap);


        // buat variabel berisi fugnsi L.popup 
        var popup = L.popup();

        // buat fungsi popup saat map diklik
        function onMapClick(e) {
            popup
                .setLatLng(e.latlng)
                .setContent("koordinatnya adalah " + e.latlng
                    .toString()
                ) //set isi konten yang ingin ditampilkan, kali ini kita akan menampilkan latitude dan longitude
                .openOn(mymap);

            var reg = /[^a-zA-Z0-9\!\@\#\$\%\^\*\_\|]+/;
            var latlong = e.latlng.toString();
            var replace = latlong.replace(/[^\d.,-]/g, '');
            var lat = replace.split(",")[0]
            var long = replace.split(",")[1]

            //value pada form latitde, longitude akan berganti secara otomatis
            document.getElementById('lat').value = lat;
            document.getElementById('long').value = long;
        }
        mymap.on('click', onMapClick); //jalankan fungsi
    }


    var myMarker = L.marker([lat, long], {
        title: "Coordinates",
        alt: "Coordinates",
        draggable: true
    }).addTo(mymap).on('dragend', function () {
        var lat = myMarker.getLatLng().lat.toFixed(8);
        var long = myMarker.getLatLng().lng.toFixed(8);
        var czoom = mymap.getZoom();
        if (czoom < 18) {
            nzoom = czoom + 2;
        }
        if (nzoom > 18) {
            nzoom = 18;
        }
        if (czoom != 18) {
            mymap.setView([lat, long], nzoom);
        } else {
            mymap.setView([lat, long]);
        }
        document.getElementById('lat').value = lat;
        document.getElementById('long').value = long;
        myMarker.bindPopup("Lat " + lat + "<br />Lon " + long).openPopup();
    });

    function myFunction(arr) {
        var out = "<br />";
        var i;
        if (arr.length > 0) {
            mymap.setView([arr[0].lat, arr[0].lon], 18);
            myMarker.setLatLng([arr[0].lat, arr[0].lon]);
            document.getElementById('lat').value = arr[0].lat;
            document.getElementById('long').value = arr[0].lon;
        } else {
            alert("Sorry, no results...");
        }
    }

    function addr_search() {
        $('#results').remove();
        var inp = document.getElementById("addr");
        var xmlhttp = new XMLHttpRequest();
        var url = "https://nominatim.openstreetmap.org/search?format=json&limit=3&q=" + inp.value;
        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                var myArr = JSON.parse(this.responseText);
                myFunction(myArr);
            }
        };
        xmlhttp.open("GET", url, true);
        xmlhttp.send();
    }

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

    $('#kategori').select2({
        allowClear: true,
        placeholder: "Pilih kategori...",
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
    });

</script>
@endpush
