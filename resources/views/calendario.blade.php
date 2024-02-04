@extends('vuexy.layouts.default', ['activePage' => 'home'])
@section('title','Calendario')
@push('css-vendor')
 <!-- BEGIN: Vendor CSS-->
 <link rel="stylesheet" type="text/css" href="{!! asset('app-assets/vendors/css/calendars/fullcalendar.min.css') !!}">
 <link rel="stylesheet" type="text/css" href="{!! asset('app-assets/vendors/css/pickers/flatpickr/flatpickr.min.css') !!}">
 <!-- END: Vendor CSS-->
 <!-- BEGIN: Page CSS-->
  <link rel="stylesheet" type="text/css" href="{!! asset('app-assets/css/pages/app-calendar.css') !!}">
 <link rel="stylesheet" type="text/css" href="{!! asset('app-assets/css/plugins/forms/form-validation.css') !!}">
 <!-- END: Page CSS-->
@endpush
@section('content')
<div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <!-- Full calendar start -->
                <section>
                    <div class="app-calendar overflow-hidden border">
                        <div class="row g-0">

                            <!-- Calendar -->
                            <div class="col position-relative">
                                <div class="card shadow-none border-0 mb-0 rounded-0">
                                    <div class="card-body pb-0">
                                        <div id="calendar"></div>
                                    </div>
                                </div>
                            </div>
                            <!-- /Calendar -->
                            <div class="body-content-overlay"></div>
                        </div>
                    </div>
                </section>
                <!-- Full calendar end -->

            </div>
        </div>
@endsection
@push('scripts-vendor')
 <!-- BEGIN: Page Vendor JS-->
 <script src="{!! asset('app-assets/vendors/js/calendar/fullcalendar.min.js') !!}"></script>
 <script src="{!! asset('app-assets/vendors/js/calendar/es.js') !!}"></script>
 <!-- END: Page Vendor JS-->

 <!-- BEGIN: Page JS-->
 <script src="{!! asset('app-assets/js/scripts/pages/app-calendar-events.js') !!}"></script>
 <script src="{!! asset('app-assets/js/scripts/pages/app-calendar.js') !!}"></script>
 <!-- END: Page JS-->
@endpush
