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
                <form method="POST" action="{{ route('register') }}">
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
                                <select class="form-control" name="id_kota" id="id_kota"
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
                                <select class="form-control" name="id_kecamatan" id="id_kecamatan"
                                    required="required" data-validation-required-message="Pilih kecamatan">
                                        <option value="">Pilih kecamatan...</option>
                                            @foreach($kecamatan as $kec)
                                            <option value="{{$kec->id}}" @if (old('id_kecamatan')==$kec->id ) selected="selected"
                                                @endif>
                                                {{$kec->kecamatan}}</option>
                                            @endforeach 
                                </select>
                                @if ($errors->has('id_kecamatan'))
                                    <span class="text-danger">{{ $errors->first('id_kecamatan') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6 sol-sm-12">
                                <!-- <label>Name</label> -->
                                <select class="form-control" name="id_desa" id="id_desa"
                                    required="required" data-validation-required-message="Pilih desa">
                                        <option value="">Pilih desa...</option>
                                            @foreach($desa as $ds)
                                            <option value="{{$ds->id}}" @if (old('id_desa')==$ds->id ) selected="selected"
                                                @endif>
                                                {{$ds->desa}}</option>
                                            @endforeach 
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
                                            <option value="{{$kategori->id}}" @if (old('id_kategori_sampah')==$kategori->id ) selected="selected"
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
                        <div class="form-row">
                            <div class="form-group col-md-4 sol-sm-8">
                                <!-- <label>Name</label> -->
                                <input class="form-control" name="lokasi" id="lokasi" type="text" placeholder="Lokasi" required="required"
                                    readonly data-validation-required-message="Pilih lokasi di maps" />
                                <p class="help-block text-danger"></p>
                            </div>
                            <div class="form-group col-md-8 sol-sm-16">
                                <div id="map-container-google-1" class="z-depth-1-half map-container"
                                    style="height: max">
                                    <iframe
                                        src="https://maps.google.com/maps?q=manhatan&t=&z=13&ie=UTF8&iwloc=&output=embed"
                                        frameborder="0" style="border:0" allowfullscreen></iframe>
                                </div>
                            </div>
                        </div>
                        <!--Google map-->
                        <!-- <div class="col-lg-16">
                            <div class="form-group"> 
                                <div id="map-container-google-1" class="z-depth-1-half map-container" style="height: relative">
                                <iframe src="https://maps.google.com/maps?q=manhatan&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0"
                                    style="border:0" allowfullscreen></iframe>
                                </div>
                            </div>
                        </div> -->
                        <!--Google Maps-->
                        <br />
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
