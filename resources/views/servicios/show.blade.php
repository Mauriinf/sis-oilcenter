@extends('vuexy.layouts.default', ['activePage' => 'servicio'])
@section('title','Ver Servicio')
@section('content')
<div class="content-wrapper p-0">
    <div class="content-body">
        <div class="row">
            <div class="col-sm-12">
              <div class="card">
                <div class="card-header  bg-light-success ">
                  <h4 class="card-title">Servicio</h4>
                  <div class="pull-right">
                    @if($servicio->citas->estado =='PENDIENTE')
                   <span class="badge badge-light-danger w-100"><strong>CITA: </strong> PENDIENTE</span>
                    @else
                    <span class="badge badge-light-success w-100"><strong>CITA: </strong>FINALIZADO</span>
                    @endif
                  </div>
                  <div class="pull-right">
                    <h5 class="m-0"><b>Fecha y Hora: {{$servicio->fecha_hora}}</b></h5>
                  </div>
                </div>
                <div class="card-body py-0 pt-1">
                  <div class="row">
                    <div class="col-sm-4">

                      <div class="apply-job-package bg-light-primary rounded p-1 mb-1">
                        <strong>Trabajador</strong>
                        <p class="m-0">{{$servicio->mecanico->nombres.' '.$servicio->mecanico->paterno.' '.$servicio->mecanico->materno}}</p>
                      </div>
                      <div class="apply-job-package bg-light-primary rounded p-1 mb-1">
                        <strong>Fecha Realizada</strong>
                        <p class="m-0">{{$servicio->fecha_hora}}</p>
                      </div>
                      <div class="apply-job-package bg-light-primary rounded p-1 mb-1">
                        <strong>Precio</strong>
                        <p class="m-0">{{$servicio->precio}} Bs.</p>
                      </div>
                      <div class="apply-job-package bg-light-primary rounded p-1 mb-1">
                        <strong>Kilometraje Actual</strong>
                        <p class="m-0">{{$servicio->km_actual}} </p>
                      </div>
                      <div class="apply-job-package bg-light-primary rounded p-1">
                        <strong>Descripción</strong>
                        <p class="m-0">{{$servicio->descripcion}}</p>
                      </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="apply-job-package bg-light-primary rounded p-1 mb-1">
                            <strong>Cliente</strong>
                            <p class="m-0">{{$servicio->cliente->nombres.' '.$servicio->cliente->paterno.' '.$servicio->cliente->materno}}</p>
                        </div>
                        <div class="apply-job-package bg-light-primary rounded p-1 mb-1">
                            <strong>Proxima Fecha  Hora</strong>
                            <p class="m-0">{{$servicio->citas->fecha_hora}}</p>
                          </div>
                          <div class="apply-job-package bg-light-primary rounded p-1 mb-1">
                            <strong>Proximo Kilometraje</strong>
                            <p class="m-0">{{$servicio->citas->km}} </p>
                          </div>
                          <div class="apply-job-package bg-light-primary rounded p-1 mb-1">
                            <strong>Descripción</strong>
                            <p class="m-0">{{$servicio->citas->descripcion}}</p>
                          </div>
                          <div class="apply-job-package bg-light-primary rounded p-1">
                            <strong>Estado</strong>
                            <p class="m-0"><span class="badge badge-light-success w-100">{{$servicio->citas->estado}}</span></p>
                          </div>
                    </div>
                    <div class="col-sm-4 ms-auto">
                      <div class="card card-transaction m-0">
                        <div class="transaction-item my-1 m-0 border-bottom-dark">
                            <div class="d-flex">
                              <div class="transaction-percentage">
                                <h6 class="transaction-title"><strong>Servicios Realizados</strong></h6>
                              </div>
                            </div>
                        </div>
                        @foreach ($servicio->detalleServicios as $item)
                        <div class="transaction-item my-1 m-0 ">
                            <div class="d-flex">
                              <div class="transaction-percentage">
                                <h6 class="transaction-title">{{ $item->tipoServicio->nombre }}</h6>
                              </div>
                            </div>
                        </div>
                        @endforeach
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                  <a class="btn btn-secondary float-md-start" href="javascript:history.back(-1);" title="Ir la página anterior" class="fa fa-hand-o-left">Volver</a>


                </div>
              </div>
            </div>
        </div>
    </div>
</div>
@endsection
