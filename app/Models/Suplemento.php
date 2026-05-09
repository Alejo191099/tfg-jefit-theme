<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Suplemento extends Model
{
    // Damos permiso a Laravel para rellenar estos campos
    protected $fillable = ['nombre', 'descripcion', 'precio', 'imagen'];
}
