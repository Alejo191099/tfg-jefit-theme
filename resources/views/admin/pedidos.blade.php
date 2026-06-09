@extends('layouts.app')

@section('title', 'Pedidos - Panel admin JeFIT')

@section('content')

<section class="container py-5">

    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">

        <div>
            <h1 class="fw-bold mb-1 pedidos-title">
                Pedidos
            </h1>

            <p class="text-muted mb-0">
                Aquí puedo revisar las compras simuladas que hacen los usuarios.
            </p>
        </div>

        <a href="{{ route('admin.index') }}" class="btn btn-secondary">
            Volver al panel
        </a>

    </div>

    {{-- Mensaje de confirmación cuando se actualiza un pedido --}}
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card pedidos-card shadow-sm rounded-4">
        <div class="card-body p-4">

            <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
                <div>
                    <h4 class="fw-bold mb-1">
                        Gestión de pedidos
                    </h4>

                    <p class="text-muted mb-0">
                        Desde aquí puedo entrar al detalle de cada pedido y cambiar su estado.
                    </p>
                </div>

                <span class="badge bg-success">
                    {{ $pedidos->count() }} pedidos
                </span>
            </div>

            <div class="table-responsive">

                <table class="table align-middle mb-0 pedidos-table">

                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Cliente</th>
                            <th>Email</th>
                            <th>Total</th>
                            <th>Estado</th>
                            <th>Fecha</th>
                            <th class="text-end">Acción</th>
                        </tr>
                    </thead>

                    <tbody>

                        {{-- Recorro los pedidos guardados en la base de datos --}}
                        @forelse ($pedidos as $pedido)

                            <tr>
                                <td class="fw-bold">
                                    #{{ $pedido->id }}
                                </td>

                                <td class="fw-bold">
                                    {{ $pedido->nombre_cliente }}
                                </td>

                                <td>
                                    {{ $pedido->email_cliente }}
                                </td>

                                <td class="fw-bold total-pedido">
                                    {{ number_format($pedido->total, 2) }} €
                                </td>

                                <td>
                                    {{-- Muestro un color diferente según el estado del pedido --}}
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
                                </td>

                                <td>
                                    {{ $pedido->created_at->format('d/m/Y H:i') }}
                                </td>

                                <td class="text-end">
                                    <a href="{{ route('admin.pedidos.show', $pedido) }}"
                                       class="btn btn-primary btn-sm">
                                        Ver detalle
                                    </a>
                                </td>
                            </tr>

                        @empty

                            {{-- Si todavía no hay pedidos, muestro una fila informativa --}}
                            <tr>
                                <td colspan="7" class="text-center text-muted py-4">
                                    Todavía no hay pedidos registrados.
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
        Estilos propios de la pantalla de pedidos del administrador.
        Mantengo el mismo estilo oscuro y verde de JeFIT.
    */

    .pedidos-title {
        color: #ffffff;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .pedidos-card {
        background: #15191e;
        border: 1px solid rgba(0, 255, 60, 0.25) !important;
    }

    .pedidos-table thead th {
        color: #00ff3c;
        border-bottom: 1px solid rgba(0, 255, 60, 0.25);
        white-space: nowrap;
    }

    .pedidos-table tbody td {
        border-bottom: 1px solid rgba(255, 255, 255, 0.10);
        vertical-align: middle;
    }

    .total-pedido {
        color: #00ff3c;
    }

    @media (max-width: 768px) {
        .pedidos-table {
            font-size: 14px;
        }
    }
</style>

@endsection