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
                <img class="mt-5 mb-2" src="{{asset('img/logo-white.svg')}}" alt="Eros" style="max-width: 250px">
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
                    @for ($i = 0; $i < 14; $i++)
                        <div class="card">
                            <div class="card-header" id="heading-{{$i}}">
                                <h2 class="mb-0 text-center">
                                    <button class="btn shadow-none font-weight-bold text-uppercase text-white" type="button" data-toggle="collapse" data-target="#collapse-{{$i}}" aria-expanded="true" aria-controls="collapse-{{$i}}">
                                        Collapsible Group Item #{{$i + 1}} <img src="{{asset('img/icons/down-arrow-16.png')}}" alt="">
                                    </button>
                                </h2>
                            </div>

                            <div id="collapse-{{$i}}" class="collapse show" aria-labelledby="heading-{{$i}}" data-parent="#preguntasAcordion">
                                <div class="card-body text-white text-center">
                                    <p>Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.</p>
                                </div>
                            </div>
                        </div>
                    @endfor
                </div>
            </div>
        </div>
    </div>
@endsection
