<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PedidoDetalle extends Model
{
    /*
        Laravel normalmente buscaría la tabla pedido_detalles igualmente,
        pero lo dejo escrito para que se entienda mejor.
    */
    protected $table = 'pedido_detalles';

    protected $fillable = [
        'pedido_id',
        'suplemento_id',
        'cantidad',
        'precio_unitario',
        'subtotal',
    ];

    public function pedido()
    {
        /*
            Cada línea pertenece a un pedido concreto.
        */
        return $this->belongsTo(Pedido::class);
    }

    public function suplemento()
    {
        /*
            Cada línea apunta al suplemento que se ha comprado.
        */
        return $this->belongsTo(Suplemento::class);
    }
}
