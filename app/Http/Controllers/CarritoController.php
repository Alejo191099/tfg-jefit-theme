<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\PedidoDetalle;
use App\Models\Suplemento;
use Illuminate\Http\Request;

class CarritoController extends Controller
{
    public function index()
    {
        // Recupero el carrito guardado en la sesión. Si no existe, lo dejo vacío
        $carrito = session()->get('carrito', []);

        return view('carrito.index', compact('carrito'));
    }

    public function agregar(Request $request, Suplemento $suplemento)
    {
        // Valido que la cantidad sea un número correcto y que no supere el stock
        $request->validate([
            'cantidad' => 'required|integer|min:1|max:' . $suplemento->stock,
        ]);

        // Si el suplemento está oculto o sin stock, no lo dejo añadir al carrito
        if ($suplemento->activo == false || $suplemento->stock <= 0) {
            return redirect()
                ->route('suplementos.index')
                ->with('error', 'Este suplemento no está disponible ahora mismo.');
        }

        // Cojo el carrito actual de la sesión
        $carrito = session()->get('carrito', []);

        // Si el suplemento ya está en el carrito, sumo la cantidad
        if (isset($carrito[$suplemento->id])) {
            $cantidadFinal = $carrito[$suplemento->id]['cantidad'] + $request->cantidad;

            // Compruebo que la cantidad final no sea mayor que el stock disponible
            if ($cantidadFinal > $suplemento->stock) {
                return redirect()
                    ->back()
                    ->with('error', 'No puedes añadir más unidades de las disponibles.');
            }

            $carrito[$suplemento->id]['cantidad'] = $cantidadFinal;
        } else {
            // Si no estaba en el carrito, lo añado con los datos que necesito mostrar
            $carrito[$suplemento->id] = [
                'id' => $suplemento->id,
                'nombre' => $suplemento->nombre,
                'precio' => $suplemento->precio,
                'cantidad' => $request->cantidad,
            ];
        }

        // Guardo el carrito actualizado en la sesión
        session()->put('carrito', $carrito);

        return redirect()
            ->route('carrito.index')
            ->with('success', 'Suplemento añadido al carrito correctamente.');
    }

    public function eliminar($id)
    {
        // Cojo el carrito actual
        $carrito = session()->get('carrito', []);

        // Si existe el producto, lo quito del carrito
        if (isset($carrito[$id])) {
            unset($carrito[$id]);
        }

        // Guardo el carrito otra vez
        session()->put('carrito', $carrito);

        return redirect()
            ->route('carrito.index')
            ->with('success', 'Producto eliminado del carrito.');
    }

    public function vaciar()
    {
        // Borro todo el carrito de la sesión
        session()->forget('carrito');

        return redirect()
            ->route('carrito.index')
            ->with('success', 'Carrito vaciado correctamente.');
    }

    public function confirmar(Request $request)
    {
        // Valido los datos básicos del cliente antes de crear el pedido
        $request->validate([
            'nombre_cliente' => 'required|string|max:100',
            'email_cliente' => 'required|email|max:150',
        ]);

        // Cojo el carrito que está guardado en la sesión
        $carrito = session()->get('carrito', []);

        // Si el carrito está vacío, no dejo confirmar el pedido
        if (count($carrito) === 0) {
            return redirect()
                ->route('carrito.index')
                ->with('error', 'El carrito está vacío.');
        }

        /*
            Antes de guardar el pedido, reviso otra vez el stock real en la base de datos.
            Esto es importante porque el carrito puede estar desactualizado.
        */
        foreach ($carrito as $producto) {
            $suplemento = Suplemento::find($producto['id']);

            // Si el suplemento ya no existe, no dejo confirmar el pedido
            if (!$suplemento) {
                return redirect()
                    ->route('carrito.index')
                    ->with('error', 'Uno de los suplementos del carrito ya no está disponible.');
            }

            // Si el suplemento está oculto o desactivado, tampoco dejo comprarlo
            if (!$suplemento->activo) {
                return redirect()
                    ->route('carrito.index')
                    ->with('error', 'El suplemento "' . $suplemento->nombre . '" ya no está disponible.');
            }

            // Si no hay stock suficiente, aviso al usuario
            if ($producto['cantidad'] > $suplemento->stock) {
                return redirect()
                    ->route('carrito.index')
                    ->with('error', 'No hay stock suficiente de "' . $suplemento->nombre . '". Stock disponible: ' . $suplemento->stock . '.');
            }
        }

        // Calculo el total del pedido
        $total = 0;

        foreach ($carrito as $producto) {
            $total = $total + ($producto['precio'] * $producto['cantidad']);
        }

        // Creo el pedido principal
        $pedido = Pedido::create([
            'user_id' => auth()->id(),
            'nombre_cliente' => $request->nombre_cliente,
            'email_cliente' => $request->email_cliente,
            'total' => $total,
            'estado' => 'pendiente',
        ]);

        // Guardo cada suplemento dentro del detalle del pedido
        foreach ($carrito as $producto) {
            $suplemento = Suplemento::find($producto['id']);

            $subtotal = $producto['precio'] * $producto['cantidad'];

            PedidoDetalle::create([
                'pedido_id' => $pedido->id,
                'suplemento_id' => $suplemento->id,
                'cantidad' => $producto['cantidad'],
                'precio_unitario' => $producto['precio'],
                'subtotal' => $subtotal,
            ]);

            /*
                Después de guardar el detalle, descuento el stock.
                Como antes ya he comprobado que hay stock suficiente,
                aquí no debería quedar en negativo.
            */
            $suplemento->stock = $suplemento->stock - $producto['cantidad'];
            $suplemento->save();
        }

        // Vacío el carrito porque el pedido ya se ha confirmado
        session()->forget('carrito');

        return redirect()
            ->route('suplementos.index')
            ->with('success', 'Pedido confirmado correctamente. El administrador lo revisará pronto.');
    }
}
