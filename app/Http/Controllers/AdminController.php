<?php

namespace App\Http\Controllers;

use App\Models\Suplemento;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Muestra la tabla del panel con todos los suplementos.
    public function index()
    {
        // Los ordeno por id descendente para ver primero los últimos que se han creado.
        $suplementos = Suplemento::orderBy('id', 'desc')->get();

        return view('admin.index', compact('suplementos'));
    }

    // Abre el formulario vacío para añadir un suplemento nuevo.
    public function create()
    {
        return view('admin.create');
    }

    // Guarda el suplemento después de comprobar que los datos tienen sentido.
    public function store(Request $request)
    {
        $datos = $this->validarSuplemento($request);

        Suplemento::create($datos);

        return redirect()
            ->route('admin.index')
            ->with('success', 'Suplemento añadido correctamente.');
    }

    // Abre el formulario de edición con los datos del suplemento elegido.
    public function edit($id)
    {
        // findOrFail busca por id. Si no existe, Laravel enseña un error 404.
        $suplemento = Suplemento::findOrFail($id);

        return view('admin.edit', compact('suplemento'));
    }

    // Actualiza un suplemento que ya existe.
    public function update(Request $request, $id)
    {
        $suplemento = Suplemento::findOrFail($id);
        $datos = $this->validarSuplemento($request);

        $suplemento->update($datos);

        return redirect()
            ->route('admin.index')
            ->with('success', 'Suplemento actualizado correctamente.');
    }

    // Borra el suplemento seleccionado.
    public function destroy($id)
    {
        $suplemento = Suplemento::findOrFail($id);
        $suplemento->delete();

        return redirect()
            ->route('admin.index')
            ->with('success', 'Suplemento eliminado correctamente.');
    }

    // He separado la validación para no repetir las mismas reglas en crear y editar.
    private function validarSuplemento(Request $request)
    {
        return $request->validate([
            'nombre' => 'required|string|max:100',
            'descripcion' => 'required|string|min:3|max:1000',
            'precio' => 'required|numeric|min:0|max:9999.99',
            'imagen' => 'nullable|string|max:255',
        ]);
    }
}
