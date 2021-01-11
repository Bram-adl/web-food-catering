<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>
    <!-- SEARCH FORM -->
    <form class="form-inline ml-3">
        <div class="input-group input-group-sm">
            <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
    </form>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="fas fa-user"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <a href="/profil/{{ $user->id }}" class="dropdown-item">
                    <h3 class="dropdown-item-title">
                        Edit profil
                    </h3>
                </a>
                <div class="dropdown-divider"></div>
            <a href="/logout" class="dropdown-item" onclick="event.preventDefault(); document.getElementById('logout').submit()">
                    <h3 class="dropdown-item-title">
                        Logout
                    </h3>
                </a>
            </div>
        </li>
    </ul>
</nav>
<!-- /.navbar -->