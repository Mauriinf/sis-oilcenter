@extends('vuexy.layouts.default', ['activePage' => 'b_dia'])
@section('title','Config. Agenda')
@push('css-vendor')
    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{!! asset('app-assets/vendors/css/tables/datatable/dataTables.bootstrap5.min.css') !!}">
    <link rel="stylesheet" type="text/css" href="{!! asset('app-assets/vendors/css/tables/datatable/responsive.bootstrap5.min.css') !!}">
    <link rel="stylesheet" type="text/css" href="{!! asset('app-assets/vendors/css/tables/datatable/buttons.bootstrap5.min.css') !!}">
    <link rel="stylesheet" type="text/css" href="{!! asset('app-assets/vendors/css/tables/datatable/rowGroup.bootstrap5.min.css') !!}">
    <link rel="stylesheet" type="text/css" href="{!! asset('app-assets/vendors/css/pickers/flatpickr/flatpickr.min.css') !!}">
    <!-- END: Vendor CSS-->
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
                <div class="card">
                    <div class="card-header border-bottom">
                        <h4 >
                            Configuración Agenda
                        </h4>
                        <div class="pull-right">
                            <div class="input-group-prepend pull-right btnagregar">
                            @if($bdu_existe)
                                <a href="{{ route('generar_agenda') }}" class="btn btn-sm btn-primary">
                                    <i data-feather='plus'></i>
                                    Nuevo
                                </a>
                            @endif
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="table-responsive listaregistros">
                                        <table class="table table-bordered table-td-valign-middle dt-responsive mt-1">
                                            <thead class="thead">
                                                <tr>
                                                    <th>Lunes</th>
                                                    <th>Martes</th>
                                                    <th>Miercoles</th>
                                                    <th>Jueves</th>
                                                    <th>Viernes</th>
                                                    <th>Sabado</th>
                                                    <th>Domingo</th>
                                                </tr>
                                            </thead>
                                            <tbody >
                                            @foreach ($bloques as $bloque)
                                            <tr>
                                                @forelse ($bloque->b_dia as $bdia)
                                                    <td class="{{ ($bdia->bd_estado == 'ACTIVO') ? 'bg-success text-light' : '' }} bloque cursor-pointer" data-bd="{{ $bdia->bd_id }}">
                                                        {{ $bloque->inicio }}
                                                    </td>    
                                                @empty
                                                    <td colspan="7" class="text-center">Lo sentimos no existe un horario generado para generar un horario haga click en Nuevo</td>
                                                    @break
                                                @endforelse
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
    <!-- BEGIN: Page JS-->
    <script src="{!! asset('app-assets/vendors/js/extensions/sweetalert2.all.min.js') !!}"></script>
    <script src="{!! asset('app-assets/vendors/js/extensions/polyfill.min.js') !!}"></script>
    <script src="{!! asset('app-assets/js/scripts/extensions/ext-component-sweet-alerts.js') !!}"></script>
    <!-- END: Page JS-->
    <script src="{{ asset('js/bloquedia.js') }}"></script>
    <script src="{{ asset('js/sonrident.js') }}"></script>
    @endpush