@extends('layouts.admin-form')
@section('title')
{{ isset($data)?'Modificar usuario' : 'Nuevo usuario' }}
@endsection
@section('form')
        <div class="form-group">
            <label>Nombre(s) y apellido(s) (Requerido)</label>
            <input type="text" name="name" class="form-control" required="required" 
            value="{{ isset($data)?$data->name:'' }}"/>
        </div>
        <div class="form-group">
            <label>Correo electrónico (Requerido)</label>
            <input type="email" name="email" class="form-control" required="required"
            value="{{ isset($data)?$data->email:'' }}"/>
        </div>
        <div class="form-group">
            <label>Nombre de usuario (Requerido)</label>
            <input type="text" name="username" class="form-control" required="required" {{ isset($user)?'disabled':'' }}
            value="{{ isset($data)?$data->username:'' }}"/>
        </div>
        <div class="form-group">
            <label>Rol de usuario (Requerido)</label>
            <select class="form-control" name="role">
                @foreach($roles as $rol)
                    <option {{ isset($data)?(($data->role_id == $rol->id)?'selected':''):'' }} value="{{ $rol->id }}">{{ $rol->description }}</option>
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
@endsection