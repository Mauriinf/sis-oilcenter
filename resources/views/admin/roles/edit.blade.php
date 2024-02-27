@extends('vuexy.layouts.default', ['activePage' => 'roles'])
@section('title','Editar Rol')

@section('content')
<div class="card">
    <div class="card-header">
        <h4>
            Editar Rol
        </h4>
    </div>

    <div class="card-body">
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <strong>Ups!</strong> Algo salió mal.<br><br>
                <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
                </ul>
            </div>
        @endif
        {!! Form::model($role, ['method' => 'PATCH','route' => ['roles.update', $role->id]]) !!}
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Nombre:</strong>
                    {!! Form::text('name', null, array('placeholder' => 'Nombre','class' => 'form-control')) !!}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Permisos:</strong>
                    <div style="display: flex; flex-wrap: wrap;">
                        @foreach($permission as $value)
                            <label style="flex-basis: 50%; margin-bottom: 10px;">{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'name')) }}
                            {{ $value->name }}</label>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Actualizar</button>
            </div>
        </div>
        {!! Form::close() !!}


    </div>
</div>



@endsection
