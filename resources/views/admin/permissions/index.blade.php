@extends('vuexy.layouts.default', ['activePage' => 'permissions'])
@section('title','Permisos')
@push('css-vendor')
    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{!! asset('app-assets/vendors/css/vendors.min.css') !!}">
    <link rel="stylesheet" type="text/css" href="{!! asset('app-assets/vendors/css/tables/datatable/dataTables.bootstrap5.min.css') !!}">
    <link rel="stylesheet" type="text/css" href="{!! asset('app-assets/vendors/css/tables/datatable/responsive.bootstrap5.min.css') !!}">
    <link rel="stylesheet" type="text/css" href="{!! asset('app-assets/vendors/css/tables/datatable/buttons.bootstrap5.min.css') !!}">
    <link rel="stylesheet" type="text/css" href="{!! asset('app-assets/vendors/css/tables/datatable/rowGroup.bootstrap5.min.css') !!}">
    <link rel="stylesheet" type="text/css" href="{!! asset('app-assets/vendors/css/pickers/flatpickr/flatpickr.min.css') !!}">
    <!-- END: Vendor CSS-->
@endpush
@section('content')
<div class="content-wrapper p-0">
    <div class="content-body">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header border-bottom">
                        <h4 >
                            Permisos
                        </h4>
                        <div class="pull-right">
                            <div class="input-group-prepend pull-right">
                                <a href="{{ route("permissions.create") }}" class="dropdown-item mb-1">
                                    <i data-feather='user-plus'></i>
                                    Nuevo Permiso
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-datatable">
                                        <table class="table table-striped table-bordered table-td-valign-middle dt-responsive" id="dt-ListaPermisos">
                                            <thead class="thead">
                                                <tr>
                                                    <th>ID</th>
                                                    <th class="hidden-xs">Titulo</th>
                                                    <th class="no-search no-sort">Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody >
                                                @foreach($permissions as $key => $permission)
                                                    <tr data-entry-id="{{ $permission->id }}">
                                                        <td>
                                                            {{ $permission->id ?? '' }}
                                                        </td>
                                                        <td>
                                                            {{ $permission->name ?? '' }}
                                                        </td>
                                                        <td>
                                                            <a class="btn btn-xs btn-primary" href="{{ route('permissions.show', $permission->id) }}">
                                                                Ver
                                                            </a>

                                                            <a class="btn btn-xs btn-info" href="{{ route('permissions.edit', $permission->id) }}">
                                                                Editar
                                                            </a>

                                                            <form action="{{ route('permissions.destroy', $permission->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                                                <input type="hidden" name="_method" value="DELETE">
                                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                                <input type="submit" class="btn btn-xs btn-danger" value="Eliminar">
                                                            </form>
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

@endpush
@push('scripts-page')
<script>

    $(function () {
        var dt_table_usuarios = $('#dt-ListaPermisos');
            var dt_basic = dt_table_usuarios.DataTable({
                dom: '<"dataTables_wrapper dt-bootstrap"<"row"<"col-xl-7 d-block d-sm-flex d-xl-block justify-content-center"<"d-block d-lg-inline-flex mr-0 mr-sm-3"l><"d-block d-lg-inline-flex"B>><"col-xl-5 d-flex d-xl-block justify-content-center"fr>>t<"row"<"col-sm-5"i><"col-sm-7"p>>>',
            //displayLength: 7,
            //lengthMenu: [7, 10, 25, 50, 75, 100],
            language: {
                "url": "/app-assets/js/scripts/tables/spanish.json"
            }
            });
    });


</script>
@endpush

