@extends('vuexy.layouts.default', ['activePage' => 'home'])
@section('title','Principal')
@push('css-vendor')

@endpush
@section('content')
<div class="content-wrapper container-xxl p-0">
@role('Admin')
    <div class="row">
        <div class="col-lg-3 col-sm-6">
            <div class="card">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <h3 class="fw-bolder mb-75">{{$users->count()}}</h3>
                        <span>Total Usuarios</span>
                    </div>
                    <div class="avatar bg-light-primary p-50">
                        <span class="avatar-content">
                            <i data-feather="user" class="font-medium-4"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6">
            <div class="card">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <h3 class="fw-bolder mb-75">{{$users->count()}}</h3>
                        <span>Total Usuarios</span>
                    </div>
                    <div class="avatar bg-light-danger p-50">
                        <span class="avatar-content">
                            <i data-feather="headphones" class="font-medium-4"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6">
            <div class="card">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <h3 class="fw-bolder mb-75">{{$users->count()}}</h3>
                        <span>Total Usuarios</span>
                    </div>
                    <div class="avatar bg-light-success p-50">
                        <span class="avatar-content">
                            <i data-feather="calendar" class="font-medium-4"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6">
            <div class="card">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <h3 class="fw-bolder mb-75">{{$users->count()}}</h3>
                        <span>Total Usuarios</span>
                    </div>
                    <div class="avatar bg-light-warning p-50">
                        <span class="avatar-content">
                            <i data-feather="users" class="font-medium-4"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endrole
</div>
@endsection
@push('scripts-vendor')
<!-- BEGIN: Page Vendor JS-->
<script src="{!! asset('app-assets/vendors/js/charts/chart.min.js') !!}"></script>
<script src="{!! asset('app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js') !!}"></script>
<!-- END: Page Vendor JS-->
<!-- BEGIN: Page JS-->
<script src="{!! asset('app-assets/js/scripts/charts/chart-chartjs.js') !!}"></script>
<!-- END: Page JS-->


@endpush

