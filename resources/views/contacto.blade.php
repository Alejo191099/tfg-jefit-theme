@extends('layouts.app')

@section('title', 'Contacto - jefit')

@section('content')
<style>
    /* Reutilizamos colores neón */
    .bg-dark-custom { background-color: #121418; }
    .text-neon { color: #00ff00; }
    .text-outline-neon { color: transparent; -webkit-text-stroke: 1px #00ff00; text-shadow: 0 0 15px rgba(0, 255, 0, 0.2); }
    .border-neon-card { border: 2px solid #00ff00; background-color: #0a0a0a; border-radius: 10px; }

    /* Estilos para el formulario oscuro */
    .form-control-dark, .form-select-dark {
        background-color: #1a1d20; color: white; border: 1px solid #333;
    }
    .form-control-dark:focus, .form-select-dark:focus {
        background-color: #1a1d20; color: white; border-color: #00ff00; box-shadow: 0 0 10px rgba(0, 255, 0, 0.3);
    }

    /* Hacemos que las etiquetas del formulario y los radios sean blancos */
    .form-label, .form-check-label { color: #ffffff !important; }

    /* Estilos para las preguntas frecuentes (Acordeón) */
    .accordion-item-dark { background-color: #1a1d20; border: 1px solid #333; }
    .accordion-button-dark { background-color: #1a1d20; color: white; font-weight: bold; }
    .accordion-button-dark:not(.collapsed) { background-color: #0a0a0a; color: #00ff00; }
    .accordion-button-dark::after { filter: invert(1); }
</style>

<div class="bg-dark-custom text-white py-5">
    <div class="container my-5">

        <div class="text-center mb-5 pb-4 border-bottom border-secondary">
            <h1 class="display-4 fw-bold text-outline-neon text-uppercase mb-4">Hablemos</h1>
            <p class="fs-5 text-secondary mb-4">¿Tienes una duda rápida? Contáctame directamente o rellena el formulario para empezar tu plan.</p>
            <div class="d-flex justify-content-center gap-4">
                <p class="fs-5"><strong class="text-neon">WhatsApp:</strong> +34 600 00 00 00</p>
                <p class="fs-5"><strong class="text-neon">Email:</strong> info@jefit.com</p>
            </div>
        </div>

        <div class="row g-5">

            <div class="col-lg-7">
                <div class="card border-neon-card p-4 p-md-5 h-100">
                    <h2 class="fw-bold mb-3 text-white">Empieza tu transformación</h2>
                    <p class="text-secondary mb-4">Cuéntame sobre ti para armar un plan a tu medida.</p>

                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    {{-- El formulario se envía a Laravel. Antes estaba en "#", por eso no hacía nada. --}}
                    <form action="{{ route('contacto.enviar') }}" method="POST">
                        @csrf

                        <div class="mb-4">
                            <label for="nombre" class="form-label fw-bold">¿Cómo te llamas? *</label>
                            <input type="text" id="nombre" name="nombre" class="form-control form-control-dark py-2 @error('nombre') is-invalid @enderror" required placeholder="Tu nombre" value="{{ old('nombre') }}">
                            @error('nombre')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-4">
                            <label for="objetivo" class="form-label fw-bold">¿Cuál es tu objetivo principal? *</label>
                            <select id="objetivo" name="objetivo" class="form-select form-select-dark py-2 @error('objetivo') is-invalid @enderror" required>
                                <option value="" disabled {{ old('objetivo') ? '' : 'selected' }}>Selecciona una opción...</option>
                                <option value="perder_grasa" @selected(old('objetivo') === 'perder_grasa')>Perder grasa</option>
                                <option value="ganar_musculo" @selected(old('objetivo') === 'ganar_musculo')>Ganar músculo</option>
                                <option value="salud_energia" @selected(old('objetivo') === 'salud_energia')>Mejorar salud y energía</option>
                                <option value="rendimiento" @selected(old('objetivo') === 'rendimiento')>Mejorar rendimiento deportivo</option>
                            </select>
                            @error('objetivo')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold">¿Cuántos días por semana puedes entrenar? *</label>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="radio" name="dias" id="dias1" value="2_3" required @checked(old('dias') === '2_3')>
                                <label class="form-check-label" for="dias1">2 - 3 días</label>
                            </div>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="radio" name="dias" id="dias2" value="4_5" @checked(old('dias') === '4_5')>
                                <label class="form-check-label" for="dias2">4 - 5 días</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="dias" id="dias3" value="6_mas" @checked(old('dias') === '6_mas')>
                                <label class="form-check-label" for="dias3">6 + días</label>
                            </div>
                            @error('dias')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-4">
                            <label for="experiencia" class="form-label fw-bold">¿Cuánto tiempo llevas entrenando? *</label>
                            <select id="experiencia" name="experiencia" class="form-select form-select-dark py-2 @error('experiencia') is-invalid @enderror" required>
                                <option value="" disabled {{ old('experiencia') ? '' : 'selected' }}>Selecciona tu nivel...</option>
                                <option value="principiante" @selected(old('experiencia') === 'principiante')>Soy principiante</option>
                                <option value="menos_1" @selected(old('experiencia') === 'menos_1')>Menos de 1 año</option>
                                <option value="1_a_3" @selected(old('experiencia') === '1_a_3')>1 - 3 años</option>
                                <option value="mas_3" @selected(old('experiencia') === 'mas_3')>Más de 3 años</option>
                            </select>
                            @error('experiencia')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-5">
                            <label for="whatsapp" class="form-label fw-bold">Tu número de WhatsApp *</label>
                            <input type="tel" id="whatsapp" name="whatsapp" class="form-control form-control-dark py-2 @error('whatsapp') is-invalid @enderror" required placeholder="+34 ..." value="{{ old('whatsapp') }}">
                            @error('whatsapp')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                        </div>

                        <button type="submit" class="btn btn-primary w-100 py-3 fw-bold fs-5" style="background-color: #00ff00; color: black; border: none;">ENVIAR RESPUESTAS &rarr;</button>
                    </form>
                </div>
            </div>

            <div class="col-lg-5">
                <h3 class="fw-bold mb-4 text-white">Preguntas Frecuentes</h3>
                <p class="text-secondary mb-4">Todo lo que necesitas saber antes de empezar el coaching.</p>

                <div class="accordion" id="faqAccordion">

                    <div class="accordion-item accordion-item-dark mb-3 rounded border">
                        <h2 class="accordion-header">
                            <button class="accordion-button accordion-button-dark collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                                ¿En cuánto tiempo veré resultados?
                            </button>
                        </h2>
                        <div id="faq1" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-secondary">
                                Algunos clientes notan cambios en 2-4 semanas, pero el progreso varía según tu punto de partida, constancia y estilo de vida.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item accordion-item-dark mb-3 rounded border">
                        <h2 class="accordion-header">
                            <button class="accordion-button accordion-button-dark collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                                ¿Necesito ir al gimnasio?
                            </button>
                        </h2>
                        <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-secondary">
                                No necesariamente. Diseñamos planes efectivos para entrenar en casa, con poco equipo o solo con tu peso corporal.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item accordion-item-dark mb-3 rounded border">
                        <h2 class="accordion-header">
                            <button class="accordion-button accordion-button-dark collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                                ¿Recibiré videos o ejemplos de los ejercicios?
                            </button>
                        </h2>
                        <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-secondary">
                                Sí. Cada ejercicio tiene instrucciones claras y, si es necesario, un video demostrativo para que lo ejecutes bien.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item accordion-item-dark mb-3 rounded border">
                        <h2 class="accordion-header">
                            <button class="accordion-button accordion-button-dark collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq4">
                                ¿Incluyes un plan de alimentación?
                            </button>
                        </h2>
                        <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-secondary">
                                Sí. Puede ser una guía flexible o un plan detallado, según tus preferencias, necesidades y objetivos.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item accordion-item-dark mb-3 rounded border">
                        <h2 class="accordion-header">
                            <button class="accordion-button accordion-button-dark collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq5">
                                ¿Cómo haces el seguimiento si todo es online?
                            </button>
                        </h2>
                        <div id="faq5" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-secondary">
                                Mediante formularios semanales, fotos de progreso, WhatsApp, correo o llamadas. Siempre estarás acompañado.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item accordion-item-dark mb-3 rounded border">
                        <h2 class="accordion-header">
                            <button class="accordion-button accordion-button-dark collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq6">
                                ¿Qué pasa si me estanco o pierdo motivación?
                            </button>
                        </h2>
                        <div id="faq6" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-secondary">
                                Ajustamos tu plan y trabajamos juntos para identificar bloqueos. También te doy herramientas para mantener el enfoque.
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection
