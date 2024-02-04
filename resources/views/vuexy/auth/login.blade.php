@extends('vuexy.layouts.auth.default')

@section('title', 'Login')

@section('content')
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body">
            <div class="auth-wrapper auth-v2">
                <div class="auth-inner row m-0">
                    <!-- Brand logo--><a class="brand-logo" href="{{ URL::to('/') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" height="35">
                            <path fill="currentColor" d="M488 248C488 111 377 0 240 0S0 111 0 248s111 248 240 248 248-111 248-248zm-400 0c0-119 97-216 216-216s216 97 216 216H88zm344 0c0 119-97 216-216 216s-216-97-216-216h432z"/>
                          </svg>
                        <h2 class="brand-text text-primary ms-1">{{ config('sistema.nombre') }}</h2>
                    </a>
                    <!-- /Brand logo-->
                    <!-- Left Text-->
                    <div class="d-none d-lg-flex col-lg-8 align-items-center p-5">
                        <div class="w-100 d-lg-flex align-items-center justify-content-center px-5"><img class="img-fluid" src="/app-assets/images/pages/login-v2.svg" alt="Login V2" /></div>
                    </div>
                    <!-- /Left Text-->
                    <!-- Login-->
                    <div class="d-flex col-lg-4 align-items-center auth-bg px-2 p-lg-5">
                        <div class="col-12 col-sm-8 col-md-6 col-lg-12 px-xl-2 mx-auto">
                            <h2 class="card-title fw-bold mb-1">Bienvenido a {{ config('sistema.nombre') }}</h2>
                            <p class="card-text mb-2">Ingrese sus datos de usuario</p>
                            <form class="auth-login-form mt-2" action="{{ route('login') }}" method="POST">
                                @csrf
                                <div class="mb-1">
                                    <label class="form-label" for="username">{{ __('Username') }}</label>
                                    <input type="text" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" id="email" name="username"  aria-describedby="login-username" autofocus="" tabindex="1" value="{{ old('username') }}"/>
                                    @if ($errors->has('username'))
                                    <div class="alert alert-danger mt-1 alert-validation-msg" role="alert">
                                        <div class="alert-body d-flex align-items-center">
                                            <i data-feather="info" class="me-50"></i>
                                            <span>{{ $errors->first('username') }}</span>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                                <div class="mb-1">
                                    {{-- <div class="d-flex justify-content-between">
                                        <label class="form-label" for="password">{{ __('Password') }}</label><a href="{{ route('password.request') }}"><small>{{ __('auth.forgot') }}</small></a>
                                    </div> --}}
                                    <div class="input-group input-group-merge form-password-toggle">
                                        <input type="password" class="form-control form-control-merge{{ $errors->has('password') ? ' is-invalid' : '' }}" id="password" name="password" placeholder="············" aria-describedby="login-password" tabindex="2" /><span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                                    </div>
                                    @if ($errors->has('password'))
                                        <div class="alert alert-danger mt-1 alert-validation-msg" role="alert">
                                            <div class="alert-body d-flex align-items-center">
                                                <i data-feather="info" class="me-50"></i>
                                                <span><strong>{{ $errors->first('password') }}</strong></span>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                <div class="mb-1">
                                    <div class="form-check">
                                        <input class="form-check-input" id="remember-me" type="checkbox" tabindex="3" {{ old('remember') ? 'checked' : '' }} />
                                        <label class="form-check-label" for="remember-me"> {{ __('Recuerdame') }}</label>
                                    </div>
                                </div>
                                <button class="btn btn-primary w-100" tabindex="4">{{ __('Login') }}</button>
                            </form>
{{--                            <p class="text-center mt-2"><span>New on our platform?</span><a href="auth-register-cover.html"><span>&nbsp;Create an account</span></a></p>--}}
                            {{-- <div class="divider my-2">
                                <div class="divider-text">O ingrese con</div>
                            </div>
                            <div class="auth-footer-btn d-flex justify-content-center"><a class="btn btn-facebook" href="#"><i data-feather="facebook"></i></a><a class="btn btn-twitter white" href="#"><i data-feather="twitter"></i></a><a class="btn btn-google" href="#"><i data-feather="mail"></i></a><a class="btn btn-github" href="#"><i data-feather="github"></i></a></div> --}}
                        </div>
                    </div>
                    <!-- /Login-->
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts-vendor')
    <script src="{!! asset('app-assets/vendors/js/forms/validation/jquery.validate.min.js') !!}"></script>
@endpush
@push('scripts-page')

    <script>
        $(window).on('load', function() {
            if (feather) {
                feather.replace({
                    width: 14,
                    height: 14
                });
            }
        })
    </script>
@endpush
