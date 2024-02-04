<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" class="loading semi-dark-layout" data-layout="semi-dark-layout" data-textdirection="ltr">
<!-- BEGIN: Head-->
<head>
    @include('vuexy.includes.head')
</head>
<!-- END: Head-->
<!--begin::Body-->
<body class="vertical-layout vertical-menu-modern  navbar-floating footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="">
    <!-- BEGIN: Header-->
    @include('vuexy.layouts.topnavbar')
    <!-- END: Header-->
    <!-- BEGIN: Main Menu-->
    @include('vuexy.layouts.navigation')
    <!-- END: Main Menu-->
    <!-- BEGIN: Content-->
    <div class="app-content content">
        @yield('content')
    </div>
    <!-- END: Content-->
    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>
    <!-- BEGIN: Footer-->
    @include('vuexy.layouts.footer')
    @include('vuexy.includes.component.scroll-top-btn')
    <!-- END: Footer-->
    <!--BEGIN:Javascript-->
    @include('vuexy.includes.page-js')
    <!--END:Javascript-->
</body>
<script>
	var URL_BASE = "{{URL("/")}}";

</script>
</html>
