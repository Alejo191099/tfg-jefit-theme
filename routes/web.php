<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CarritoController;
use App\Http\Controllers\ImcController;
use App\Http\Controllers\SuplementoController;
use App\Http\Controllers\UsuarioController;
use App\Models\Suplemento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Rutas públicas
|--------------------------------------------------------------------------
| Estas rutas las puede ver cualquier persona sin iniciar sesión.
*/

Route::get('/', function () {
    /*
        Cojo los suplementos activos por si más adelante quiero mostrarlos
        también en la portada de la web.
    */
    $suplementos = Suplemento::where('activo', true)->get();

    return view('welcome', compact('suplementos'));
})->name('inicio');

Route::get('/calculadora', [ImcController::class, 'index'])->name('calculadora');

Route::get('/reels', function () {
    return view('reels');
})->name('reels');

Route::get('/contacto', function () {
    return view('contacto');
})->name('contacto');

/*
    Esta ruta recibe el formulario de contacto.
    De momento solo valida los datos y devuelve un mensaje.
*/
Route::post('/contacto', function (Request $request) {
    $request->validate([
        'nombre' => 'required|string|max:80',
        'objetivo' => 'required|in:perder_grasa,ganar_musculo,salud_energia,rendimiento',
        'dias' => 'required|in:2_3,4_5,6_mas',
        'experiencia' => 'required|in:principiante,menos_1,1_a_3,mas_3',
        'whatsapp' => 'required|string|min:9|max:20',
    ]);

    return back()->with('success', 'Formulario enviado correctamente. Te responderemos lo antes posible.');
})->name('contacto.enviar');

/*
|--------------------------------------------------------------------------
| Suplementos públicos
|--------------------------------------------------------------------------
| Estas rutas son para que cualquier usuario pueda ver los suplementos.
*/

Route::get('/suplementos', [SuplementoController::class, 'index'])->name('suplementos.index');

Route::get('/suplementos/{suplemento}', [SuplementoController::class, 'show'])->name('suplementos.show');

/*
|--------------------------------------------------------------------------
| Carrito
|--------------------------------------------------------------------------
| Estas rutas permiten añadir suplementos al carrito y confirmar un pedido.
*/

Route::get('/carrito', [CarritoController::class, 'index'])->name('carrito.index');

Route::post('/carrito/agregar/{suplemento}', [CarritoController::class, 'agregar'])->name('carrito.agregar');

Route::post('/carrito/eliminar/{id}', [CarritoController::class, 'eliminar'])->name('carrito.eliminar');

Route::post('/carrito/vaciar', [CarritoController::class, 'vaciar'])->name('carrito.vaciar');

Route::post('/carrito/confirmar', [CarritoController::class, 'confirmar'])->name('carrito.confirmar');

/*
|--------------------------------------------------------------------------
| Login, registro y logout
|--------------------------------------------------------------------------
| Aquí gestiono el acceso de usuarios y administrador.
*/

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');

Route::post('/login', [AuthController::class, 'login'])->name('login.post');

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');

Route::post('/register', [AuthController::class, 'register'])->name('register.post');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| Zona del usuario registrado
|--------------------------------------------------------------------------
| Aquí el usuario puede ver sus pedidos.
*/

Route::middleware('auth')->group(function () {
    Route::get('/mis-compras', [UsuarioController::class, 'misCompras'])->name('usuario.compras');
});

/*
|--------------------------------------------------------------------------
| Zona privada del administrador
|--------------------------------------------------------------------------
| Primero compruebo que el usuario esté logueado.
| Luego compruebo que tenga rol de administrador.
*/

Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', function () {
        // Si no es admin, no dejo entrar al panel
        if (auth()->user()->rol !== 'admin') {
            abort(403);
        }

        return app(AdminController::class)->index();
    })->name('index');

    Route::get('/crear', function () {
        // Solo el administrador puede crear suplementos
        if (auth()->user()->rol !== 'admin') {
            abort(403);
        }

        return app(AdminController::class)->create();
    })->name('create');

    Route::post('/guardar', function (Request $request) {
        // Solo el administrador puede guardar suplementos
        if (auth()->user()->rol !== 'admin') {
            abort(403);
        }

        return app(AdminController::class)->store($request);
    })->name('store');

    Route::get('/pedidos', function () {
        // Solo el administrador puede ver todos los pedidos
        if (auth()->user()->rol !== 'admin') {
            abort(403);
        }

        return app(AdminController::class)->pedidos();
    })->name('pedidos');

    Route::get('/pedidos/{pedido}', function ($pedido) {
        // Solo el administrador puede ver el detalle de los pedidos
        if (auth()->user()->rol !== 'admin') {
            abort(403);
        }

        return app(AdminController::class)->verPedido(\App\Models\Pedido::findOrFail($pedido));
    })->name('pedidos.show');

    Route::put('/pedidos/{pedido}/estado', function (Request $request, $pedido) {
        // Solo el administrador puede cambiar el estado de un pedido
        if (auth()->user()->rol !== 'admin') {
            abort(403);
        }

        return app(AdminController::class)->actualizarEstadoPedido($request, \App\Models\Pedido::findOrFail($pedido));
    })->name('pedidos.estado');

    Route::get('/{id}/editar', function ($id) {
        // Solo el administrador puede editar suplementos
        if (auth()->user()->rol !== 'admin') {
            abort(403);
        }

        return app(AdminController::class)->edit($id);
    })->name('edit');

    Route::put('/{id}', function (Request $request, $id) {
        // Solo el administrador puede actualizar suplementos
        if (auth()->user()->rol !== 'admin') {
            abort(403);
        }

        return app(AdminController::class)->update($request, $id);
    })->name('update');

    Route::delete('/{id}', function ($id) {
        // Solo el administrador puede borrar suplementos
        if (auth()->user()->rol !== 'admin') {
            abort(403);
        }

        return app(AdminController::class)->destroy($id);
    })->name('destroy');
});