@extends('layouts.app')
@section('title')
{{ $title }}
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            {{ $title }}
                        </h3>
                    </div>
                    <div class="panel-body">
                        @if (isset($visit))
                            <div class="col-lg-12 col-md-12 text-right">
                                <form method="POST" action="{{ url('/supervisor/visits/' . $visit->id ) }} ">
                                    <input type="submit" value="Eliminar" class="btn btn-default" />
                                    <input name="_method" type="hidden" value="delete">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                </form>
                            </div>
                        @endif
                        <form method="POST" 
                        action="{{ isset($action)?url($action):url('/supervisor/visits/') }}">
                            @if (isset($method))
                                <input name="_method" type="hidden" value="{{ $method }}">
                                <input type="hidden" name="id" value="{{ $visit->id }}" />
                            @else 
                                    <input type="hidden" name="circle" value="{{ $id }}" />
                            @endif
                            <div class="form-group">
                                <label>Cliente</label>
                                <select class="form-control" name="customer">
                                    @foreach ($customers as $customer)
                                        <option {{ isset($visit)?(($visit->customer_id == $customer->id)?'selected':''):'' }}  value="{{ $customer->id }}">{{ $customer->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Usuario designado</label>
                                <select class="form-control" name="user">
                                    @foreach ($users as $user)
                                        <option {{ isset($visit)?(($visit->user_id == $user->id)?'selected':''):'' }} 
                                            value="{{ $user->user->id }}">
                                            {{ $user->user->name . ' (' . $user->user->username . ')' }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Fecha de programación</label>
                                <input id="programmingd" type="text" name="date" 
                                class="form-control" value="{{ (isset($visit))?$visit->programmed_date:'' }}" />
                            </div>
                            <div class="form-group">
                                <label>Hora de programación</label>
                                <input id="programmingt" type="text" name="time" value="{{ (isset($visit))?$visit->programmed_time:'' }}"
                                class="form-control" />
                            </div>
                            <div class="form-group">
                                <label>Detalle</label>
                                <textarea name="detail" class="form-control">{{ isset($visit)?$visit->detail:'' }}</textarea>
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
                            <div class="form-group">
                                <input type="submit" value="Guardar" class="btn btn-default" />
                                <a href="{{ url('/supervisor/visits/' . $id) }}" class="btn btn-default">Cancelar</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
    <script>
        $(function() {
            $( "#programmingd" ).datepicker({ dateFormat: 'yy-mm-dd' });
        });
    </script>
@endsection