@extends('vuexy.layouts.default')

@section('title', 'Perfil')

@push('css-vendor')
    <link rel="stylesheet" type="text/css" href="{!! asset('app-assets/vendors/css/vendors.min.css') !!}">
    <link rel="stylesheet" type="text/css" href="{!! asset('app-assets/vendors/css/forms/select/select2.min.css') !!}">
    <link rel="stylesheet" type="text/css" href="{!! asset('app-assets/vendors/css/animate/animate.min.css') !!}">
    <link rel="stylesheet" type="text/css" href="{!! asset('app-assets/vendors/css/extensions/sweetalert2.min.css') !!}">
    <link rel="stylesheet" type="text/css" href="{!! asset('app-assets/vendors/css/tables/datatable/dataTables.bootstrap5.min.css') !!}">
    <link rel="stylesheet" type="text/css" href="{!! asset('app-assets/vendors/css/tables/datatable/responsive.bootstrap5.min.css') !!}">
    <link rel="stylesheet" type="text/css" href="{!! asset('app-assets/vendors/css/tables/datatable/buttons.bootstrap5.min.css') !!}">
    <link rel="stylesheet" type="text/css" href="{!! asset('app-assets/vendors/css/tables/datatable/rowGroup.bootstrap5.min.css') !!}">
@endpush
@push('css-page')
    <link rel="stylesheet" type="text/css" href="{!! asset('app-assets/css/core/menu/menu-types/vertical-menu.css') !!}">
    <link rel="stylesheet" type="text/css" href="{!! asset('app-assets/css/plugins/forms/form-validation.css') !!}">
    <link rel="stylesheet" type="text/css" href="{!! asset('app-assets/css/plugins/extensions/ext-component-sweet-alerts.css') !!}">
@endpush

@php
    $currentUser = Auth::user()
@endphp

