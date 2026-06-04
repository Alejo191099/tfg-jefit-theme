@extends('layouts.app')

@section('content')

<section class="container py-5">

    {{-- Mensaje cuando el suplemento se añade al carrito o aparece algún aviso --}}
    @if (session('success'))
        <div class="alert alert-success text-center">
            {{ session('success') }}
        </div>
    @endif

    {{-- Mensaje de error, por ejemplo si se intenta añadir más stock del disponible --}}
    @if (session('error'))
        <div class="alert alert-danger text-center">
            {{ session('error') }}
        </div>
    @endif

    <div class="row align-items-center g-5">

        <div class="col-md-6">

            {{-- Muestro la imagen grande del suplemento. Si no tiene imagen, dejo un bloque simple --}}
            @if ($suplemento->imagen)
                <img src="{{ asset($suplemento->imagen) }}"
                     class="img-fluid rounded-4 shadow suplemento-detalle-img"
                     alt="{{ $suplemento->nombre }}">
            @else
                <div class="suplemento-img-placeholder rounded-4 shadow">
                    <span>JeFIT</span>
                </div>
            @endif

        </div>

        <div class="col-md-6">

            {{-- Nombre principal del suplemento --}}
            <h1 class="fw-bold mb-3">
                {{ $suplemento->nombre }}
            </h1>

            {{-- Categoría del suplemento, solo se muestra si tiene valor --}}
            @if ($suplemento->categoria)
                <p class="text-muted mb-2">
                    Categoría: {{ $suplemento->categoria }}
                </p>
            @endif

            {{-- Descripción completa del producto --}}
            <p class="lead">
                {{ $suplemento->descripcion }}
            </p>

            {{-- Precio con formato de euros --}}
            <h3 class="fw-bold mb-3">
                {{ number_format($suplemento->precio, 2) }} €
            </h3>

            {{-- Estado del stock para que el usuario sepa si puede comprarlo --}}
            @if ($suplemento->stock > 0)
                <p class="text-success fw-bold">
                    Disponible: {{ $suplemento->stock }} unidades
                </p>
            @else
                <p class="text-danger fw-bold">
                    Producto sin stock
                </p>
            @endif

            {{-- 
                Si hay stock, dejo añadir al carrito.
                Si no hay stock, dejo el botón desactivado.
            --}}
            @if ($suplemento->stock > 0)

                <form action="{{ route('carrito.agregar', $suplemento) }}" method="POST" class="mt-4">
                    @csrf

                    <div class="mb-3">
                        <label for="cantidad" class="form-label">
                            Cantidad
                        </label>

                        <input type="number"
                               name="cantidad"
                               id="cantidad"
                               class="form-control cantidad-input"
                               min="1"
                               max="{{ $suplemento->stock }}"
                               value="1"
                               required>
                    </div>

                    <div class="d-flex gap-2 flex-wrap">

                        <button type="submit" class="btn btn-primary">
                            Añadir al carrito
                        </button>

                        <a href="{{ route('carrito.index') }}" class="btn btn-outline-dark">
                            Ver carrito
                        </a>

                    </div>
                </form>

            @else

                <button class="btn btn-secondary mt-3" disabled>
                    Producto sin stock
                </button>

            @endif

            {{-- Enlace para volver al listado de suplementos --}}
            <div class="mt-4">
                <a href="{{ route('suplementos.index') }}" class="text-decoration-none">
                    Volver a suplementos
                </a>
            </div>

        </div>
    </div>

</section>

<style>
    /*
        Estilos sencillos para que la ficha del suplemento se vea mejor
        sin cambiar demasiado el diseño general de la web.
    */

    .suplemento-detalle-img {
        width: 100%;
        max-height: 430px;
        object-fit: contain;
        padding: 20px;
        background: #f8f9fa;
    }

    .suplemento-img-placeholder {
        height: 360px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #f1f3f5;
        color: #212529;
        font-size: 36px;
        font-weight: bold;
    }

    .cantidad-input {
        max-width: 150px;
    }
</style>

@endsection