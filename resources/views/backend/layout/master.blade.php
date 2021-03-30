<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>
            @yield('title') | BUMDES - KUPAS
        </title>
        <!-- Favicon -->
        <link href="{{asset('assets/img/brand/logo_kupas.png')}}" rel="icon" type="image/png">
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
        <!-- Icons -->
        <link href="{{asset('assets/js/plugins/nucleo/css/nucleo.css')}}" rel="stylesheet" />
        <link href="{{asset('assets/js/plugins/@fortawesome/fontawesome-free/css/all.min.css')}}" rel="stylesheet" />
        <!-- CSS Files -->
        <link href="{{asset('assets/css/argon-dashboard.css?v=1.1.0')}}" rel="stylesheet" />

        <!-- select 2 -->
        <link href="{{asset('select2/dist/css/select2.min.css')}}" rel="stylesheet" />
        <link rel="stylesheet" href="{{asset('select2/dist/css/select2-bootstrap4.min.css')}}">

        <!-- toogle button -->
        <link href="{{asset('bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css')}}" rel="stylesheet">

        <!-- datatables -->
        <link href="{{asset('datatables/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
    </head>

    <body class="">
        <div class=".d-none .d-lg-block .d-xl-none">
            <nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
            @include('backend.layout.sidebar')
        </nav>
        </div>
        
        <div class=".d-none .d-sm-block .d-md-none">
            <nav>
                @include('backend.layout.sidebar-mobile')
            </nav>
        </div>
        <div class="main-content">
            @include('sweetalert::alert')
            <!-- Navbar -->
            <nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
                <div class="container-fluid">
                    <!-- Brand -->
                    <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block"
                        href="./index.html">@yield('title')</a>
                    @include('backend.layout.topbar')
                </div>
            </nav>

            <!-- End Navbar -->
            <!-- Header -->
            <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
                @yield('card')
            </div>
            <div class="container-fluid mt--7">
                @yield('content')
                <footer class="footer">

                </footer>
            </div>
        </div>
        <!--   Core   -->
        <script src="{{asset('assets/js/plugins/jquery/dist/jquery.min.js')}}"></script>
        <script src="{{asset('assets/js/plugins/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
        <!--   Argon JS   -->
        <script src="{{asset('assets/js/argon-dashboard.min.js?v=1.1.0')}}"></script>
        <!-- Select2 -->
        <script src="{{asset('select2/dist/js/select2.min.js')}}"></script>
        <!-- Button toggle -->
        <script src="{{asset('bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js')}}"></script>
        <!-- Datatables -->
        <script src="{{asset('datatables/js/jquery.dataTables.min.js')}}"></script>
        <script src="{{asset('datatables/js/dataTables.bootstrap4.min.js')}}"></script>
        <script src="{{asset('datatables/js/dataTables.fixedHeader.min.js')}}"></script>
        <script src="{{asset('datatables/js/dataTables.responsive.min.js')}}"></script>
        <script src="{{asset('datatables/js/responsive.bootstrap.min.js')}}"></script>

        @stack('script')

        <script>
            window.TrackJS &&
                TrackJS.install({
                    token: "ee6fab19c5a04ac1a32a645abde4613a",
                    application: "argon-dashboard-free"
                });

        </script>
    </body>

</html>
