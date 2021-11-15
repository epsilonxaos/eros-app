@extends('layouts.app')

@push('link')
    <link rel="stylesheet" href="{{mix('css/home.css')}}">
@endpush

@section('content')
    <div class="p-4"></div>
    <div class="home-contacto">
        <div class="container-fluid w16">
            <h3 class="titulos text-white mb-5">Contactanos</h3>

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
    </script>
    <script type="text/javascript" src="{{mix('js/mapa.js')}}"></script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDZ2z7aoo8okwvyHbaxfKwUi-sblBj5QYk&callback=initMap"></script>
@endpush
