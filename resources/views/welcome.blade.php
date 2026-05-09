@extends('layouts.app')

@section('title', 'Inicio - jefit')

@section('content')
<style>
    /* Colores base */
    .bg-dark-custom { background-color: #121418; }
    .text-neon { color: #00ff00; }

    /* Efecto de texto hueco con borde verde (como en la imagen 2 y 3) */
    .text-outline-neon {
        color: transparent;
        -webkit-text-stroke: 1px #00ff00;
        text-shadow: 0 0 15px rgba(0, 255, 0, 0.2);
        letter-spacing: 2px;
    }

    /* Tarjetas con borde verde neón */
    .border-neon-card {
        border: 2px solid #00ff00;
        background-color: #0a0a0a;
        border-radius: 10px;
        transition: all 0.3s ease;
    }
    .border-neon-card:hover {
        box-shadow: 0 0 20px rgba(0, 255, 0, 0.6);
        transform: translateY(-5px);
    }

    /* Ajuste para que los separadores verdes de la imagen 2 se vean bien */
    .border-end-neon { border-right: 1px solid rgba(0, 255, 0, 0.3); }
    @media (max-width: 768px) { .border-end-neon { border-right: none; border-bottom: 1px solid rgba(0, 255, 0, 0.3); padding-bottom: 20px; } }
</style>

{{-- Portada principal. He mantenido el mismo diseño, solo he cambiado enlaces # por rutas reales. --}}
<section class="bg-dark text-white text-center d-flex align-items-center justify-content-center" style="min-height: 85vh; background-color: #1a1d20 !important;">
    <div class="container px-4">
        <h1 class="display-3 fw-bold mb-4">Transforma tu físico con un profesional</h1>
        <p class="lead mb-5 text-light mx-auto" style="max-width: 800px;">
            Entrenamientos personalizados y asesoramiento nutricional en Madrid. Da el primer paso hacia tu mejor versión.
        </p>
        <div class="d-flex justify-content-center gap-3">
            <a href="{{ route('inicio') }}#planes" class="btn btn-primary btn-lg px-4 fw-bold">Ver Servicios</a>
            <a href="{{ route('contacto') }}" class="btn btn-outline-light btn-lg px-4 fw-bold">Contactar</a>
        </div>
    </div>
</section>

{{-- Presentación del proyecto. --}}
<section class="py-5 bg-white">
    <div class="container my-5">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <h2 class="fw-bold display-6 mb-4 text-dark">QUIÉNES SOMOS Y QUÉ OFRECEMOS</h2>
                <div class="border-start border-4 border-dark ps-4">
                    <p class="text-secondary fs-5 lh-lg mb-4">
                        En <strong>jefit</strong> no creemos en las rutinas genéricas. Somos especialistas en transformar el cuerpo y la mente a través de la ciencia del entrenamiento y la nutrición aplicada.
                    </p>
                    <p class="text-secondary fs-5 lh-lg">
                        Ofrecemos un seguimiento integral donde cada repetición y cada caloría cuentan. Nuestro objetivo no es solo que te veas bien en el espejo, sino que construyas una salud de hierro y aprendas a mantener tus resultados para siempre.
                    </p>
                </div>
            </div>
            <div class="col-lg-6 text-center">
                <img src="https://images.unsplash.com/photo-1534438327276-14e5300c3a48?q=80&w=1000&auto=format&fit=crop" class="img-fluid rounded shadow-lg" alt="Entrenamiento en el gimnasio">
            </div>
        </div>
    </div>
</section>

{{-- Bloque de objetivos. --}}
<section class="py-5 bg-dark-custom text-white" id="servicios">
    <div class="container my-5">
        <h2 class="text-center display-4 fw-bold text-outline-neon mb-5 text-uppercase">Elige tus objetivos</h2>

        <div class="row g-4 mt-4">
            <div class="col-md-4 border-end-neon px-4 text-center text-md-start">
                <h4 class="text-white fw-bold mb-3">PÉRDIDA DE PESO</h4>
                <p class="text-secondary">Adaptamos el entrenamiento a tu peso actual y te apoyamos en todo el camino hacia la pérdida de grasa, hasta que alcances tus objetivos y te propongamos nuevos retos.</p>
            </div>

            <div class="col-md-4 border-end-neon px-4 text-center text-md-start">
                <h4 class="text-white fw-bold mb-3">ENTRENAMIENTOS</h4>
                <p class="text-secondary">Programación estructurada basada en tus capacidades. Desde rutinas de fuerza máxima hasta circuitos metabólicos para que saques el máximo partido a cada sesión.</p>
            </div>

            <div class="col-md-4 px-4 text-center text-md-start">
                <h4 class="text-white fw-bold mb-3">GANAR MASA MUSCULAR</h4>
                <p class="text-secondary">Progresión de cargas enfocada en la hipertrofia. Te enseñamos a romper fibras correctamente y a nutrir tu cuerpo para crear músculo limpio y funcional.</p>
            </div>
        </div>
    </div>
</section>

{{-- Planes de entrenamiento. El id sirve para que el enlace "Servicios" baje hasta aquí. --}}
<section class="py-5 bg-dark text-white position-relative" id="planes" style="background-image: url('https://images.unsplash.com/photo-1581009146145-b5ef050c2e1e?q=80&w=2000&auto=format&fit=crop'); background-size: cover; background-attachment: fixed; background-blend-mode: multiply; background-color: rgba(10, 10, 10, 0.9);">
    <div class="container my-5 position-relative z-index-1">
        <h2 class="text-center display-4 fw-bold text-outline-neon mb-5 text-uppercase">Elige tu plan de entrenamiento</h2>

        <div class="row g-4 justify-content-center mt-4">
            <div class="col-md-4">
                <div class="card h-100 border-neon-card p-4 text-center">
                    <div class="card-body">
                        <h3 class="text-neon fw-bold mb-4">PLAN EXCLUSIVO</h3>
                        <p class="text-light mb-4">Tendrás a tu disposición un entrenador personal para ti de forma exclusiva. Atención al 100% en tu técnica y progresión.</p>
                        <a href="{{ route('contacto') }}" class="text-neon fw-bold text-decoration-none">SABER MÁS &rarr;</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card h-100 border-neon-card p-4 text-center">
                    <div class="card-body">
                        <h3 class="text-neon fw-bold mb-4">PLAN DÚO</h3>
                        <p class="text-light mb-4">Entrenador en exclusiva para ti y la persona que elijas (amigo/a, familiar o pareja). Motivaos juntos compartiendo gastos.</p>
                        <a href="{{ route('contacto') }}" class="text-neon fw-bold text-decoration-none">SABER MÁS &rarr;</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card h-100 border-neon-card p-4 text-center">
                    <div class="card-body">
                        <h3 class="text-neon fw-bold mb-4">GRUPOS REDUCIDOS</h3>
                        <p class="text-light mb-4">Disfruta de un entrenador personal con un máximo de 3 alumnos en cada sesión. Entrena duro en un ambiente inmejorable.</p>
                        <a href="{{ route('contacto') }}" class="text-neon fw-bold text-decoration-none">SABER MÁS &rarr;</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Enlace a la calculadora de IMC. --}}
<section class="py-5 bg-white text-center">
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h2 class="fw-bold display-6 text-dark mb-3">¿Conoces tu punto de partida?</h2>
                <p class="text-secondary fs-5 mb-4">Antes de empezar cualquier plan, es fundamental conocer tu estado físico actual. Utiliza nuestra herramienta gratuita para descubrir tu Índice de Masa Corporal.</p>
                <a href="{{ route('calculadora') }}" class="btn btn-dark btn-lg px-5 py-3 fw-bold shadow">CALCULAR MI IMC AHORA</a>
            </div>
        </div>
    </div>
</section>
@endsection
