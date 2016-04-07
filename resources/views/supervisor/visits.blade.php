@extends('layouts.app')
@section('title')
Visitas
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">{{ $name }} | Visitas pendientes y 
                            en proceso
                        </h3>
                    </div>
                    <div class="panel-body">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <a class="btn btn-default" 
                            href="{{ url('/supervisor/visits/'. $id . '/create') }}">Nueva visita</a>
                            <br/>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            @if ($visits->count() > 0)
                            <div class="table-responsive">
                                <table class="table">
                                    <th>Cliente</th>
                                    <th>Usuario designado</th>
                                    <th>Fecha de programación</th>
                                    <th>Hora de programación</th>
                                    <th>Detalle</th>
                                    <th>Estado</th>
                                    @foreach ($visits as $visit)
                                        <tr class="{{ ($visit->visit_status->id == 1)?'warning':'success' }}">
                                            <td><a href="{{ url('/supervisor/visits/' . $visit->id . '/edit') }}">{{ $visit->customer->name }}</a></td>
                                            <td>{{ $visit->user->name . ' (' . $visit->user->username . ')' }}</td>
                                            <td>{{ $visit->programmed_date }}</td>
                                            <td>{{ $visit->programmed_time }}</td>
                                            <td>{{ $visit->detail }}</td>
                                            <td>{{ $visit->visit_status->description }}</td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                            @else
                                <label class="label label-info">No se encontró visitas.</label>
                            @endif
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection