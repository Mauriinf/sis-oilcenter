@extends('vuexy.layouts.default', ['activePage' => 'ingreso'])
@section('title','Usuarios')
@section('content')
<div class="content-wrapper p-0">
    <div class="content-body">
        {!! Form::open(array('route' => ['ingreso.show.payment', $ingreso->id], 'method' => 'PUT')) !!}
        <div class="row">
            <div class="col-sm-12">
              @if(session('success'))
                <div class="alert alert-success p-2">
                  {{ session('success') }}
                </div>
              @endif
              <div class="card">
                <div class="card-header @if($ingreso->estado == 1) bg-light-success @else bg-light-danger @endif">
                  <h4 class="card-title">Ingreso</h4>
                  <div class="pull-right">
                    @if($ingreso->estado == 1)
                    <span class="badge badge-light-success w-100">ACTIVO</span>
                    @else
                    <span class="badge badge-light-danger w-100">ANULADO</span>
                    @endif
                  </div>
                  <div class="pull-right">
                    <h5 class="m-0"><b>Fecha y Hora: {{$ingreso->fecha_hora}}</b></h5>
                  </div>
                </div>
                <div class="card-body py-0 pt-1">
                  <div class="row">
                    <div class="col-sm-3">
                      <div class="apply-job-package bg-light-primary rounded p-1 mb-1">
                        <strong>Proveedor</strong>
                        <p class="m-0">{{$ingreso->proveedor->nombres.' '.$ingreso->proveedor->paterno.' '.$ingreso->proveedor->materno}}</p>
                      </div>
                      <div class="apply-job-package bg-light-primary rounded p-1">
                        <strong>Almacenero</strong>
                        <p class="m-0">{{$ingreso->almacenero->nombres.' '.$ingreso->almacenero->paterno.' '.$ingreso->almacenero->materno}}</p>                        
                      </div>
                    </div>
                    <div class="col-sm-3">
                      
                    </div>
                    <div class="col-sm-3 ms-auto">
                      <div class="card card-transaction m-0">
                        <div class="transaction-item my-1 m-0 border-bottom-dark">
                          <div class="d-flex">
                            <div class="transaction-percentage">
                              <h6 class="transaction-title">Total</h6>
                            </div>
                          </div>
                          <input type="hidden" id="b_total" value="{{$ingreso->monto_total}}">
                          <div class="fw-bolder text-success">{{'Bs. '.$ingreso->monto_total}}</div>
                        </div>
                        <div class="transaction-item my-1 m-0 border-bottom-dark">
                          <div class="d-flex">
                            <div class="transaction-percentage">
                              <h6 class="transaction-title">Cancelado:</h6>
                            </div>
                          </div>
                          <input type="hidden" id="b_cancelado" value="{{$ingreso->monto_cancelado}}">
                          <div class="fw-bolder text-success">{{'Bs. '.$ingreso->monto_cancelado}}</div>
                        </div>
                        <div class="transaction-item my-1 m-0 border-bottom-dark">
                          <div class="d-flex">
                            <div class="transaction-percentage">
                              <h6 class="transaction-title">Saldo:</h6>
                            </div>
                          </div>
                          <input type="hidden" name="b_saldo" id="b_saldo" value="{{$ingreso->monto_deuda}}">
                          <div class="fw-bolder text-success">{{'Bs. '.$ingreso->monto_deuda}}</div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card-body">
                  <table class="table table-striped table-bordered table-td-valign-middle dt-responsive">
                    <thead>
                      <tr>
                        <th>ARTICULO</th>
                        <th>CANTIDAD</th>
                        <th>P. COMPRA</th>
                        <th>P. VENTA NORMAL</th>
                        <th>P. VENTA FACTURA</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($ingreso->detalle_ingreso as $ing)
                      <tr>
                        <td>{{$ing->articulo->nombre}}</td>
                        <td>{{$ing->cantidad}}</td>
                        <td>{{$ing->precio_compra}}</td>
                        <td>{{$ing->precio_venta_normal}}</td>
                        <td>{{$ing->precio_venta_factura}}</td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
                <div class="card-footer">
                  <a class="btn btn-secondary float-md-start" href="javascript:history.back(-1);" title="Ir la página anterior" class="fa fa-hand-o-left">Volver</a>

                  @if($ingreso->estado == 1)
                    <button type="button" id="bt_pagar" class="btn btn-success float-md-end" data-bs-toggle="modal" data-bs-target="#inlineForm">
                      <span>
                        <i data-feather='money'></i>
                        Cancelar saldo
                      </span>
                    </button>
                  @endif
                </div>
              </div>
            </div>
        </div>
        <div class="modal fade text-start" id="inlineForm" tabindex="-1" aria-labelledby="myModalLabel33" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel33">Pago de saldo</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
                <div class="modal-body">
                  <div class="row mb-2">
                    <div class="col-md-4">
                      <div class="form-group">
                        <strong>TOTAL Bs.: </strong>
                        <input type="integer" class="form-control" id="m_total" value="{{$ingreso->monto_total}}" disabled/>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <strong>CANCELADO Bs.: </strong>
                        <input type="integer" class="form-control" id="m_cancelado" value="{{$ingreso->monto_cancelado}}" disabled/>
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="form-group">
                        <strong>SALDO Bs.: </strong>
                        <input type="integer" class="form-control" id="m_saldo" value="{{$ingreso->monto_deuda}}" disabled />
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-7 ms-auto">
                      <div class="input-group">
                        <strong class="input-group-text bg-light-success" id="basic-addon3">ABONAR Bs:</strong>
                        <input type="integer" class="form-control" name="m_amortizar" id="m_amortizar" value="0" />
                      </div>
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Pagar</button>
                </div>
            </div>
          </div>
        </div>
        {!! Form::close() !!}
    </div>
</div>
@endsection

@push('scripts-vendor')
<script>

  total = 0;
  cancelado = 0;
  saldo = 0;

  $(document).ready(function() {
    $('#bt_pagar').click(function() {

      total = $('#b_total').val();
      cancelado = $('#b_cancelado').val();
      saldo = $('#b_saldo').val();

      $('#m_total').val(total);
      $('#m_cancelado').val(cancelado);
      $('#m_saldo').val(saldo);
      $('#m_amortizar').val(0);

    });
  });

  $('#m_amortizar').on('input', calcularSaldo);

  function calcularSaldo(){

    var m_pagar = saldo - $('#m_amortizar').val();

    if (m_pagar < 0) {
      alert('El monto a cancelar no puede ser mayor al saldo pendiente');

      $('#b_saldo').val(saldo);
      $('#m_saldo').val(saldo);
      $('#m_amortizar').val(saldo);
    }else{
      $('#b_saldo').val(m_pagar);
      $('#m_saldo').val(m_pagar);
    }
  }

</script>
@endpush
@push('scripts-page')
@endpush