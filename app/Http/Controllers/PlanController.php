<?php

namespace App\Http\Controllers;

use App\Models\PlanContratado;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    /*
        Aquí guardo los planes de forma sencilla.
        No creo una tabla aparte para los planes porque son pocos y son fijos.
    */
    private function planes()
    {
        return [
            'exclusivo' => [
                'nombre' => 'Plan Exclusivo',
                'slug' => 'exclusivo',
                'precio' => 79.99,
                'descripcion' => 'Entrenamiento personalizado con atención individual y seguimiento adaptado a tus objetivos.',
                'caracteristicas' => [
                    'Entrenador personal asignado',
                    'Plan adaptado a tu objetivo físico',
                    'Seguimiento semanal',
                    'Corrección de técnica',
                    'Recomendaciones básicas de alimentación',
                    'Atención individual durante todo el proceso',
                ],
            ],

            'duo' => [
                'nombre' => 'Plan Dúo',
                'slug' => 'duo',
                'precio' => 119.99,
                'descripcion' => 'Plan pensado para entrenar junto a otra persona, compartiendo motivación y gastos.',
                'caracteristicas' => [
                    'Entrenamiento para dos personas',
                    'Rutina adaptada al nivel de ambos',
                    'Seguimiento conjunto',
                    'Motivación en pareja o amistad',
                    'Corrección de ejercicios',
                    'Precio más económico al compartir el plan',
                ],
            ],

            'grupos-reducidos' => [
                'nombre' => 'Grupos Reducidos',
                'slug' => 'grupos-reducidos',
                'precio' => 49.99,
                'descripcion' => 'Entrenamiento en grupo pequeño, con ambiente motivador y atención más cercana.',
                'caracteristicas' => [
                    'Grupos de máximo 3 personas',
                    'Entrenamientos dinámicos',
                    'Buen ambiente y motivación',
                    'Supervisión del entrenador',
                    'Ejercicios adaptados al grupo',
                    'Opción ideal para empezar acompañado',
                ],
            ],
        ];
    }

    public function show($slug)
    {
        // Cojo todos los planes disponibles
        $planes = $this->planes();

        // Si el plan no existe, muestro error 404
        if (!array_key_exists($slug, $planes)) {
            abort(404);
        }

        // Guardo el plan elegido
        $plan = $planes[$slug];

        // Envío el plan a la vista de detalle
        return view('planes.show', compact('plan'));
    }

    public function contratar($slug)
    {
        // Cojo todos los planes disponibles
        $planes = $this->planes();

        // Si el plan no existe, muestro error 404
        if (!array_key_exists($slug, $planes)) {
            abort(404);
        }

        $plan = $planes[$slug];

        /*
            Compruebo si el usuario ya tiene este plan activo.
            Así evito que lo contrate varias veces sin querer.
        */
        $planExistente = PlanContratado::where('user_id', auth()->id())
            ->where('slug_plan', $plan['slug'])
            ->where('estado', 'activo')
            ->first();

        if ($planExistente) {
            return redirect()
                ->route('usuario.planes')
                ->with('success', 'Ya tienes este plan contratado.');
        }

        // Guardo el plan contratado en la base de datos
        PlanContratado::create([
            'user_id' => auth()->id(),
            'nombre_plan' => $plan['nombre'],
            'slug_plan' => $plan['slug'],
            'precio' => $plan['precio'],
            'estado' => 'activo',
        ]);

        return redirect()
            ->route('usuario.planes')
            ->with('success', 'Plan contratado correctamente.');
    }

    public function misPlanes()
    {
        // Cojo solo los planes contratados por el usuario que está logueado
        $planesContratados = PlanContratado::where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('usuario.planes', compact('planesContratados'));
    }
}