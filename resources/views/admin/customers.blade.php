@extends('layouts.admin-forms')
@section('title')
Clientes (Administrador)
@endsection
@section('section-title')
Clientes
@endsection
@section('table')
    @if(count($customers) > 0)
        <div class="table-responsive">
            <table class="table">
                <tr>
                    <th>Nombre</th>
                    <th>N° Identificación</th>
                    <th>Dirección</th>
                    <th>Referencia</th>
                    <th>Latitud</th>
                    <th>Longitud</th>
                </tr>
            @foreach ($customers as $customer)
                <tr>
                    <td><a href="{{ url('/admin/customers/' . $customer->id . '/edit/') }}">{{ $customer->name }}</a></td>
                    <td>{{ $customer->identification }}</td>
                    <td>{{ $customer->address }}</td>
                    <td>{{ $customer->reference }}</td>
                    <td>{{ $customer->latitude }}</td>
                    <td>{{ $customer->longitude }}</td>
                </tr>
            @endforeach
            </table>
        </div>
    @else 
        <label class="label label-info">¡No se encontró resultados!</label>
    @endif
@endsection