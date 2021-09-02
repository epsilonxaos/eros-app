@extends('layouts.panel.app')

@push('link')
    <style>
        .bg {
            width: 100px;
            height: 60px;
            background-position: center center;
            background-repeat: no-repeat;
            background-size: auto;
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
									<th scope="col" class="sort" data-sort="titulo">Titulo</th>
									<th scope="col" class="no-sort text-center" width="200px">Acciones</th>
								</tr>
							</thead>
							<tbody class="list">
								@if ((isset($lista)) && (count($lista) > 0))
                                    @foreach ($lista as $num => $row)
                                        <tr>
                                            <td>
                                                <a href="javascript:;" onclick="mdEdit({{$num}})">{{$row -> titulo}}</a>
                                                {{-- @can(PermissionKey::Noticias['permissions']['edit']['name'])
                                                @elsecan(PermissionKey::Noticias['permissions']['index']['name'])
                                                    {{$row -> titulo}}
                                                @endcan --}}
                                            </td>
                                            <td class="text-center" width="200px">
                                                <button onclick="mdEdit({{$num}})" class="btn btn-info btn-sm"><i class="fas fa-edit mr-2"></i> Editar</button>
                                                {{-- @can(PermissionKey::Noticias['permissions']['edit']['name'])
                                                @endcan --}}
                                                <form action="{{route('panel.faqs.destroy', ['id' => $row -> id])}}" method="post" class="d-inline delete-form-{{$row -> id}}">
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
                <form action="{{route('panel.faqs.store')}}" method="post" enctype="multipart/form-data" class="form-submit-alert-wait">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Agregar nueva pregunta</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body pt-0">
                        <div class="row">
                            <div class="col-12 mb-4">
                                <label for="titulo">Titulo <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="titulo" required />
                            </div>
                            <div class="col-12 mb-4">
                                <label for="informacion">Información <span class="text-danger">*</span></label>
                                <textarea name="informacion" id="informacion" class="form-control" required cols="30" rows="10"></textarea>
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
                <form action="{{route('panel.faqs.update')}}" method="post" enctype="multipart/form-data" class="form-submit-alert-wait">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Editar amenidad</h5>
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
                            <div class="col-12 mb-4">
                                <label for="informacion">Información <span class="text-danger">*</span></label>
                                <textarea name="informacion" id="informacionE" class="form-control" required cols="30" rows="10"></textarea>
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
    <script>
        const all = @json($lista);

        function mdEdit(idx) {
            let index = all[idx];

            document.getElementById('idx').value = index['id'];
            document.getElementById('tituloE').value = '';
            document.getElementById('informacionE').value = '';

            document.getElementById('tituloE').value = index['titulo'];
            document.getElementById('informacionE').value = index['informacion'];

            $('#mdEdit').modal('show');
        }
    </script>
@endpush
