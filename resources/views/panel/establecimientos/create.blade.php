@extends('layouts.panel.app')

@section('content')
    <!-- Header -->
    @include('includes.panel.header')

    <!-- Page content -->
    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col">
                <form action="{{route('panel.eros.establecimientos.store')}}" method="POST" enctype="multipart/form-data" class="form-submit-alert-wait">
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
                                    <div class="col-12 mb-4">
                                        <div class="form-group">
                                            <label for="nombre">Nombre del establecimiento <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="nombre" value="{{old('nombre')}}">
                                            @if($errors -> has('nombre'))
                                                <small class="text-danger pt-1">{{ $errors -> first('nombre') }}</small>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6 mb-4">
                                        <div class="form-group">
                                            <label for="telefono"> Teléfono</label>
                                            <input type="number" class="form-control" name="telefono" id="telefono" value="{{old('telefono')}}">
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6 mb-4">
                                        <div class="form-group">
                                            <label for="email"> Correo electrónico</label>
                                            <input type="email" class="form-control" name="email" id="email" value="{{old('email')}}">
                                        </div>
                                    </div>
                                    <hr class="col-12">
                                    <div class="col-12 mb-4">
                                        <h3>Redes sociales</h3>
                                    </div>
                                    <div class="col-12 col-sm-6 mb-4">
                                        <div class="form-group">
                                            <label for="facebook"> Facebook</label>
                                            <input type="facebook" class="form-control" name="facebook" id="facebook" value="{{old('facebook')}}">
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6 mb-4">
                                        <div class="form-group">
                                            <label for="instagram"> Instagram</label>
                                            <input type="instagram" class="form-control" name="instagram" id="instagram" value="{{old('instagram')}}">
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6 mb-4">
                                        <div class="form-group">
                                            <label for="twitter"> Twitter</label>
                                            <input type="twitter" class="form-control" name="twitter" id="twitter" value="{{old('twitter')}}">
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6 mb-4">
                                        <div class="form-group">
                                            <label for="whatsapp"> Whatsapp</label>
                                            <input type="whatsapp" class="form-control" name="whatsapp" id="whatsapp" value="{{old('whatsapp')}}">
                                        </div>
                                    </div>
                                    <hr class="col-12">
                                    <div class="col-12">
                                        <h3 class="mb-4">Ubicacion del establecimiento</h3>
                                        <p class="small">Si no cuenta con conocimientos para obtener la latitud y la longitud mediante Maps, puede usar nuestra mapa integrado que se encuentra en la parte de abajo, para obtener las coordenadas de manera automatica haga clic derecho sobre la ubicación.</p>
                                    </div>
                                    <div class="col-12 col-sm-6 mb-4">
                                        <div class="form-group">
                                            <label for="lat"> Latitud</label>
                                            <input type="text" class="form-control" name="lat" id="lat" value="{{old('lat')}}">
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6 mb-4">
                                        <div class="form-group">
                                            <label for="lng"> Longitud</label>
                                            <input type="text" class="form-control" name="lng" id="lng" value="{{old('lng')}}">
                                        </div>
                                    </div>
                                    <div class="col-12 position-relative">
                                        <p></p>
                                        <div id="map" style="height: 400px"></div>
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
    <link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet/v1.0.0-rc.1/leaflet.css">
    <script src="http://cdn.leafletjs.com/leaflet/v1.0.0-rc.1/leaflet.js"></script>

    <script>

        var map = L.map("map").setView([20.971145, -89.622943], 12);

        L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        var market;

        map.on("contextmenu", function (event) {
            console.log("user right-clicked on map coordinates: " + event.latlng.toString());
            if(market) map.removeLayer(market);
            market = L.marker(event.latlng).addTo(map);

            document.getElementById('lat').value = event.latlng.lat;
            document.getElementById('lng').value = event.latlng.lng;
            console.log(event.latlng.lat, event.latlng.lng);
        });
    </script>
    <script type="text/javascript">
        $('.dropify').dropify();
    </script>
@endpush
