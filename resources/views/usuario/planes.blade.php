@extends('layouts.app')

@section('title', 'Mis planes - JeFIT')

@section('content')

<section class="container py-5">

    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">

        <div>
            <h1 class="fw-bold mis-planes-title">
                Mis planes
            </h1>

            <p class="text-muted mb-0">
                Aquí puedes ver los planes de entrenamiento que tienes contratados.
            </p>
        </div>

        <a href="{{ route('inicio') }}#planes" class="btn btn-primary">
            Ver planes
        </a>

    </div>

    {{-- Mensaje cuando se contrata un plan correctamente --}}
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if ($planesContratados->count() > 0)

        <div class="row g-4">

            {{-- Recorro los planes contratados por el usuario --}}
            @foreach ($planesContratados as $planContratado)

                <div class="col-md-6 col-lg-4">

                    <div class="card mis-plan-card shadow-sm rounded-4 h-100">
                        <div class="card-body p-4">

                            <h4 class="fw-bold mb-2">
                                {{ $planContratado->nombre_plan }}
                            </h4>

                            <p class="text-muted mb-3">
                                Contratado el {{ $planContratado->created_at->format('d/m/Y') }}
                            </p>

                            <p class="mb-2">
                                <span class="mis-plan-label">Precio</span><br>
                                <strong class="mis-plan-price">
                                    {{ number_format($planContratado->precio, 2) }} €
                                </strong>
                            </p>

                            <p class="mb-4">
                                <span class="mis-plan-label">Estado</span><br>

                                @if ($planContratado->estado === 'activo')
                                    <span class="badge bg-success mt-1">
                                        Activo
                                    </span>
                                @else
                                    <span class="badge bg-secondary mt-1">
                                        {{ ucfirst($planContratado->estado) }}
                                    </span>
                                @endif
                            </p>

                            <a href="{{ route('planes.show', $planContratado->slug_plan) }}" class="btn btn-outline-dark w-100">
                                Ver características
                            </a>

                        </div>
                    </div>

                </div>

            @endforeach

        </div>

    @else

        {{-- Si el usuario no ha contratado ningún plan todavía --}}
        <div class="card mis-plan-card shadow-sm rounded-4 text-center">
            <div class="card-body p-5">

                <h4 class="fw-bold">
                    Todavía no tienes planes contratados
                </h4>

                <p class="text-muted">
                    Elige un plan de entrenamiento y aparecerá aquí.
                </p>

                <a href="{{ route('inicio') }}#planes" class="btn btn-primary">
                    Ver planes
                </a>

            </div>
        </div>

    @endif

</section>

<style>
    /*
        Estilos propios de Mis planes.
        Mantengo el diseño oscuro/neón de JeFIT.
    */

    .mis-planes-title {
        color: #ffffff;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .mis-plan-card {
        background: #15191e;
        border: 1px solid rgba(0, 255, 60, 0.25) !important;
    }

    .mis-plan-label {
        color: #9ca3af;
        font-size: 14px;
    }

    .mis-plan-price {
        color: #00ff3c;
        font-size: 1.4rem;
    }
</style>

@endsection