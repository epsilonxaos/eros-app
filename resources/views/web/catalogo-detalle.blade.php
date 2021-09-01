@extends('layouts.app')

@push('link')
    <link rel="stylesheet" href="{{mix('css/catalogo.css')}}">
@endpush

@section('content')
    <div class="catalogo-detalle">
        <div class="container-fluid w16">
            <div class="row">
                <div class="col-12 col-md-7 col-lg-8 galeria mb-4 mb-md-0">
                    <div class="swiper-container gallery-top">
                        <div class="swiper-wrapper">
                            @for ($i = 0; $i < 5; $i++)
                                <div class="swiper-slide"><img src="https://source.unsplash.com/random?sig={{$i + 1}}" alt="Galeria" class="img-object slide"></div>
                            @endfor
                        </div>
                        <div class="swiper-button-next swiper-button-white"></div>
                        <div class="swiper-button-prev swiper-button-white"></div>
                    </div>
                    <div class="swiper-container gallery-thumbs">
                        <div class="swiper-wrapper">
                            @for ($i = 0; $i < 5; $i++)
                                <div class="swiper-slide"><img src="https://source.unsplash.com/random?sig={{$i + 1}}" alt="Galeria" class="img-object thumbs"></div>
                            @endfor
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-5 col-lg-4 text-white">
                    <h2 class="tlo">Lujo Cenote</h2>
                    <p class="line-text">Eros II</p>
                    <p>Minim occaecat non mollit sunt voluptate consectetur mollit mollit duis cillum id anim. Lorem culpa irure incididunt ea magna voluptate. Exercitation et sint non culpa consequat id quis consectetur enim duis eu commodo consequat magna.</p>
                </div>
            </div>
        </div>

        <div class="container ptb-section">
            <h3 class="tlo text-white text-center mb-5">Un lugar <span class="letter-x">erótico <span class="neon red-neon">x</span></span></h3>

            <div class="row justify-content-center pt-5">
                @for ($i = 0; $i < 8; $i++)
                <div class="col-6 col-md-4 col-lg-3 pb-5 text-white text-center">
                    <img src="{{asset('img/amenidades/wifi.png')}}" alt="Wifi" class="mb-2" style="filter: invert(1)">
                    <p>Wi fi</p>
                </div>
                @endfor
            </div>

            <div class="row justify-content-center">
                <div class="col-12 col-md-8">
                    <p class="text-white text-center mt-5">Anim Lorem irure exercitation labore eiusmod. Voluptate ea eu laboris deserunt culpa labore anim minim tempor ex qui aute fugiat. Laboris voluptate officia incididunt dolore anim anim. Ex magna sunt et irure labore.</p>
                    <div class="mb-5"></div>
                    <hr>
                    <a href="">
                        <h4 class="titulos text-center text-white">Reservar por <span class="neon green-neon">whatsapp</span></h4>
                    </a>
                    <hr>
                </div>
            </div>
        </div>

        <div class="container-fluid w16 extras">
            <div class="row">
                @for ($i = 0; $i < 8; $i++)
                    <div class="col-12 col-sm-6 col-md-6 col-lg-3 mb-3">
                        <img src="https://source.unsplash.com/random?sig={{$i + 1}}" alt="" class="img-object">
                    </div>
                @endfor
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="{{mix('js/galeria.js')}}"></script>
@endpush
