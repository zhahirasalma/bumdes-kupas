@extends('frontend.layout.master')
@section('title')
Registrasi Bank Sampah
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
                    <!-- To configure the contact form email address, go to mail/contact_me.php and update the email address in the PHP file on line 19.-->
                    <form id="contactForm" name="sentMessage" novalidate="novalidate">
                        <div class="col-lg-16">
                            <div class="form-group">
                                <!-- <label>Name</label> -->
                                <input class="form-control" name="nama" id="nama" type="text" placeholder="Nama"
                                    required="required" data-validation-required-message="Masukkan nama" />
                                <p class="help-block text-danger"></p>
                                @if ($errors->has('nama'))
                                <span class="text-danger">{{ $errors->first('nama') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="col-lg-16">
                            <div class="form-group">
                                <!-- <label>Name</label> -->
                                <input class="form-control" name="NIK" id="NIK" type="text" placeholder="NIK"
                                    required="required" data-validation-required-message="Masukkan NIK" />
                                <p class="help-block text-danger"></p>
                                @if ($errors->has('NIK'))
                                <span class="text-danger">{{ $errors->first('NIK') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="col-lg-16">
                            <div class="form-group">
                                <!-- <label>Nomor Telepon</label> -->
                                <input class="form-control" name="no_telp" id="no_telp" type="tel"
                                    placeholder="Nomor Telepon Warga" required="required"
                                    data-validation-required-message="Masukkan nomor telepon warga" />
                                <p class="help-block text-danger"></p>
                                @if ($errors->has('no_telp'))
                                <span class="text-danger">{{ $errors->first('no_telp') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="col-lg-16">
                            <div class="form-group">
                                <!-- <label>Email Address</label> -->
                                <input class="form-control" name="email" id="email" type="email" placeholder="Email"
                                    required="required" data-validation-required-message="Masukkan alamat email" />
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>

                        <div class="col-lg-16">
                            <div class="form-group">
                                <!-- <label>Email Address</label> -->
                                <input class="form-control" name="password" id="password" type="password"
                                    placeholder="Kata Sandi" required="required"
                                    data-validation-required-message="Masukkan kata sandi" />
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>

                        <div class="col-lg-16">
                            <div class="form-group">
                                <!-- <label>Name</label> -->
                                <select class="form-control" name="id_kota" id="id_kota" onChange="updateKecamatan()"
                                    required="required" data-validation-required-message="Pilih kota">
                                    <option value="">Pilih kota...</option>
                                    @foreach($kota as $kota)
                                    <option value="{{$kota->id}}" @if (old('id_kota')==$kota->id ) selected="selected"
                                        @endif>
                                        {{$kota->kota}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('id_kota'))
                                <span class="text-danger">{{ $errors->first('id_kota') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="col-lg-16">
                            <div class="form-group">
                                <!-- <label>Name</label> -->
                                <select class="form-control" onChange="updateDesa()" name="id_kecamatan"
                                    id="id_kecamatan" required="required"
                                    data-validation-required-message="Pilih kecamatan">
                                    <option value="">Pilih kecamatan...</option>
                                </select>
                                @if ($errors->has('id_kecamatan'))
                                <span class="text-danger">{{ $errors->first('id_kecamatan') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6 sol-sm-12">
                                <!-- <label>Name</label> -->
                                <select class="form-control" name="id_desa" id="id_desa" required="required"
                                    data-validation-required-message="Pilih desa">
                                    <option value="">Pilih desa...</option>
                                </select>
                                @if ($errors->has('id_desa'))
                                <span class="text-danger">{{ $errors->first('id_desa') }}</span>
                                @endif
                            </div>

                            <div class="form-group col-md-6 sol-sm-12">
                                <input class="form-control" name="dukuh" id="dukuh" type="text" placeholder="Dukuh"
                                    required="required" data-validation-required-message="Masukkan dukuh" />
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <div class="col-lg-16">
                            <div class="form-group">
                                <!-- <label>Detail Alamat</label> -->
                                <textarea class="form-control" name="detail_alamat" id="message" rows="3"
                                    placeholder="Masukkan Detail Alamat" required="required"
                                    data-validation-required-message="Please enter a message."></textarea>
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <div class="col-lg-16">
                            <div class="form-group">
                                <!-- <label>Name</label> -->
                                <select class="form-control" name="id_kategori_sampah" id="id_kategori_sampah"
                                    required="required" data-validation-required-message="Pilih kategori sampah">
                                    <option value="">Pilih kategori sampah...</option>
                                    @foreach($kategori as $kategori)
                                    <option value="{{$kategori->id}}" @if (old('id_kategori_sampah')==$kategori->id )
                                        selected="selected"
                                        @endif>
                                        {{$kategori->jenis_sampah}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('id_kategori_sampah'))
                                <span class="text-danger">{{ $errors->first('id_kategori_sampah') }}</span>
                                @endif
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>

                        <div class="row" style="display: none;">
                            <div class="col-lg-16">
                                <div class="form-group">
                                    <!-- <label>Name</label> -->
                                    <input class="form-control" name="latitude" id="latitude" type="text"
                                        placeholder="Masukkan lokasi" />
                                </div>
                            </div>
                            <div class="col-lg-16">
                                <div class="form-group">
                                    <!-- <label>Name</label> -->
                                    <input class="form-control" name="longitude" id="longitude" type="text"
                                        placeholder="Masukkan lokasi" />
                                </div>
                            </div>
                        </div>

                        <div>
                            <div class="form-row">
                                <div class="form-group col-md-6 sol-sm-12">
                                    <!-- <label>Name</label> -->
                                    <div id="search">
                                        <input class="form-control" name="addr" id="addr" type="text"
                                            placeholder="Pilih lokasi pada peta" required="required"
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
                            <span class="text">Pilih pada peta untuk memilih</span>
                        </div>
                        <br/>
                        <div id="success"></div>
                        <!-- <div class="form-group"><a href="/homewarga" class="btn btn-primary btn-xl"
                                id="sendMessageButton" type="submit">Send</a></div> -->
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

    var latitude = "-2.9547949";
    var longitude = "104.6929233";
    var mymap = L.map('mapid').setView([latitude, longitude], 13);

    function showPosition(position) {
       var latitude = position.coords.latitude;
       var longitude = position.coords.longitude;

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

                 //value pada form latitude, longitude akan berganti secara otomatis
                 document.getElementById('latitude').value = latitude;
                 document.getElementById('longitude').value = longitude;
            }
            mymap.on('click', onMapClick); //jalankan fungsi
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
