<div class="container-fluid">
    <!-- Brand -->
    <a class="navbar-brand pt-0" href="">
        <img src="{{asset('/assets/img/brand/logo_kupas.png')}}" class="navbar-brand-img" alt="Logo Kupas">
    </a>
    
    <!-- Collapse -->
    <div class="collapse navbar-collapse" id="sidenav-collapse-main">
        <!-- Navigation -->
        @if(Auth::user()->role=='admin')
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class=" nav-link " href="{{route('dashboard.index')}}"> 
                    <i class="ni ni-sound-wave text-grey"></i> Dashboard
                </a>
            </li>
        </ul>
        @endif
        @if(Auth::user()->role=='educator' || Auth::user()->role=='admin')
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link " href="{{route('pengambilan.index')}}">
                    <i class="ni ni-delivery-fast text-orange"></i> Pengambilan Sampah
                </a>
            </li>
        </ul>
        @endif
        @if(Auth::user()->role=='admin') 
        <ul class="navbar-nav">
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
                    <i class="ni ni-paper-diploma text-green"></i> Kategori warga
                </a>
            </li>
        </ul>
        @endif
    </div>
</div>
