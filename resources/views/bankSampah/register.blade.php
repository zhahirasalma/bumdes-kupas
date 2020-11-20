@extends('layout.master')
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
                    <!-- To configure the contact form email address, go to mail/contact_me.php and update the email address in the PHP file on line 19.-->
                    <form id="contactForm" name="sentMessage" novalidate="novalidate">
                        <div class="col-lg-16">
                            <div class="form-group">
                                <!-- <label>Name</label> -->
                                <input class="form-control" id="name" type="text" placeholder="Nama" required="required"
                                    data-validation-required-message="Masukkan nama" />
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <div class="col-lg-16">
                            <div class="form-group">
                                <!-- <label>Nomor Telepon</label> -->
                                <input class="form-control" id="phone" type="tel" placeholder="Nomor Telepon"
                                    required="required"
                                    data-validation-required-message="Masukkan nomor telepon" />
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <div class="col-lg-16">
                            <div class="form-group">
                                <!-- <label>Email Address</label> -->
                                <input class="form-control" id="email" type="email" placeholder="Email"
                                    required="required"
                                    data-validation-required-message="Masukkan alamat email" />
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <div class="col-lg-16">
                            <div class="form-group">
                                <!-- <label>Email Address</label> -->
                                <input class="form-control" id="password" type="password" placeholder="Kata Sandi"
                                    required="required"
                                    data-validation-required-message="Masukkan kata sandi" />
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <div class="col-lg-16">
                            <div class="form-group">
                                <!-- <label>Name</label> -->
                                <input class="form-control" id="kota" type="text"
                                    placeholder="Kota/Kabupaten" required="required"
                                    data-validation-required-message="Masukkan Kabupaten/Kota" />
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <div class="col-lg-16">
                            <div class="form-group">
                                <!-- <label>Name</label> -->
                                <input class="form-control" id="kecamatan" type="text"
                                    placeholder="Kecamatan" required="required"
                                    data-validation-required-message="Masukkan kecamatan" />
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6 sol-sm-12">
                                <!-- <label>Name</label> -->
                                <input class="form-control" id="desa" type="text"
                                    placeholder="Desa" required="required"
                                    data-validation-required-message="Masukkan desa" />
                                <p class="help-block text-danger"></p>
                            </div>
                            <div class="form-group col-md-6 sol-sm-12">
                                <input class="form-control" id="desa" type="text"
                                    placeholder="Dusun" required="required"
                                    data-validation-required-message="Masukkan desa" />
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6 sol-sm-12">
                                <!-- <label>Name</label> -->
                                <input class="form-control" id="rt" type="text"
                                    placeholder="RT" required="required"
                                    data-validation-required-message="Masukkan RT" />
                                <p class="help-block text-danger"></p>
                            </div>
                            <div class="form-group col-md-6 sol-sm-12">
                                <input class="form-control" id="rw" type="text"
                                    placeholder="RW" required="required"
                                    data-validation-required-message="Masukkan RW" />
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <div class="col-lg-16">
                            <div class="form-group">
                                <!-- <label>Detail Alamat</label> -->
                                <textarea class="form-control" id="message" rows="3" placeholder="Masukkan Detail Alamat"
                                    required="required"
                                    data-validation-required-message="Please enter a message."></textarea>
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <br />
                        <div id="success"></div>
                        <div class="form-group"><button class="btn btn-primary btn-xl" id="sendMessageButton"
                                type="submit">Send</button></div>
                    </form>
                </div>
            </div>
        </div>
    </header>
    @endsection
