<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CarritoController;
use App\Http\Controllers\ImcController;
use App\Http\Controllers\SuplementoController;
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
        Cojo los suplementos por si más adelante quiero mostrarlos también
        en la portada de la web.
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

    De momento solo valida los datos y devuelve un mensaje de confirmación.
    Más adelante se podría guardar en una tabla de contactos.
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
| Login y logout
|--------------------------------------------------------------------------
| Estas rutas controlan el inicio y cierre de sesión.
*/

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');

Route::post('/login', [AuthController::class, 'login'])->name('login.post');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| Zona privada del administrador
|--------------------------------------------------------------------------
| Todo lo que está dentro de este grupo pide estar logueado.
|
| En tu proyecto, el AdminController es el que gestiona los suplementos:
| crear, editar, actualizar y eliminar.
*/

Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('index');

    Route::get('/crear', [AdminController::class, 'create'])->name('create');

    Route::post('/guardar', [AdminController::class, 'store'])->name('store');

    /*
        Rutas para revisar los pedidos desde el panel de administrador.
        Las pongo antes de las rutas con {id} para que Laravel no confunda
        "pedidos" con el id de un suplemento.
    */
    Route::get('/pedidos', [AdminController::class, 'pedidos'])->name('pedidos');

    Route::get('/pedidos/{pedido}', [AdminController::class, 'verPedido'])->name('pedidos.show');

    Route::put('/pedidos/{pedido}/estado', [AdminController::class, 'actualizarEstadoPedido'])->name('pedidos.estado');

    Route::get('/{id}/editar', [AdminController::class, 'edit'])->name('edit');

    Route::put('/{id}', [AdminController::class, 'update'])->name('update');

    Route::delete('/{id}', [AdminController::class, 'destroy'])->name('destroy');
});