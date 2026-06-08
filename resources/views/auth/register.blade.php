@extends('layouts.app')

@section('title', 'Registro - JeFIT')

@section('content')

<section class="register-section py-5">

    <div class="container">

        <div class="row justify-content-center">

            <div class="col-md-6 col-lg-5">

                <div class="text-center mb-4">
                    <h1 class="fw-bold register-title">
                        Crear cuenta
                    </h1>

                    <p class="text-muted">
                        Regístrate para ver tus compras y seguir tu actividad en JeFIT.
                    </p>
                </div>

                <div class="card register-card shadow-sm rounded-4">
                    <div class="card-body p-4">

                        {{-- Formulario para registrar un usuario nuevo --}}
                        <form action="{{ route('register.post') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label for="name" class="form-label fw-bold">
                                    Nombre
                                </label>

                                <input type="text"
                                       name="name"
                                       id="name"
                                       class="form-control @error('name') is-invalid @enderror"
                                       placeholder="Tu nombre"
                                       value="{{ old('name') }}"
                                       required>

                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label fw-bold">
                                    Correo electrónico
                                </label>

                                <input type="email"
                                       name="email"
                                       id="email"
                                       class="form-control @error('email') is-invalid @enderror"
                                       placeholder="ejemplo@correo.com"
                                       value="{{ old('email') }}"
                                       required>

                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label fw-bold">
                                    Contraseña
                                </label>

                                <div class="input-group">
                                    <input type="password"
                                           name="password"
                                           id="password"
                                           class="form-control @error('password') is-invalid @enderror"
                                           placeholder="Mínimo 6 caracteres"
                                           required>

                                    {{-- Botón para ver u ocultar la contraseña --}}
                                    <button type="button"
                                            class="btn btn-outline-success"
                                            onclick="mostrarPassword('password', this)">
                                        Ver
                                    </button>
                                </div>

                                @error('password')
                                    <div class="text-danger small mt-1">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="password_confirmation" class="form-label fw-bold">
                                    Repetir contraseña
                                </label>

                                <div class="input-group">
                                    <input type="password"
                                           name="password_confirmation"
                                           id="password_confirmation"
                                           class="form-control"
                                           placeholder="Repite la contraseña"
                                           required>

                                    {{-- Botón para ver u ocultar la repetición de contraseña --}}
                                    <button type="button"
                                            class="btn btn-outline-success"
                                            onclick="mostrarPassword('password_confirmation', this)">
                                        Ver
                                    </button>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary w-100 py-2 fw-bold">
                                Crear cuenta
                            </button>

                        </form>

                        <div class="text-center mt-3">
                            <p class="mb-0 text-muted">
                                ¿Ya tienes cuenta?
                                <a href="{{ route('login') }}" class="text-decoration-none text-success fw-bold">
                                    Inicia sesión
                                </a>
                            </p>
                        </div>

                    </div>
                </div>

            </div>

        </div>

    </div>

</section>

<style>
    /*
        Estilo propio para el registro.
        Mantengo el mismo diseño que el login para que la web sea coherente.
    */

    .register-section {
        min-height: 75vh;
        display: flex;
        align-items: center;
    }

    .register-title {
        color: #ffffff;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .register-card {
        background: #15191e;
        border: 1px solid rgba(0, 255, 60, 0.25) !important;
    }

    .register-card label {
        color: #f8f9fa;
    }

    .register-card .form-control {
        background: #1d2126;
        color: #ffffff;
        border: 1px solid #343a40;
    }

    .register-card .form-control:focus {
        background: #1d2126;
        color: #ffffff;
        border-color: #00c832;
        box-shadow: 0 0 0 0.2rem rgba(0, 200, 50, 0.25);
    }
</style>

<script>
    /*
        Reutilizo esta función para los dos campos de contraseña.
        Así el usuario puede comprobar si ha escrito bien la contraseña.
    */
    function mostrarPassword(idCampo, boton) {
        const campo = document.getElementById(idCampo);

        if (campo.type === 'password') {
            campo.type = 'text';
            boton.textContent = 'Ocultar';
        } else {
            campo.type = 'password';
            boton.textContent = 'Ver';
        }
    }
</script>

@endsection