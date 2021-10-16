@extends('layouts.app')

@push('link')
    <link rel="stylesheet" href="{{mix('css/extras.css')}}">
@endpush

@section('content')
    <div class="faqs">
        <div class="primera position-relative">
            <div class="container text-center">
                <h1 class="mb-5 text-uppercase"><span>La</span><br> guía del <br> primeriz@ <br> <span>al motel</span></h1>
                <p class="my-4">POR</p>
                <img class="mt-5 mb-2" src="{{asset('img/logo-circle.svg')}}" alt="Eros" style="max-width: 250px">
                <p class="mb-5">MÉR. ------------ YUC.</p>

                <span class="move-animation">
                    <a href="javascript:;" data-id="#preguntas" data-space="0" data-speed="1000">
                        <div class="arrow bounce center"> </div>
                    </a>
                </span>
            </div>
        </div>
        <div class="preguntas" id="preguntas">
            <div class="accordion pt-5" id="preguntasAcordion">
                <div class="container">
                    @if (count($info['faqs']) > 0)
                        @foreach ($info['faqs'] as $i => $item)
                            <div class="card">
                                <div class="card-header" id="heading-{{$i}}">
                                    <h2 class="mb-0 text-center">
                                        <button class="btn shadow-none font-weight-bold text-uppercase" style="color: goldenrod" type="button" data-toggle="collapse" data-target="#collapse-{{$i}}" aria-expanded="true" aria-controls="collapse-{{$i}}">
                                            {{$item -> titulo}} <img class="ml-2" src="{{asset('img/icons/down-arrow-16.png')}}" alt="">
                                        </button>
                                    </h2>
                                </div>

                                <div id="collapse-{{$i}}" class="collapse show" aria-labelledby="heading-{{$i}}" data-parent="#preguntasAcordion">
                                    <div class="card-body text-white text-center">
                                        <p>{{$item -> informacion}}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else

                        <div class="d-flex align-items-center justify-content-center text-center" style="height: 300px">
                            <h4 class="text-white">Sin información por el momento</h4>
                        </div>

                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
