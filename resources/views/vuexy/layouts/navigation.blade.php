<div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true" id="navegation">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item me-auto"><a class="navbar-brand" href="{{route('home')}}"><span class="brand-logo">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" height="35">
                    <path fill="currentColor" d="M488 248C488 111 377 0 240 0S0 111 0 248s111 248 240 248 248-111 248-248zm-400 0c0-119 97-216 216-216s216 97 216 216H88zm344 0c0 119-97 216-216 216s-216-97-216-216h432z"/>
                </svg></span>
                    <h2 class="brand-text">OILCENTER</h2>
                </a></li>
            <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pe-0" data-bs-toggle="collapse"><i class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i><i class="d-none d-xl-block collapse-toggle-icon font-medium-4  text-primary" data-feather="disc" data-ticon="disc"></i></a></li>
        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class=" navigation-header"><span data-i18n="Apps &amp; Pages">Menú</span><i data-feather="more-horizontal"></i>
            </li>
            @can('lista-roles')
            <li class="nav-item {{ $activePage == 'roles' ? ' active' : '' }}">
                <a class="d-flex align-items-center" href="{{ route('roles.index') }}">
                    <i data-feather="shield"></i>
                    <span class="menu-title text-truncate" ></span>Roles
                </a>
            </li>
            @endcan
            @can('lista-usuarios')
            <li class=" nav-item {{ $activePage == 'users' ? ' active' : '' }} ">
                <a class="d-flex align-items-center" href="{{ route('users.index') }}">
                    <i data-feather='users'></i><span class="menu-title text-truncate" data-i18n="Usuarios"></span>Usuarios
                </a>
            </li>
            @endcan
            <li class=" nav-item {{ $activePage == 'articulo' ? ' active' : '' }} ">
                <a class="d-flex align-items-center" href="{{ route('articulo.index') }}">
                    <i data-feather='box'></i><span class="menu-title text-truncate" data-i18n="Articulo"></span>Articulo
                </a>
            </li>
            <li class=" nav-item {{ $activePage == 'ingreso' ? ' active' : '' }} ">
                <a class="d-flex align-items-center" href="{{ route('ingreso.index') }}">
                    <i data-feather='box'></i><span class="menu-title text-truncate" data-i18n="Ingreso"></span>Ingreso
                </a>
            </li>

        </ul>
    </div>
</div>
