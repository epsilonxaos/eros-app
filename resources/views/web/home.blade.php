@extends('layouts.app')

@push('link')
    <link rel="stylesheet" href="{{mix('css/home.css')}}">
@endpush

@section('content')
    <div class="home-banner">
        <div class="container-fluid w12 h-100 pt-5 d-flex align-items-end position-relative">
            <div class="informacion">
                <h3 class="mb-0 neon red-neon">Dejando nada a</h3>
                <h1 class="mb-0 neon red-neon text-uppercase">La imaginación</h1>
                <h3 class="mb-0">Consulta nuestro catálogo <a href="#" style="text-decoration: underline">aquí</a></h3>
            </div>

            <span class="move-animation">
                <a href="javascript:;" data-id="#habitaciones" data-space="0" data-speed="1000">
                    <div class="arrow bounce"> </div>
                </a>
            </span>
        </div>

        <div class="video-banner-bg" style="background-color: #323232">
            <video muted loop autoplay class="w-100">
                <source src="{{asset('video/video-test.mp4')}}" type="video/mp4">
                Your browser does not support the video tag.
            </video>
            {{-- <iframe src="https://player.vimeo.com/video/11550303?autoplay=1&color=ffffff&title=0&byline=0&portrait=0&loop=10&background=1&muted=1" width="640" height="360" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen></iframe> --}}
        </div>
    </div>

    <div class="home-habitaciones bg-black" id="habitaciones">
        <div class="container-fluid" style="max-width: 1600px">
            <h3 class="titulos text-center text-white mb-5 text-uppercase">Conoce nuestras habitaciones</h3>
            <div class="row">
                <div class="col-12 col-md-6 pr-md-1 mb-2">
                    <div class="bg bg-img-view p-4" style="background-image: url({{asset('img/habitaciones-bg-1.jpg')}})">
                        <a href="{{route('app.catalogo')}}">
                            <div class="d-flex align-items-center justify-content-center h-100">
                                <div class="wp text-center">
                                    <h2 class="text-white mb-0">Eros I</h2>
                                    <h4 class="text-white mb-0">Entrar <img class="ml-2" src={{asset('img/icons/icon-link.png')}} alt="Go" /></h4>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="col-12 col-md-6 pl-md-1">
                    <div class="bg bg-img-view p-4" style="background-image: url({{asset('img/habitaciones-bg-2.jpg')}})">
                        <a href="{{route('app.catalogo')}}">
                            <div class="d-flex align-items-center justify-content-center h-100">
                                <div class="wp text-center">
                                    <h2 class="text-white mb-0">Eros II</h2>
                                    <h4 class="text-white mb-0">Entrar <img class="ml-2" src={{asset('img/icons/icon-link.png')}} alt="Go" /></h4>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="home-extras bg-black" id="servicios">
        <div class="container-fluid w16">
            <h3 class="titulos text-center text-white mb-5 text-uppercase">¿Qué se te antoja?</h3>
            <div class="row">
                <div class="col-12 col-md-6 pr-md-1 mb-2">
                    <div class="bg bg-img-view p-4" style="background-image: url({{asset('img/extras-bg-1.jpg')}})">
                        <div class="d-flex align-items-center justify-content-center h-100">
                            <div class="wp text-center text-md-left">
                                <h2 class="text-white mb-0">Alimentos <img class="ml-2" src={{asset('img/icons/icon-link.png')}} alt="Go" /></h2>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 pl-md-1 mb-2">
                    <div class="bg bg-img-view p-4" style="background-image: url({{asset('img/extras-bg-2.jpg')}})">
                        <div class="d-flex align-items-center justify-content-center h-100">
                            <div class="wp text-center text-md-right">
                                <h2 class="text-white mb-0">Sexshop II <img class="ml-2" src={{asset('img/icons/icon-link.png')}} alt="Go" /></h2>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 pr-md-1 mb-2">
                    <div class="bg bg-img-view p-4" style="background-image: url({{asset('img/extras-bg-3.jpg')}})">
                        <div class="d-flex align-items-center justify-content-center h-100">
                            <div class="wp text-center text-md-left">
                                <h2 class="text-white mb-0">Promociones <img class="ml-2" src={{asset('img/icons/icon-link.png')}} alt="Go" /></h2>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 pl-md-1 mb-2">
                    <div class="bg bg-img-view p-4" style="background-image: url({{asset('img/extras-bg-4.jpg')}})">
                        <div class="d-flex align-items-center justify-content-center h-100">
                            <div class="wp text-center text-md-right">
                                <h2 class="text-white mb-0">Bebidas <img class="ml-2" src={{asset('img/icons/icon-link.png')}} alt="Go" /></h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="home-contacto">
        <div class="container-fluid w16">
            <h3 class="titulos text-white mb-5">Contactanos</h3>

            <div class="row mb-4">
                <div class="col-12 col-md-4 col-xl-4">
                    <h3 class="text-white mb-3"><span class="neon red-neon">Eros I</span></h3>
                    <h4 class="text-white mb-1">T. <a href="tel:+529991567890">999 156 7890</a></h4>
                    <h4 class="text-white mb-4">C. <a href="mailto:erossuite@gmail.com">erossuite@gmail.com</a></h4>
                </div>
                <div class="col-12 col-md-4 col-xl-4">
                    <h3 class="text-white mb-3"><span class="neon red-neon">Eros II</span></h3>
                    <h4 class="text-white mb-1">T. <a href="tel:+529993728835">999 372 8835</a></h4>
                    <h4 class="text-white mb-4">C. <a href="mailto:erossuite@gmail.com">erossuite@gmail.com</a></h4>
                </div>
            </div>


            <div id="mapa" style="width: 100%; height: 450px"></div>
        </div>
    </div>
@endsection

@push('js')
    <script type="text/javascript" src="{{mix('js/mapa.js')}}"></script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDZ2z7aoo8okwvyHbaxfKwUi-sblBj5QYk&callback=initMap"></script>
@endpush
