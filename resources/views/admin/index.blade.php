@extends('layouts.app')

@section('title', 'Panel de Control - jefit')

@section('content')

<div class="container my-5">

    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">

        <h2 class="fw-bold">
            Panel de Control
        </h2>

        <div class="d-flex gap-2 flex-wrap">

            {{-- Botón para revisar los pedidos que hacen los usuarios desde el carrito --}}
            <a href="{{ route('admin.pedidos') }}" class="btn btn-outline-dark">
                Ver pedidos
            </a>

            <a href="{{ route('admin.planes.contratados') }}" class="btn btn-primary">
                Planes contratados
            </a>

            {{-- Botón para añadir un suplemento nuevo desde el panel de administrador --}}
            <a href="{{ route('admin.create') }}" class="btn btn-dark">
                Añadir Suplemento
            </a>

        </div>

    </div>

    {{-- Mensaje de confirmación cuando se crea, edita o borra un suplemento --}}
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card shadow-sm border-0">
        <div class="card-body p-0">

            <div class="table-responsive">

                <table class="table table-hover mb-0">

                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Precio</th>
                            <th>Stock</th>
                            <th>Estado</th>
                            <th class="text-end">Acciones</th>
                        </tr>
                    </thead>

                    <tbody>

                        {{-- Recorro todos los suplementos que llegan desde el AdminController --}}
                        @forelse($suplementos as $suplemento)

                            <tr>
                                <td>
                                    {{ $suplemento->id }}
                                </td>

                                <td class="fw-bold">
                                    {{ $suplemento->nombre }}
                                </td>

                                <td>
                                    {{ number_format($suplemento->precio, 2, ',', '.') }} €
                                </td>

                                <td>
                                    {{-- Muestro el stock para controlar rápido las unidades disponibles --}}
                                    @if ($suplemento->stock > 0)
                                        <span class="badge bg-success">
                                            {{ $suplemento->stock }} unidades
                                        </span>
                                    @else
                                        <span class="badge bg-danger">
                                            Sin stock
                                        </span>
                                    @endif
                                </td>

                                <td>
                                    {{-- Si activo vale 1, el suplemento se muestra en la tienda pública --}}
                                    @if ($suplemento->activo)
                                        <span class="badge bg-primary">
                                            Visible
                                        </span>
                                    @else
                                        <span class="badge bg-secondary">
                                            Oculto
                                        </span>
                                    @endif
                                </td>

                                <td class="text-end">

                                    {{-- Este botón lleva a la pantalla para editar el suplemento --}}
                                    <a href="{{ route('admin.edit', $suplemento->id) }}"
                                       class="btn btn-sm btn-outline-primary">
                                        Editar
                                    </a>

                                    {{-- Para borrar uso un formulario porque Laravel no borra con enlaces normales --}}
                                    <form action="{{ route('admin.destroy', $suplemento->id) }}"
                                          method="POST"
                                          class="d-inline"
                                          onsubmit="return confirm('¿Seguro que quieres borrar este suplemento?')">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn btn-sm btn-outline-danger">
                                            Borrar
                                        </button>

                                    </form>

                                </td>
                            </tr>

                        @empty

                            {{-- Si no hay suplementos en la base de datos, muestro este aviso --}}
                            <tr>
                                <td colspan="6" class="text-center text-secondary py-4">
                                    Todavía no hay suplementos añadidos.
                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>
    </div>

</div>

@endsection