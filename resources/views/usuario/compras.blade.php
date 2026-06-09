@extends('layouts.app')

@section('title', 'Mis compras - JeFIT')

@section('content')

<section class="container py-5">

    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">

        <div>
            <h1 class="fw-bold mb-1 compras-title">
                Mis compras
            </h1>

            <p class="text-muted mb-0">
                Aquí puedes ver los suplementos que has comprado y el estado de cada pedido.
            </p>
        </div>

        <a href="{{ route('suplementos.index') }}" class="btn btn-primary">
            Ver suplementos
        </a>

    </div>

    {{-- Mensaje cuando el usuario se registra o realiza alguna acción correctamente --}}
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if ($pedidos->count() > 0)

        {{-- Recorro los pedidos del usuario --}}
        @foreach ($pedidos as $pedido)

            <div class="card compra-card shadow-sm rounded-4 mb-4">
                <div class="card-body p-4">

                    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">

                        <div>
                            <h5 class="fw-bold mb-1">
                                Pedido #{{ $pedido->id }}
                            </h5>

                            <p class="text-muted mb-0">
                                Fecha: {{ $pedido->created_at->format('d/m/Y H:i') }}
                            </p>
                        </div>

                        <div class="text-md-end">

                            {{-- Muestro el estado del pedido con un color sencillo --}}
                            @if ($pedido->estado === 'pendiente')
                                <span class="badge bg-warning text-dark">
                                    Pendiente
                                </span>
                            @elseif ($pedido->estado === 'contactado')
                                <span class="badge bg-info text-dark">
                                    Contactado
                                </span>
                            @elseif ($pedido->estado === 'completado')
                                <span class="badge bg-success">
                                    Completado
                                </span>
                            @else
                                <span class="badge bg-danger">
                                    Cancelado
                                </span>
                            @endif

                            <p class="fw-bold mt-2 mb-0 total-compra">
                                Total: {{ number_format($pedido->total, 2) }} €
                            </p>

                        </div>

                    </div>

                    <div class="table-responsive">

                        <table class="table align-middle mb-0 compras-table">

                            <thead>
                                <tr>
                                    <th>Suplemento</th>
                                    <th>Cantidad</th>
                                    <th>Precio</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>

                            <tbody>

                                {{-- Recorro los suplementos que iban dentro del pedido --}}
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

                                    <tr>
                                        <td colspan="4" class="text-center text-muted py-3">
                                            Este pedido no tiene productos asociados.
                                        </td>
                                    </tr>

                                @endforelse

                            </tbody>

                        </table>

                    </div>

                </div>
            </div>

        @endforeach

    @else

        {{-- Si el usuario todavía no ha comprado nada, le muestro este mensaje --}}
        <div class="card compra-card shadow-sm rounded-4 text-center">
            <div class="card-body p-5">

                <h4 class="fw-bold">
                    Todavía no tienes compras
                </h4>

                <p class="text-muted">
                    Cuando confirmes un pedido, aparecerá aquí.
                </p>

                <a href="{{ route('suplementos.index') }}" class="btn btn-primary">
                    Ver suplementos
                </a>

            </div>
        </div>

    @endif

</section>

<style>
    /*
        Estilos propios de la pantalla Mis compras.
        Los dejo aquí porque solo afectan a esta vista.
    */

    .compras-title {
        color: #ffffff;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .compra-card {
        background: #15191e;
        border: 1px solid rgba(0, 255, 60, 0.25) !important;
    }

    .total-compra {
        color: #00ff3c;
    }

    .compras-table thead th {
        color: #00ff3c;
        border-bottom: 1px solid rgba(0, 255, 60, 0.25);
    }

    .compras-table tbody td {
        border-bottom: 1px solid rgba(255, 255, 255, 0.10);
    }
</style>

@endsection