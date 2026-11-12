<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>@yield('titulo', 'Panel Administrativo') - AGROVALLE Honduras</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('plantilla/assets/favicon.ico') }}" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">


    <link href="https://fonts.googleapis.com/css?family=Catamaran:100,200,300,400,500,600,700,800,900" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i" rel="stylesheet" />

    <link href="{{ asset('plantilla/css/styles.css') }}" rel="stylesheet" />

    <style>
        :root {
            --agro-verde: #1e6b34;
            --agro-verde-oscuro: #14532d;
            --agro-amarillo: #f4b400;
        }
        body {
            background-color: #f4f6f3;
            min-height: 100vh;
        }

        .navbar-custom {
            background-color: var(--agro-verde-oscuro);
            height: 64px;
            padding-top: 0;
            padding-bottom: 0;
        }
        .navbar-custom .navbar-brand img {
            height: 36px;
        }

        #layoutSidenav_nav {
            position: fixed;
            top: 64px;
            left: 0;
            bottom: 0;
            width: 240px;
            background-color: var(--agro-verde);
            display: flex;
            flex-direction: column;
            overflow-y: auto;
            transition: transform .2s;
            z-index: 1020;
        }
        .sb-sidenav-logo {
            text-align: center;
            padding: 1.25rem 1rem;
            border-bottom: 1px solid rgba(255, 255, 255, .15);
        }
        .sb-sidenav-logo img {
            max-width: 170px;
        }
        .sb-sidenav-menu-heading {
            color: rgba(255, 255, 255, .55);
            font-size: .75rem;
            font-weight: 700;
            text-transform: uppercase;
            padding: 1.25rem 1rem .5rem;
        }
        #layoutSidenav_nav .nav-link {
            color: rgba(255, 255, 255, .85);
            padding: .7rem 1rem;
            border-left: 4px solid transparent;
        }
        #layoutSidenav_nav .nav-link i {
            margin-right: .6rem;
        }
        #layoutSidenav_nav .nav-link:hover {
            color: #fff;
            background-color: rgba(255, 255, 255, .08);
        }
        #layoutSidenav_nav .nav-link.active {
            color: #fff;
            background-color: rgba(0, 0, 0, .2);
            border-left-color: var(--agro-amarillo);
            font-weight: 700;
        }
        .sb-sidenav-footer {
            margin-top: auto;
            padding: .9rem 1rem;
            color: #fff;
            background-color: var(--agro-verde-oscuro);
        }
        .texto-claro {
            color: rgba(255, 255, 255, .75) !important;
        }

        #layoutSidenav_content {
            margin-left: 240px;
            padding-top: 64px;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        @media (max-width: 991.98px) {
            #layoutSidenav_nav {
                transform: translateX(-240px);
            }
            #layoutSidenav_content {
                margin-left: 0;
            }
            body.sidenav-abierto #layoutSidenav_nav {
                transform: translateX(0);
            }
        }
    </style>
</head>
<body>
   
    <nav class="navbar navbar-expand navbar-dark navbar-custom fixed-top">
        <div class="container-fluid">
            <button class="btn btn-link text-white d-lg-none me-2" id="sidebarToggle" type="button">
                <i class="bi bi-list fs-4"></i>
            </button>

            <a class="navbar-brand d-flex align-items-center" href="{{ route('dashboard') }}">
                <img src="{{ asset('plantilla/assets/img/logo-agrovalle-icono.svg') }}" alt="AGROVALLE" class="me-2">
                AGROVALLE Honduras
            </a>

            <ul class="navbar-nav ms-auto align-items-center">

                <li class="nav-item me-3 text-white d-none d-sm-block">
                    <i class="bi bi-person-circle me-1"></i>{{ Auth::user()->name }}
                </li>

                <li class="nav-item">
                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-outline-light">
                            <i class="bi bi-box-arrow-right me-1"></i>Cerrar sesión
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </nav>

    <div id="layoutSidenav_nav">
        <div class="sb-sidenav-logo">
            <img src="{{ asset('plantilla/assets/img/logo-agrovalle.svg') }}" alt="Logo AGROVALLE Honduras">
        </div>

        <div class="nav flex-column">
            <div class="sb-sidenav-menu-heading">Principal</div>
            <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                <i class="bi bi-speedometer2"></i>Dashboard
            </a>

            <div class="sb-sidenav-menu-heading">Módulos de Gestión</div>
            <a class="nav-link {{ request()->routeIs('insumos.*') ? 'active' : '' }}" href="{{ route('insumos.index') }}">
                <i class="bi bi-box-seam"></i>Insumos
            </a>
            <a class="nav-link {{ request()->routeIs('proveedores.*') ? 'active' : '' }}" href="{{ route('proveedores.index') }}">
                <i class="bi bi-truck"></i>Proveedores
            </a>
            <a class="nav-link {{ request()->routeIs('empleados.*') ? 'active' : '' }}" href="{{ route('empleados.index') }}">
                <i class="bi bi-people"></i>Empleados
            </a>
        </div>

        <div class="sb-sidenav-footer">
            <div class="small texto-claro">Usuario:</div>
            {{ Auth::user()->name }}
        </div>
    </div>

    <div id="layoutSidenav_content">
        <main class="flex-grow-1">
            <div class="container-fluid px-4 py-4">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                        <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
                    </div>
                @endif

                @yield('contenido')
            </div>
        </main>

        
        <footer class="py-4 bg-black mt-auto">
            <div class="container-fluid px-4">
                <div class="d-flex flex-wrap align-items-center justify-content-between small texto-claro">
                    <div>&copy; 2026 Distribuidora Agropecuaria del Valle S. de R.L. (AGROVALLE Honduras)</div>
                    <div>Comayagua · San Pedro Sula | Sistema de Gestión Interna</div>
                </div>
            </div>
        </footer>
    </div>

    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('plantilla/js/scripts.js') }}"></script>
</body>
</html>
