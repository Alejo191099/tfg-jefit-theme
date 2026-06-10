<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">

    {{-- Esto hace que la web se adapte mejor a móviles --}}
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'JeFIT - Entrenamiento y Nutrición')</title>

    {{-- Bootstrap por CDN para usar columnas, botones, navbar y responsive sin complicarlo --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /*
            Estilo general de la web.
            Lo dejo aquí para que todas las páginas tengan una misma base visual.
        */

        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            background: #111418;
            color: #f8f9fa;
        }

        main {
            flex: 1;
        }

        /*
            Navbar oscura para mantener el diseño fitness/neón de la web.
        */
        .navbar {
            background: #1d2126 !important;
            border-bottom: 1px solid rgba(0, 255, 60, 0.15);
        }

        /*
        Logo de JeFIT.
        Lo hago con texto y CSS para que pese poco, se adapte bien a móvil
        y mantenga el estilo deportivo/neón de la web.
        */
        .navbar-brand.logo-jefit {
            font-weight: 900;
            letter-spacing: 2px;
            font-size: 1.35rem;
            display: inline-flex;
            align-items: center;
            text-decoration: none;
        }

        .logo-je {
            color: #ffffff;
        }

        .logo-fit {
            color: #00ff3c;
            text-shadow: 0 0 8px rgba(0, 255, 60, 0.65);
        }

        .navbar-brand.logo-jefit:hover .logo-je {
            color: #00ff3c;
        }

        .navbar-brand.logo-jefit:hover .logo-fit {
            color: #ffffff;
            text-shadow: 0 0 10px rgba(0, 255, 60, 0.8);
        }

        .navbar .nav-link {
            color: #cfd3d8 !important;
            font-weight: 500;
        }

        .navbar .nav-link:hover {
            color: #00ff3c !important;
        }

        .navbar .dropdown-menu {
            background: #1d2126;
            border: 1px solid rgba(0, 255, 60, 0.2);
        }

        .navbar .dropdown-item {
            color: #f8f9fa;
        }

        .navbar .dropdown-item:hover {
            background: #111418;
            color: #00ff3c;
        }

        .dropdown-divider {
            border-color: rgba(255, 255, 255, 0.15);
        }

        /*
            Muchas vistas usan cards de Bootstrap.
            Con esto las adapto al diseño oscuro sin tocar cada página una por una.
        */
        .card {
            background: #15191e;
            color: #f8f9fa;
            border: 1px solid rgba(0, 255, 60, 0.15) !important;
        }

        .card .text-muted,
        .text-muted {
            color: #9ca3af !important;
        }

        /*
            Formularios en estilo oscuro.
        */
        .form-control,
        .form-select {
            background-color: #1d2126;
            color: #ffffff;
            border: 1px solid #343a40;
        }

        .form-control:focus,
        .form-select:focus {
            background-color: #1d2126;
            color: #ffffff;
            border-color: #00c832;
            box-shadow: 0 0 0 0.2rem rgba(0, 200, 50, 0.25);
        }

        .form-control::placeholder {
            color: #6c757d;
        }

        /*
            Tablas en oscuro para que el admin y los pedidos no se vean en blanco.
        */
        .table {
            color: #f8f9fa;
        }

        .table > :not(caption) > * > * {
            background-color: transparent;
            color: #f8f9fa;
            border-bottom-color: rgba(255, 255, 255, 0.12);
        }

        .table-dark {
            --bs-table-bg: #1d2126;
        }

        /*
            Botones principales con toque verde para mantener la identidad visual.
        */
        .btn-primary {
            background: #00b934;
            border-color: #00b934;
            font-weight: 600;
        }

        .btn-primary:hover {
            background: #009b2c;
            border-color: #009b2c;
        }

        .btn-dark {
            background: #00b934;
            border-color: #00b934;
            font-weight: 600;
        }

        .btn-dark:hover {
            background: #009b2c;
            border-color: #009b2c;
        }

        .btn-outline-dark {
            color: #00ff3c;
            border-color: #00ff3c;
        }

        .btn-outline-dark:hover {
            background: #00b934;
            color: #ffffff;
            border-color: #00b934;
        }

        /*
            Footer oscuro para que no rompa con el diseño general.
        */
        footer {
            background: #0d0f12 !important;
            border-top: 1px solid rgba(0, 255, 60, 0.15) !important;
            color: #9ca3af;
        }

        /*
            Pequeño ajuste para que los contenidos no queden pegados en móvil.
        */
        @media (max-width: 768px) {
            .navbar-nav {
                padding-top: 12px;
            }

            .navbar .nav-link {
                padding-top: 8px;
                padding-bottom: 8px;
            }
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark shadow-sm">
        <div class="container">

            <a class="navbar-brand logo-jefit" href="{{ route('inicio') }}">
                <span class="logo-je">JE</span><span class="logo-fit">FIT</span>
            </a>

            <button class="navbar-toggler"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#navbarNav"
                    aria-controls="navbarNav"
                    aria-expanded="false"
                    aria-label="Abrir menú">

                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">

                {{-- Enlaces principales de la web --}}
                <ul class="navbar-nav me-auto">

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('inicio') }}">
                            Inicio
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('calculadora') }}">
                            IMC
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('inicio') }}#planes">
                            Servicios
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('suplementos.index') }}">
                            Suplementos
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('reels') }}">
                            Fitness Reels
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('contacto') }}">
                            Contacto
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('carrito.index') }}">
                            Carrito
                        </a>
                    </li>

                </ul>

                <ul class="navbar-nav ms-auto">

                    @guest

                        {{-- Si no hay usuario iniciado, muestro login y registro --}}
                        <li class="nav-item">
                            <a class="nav-link fw-bold" href="{{ route('login') }}">
                                Iniciar sesión
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link fw-bold" href="{{ route('register') }}">
                                Registrarse
                            </a>
                        </li>

                    @endguest

                    @auth

                        <li class="nav-item dropdown">

                            <a class="nav-link dropdown-toggle text-white fw-bold"
                               href="#"
                               id="userDropdown"
                               role="button"
                               data-bs-toggle="dropdown"
                               aria-expanded="false">

                                Hola, {{ Auth::user()->name }}
                            </a>

                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">

                                {{-- Si el usuario es admin, enseño las opciones del panel --}}
                                @if (Auth::user()->rol === 'admin')

                                    <li>
                                        <a class="dropdown-item" href="{{ route('admin.index') }}">
                                            Panel admin
                                        </a>
                                    </li>

                                    <li>
                                        <a class="dropdown-item" href="{{ route('admin.pedidos') }}">
                                            Ver pedidos
                                        </a>
                                    </li>

                                    <li>
                                        <a class="dropdown-item" href="{{ route('admin.planes.contratados') }}">
                                            Planes contratados
                                        </a>
                                    </li>

                                @else

                                    {{-- Si es usuario normal, enseño sus compras --}}
                                    <li>
                                        <a class="dropdown-item" href="{{ route('usuario.compras') }}">
                                            Mis compras
                                        </a>
                                    </li>

                                    <li>
                                        <a class="dropdown-item" href="{{ route('usuario.planes') }}">
                                            Mis planes
                                        </a>
                                    </li>

                                @endif

                                <li>
                                    <hr class="dropdown-divider">
                                </li>

                                <li>
                                    <form action="{{ route('logout') }}" method="POST" class="px-3 py-1">
                                        @csrf

                                        <button type="submit" class="btn btn-sm btn-danger w-100">
                                            Cerrar sesión
                                        </button>
                                    </form>
                                </li>

                            </ul>

                        </li>

                    @endauth

                </ul>

            </div>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    <footer class="py-4 mt-5">
        <div class="container text-center">
            <p class="mb-1">
                &copy; {{ date('Y') }} JeFIT - Proyecto de Fin de Grado
            </p>

            <small>
                Desarrollado con Laravel, PHP, JavaScript y Bootstrap
            </small>
        </div>
    </footer>

    {{-- Bootstrap JS hace funcionar el menú responsive, el desplegable y otros componentes --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    @stack('scripts')

</body>
</html>