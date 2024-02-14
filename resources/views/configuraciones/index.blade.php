@extends('vuexy.layouts.default', ['activePage' => 'configuraciones'])
@section('title','Categorias y Servicios')
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
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-header border-bottom">
                        <h4 >
                            Tipos de Servicios
                        </h4>
                        <div class="pull-right">
                            <div class="input-group-prepend pull-right btnagregar">
                                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modal-agregar">
                                    <i data-feather='plus'></i>
                                    Nuevo
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="table-responsive listaregistros">
                                        <table class="table table-striped table-bordered table-td-valign-middle dt-responsive" id="tdLista">
                                            <thead class="thead">
                                                <tr>

                                                    <th>Nro</th>
                                                    <th>Nombre</th>
                                                    <th>Estado</th>
                                                    <th >Actiones</th>
                                                </tr>
                                            </thead>
                                            <tbody >

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
<div class="modal fade" id="modal-agregar">
    <div class="modal-dialog" style="max-width: 40%;" role="document">
        <div class="modal-content" >
            <div class="modal-header alert-primary">
                <h4 class="modal-title">Nueva tipo de servicio</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form onSubmit="return false" id="formAdd" action="{{ route('tiposervicio.save') }}">
                <div class="modal-body">
                    {{ csrf_field() }}
                    <div class="alert alert-danger print-error-msg" style="display:none">
                        <ul></ul>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12 text-center">
                            <div class="row ">
                                <div class="col-md-12">
                                    <div class="mb-1">
                                        <div class="input-group " >
                                            <span class="input-group-text">
                                                Nombre
                                            </span>
                                            <input type="text" class="form-control" id="nombre_tipo" name="nombre_tipo" placeholder="Nombre" value="" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                </div>
                <div class="modal-footer">
                    <a href="javascript:;" class="btn btn-secondary" data-bs-dismiss="modal"><i data-feather='minus-circle'></i> Cerrar</a>
                    <button type="submit" class="btn btn-success"><i data-feather='save'></i> Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="modal-editar">
    <div class="modal-dialog" style="max-width: 40%;" role="document">
        <div class="modal-content" >
            <div class="modal-header alert-info">
                <h4 class="modal-title">Editar Tipo Servicio</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form onSubmit="return false" id="formEdit" action="{{ route('tiposervicio.edit') }}" method="POST">
                <div class="modal-body">
                    {{ csrf_field() }}
                    <div class="alert alert-danger print-error-msg" style="display:none">
                        <ul></ul>
                    </div>
                    <input type="hidden" value="" name="id_edit" id="id_edit">
                    <div class="form-group row">
                        <div class="col-md-12 text-center">
                            <div class="row ">
                                <div class="col-md-12">
                                    <div class="mb-1">
                                        <div class="input-group " >
                                            <span class="input-group-text">
                                                Nombre
                                            </span>
                                            <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre" value="" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row row-space-10">
                                <div class="col-md">
                                    <div class="mb-1">
                                        <div class="input-group" >
                                            <span class="input-group-text">
                                                Estado
                                            </span>
                                            <select name="estado" id="estado" class="form-control form-select">
                                                <option value="ACTIVO">ACTIVO</option>
                                                <option value="INACTIVO">INACTIVO</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                </div>
                <div class="modal-footer">
                    <a href="javascript:;" class="btn btn-secondary" data-bs-dismiss="modal"><i data-feather='minus-circle'></i> Cerrar</a>
                    <button type="submit" class="btn btn-success"><i data-feather='save'></i> Guardar</button>
                </div>
            </form>
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
     {{-- funciones --}}
     <script src="{!! asset('app-assets/js/funtions.js') !!}"></script>


@endpush
@push('scripts-page')
<script>
                //dom: '<"dataTables_wrapper dt-bootstrap"<"row"<"col-xl-7 d-block d-sm-flex d-xl-block justify-content-center"<"d-block d-lg-inline-flex mr-0 mr-sm-3"l><"d-block d-lg-inline-flex"B>><"col-xl-5 d-flex d-xl-block justify-content-center"fr>>t<"row"<"col-sm-5"i><"col-sm-7"p>>>',
$(document).ready( function () {
    $('#tdLista').DataTable({
        dom: '<"dataTables_wrapper dt-bootstrap"<"row"<"col-xl-7 d-block d-sm-flex d-xl-block justify-content-center"<"d-block d-lg-inline-flex mr-0 mr-sm-3"l><"d-block d-lg-inline-flex"B>><"col-xl-5 d-flex d-xl-block justify-content-center"fr>>t<"row"<"col-sm-5"i><"col-sm-7"p>>>',
        language: {
            "url": "/app-assets/js/scripts/tables/spanish.json"
        },
        buttons: [

        ],
        "ajax": {
            url: "{{route('lista.tiposervicio')}}",
            type: 'GET',
        },
        columns: [
                    {
                        data: null,
                        render: function (data, type, row, meta) {
                            return meta.row + 1;
                        }
                    },
                    { data: 'nombre', name: 'nombre'},
                    {data: 'estado', name: 'estado',
                        render: function(data, type, row, meta) {
                            return data === 'ACTIVO' ?
                                '<span class="badge bg-primary">ACTIVO</span>' :
                                '<span class="badge bg-danger">INACTIVO</span>';
                        }
                    },
                    { data: 'botones', "orderable": false}
        ],
        error: function(jqXHR, textStatus, errorThrown){
            $("#tdLista").DataTable().clear().draw();
        }
    });


});


function f_editar_tiposervicio(id,nombre){
    document.getElementById('id_edit').value=id;
    document.getElementById('nombre').value=nombre;
    $('#modal-editar').modal('toggle');
}

</script>
@endpush
