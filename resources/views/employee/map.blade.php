@extends('layouts.app')
@section('title')
Mapa
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Círculo</h3>
                    </div>
                    <div class="panel-body">
                        <div id="map" class="big-map"></div>
                                <script>
                                    var map;
                                    var position = {lat: -2.152381, lng: -80.1199965};
                                    var markers = [];
                                    function initMap() {
                                        map = new google.maps.Map(document.getElementById('map'), {
                                            center: position,
                                            zoom: 10
                                        });
                                        @if ($visits->count() > 0)
                                            @foreach ($visits as $visit)
                                                var content = 
                                                '<div class="info">'
                                                    + 'Lugar: {{ $visit->customer->name }}'
                                                +'</div>';
                                                addMarker('{{ $visit->customer->latitude }}', '{{ $visit->customer->longitude }}', 
                                                '{{ $visit->customer->name }}', content);
                                            @endforeach
                                        @endif
                                    }
                                    function addMarker(lat, lng, title, content) {
                                        var position = new google.maps.LatLng(
                                                lat , lng);
                                        var marker = new google.maps.Marker({
                                                map : map,
                                                position : position,
                                                title : title
                                            });
                                            marker.addListener('click', function() {
                                                var infoWindow = new google.maps.InfoWindow({
                                                    content : content
                                                });
                                                infoWindow.open(map, marker);
                                            });
                                            markers.push(marker);
                                    }
                                </script>
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