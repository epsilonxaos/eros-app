@extends('layouts.panel.app')

@section('content')
    <!-- Header -->
    @include('includes.panel.header')

    <!-- Page content -->
    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col">
                <form action="{{route('panel.website.catalogo.update', ["id" => $data -> id])}}" method="POST" enctype="multipart/form-data" class="form-submit-alert-wait">
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col-12 col-sm-6"><h3>Informacion general</h3></div>
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
                                    <div class="col-12 col-md-5 mb-4">
                                        <label for="pdf">Catalogo - PDF</label>
                                        <input type="file" name="pdf" class="dropify" data-height="300" data-max-file-size="2M"  data-allowed-file-extensions="pdf" required/>
                                        <small>Solo se aceptan .pdf con un maximo de peso de 8MB.</small>
                                    </div>
                                    <div class="col-12 col-md-7 mb-4">
                                        <iframe src="{{asset($data -> catagoloPDF)}}" width="100%" height="500" frameborder="0"></iframe>
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
