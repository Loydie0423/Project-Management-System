@extends('auth.layouts.app')

@section('content')
    <div class="d-flex align-items-center justify-content-center auth-container">
        <div class="container auth-form-container">
            <div class="row h-100">
                <div class="col login-leftside-container h-100">
                    <div class="d-flex flex-column align-items-center justify-content-center gap-2">
                        <img src="{{ asset('images/logo-icon.png') }}" alt="login-logo" class="auth-logo" height="100"
                            width="100">
                        <p class="login-brand-name">Project Management System</p>
                    </div>
                </div>
                <div class="col login-rigthside-container h-100 w-100">
                    <div class="d-flex flex-column align-items-center justify-content-center h-100">
                        <div class="mt-2">
                            <p class="sign-in-label">Sign In</p>
                        </div>
                        <div class="login-field-form-group my-1">
                            <input type="text" class="form-control login-field" placeholder="Username" id="username">
                            <div class="icon-container">
                                <i class="fas fa-user"></i>
                            </div>
                        </div>
                        <div class="login-field-form-group my-1">
                            <input type="password" class="form-control login-field" placeholder="Password" id="password">
                            <div class="icon-container">
                                <i class="fas fa-lock"></i>
                            </div>
                        </div>
                        <div class="login-other-function my-1">
                            <div class="remeber-me-container pl-3">
                                <input type="checkbox" class="form-check-input">
                                <label class="remember-me-label">Remember me</label>
                            </div>
                            <a href="{{ route('password-reset.send-reset-link.index') }}" class="reset-password-link">Reset
                                Password</a>
                        </div>

                        <div class="login-button-container mt-3">
                            <button class="btn btn-primary login-btn">Sign In</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
