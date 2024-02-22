@extends('vuexy.layouts.default', ['activePage' => 'venta'])
@section('title','Venta')
@push('css-vendor')
    <!-- END: Page CSS-->
@endpush
@section('content')
<div class="content-wrapper p-0">
    <div class="content-body">
        <div class="row">
            <div class="col-sm-12">
              @if(session('success'))
                <div class="alert alert-success p-2">
                  {{ session('success') }}
                </div>
              @endif
              <div class="card">
                <div class="card-header">
                  <h4 class="card-title">Ventas</h4>
                  <div class="pull-right">
                    <a class="btn btn-primary" href="{{ route('venta.create') }}">
                      <span>
                        <i data-feather='plus'></i>
                        Realizar Venta
                      </span>
                    </a>
                  </div>
                </div>
                <div class="card-body">
                  <div class="card-datatable">
                    <table class="table table-striped table-bordered table-td-valign-middle dt-responsive" id="dt-Venta">
                      <thead class="thead" align="center">
                        <tr>
                          <th>#</th>
                          <th>Cliente</th>
                          <th>Vendedor</th>
                          <th>Fecha y hora</th>
                          <th>total venta</th>
                          <th>Cancelado</th>
                          <th>Saldo</th>
                          <th>Estado</th>
                          <th><i data-feather='life-buoy'></i></th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($venta as $ven)
                        <tr>
                          <td>{{$loop->iteration }}</td>
                          <td>{{ $ven->cliente->paterno.' '.$ven->cliente->materno.' '.$ven->cliente->nombres }}</td>
                          <td>{{ $ven->vendedorV->paterno.' '.$ven->vendedorV->materno.' '.$ven->vendedorV->nombres }}</td>
                          <td>{{ $ven->fecha_hora }}</td>
                          <td>{{ $ven->total_venta }}</td>
                          <td>{{ $ven->monto_cancelado }}</td>
                          <td>{{ $ven->monto_deuda }}</td>
                          @if($ven->estado == 1)
                          <td><span class="badge badge-light-success w-100">ACTIVO</span></td>
                          @else
                          <td><span class="badge badge-light-danger w-100">ANULADO</span></td>
                          @endif
                          <td>
                            <div class="d-flex">
                              <a class="btn btn-sm btn-info" style="margin-right:5px" data-toggle="tooltip" title="Mostrar" href="{{ route('venta.show',$ven->id) }}">
                                <i data-feather='eye'></i>
                              </a>
                              {!! Form::open(['method' => 'GET', 'route' => ['venta.cancel', $ven->id], 'style' => 'display:inline']) !!}
                                @if($ven->estado == 1)
                                  <button type="submit" class="btn btn-sm btn-danger" data-toggle="tooltip" title="Eliminar" onclick="return confirm('¿Estás seguro de anular este registro?')">
                                    <i data-feather='trash-2'></i>
                                  </button>
                                @else
                                  <button type="button" class="btn btn-sm btn-danger" disabled>
                                    <i data-feather='trash-2'></i>
                                  </button>
                                @endif
                              {!! Form::close() !!}
                            </div>
                          </td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts-page')
<script>

    $(function () {
        var dt_table_usuarios = $('#dt-Venta');
            var dt_basic = dt_table_usuarios.DataTable({
                dom: '<"dataTables_wrapper dt-bootstrap"<"row"<"col-xl-7 d-block d-sm-flex d-xl-block justify-content-center"<"d-block d-lg-inline-flex mr-0 mr-sm-3"l><"d-block d-lg-inline-flex"B>><"col-xl-5 d-flex d-xl-block justify-content-center"fr>>t<"row"<"col-sm-5"i><"col-sm-7"p>>>',
            //displayLength: 7,
            //lengthMenu: [7, 10, 25, 50, 75, 100],
            language: {
                "url": "/app-assets/js/scripts/tables/spanish.json"
            },
            buttons: [
            ],
            });
    });


</script>
@endpush