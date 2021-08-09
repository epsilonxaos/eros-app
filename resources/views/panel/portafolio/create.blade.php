@extends('layouts.panel.app')

@section('content')
    <!-- Header -->
    @include('includes.panel.header')

    <!-- Page content -->
    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col">
                <form action="{{route('panel.portafolio.store')}}" method="POST" enctype="multipart/form-data" class="form-submit-alert-wait">
                    @csrf
                    @method('PUT')
                    <div class="card">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col-12 col-sm-6"><h3>Agregar nuevo portafolio</h3></div>
                                <div class="col-12 col-sm-6 text-center text-sm-right">
                                    @can(PermissionKey::Portafolio['permissions']['create']['name'])
                                        <button type="submit" class="btn btn-primary pt-2 pb-2"><i class="fas fa-save mr-2"></i> Guardar</button>
                                    @endcan
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="container">
                                <div class="row">
                                    <div class="col-12 col-lg-6 mb-4">
                                        <label for="portada">Portada <span class="text-danger">*</span></label>
                                        <input type="file" name="portada" class="dropify" data-height="300" data-max-file-size="2M"  data-allowed-file-extensions="jpg jpeg png" />
                                        <small>Las medidas recomendadas son 670 x 396 px, solo se aceptan .jpg, .jpeg y .png con un maximo de peso de 2MB.</small>
                                        @if($errors -> has('portada'))
                                            <br>
                                            <small class="text-danger pt-1">{{ $errors -> first('portada') }}</small>
                                        @endif
                                    </div>
                                    <div class="col-12 col-lg-6 mb-4">
                                        <label for="cover">Cover <span class="text-danger">*</span></label>
                                        <input type="file" name="cover" class="dropify" data-height="300" data-max-file-size="2M"  data-allowed-file-extensions="jpg jpeg png" />
                                        <small>Las medidas recomendadas son 1500 x 750 px, solo se aceptan .jpg, .jpeg y .png con un maximo de peso de 2MB.</small>
                                        @if($errors -> has('cover'))
                                            <br>
                                            <small class="text-danger pt-1">{{ $errors -> first('cover') }}</small>
                                        @endif
                                    </div>
                                    <div class="col-12 col-sm-6 mb-4">
                                        <div class="form-group">
                                            <label for="titulo">Titulo <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="titulo" value="{{old('titulo')}}">
                                            @if($errors -> has('titulo'))
                                                <small class="text-danger pt-1">{{ $errors -> first('titulo') }}</small>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6 mb-4">
                                        <div class="form-group">
                                            <label for="id_categoria">Categoria <span class="text-danger">*</span></label>
                                            <select class="form-control" name="id_categoria">
                                                <option value="">Seleccione una opción</option>
                                                @foreach ($categorias as $item)
                                                    <option {{old('id_categoria') == $item -> id ? 'selected' : ''}} value="{{$item -> id}}">{{$item -> titulo}}</option>
                                                @endforeach
                                            </select>
                                            @if($errors -> has('id_categoria'))
                                                <small class="text-danger pt-1">{{ $errors -> first('id_categoria') }}</small>
                                            @endif
                                        </div>
                                    </div>
                                    {{-- <div class="col-12 mb-4">
                                        <div class="form-group">
                                            <label for="descripcion_corta">Descripción corta</label>
                                            <textarea class="form-control" name="descripcion_corta" rows="6" style="resize: none" onKeyDown="limitText(this.form.descripcion_corta, 150);" onKeyUp="limitText(this.form.descripcion_corta, 150);" maxlength="150"></textarea>
                                            <small>Caracteres disponibles: <span class="limitText text-primary font-weight-bold">150</span></small>
                                        </div>
                                    </div> --}}
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <label for="">Descripción</label>
                                        <small class="pb-2 d-block">Recomendamos siempre que al copiar y pegar información desde algun sitio o archivo <b>eliminar el formato</b> de los textos para un optimo funcionamiento, esto se puede realizar desde el mismo editor de texto presionando el siguiente botón <img src="{{asset('panel/img/clear-format.png')}}" alt="Clear format"></small>
                                        <textarea name="descripcion" class="trumbowyg-panel" cols="30" rows="10">{{old('descripcion')}}</textarea>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-12 mb-4">
                                        <label for="portada">Galeria</label>
                                        <input type="file" name="galeria[]" class="dropify" data-height="300" data-max-file-size="6M"  data-allowed-file-extensions="jpg jpeg png" multiple />
                                        <small>Las medidas recomendadas son 670 x 396 px, solo se aceptan .jpg, .jpeg y .png con un maximo de peso de 2MB.</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-center">
                            @can(PermissionKey::Portafolio['permissions']['create']['name'])
                                <button type="submit" class="btn btn-primary pt-2 pb-2"><i class="fas fa-save mr-2"></i> Guardar</button>
                            @endcan
                        </div>
                    </div>
                </form>
			</div>
        </div>
    </div>
@endsection

@push('js')
    <script type="text/javascript">
        $('.dropify').dropify();

        // function limitText(limitField, limitNum) {
        //     if (limitField.value.length > limitNum) {
        //         limitField.value = limitField.value.substring(0, limitNum);
        //     } else {
        //         document.querySelector('.limitText').innerHTML = limitNum - limitField.value.length;
        //     }
        // }
    </script>
@endpush