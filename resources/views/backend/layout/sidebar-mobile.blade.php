<body>

    <!-- Top Navigation Menu -->
    <div class="topnav">
        <a href="#home" class="active"></a>
        <div id="myLinks">
            <li class="nav-item  class=" active" ">
                <a class=" nav-link " href=" {{route('dashboard.index')}}">
                <i class="ni ni-sound-wave text-grey"></i> Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="{{route('pengambilan.index')}}">
                    <i class="ni ni-delivery-fast text-orange"></i> Pengambilan Sampah
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="{{route('users.index')}}">
                    <i class="ni ni-single-02 text-orange"></i> Users
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="{{route('warga.index')}}">
                    <i class="ni ni-single-copy-04 text-blue"></i> Daftar Warga
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="{{route('retribusi.index')}}">
                    <i class="ni ni-money-coins text-blue"></i> Transaksi Retribusi
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="{{route('bank_sampah.index')}}">
                    <i class="ni ni-building text-yellow"></i> Daftar Bank Sampah
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="{{route('transaksi.index')}}">
                    <i class="ni ni-money-coins text-yellow"></i> Transaksi Bank Sampah
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="{{route('konversi.index')}}">
                    <i class="ni ni-tag text-green"></i> Konversi sampah
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="{{route('kategori_sampah.index')}}">
                    <i class="ni ni-paper-diploma text-green"></i> Kategori sampah
                </a>
            </li>
        </div>
        <div style="position: fixed; top: 20px; z-index:100; right:0px">
            <a href="javascript:void(0);" class="icon" onclick="myFunction()">
                <i style="font-size: 1.5rem;" class="fa fa-bars"></i>
            </a>
        </div>
    </div>
</body>

<script>
    function myFunction() {
        var x = document.getElementById("myLinks");
        if (x.style.display === "block") {
            x.style.display = "none";
        } else {
            x.style.display = "block";
        }
    }

</script>

<style>
    body {
        font-family: Arial, Helvetica, sans-serif;
    }

    .mobile-container {
        max-width: 480px;
        margin: auto;
        background-color: #555;
        height: 500px;
        color: white;
        border-radius: 10px;
    }

    .topnav {
        overflow: hidden;
        background-color: white;
        position: relative;
    }

    .topnav #myLinks {
        display: none;
    }

    .topnav a {
        color: black;
        padding: 0px;
        text-decoration: none;
        font-size: 17px;
        display: block;
    }

    .topnav a.icon {
        background: white;
        display: block;
        position: absolute;
        right: 0;
        top: 0;
    }

    .topnav a:hover {
        background-color: #ddd;
        color: black;
    }

    .active {
        background-color: #4CAF50;
        color: white;
    }

    .icon {
        width: 3rem;
        height: 0px !important;
    }

    .bg-white {
        height: 70px !important;
    }

    li {
        list-style-type: none !important;
        margin-left: 10px !important;
        line-height: 40px !important;
    }

</style>
