@extends('layouts.app')

@section('title', 'Planes contratados - Panel admin JeFIT')

@section('content')

<section class="container py-5">

    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">

        <div>
            <h1 class="fw-bold mb-1 planes-admin-title">
                Planes contratados
            </h1>

            <p class="text-muted mb-0">
                Aquí puedo revisar los planes de entrenamiento contratados por los usuarios.
            </p>
        </div>

        <a href="{{ route('admin.index') }}" class="btn btn-secondary">
            Volver al panel
        </a>

    </div>

    <div class="card planes-admin-card shadow-sm rounded-4">
        <div class="card-body p-4">

            <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">

                <div>
                    <h4 class="fw-bold mb-1">
                        Gestión de planes
                    </h4>

                    <p class="text-muted mb-0">
                        Desde aquí el administrador puede ver qué plan ha contratado cada usuario.
                    </p>
                </div>

                <span class="badge bg-success">
                    {{ $planesContratados->count() }} planes
                </span>

            </div>

            <div class="table-responsive">

                <table class="table align-middle mb-0 planes-admin-table">

                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Cliente</th>
                            <th>Email</th>
                            <th>Plan</th>
                            <th>Precio</th>
                            <th>Estado</th>
                            <th>Fecha</th>
                        </tr>
                    </thead>

                    <tbody>

                        {{-- Recorro los planes contratados guardados en la base de datos --}}
                        @forelse ($planesContratados as $planContratado)

                            <tr>
                                <td class="fw-bold">
                                    #{{ $planContratado->id }}
                                </td>

                                <td class="fw-bold">
                                    {{ $planContratado->user->name ?? 'Usuario eliminado' }}
                                </td>

                                <td>
                                    {{ $planContratado->user->email ?? 'Sin email' }}
                                </td>

                                <td class="fw-bold">
                                    {{ $planContratado->nombre_plan }}
                                </td>

                                <td class="fw-bold plan-precio">
                                    {{ number_format($planContratado->precio, 2) }} €
                                </td>

                                <td>
                                    @if ($planContratado->estado === 'activo')
                                        <span class="badge bg-success">
                                            Activo
                                        </span>
                                    @else
                                        <span class="badge bg-secondary">
                                            {{ ucfirst($planContratado->estado) }}
                                        </span>
                                    @endif
                                </td>

                                <td>
                                    {{ $planContratado->created_at->format('d/m/Y H:i') }}
                                </td>
                            </tr>

                        @empty

                            {{-- Si todavía no hay planes contratados, muestro una fila informativa --}}
                            <tr>
                                <td colspan="7" class="text-center text-muted py-4">
                                    Todavía no hay planes contratados.
                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>
    </div>

</section>

<style>
    /*
        Estilos propios de la pantalla de planes contratados del administrador.
        Mantengo el diseño oscuro/neón de JeFIT.
    */

    .planes-admin-title {
        color: #ffffff;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .planes-admin-card {
        background: #15191e;
        border: 1px solid rgba(0, 255, 60, 0.25) !important;
    }

    .planes-admin-table thead th {
        color: #00ff3c;
        border-bottom: 1px solid rgba(0, 255, 60, 0.25);
        white-space: nowrap;
    }

    .planes-admin-table tbody td {
        border-bottom: 1px solid rgba(255, 255, 255, 0.10);
        vertical-align: middle;
    }

    .plan-precio {
        color: #00ff3c;
    }

    @media (max-width: 768px) {
        .planes-admin-table {
            font-size: 14px;
        }
    }
</style>

@endsection