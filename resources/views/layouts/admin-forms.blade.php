@extends('layouts.admin')
@section('admin-content')
    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="col-lg-6 col-md-4 col-sm-12">
            <div class="form-group">
                <div class="btn-group" role="group" aria-label="...">
                    <a href="{{ $link }}" class="btn btn-default">Añadir nuevo</a>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-8 col-sm-12">
            <form method="POST" action="{{ url(isset($search)?$search:'/') }}">
                <div class="form-group">
                    <div class="input-group">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input name="search" type="text" class="form-control" placeholder="Escribe tu consulta...">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="submit">Buscar</button>
                        </span>
                    </div>
                </div>
            </form>
         </div>
         <div class="col-lg-12 col-md-12 col-sm-12">
             @yield('table')
         </div>
    </div>
@endsection