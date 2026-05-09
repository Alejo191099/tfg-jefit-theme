<?php

namespace App\Http\Controllers;

class ImcController extends Controller
{
    // Esta función solo carga la vista de la calculadora.
    // El cálculo lo hago en JavaScript porque es algo rápido y no necesita base de datos.
    public function index()
    {
        return view('calculadora');
    }
}
