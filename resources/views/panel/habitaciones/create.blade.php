@extends('layouts.panel.app')

@section('content')
    <!-- Header -->
    @include('includes.panel.header')

    <!-- Page content -->
    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col">
                <form action="{{route('panel.eros.productos.store')}}" method="POST" enctype="multipart/form-data" class="form-submit-alert-wait">
                    <input type="hidden" name="tipo" value="habitacion">
                    @csrf
                    @method('PUT')
                    <div class="card">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col-12 col-sm-6"><h3>Agregar nuevo registro</h3></div>
                                <div class="col-12 col-sm-6 text-center text-sm-right">
                                    <button type="submit" class="btn btn-primary pt-2 pb-2"><i class="fas fa-save mr-2"></i> Guardar</button>
                                    {{-- @can(PermissionKey::Portafolio['permissions']['create']['name'])
                                    @endcan --}}
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="container">
                                <div class="row">
                                    <div class="col-12 mb-4">
                                        <label for="cover">Cover o portada <span class="text-danger">*</span></label>
                                        <input type="file" name="cover" class="dropify" data-height="300" data-max-file-size="2M"  data-allowed-file-extensions="jpg jpeg png" />
                                        <small>Las medidas recomendadas son 670 x 396 px, solo se aceptan .jpg, .jpeg y .png con un maximo de peso de 2MB.</small>
                                        @if($errors -> has('cover'))
                                            <br>
                                            <small class="text-danger pt-1">{{ $errors -> first('cover') }}</small>
                                        @endif
                                    </div>
                                    <div class="col-12 col-lg-6 mb-4">
                                        <div class="form-group">
                                            <label for="nombre">Nombre del producto <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="nombre" value="{{old('nombre')}}">
                                            @if($errors -> has('nombre'))
                                                <small class="text-danger pt-1">{{ $errors -> first('nombre') }}</small>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-6 mb-4">
                                        <div class="form-group">
                                            <label for="categorias_id">Categoria <span class="text-danger">*</span></label>
                                            <select class="form-control" name="categorias_id">
                                                <option value="">Seleccione una opción</option>
                                                @foreach ($categorias as $item)
                                                    <option {{old('categoria_id') == $item -> id ? 'selected' : ''}} value="{{$item -> id}}">{{$item -> nombre}}</option>
                                                @endforeach
                                            </select>
                                            @if($errors -> has('categorias_id'))
                                                <small class="text-danger pt-1">{{ $errors -> first('categorias_id') }}</small>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-12 mb-4 pb-3">
                                        <label for="establecimiento">Establecimientos <span class="text-danger">*</span></label>
                                        <br>
                                        @foreach ($establecimiento as $key => $item)
                                            <div class="custom-control custom-checkbox custom-control-inline">
                                                <input type="checkbox" class="custom-control-input" id="establecimiento-{{$key}}" name="establecimiento[]" value="{{$item -> id}}">
                                                <label class="custom-control-label" for="establecimiento-{{$key}}">{{$item -> nombre}}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="col-12 mb-4">
                                        <label for="">Descripción</label>
                                        <small class="pb-2 d-block">Recomendamos siempre que al copiar y pegar información desde algun sitio o archivo <b>eliminar el formato</b> de los textos para un optimo funcionamiento, esto se puede realizar desde el mismo editor de texto presionando el siguiente botón <img src="{{asset('panel/img/clear-format.png')}}" alt="Clear format"></small>
                                        <textarea name="descripcion" class="trumbowyg-panel" cols="30" rows="10"></textarea>
                                    </div>
                                    <div class="col-12">
                                        <label for="">Información extra</label>
                                        <small class="pb-2 d-block">Recomendamos siempre que al copiar y pegar información desde algun sitio o archivo <b>eliminar el formato</b> de los textos para un optimo funcionamiento, esto se puede realizar desde el mismo editor de texto presionando el siguiente botón <img src="{{asset('panel/img/clear-format.png')}}" alt="Clear format"></small>
                                        <textarea name="descripcion_extra" class="trumbowyg-panel" cols="30" rows="10"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-center">
                            <button type="submit" class="btn btn-primary pt-2 pb-2"><i class="fas fa-save mr-2"></i> Guardar</button>
                            {{-- @can(PermissionKey::Portafolio['permissions']['create']['name'])
                            @endcan --}}
                        </div>
                    </div>
                </form>
			</div>
        </div>
    </div>
@endsection

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>    <link rel="stylesheet" href="/path/to/select2.css">

    <script type="text/javascript">
        $('.dropify').dropify();
        // $('.select-select2').select2({
        //     placeholder: 'Selecciona una opción',
        //     theme: 'bootstrap4'
        // });

        // function limitText(limitField, limitNum) {
        //     if (limitField.value.length > limitNum) {
        //         limitField.value = limitField.value.substring(0, limitNum);
        //     } else {
        //         document.querySelector('.limitText').innerHTML = limitNum - limitField.value.length;
        //     }
        // }
    </script>
@endpush