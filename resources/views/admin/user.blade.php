@extends('layouts.admin')
@section('title')
{{ $title }}
@endsection
@section('section-title')
{{ $title }}
@endsection
@section('admin-content')
    <form method="POST" action="{{ isset($action)?$action:url('/admin/users') }}">
    @if (isset($method))
        <input name="_method" type="hidden" value="PUT">
    @endif
        <div class="form-group">
            <label>Nombre(s) y apellido(s) (Requerido)</label>
            <input type="text" name="name" class="form-control" required="required" 
            value="{{ isset($user)?$user->name:'' }}"/>
        </div>
        <div class="form-group">
            <label>Correo electrónico (Requerido)</label>
            <input type="email" name="email" class="form-control" required="required"
            value="{{ isset($user)?$user->email:'' }}"/>
        </div>
        <div class="form-group">
            <label>Nombre de usuario (Requerido)</label>
            <input type="text" name="username" class="form-control" required="required" {{ isset($user)?'disabled':'' }}
            value="{{ isset($user)?$user->username:'' }}"/>
        </div>
        <div class="form-group">
            <label>Rol de usuario (Requerido)</label>
            <select class="form-control" name="role">
                @foreach($roles as $rol)
                    <option {{ isset($user)?(($user->role_id == $rol->id)?'selected':''):'' }} value="{{ $rol->id }}">{{ $rol->description }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>Contraseña (Requerido)</label>
            <input type="password" name="password" class="form-control" required="required"/>
        </div>
        <div class="form-group">
            <label>Confirmación de contraseña (Requerido)</label>
            <input type="password" name="password_confirmation" class="form-control" required="required"/>
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
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
        @if (isset($message))
            <div class="form-group">
                <label class="label label-info">{{ $message }}</label>
            </div>
        @endif
        <div class="form-group">
            <input type="submit" value="Guardar" class="btn btn-primary" />
            <a href="{{ url('/admin/users') }}" class="btn btn-danger">Cancelar</a>
        </div>
    </form>
@endsection