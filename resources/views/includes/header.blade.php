<header class="{{(request() -> is('politicas') || request() -> is('terminos')) ? 'white' : ''}}">
    <nav class="nav-menu py-3">
        <div class="container-fluid w16">
            <div class="row align-items-center">
                <div class="col-8 col-md-3">
                    <a href="{{route('app.home')}}">
                        <img src={{asset('img/logo-white.svg')}} alt="Eros" class="logo" >
                    </a>
                </div>
                <div class="col-md-9 d-none d-md-block">
                    <ul class="menu-list list-unstyled d-flex align-items-center justify-content-end p-0 m-0">
                        <li><a href="#">Nosotros</a></li>
                        <li class="move-animation ml-3 ml-lg-4"><a href="javascript:;" data-id="#habitaciones" data-space="0" data-speed="1000">Habitaciones</a></li>
                        <li class="move-animation ml-3 ml-lg-4"><a href="javascript:;" data-id="#servicios" data-space="0" data-speed="1000">Servicios</a></li>
                        <li class="ml-3 ml-lg-4"><a href="{{route('app.catalogo')}}">Sexshop</a></li>
                        <li class="ml-3 ml-lg-4 active neon blue-neon"><a href="{{route('app.catalogo')}}">Catálogo</a></li>
                        <li class="ml-3 ml-lg-4"><a href="{{route('app.contacto')}}">Contacto</a></li>
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
            <li><a class="active neon yellow-neon text-dark" href="#">Nosotros</a></li>
            <li class="move-animation"><a class="" href="javascript:;" data-id="#habitaciones" data-space="60" data-speed="1000">Habitaciones</a></li>
            <li class="move-animation"><a class="" href="javascript:;" data-id="#servicios" data-space="60" data-speed="1000">Servicios</a></li>
            <li><a class="" href="{{route('app.catalogo')}}">Sexshop</a></li>
            <li><a class="" href="{{route('app.catalogo')}}">Catálogo</a></li>
            <li><a class="" href="{{route('app.contacto')}}">Contacto</a></li>
        </ul>

        <hr>
        <p class="mb-0"><a href="">FAQ's</a></p>
        <p class="mb-0"><a href="">Terminos y condiciones</a></p>
        <p><a href="">Aviso de privacidad</a></p>
        <hr>

        <a href=""><img class="icon" src="{{asset('img/icons/facebook.svg')}}" alt="Facebook"></a>
        <a href=""><img class="icon" src="{{asset('img/icons/twitter.svg')}}" alt="twitter"></a>
        <a href=""><img class="icon" src="{{asset('img/icons/instagram.svg')}}" alt="instagram"></a>
        <a href=""><img class="icon" src="{{asset('img/icons/whatsapp.svg')}}" alt="whatsapp"></a>
    </nav>
</header>
