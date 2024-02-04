@extends('vuexy.layouts.default', ['activePage' => 'tratamiento'])
@section('title','Tratamientos')
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
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-body">
            <div class="row">
                <div class="col-12">
                    <!-- security -->

                    <div class="card">
                        <div class="card-header border-bottom">
                            <h4 class="card-title">Cambiar Contraseña</h4>
                        </div>
                        <div class="card-body pt-1">
                            <!-- form -->
                            <form class="validate-form" action="{{ route('password.actualizar') }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-12 col-sm-6 mb-1">
                                        <label class="form-label" for="password">Contraseña Actual</label>
                                        <div class="input-group form-password-toggle input-group-merge">
                                            <input type="password" class="form-control" id="password" name="password" placeholder="Ingrese contraseña actual" data-msg="aaaaaaaa" />
                                            <div class="input-group-text cursor-pointer">
                                                <i data-feather="eye"></i>
                                            </div>
                                        </div>
                                        @if ($errors->has('password'))
                                            <div class="alert alert-danger mt-1 alert-validation-msg" role="alert">
                                                <div class="alert-body d-flex align-items-center">
                                                    <i data-feather="info" class="me-50"></i>
                                                    <span>{{ $errors->first('password') }}</span>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-sm-6 mb-1">
                                        <label class="form-label" for="password_nuevo">Nueva Contraseña</label>
                                        <div class="input-group form-password-toggle input-group-merge">
                                            <input type="password" id="password_nuevo" name="password_nuevo" class="form-control" placeholder="Ingrese nueva contraseña" />
                                            <div class="input-group-text cursor-pointer">
                                                <i data-feather="eye"></i>
                                            </div>
                                        </div>
                                        @if ($errors->has('password_nuevo'))
                                            <div class="alert alert-danger mt-1 alert-validation-msg" role="alert">
                                                <div class="alert-body d-flex align-items-center">
                                                    <i data-feather="info" class="me-50"></i>
                                                    <span>{{ $errors->first('password_nuevo') }}</span>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-12 col-sm-6 mb-1">
                                        <label class="form-label" for="password_nuevo_verif">Verificar Contraseña</label>
                                        <div class="input-group form-password-toggle input-group-merge">
                                            <input type="password" class="form-control" id="password_nuevo_verif" name="password_nuevo_verif" placeholder="Confirme su nueva contraseña" />
                                            <div class="input-group-text cursor-pointer"><i data-feather="eye"></i></div>
                                        </div>
                                        @if ($errors->has('password_nuevo_verif'))
                                            <div class="alert alert-danger mt-1 alert-validation-msg" role="alert">
                                                <div class="alert-body d-flex align-items-center">
                                                    <i data-feather="info" class="me-50"></i>
                                                    <span>{{ $errors->first('password_nuevo_verif') }}</span>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary me-1 mt-1">Guardar Cambios</button>
                                        <button type="reset" class="btn btn-outline-secondary mt-1">Cancelar</button>
                                    </div>
                                </div>
                            </form>
                            <!--/ form -->
                        </div>
                    </div>
                    <!--/ security -->
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
    <script src="{{ asset('js/tratamiento.js') }}"></script>
    <script src="{{ asset('js/sonrident.js') }}"></script>
@endpush
@push('scripts-page')
<script>
                //dom: '<"dataTables_wrapper dt-bootstrap"<"row"<"col-xl-7 d-block d-sm-flex d-xl-block justify-content-center"<"d-block d-lg-inline-flex mr-0 mr-sm-3"l><"d-block d-lg-inline-flex"B>><"col-xl-5 d-flex d-xl-block justify-content-center"fr>>t<"row"<"col-sm-5"i><"col-sm-7"p>>>',
$(document).ready( function () {
    $('#dt-ListaEspec').DataTable({
        dom: '<"dataTables_wrapper dt-bootstrap"<"row"<"col-xl-7 d-block d-sm-flex d-xl-block justify-content-center"<"d-block d-lg-inline-flex mr-0 mr-sm-3"l><"d-block d-lg-inline-flex"B>><"col-xl-5 d-flex d-xl-block justify-content-center"fr>>t<"row"<"col-sm-5"i><"col-sm-7"p>>>',
        language: {
            "url": "/app-assets/js/scripts/tables/spanish.json"
        },

    });
});
document.querySelector("#color").disabled = false
</script>
@endpush
