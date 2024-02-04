@extends('vuexy.layouts.default', ['activePage' => 'permissions'])
@section('title','Nuevo Permiso')
@section('content')

<div class="card">
    <div class="card-header">
        Nuevo Permiso
    </div>

    <div class="card-body">

        <form action="{{ route("permissions.store") }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="name">Titulo*</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ old('name', isset($permission) ? $permission->name : '') }}" required>
                @if($errors->has('name'))
                    <em class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </em>
                @endif
                <p class="helper-block">
                    @error('name')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                    {{ trans('cruds.permission.fields.title_helper') }}
                </p>
            </div>
            <div>
                <input class="btn btn-danger" type="submit" value="Guardar">
            </div>
        </form>


    </div>
</div>
@endsection
