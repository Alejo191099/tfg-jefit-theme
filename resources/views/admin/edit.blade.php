@extends('layouts.app')

@section('title', 'Editar Suplemento - jefit')

@section('content')

<div class="container my-5">

    <div class="row justify-content-center">

        <div class="col-md-8">

            <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">

                <h2 class="fw-bold">
                    Editar Suplemento
                </h2>

                <a href="{{ route('admin.index') }}" class="btn btn-outline-secondary">
                    Volver
                </a>

            </div>

            <div class="card shadow-sm border-0 p-4">

                {{-- Formulario para modificar un suplemento que ya existe --}}
                <form action="{{ route('admin.update', $suplemento->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="nombre" class="form-label fw-bold">
                            Nombre del producto
                        </label>

                        <input type="text"
                               id="nombre"
                               name="nombre"
                               class="form-control @error('nombre') is-invalid @enderror"
                               required
                               value="{{ old('nombre', $suplemento->nombre) }}">

                        @error('nombre')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="precio" class="form-label fw-bold">
                            Precio (€)
                        </label>

                        <input type="number"
                               id="precio"
                               name="precio"
                               step="0.01"
                               min="0"
                               class="form-control @error('precio') is-invalid @enderror"
                               required
                               value="{{ old('precio', $suplemento->precio) }}">

                        @error('precio')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="stock" class="form-label fw-bold">
                            Stock
                        </label>

                        <input type="number"
                               id="stock"
                               name="stock"
                               min="0"
                               class="form-control @error('stock') is-invalid @enderror"
                               required
                               value="{{ old('stock', $suplemento->stock) }}">

                        @error('stock')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                        <small class="text-muted">
                            Aquí puedo modificar las unidades disponibles.
                        </small>
                    </div>

                    <div class="mb-3">
                        <label for="imagen" class="form-label fw-bold">
                            Imagen
                        </label>

                        <input type="text"
                               id="imagen"
                               name="imagen"
                               class="form-control @error('imagen') is-invalid @enderror"
                               placeholder="Ej: suplementos/creatina.jpg"
                               value="{{ old('imagen', $suplemento->imagen) }}">

                        @error('imagen')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                        <small class="text-muted">
                            De momento la imagen se guarda como ruta o nombre de archivo.
                        </small>
                    </div>

                    <div class="mb-4">
                        <label for="descripcion" class="form-label fw-bold">
                            Descripción
                        </label>

                        <textarea id="descripcion"
                                  name="descripcion"
                                  class="form-control @error('descripcion') is-invalid @enderror"
                                  rows="4"
                                  required>{{ old('descripcion', $suplemento->descripcion) }}</textarea>

                        @error('descripcion')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-check form-switch mb-4">

                        {{-- Si está marcado, el suplemento se muestra en la tienda pública --}}
                        <input class="form-check-input"
                               type="checkbox"
                               role="switch"
                               id="activo"
                               name="activo"
                               value="1"
                               {{ old('activo', $suplemento->activo) ? 'checked' : '' }}>

                        <label class="form-check-label" for="activo">
                            Mostrar este suplemento en la tienda
                        </label>

                    </div>

                    <button type="submit" class="btn btn-dark w-100 py-2 fw-bold">
                        Guardar Cambios
                    </button>

                </form>

            </div>

        </div>

    </div>

</div>

@endsection