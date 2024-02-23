@extends('vuexy.layouts.default', ['activePage' => 'roles'])
@section('title','Ver Rol')

@section('content')

<div class="card">
    <div class="card-header">
        <h2>
            Ver Rol
        </h2>
    </div>

    <div class="card-body">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">

                    <h4><strong>Nombre:</strong>
                        {{ $role->name }}</h4>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <h4><strong>Permisos:</strong></h4>
                    <div style="display: flex; flex-wrap: wrap;">
                        @if(!empty($rolePermissions))
                            @php
                                $badges=['primary','danger','warning','info','success','dark','primary','danger','warning','info','warning','info','success','dark'];
                                $bandera=0;
                                $j=0;
                            @endphp
                            @foreach($rolePermissions as $v)
                                @php
                                    
                                    if($bandera==3){
                                        $j=rand(0, 13);
                                        $bandera=0;
                                    }
                                    $bandera++;
                                @endphp
                                <label style="flex-basis: 33%; margin-bottom: 10px;"><span class="{{ 'badge badge-light-'.$badges[$j] }}">{{ $v->name}}</span></label> 
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
