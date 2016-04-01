@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                        <ul class="nav">
                            <li><a href="{{ url('/admin') }}">ESCRITORIO</a></li>
                            <li><a href="{{ url('/admin/users') }}">USUARIOS (ADMINISTRADORES, SUPERVISORES y 
                            EMPLEADOS)</a></li>
                            <li><a href="{{ url('/admin/circles') }}">CÍRCULOS</a></li>
                            <li><a href="{{ url('/admin/customers') }}">CLIENTES</a></li>
                        </ul>
            </div>
            <div class="col-lg-8 col-md-6 col-sm-12 col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">@yield('section-title')</h3>
                    </div>
                    <div class="panel-body">
                        @yield('admin-content')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection