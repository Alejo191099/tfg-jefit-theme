<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanContratado extends Model
{
    use HasFactory;

    /*
        Estos son los campos que permito guardar desde el controlador.
    */
    protected $fillable = [
        'user_id',
        'nombre_plan',
        'slug_plan',
        'precio',
        'estado',
    ];

    /*
        Un plan contratado pertenece a un usuario.
    */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}