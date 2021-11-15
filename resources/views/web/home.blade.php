@extends('layouts.app')

@push('link')
    <link rel="stylesheet" href="{{mix('css/home.css')}}">
    <style>
        .vimeo-wrapper { position: fixed; top: 0; left: 0; width: 100%; height: 100%; z-index: -1; pointer-events: none; overflow: hidden; }
        .vimeo-wrapper iframe { width: 100vw; height: 56.25vw; min-height: 100vh; min-width: 177.77vh; position: absolute; top: 0; left: 50% !important; transform: translateX(-50%); }
        @media screen and (min-width: 768px){
            .vimeo-wrapper iframe { top: 0; left: 50% !important; transform: translateX(-50%); }
        }
    </style>
@endpush

@section('content')
    <div class="home-banner" id="home">
        <div class="container-fluid w12 h-100 pt-5 d-flex align-items-end position-relative">
            <div class="informacion">
                <h3 class="mb-0">{{$info['website'] -> banner_texto_1}}</h3>
                <h1 class="mb-0 text-uppercase">{{$info['website'] -> banner_texto_2}}</h1>
                <h3 class="mb-0">{{$info['website'] -> banner_texto_3}} <a href="{{asset($info['website'] -> catagoloPDF) }}" target="_blank" style="text-decoration: underline">aquí</a></h3>
            </div>

            <span class="move-animation">
                <a href="javascript:;" data-id="#habitaciones" data-space="0" data-speed="1000">
                    <div class="arrow bounce"> </div>
                </a>
            </span>
        </div>

        <div class="video-banner-bg" style="background-color: #323232">
            {{-- <video muted loop autoplay class="w-100">
                <source src="{{asset('video/video-test.mp4')}}" type="video/mp4">
                Your browser does not support the video tag.
            </video> --}}
            {{-- <div style="padding:56.25% 0 0 0;position:relative;"><iframe src="https://player.vimeo.com/video/183174083?h=112327f091&autoplay=1&title=0&byline=0&portrait=0" style="position:absolute;top:0;left:0;width:100%;height:100%;" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen></iframe></div><script src="https://player.vimeo.com/api/player.js"></script> --}}
            <iframe src="https://player.vimeo.com/video/183174083?autoplay=1&color=ffffff&title=0&byline=0&portrait=0&loop=10&background=1&muted=1" width="640" height="360" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen></iframe>
        </div>
    </div>

    <div class="home-habitaciones bg-black" id="habitaciones">
        <div class="container-fluid" style="max-width: 1600px">
            <h3 class="titulos text-center text-white mb-5 text-uppercase">{{$info['website'] -> hab_titulo}}</h3>
            <div class="row">
                @foreach ($info['establecimientos'] as $key => $item)
                    <div class="col-12 {{count($info['establecimientos']) !== ($key + 1) ? 'col-md-6' : (($key % 2 === 0) ? '' : 'col-md-6')}} {{$key % 2 === 0 ? 'pr-md-1' : 'pl-md-1'}} mb-2">
                        <a href="{{route('app.catalogo')."?establecimiento=".$item -> id."&categoria=1"}}">
                            <div class="bg bg-img-view p-4" style="background-image: url({{asset($item -> cover)}})">
                                <div class="d-flex align-items-center justify-content-center h-100">
                                    <div class="wp text-center">
                                        <h2 class="text-white mb-0">{{$item -> nombre}}</h2>
                                        <h4 class="text-white mb-0">Entrar <img class="ml-2" src={{asset('img/icons/icon-link.png')}} alt="Go" /></h4>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="home-extras bg-black" id="servicios">
        <div class="container-fluid w16">
            <h3 class="titulos text-center text-white mb-5 text-uppercase">{{$info['website'] -> ser_titulo}}</h3>
            <div class="row">
                @foreach ($info['categorias'] as $key => $item)
                    <div class="col-12 {{count($info['categorias']) !== ($key + 1) ? 'col-md-6' : (($key % 2 === 0) ? '' : 'col-md-6')}} {{$key % 2 === 0 ? 'pr-md-1' : 'pl-md-1'}} mb-2">
                        <a href="{{route('app.catalogo')."?categoria=".$item -> id}}">
                            <div class="bg bg-img-view p-4" style="background-image: url({{asset($item -> cover)}})">
                                <div class="d-flex align-items-center justify-content-center h-100">
                                    <div class="wp text-center text-md-left">
                                        <h2 class="text-white mb-0">{{$item -> nombre}} <img class="ml-2" src={{asset('img/icons/icon-link.png')}} alt="Go" /></h2>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="home-contacto">
        <div class="container-fluid w16">
            <h3 class="titulos text-white mb-5 text-center">{{$info['website'] -> con_titulo}}</h3>

            <div class="row mb-4 text-center justify-content-center">
                @foreach ($info['establecimientos'] as $item)
                    <div class="col-12 col-md-4 col-xl-4 mb-4">
                        <h3 class="text-white mb-3"><span class="neon red-neon">{{$item -> nombre}}</span></h3>

                        <div class="d-block mb-3">
                            @if ($item -> facebook) <a href="{{$item -> facebook}}" target="_blank"><img class="icon" style="width: 25px; filter: invert(1);" src="{{asset('img/icons/facebook.svg')}}" alt="Facebook"></a> @endif
                            @if ($item -> twitter) <a class="ml-2" href="{{$item -> twitter}}" target="_blank"><img class="icon" style="width: 25px; filter: invert(1);" src="{{asset('img/icons/twitter.svg')}}" alt="twitter"></a> @endif
                            @if ($item -> instagram) <a class="ml-2" href="{{$item -> instagram}}" target="_blank"><img class="icon" style="width: 25px; filter: invert(1);" src="{{asset('img/icons/instagram.svg')}}" alt="instagram"></a> @endif
                            @if ($item -> whatsapp) <a class="ml-2" href="{{$item -> whatsapp}}" target="_blank"><img class="icon" style="width: 25px; filter: invert(1);" src="{{asset('img/icons/whatsapp.svg')}}" alt="whatsapp"></a> @endif
                        </div>

                        @if ($item -> telefono)
                            <h4 class="text-white mb-1">T. <a href="tel:+52{{$item -> telefono}}">{{$item -> telefono}}</a></h4>
                        @endif
                        @if ($item -> email)
                            <h4 class="text-white mb-4">C. <a href="mailto:{{$item -> email}}">{{$item -> email}}</a></h4>
                        @endif


                    </div>
                @endforeach
            </div>


            <div id="mapa" style="width: 100%; height: 450px"></div>
        </div>
    </div>
