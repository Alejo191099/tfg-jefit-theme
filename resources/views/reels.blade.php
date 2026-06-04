@extends('layouts.app')

@section('title', 'Fitness Reels - jefit')

@section('content')
<div class="container my-5">
    <div class="text-center mb-5">
        <h1 class="fw-bold display-5">Fitness Reels</h1>
        <p class="text-secondary fs-5">Selección de los mejores vídeos y animaciones para entender tu entrenamiento.</p>
    </div>

    <div class="row g-4 justify-content-center">

        <div class="col-md-6 col-lg-5">
            <div class="card h-100 shadow-sm border-0 bg-light">
                <div class="card-body p-4 text-center">
                    <h4 class="fw-bold text-dark mb-3">Claves para perder grasa</h4>
                    <p class="text-secondary small mb-4">Entiende el déficit calórico de forma visual.</p>

                    {{-- Embed de TikTok. Lo dejo separado para que sea más fácil cambiarlo por otro vídeo. --}}
                    <div class="d-flex justify-content-center w-100">
                        <blockquote class="tiktok-embed" cite="https://www.tiktok.com/@bluegymanimation/video/7626279807801773343" data-video-id="7626279807801773343" style="max-width: 605px;min-width: 325px;">
                            <section>
                                <a target="_blank" title="@bluegymanimation" href="https://www.tiktok.com/@bluegymanimation?refer=embed">@bluegymanimation</a>
                                Cómo hacer RECOMPOSICIÓN Corporal 7&#47;8
                                <a title="gym" target="_blank" href="https://www.tiktok.com/tag/gym?refer=embed">#gym</a>
                                <a title="gymtips" target="_blank" href="https://www.tiktok.com/tag/gymtips?refer=embed">#gymtips</a>
                                <a target="_blank" title="♬ original sound  - Blue Gym Animation" href="https://www.tiktok.com/music/original-sound-Blue-Gym-Animation-7626279782057003807?refer=embed">♬ original sound - Blue Gym Animation</a>
                            </section>
                        </blockquote>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-5">
            <div class="card h-100 shadow-sm border-0 bg-light">
                <div class="card-body p-4 text-center">
                    <h4 class="fw-bold text-dark mb-3">Ganar masa muscular</h4>
                    <p class="text-secondary small mb-4">Como ganar musculo correctamente.</p>

                    {{-- Embed de TikTok. Lo dejo separado para que sea más fácil cambiarlo por otro vídeo. --}}
                    <div class="d-flex justify-content-center w-100">
                        <blockquote class="tiktok-embed" cite="https://www.tiktok.com/@bluegym.animation/video/7612671010537508118" data-video-id="7612671010537508118" style="max-width: 605px;min-width: 325px;" > <section> <a target="_blank" title="@bluegym.animation" href="https://www.tiktok.com/@bluegym.animation?refer=embed">@bluegym.animation</a> 
                        <a target="_blank" title="♬ sonido original  - Blue Gym Animation" href="https://www.tiktok.com/music/sonido-original-Blue-Gym-Animation-7612671039994120963?refer=embed">♬ sonido original  - Blue Gym Animation</a> </section> </blockquote> <script async src="https://www.tiktok.com/embed.js"></script>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-5">
            <div class="card h-100 shadow-sm border-0 bg-light">
                <div class="card-body p-4 text-center">
                    <h4 class="fw-bold text-dark mb-3">Crece tus piernas</h4>
                    <p class="text-secondary small mb-4">Uno de los mejores ejercicios el peso muerto rumano.</p>

                    {{-- Embed de TikTok. Lo dejo separado para que sea más fácil cambiarlo por otro vídeo. --}}
                    <div class="d-flex justify-content-center w-100">
                        <blockquote class="tiktok-embed" cite="https://www.tiktok.com/@bluegym.animation/video/7541443931838352662" data-video-id="7541443931838352662" style="max-width: 605px;min-width: 325px;" > <section> <a target="_blank" title="@bluegym.animation" href="https://www.tiktok.com/@bluegym.animation?refer=embed">@bluegym.animation</a> Crece tus PIERNAS con el peso muerto rumano!! Estos son los ejercicios de pierna que necesitas para una rutina COMPLETA enfocada a HIPERTRÓFIA y para hacer 1 VEZ A LA SEMANA (para principiantes o gente que no se complica, como yo🤪).  Os dejo variantes tanto para Gym (máquinas o peso libre) y para entrenar en casa! <a title="ejercicio" target="_blank" href="https://www.tiktok.com/tag/ejercicio?refer=embed">#ejercicio</a> <a title="pierna" target="_blank" href="https://www.tiktok.com/tag/pierna?refer=embed">#pierna</a> <a title="legday" target="_blank" href="https://www.tiktok.com/tag/legday?refer=embed">#legday</a> <a title="sentadilla" target="_blank" href="https://www.tiktok.com/tag/sentadilla?refer=embed">#sentadilla</a> <a title="zancadas" target="_blank" href="https://www.tiktok.com/tag/zancadas?refer=embed">#zancadas</a> <a title="pantorrillas" target="_blank" href="https://www.tiktok.com/tag/pantorrillas?refer=embed">#pantorrillas</a> <a title="isquios" target="_blank" href="https://www.tiktok.com/tag/isquios?refer=embed">#isquios</a> <a title="cuadriceps" target="_blank" href="https://www.tiktok.com/tag/cuadriceps?refer=embed">#cuadriceps</a> <a title="femoral" target="_blank" href="https://www.tiktok.com/tag/femoral?refer=embed">#femoral</a> <a title="gluteos" target="_blank" href="https://www.tiktok.com/tag/gluteos?refer=embed">#gluteos</a> <a title="encasa" target="_blank" href="https://www.tiktok.com/tag/encasa?refer=embed">#encasa</a> <a title="consejos" target="_blank" href="https://www.tiktok.com/tag/consejos?refer=embed">#consejos</a> <a title="gimnasio" target="_blank" href="https://www.tiktok.com/tag/gimnasio?refer=embed">#gimnasio</a> <a title="gym" target="_blank" href="https://www.tiktok.com/tag/gym?refer=embed">#gym</a> <a title="rutina" target="_blank" href="https://www.tiktok.com/tag/rutina?refer=embed">#rutina</a> 
                        <a title="entrenamiento" target="_blank" href="https://www.tiktok.com/tag/entrenamiento?refer=embed">#entrenamiento</a> <a title="posturacorporal" target="_blank" href="https://www.tiktok.com/tag/posturacorporal?refer=embed">#posturacorporal</a> <a target="_blank" title="♬ sonido original  - Blue Gym Animation" href="https://www.tiktok.com/music/sonido-original-Blue-Gym-Animation-7541443961244699414?refer=embed">♬ sonido original  - Blue Gym Animation</a> </section> </blockquote> <script async src="https://www.tiktok.com/embed.js"></script>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-5">
            <div class="card h-100 shadow-sm border-0 bg-light">
                <div class="card-body p-4 text-center">
                    <h4 class="fw-bold text-dark mb-3">Ejercicios para biceps 💪</h4>
                    <p class="text-secondary small mb-4">Los tres mejores ejerecicios</p>

                    {{-- Embed de TikTok. Lo dejo separado para que sea más fácil cambiarlo por otro vídeo. --}}
                    <div class="d-flex justify-content-center w-100">
                        <blockquote class="tiktok-embed" cite="https://www.tiktok.com/@bluegymanimation/video/7566697987653602590" data-video-id="7566697987653602590" style="max-width: 605px;min-width: 325px;" > 
                            <section> <a target="_blank" title="@bluegymanimation" href="https://www.tiktok.com/@bluegymanimation?refer=embed">@bluegymanimation</a> LOS TRES MEJORES EJERCICIOS DE BÍCEPS 1&#47;4 <a title="bluegymanimation" target="_blank" href="https://www.tiktok.com/tag/bluegymanimation?refer=embed">#bluegymanimation</a> <a title="gym" target="_blank" href="https://www.tiktok.com/tag/gym?refer=embed">#gym</a> <a title="biceps" target="_blank" href="https://www.tiktok.com/tag/biceps?refer=embed">#biceps</a> <a title="curl" target="_blank" href="https://www.tiktok.com/tag/curl?refer=embed">#curl</a> <a title="gymtips" target="_blank" href="https://www.tiktok.com/tag/gymtips?refer=embed">#gymtips</a> <a target="_blank" title="♬ original sound - Blue Gym Animation" href="https://www.tiktok.com/music/original-sound-7566703147415112478?refer=embed">♬ original sound - Blue Gym Animation</a> </section> </blockquote> 
                        <script async src="https://www.tiktok.com/embed.js"></script>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-5">
            <div class="card h-100 shadow-sm border-0 bg-light">
                <div class="card-body p-4 text-center">
                    <h4 class="fw-bold text-dark mb-3">Entrenamiento de espalda</h4>
                    <p class="text-secondary small mb-4">Mejora tu rutina de espalda</p>

                    {{-- Embed de TikTok. Lo dejo separado para que sea más fácil cambiarlo por otro vídeo. --}}
                    <div class="d-flex justify-content-center w-100">
                        <blockquote class="tiktok-embed" cite="https://www.tiktok.com/@bluegym.animation/video/7618944961584844035" data-video-id="7618944961584844035" style="max-width: 605px;min-width: 325px;" > <section> <a target="_blank" title="@bluegym.animation" href="https://www.tiktok.com/@bluegym.animation?refer=embed">@bluegym.animation</a> Cómo entrenar la ESPALDA💪💪 Te explico cómo hacer crecer tu espalda en el gym. Es simple: Hacer Remo. Pero si quieres mejorar tu rutina de forma eficiente sin repetir ejercicios ni movimientos, te dejo aquí las claves para entrenar de manera completa tu espalda 💪💪 <a title="ejercicio" target="_blank" href="https://www.tiktok.com/tag/ejercicio?refer=embed">#ejercicio</a> <a title="rutina" target="_blank" href="https://www.tiktok.com/tag/rutina?refer=embed">#rutina</a> <a title="espalda" target="_blank" href="https://www.tiktok.com/tag/espalda?refer=embed">#espalda</a> <a title="entrenamiento" target="_blank" href="https://www.tiktok.com/tag/entrenamiento?refer=embed">#entrenamiento</a> <a title="remo" target="_blank" href="https://www.tiktok.com/tag/remo?refer=embed">#remo</a> <a title="mancuernasencasa" target="_blank" href="https://www.tiktok.com/tag/mancuernasencasa?refer=embed">#mancuernasencasa</a> <a title="barra" target="_blank" href="https://www.tiktok.com/tag/barra?refer=embed">#barra</a> <a title="polea" target="_blank" href="https://www.tiktok.com/tag/polea?refer=embed">#polea</a> <a title="hombro" target="_blank" href="https://www.tiktok.com/tag/hombro?refer=embed">#hombro</a> <a title="trapecio" target="_blank" href="https://www.tiktok.com/tag/trapecio?refer=embed">#trapecio</a> <a title="gym" target="_blank" href="https://www.tiktok.com/tag/gym?refer=embed">#gym</a> <a target="_blank" title="♬ sonido original  - Blue Gym Animation" href="https://www.tiktok.com/music/sonido-original-Blue-Gym-Animation-7618944993696271126?refer=embed">♬ sonido original  - Blue Gym Animation</a> </section> </blockquote> <script async src="https://www.tiktok.com/embed.js"></script>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-5">
            <div class="card h-100 shadow-sm border-0 bg-light">
                <div class="card-body p-4 text-center">
                    <h4 class="fw-bold text-dark mb-3">Los mejores ejercicios para hombro</h4>
                    <p class="text-secondary small mb-4">Implemeta esto en tu rutina y tus hombros creceran</p>

                    {{-- Embed de TikTok. Lo dejo separado para que sea más fácil cambiarlo por otro vídeo. --}}
                    <div class="d-flex justify-content-center w-100">
                        <blockquote class="tiktok-embed" cite="https://www.tiktok.com/@bluegymanimation/video/7638540164863692062" data-video-id="7638540164863692062" style="max-width: 605px;min-width: 325px;" > <section> <a target="_blank" title="@bluegymanimation" href="https://www.tiktok.com/@bluegymanimation?refer=embed">@bluegymanimation</a> Los Mejores Ejercicios De HOMBRO 2&#47;5 <a title="gymtips" target="_blank" href="https://www.tiktok.com/tag/gymtips?refer=embed">#gymtips</a> <a title="hombros" target="_blank" href="https://www.tiktok.com/tag/hombros?refer=embed">#hombros</a> <a target="_blank" title="♬ original sound  - Blue Gym Animation" href="https://www.tiktok.com/music/original-sound-Blue-Gym-Animation-7638540456392919838?refer=embed">♬ original sound  - Blue Gym Animation</a> </section> </blockquote> <script async src="https://www.tiktok.com/embed.js"></script>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-5">
            <div class="card h-100 shadow-sm border-0 bg-light">
                <div class="card-body p-4 text-center">
                    <h4 class="fw-bold text-dark mb-3">Ejercicios para pecho</h4>
                    <p class="text-secondary small mb-4">Trabaja tu pecho, para tenerlo como superman</p>

                    {{-- Embed de TikTok. Lo dejo separado para que sea más fácil cambiarlo por otro vídeo. --}}
                    <div class="d-flex justify-content-center w-100">
                        <blockquote class="tiktok-embed" cite="https://www.tiktok.com/@bluegym.animation/video/7589323223620357398" data-video-id="7589323223620357398" style="max-width: 605px;min-width: 325px;" > <section> <a target="_blank" title="@bluegym.animation" href="https://www.tiktok.com/@bluegym.animation?refer=embed">@bluegym.animation</a> 🛒10% Código BLUEGYM en Myprotein🛒 Los 2 ejercicios de pecho PRINCIPALES 💪💪 Vídeo completo en mi canal de Youtube: Te explico la teoría muy fácil, sobre cómo entrenar tu pecho, y una vez entiendas esto, vas a poder aplicarla en tus rutinas para siempre 💪💪 <a title="gym" target="_blank" href="https://www.tiktok.com/tag/gym?refer=embed">#gym</a> <a title="entrenamiento" target="_blank" href="https://www.tiktok.com/tag/entrenamiento?refer=embed">#entrenamiento</a> <a title="rutina" target="_blank" href="https://www.tiktok.com/tag/rutina?refer=embed">#rutina</a> <a title="ejercicio" target="_blank" href="https://www.tiktok.com/tag/ejercicio?refer=embed">#ejercicio</a> <a title="pecho" target="_blank" href="https://www.tiktok.com/tag/pecho?refer=embed">#pecho</a> <a title="press" target="_blank" href="https://www.tiktok.com/tag/press?refer=embed">#press</a> <a title="banca" target="_blank" href="https://www.tiktok.com/tag/banca?refer=embed">#banca</a> <a title="pectoral" target="_blank" href="https://www.tiktok.com/tag/pectoral?refer=embed">#pectoral</a> <a title="encasa" target="_blank" href="https://www.tiktok.com/tag/encasa?refer=embed">#encasa</a> <a target="_blank" title="♬ sonido original  - Blue Gym Animation" href="https://www.tiktok.com/music/sonido-original-Blue-Gym-Animation-7589323243128638230?refer=embed">♬ sonido original  - Blue Gym Animation</a> </section> </blockquote> <script async src="https://www.tiktok.com/embed.js"></script>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-5">
            <div class="card h-100 shadow-sm border-0 bg-light">
                <div class="card-body p-4 text-center">
                    <h4 class="fw-bold text-dark mb-3">Como empezar en el gimnasio</h4>
                    <p class="text-secondary small mb-4">Si eres nuevo en el gimnasio, mira esto</p>

                    {{-- Embed de TikTok. Lo dejo separado para que sea más fácil cambiarlo por otro vídeo. --}}
                    <div class="d-flex justify-content-center w-100">
                        <blockquote class="tiktok-embed" cite="https://www.tiktok.com/@bluegym.animation/video/7592319641352015126" data-video-id="7592319641352015126" style="max-width: 605px;min-width: 325px;" > <section> <a target="_blank" title="@bluegym.animation" href="https://www.tiktok.com/@bluegym.animation?refer=embed">@bluegym.animation</a> Te explico cómo empezar en el gimnasio desde cero, paso a paso y sin complicarte la vida. Está pensado tanto para personas que nunca han ido al gym, como para los que ya lo intentaron alguna vez pero lo acabaron dejando.  Te dejo una rutina de fullbody, con solo 4 ejercicios por día, que puedes completar en unos 40 minutos, siguiendo un plan claro de 6 meses para crear el hábito, aprender técnica y progresar al siguiente nivel 💪💪 <a title="gym" target="_blank" href="https://www.tiktok.com/tag/gym?refer=embed">#gym</a> <a title="principiantes" target="_blank" href="https://www.tiktok.com/tag/principiantes?refer=embed">#principiantes</a> <a title="alimentacion" target="_blank" href="https://www.tiktok.com/tag/alimentacion?refer=embed">#alimentacion</a> <a title="pecho" target="_blank" href="https://www.tiktok.com/tag/pecho?refer=embed">#pecho</a> <a title="encasa" target="_blank" href="https://www.tiktok.com/tag/encasa?refer=embed">#encasa</a> <a title="entrenamiento" target="_blank" href="https://www.tiktok.com/tag/entrenamiento?refer=embed">#entrenamiento</a> <a title="ejercicio" target="_blank" href="https://www.tiktok.com/tag/ejercicio?refer=embed">#ejercicio</a> <a target="_blank" title="♬ sonido original  - Blue Gym Animation" href="https://www.tiktok.com/music/sonido-original-Blue-Gym-Animation-7592319659521706774?refer=embed">♬ sonido original  - Blue Gym Animation</a> </section> </blockquote> <script async src="https://www.tiktok.com/embed.js"></script>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection

@push('scripts')
    {{-- TikTok necesita este script para transformar el blockquote en vídeo. --}}
    <script async src="https://www.tiktok.com/embed.js"></script>
@endpush
