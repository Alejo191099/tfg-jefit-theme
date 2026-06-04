<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    /*
        Campos que permito guardar de forma directa desde el controlador.

        Esto evita errores de seguridad y deja claro qué datos forman parte
        de un pedido.
    */
    protected $fillable = [
        'user_id',
        'nombre_cliente',
        'email_cliente',
        'total',
        'estado',
    ];

    public function detalles()
    {
        /*
            Un pedido puede tener varias líneas.

            Por ejemplo, un pedido puede incluir proteína, creatina
            y otro suplemento más.
        */
        return $this->hasMany(PedidoDetalle::class);
    }

    public function user()
    {
        /*
            Un pedido puede pertenecer a un usuario registrado.

            Lo dejo como relación porque algunos pedidos podrían ser de invitados.
        */
        return $this->belongsTo(User::class);
    }
}
