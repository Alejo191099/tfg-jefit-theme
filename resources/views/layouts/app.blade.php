<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'jefit - Entrenamiento y Nutrición')</title>

    {{-- Bootstrap por CDN para no complicar la instalación del diseño. --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* Hago que el footer se quede abajo aunque una página tenga poco contenido. */
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        main {
            flex: 1;
        }

        .navbar-brand {
            font-weight: 800;
            letter-spacing: 1px;
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
        <div class="container">
            <a class="navbar-brand text-uppercase" href="{{ route('inicio') }}">jefit</a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                {{-- Enlaces principales de la web. Uso route() para no escribir las URL a mano. --}}
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('inicio') }}">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('calculadora') }}">Calculadora IMC</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('inicio') }}#planes">Servicios</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('reels') }}">Fitness Reels</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('contacto') }}">Contacto</a>
                    </li>
                </ul>

                <ul class="navbar-nav ms-auto">
                    @guest
                        <li class="nav-item">
                            <a class="nav-link fw-bold text-white" href="{{ route('login') }}">Iniciar Sesión</a>
                        </li>
                    @endguest

                    @auth
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-white fw-bold" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Hola, {{ Auth::user()->name }}
                            </a>

                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                <li>
                                    <a class="dropdown-item" href="{{ route('admin.index') }}">Panel admin</a>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form action="{{ route('logout') }}" method="POST" class="px-3 py-1">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-danger w-100 text-start">Cerrar Sesión</button>
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

    <footer class="bg-white border-top py-4 mt-5">
        <div class="container text-center text-secondary">
            <p class="mb-0">&copy; {{ date('Y') }} jefit - Proyecto de Fin de Grado</p>
            <small>Desarrollado con Laravel y Bootstrap </small>
        </div>
    </footer>

    {{-- Bootstrap JS hace funcionar el menú responsive, el desplegable y el acordeón. --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
