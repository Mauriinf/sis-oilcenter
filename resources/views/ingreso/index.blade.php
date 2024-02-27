@extends('vuexy.layouts.default', ['activePage' => 'ingreso'])
@section('title','Ingresos')
@push('css-vendor')
    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{!! asset('app-assets/vendors/css/vendors.min.css') !!}">
    <link rel="stylesheet" type="text/css" href="{!! asset('app-assets/vendors/css/tables/datatable/dataTables.bootstrap5.min.css') !!}">
    <link rel="stylesheet" type="text/css" href="{!! asset('app-assets/vendors/css/tables/datatable/responsive.bootstrap5.min.css') !!}">
    <link rel="stylesheet" type="text/css" href="{!! asset('app-assets/vendors/css/tables/datatable/buttons.bootstrap5.min.css') !!}">
    <link rel="stylesheet" type="text/css" href="{!! asset('app-assets/vendors/css/tables/datatable/rowGroup.bootstrap5.min.css') !!}">
    <link rel="stylesheet" type="text/css" href="{!! asset('app-assets/vendors/css/pickers/flatpickr/flatpickr.min.css') !!}">
    <!-- END: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{!! asset('app-assets/vendors/css/forms/select/select2.min.css') !!}">
    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{!! asset('app-assets/vendors/css/animate/animate.min.css') !!}">
    <link rel="stylesheet" type="text/css" href="{!! asset('app-assets/vendors/css/extensions/sweetalert2.min.css') !!}">
    <!-- END: Vendor CSS-->
    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{!! asset('app-assets/css/plugins/extensions/ext-component-sweet-alerts.css') !!}">
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
                  <h4 class="card-title">Ingresos</h4>
                  <div class="pull-right">
                    @can('registrar-ingresos')
                        <a class="btn btn-primary" href="{{ route('ingreso.create') }}">
                            <span>
                            <i data-feather='plus'></i>
                            Nuevo Ingreso
                            </span>
                        </a>
                    @endcan
                  </div>
                </div>
                <div class="card-body">
                  <div class="card-datatable">
                    <table class="table table-striped table-bordered table-td-valign-middle dt-responsive" id="dt-Ingreso">
                      <thead class="thead" align="center">
                        <tr>
                          <th>#</th>
                          <th>Proveedor</th>
                          <th>Almacenero</th>
                          <th>Monto total</th>
                          <th>Fecha-Hora</th>
                          <th>Cancelado</th>
                          <th>Deuda</th>
                          <th>Estado</th>
                          <th><i data-feather='life-buoy'></i></th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($ingreso as $ing)
                        <tr>
                          <td>{{ $loop->iteration }}</td>
                          <td>{{ $ing->proveedor->nombres }}</td>
                          <td>{{ $ing->almacenero->nombres }}</td>
                          <td>{{ $ing->monto_total }}</td>
                          <td>{{ $ing->fecha_hora }}</td>
                          <td>{{ $ing->monto_cancelado }}</td>
                          <td>{{ $ing->monto_deuda }}</td>
                          @if($ing->estado == 1)
                          <td><span class="badge badge-light-success w-100">ACTIVO</span></td>
                          @else
                          <td><span class="badge badge-light-danger w-100">ANULADO</span></td>
                          @endif
                          <td>
                            <div>
                                @can('ver-ingresos')
                                    <a class="btn btn-sm btn-info" data-toggle="tooltip" title="Mostrar" href="{{ route('ingreso.show',$ing->id) }}">
                                        <i data-feather='eye'></i>
                                    </a>
                                    @can('eliminar-ingresos')
                                        {!! Form::open(['method' => 'GET', 'route' => ['ingreso.cancel', $ing->id], 'style' => 'display:inline']) !!}
                                            @if($ing->estado == 1)
                                            <button type="submit" class="btn btn-sm btn-danger" data-toggle="tooltip" title="Eliminar" onclick="return confirm('¿Estás seguro de anular este registro?')">
                                                <i data-feather='trash-2'></i>
                                            </button>
                                            @else
                                            <button type="button" class="btn btn-sm btn-danger" disabled>
                                                <i data-feather='trash-2'></i>
                                            </button>
                                            @endif
                                        {!! Form::close() !!}
                                    @endcan
                                @elsecan('eliminar-ingresos')
                                    {!! Form::open(['method' => 'GET', 'route' => ['ingreso.cancel', $ing->id], 'style' => 'display:inline']) !!}
                                        @if($ing->estado == 1)
                                        <button type="submit" class="btn btn-sm btn-danger" data-toggle="tooltip" title="Eliminar" onclick="return confirm('¿Estás seguro de anular este registro?')">
                                            <i data-feather='trash-2'></i>
                                        </button>
                                        @else
                                        <button type="button" class="btn btn-sm btn-danger" disabled>
                                            <i data-feather='trash-2'></i>
                                        </button>
                                        @endif
                                    {!! Form::close() !!}
                                @else
                                <span class="badge badge-light-warning">Sin Permisos</span>
                                @endcan
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

