<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\Suplemento;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        // Muestro primero los suplementos más recientes en el panel
        $suplementos = Suplemento::orderBy('id', 'desc')->get();

        return view('admin.index', compact('suplementos'));
    }

    public function create()
    {
        // Abro el formulario para crear un suplemento nuevo
        return view('admin.create');
    }

    public function store(Request $request)
    {
        // Valido los datos antes de guardar el suplemento
        $datos = $this->validarSuplemento($request);

        // Si el checkbox está marcado, activo vale 1. Si no está marcado, vale 0
        $datos['activo'] = $request->has('activo');

        Suplemento::create($datos);

        return redirect()
            ->route('admin.index')
            ->with('success', 'Suplemento añadido correctamente.');
    }

    public function edit($id)
    {
        // Busco el suplemento por su id. Si no existe, Laravel muestra un error 404
        $suplemento = Suplemento::findOrFail($id);

        return view('admin.edit', compact('suplemento'));
    }

    public function update(Request $request, $id)
    {
        // Busco el suplemento y actualizo sus datos
        $suplemento = Suplemento::findOrFail($id);

        $datos = $this->validarSuplemento($request);

        // Esto permite ocultar un suplemento cuando desmarco el checkbox en el formulario
        $datos['activo'] = $request->has('activo');

        $suplemento->update($datos);

        return redirect()
            ->route('admin.index')
            ->with('success', 'Suplemento actualizado correctamente.');
    }

    public function destroy($id)
    {
        // Borro el suplemento seleccionado desde el panel
        $suplemento = Suplemento::findOrFail($id);

        $suplemento->delete();

        return redirect()
            ->route('admin.index')
            ->with('success', 'Suplemento eliminado correctamente.');
    }

    public function pedidos()
    {
        // Cojo los pedidos del más nuevo al más antiguo
        $pedidos = Pedido::orderBy('created_at', 'desc')->get();

        return view('admin.pedidos', compact('pedidos'));
    }

    public function verPedido(Pedido $pedido)
    {
        // Cargo los productos del pedido para poder verlos en el detalle
        $pedido->load('detalles.suplemento');

        return view('admin.pedido-detalle', compact('pedido'));
    }

    public function actualizarEstadoPedido(Request $request, Pedido $pedido)
    {
        // Solo permito guardar estados que yo he definido
        $request->validate([
            'estado' => 'required|in:pendiente,contactado,completado,cancelado',
        ]);

        $pedido->estado = $request->estado;
        $pedido->save();

        return redirect()
            ->route('admin.pedidos.show', $pedido)
            ->with('success', 'Estado del pedido actualizado correctamente.');
    }

    private function validarSuplemento(Request $request)
    {
        // Estas reglas se usan tanto al crear como al editar suplementos
        return $request->validate([
            'nombre' => 'required|string|max:100',
            'descripcion' => 'required|string|min:3|max:1000',
            'precio' => 'required|numeric|min:0|max:9999.99',
            'imagen' => 'nullable|string|max:255',
            'stock' => 'required|integer|min:0|max:9999',
            'activo' => 'nullable|boolean',
        ]);
    }
}