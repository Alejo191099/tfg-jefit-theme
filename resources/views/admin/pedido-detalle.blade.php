@extends('layouts.app')

@section('content')

<section class="container py-5">

    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">

        <div>
            <h1 class="fw-bold mb-1">
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

            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-body">

                    <h5 class="fw-bold mb-3">
                        Datos del cliente
                    </h5>

                    <p class="mb-2">
                        <strong>Nombre:</strong><br>
                        {{ $pedido->nombre_cliente }}
                    </p>

                    <p class="mb-2">
                        <strong>Email:</strong><br>
                        {{ $pedido->email_cliente }}
                    </p>

                    <p class="mb-2">
                        <strong>Fecha:</strong><br>
                        {{ $pedido->created_at->format('d/m/Y H:i') }}
                    </p>

                    <p class="mb-0">
                        <strong>Total:</strong><br>
                        {{ number_format($pedido->total, 2) }} €
                    </p>

                </div>
            </div>

            <div class="card shadow-sm border-0 rounded-4 mt-4">
                <div class="card-body">

                    <h5 class="fw-bold mb-3">
                        Estado del pedido
                    </h5>

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

            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-body">

                    <h5 class="fw-bold mb-3">
                        Suplementos del pedido
                    </h5>

                    <div class="table-responsive">

                        <table class="table align-middle mb-0">

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

                                        <td>
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

@endsection