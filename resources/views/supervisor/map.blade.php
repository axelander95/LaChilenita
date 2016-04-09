@extends('layouts.app')
@section('title')
Mapa
@endsection
@section('styles')
    #map {
        height: 250px;
    }
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Mapa de usuarios | {{ $circle->name }}</h3>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="btn-toolbar" role="toolbar" aria-label="...">
                                    <div class="btn-group" role="group" aria-label="...">
                                        <button class="btn btn-default" type="button">
                                            <span class="glyphicon glyphicon-refresh" aria-hidden="true">
                                                </span> Actualizar</button>
                                        <button class="btn btn-default" type="button">
                                            <span class="glyphicon glyphicon-play" aria-hidden="true">
                                                </span> Seguimiento</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div id="map" class="big-map"></div>
                                <script>
                                    var map;
                                    var position = {lat: -2.152381, lng: -80.1199965};
                                    function initMap() {
                                        map = new google.maps.Map(document.getElementById('map'), {
                                            center: position,
                                            zoom: 10
                                        });
                                    }
                                </script>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-md-1 col-sm-12 text-justify">
                                <h2>Indicaciones generales</h2>
                                <p>Este mapa muestra las visitas en proceso, para activar el seguimiento 
                                    por geolocalización, se debe dar clic al botón de 'Seguimiento' y, para 
                                    desactivarlo, se debe volver dar clic nuevamente a dicho botón.
                                    El mapa puede ser actualizado como se desee al momento de dar clic en el 
                                    botón de actualización. Para ver más detalles del empleado, se debe dar 
                                    clic en el marcador que le corresponda.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script async defer
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBuFT2mdjBZ3eUOm0YNLaVZO6pQaPyJlOs&callback=initMap">
    </script>
@endsection