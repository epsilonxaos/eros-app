@extends('layouts.panel.app')

@push('link')
    <style>
        .bg {
            width: 170px;
            height: 100px;
            background-position: center center;
            background-repeat: no-repeat;
            background-size: cover;
        }
    </style>
@endpush

@section('content')
    <!-- Header -->
    @include('includes.panel.header')

    <!-- Page content -->
    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col">
				<div class="card">
				<!-- Card header -->
					<div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-12 col-sm-6">
                                <h3 class="mb-0 mr-4">Listado de registros</h3>
                            </div>
                            <div class="col-12 col-sm-6 text-center text-sm-right">
                                <button class="btn btn-success pt-2 pb-2" data-toggle="modal" data-target="#mdAdd"><i class="fas fa-plus mr-2"></i> Agregar</button>
                                {{-- @can(PermissionKey::Noticias['permissions']['create']['name'])
                                @endcan --}}
                            </div>
                        </div>
					</div>
                    <!-- Light table -->
					<div class="table-responsive pb-3">
						<table class="table align-items-center table-flush" id="dataTable">
							<thead class="thead-light">
								<tr>
									<th scope="col" class="sort" data-sort="cover">Cover</th>
									<th scope="col" class="sort" data-sort="titulo">Categorias</th>
									<th scope="col" class="no-sort text-center" width="200px">Acciones</th>
								</tr>
							</thead>
							<tbody class="list">
								@if ((isset($lista)) && (count($lista) > 0))
                                    @foreach ($lista as $num => $row)
                                        <tr>
                                            <td style="width: 200px">
                                                <div class="bg" style="background-image: url({{asset($row -> cover)}})"> </div>
                                            </td>
                                            <td>
                                                <a href="javascript:;" onclick="mdEdit({{$num}})">{{$row -> nombre}}</a>
                                                {{-- @can(PermissionKey::Noticias['permissions']['edit']['name'])
                                                @elsecan(PermissionKey::Noticias['permissions']['index']['name'])
                                                    {{$row -> titulo}}
                                                @endcan --}}
                                            </td>
                                            <td class="text-center" width="200px">
                                                <button onclick="mdEdit({{$num}})" class="btn btn-info btn-sm"><i class="fas fa-edit mr-2"></i> Editar</button>
                                                {{-- @can(PermissionKey::Noticias['permissions']['edit']['name'])
                                                @endcan --}}
                                                <form action="{{route('panel.eros.categorias.destroy', ['id' => $row -> id])}}" method="post"  class="d-inline delete-form-{{$row -> id}}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></a>
                                                </form>
                                                {{-- @can(PermissionKey::Noticias['permissions']['destroy']['name'])
                                                @endcan --}}
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
							</tbody>
						</table>
					</div>
				</div>
			</div>
        </div>
    </div>

    {{-- Agregar --}}
    <div class="modal" tabindex="-1" role="dialog" id="mdAdd">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form action="{{route('panel.eros.categorias.store')}}" method="post" enctype="multipart/form-data" class="form-submit-alert-wait">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title">Agregar nueva categoria</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body pt-0">
                        <p>Haga clic en el cuadro para subir una imagen desde el ordenador o si lo prefiere puede arrastrar y soltar en el cuadro de portada:</p>
                        <div class="row">
                            <div class="col-12 mb-4">
                                <label for="cover">Cover o portada <span class="text-danger">*</span></label>
                                <input type="file" name="cover" class="dropify" data-height="300" required data-max-file-size="2M"  data-allowed-file-extensions="jpg jpeg png" />
                                <small>Las medidas recomendadas son 670 x 396 px, solo se aceptan .jpg, .jpeg y .png con un maximo de peso de 2MB.</small>
                                @if($errors -> has('cover'))
                                    <br>
                                    <small class="text-danger pt-1">{{ $errors -> first('cover') }}</small>
                                @endif
                            </div>
                            <div class="col-12 mb-4">
                                <label for="nombre">Titulo <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="nombre" required />
                                @if($errors -> has('nombre'))
                                    <small class="text-danger pt-1">{{ $errors -> first('nombre') }}</small>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-default"><i class="fas fa-save mr-2"></i> Guardar</button>
                        {{-- @can(PermissionKey::Noticias['permissions']['create']['name'])
                        @endcan --}}
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Editar --}}
    <div class="modal" tabindex="-1" role="dialog" id="mdEdit">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form action="{{route('panel.eros.categorias.update')}}" method="post" enctype="multipart/form-data" class="form-submit-alert-wait">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Editar categoria</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body pt-0">
                        <input type="hidden" name="id" id="idx" required>
                        <p>Haga clic en el cuadro para subir la nueva imagen para reemplazar desde el ordenador o si lo prefiere puede arrastrar y soltar en el cuadro de portada:</p>
                        <div class="row">
                            <div class="col-12 mb-4">
                                <label for="portada">Portada</label>
                                <div class="inputE">

                                </div>
                                <small>Medidas recomendadas: 800px x 800px</small>
                            </div>
                            <div class="col-12 mb-4">
                                <label for="nombre">Titulo <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="nombre" id="tituloE" requied />
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-default"><i class="fas fa-save mr-2"></i> Guardar</button>
                        {{-- @can(PermissionKey::Noticias['permissions']['update']['name'])
                        @endcan --}}
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection


@push('js')
    @if($errors -> has('nombre'))
        <script>
            $('#mdAdd').modal('show');
        </script>
    @endif
    <script>
        const all = @json($lista);
        $('.dropify').dropify();

        function mdEdit(idx) {
            let index = all[idx];

            document.getElementById('idx').value = index['id'];
            document.getElementById('tituloE').value = '';

            let contenedor = document.querySelector('.inputE');
                if(contenedor.querySelector('.dropify-wrapper')){
                    contenedor.querySelector('.dropify-wrapper').remove();
                }

            let input = document.createElement('input');
                input.classList.add('dropifyE');
                input.type = 'file';
                input.name = 'cover';
                input.setAttribute('data-height', '250');
                input.setAttribute('data-allowed-file-extensions', 'png jpg jpeg');
                input.setAttribute('data-max-file-size', '2M');
                input.setAttribute('data-default-file', PATH + index['cover']);

            contenedor.appendChild(input);

            document.getElementById('tituloE').value = index['nombre'];

            $('.dropifyE').dropify();
            $('#mdEdit').modal('show');
        }
    </script>
@endpush
