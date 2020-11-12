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
</head>

<body id="page-top">
    <!-- Navigation-->
    @include('layout.topbar')
    <!-- Masthead-->
    @yield('content')
    <!-- Portfolio Section-->
    
    <!-- Footer-->
    @include('layout.footer')
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
    <script src="/js/scripts.js"></script>
</body>

</html>
