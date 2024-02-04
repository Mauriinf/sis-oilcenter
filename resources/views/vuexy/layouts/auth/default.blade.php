<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" class="loading semi-dark-layout" data-layout="semi-dark-layout" data-textdirection="ltr">
<!-- BEGIN: Head-->
<head>
    @include('vuexy.includes.head')
</head>
<!-- END: Head-->
<!--begin::Body-->
<body class="vertical-layout vertical-menu-modern blank-page navbar-floating footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="blank-page">
    <!-- BEGIN: Content-->
    <div class="app-content content">
        @yield('content')
    </div>
    <!-- END: Content-->
    <!--BEGIN:Javascript-->
    @include('vuexy.includes.page-js')
    <!--END:Javascript-->
</body>
</html>
