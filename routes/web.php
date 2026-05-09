<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ImcController;
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
    // Cojo los suplementos por si más adelante quiero pintarlos en la portada.
    // De momento la portada mantiene el mismo diseño que tenía.
    $suplementos = Suplemento::all();

    return view('welcome', compact('suplementos'));
})->name('inicio');

Route::get('/calculadora', [ImcController::class, 'index'])->name('calculadora');

Route::get('/reels', function () {
    return view('reels');
})->name('reels');

Route::get('/contacto', function () {
    return view('contacto');
})->name('contacto');

// Esta ruta recibe el formulario de contacto.
// Ahora mismo no guarda nada en base de datos: solo valida y devuelve un aviso.
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
*/

Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('index');
    Route::get('/crear', [AdminController::class, 'create'])->name('create');
    Route::post('/guardar', [AdminController::class, 'store'])->name('store');

    Route::get('/{id}/editar', [AdminController::class, 'edit'])->name('edit');
    Route::put('/{id}', [AdminController::class, 'update'])->name('update');
    Route::delete('/{id}', [AdminController::class, 'destroy'])->name('destroy');
});
