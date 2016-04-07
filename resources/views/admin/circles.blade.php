@extends('layouts.admin-list')
@section('table')
    @if(count($circles) > 0)
        <div class="table-responsive">
            <table class="table">
                <tr>
                    <th>Nombre</th>
                    <th>Nombre de supervisor</th>
                    <th>Nombre de usuario del supervisor</th>
                </tr>
            @foreach ($circles as $circle)
                <tr>
                    <td><a href="{{ url('/admin/' . $module .'/' . $circle->id . '/edit/') }}">{{ $circle->name }}</a></td>
                    <td>{{ $circle->user->name }}</td>
                    <td>{{ $circle->user->username }}</td>
                </tr>
            @endforeach
            </table>
        </div>
    @else 
        <label class="label label-info">¡No se encontró resultados!</label>
    @endif
@endsection