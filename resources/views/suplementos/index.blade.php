@extends('layouts.app')

@section('content')

<section class="container py-5">

    {{-- Título principal de la sección de suplementos --}}
    <div class="text-center mb-5">
        <h1 class="fw-bold">Suplementos</h1>

        <p class="text-muted">
            Aquí puedes ver los suplementos disponibles para complementar tu entrenamiento.
        </p>
    </div>

    {{-- Mensaje que aparece cuando se confirma un pedido o se añade algo correctamente --}}
    @if (session('success'))
        <div class="alert alert-success text-center">
            {{ session('success') }}
        </div>
    @endif

    {{-- Mensaje de error, por ejemplo si un producto no está disponible --}}
    @if (session('error'))
        <div class="alert alert-danger text-center">
            {{ session('error') }}
        </div>
    @endif

    {{-- Botón para ir al carrito desde la página de suplementos --}}
    <div class="d-flex justify-content-end mb-4">
        <a href="{{ route('carrito.index') }}" class="btn btn-outline-dark">
            Ver carrito
        </a>
    </div>

    <div class="row g-4">

        {{-- Recorro todos los suplementos que vienen desde el controlador --}}
        @forelse ($suplementos as $suplemento)

            <div class="col-md-6 col-lg-4">

                <div class="card h-100 shadow-sm border-0 suplemento-card">

                    {{-- Si el suplemento tiene imagen, la muestro. Si no, dejo un bloque simple --}}
                    @if ($suplemento->imagen)
                        <img src="{{ asset($suplemento->imagen) }}"
                             class="card-img-top suplemento-img"
                             alt="{{ $suplemento->nombre }}">
                    @else
                        <div class="suplemento-img-placeholder">
                            <span>JeFIT</span>
                        </div>
                    @endif

                    <div class="card-body d-flex flex-column">

                        {{-- Nombre del suplemento --}}
                        <h5 class="card-title fw-bold">
                            {{ $suplemento->nombre }}
                        </h5>

                        {{-- Descripción corta para que todas las tarjetas tengan un tamaño parecido --}}
                        <p class="card-text text-muted">
                            {{ Str::limit($suplemento->descripcion, 100) }}
                        </p>

                        {{-- Precio del suplemento --}}
                        <p class="fw-bold mb-2">
                            {{ number_format($suplemento->precio, 2) }} €
                        </p>

                        {{-- Muestro si el suplemento está disponible o no --}}
                        @if ($suplemento->stock > 0)
                            <span class="badge bg-success mb-3">
                                Disponible - {{ $suplemento->stock }} unidades
                            </span>
                        @else
                            <span class="badge bg-danger mb-3">
                                Sin stock
                            </span>
                        @endif

                        {{-- Enlace para ver la ficha completa del suplemento --}}
                        <a href="{{ route('suplementos.show', $suplemento) }}"
                           class="btn btn-primary mt-auto">
                            Ver suplemento
                        </a>

                    </div>
                </div>

            </div>

        @empty

            {{-- Si no hay suplementos activos, enseño este mensaje --}}
            <div class="col-12">
                <div class="alert alert-info text-center">
                    Ahora mismo no hay suplementos disponibles.
                </div>
            </div>

        @endforelse

    </div>

</section>

<style>
    /*
        Estos estilos son sencillos y solo mejoran las tarjetas
        sin cambiar demasiado el diseño general de la web.
    */

    .suplemento-card {
        border-radius: 16px;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .suplemento-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 22px rgba(0, 0, 0, 0.12);
    }

    .suplemento-img {
        height: 220px;
        width: 100%;
        object-fit: contain;
        padding: 18px;
        background: #f8f9fa;
        border-top-left-radius: 16px;
        border-top-right-radius: 16px;
    }

    .suplemento-img-placeholder {
        height: 210px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #f1f3f5;
        color: #212529;
        font-size: 28px;
        font-weight: bold;
        border-top-left-radius: 16px;
        border-top-right-radius: 16px;
    }
</style>

@endsection