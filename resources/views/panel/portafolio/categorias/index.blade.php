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
                                <h3 class="mb-0 mr-4">Listado de categorias</h3>
                            </div>
                            <div class="col-12 col-sm-6 text-center text-sm-right">
                                @can(PermissionKey::Portafolio['permissions']['create']['name'])
                                    <button class="btn btn-success pt-2 pb-2" data-toggle="modal" data-target="#mdAdd"><i class="fas fa-plus mr-2"></i> Agregar</button>
                                @endcan
                            </div>
                        </div>
					</div>
                    <!-- Light table -->
					<div class="table-responsive pb-3">
						<table class="table align-items-center table-flush" id="dataTable">
							<thead class="thead-light">
								<tr>
									<th scope="col" class="sort" data-sort="titulo">Categorias</th>
									<th scope="col" class="no-sort text-center" width="200px">Acciones</th>
								</tr>
							</thead>
							<tbody class="list">
								@if ((isset($lista)) && (count($lista) > 0))
                                    @foreach ($lista as $num => $row)
                                        <tr>
                                            <td>
                                                @can(PermissionKey::Portafolio['permissions']['edit']['name'])
                                                    <a href="#" onclick="mdEdit({{$num}})">{{$row -> titulo}}</a>
                                                @elsecan(PermissionKey::Portafolio['permissions']['index']['name'])
                                                    {{$row -> titulo}}
                                                @endcan
                                            </td>
                                            <td class="text-center" width="200px">
                                                @can(PermissionKey::Portafolio['permissions']['edit']['name'])
                                                    <button onclick="mdEdit({{$num}})" class="btn btn-info btn-sm"><i class="fas fa-edit mr-2"></i> Editar</button>
                                                @endcan
                                                @can(PermissionKey::Portafolio['permissions']['destroy']['name'])
                                                    <form action="{{route('panel.portafolio.categorias.destroy', ['id' => $row -> id])}}" method="post" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></a>
                                                    </form>
                                                @endcan
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
                <form action="{{route('panel.portafolio.categorias.store')}}" method="post" enctype="multipart/form-data" class="form-submit-alert-wait">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title">Agregar nueva categoria</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body pt-0">
                        <div class="row">
                            <div class="col-12 mb-4">
                                <label for="titulo">Titulo <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="titulo" required />
                                @if($errors -> has('titulo'))
                                    <small class="text-danger pt-1">{{ $errors -> first('titulo') }}</small>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                        @can(PermissionKey::Portafolio['permissions']['create']['name'])
                            <button type="submit" class="btn btn-default"><i class="fas fa-save mr-2"></i> Guardar</button>
                        @endcan
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Editar --}}
    <div class="modal" tabindex="-1" role="dialog" id="mdEdit">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form action="{{route('panel.portafolio.categorias.update')}}" method="post" enctype="multipart/form-data" class="form-submit-alert-wait">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Editar categoria</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body pt-0">
                        <input type="hidden" name="id" id="idx" required>
                        <div class="row">
                            <div class="col-12 mb-4">
                                <label for="titulo">Titulo <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="titulo" id="tituloE" required />
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                        @can(PermissionKey::Portafolio['permissions']['update']['name'])
                            <button type="submit" class="btn btn-default"><i class="fas fa-save mr-2"></i> Guardar</button>
                        @endcan
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection


@push('js')
    @if($errors -> has('titulo'))
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

            // let contenedor = document.querySelector('.inputE');
            //     if(contenedor.querySelector('.dropify-wrapper')){
            //         contenedor.querySelector('.dropify-wrapper').remove();
            //     }

            // let input = document.createElement('input');
            //     input.classList.add('dropifyE');
            //     input.type = 'file';
            //     input.name = 'portada';
            //     input.setAttribute('data-height', '250');
            //     input.setAttribute('data-allowed-file-extensions', 'png jpg jpeg');
            //     input.setAttribute('data-max-file-size', '2M');
            //     input.setAttribute('data-default-file', PATH + index['portada']);

            // contenedor.appendChild(input);

            document.getElementById('tituloE').value = index['titulo'];

            $('.dropifyE').dropify();
            $('#mdEdit').modal('show');
        }
    </script>
@endpush