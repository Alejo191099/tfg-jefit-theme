@extends('layouts.app')

@section('title', 'Panel de Control - jefit')

@section('content')
<div class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">Panel de Control</h2>
        <a href="{{ route('admin.create') }}" class="btn btn-dark">Añadir Suplemento</a>
    </div>

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
                            <th class="text-end">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($suplementos as $suplemento)
                            <tr>
                                <td>{{ $suplemento->id }}</td>
                                <td class="fw-bold">{{ $suplemento->nombre }}</td>
                                <td>{{ number_format($suplemento->precio, 2, ',', '.') }} €</td>
                                <td class="text-end">
                                    {{-- Ahora el botón editar sí lleva a una pantalla real de edición. --}}
                                    <a href="{{ route('admin.edit', $suplemento->id) }}" class="btn btn-sm btn-outline-primary">Editar</a>

                                    {{-- Para borrar uso un formulario porque Laravel no borra con enlaces GET. --}}
                                    <form action="{{ route('admin.destroy', $suplemento->id) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Seguro que quieres borrar este suplemento?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">Borrar</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-secondary py-4">
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
