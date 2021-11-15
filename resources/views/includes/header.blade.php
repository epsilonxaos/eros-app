<header class="{{(request() -> is('politicas') || request() -> is('terminos')) ? 'white' : ''}}">
    <nav class="nav-menu py-3" id="nav-menu">
        <div class="container-fluid w16">
            <div class="row align-items-center">
                <div class="col-8 col-md-3 pl-md-4 pl-lg-5">
                    <a href="{{route('app.home')}}">
                        <img src={{asset('img/logo-white.svg')}} alt="Eros" class="logo" >
                    </a>
                </div>
                <div class="col-md-9 pr-md-4 pr-lg-5 d-none d-md-block">
                    <ul class="menu-list list-unstyled d-flex align-items-center justify-content-end p-0 m-0">
                        <li class="move-animation ml-3 ml-lg-4 {{request() -> is("/") ? 'active neon blue-neon' : ''}}"><a class="static-menu" href="{{request() -> is("/") ? '#home' : route('app.home')."#home" }}" data-id="#home" data-space="0" data-speed="1000">Nosotros</a></li>
                        <li class="move-animation ml-3 ml-lg-4"><a class="static-menu" href="{{request() -> is("/") ? '#habitaciones' : route('app.home')."#habitaciones" }}" data-id="#habitaciones" data-space="0" data-speed="1000">Habitaciones</a></li>
                        <li class="move-animation ml-3 ml-lg-4"><a class="static-menu" href="{{request() -> is("/") ? '#servicios' : route('app.home')."#servicios" }}" data-id="#servicios" data-space="0" data-speed="1000">Servicios</a></li>
                        <li class="ml-3 ml-lg-4 {{request() -> is("sexshop") ? 'active neon blue-neon' : ''}}"><a href="{{route('app.sexshop')."?categoria=2"}}">Sexshop</a></li>
                        <li class="ml-3 ml-lg-4 {{request() -> is("catalogo*") ? 'active neon blue-neon' : ''}}"><a href="{{route('app.catalogo')}}">Catálogo</a></li>
                        <li class="ml-3 ml-lg-4 {{request() -> is("contacto") ? 'active neon blue-neon' : ''}}"><a href="{{route('app.contacto')}}">Contacto</a></li>
                    </ul>
                </div>
                <div class="col-4 d-md-none text-right">
                    <div class="menu menu-3" id="btn-menu-movil">
                        <span></span>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <nav class="nav-sidebar text-center d-md-none">
        <img src="{{asset('img/logo-black.svg')}}" alt="Eros" class="mb-4" style="max-width: 250px">

        <ul class="list-unstyled mb-0 p-0">
            <li class="move-animation"><a class="static-menu {{request() -> is("/") ? 'active neon red-neon text-dark' : ''}}" href="{{request() -> is("/") ? '#home' : route('app.home')."#home" }}" data-id="#home" data-space="0" data-speed="1000">Nosotros</a></li>
            <li class="move-animation"><a class="static-menu" href="{{request() -> is("/") ? '#habitaciones' : route('app.home')."#habitaciones" }}" data-id="#habitaciones" data-space="90" data-speed="1000">Habitaciones</a></li>
            <li class="move-animation"><a class="static-menu" href="{{request() -> is("/") ? '#servicios' : route('app.home')."#servicios" }}" data-id="#servicios" data-space="90" data-speed="1000">Servicios</a></li>
            <li><a class="{{request() -> is("sexshop") ? 'active neon red-neon text-dark' : ''}}" href="{{route('app.catalogo')}}">Sexshop</a></li>
            <li><a class="{{request() -> is("catalogo*") ? 'active neon red-neon text-dark' : ''}}" href="{{route('app.catalogo')}}">Catálogo</a></li>
            <li><a class="{{request() -> is("contacto") ? 'active neon red-neon text-dark' : ''}}" href="{{route('app.contacto')}}">Contacto</a></li>
        </ul>

        <hr>
        <p class="mb-0"><a href="">FAQ's</a></p>
        <p class="mb-0"><a href="">Terminos y condiciones</a></p>
        <p><a href="">Aviso de privacidad</a></p>
        {{-- <hr> --}}

        {{-- <a href=""><img class="icon" src="{{asset('img/icons/facebook.svg')}}" alt="Facebook"></a> --}}
        {{-- <a href=""><img class="icon" src="{{asset('img/icons/twitter.svg')}}" alt="twitter"></a> --}}
        {{-- <a href=""><img class="icon" src="{{asset('img/icons/instagram.svg')}}" alt="instagram"></a> --}}
        {{-- <a href=""><img class="icon" src="{{asset('img/icons/whatsapp.svg')}}" alt="whatsapp"></a> --}}
    </nav>
</header>
