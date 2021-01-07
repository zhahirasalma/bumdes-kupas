<div class="container-fluid">
    <!-- Brand -->
    <a class="navbar-brand pt-0" href="">
        <img src="{{asset('/assets/img/brand/logo_kupas.png')}}" class="navbar-brand-img" alt="Logo Kupas">
    </a>
    
    <!-- Collapse -->
    <div class="collapse navbar-collapse" id="sidenav-collapse-main">
        <!-- Navigation -->
        <ul class="navbar-nav">
            <li class="nav-item  class=" active" ">
                <a class=" nav-link " href="/admin"> 
                    <i class="ni ni-sound-wave text-grey"></i> Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="/admin/pengambilan">
                    <i class="ni ni-delivery-fast text-orange"></i> Pengambilan Sampah
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="{{URL::to('/admin/warga')}}">
                    <i class="ni ni-single-02 text-blue"></i> Daftar Warga
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="{{URL::to('/admin/retribusi')}}">
                    <i class="ni ni-money-coins text-blue"></i> Transaksi Retribusi
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="{{URL::to('admin/bank_sampah')}}">
                    <i class="ni ni-building text-yellow"></i> Daftar Bank Sampah
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="{{URL::to('admin/transaksi')}}">
                    <i class="ni ni-money-coins text-yellow"></i> Transaksi Bank Sampah
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="{{URL::to('admin/konversi')}}">
                    <i class="ni ni-tag text-green"></i> Konversi sampah
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="{{route('kategori_sampah.index')}}">
                    <i class="ni ni-paper-diploma text-green"></i> Kategori sampah
                </a>
            </li>
        </ul>
    </div>
</div>
