@extends('layouts.admin')
@section('title')
{{ $title }}
@endsection
@section('section-title')
{{ $title }}
@endsection
@section('admin-content')
    <form method="POST" action="{{ isset($action)?$action:url('/admin/circles') }}">
    @if (isset($method))
        <input name="_method" type="hidden" value="PUT">
    @endif
        <div class="form-group">
            <label>Nombre del círculo (Requerido)</label>
            <input type="text" name="name" class="form-control" required="required" 
            value="{{ isset($circle)?$circle->name:'' }}"/>
        </div>
        <div class="form-group">
            <label>Usuario supervisor (Requerido)</label>
            <select class="form-control" name="user" required="required">
                @foreach($users as $user)
                    <option {{ isset($circle)?(($circle->user_id == $user->id)?'selected':''):'' }} 
                        value="{{ $user->id }}">{{ $user->username . ' (' . $user->name . ')' }}</option>
                @endforeach
            </select>
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
            <a href="{{ url('/admin/circles') }}" class="btn btn-danger">Cancelar</a>
        </div>
    </form>
@endsection