@endsection

@php
    $locations = Array();

    foreach ($info['establecimientos'] as $key => $item) {
        if($item -> lng && $item -> lat) {
            $row['lng'] = floatval($item -> lng);
            $row['lat'] = floatval($item -> lat);
            $row['name'] = $item -> nombre;
            array_push($locations, $row);
        }
    }
@endphp

@push('js')
    <script type="text/javascript">
        const locations = @json($locations);

        var topMenu = $("#nav-menu"),
            topMenuHeight = $("#nav-menu").outerHeight() + 30,
            menuItems = topMenu.find("a.static-menu"),
            scrollItems = menuItems.map(function() {
                let item = $($(this).attr("href"));
                console.log(item);

                if(item.length) return item;
            });

        var menuItemsMovil = document.querySelectorAll(".nav-sidebar a.static-menu");

        $(window).scroll(function () {
            let fromTop = $(this).scrollTop() + topMenuHeight;
            let cur = scrollItems.map(function() {
                if($(this).offset().top < fromTop) return this;
            });
            cur = cur[cur.length - 1];
            let id = cur && cur.length ? cur[0].id : "";
            menuItems
                .parent().removeClass("active neon blue-neon")
                .end().filter('[href="#'+id+'"]').parent().addClass("active neon blue-neon");

                console.log(menuItemsMovil);

            menuItemsMovil.forEach(item => {
                item.classList.remove('active');
                item.classList.remove('neon');
                item.classList.remove('red-neon');
                item.classList.remove('text-dark');
            });

            document.querySelector('.nav-sidebar a[data-id="#'+id+'"]').classList.add('active');
            document.querySelector('.nav-sidebar a[data-id="#'+id+'"]').classList.add('neon');
            document.querySelector('.nav-sidebar a[data-id="#'+id+'"]').classList.add('red-neon');
            document.querySelector('.nav-sidebar a[data-id="#'+id+'"]').classList.add('text-dark');
        });
    </script>
    <script type="text/javascript" src="{{mix('js/mapa.js')}}"></script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDZ2z7aoo8okwvyHbaxfKwUi-sblBj5QYk&callback=initMap"></script>
@endpush
