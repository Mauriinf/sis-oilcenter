@extends('vuexy.layouts.default', ['activePage' => 'roles'])
@section('title','Nuevo Rol')
@section('content')

<div class="card">
    <div class="card-header">
        Nuevo Rol
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
        {!! Form::open(array('route' => 'roles.store','method'=>'POST')) !!}
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
                            <label style="flex-basis: 50%; margin-bottom: 10px;">{{ Form::checkbox('permission[]', $value->id, false, array('class' => 'name')) }}
                            {{ $value->name }}</label>
                    
                        @endforeach
                    </div>
                   
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
        </div>
        {!! Form::close() !!}

    </div>
</div>
@endsection
