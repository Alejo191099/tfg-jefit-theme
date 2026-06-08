<?php

namespace App\Http\Controllers;

use App\Models\Pedido;

class UsuarioController extends Controller
{
    public function misCompras()
    {
        // Cojo solo los pedidos del usuario que ha iniciado sesión
        $pedidos = Pedido::where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->get();

        // Envío esos pedidos a la vista de mis compras
        return view('usuario.compras', compact('pedidos'));
    }
}