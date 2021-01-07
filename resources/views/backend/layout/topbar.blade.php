<!-- Form -->
<form class="navbar-search navbar-search-dark form-inline mr-3 d-none d-md-flex ml-lg-auto">
    <div class="form-group mb-0">
        <div class="input-group input-group-alternative">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-search"></i></span>
            </div>
            <input class="form-control" placeholder="Search" type="text">
        </div>
    </div>
</form>
<!-- User -->
<ul class="navbar-nav align-items-center d-none d-md-flex">
    <li class="nav-item dropdown">
        <a class="nav-link pr-0" href="" role="button" data-toggle="dropdown" aria-haspopup="true"
            aria-expanded="false">
            <div class="media align-items-center">
                <span class="avatar avatar-sm rounded-circle">
                    <img alt="" src="{{asset('/assets/img/brand/favicon.png')}}">
                </span>
                <div class="media-body ml-2 d-none d-lg-block">
                    <span class="mb-0 text-sm  font-weight-bold">USER</span>
                </div>
            </div>
        </a>
        <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
            <a href="#!" class="dropdown-item">
                <i class="ni ni-user-run"></i>
                <span>Logout</span>
            </a>
        </div>
    </li>
</ul>
