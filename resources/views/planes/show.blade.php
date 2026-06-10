@extends('layouts.app')

@section('title', $plan['nombre'] . ' - JeFIT')

@section('content')

<section class="container py-5">

    <div class="row justify-content-center">

        <div class="col-lg-9">

            <div class="text-center mb-5">
                <h1 class="fw-bold plan-title">
                    {{ $plan['nombre'] }}
                </h1>

                <p class="text-muted fs-5">
                    {{ $plan['descripcion'] }}
                </p>
            </div>

            <div class="card plan-card shadow-sm rounded-4 mb-4">
                <div class="card-body p-4 p-md-5">

                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">

                        <div>
                            <h3 class="fw-bold mb-1">
                                Características del plan
                            </h3>

                            <p class="text-muted mb-0">
                                Revisa lo que incluye antes de contratarlo.
                            </p>
                        </div>

                        <div class="plan-price">
                            {{ number_format($plan['precio'], 2) }} €
                        </div>

                    </div>

                    <div class="row g-3 mb-4">

                        @foreach ($plan['caracteristicas'] as $caracteristica)

                            <div class="col-md-6">
                                <div class="plan-feature">
                                    <span class="feature-icon">✓</span>
                                    <span>{{ $caracteristica }}</span>
                                </div>
                            </div>

                        @endforeach

                    </div>

                    <div class="alert alert-info">
                        Esta contratación es una simulación. El plan quedará guardado en tu cuenta para poder consultarlo desde <strong>Mis planes</strong>.
                    </div>

                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mt-4">

                        <a href="{{ route('inicio') }}#planes" class="btn btn-secondary">
                            Volver a planes
                        </a>

                        @guest
                            <a href="{{ route('login') }}" class="btn btn-primary">
                                Iniciar sesión para contratar
                            </a>
                        @endguest

                        @auth
                            <form action="{{ route('planes.contratar', $plan['slug']) }}" method="POST">
                                @csrf

                                <button type="submit" class="btn btn-primary">
                                    Contratar plan
                                </button>
                            </form>
                        @endauth

                    </div>

                </div>
            </div>

        </div>

    </div>

</section>

<style>
    /*
        Estilo para el detalle de cada plan.
        Mantengo el estilo oscuro y verde de JeFIT.
    */

    .plan-title {
        color: #00ff3c;
        text-transform: uppercase;
        letter-spacing: 2px;
        text-shadow: 0 0 12px rgba(0, 255, 60, 0.45);
    }

    .plan-card {
        background: #15191e;
        border: 1px solid rgba(0, 255, 60, 0.25) !important;
    }

    .plan-price {
        color: #00ff3c;
        font-size: 2rem;
        font-weight: 900;
    }

    .plan-feature {
        background: #111418;
        border: 1px solid rgba(0, 255, 60, 0.16);
        border-radius: 14px;
        padding: 14px 16px;
        height: 100%;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .feature-icon {
        color: #00ff3c;
        font-weight: 900;
    }
</style>

@endsection