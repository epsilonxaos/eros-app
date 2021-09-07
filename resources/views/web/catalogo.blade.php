@extends('layouts.app')

@push('link')
    <link rel="stylesheet" href="{{mix('css/catalogo.css')}}">
@endpush

@section('content')
    <div class="catalogo">
        <div class="container-fluid w16">
            <div class="row align-items-end mb-5">
                <div class="col-12 col-md-4 col-lg-5 mb-4 mb-md-0">
                    <form action="{{route('app.catalogo.buscar')}}" method="GET">
                        <input class="form-control" name="buscar" type="search" placeholder="Buscar" />
                    </form>
                </div>
                <div class="col-12 col-md-8 col-lg-7">
                    <form action="{{route('app.catalogo')}}" method="GET">
                        <div class="row align-items-end">
                            <div class="col-12 col-sm-6 col-md-5 mb-4 mb-md-0">
                                <label class="text-white neon">Ubicación</label>
                                {{-- <div class="dropdown w-100">
                                    <button class="btn w-100 dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        @if (Request::get('establecimiento') !== null)
                                            @foreach ($info['establecimientos'] as $key => $item)
                                                @if ($item -> id == Request::get('establecimiento'))
                                                    {{$item -> nombre}}
                                                @endif
                                            @endforeach
                                        @else
                                            {{$info['establecimientos'][0] -> nombre}}
                                        @endif
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        @foreach ($info['establecimientos'] as $key => $item)
                                            @if (Request::get('establecimiento') !== null)
                                                <a class="dropdown-item {{Request::get('establecimiento') == $item -> id ? 'active' : ''}}" href="javascript:;" data-id="{{$item -> id}}">{{$item -> nombre}}</a>
                                            @else
                                                <a class="dropdown-item {{$key == $item -> id ? 'active' : ''}}" href="javascript:;" data-id="{{$item -> id}}">{{$item -> nombre}}</a>
                                            @endif
                                        @endforeach
                                    </div>
                                </div> --}}
                                <select class="form-control" name="establecimiento">
                                    @foreach ($info['establecimientos'] as $key => $item)
                                        @if (Request::get('establecimiento') !== null)
                                            <option value="{{$item -> id}}" {{Request::get('establecimiento') == $item -> id ? 'selected' : ''}}>{{$item -> nombre}}</option>
                                        @else
                                            <option value="{{$item -> id}}" {{$key === 0 ? 'selected' : ''}}>{{$item -> nombre}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12 col-sm-6 col-md-5 mb-4 mb-md-0">
                                <label class="text-white neon">Categoria</label>
                                <select class="form-control" name="categoria">
                                    <option value="">Seleccione una opción</option>
                                    @foreach ($info['categorias'] as $key => $item)
                                        @if (Request::get('categoria') !== null)
                                            <option value="{{$item -> id}}" {{Request::get('categoria') == $item -> id ? 'selected' : ''}}>{{$item -> nombre}}</option>
                                        @else
                                            <option value="{{$item -> id}}">{{$item -> nombre}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12 col-md-2 pl-md-0 text-center text-md-right">
                                <button class="btn btn-info" type="submit">Aplicar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="row">
                @if (count($info['productos']) > 0)
                    @foreach ($info['productos'] as $item)
                        <div class="col-12 col-sm-6 col-md-6 col-lg-4 card-result bg bg-img-view py-4" style="background-image: url({{asset($item -> cover)}})">
                            <div class="wpc w-100 h-100 position-absolute d-flex align-items-center justify-content-center align-items-md-end justify-content-md-start">
                                <div class="wp text-center text-md-left">
                                    <a href="{{route('app.catalogo.detalle')}}">
                                        <h2 class="text-white neon red-neon mb-0">{{$item -> nombre}}</h2>
                                        <p class="text-white">{{$item -> nombreEstablecimiento}}</p>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="col-12 text-center d-flex align-items-center justify-content-center" style="height: 350px">
                        <h4 class="neon red-neon">Sin resultados</h4>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
