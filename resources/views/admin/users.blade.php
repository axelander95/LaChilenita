@extends('layouts.admin-list')
@section('title')
Usuarios
@endsection
@section('table')
    @if(count($users) > 0)
        <div class="table-responsive">
            <table class="table">
                <tr>
                    <th>Nombre</th>
                    <th>Nombre de usuario</th>
                    <th>Correo electrónico</th>
                    <th>Rol</th>
                </tr>
            @foreach ($users as $user)
                <tr>
                    <td><a href="{{ url('/admin/' . $module . '/' . $user->id . '/edit/') }}">{{ $user->name }}</a></td>
                    <td>{{ $user->username }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->role->description }}</td>
                </tr>
            @endforeach
            </table>
        </div>
    @else 
        <label class="label label-info">¡No se encontró resultados!</label>
    @endif
@endsection