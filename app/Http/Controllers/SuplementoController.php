<?php

namespace App\Http\Controllers;

use App\Models\Suplemento;

class SuplementoController extends Controller
{
    public function index()
    {
        /*
            Aquí saco de la base de datos solo los suplementos activos.

            Así, si desde el panel de administrador marco un suplemento como no activo,
            no se mostrará en la parte pública de la web.
        */
        $suplementos = Suplemento::where('activo', true)
            ->orderBy('nombre', 'asc')
            ->get();

        /*
            Envío la lista de suplementos a la vista pública.
        */
        return view('suplementos.index', compact('suplementos'));
    }

    public function show(Suplemento $suplemento)
    {
        /*
            Si el suplemento está desactivado, no dejo verlo aunque alguien escriba
            la dirección directamente en el navegador.
        */
        if (!$suplemento->activo) {
            abort(404);
        }

        /*
            Envío el suplemento seleccionado a la vista de detalle.
        */
        return view('suplementos.show', compact('suplemento'));
    }
}