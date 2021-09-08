<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>@yield('title') | KUPAS BUMDES</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="{{asset('template/assets/img/favicon.ico')}}" />
    <!-- Font Awesome icons (free version)-->
    <script src="{{('https://use.fontawesome.com/releases/v5.15.1/js/all.js')}}" crossorigin="anonymous"></script>
    <!-- Google fonts-->
    <link href="{{('https://fonts.googleapis.com/css?family=Montserrat:400,700')}}" rel="stylesheet" type="text/css" />
    <link href="{{('https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic')}}" rel="stylesheet"
        type="text/css" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="{{asset('template/css/styles.css')}}" rel="stylesheet" />
    <!-- Select2 -->
    <link href="{{asset('select2/dist/css/select2.min.css')}}" rel="stylesheet" />
    <link rel="stylesheet" href="{{asset('select2/dist/css/select2-bootstrap4.min.css')}}">
    <!--Swal2-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.min.css'>
    <!--leaflet-->
    <link rel="stylesheet" href="{{('https://unpkg.com/leaflet@1.7.1/dist/leaflet.css')}}"
        integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
        crossorigin="" />
    <!--toggle switch-->
    <link href="{{('https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css')}}" rel="stylesheet">
    <link href="{{asset('datatables/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
    
</head>

<body id="page-top">
    <!-- Navigation-->
    @include('frontend.layout.topbar')
    <!-- Masthead-->
    @yield('content')
    <!-- Portfolio Section-->

    <!-- Footer-->
    @include('frontend.layout.footer')
    <!-- Scroll to Top Button (Only visible on small and extra-small screen sizes)-->
    <div class="scroll-to-top d-lg-none position-fixed">
        <a class="js-scroll-trigger d-block text-center text-white rounded" href="#page-top"><i
                class="fa fa-chevron-up"></i></a>
    </div>
    <!-- Portfolio Modals-->

    <!-- Bootstrap core JS-->
    <script src="{{('https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js')}}"></script>
    <script src="{{('https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js')}}"></script>
    <!-- Third party plugin JS-->
    <script src="{{('https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js')}}"></script>
    <!-- Contact form JS-->
    <script src="{{asset('template/assets/mail/jqBootstrapValidation.js')}}"></script>
    <script src="{{asset('template/assets/mail/contact_me.js')}}"></script>
    <!-- Core theme JS-->
    <script src="{{asset('template/js/scripts.js')}}"></script>
    <!-- Select2 -->
    <script src="{{asset('select2/dist/js/select2.min.js')}}"></script>
    <!--leafletjs-->
    <script src="{{('https://unpkg.com/leaflet@1.7.1/dist/leaflet.j')}}s"
        integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
        crossorigin=""></script>
    <!--toggle switch-->
    <script src="{{('https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js')}}"></script>
    <script src="{{('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js')}}"></script>
    <!-- Datatables -->
    <script src="{{asset('datatables/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('datatables/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('datatables/js/dataTables.fixedHeader.min.js')}}"></script>
    <script src="{{asset('datatables/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('datatables/js/responsive.bootstrap.min.js')}}"></script>

    @stack('script')
</body>

</html>
