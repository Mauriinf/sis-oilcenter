@extends('vuexy.layouts.default', ['activePage' => 'users'])
@section('title','Ver Usuario')

@section('content')

<div class="card">
    <div class="card-header">
        <h4>
            Ver Usuario
        </h4>
    </div>

    <div class="card-body">
        <div class="row">
            <div class="col-xl-12 col-lg-12 mt-2 mt-xl-0">
                <div class="user-info-wrapper">
                    <div class="d-flex flex-wrap">
                        <div class="user-info-title">
                            <i data-feather="user" class="mr-1"></i>
                            <span class="card-text user-info-title font-weight-bold mb-0">Nombres: </span>
                        </div>
                        <p class="card-text mb-0">{{ $user->nombres }}</p>
                    </div>
                    <div class="d-flex flex-wrap my-50">
                        <div class="user-info-title">
                            <i data-feather="user" class="mr-1"></i>
                            <span class="card-text user-info-title font-weight-bold mb-0">Ap. Paterno: </span>
                        </div>
                        <p class="card-text mb-0">{{ $user->paterno }}</p>
                    </div>
                    <div class="d-flex flex-wrap my-50">
                        <div class="user-info-title">
                            <i data-feather="user" class="mr-1"></i>
                            <span class="card-text user-info-title font-weight-bold mb-0">Ap. Materno: </span>
                        </div>
                        <p class="card-text mb-0">{{ $user->materno }}</p>
                    </div>
                    <div class="d-flex flex-wrap my-50">
                        <div class="user-info-title">
                            <i data-feather="info" class="mr-1"></i>
                            <span class="card-text user-info-title font-weight-bold mb-0">C.I.: </span>
                        </div>
                        <p class="card-text mb-0">{{ $user->ci }}</p>
                    </div>
                    <div class="d-flex flex-wrap">
                        <div class="user-info-title">
                            <i data-feather="calendar" class="mr-1"></i>
                            <span class="card-text user-info-title font-weight-bold mb-0">Fecha Nacimiento: </span>
                        </div>
                        <p class="card-text mb-0">{{ $user->fec_nac }}</p>
                    </div>
                    <div class="d-flex flex-wrap">
                        <div class="user-info-title">
                            <i data-feather="map-pin" class="mr-1"></i>
                            <span class="card-text user-info-title font-weight-bold mb-0">Dirección: </span>
                        </div>
                        <p class="card-text mb-0">{{ $user->direccion }}</p>
                    </div>
                    <div class="d-flex flex-wrap">
                        <div class="user-info-title">
                            <i data-feather="phone" class="mr-1"></i>
                            <span class="card-text user-info-title font-weight-bold mb-0">Teléfono: </span>
                        </div>
                        <p class="card-text mb-0">{{ $user->telefono }}</p>
                    </div>
                    <div class="d-flex flex-wrap">
                        <div class="user-info-title">
                            <i data-feather="user-check" class="mr-1"></i>
                            <span class="card-text user-info-title font-weight-bold mb-0">Userame: </span>
                        </div>
                        <p class="card-text mb-0">{{ $user->username }}</p>
                    </div>
                    <div class="d-flex flex-wrap">
                        <div class="user-info-title">
                            <i data-feather="mail" class="mr-1"></i>
                            <span class="card-text user-info-title font-weight-bold mb-0">Email: </span>
                        </div>
                        <p class="card-text mb-0">{{ $user->email }}</p>
                    </div>
                    <div class="d-flex flex-wrap">
                        <div class="user-info-title">
                            <i data-feather="toggle-left" class="mr-1"></i>
                            <span class="card-text user-info-title font-weight-bold mb-0">Estado: </span>
                        </div>
                        <p class="card-text mb-0">
                            @if ($user->estado===1)
                                Activo
                            @else
                                Inactivo
                            @endif
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <i data-feather="shield" class="mr-1"></i>
                    <strong>Roles: </strong>
                    @php
                        $badges=['primary','danger','warning','info','success','dark','primary','danger','warning','info','warning','info','success','dark'];
                        $j=0;
                    @endphp
                    @if(!empty($user->getRoleNames()))
                        @foreach($user->getRoleNames() as $v)
                            <span class="{{ 'badge badge-light-'.$badges[$j] }}">{{ $v }}</span>
                            @php
                                $j++;
                            @endphp
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