@push('scripts-vendor')
    <!-- BEGIN: Page Vendor JS-->
    <script src="{!! asset('app-assets/vendors/js/tables/datatable/jquery.dataTables.min.js') !!}"></script>
    <script src="{!! asset('app-assets/vendors/js/tables/datatable/dataTables.bootstrap5.min.js') !!}"></script>
    <script src="{!! asset('app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js') !!}"></script>
    <script src="{!! asset('app-assets/vendors/js/tables/datatable/responsive.bootstrap5.min.js') !!}"></script>
    <script src="{!! asset('app-assets/vendors/js/tables/datatable/datatables.checkboxes.min.js') !!}"></script>
    <script src="{!! asset('app-assets/vendors/js/tables/datatable/datatables.buttons.min.js') !!}"></script>
    <script src="{!! asset('app-assets/vendors/js/tables/datatable/jszip.min.js') !!}"></script>
    <script src="{!! asset('app-assets/vendors/js/tables/datatable/pdfmake.min.js') !!}"></script>
    <script src="{!! asset('app-assets/vendors/js/tables/datatable/vfs_fonts.js') !!}"></script>
    <script src="{!! asset('app-assets/vendors/js/tables/datatable/buttons.html5.min.js') !!}"></script>
    <script src="{!! asset('app-assets/vendors/js/tables/datatable/buttons.bootstrap5.min.js') !!}"></script>
    <script src="{!! asset('app-assets/vendors/js/tables/datatable/buttons.print.min.js') !!}"></script>
    <script src="{!! asset('app-assets/vendors/js/tables/datatable/dataTables.rowGroup.min.js') !!}"></script>
    <script src="{!! asset('app-assets/vendors/js/tables/datatable/rowGroup.bootstrap5.min.js') !!}"></script>
    <script src="{!! asset('app-assets/vendors/js/tables/datatable/dataTables.select.min.js') !!}"></script>
    <script src="{!! asset('app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js') !!}"></script>
    <!-- END: Page Vendor JS-->
    <!-- BEGIN: Page Vendor JS-->
    <script src="{!! asset('app-assets/vendors/js/forms/select/select2.full.min.js') !!}"></script>
    <!-- END: Page Vendor JS-->
    <!-- BEGIN: Page JS-->
    <script src="{!! asset('app-assets/js/scripts/forms/form-select2.js') !!}"></script>
    <!-- END: Page JS-->
    <!-- BEGIN: Page JS-->
    <script src="{!! asset('app-assets/vendors/js/extensions/sweetalert2.all.min.js') !!}"></script>
    <script src="{!! asset('app-assets/vendors/js/extensions/polyfill.min.js') !!}"></script>
    <script src="{!! asset('app-assets/js/scripts/extensions/ext-component-sweet-alerts.js') !!}"></script>
    <!-- END: Page JS-->
@endpush
@push('scripts-page')
<script>

    $(function () {
        var dt_table_usuarios = $('#dt-Ingreso');
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
