@extends('layouts.app')

@push('link')
    <link rel="stylesheet" href="{{mix('css/catalogo.css')}}">
@endpush

@section('content')
    <div class="catalogo">
        <div class="container-fluid w16">
            <div class="row align-items-end mb-5">
                <div class="col-12 col-md-6 mb-4 mb-md-0">
                    <form>
                        <input class="form-control" type="search" placeholder="Buscar" />
                    </form>
                </div>
                <div class="col-12 col-md-3 mb-4 mb-md-0">
                    <label class="text-white">Ubicación</label>
                    <select class="form-control">
                        <option value="1" selected>Eros I</option>
                        <option value="2">Eros II</option>
                    </select>
                </div>
                <div class="col-12 col-md-3">
                    <label class="text-white">Categoria</label>
                    <select class="form-control">
                        <option value="">Seleccione una opción</option>
                        <option value="1">Habitaciones</option>
                        <option value="2">Sexshop</option>
                        <option value="3">Alimentos</option>
                        <option value="4">Bebidas</option>
                    </select>
                </div>
            </div>

            <div class="row">
                @for ($i = 0; $i < 12; $i++)
                    <div class="col-12 col-sm-6 col-md-6 col-lg-4 card-result bg bg-img-view py-4" style="background-image: url(https://source.unsplash.com/random?sig={{$i + 1}})">
                        <div class="wpc w-100 h-100 position-absolute d-flex align-items-center justify-content-center align-items-md-end justify-content-md-start">
                            <div class="wp text-center text-md-left">
                                <a href="{{route('app.catalogo.detalle')}}">
                                    <h2 class="text-white neon red-neon mb-0">Lorem ipsum</h2>
                                    <p class="text-white">Eros I</p>
                                </a>
                            </div>
                        </div>
                    </div>
                @endfor
            </div>
        </div>
    </div>
@endsection
