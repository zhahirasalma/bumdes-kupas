@extends('backend.layout.master')
@section('title')
Tambah Data Warga
@endsection

<head>
    <!-- leaflet css  -->
    <link rel="stylesheet" href="{{asset('leaflet/leaflet.css')}}"/>
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
                <form action="{{route('warga.store')}}" method="POST">
                    @csrf
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
                                <input type="text" name="nama" class="form-control form-control-alternative"
                                    placeholder="Nama" value="{{ old('nama')}}">
                                @if ($errors->has('nama'))
                                <span class="text-danger">{{ $errors->first('nama') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label" for="input-nama">Email</label>
                                <input type="email" name="email" class="form-control form-control-alternative"
                                    placeholder="Email" value="{{ old('email')}}">
                                @if ($errors->has('email'))
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label" for="input-first-name">Password</label>
                                <input type="password" name="password" class="form-control form-control-alternative"
                                    placeholder="Password" value="{{ old('password')}}">
                            </div>
                            @if ($errors->has('password'))
                            <span class="text-danger">{{ $errors->first('password') }}</span>
                            @endif
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
                                <select name="id_kecamatan" onChange="updateDesa()" id="kecamatan" class="form-control"
                                    disabled>
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
                                <label class="form-control-label" for="input-city">Desa</label>
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
                                <label class="form-control-label" for="input-country">Dukuh</label>
                                <input type="text" name="dukuh" class="form-control form-control-alternative"
                                    placeholder="Dukuh" value="{{ old('dukuh')}}">
                                @if ($errors->has('dukuh'))
                                <span class="text-danger">{{ $errors->first('dukuh') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-control-label">Detail Alamat</label>
                        <textarea rows="4" name="detail_alamat" class="form-control form-control-alternative"
                            placeholder="Detail Alamat">{{ old('detail_alamat')}}</textarea>
                        @if ($errors->has('detail_alamat'))
                        <span class="text-danger">{{ $errors->first('detail_alamat') }}</span>
                        @endif
                    </div>
                    <div class="row" style="display: none;">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label" for="input-nama">Latitude</label>
                                <input type="text" id="lat" name="lat" class="form-control form-control-alternative"
                                    placeholder="Lokasi" value="{{ old('lokasi')}}">
                                @if ($errors->has('lokasi'))
                                <span class="text-danger">{{ $errors->first('lokasi') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label" for="input-nama">Longitude</label>
                                <input type="text" id="long" name="long" class="form-control form-control-alternative"
                                    placeholder="Lokasi" value="{{ old('lokasi')}}">
                                @if ($errors->has('lokasi'))
                                <span class="text-danger">{{ $errors->first('lokasi') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div>
                        <label class="form-control-label" for="input-nama">Lokasi</label>
                        <div class="row">
                            <div id="search" class="col-lg-4">
                                <input type="text" class="form-control form-control-alternative" name="addr" value=""
                                    id="addr" size="58">
                            </div>
                            <button class="btn btn-success" type="button" onclick="addr_search();">Search</button>
                        </div> <br>
                            <div class="form-group">
                                <div id="mapid"></div>
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
@endsection

@push('script')
<script src="{{asset('leaflet/leaflet.js')}}"></script>
<script type="text/javascript">
    $(document).ready(function () {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition);
        } else {
            console.log("Geolocation is not supported by this browser.");
        }
    });

    var lat = "-2.9547949";
    var long = "104.6929233";
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
            console.log(replace)

            //value pada form latitde, longitude akan berganti secara otomatis
            document.getElementById('lat').value =lat; 
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
    })

</script>
@endpush
