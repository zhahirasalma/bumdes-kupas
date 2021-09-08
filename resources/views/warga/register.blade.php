@extends('frontend.layout.master')
@section('title')
Registrasi Warga
@endsection
@section('content')

<header class="masthead bg-primary text-secondary text-center">
    <div class="container">
        <!-- Contact Section Heading-->
        <h3 class="page-section-sub-heading text-center text-uppercase text-secondary mb-0">Pendaftaran Nasabah KUPAS
        </h3>
        <!-- Icon Divider-->
        <div class="divider-custom">
            <div class="divider"></div>
        </div>
        <!-- Contact Section Form-->
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <form method="POST" action="{{route('store_warga')}}">
                    @csrf
                    <form id="contactForm" name="sentMessage" novalidate="novalidate">
                        <div class="col-lg-16">
                            <div class="form-group">
                                <input class="form-control @error('nama') is-invalid @enderror" name="nama" 
                                    id="nama" type="text" placeholder="Nama" value="{{ old('nama')}}"/>
                                @error('nama')
                                <span class="text-danger">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-16">
                            <div class="form-group">
                                <input class="form-control @error('NIK') is-invalid @enderror" name="NIK" 
                                    id="NIK" type="text" placeholder="NIK" value="{{ old('NIK')}}" />
                                <p class="help-block text-danger"></p>
                                @error('NIK')
                                <span class="text-danger">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-16">
                            <div class="form-group">
                                <input class="form-control" name="no_telp" id="no_telp" type="tel"
                                    placeholder="Nomor Telepon Warga" value="{{ old('no_telp')}}"/>
                                <p class="help-block text-danger"></p>
                                @error('no_telp')
                                <span class="text-danger">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-16">
                            <div class="form-group">
                                <input class="form-control" name="email" id="email" type="email" placeholder="Email" value="{{ old('email')}}"/>
                                <p class="help-block text-danger"></p>
                                @error('email')
                                <span class="text-danger">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-16">
                            <div class="form-group">
                                <input class="form-control" name="password" id="password" type="password"
                                    placeholder="Kata Sandi"/>
                                <p class="help-block text-danger"></p>
                                @error('password')
                                <span class="text-danger">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-16">
                            <div class="form-group">
                                <select class="form-control" name="id_kota" id="id_kota" onChange="updateKecamatan()">
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
                                <select class="form-control" onChange="updateDesa()" name="id_kecamatan"
                                    id="id_kecamatan">
                                    <option value="">Pilih kecamatan...</option>
                                </select>
                                @error('id_kecamatan')
                                <span class="text-danger">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6 sol-sm-8">
                                <select class="form-control" name="id_desa" id="id_desa">
                                    <option value="">Pilih desa...</option>
                                </select>
                                @error('id_desa')
                                <span class="text-danger">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group col-md-6 sol-sm-8">
                                <input class="form-control" name="dukuh" id="dukuh" type="text" placeholder="Dukuh" value="{{ old('dukuh')}}"/>
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
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-16">
                            <d  iv class="form-group">
                                <select class="form-control" name="id_kategori_sampah" id="id_kategori_sampah">
                                    <option value="">Pilih kategori sampah...</option>
                                    @foreach($kategori as $kategori)
                                    <option value="{{$kategori->id}}" @if (old('id_kategori_sampah')==$kategori->id )
                                        selected="selected"
                                        @endif>
                                        {{$kategori->jenis_sampah}}</option>
                                    @endforeach
                                </select>
                                @error('id_kategori_sampah')
                                <span class="text-danger">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>

                        <div class="row" style="display: none;">
                            <div class="col-lg-16">
                                <div class="form-group">
                                    <input class="form-control" name="latitude" id="latitude" type="text"
                                        placeholder="Masukkan lokasi" />
                                </div>
                            </div>
                            <div class="col-lg-16">
                                <div class="form-group">
                                    <input class="form-control" name="longitude" id="longitude" type="text"
                                        placeholder="Masukkan lokasi" />
                                </div>
                            </div>
                        </div>

                        <div>
                            <div class="form-row">
                                <div class="form-group col-md-6 sol-sm-12">
                                    <div id="search">
                                        <input class="form-control" name="addr" id="addr" type="text"
                                            placeholder="Pilih lokasi pada peta"
                                            data-validation-required-message="Pilih lokasi pada peta" />
                                        <p class="help-block text-danger"></p>
                                    </div>
                                </div>
                                <div class="form-group col-md-2 sol-sm-6">
                                    <button class="btn btn-primary" type="button" onclick="addr_search();">Cari</button>
                                </div>
                            </div>
                        </div>
                        <br />
                        <div class="form-group">
                            <div id="mapid" style="height: 500px;"></div>
                            <h5 class="text">Klik pada peta untuk memilih lokasi</h5>
                        </div>
                        <br/>
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
<script src="{{asset('leaflet/leaflet.js')}}"></script>
<script type="text/javascript">

    function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition);
        } else {
            alert("Geolocation is not supported by this browser.");
        }
    }

    var lat = "-7.857762";
    var long = "110.341055";
    var mymap = L.map('mapid').setView([lat, long], 13);
    var popup = L.popup();


    L.tileLayer(
        'https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibmFiaWxjaGVuIiwiYSI6ImNrOWZzeXh5bzA1eTQzZGxpZTQ0cjIxZ2UifQ.1YMI-9pZhxALpQ_7x2MxHw', {
            attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
            maxZoom: 20,
            id: 'mapbox/streets-v11', //menggunakan peta model streets-v11 kalian bisa melihat jenis-jenis peta lainnnya di web resmi mapbox
            tileSize: 512,
            zoomOffset: -1,
            accessToken: 'your.mapbox.access.token'
        }).addTo(mymap);
    

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
            //value pada form latitude, longitude akan berganti secara otomatis
            document.getElementById('latitude').value = lat;
            document.getElementById('longitude').value = long;
    }
        mymap.on('click', onMapClick); //jalankan fungsi

    function myFunction(arr) {
        var out = "<br />";
        var i;
        if (arr.length > 0) {
            mymap.setView([arr[0].lat, arr[0].lon], 18);
            popup
                .setLatLng([arr[0].lat, arr[0].lon])
                .setContent("koordinatnya adalah " + [arr[0].lat, arr[0].lon]
                    .toString()
                ) //set isi konten yang ingin ditampilkan, kali ini kita akan menampilkan latitude dan longitude
                .openOn(mymap);
            document.getElementById('latitude').value = arr[0].lat;
            document.getElementById('longitude').value = arr[0].lon;
        } else {
            alert("Alamat tidak ditemukan");
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
    $(document).ready(function () {
        $('#id_kategori_sampah').select2({
            allowClear: true,
            placeholder: "Pilih kategori sampah...",
            theme: 'bootstrap4',
        });
    })

</script>

@endpush
