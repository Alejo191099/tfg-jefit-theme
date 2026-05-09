@extends('layouts.app')

@section('title', 'Login - jefit')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card shadow-sm border-0 bg-light p-4">
                <h2 class="text-center fw-bold mb-4">Iniciar Sesión</h2>

                @if($errors->any())
                    <div class="alert alert-danger text-center">
                        {{ $errors->first() }}
                    </div>
                @endif

                {{-- Formulario para entrar al panel. El email se mantiene si hay error. --}}
                <form action="{{ route('login.post') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="email" class="form-label text-secondary">Correo Electrónico</label>
                        <input type="email" id="email" name="email" class="form-control" required placeholder="ejemplo@correo.com" value="{{ old('email') }}">
                    </div>

                    <div class="mb-4">
                        <label for="password" class="form-label text-secondary">Contraseña</label>
                        <input type="password" id="password" name="password" class="form-control" required placeholder="********">
                    </div>

                    <button type="submit" class="btn btn-dark w-100 py-2 fw-bold">Entrar</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
