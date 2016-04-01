@extends('layouts.app')
@section('title')
Instalación
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Instalación</div>
                    <div class="panel-body">
                        <p>¡Debes crear un Súper Administrador!</p>
                        <form method="POST" action="{{ url('/install') }}">
                            <div class="form-group">
                                <label>Nombre(s) y apellido(s)</label>
                                <input type="text" name="name" class="form-control"/>
                            </div>
                            <div class="form-group">
                                <label>Dirección de correo electrónico</label>
                                <input type="email" name="email" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label>Nombre de usuario</label>
                                <input type="text" name="username" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label>Contraseña (Debe tener mínimo 6 caracteres)</label>
                                <input type="password" name="password" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label>Repetir contraseña</label>
                                <input type="password" name="password_confirmation" class="form-control" />
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
                            <div class="form-group">
                                <input type="submit" class="btn btn-primary" value="Registrar" />
                            </div>
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        </form>
                    </div>
                    <div class="panel-footer">
                        <p>No te preocupes, esto sólo sucede cuando no hay usuarios 
                        registrados.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection