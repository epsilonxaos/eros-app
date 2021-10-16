<footer class="pb-4 {{(request() -> is('politicas') || request() -> is('terminos')) ? 'white' : ''}}">
    <div class="container-fluid w16">
        <div class="row">
            <div class="col-12 col-md-9 text-center text-md-left d-md-flex align-items-md-center justify-content-md-start mb-4 mb-md-0">
                <p class="mb-2 mb-md-0 mr-md-3"><a href="{{route('app.politicas')}}">Política de privacidad</a></p>
                <p class="mb-2 mb-md-0 mr-md-3"><a href="{{route('app.terminos')}}">Términos & condiciones</a></p>
                <p class="mb-0"><a href="{{route('app.faqs')}}">FAQ's</a></p>
            </div>
            <div class="col-12 col-md-3 text-center text-md-right">
                <img class="mr-2" src={{asset('img/icons/facebook.svg')}} alt="Facebook" />
                <img class="mr-2" src={{asset('img/icons/twitter.svg')}} alt="Twitter" />
                <img class="mr-2" src={{asset('img/icons/instagram.svg')}} alt="Instagram" />
                <img src={{asset('img/icons/whatsapp.svg')}} alt="Whatsapp" />
            </div>
        </div>
    </div>
</footer>
