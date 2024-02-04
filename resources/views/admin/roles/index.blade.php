@extends('vuexy.layouts.default', ['activePage' => 'roles'])
@section('title','Roles')
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
                            Roles
                        </h4>
                        <div class="pull-right">
                            <div class="input-group-prepend pull-right">
                                @can('crear-roles')
                                <a href="{{ route("roles.create") }}" class="btn btn-sm btn-primary">
                                    <i data-feather='plus'></i>
                                    Nuevo Rol
                                </a>
                                @endcan

                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        @if ($message = Session::get('success'))
                            <div class="alert alert-success">
                                <p>{{ $message }}</p>
                            </div>
                        @endif
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-datatable">
                                        <table class="table table-striped table-bordered table-td-valign-middle dt-responsive" id="dt-ListaRoles">
                                            <thead class="thead">
                                                <tr>
                                                    <th>Nro</th>
                                                    <th>Nombre</th>
                                                    <th width="280px">Acción</th>
                                                </tr>
                                            </thead>
                                            <tbody >
                                                @foreach ($roles as $key => $role)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $role->name }}</td>
                                                    <td>
                                                        <a class="btn btn-info btn-sm" data-toggle="tooltip" title="Ver" href="{{ route('roles.show',$role->id) }}"><i data-feather='eye'></i></a>
                                                        @can('editar-roles')
                                                            <a class="btn btn-primary btn-sm" data-toggle="tooltip" title="Editar" href="{{ route('roles.edit',$role->id) }}"><i data-feather='edit'></i></a>
                                                        @endcan
                                                        @can('eliminar-roles')
                                                            {!! Form::open(['method' => 'DELETE','route' => ['roles.destroy', $role->id],'style'=>'display:inline']) !!}

                                                                <button type="submit" class="btn btn-sm btn-danger" data-toggle="tooltip" title="Eliminar"><i data-feather='trash-2'></i></button>
                                                            {!! Form::close() !!}
                                                        @endcan
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
        var dt_table_usuarios = $('#dt-ListaRoles');
            var dt_basic = dt_table_usuarios.DataTable({
                dom: '<"dataTables_wrapper dt-bootstrap"<"row"<"col-xl-7 d-block d-sm-flex d-xl-block justify-content-center"<"d-block d-lg-inline-flex mr-0 mr-sm-3"l><"d-block d-lg-inline-flex"B>><"col-xl-5 d-flex d-xl-block justify-content-center"fr>>t<"row"<"col-sm-5"i><"col-sm-7"p>>>',
            //displayLength: 7,
            //lengthMenu: [7, 10, 25, 50, 75, 100],
            language: {
                "url": "/app-assets/js/scripts/tables/spanish.json"
            },
            buttons: [
            //{ extend: 'copy', text: 'Copiar', className: 'btn-sm' },
            //{ extend: 'csv', className: 'btn-sm' },
            {   extend: 'excel', className: 'btn-sm',
            },
            { extend: 'pdf', className: 'btn-sm' },
            { extend: 'print', text: 'Imprimir', className: 'btn-sm' }
            ],

            });
    });


</script>
@endpush
