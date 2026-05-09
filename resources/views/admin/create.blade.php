@extends('layouts.app')

@section('title', 'Añadir Suplemento - jefit')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="fw-bold">Añadir Nuevo Suplemento</h2>
                <a href="{{ route('admin.index') }}" class="btn btn-outline-secondary">Volver</a>
            </div>

            <div class="card shadow-sm border-0 p-4">
                {{-- Formulario para crear un producto nuevo en la tabla suplementos. --}}
                <form action="{{ route('admin.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="nombre" class="form-label fw-bold">Nombre del producto</label>
                        <input type="text" id="nombre" name="nombre" class="form-control @error('nombre') is-invalid @enderror" required placeholder="Ej: BCAA 2:1:1" value="{{ old('nombre') }}">
                        @error('nombre')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <label for="precio" class="form-label fw-bold">Precio (€)</label>
                        <input type="number" id="precio" step="0.01" min="0" name="precio" class="form-control @error('precio') is-invalid @enderror" required placeholder="Ej: 19.99" value="{{ old('precio') }}">
                        @error('precio')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-4">
                        <label for="descripcion" class="form-label fw-bold">Descripción</label>
                        <textarea id="descripcion" name="descripcion" class="form-control @error('descripcion') is-invalid @enderror" rows="4" required placeholder="Escribe los detalles del producto...">{{ old('descripcion') }}</textarea>
                        @error('descripcion')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <button type="submit" class="btn btn-dark w-100 py-2 fw-bold">Guardar Suplemento</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
