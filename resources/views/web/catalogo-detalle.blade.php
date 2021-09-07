@extends('layouts.app')

@push('link')
    <link rel="stylesheet" href="{{mix('css/catalogo.css')}}">
@endpush

@section('content')
    <div class="catalogo-detalle">
        <div class="container-fluid w16">
            <div class="row">
                <div class="col-12 col-md-7 col-lg-8 galeria mb-4 mb-md-0">
                    @if (count($info['galeria']) > 0)
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
                    @else
                        <img src="{{asset($info['producto'] -> cover)}}" alt="{{$info['producto'] -> nombre}}" class="w-100">
                    @endif
                </div>
                <div class="col-12 col-md-5 col-lg-4 text-white">
                    <h2 class="tlo">{{$info['producto'] -> nombre}}</h2>
                    <p class="line-text">{{$info['producto'] -> nombreEstablecimiento}}</p>
                    {!! $info['producto'] -> descripcion !!}
                </div>
            </div>
        </div>

        <div class="container ptb-section">
            {{-- <h3 class="tlo text-white text-center mb-5">Un lugar <span class="letter-x">erótico <span class="neon red-neon">x</span></span></h3> --}}

            <div class="row justify-content-center pt-5">
                @foreach ($info['amenidades'] as $item)
                    <div class="col-6 col-md-4 col-lg-3 pb-5 text-white text-center">
                        <img src="{{asset($item -> img)}}" alt="Wifi" class="mb-2">
                        <p>{{$item -> titulo}}</p>
                    </div>
                @endforeach
            </div>

            <div class="row justify-content-center">
                <div class="col-12 col-md-8">
                    {!! $info['producto'] -> descripcion_extra !!}
                    <div class="mb-5"></div>
                    <hr>
                    <a href="#">
                        <h4 class="titulos text-center text-white">Reservar por <span class="neon green-neon">whatsapp</span></h4>
                    </a>
                    <hr>
                </div>
            </div>
        </div>

        <div class="container-fluid w16 extras">
            <div class="row">
                @foreach ($info['otros'] as $item)
                    <div class="col-12 col-sm-6 col-md-6 col-lg-3 mb-3">
                        <a href="{{route('app.catalogo.detalle', ["id" => $item -> id, "url" => Str::slug($item -> nombre, '-')])}}">
                            <img src="{{$item -> cover}}" alt="" class="img-object">
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="{{mix('js/galeria.js')}}"></script>
@endpush
