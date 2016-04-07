@extends('layouts.admin-form')
@section('title')
{{ isset($data)?'Modificar círculo' : 'Nuevo círculo' }}
@endsection
@section('form')
    <div class="form-group">
            <label>Nombre del círculo (Requerido)</label>
            <input type="text" name="name" class="form-control" required="required" 
            value="{{ isset($data)?$data->name:'' }}"/>
        </div>
        <div class="form-group">
            <label>Usuario supervisor (Requerido)</label>
            <select class="form-control" name="user" required="required">
                @foreach($users as $user)
                    <option {{ isset($data)?(($data->user_id == $user->id)?'selected':''):'' }} 
                        value="{{ $user->id }}">{{ $user->username . ' (' . $user->name . ')' }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>Miembros del círculo</label>
            @if(count($members) > 0)
                @foreach ($members as $member)
                    <div class="checkbox">
                        <label> <input type="checkbox" name="members[]" value="{{ $member->id }}" />
                            {{ $member->name . ' (' . $member->username . ')' }}
                        </label>
                    </div>
                @endforeach
            @else 
                <label class="label label-info">¡No hay empleados registrados!</label>
            @endif
        </div>
        <script>
            function checkMember (member) {
                var members = document.getElementsByName('members[]');
                    for (var i = 0; i < members.length; i++)
                        if (members[i].value ==  member)
                            members[i].checked = true;
            }
        </script>
        @if (isset($circle_users))
            @foreach($circle_users as $member)
                <script>
                    checkMember({{ $member['user_id'] }});
                </script>
            @endforeach
        @endif
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