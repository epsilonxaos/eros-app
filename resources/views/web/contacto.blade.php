@extends('layouts.app')

@push('link')
    <link rel="stylesheet" href="{{mix('css/home.css')}}">
@endpush

@section('content')
    <div class="p-4"></div>
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
