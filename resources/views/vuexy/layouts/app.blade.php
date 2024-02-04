<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INSPINIA - @yield('title') </title>

    <link href="{!! asset('/assets/css/bootstrap.min.css') !!}" rel="stylesheet">
    <link href="{!! asset('/assets/font-awesome/css/font-awesome.css') !!}" rel="stylesheet">
    <link href="{!! asset('/assets/css/animate.css') !!}" rel="stylesheet">
    <link href="{!! asset('/assets/css/style.css') !!} " rel="stylesheet">
{{--    <link rel="stylesheet" href="{!! asset('/assets/css/vendor.css') !!}" />--}}
{{--    <link rel="stylesheet" href="{!! asset('/assets/css/app.css') !!}" />--}}
    @stack('css')
</head>
<body>

  <!-- Wrapper-->
    <div id="wrapper">

        <!-- Navigation -->
        @include('layouts.navigation')

        <!-- Page wraper -->
        <div id="page-wrapper" class="gray-bg">

            <!-- Page wrapper -->
            @include('layouts.topnavbar')

            <!-- Main view  -->
            @yield('content')

            <!-- Footer -->
            @include('layouts.footer')

        </div>
        <!-- End page wrapper-->

    </div>
    <!-- End wrapper-->

{{--<script src="{!! asset('/js/app.js') !!}" type="text/javascript"></script>--}}
  <!-- Mainly scripts -->
  <script src="{!! asset('/assets/js/jquery-3.1.1.min.js') !!}"></script>
  <script src="{!! asset('/assets/js/popper.min.js') !!}"></script>
  <script src="{!! asset('/assets/js/bootstrap.js') !!}"></script>
  <script src="{!! asset('/assets/js/plugins/metisMenu/jquery.metisMenu.js') !!}"></script>
  <script src="{!! asset('/assets/js/plugins/slimscroll/jquery.slimscroll.min.js') !!}"></script>
  <!-- Custom and plugin javascript -->
  <script src="{!! asset('/assets/js/inspinia.js') !!}"></script>
  <script src="{!! asset('/assets/js/plugins/pace/pace.min.js') !!}"></script>

  @stack('scripts')
{{--@section('scripts')--}}
{{--@show--}}

</body>
</html>