@section('content')
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper p-0">
        <div class="content-header row">
        </div>
        <div class="content-body">
            <section class="app-user-view-account">
                <div class="row">
                    <!-- User Sidebar -->
                    <div class="col-xl-4 col-lg-5 col-md-5 order-1 order-md-0">
                        <!-- User Card -->
                        @include('vuexy.profiles.includes.usercard')
                        <!-- /User Card -->
                        <!-- Plan Card -->
{{--                        <div class="card border-primary">--}}
{{--                            <div class="card-body">--}}
{{--                                <div class="d-flex justify-content-between align-items-start">--}}
{{--                                    <span class="badge bg-light-primary">Standard</span>--}}
{{--                                    <div class="d-flex justify-content-center">--}}
{{--                                        <sup class="h5 pricing-currency text-primary mt-1 mb-0">$</sup>--}}
{{--                                        <span class="fw-bolder display-5 mb-0 text-primary">99</span>--}}
{{--                                        <sub class="pricing-duration font-small-4 ms-25 mt-auto mb-2">/month</sub>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <ul class="ps-1 mb-2">--}}
{{--                                    <li class="mb-50">10 Users</li>--}}
{{--                                    <li class="mb-50">Up to 10 GB storage</li>--}}
{{--                                    <li>Basic Support</li>--}}
{{--                                </ul>--}}
{{--                                <div class="d-flex justify-content-between align-items-center fw-bolder mb-50">--}}
{{--                                    <span>Days</span>--}}
{{--                                    <span>4 of 30 Days</span>--}}
{{--                                </div>--}}
{{--                                <div class="progress mb-50" style="height: 8px">--}}
{{--                                    <div class="progress-bar" role="progressbar" style="width: 80%" aria-valuenow="65" aria-valuemax="100" aria-valuemin="80"></div>--}}
{{--                                </div>--}}
{{--                                <span>4 days remaining</span>--}}
{{--                                <div class="d-grid w-100 mt-2">--}}
{{--                                    <button class="btn btn-primary" data-bs-target="#upgradePlanModal" data-bs-toggle="modal">--}}
{{--                                        Upgrade Plan--}}
{{--                                    </button>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                        <!-- /Plan Card -->
                    </div>
                    <!--/ User Sidebar -->

                    <!-- User Content -->
                    <div class="col-xl-8 col-lg-7 col-md-7 order-0 order-md-1">
                        <!-- User Pills -->
                        <ul class="nav nav-pills mb-2" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-bs-toggle="tab" href="#activitiesIcon">
                                    <i data-feather="list" class="font-medium-3 me-50"></i>
                                    <span class="fw-bold">{{ trans('profile.viewAccountActivities') }}</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#AccountIcon">
                                    <i data-feather="user" class="font-medium-3 me-50"></i>
                                    <span class="fw-bold">{{ trans('profile.editAccountTitle') }}</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#AdministrationIcon">
                                    <i data-feather="lock" class="font-medium-3 me-50"></i>
                                    <span class="fw-bold">{{ trans('profile.editAccountAdminTitle') }}</span>
                                </a>
                            </li>
{{--                            <li class="nav-item">--}}
{{--                                <a class="nav-link" data-bs-toggle="tab" href="#homeIcon2">--}}
{{--                                    <i data-feather="bookmark" class="font-medium-3 me-50"></i>--}}
{{--                                    <span class="fw-bold">Billing & Plans</span>--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                            <li class="nav-item">--}}
{{--                                <a class="nav-link" data-bs-toggle="tab" href="#homeIcon3">--}}
{{--                                    <i data-feather="bell" class="font-medium-3 me-50"></i><span class="fw-bold">Notifications</span>--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                            <li class="nav-item">--}}
{{--                                <a class="nav-link" href="app-user-view-connections.html">--}}
{{--                                    <i data-feather="link" class="font-medium-3 me-50"></i><span class="fw-bold">Connections</span>--}}
{{--                                </a>--}}
{{--                            </li>--}}
                        </ul>
                        <!--/ User Pills -->
                        <!-- Profile Menu -->
{{--                        <ul class="nav nav-tabs" role="tablist">--}}
{{--                            <li class="nav-item">--}}
{{--                                <a class="nav-link active" id="homeIcon-tab" data-bs-toggle="tab" href="#homeIcon" aria-controls="home" role="tab" aria-selected="true"><i data-feather="home"></i> Home</a>--}}
{{--                            </li>--}}
{{--                            <li class="nav-item">--}}
{{--                                <a class="nav-link" id="profileIcon-tab" data-bs-toggle="tab" href="#profileIcon" aria-controls="profile" role="tab" aria-selected="false"><i data-feather="tool"></i> Service</a>--}}
{{--                            </li>--}}
{{--                            <li class="nav-item">--}}
{{--                                <a href="disabledIcon" id="disabledIcon-tab" class="nav-link disabled"><i data-feather="eye-off"></i> Disabled</a>--}}
{{--                            </li>--}}
{{--                            <li class="nav-item">--}}
{{--                                <a class="nav-link" id="aboutIcon-tab" data-bs-toggle="tab" href="#aboutIcon" aria-controls="about" role="tab" aria-selected="false"><i data-feather="user"></i> Account</a>--}}
{{--                            </li>--}}
{{--                        </ul>--}}
                        <!--/ Profile Menu -->
                        <!-- Project table -->
{{--                        <div class="card">--}}
{{--                            <h4 class="card-header">User's Projects List</h4>--}}
{{--                            <div class="table-responsive">--}}
{{--                                <table class="table datatable-project">--}}
{{--                                    <thead>--}}
{{--                                    <tr>--}}
{{--                                        <th></th>--}}
{{--                                        <th>Project</th>--}}
{{--                                        <th class="text-nowrap">Total Task</th>--}}
{{--                                        <th>Progress</th>--}}
{{--                                        <th>Hours</th>--}}
{{--                                    </tr>--}}
{{--                                    </thead>--}}
{{--                                </table>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                        <!-- /Project table -->
                        <div class="tab-content">
                            <!-- Activity Timeline -->
                            <div class="tab-pane active" id="activitiesIcon" aria-labelledby="homeIcon-tab" role="tabpanel">
                                <div class="card">
                                    <h4 class="card-header">{{ trans('profile.viewAccountActivities') }}</h4>
                                    <div class="card-body pt-1">
                                        <ul class="timeline ms-50">
                                            <li class="timeline-item">
                                                <span class="timeline-point timeline-point-indicator"></span>
                                                <div class="timeline-event">
                                                    <div class="d-flex justify-content-between flex-sm-row flex-column mb-sm-0 mb-1">
                                                        <h6>User login</h6>
                                                        <span class="timeline-event-time me-1">12 min ago</span>
                                                    </div>
                                                    <p>User login at 2:12pm</p>
                                                </div>
                                            </li>
                                            <li class="timeline-item">
                                                <span class="timeline-point timeline-point-warning timeline-point-indicator"></span>
                                                <div class="timeline-event">
                                                    <div class="d-flex justify-content-between flex-sm-row flex-column mb-sm-0 mb-1">
                                                        <h6>Meeting with john</h6>
                                                        <span class="timeline-event-time me-1">45 min ago</span>
                                                    </div>
                                                    <p>React Project meeting with john @10:15am</p>
                                                    <div class="d-flex flex-row align-items-center mb-50">
                                                        <div class="avatar me-50">
                                                            <img src="../../../app-assets/images/portrait/small/avatar-s-7.jpg" alt="Avatar" width="38" height="38" />
                                                        </div>
                                                        <div class="user-info">
                                                            <h6 class="mb-0">Leona Watkins (Client)</h6>
                                                            <p class="mb-0">CEO of pixinvent</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="timeline-item">
                                                <span class="timeline-point timeline-point-info timeline-point-indicator"></span>
                                                <div class="timeline-event">
                                                    <div class="d-flex justify-content-between flex-sm-row flex-column mb-sm-0 mb-1">
                                                        <h6>Create a new react project for client</h6>
                                                        <span class="timeline-event-time me-1">2 day ago</span>
                                                    </div>
                                                    <p>Add files to new design folder</p>
                                                </div>
                                            </li>
                                            <li class="timeline-item">
                                                <span class="timeline-point timeline-point-danger timeline-point-indicator"></span>
                                                <div class="timeline-event">
                                                    <div class="d-flex justify-content-between flex-sm-row flex-column mb-sm-0 mb-1">
                                                        <h6>Create Invoices for client</h6>
                                                        <span class="timeline-event-time me-1">12 min ago</span>
                                                    </div>
                                                    <p class="mb-0">Create new Invoices and send to Leona Watkins</p>
                                                    <div class="d-flex flex-row align-items-center mt-50">
                                                        <img class="me-1" src="../../../app-assets/images/icons/pdf.png" alt="data.json" height="25" />
                                                        <h6 class="mb-0">Invoices.pdf</h6>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!-- /Activity Timeline -->
                            <!-- Profile Settings -->
                            <div class="tab-pane" id="AccountIcon" aria-labelledby="profileIcon-tab" role="tabpanel">
                                <div class="card">
                                    <h4 class="card-header">{{ trans('profile.editAccountTitle') }}</h4>
{{--                                    <form action="{!! array('ProfilesController@updateUserAccount', $user->id) !!}" class="form form-horizontal">--}}
                                    <div class="card-body">
                                        {!! Form::model($user, array('action' => array('ProfilesController@updateUserAccount', $user->id), 'method' => 'PUT', 'class' => 'form form-horizontal',  'id' => 'user_basics_form')) !!}
                                        <div class="row">
                                            <div class="col-12 col-md-6">
                                                <div class="mb-1">
                                                    <label class="form-label" for="first_name">{!! trans('forms.create_user_label_firstname') !!}</label>
                                                    <div class="input-group input-group-merge">
                                                        <span class="input-group-text"><i data-feather="user"></i></span>
                                                        <input
                                                            type="text"
                                                            id="first_name"
                                                            class="form-control {{ $errors->has('first_name') ? ' is-invalid ' : '' }}"
                                                            name="first_name"
                                                            placeholder="{!! trans('forms.create_user_label_firstname') !!}"
                                                            value="{{ $user->first_name }}"
                                                        />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="mb-1">
                                                    <label class="form-label" for="last_name">{!! trans('forms.create_user_label_lastname') !!}</label>
                                                    <div class="input-group input-group-merge">
                                                        <span class="input-group-text"><i data-feather="user"></i></span>
                                                        <input
                                                            type="text"
                                                            id="last_name"
                                                            class="form-control {{ $errors->has('last_name') ? ' is-invalid ' : '' }}"
                                                            name="last_name"
                                                            placeholder="{!! trans('forms.create_user_label_lastname') !!}"
                                                            value="{{ $user->last_name }}"
                                                        />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="name">{!! trans('forms.create_user_label_username') !!}</label>
                                                    <div class="input-group input-group-merge">
                                                        <span class="input-group-text"><i data-feather="user"></i></span>
                                                        <input
                                                            type="text"
                                                            id="name"
                                                            class="form-control {{ $errors->has('name') ? ' is-invalid ' : '' }}"
                                                            name="name"
                                                            placeholder="{!! trans('forms.create_user_label_username') !!}"
                                                            value="{{ $user->name }}"
                                                        />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="email">{!! trans('forms.create_user_label_email') !!}</label>
                                                    <div class="input-group input-group-merge">
                                                        <span class="input-group-text"><i data-feather="mail"></i></span>
                                                        <input
                                                            type="text"
                                                            id="email"
                                                            class="form-control {{ $errors->has('name') ? ' is-invalid ' : '' }}"
                                                            name="email"
                                                            placeholder="{!! trans('forms.create_user_label_email') !!}"
                                                            value="{{ $user->email }}"
                                                        />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                {!! Form::button(
                                                    '<i class="fa fa-fw fa-save" aria-hidden="true"></i> ' . trans('profile.submitProfileButton'),
                                                     array(
                                                        'class'             => 'btn btn-success disabled',
                                                        'id'                => 'account_save_trigger',
                                                        'disabled'          => true,
                                                        'type'              => 'button',
                                                        'data-submit'       => trans('profile.submitProfileButton'),
                                                        'data-bs-target'    => '#confirmForm',
                                                        'data-modalClass'   => 'modal-success',
                                                        'data-bs-toggle'    => 'modal',
                                                        'data-title'        => trans('modals.edit_user__modal_text_confirm_title'),
                                                        'data-message'      => trans('modals.edit_user__modal_text_confirm_message')
                                                )) !!}
{{--                                                <button type="button" class="btn btn-primary" data-bs-target="#exampleModal" data-bs-toggle="modal">--}}
{{--                                                    Launch demo modal--}}
{{--                                                </button>--}}
                                            </div>
                                        </div>
                                        {!! Form::close() !!}
                                    </div>
                                </div>
                            </div>
                            <!-- /Profile Settings -->
                            <!-- Administration Settings -->
                            <div class="tab-pane" id="AdministrationIcon" aria-labelledby="profileIcon-tab" role="tabpanel">
                                <div class="card">
                                    <h4 class="card-header">{{ trans('profile.editAccountAdminTitle') }}</h4>
                                </div>
                            </div>
                            <!-- /Administration Settings -->
                        </div>
                        <!-- Invoice table -->
{{--                        <div class="card">--}}
{{--                            <table class="invoice-table table text-nowrap">--}}
{{--                                <thead>--}}
{{--                                <tr>--}}
{{--                                    <th></th>--}}
{{--                                    <th>#ID</th>--}}
{{--                                    <th><i data-feather="trending-up"></i></th>--}}
{{--                                    <th>TOTAL Paid</th>--}}
{{--                                    <th class="text-truncate">Issued Date</th>--}}
{{--                                    <th class="cell-fit">Actions</th>--}}
{{--                                </tr>--}}
{{--                                </thead>--}}
{{--                            </table>--}}
{{--                        </div>--}}
                        <!-- /Invoice table -->
                    </div>
                    <!--/ User Content -->
                </div>
            </section>
            <!-- User Modal -->
            @include('vuexy.profiles.includes.usermodal')
            <!-- /User Modal -->
        </div>
    </div>
@endsection

@push('scripts-vendor')
    <script src="{!! asset('app-assets/vendors/js/forms/select/select2.full.min.js') !!}"></script>
    <script src="{!! asset('app-assets/vendors/js/forms/cleave/cleave.min.js') !!}"></script>
    <script src="{!! asset('app-assets/vendors/js/forms/cleave/addons/cleave-phone.us.js') !!}"></script>
    <script src="{!! asset('app-assets/vendors/js/forms/validation/jquery.validate.min.js') !!}"></script>
    <script src="{!! asset('app-assets/vendors/js/extensions/moment.min.js') !!}"></script>
    <script src="{!! asset('app-assets/vendors/js/tables/datatable/jquery.dataTables.min.js') !!}"></script>
    <script src="{!! asset('app-assets/vendors/js/tables/datatable/dataTables.bootstrap5.min.js') !!}"></script>
    <script src="{!! asset('app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js') !!}"></script>
    <script src="{!! asset('app-assets/vendors/js/tables/datatable/responsive.bootstrap5.js') !!}"></script>
    <script src="{!! asset('app-assets/vendors/js/tables/datatable/datatables.buttons.min.js') !!}"></script>
    <script src="{!! asset('app-assets/vendors/js/tables/datatable/jszip.min.js') !!}"></script>
    <script src="{!! asset('app-assets/vendors/js/tables/datatable/pdfmake.min.js') !!}"></script>
    <script src="{!! asset('app-assets/vendors/js/tables/datatable/vfs_fonts.js') !!}"></script>
    <script src="{!! asset('app-assets/vendors/js/tables/datatable/buttons.html5.min.js') !!}"></script>
    <script src="{!! asset('app-assets/vendors/js/tables/datatable/buttons.print.min.js') !!}"></script>
    <script src="{!! asset('app-assets/vendors/js/tables/datatable/dataTables.rowGroup.min.js') !!}"></script>
    <script src="{!! asset('app-assets/vendors/js/extensions/sweetalert2.all.min.js') !!}"></script>
    <script src="{!! asset('app-assets/vendors/js/extensions/polyfill.min.js') !!}"></script>
@endpush
@push('scripts-page')
{{--    <script src="{!! asset('app-assets/js/scripts/pages/modal-edit-user.js') !!}"></script>--}}
{{--    <script src="{!! asset('app-assets/js/scripts/pages/app-user-view-account.js') !!}"></script>--}}
{{--    <script src="{!! asset('app-assets/js/scripts/pages/app-user-view.js') !!}"></script>--}}
    <script src="{!! asset('assets/js/jquery.alterclass.js') !!}"></script>
    @include('scripts.form-modal-script')
{{--    @if(config('settings.googleMapsAPIStatus'))--}}
{{--        @include('scripts.gmaps-address-lookup-api3')--}}
{{--    @endif--}}
{{--    @include('scripts.user-avatar-dz')--}}
    <script type="text/javascript">
        function abre(){
            $('#exampleModal').modal('toggle');
            return false;
        }
        //
        $('.dropdown-menu li a').click(function() {
            $('.dropdown-menu li').removeClass('active');
        });

        $('.profile-trigger').click(function() {
            $('.panel').alterClass('card-*', 'card-default');
        });

        $('.settings-trigger').click(function() {
            $('.panel').alterClass('card-*', 'card-info');
        });

        $('.admin-trigger').click(function() {
            $('.panel').alterClass('card-*', 'card-warning');
            $('.edit_account .nav-pills li, .edit_account .tab-pane').removeClass('active');
            $('#changepw')
                .addClass('active')
                .addClass('in');
            $('.change-pw').addClass('active');
        });

        $('.warning-pill-trigger').click(function() {
            $('.panel').alterClass('card-*', 'card-warning');
        });

        $('.danger-pill-trigger').click(function() {
            $('.panel').alterClass('card-*', 'card-danger');
        });

        $('#user_basics_form').on('keyup change', 'input, select, textarea', function(){
            $('#account_save_trigger').attr('disabled', false).removeClass('disabled').show();
        });

        $('#user_profile_form').on('keyup change', 'input, select, textarea', function(){
            $('#confirmFormSave').attr('disabled', false).removeClass('disabled').show();
        });

        $('#checkConfirmDelete').change(function() {
            var submitDelete = $('#delete_account_trigger');
            var self = $(this);

            if (self.is(':checked')) {
                submitDelete.attr('disabled', false);
            }
            else {
                submitDelete.attr('disabled', true);
            }
        });

        // $("#password_confirmation").keyup(function() {
        //     checkPasswordMatch();
        // });
        //
        // $("#password, #password_confirmation").keyup(function() {
        //     enableSubmitPWCheck();
        // });
        //
        // $('#password, #password_confirmation').hidePassword(true);
        //
        // $('#password').password({
        //     shortPass: 'The password is too short',
        //     badPass: 'Weak - Try combining letters & numbers',
        //     goodPass: 'Medium - Try using special charecters',
        //     strongPass: 'Strong password',
        //     containsUsername: 'The password contains the username',
        //     enterPass: false,
        //     showPercent: false,
        //     showText: true,
        //     animate: true,
        //     animateSpeed: 50,
        //     username: false, // select the username field (selector or jQuery instance) for better password checks
        //     usernamePartialMatch: true,
        //     minimumLength: 6
        // });
        //
        // function checkPasswordMatch() {
        //     var password = $("#password").val();
        //     var confirmPassword = $("#password_confirmation").val();
        //     if (password != confirmPassword) {
        //         $("#pw_status").html("Passwords do not match!");
        //     }
        //     else {
        //         $("#pw_status").html("Passwords match.");
        //     }
        // }
        //
        // function enableSubmitPWCheck() {
        //     var password = $("#password").val();
        //     var confirmPassword = $("#password_confirmation").val();
        //     var submitChange = $('#pw_save_trigger');
        //     if (password != confirmPassword) {
        //         submitChange.attr('disabled', true);
        //     }
        //     else {
        //         submitChange.attr('disabled', false);
        //     }
        // }
    </script>
    <script>
        $(window).on('load', function() {
            if (feather) {
                feather.replace({
                    width: 14,
                    height: 14
                });
            }
        });
    </script>
@endpush
