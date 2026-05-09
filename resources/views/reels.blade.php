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
                    <h4 class="fw-bold text-dark mb-3">Hipertrofia al máximo</h4>
                    <p class="text-secondary small mb-4">Cómo romper fibras correctamente.</p>

                    {{-- Hueco preparado para pegar otro embed de TikTok cuando tenga el vídeo elegido. --}}
                    <div class="ratio ratio-1x1" style="min-height: 500px;">
                        <div class="d-flex align-items-center justify-content-center bg-white border rounded">
                           <span class="text-muted">Pega aquí el Embed de TikTok</span>
                        </div>
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
