@extends('layouts.authentication.master')
@section('title', 'Employer Login')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
@endsection

@section('content')
    <div class="container-fluid p-0">
        <div class="row m-0">
            <div class="col-12 p-0">
                <div class="login-card">
                    <div>
                        <div class="text-center">
                            <a class="logo" href="{{ route('index') }}">
                                <x-application-logo />
                            </a>
                        </div>
                        <div class="login-main">
                            <form method="POST" action="{{ route('employer.login') }}">
                                @csrf
                                <h4>Sign in to your Employer Account</h4>
                                <p>Enter your email & password to log in</p>

                                <!-- Email Field -->
                                <div class="form-group">
                                    <label class="col-form-label">Email Address</label>
                                    <input class="form-control" type="email" name="email" required
                                        placeholder="example@gmail.com">
                                </div>

                                <!-- Password Field -->
                                <div class="form-group">
                                    <label class="col-form-label">Password</label>
                                    <input class="form-control" type="password" name="password" required=""
                                        placeholder="*********">
                                    <div class="show-hide"><span class="show"> </span></div>
                                </div>

                                <!-- Error Message -->
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        {{ $errors->first('email') }}
                                    </div>
                                @endif

                                <!-- Remember Me and Forgot Password -->
                                <div class="form-group mb-0">
                                    <div class="checkbox p-0">
                                        <input id="checkbox1" class="checkbox" type="checkbox" name="remember">
                                        <label class="text-muted" for="checkbox1">Remember password</label>
                                    </div>
                                    <a class="link" href="{{ route('forget-password') }}">Forgot password?</a>
                                </div>

                                <!-- Submit Button -->
                                <button class="btn btn-primary btn-block mt-3" type="submit">Sign in</button>



                                <!-- Create Account Link -->
                                <p class="mt-4 mb-0">
                                    Don't have an account?
                                    <a class="ms-2" href="{{ route('employer.register') }}">Create Account</a>
                                </p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        // Add functionality for the "Show" password toggle
        document.querySelector('.show-hide .show').addEventListener('click', function() {
            const passwordField = document.querySelector('input[name="password"]');
            if (passwordField.type === "password") {
                passwordField.type = "text";
                this.textContent = "Hide";
            } else {
                passwordField.type = "password";
                this.textContent = "Show";
            }
        });
    </script>
@endsection
