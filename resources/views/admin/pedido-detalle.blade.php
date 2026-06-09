@extends('layouts.app')

@section('title', 'Detalle pedido - Panel admin JeFIT')

@section('content')

<section class="container py-5">

    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">

        <div>
            <h1 class="fw-bold mb-1 pedido-detalle-title">
                Pedido #{{ $pedido->id }}
            </h1>

            <p class="text-muted mb-0">
                Detalle del pedido realizado por el usuario.
            </p>
        </div>

        <a href="{{ route('admin.pedidos') }}" class="btn btn-secondary">
            Volver a pedidos
        </a>

    </div>

    {{-- Mensaje cuando se cambia el estado correctamente --}}
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="row g-4">

        <div class="col-md-4">

            <div class="card detalle-card shadow-sm rounded-4">
                <div class="card-body p-4">

                    <h5 class="fw-bold mb-3">
                        Datos del cliente
                    </h5>

                    <p class="mb-3">
                        <span class="detalle-label">Nombre</span><br>
                        <strong>{{ $pedido->nombre_cliente }}</strong>
                    </p>

                    <p class="mb-3">
                        <span class="detalle-label">Email</span><br>
                        {{ $pedido->email_cliente }}
                    </p>

                    <p class="mb-3">
                        <span class="detalle-label">Fecha</span><br>
                        {{ $pedido->created_at->format('d/m/Y H:i') }}
                    </p>

                    <p class="mb-0">
                        <span class="detalle-label">Total</span><br>
                        <strong class="detalle-total">
                            {{ number_format($pedido->total, 2) }} €
                        </strong>
                    </p>

                </div>
            </div>

            <div class="card detalle-card shadow-sm rounded-4 mt-4">
                <div class="card-body p-4">

                    <h5 class="fw-bold mb-3">
                        Estado del pedido
                    </h5>

                    <div class="mb-3">
                        <span class="detalle-label">Estado actual</span><br>

                        {{-- Muestro el estado actual antes de cambiarlo --}}
                        @if ($pedido->estado === 'pendiente')
                            <span class="badge bg-warning text-dark mt-2">
                                Pendiente
                            </span>
                        @elseif ($pedido->estado === 'contactado')
                            <span class="badge bg-info text-dark mt-2">
                                Contactado
                            </span>
                        @elseif ($pedido->estado === 'completado')
                            <span class="badge bg-success mt-2">
                                Completado
                            </span>
                        @else
                            <span class="badge bg-danger mt-2">
                                Cancelado
                            </span>
                        @endif
                    </div>

                    {{-- Desde aquí cambio el estado del pedido sin modificar el resto de datos --}}
                    <form action="{{ route('admin.pedidos.estado', $pedido) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="estado" class="form-label">
                                Cambiar estado
                            </label>

                            <select name="estado" id="estado" class="form-select">
                                <option value="pendiente" {{ $pedido->estado === 'pendiente' ? 'selected' : '' }}>
                                    Pendiente
                                </option>

                                <option value="contactado" {{ $pedido->estado === 'contactado' ? 'selected' : '' }}>
                                    Contactado
                                </option>

                                <option value="completado" {{ $pedido->estado === 'completado' ? 'selected' : '' }}>
                                    Completado
                                </option>

                                <option value="cancelado" {{ $pedido->estado === 'cancelado' ? 'selected' : '' }}>
                                    Cancelado
                                </option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">
                            Guardar estado
                        </button>
                    </form>

                </div>
            </div>

        </div>

        <div class="col-md-8">

            <div class="card detalle-card shadow-sm rounded-4">
                <div class="card-body p-4">

                    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
                        <div>
                            <h5 class="fw-bold mb-1">
                                Suplementos del pedido
                            </h5>

                            <p class="text-muted mb-0">
                                Productos incluidos en esta compra simulada.
                            </p>
                        </div>

                        <span class="badge bg-success">
                            {{ $pedido->detalles->count() }} productos
                        </span>
                    </div>

                    <div class="table-responsive">

                        <table class="table align-middle mb-0 detalle-table">

                            <thead>
                                <tr>
                                    <th>Suplemento</th>
                                    <th>Cantidad</th>
                                    <th>Precio unitario</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>

                            <tbody>

                                {{-- Recorro los suplementos que forman parte de este pedido --}}
                                @forelse ($pedido->detalles as $detalle)

                                    <tr>
                                        <td class="fw-bold">
                                            {{ $detalle->suplemento->nombre ?? 'Suplemento eliminado' }}
                                        </td>

                                        <td>
                                            {{ $detalle->cantidad }}
                                        </td>

                                        <td>
                                            {{ number_format($detalle->precio_unitario, 2) }} €
                                        </td>

                                        <td class="fw-bold detalle-subtotal">
                                            {{ number_format($detalle->subtotal, 2) }} €
                                        </td>
                                    </tr>

                                @empty

                                    {{-- Esto se mostraría si por algún motivo el pedido no tiene productos --}}
                                    <tr>
                                        <td colspan="4" class="text-center text-muted py-4">
                                            Este pedido no tiene suplementos asociados.
                                        </td>
                                    </tr>

                                @endforelse

                            </tbody>

                        </table>

                    </div>

                </div>
            </div>

        </div>

    </div>

</section>

<style>
    /*
        Estilos propios del detalle del pedido.
        Mantengo el diseño oscuro/neón de JeFIT.
    */

    .pedido-detalle-title {
        color: #ffffff;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .detalle-card {
        background: #15191e;
        border: 1px solid rgba(0, 255, 60, 0.25) !important;
    }

    .detalle-label {
        color: #9ca3af;
        font-size: 14px;
    }

    .detalle-total,
    .detalle-subtotal {
        color: #00ff3c;
    }

    .detalle-table thead th {
        color: #00ff3c;
        border-bottom: 1px solid rgba(0, 255, 60, 0.25);
        white-space: nowrap;
    }

    .detalle-table tbody td {
        border-bottom: 1px solid rgba(255, 255, 255, 0.10);
        vertical-align: middle;
    }

    @media (max-width: 768px) {
        .detalle-table {
            font-size: 14px;
        }
    }
</style>

@endsection