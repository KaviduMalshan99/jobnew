@extends('layouts.authentication.master')
@section('title', 'Login')

@section('css')
@endsection

@section('style')
@endsection

@section('content')
    <div class="container-fluid p-0">
        <div class="row m-0">
            <div class="col-12 p-0">
                <div class="login-card">
                    <div>
                        <div>
                            <a class="logo" href="{{ route('index') }}">
                                <x-application-logo />
                            </a>
                        </div>
                        <div class="login-main">
                            <form method="POST" action="{{ route('admin.login') }}">
                                @csrf
                                <h4>Sign in to your account</h4>
                                <p>Enter your email & password to login</p>

                                <!-- Email Address Field -->
                                <div class="form-group">
                                    <label class="col-form-label">Email Address</label>
                                    <input class="form-control" type="email" name="email" required
                                        placeholder="example@gmail.com">
                                </div>

                                <!-- Password Field -->
                                <div class="form-group">
                                    <label class="col-form-label">Password</label>
                                    <input class="form-control" type="password" name="password" required
                                        placeholder="*********">
                                    <div class="show-hide">
                                        <span class="show">Show</span>
                                    </div>
                                </div>

                                <!-- Remember Me Checkbox -->
                                <div class="form-group mb-0">
                                    <div class="checkbox p-0">
                                        <input id="checkbox1" type="checkbox" name="remember">
                                        <label class="text-muted" for="checkbox1">Remember password</label>
                                    </div>
                                    <a class="link" href="{{ route('admin.password.request') }}">Forgot password?</a>
                                    <button class="btn btn-primary btn-block" type="submit">Sign in</button>
                                </div>




                                <!-- Create Account Link -->
                                <p class="mt-4 mb-0">
                                    Don't have an account?
                                    <a class="ms-2" href="{{ route('sign-up') }}">Create Account</a>
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
@endsection
