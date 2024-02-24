@extends('vuexy.layouts.default', ['activePage' => 'publicacion'])
@section('title','Publicaciones')
@push('css-vendor')
    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{!! asset('app-assets/vendors/css/vendors.min.css') !!}">
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
              @if(session('success'))
                <div class="alert alert-success p-2">
                  {{ session('success') }}
                </div>
              @endif
              <div class="card">
                <div class="card-header">
                  <h4 class="card-title">Publicaciones</h4>
                  <div class="pull-right">
                    @can('registrar-publicaciones')
                        <a class="btn btn-primary" href="{{ route('publicacion.create') }}">
                            <span>
                            <i data-feather='plus'></i>
                            Crear Publicacion
                            </span>
                        </a>
                    @endcan
                  </div>
                </div>
                <div class="card-body">
                  <div class="card-datatable">
                    <table class="table table-striped table-bordered table-td-valign-middle dt-responsive" id="dt-Publicacion">
                      <thead class="thead" align="center">
                        <tr>
                          <th>#</th>
                          <th>Titulo</th>
                          <th>Fecha</th>
                          <th>Imagen</th>
                          <th>Estado</th>
                          <th><i data-feather='life-buoy'></i></th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($publicacion as $pub)
                        <tr>
                          <td>{{$loop->iteration }}</td>
                          <td>{{ $pub->titulo }}</td>
                          <td>{{ $pub->fecha }}</td>
                          <td><img src="{{ asset('imagenes/publicacion/'.$pub->imagen) }}" alt="100" width="50"></td>
                          @if($pub->estado == 'Activo')
                          <td><span class="badge badge-light-success w-100">ACTIVO</span></td>
                          @else
                          <td><span class="badge badge-light-danger w-100">INACTIVO</span></td>
                          @endif
                          <td>
                            <div>
                                @can('editar-publicaciones')
                                <a class="btn btn-sm btn-primary" data-toggle="tooltip" title="Editar" href="{{ route('publicacion.edit',$pub->id) }}">
                                    <i data-feather='edit'></i>
                                  </a>
                                    @can('eliminar-publicaciones')
                                    <a href="javascript:void(0)"  class="btn btn-sm btn-danger" onclick="eliminarPublicacion(<?php echo $pub->id; ?>)"><i data-feather='trash-2' ></i></a>
                                    @endcan
                                @elsecan('eliminar-publicaciones')
                                <a href="javascript:void(0)"  class="btn btn-sm btn-danger" onclick="eliminarPublicacion(<?php echo $pub->id; ?>)"><i data-feather='trash-2' ></i></a>
                                @else
                                    <span class="badge badge-light-warning">Sin Permisos</span>
                                @endcan
                                <form id="delete-form" method="post" class="d-none">
                                    @csrf
                                    @method('DELETE')
                                </form>
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
       <!-- BEGIN: Page JS-->
       <script src="{!! asset('app-assets/vendors/js/extensions/sweetalert2.all.min.js') !!}"></script>
       <script src="{!! asset('app-assets/vendors/js/extensions/polyfill.min.js') !!}"></script>
       <script src="{!! asset('app-assets/js/scripts/extensions/ext-component-sweet-alerts.js') !!}"></script>
       <!-- END: Page JS-->
    <script src="{!! asset('app-assets/js/funtions.js') !!}"></script>
@endpush
@push('scripts-page')
<script>

    $(function () {
        var dt_table_usuarios = $('#dt-Publicacion');
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
