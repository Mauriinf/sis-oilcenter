    <meta charset="utf-8" />
    <title>{{ config('sistema.nombre') }} | @yield('title')</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta content="" name="description" />
    <meta content="" name="Mauricio Nina" />
    {{-- CSRF Token --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="apple-touch-icon" href="{!! asset('app-assets/images/ico/apple-icon-120.png') !!}">
    <link rel="shortcut icon" type="image/x-icon" href="{!! asset('app-assets/images/ico/favicon.svg') !!}">
    <link rel="icon" type="image/png" href="{!! asset('assets/img/favicon.png') !!}">
    <!--begin::Fonts-->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600" rel="stylesheet">
    <!--end::Fonts-->
    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{!! asset('app-assets/vendors/css/vendors.min.css') !!}">
    <link rel="stylesheet" type="text/css" href="{!! asset('app-assets/vendors/css/forms/select/select2.min.css') !!}">
    @stack('css-vendor')
    <!-- END: Vendor CSS-->
    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{!! asset('app-assets/css/bootstrap.css') !!}">
    <link rel="stylesheet" type="text/css" href="{!! asset('app-assets/css/bootstrap-extended.css') !!}">
    <link rel="stylesheet" type="text/css" href="{!! asset('app-assets/css/colors.css') !!}">
    <link rel="stylesheet" type="text/css" href="{!! asset('app-assets/css/components.css') !!}">
    <link rel="stylesheet" type="text/css" href="{!! asset('app-assets/css/themes/dark-layout.css') !!}">
    <link rel="stylesheet" type="text/css" href="{!! asset('app-assets/css/themes/bordered-layout.css') !!}">
    <link rel="stylesheet" type="text/css" href="{!! asset('app-assets/css/themes/semi-dark-layout.css') !!}">

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{!! asset('app-assets/css/core/menu/menu-types/vertical-menu.css') !!}">
    <link rel="stylesheet" type="text/css" href="{!! asset('app-assets/css/plugins/charts/chart-apex.css') !!}">
    <link rel="stylesheet" type="text/css" href="{!! asset('app-assets/css/plugins/extensions/ext-component-toastr.css') !!}">
    <!-- END: Page CSS-->
    <!-- END: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{!! asset('app-assets/vendors/css/pickers/pickadate/pickadate.css') !!}">
    <link rel="stylesheet" type="text/css" href="{!! asset('app-assets/vendors/css/pickers/flatpickr/flatpickr.min.css') !!}">
    <link rel="stylesheet" type="text/css" href="{!! asset('app-assets/css/plugins/forms/pickers/form-flat-pickr.css') !!}">
    <link rel="stylesheet" type="text/css" href="{!! asset('app-assets/css/plugins/forms/pickers/form-pickadate.css') !!}">
    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{!! asset('app-assets/vendors/css/pickers/pickadate/pickadate.css') !!}">
    <link rel="stylesheet" type="text/css" href="{!! asset('app-assets/css/plugins/forms/pickers/form-pickadate.css') !!}">
    {{-- Scripts --}}
    <script>
        window.Laravel = {!! json_encode([
                'csrfToken' => csrf_token(),
        ]) !!};
    </script>
    @stack('css-page')
    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{!! asset('assets/css/style.css') !!}">
    <!-- END: Custom CSS-->

