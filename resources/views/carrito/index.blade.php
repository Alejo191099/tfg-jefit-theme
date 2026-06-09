@extends('layouts.app')

@section('content')

<section class="container py-5">

    {{-- Título principal del carrito --}}
    <div class="text-center mb-5">
        <h1 class="fw-bold">Carrito</h1>

        <p class="text-muted">
            Revisa los suplementos antes de confirmar el pedido.
        </p>
    </div>

    {{-- Mensaje cuando algo se hace correctamente --}}
    @if (session('success'))
        <div class="alert alert-success text-center">
            {{ session('success') }}
        </div>
    @endif

    {{-- Mensaje cuando hay algún error --}}
    @if (session('error'))
        <div class="alert alert-danger text-center">
            {{ session('error') }}
        </div>
    @endif

    {{-- Si hay productos en el carrito, los enseño en una tabla --}}
    @if (count($carrito) > 0)

        <div class="card shadow-sm border-0 rounded-4 mb-4">
            <div class="card-body">

                <div class="table-responsive">
                    <table class="table align-middle mb-0">
                        <thead>
                            <tr>
                                <th>Suplemento</th>
                                <th>Precio</th>
                                <th>Cantidad</th>
                                <th>Subtotal</th>
                                <th class="text-end">Acción</th>
                            </tr>
                        </thead>

                        <tbody>
                            @php
                                $total = 0;
                            @endphp

                            @foreach ($carrito as $producto)
                                @php
                                    // Calculo el subtotal de este producto
                                    $subtotal = $producto['precio'] * $producto['cantidad'];

                                    // Voy sumando cada subtotal al total del carrito
                                    $total = $total + $subtotal;
                                @endphp

                                <tr>
                                    <td class="fw-bold">
                                        {{ $producto['nombre'] }}
                                    </td>

                                    <td>
                                        {{ number_format($producto['precio'], 2) }} €
                                    </td>

                                    <td>
                                        {{ $producto['cantidad'] }}
                                    </td>

                                    <td>
                                        {{ number_format($subtotal, 2) }} €
                                    </td>

                                    <td class="text-end">
                                        <form action="{{ route('carrito.eliminar', $producto['id']) }}" method="POST">
                                            @csrf

                                            <button type="submit" class="btn btn-outline-danger btn-sm">
                                                Eliminar
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- Total final del carrito --}}
                <div class="text-end mt-4">
                    <h4 class="fw-bold">
                        Total: {{ number_format($total, 2) }} €
                    </h4>
                </div>

            </div>
        </div>

        {{-- Botones para seguir comprando o vaciar el carrito --}}
        <div class="d-flex justify-content-between mb-4 flex-wrap gap-2">

            <a href="{{ route('suplementos.index') }}" class="btn btn-secondary">
                Seguir comprando
            </a>

            <form action="{{ route('carrito.vaciar') }}" method="POST">
                @csrf

                <button type="submit" class="btn btn-outline-danger">
                    Vaciar carrito
                </button>
            </form>

        </div>

        {{-- Formulario para confirmar el pedido --}}
        <div class="card shadow-sm border-0 rounded-4">
            <div class="card-body p-4">

                <h4 class="fw-bold mb-3">
                    Confirmar pedido
                </h4>

                <p class="text-muted">
                    Esta compra es una simulación. El pedido se guarda para que el administrador pueda revisarlo.
                </p>

                @guest
                    {{-- Aviso para explicar la ventaja de iniciar sesión antes de comprar --}}
                    <div class="alert alert-info">
                        Puedes comprar como invitado, pero si inicias sesión antes de confirmar el pedido,
                        podrás verlo después en la sección <strong>Mis compras</strong>.
                    </div>

                    <div class="d-flex gap-2 flex-wrap mb-3">
                        <a href="{{ route('login') }}" class="btn btn-outline-dark btn-sm">
                            Iniciar sesión
                        </a>

                        <a href="{{ route('register') }}" class="btn btn-outline-dark btn-sm">
                            Crear cuenta
                        </a>
                    </div>
                @endguest

                @auth
                    {{-- Si el usuario está logueado, le aviso de que el pedido quedará guardado en su cuenta --}}
                    <div class="alert alert-success">
                        Este pedido quedará asociado a tu cuenta y podrás consultarlo en <strong>Mis compras</strong>.
                    </div>
                @endauth

                <form action="{{ route('carrito.confirmar') }}" method="POST">
                    @csrf

                    <div class="row">

                        <div class="col-md-6 mb-3">
                            <label for="nombre_cliente" class="form-label">
                                Nombre
                            </label>

                            <input type="text"
                                   name="nombre_cliente"
                                   id="nombre_cliente"
                                   class="form-control"
                                   value="{{ auth()->user()->name ?? old('nombre_cliente') }}"
                                   required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="email_cliente" class="form-label">
                                Correo electrónico
                            </label>

                            <input type="email"
                                   name="email_cliente"
                                   id="email_cliente"
                                   class="form-control"
                                   value="{{ auth()->user()->email ?? old('email_cliente') }}"
                                   required>
                        </div>

                    </div>

                    <button type="submit" class="btn btn-primary">
                        Confirmar pedido
                    </button>
                </form>

            </div>
        </div>

    @else

        {{-- Si el carrito está vacío, muestro un aviso sencillo --}}
        <div class="card shadow-sm border-0 rounded-4 text-center">
            <div class="card-body p-5">

                <h4 class="fw-bold">
                    Tu carrito está vacío
                </h4>

                <p class="text-muted">
                    Añade algún suplemento para poder confirmar un pedido.
                </p>

                <a href="{{ route('suplementos.index') }}" class="btn btn-primary">
                    Ver suplementos
                </a>

            </div>
        </div>

    @endif

</section>

@endsection