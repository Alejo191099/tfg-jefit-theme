<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Suplemento extends Model
{
    /*
        Aquí indico qué campos se pueden guardar desde formularios.

        Esto es importante porque Laravel no deja guardar cualquier dato
        directamente en la base de datos por seguridad.
    */
    protected $fillable = [
        'nombre',
        'descripcion',
        'precio',
        'imagen',
        'stock',
        'categoria',
        'activo',
    ];

    public function detallesPedido()
    {
        /*
            Un suplemento puede aparecer en muchos pedidos.

            Por ejemplo, la creatina puede estar en el pedido de un usuario
            y también en el pedido de otro usuario diferente.
        */
        return $this->hasMany(PedidoDetalle::class);
    }
}