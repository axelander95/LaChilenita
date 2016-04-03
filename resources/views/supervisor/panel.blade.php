@extends('layouts.app')
@section('title')
Supervisión
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Mis círculos</h3>
                    </div>
                    <div class="panel-body">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            @if ($circles->count() > 0)
                                <div class="list-group">
                                    @foreach($circles as $circle)
                                        <div class="list-group-item">
                                            <div class="input-group">
                                                <label>{{ $circle->name }}</label>
                                                <span class="input-group-btn">
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <span class="glyphicon glyphicon-tasks" aria-hidden="true"></span> <span class="caret"></span>
                                                        </button>
                                                        <ul class="dropdown-menu">
                                                            <li><a href="#">Ver en el mapa</a></li>
                                                            <li><a href="{{ url('/supervisor/visits/' . $circle->id) }}">Ver visitas</a></li>
                                                            <li><a href="#">Ver reportes</a></li>
                                                        </ul>
                                                    </div>
                                                </span>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else 
                                <label class="label label-info">
                                    ¡No tienes círculos que administrar!
                                </label>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection