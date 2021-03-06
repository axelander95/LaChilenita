@extends('layouts.admin-form')
@section('title')
{{ isset($data)?'Modificar cliente' : 'Nuevo cliente' }}
@endsection
@section('form')
        <div class="form-group">
            <label>Nombre del cliente (Requerido)</label>
            <input type="text" name="name" class="form-control" required="required" 
            value="{{ isset($data)?$data->name:'' }}"/>
        </div>
        <div class="form-group">
            <label>Identificación</label>
            <input type="text" name="identification" class="form-control" required="required" 
            value="{{ isset($data)?$data->identification:'' }}"/>
        </div>
        <div class="form-group">
            <label>Dirección</label>
                    <div class="input-group">
                        <input id="address" name="address" type="text" class="form-control"
                        value="{{ isset($data)?$data->address:'' }}">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="button" onclick="locate();">Buscar en el mapa</button>
                        </span>
                    </div>
        </div>
        <div class="form-group">
             <label>Latitud</label>
             <input type="text" name="latitude" id="latitude" class="form-control" required="required" readonly="readonly"
             value="{{ isset($data)?$data->latitude:'' }} "/>
        </div>
        <div class="form-group">
            <label>Longitud</label>
            <input type="text" name="longitude" id="longitude" class="form-control" required="required" 
            readonly="readonly" value="{{ isset($data)?$data->longitude:'' }}"/>
        </div>
        <div class="form-group">
            <div id="map"></div>
            <script>
                var map;
                var geocoder;
                var marker;
                var position = {lat: -2.152381, lng: -80.1199965};
                function initMap() {
                    map = new google.maps.Map(document.getElementById('map'), {
                        center: position,
                        zoom: 18
                    });
                    marker = new google.maps.Marker(
                        {
                            map : map
                        }
                    );
                    geocoder = new google.maps.Geocoder();
                    @if (isset($data))
                        locate();
                    @endif
                }
                function locate() {
                    var address = document.getElementById('address').value;
                    marker.setMap(null);
                    geocoder.geocode( { 'address' : address,
                    componentRestrictions: {
                        country: 'EC'
                    }}, function(results, status) {
                            if (status == google.maps.GeocoderStatus.OK) {
                                map.setCenter(results[0].geometry.location);
                                marker = new google.maps.Marker({
                                    map: map,
                                    position: results[0].geometry.location
                                });
                                document.getElementById('latitude').value = marker.getPosition().lat();
                                document.getElementById('longitude').value = marker.getPosition().lng();
                            } else {
                                alert("Geocode was not successful for the following reason: " + status);
                                document.getElementById('latitude').value = '';
                                document.getElementById('longitude').value = '';
                            }
                        });
                }
            </script>
        </div>
        <div class="form-group">
            <label>Referencia de la ubicación</label>
            <textarea name="reference"
                class="form-control">{{ isset($data)?$data->reference:'' }}</textarea>
        </div>
                        @if (count($errors) > 0)
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
@endsection
@section('scripts')
    <script async defer
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBuFT2mdjBZ3eUOm0YNLaVZO6pQaPyJlOs&callback=initMap">
    </script>
@endsection