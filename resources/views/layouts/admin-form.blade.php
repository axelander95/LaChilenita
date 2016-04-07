@extends('layouts.admin')
@section('admin-content')
    @if (isset($data))
        <div class="col-lg-12 col-md-12 col-sm-12 text-right">
            <form method="POST" action="{{ url('/admin/' . $module . '/' .  $data->id) }}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="_method" value="delete" />
                <input type="submit" class="btn btn-default" value="Eliminar" />
            </form>
        </div>
    @endif
    <form name="circle" method="POST" action="{{ url('admin/' . $module . '/' . ((isset($data)?$data->id:'')) )}}">
    @if (isset($data))
        <input name="_method" type="hidden" value="PUT">
    @endif
        @yield('form')
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="form-group">
            <input type="submit" value="Guardar" class="btn btn-default" />
            <a href="{{ url('/admin/' . $module) }}" class="btn btn-default">Cancelar</a>
        </div>
    </form>
@endsection