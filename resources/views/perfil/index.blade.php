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
                        <!-- profile -->
                        <div class="card">
                            <div class="card-header border-bottom">
                                <h4 class="card-title">Mi Perfil</h4>
                            </div>
                            <div class="card-body py-2 my-25">
                                <form class="validate-form pt-50" method="POST" action="{{ route('perfil.actualizar') }}" enctype="multipart/form-data">
                                <!-- header section -->
                                <div class="d-flex">
                                    <a href="#" class="me-25">
                                        <img src="{{ Auth::user()->avatar ? asset('avatar/'.Auth::user()->avatar) : asset('images/user.png')}}" id="avatar-img" class="uploadedAvatar rounded me-50" alt="profile image" height="100" width="100" />
                                    </a>
                                    <!-- upload and reset button -->
                                    <div class="d-flex align-items-end mt-75 ms-1">
                                        <div>
                                            <label for="avatar" class="btn btn-sm btn-primary mb-75 me-75">Subir</label>
                                            <input type="file" id="avatar" name="avatar" hidden accept="image/*" />
                                            <button type="button" id="avatar-reset" class="btn btn-sm btn-outline-secondary mb-75">Cancelar</button>
                                            <p class="mb-0">Tipos de archivos permitidos: png, jpg, jpeg.</p>
                                        </div>
                                    </div>
                                    <!--/ upload and reset button -->
                                </div>
                                <!--/ header section -->
                                
                                <!-- form -->
                                
                                    @csrf
                                    @method('PUT')
                                    <div class="row mt-2">
                                        <div class="col-12 col-sm-4 mb-1">
                                            <label class="form-label" for="paterno">Apellido Paterno</label>
                                            <input type="text" class="form-control" id="paterno" name="paterno" placeholder="John" value="{{ Auth::user()->paterno }}" readonly data-msg="Please enter first name" />
                                        </div>
                                        <div class="col-12 col-sm-4 mb-1">
                                            <label class="form-label" for="materno">Apellido Materno</label>
                                            <input type="text" class="form-control" id="materno" name="materno" placeholder="Doe" value="{{ Auth::user()->materno }}" readonly data-msg="Please enter last name" />
                                        </div>
                                        <div class="col-12 col-sm-4 mb-1">
                                            <label class="form-label" for="nombres">Nombres</label>
                                            <input type="text" class="form-control" id="nombres" name="nombres" placeholder="doe" value="{{ Auth::user()->nombres }}" readonly />
                                        </div>
                                        <div class="col-12 col-sm-4 mb-1">
                                            <label class="form-label" for="accountAddress">Fecha de Nacimiento</label>
                                            <input type="text" class="form-control" id="nacimiento" name="nacimiento" placeholder="Fecha de nacimiento" value="{{ Auth::user()->fec_nac }}" readonly/>
                                        </div>
                                        <div class="col-12 col-sm-4 mb-1">
                                            <label class="form-label" for="telefono">Telefono</label>
                                            <input type="text" class="form-control" id="telefono" name="telefono" placeholder="78142535" value="{{ Auth::user()->telefono }}"/>
                                            @if ($errors->has('telefono'))
                                            <div class="alert alert-danger mt-1 alert-validation-msg" role="alert">
                                                <div class="alert-body d-flex align-items-center">
                                                    <i data-feather="info" class="me-50"></i>
                                                    <span>{{ $errors->first('telefono') }}</span>
                                                </div>
                                            </div>
                                            @endif
                                        </div>
                                        <div class="col-12 col-sm-4 mb-1">
                                            <label class="form-label" for="usuario">Usuario</label>
                                            <input type="text" class="form-control" id="usuario" name="usuario" placeholder="username" value="{{ Auth::user()->username }}" readonly/>
                                        </div>
                                        <div class="col-12 col-sm-6 mb-1">
                                            <label class="form-label" for="email">Correo Electronico</label>
                                            <input type="text" class="form-control" id="email" name="email" placeholder="correo@mail.com" value="{{ Auth::user()->email }}" />
                                            @if ($errors->has('email'))
                                            <div class="alert alert-danger mt-1 alert-validation-msg" role="alert">
                                                <div class="alert-body d-flex align-items-center">
                                                    <i data-feather="info" class="me-50"></i>
                                                    <span>{{ $errors->first('email') }}</span>
                                                </div>
                                            </div>
                                            @endif
                                        </div>
                                        <div class="col-12 col-sm-6 mb-1">
                                            <label class="form-label" for="accountPhoneNumber">Direccion</label>
                                            <input type="text" class="form-control" id="direccion" name="direccion" placeholder="direccion" value="{{ Auth::user()->direccion }}" />
                                            @if ($errors->has('direccion'))
                                            <div class="alert alert-danger mt-1 alert-validation-msg" role="alert">
                                                <div class="alert-body d-flex align-items-center">
                                                    <i data-feather="info" class="me-50"></i>
                                                    <span>{{ $errors->first('direccion') }}</span>
                                                </div>
                                            </div>
                                            @endif
                                        </div>
                                        <div class="col-12">
                                            <button type="submit" class="btn btn-primary mt-1 me-1">Actualizar Perfil</button>
                                            <button type="reset" class="btn btn-outline-secondary mt-1">Descartar Cambios</button>
                                        </div>
                                    </div>
                                </form>
                                <!--/ form -->
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
    <script src="{{ asset('js/tratamiento.js') }}"></script>
    <script src="{{ asset('js/sonrident.js') }}"></script>
@endpush
@push('scripts-page')
<script>
                //dom: '<"dataTables_wrapper dt-bootstrap"<"row"<"col-xl-7 d-block d-sm-flex d-xl-block justify-content-center"<"d-block d-lg-inline-flex mr-0 mr-sm-3"l><"d-block d-lg-inline-flex"B>><"col-xl-5 d-flex d-xl-block justify-content-center"fr>>t<"row"<"col-sm-5"i><"col-sm-7"p>>>',
$(document).ready( function () {
    const $seleccionArchivos = document.querySelector("#avatar"),
    $imagenPrevisualizacion = document.querySelector("#avatar-img");

    // Escuchar cuando cambie
    $seleccionArchivos.addEventListener("change", () => {
    // Los archivos seleccionados, pueden ser muchos o uno
    const archivos = $seleccionArchivos.files;
    // Si no hay archivos salimos de la función y quitamos la imagen
    if (!archivos || !archivos.length) {
        $imagenPrevisualizacion.src = "";
        return;
    }
    // Ahora tomamos el primer archivo, el cual vamos a previsualizar
    const primerArchivo = archivos[0];
    // Lo convertimos a un objeto de tipo objectURL
    const objectURL = URL.createObjectURL(primerArchivo);
    // Y a la fuente de la imagen le ponemos el objectURL
    $imagenPrevisualizacion.src = objectURL;
    });
});

</script>
@endpush
