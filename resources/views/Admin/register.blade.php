@extends('layouts.authentication.master')
@section('title', 'Admin Register')

@section('css')
    <!-- Add custom CSS links if needed -->
@endsection

@section('style')
    <style>
        /* Add custom inline styles if needed */
    </style>
@endsection

@section('content')
    <div class="container-fluid p-0">
        <div class="row m-0">
            <div class="col-12 p-0">
                <div class="login-card">
                    <div>
                        <div class="text-center">
                            <a class="logo" href="{{ route('index') }}">
                                <img class="img-fluid for-light" src="{{ asset('assets/images/logo/login.png') }}"
                                    alt="logo">
                                <img class="img-fluid for-dark" src="{{ asset('assets/images/logo/logo_dark.png') }}"
                                    alt="logo">
                            </a>
                        </div>
                        <div class="login-main">
                            <form method="POST" action="{{ route('admin.register') }}">
                                @csrf
                                <h4>Create Your Account</h4>
                                <p>Enter your personal details to create an account</p>

                                <!-- Name -->
                                <div class="form-group">
                                    <label class="col-form-label pt-0">Your Name</label>
                                    <input type="text" name="name" class="form-control" placeholder="Name" required>
                                </div>

                                <!-- Email -->
                                <div class="form-group">
                                    <label class="col-form-label">Email Address</label>
                                    <input type="email" name="email" class="form-control" placeholder="Test@gmail.com"
                                        required>
                                </div>

                                <!-- Contact -->
                                <div class="form-group">
                                    <label class="col-form-label">Phone Number</label>
                                    <input type="text" name="contact" class="form-control" placeholder="Contact">
                                </div>

                                <!-- Password -->
                                <div class="form-group">
                                    <label class="col-form-label">Password</label>
                                    <input type="password" name="password" class="form-control" placeholder="*********"
                                        required>
                                </div>

                                <!-- Confirm Password -->
                                <div class="form-group">
                                    <label class="col-form-label">Confirm Password</label>
                                    <input type="password" name="password_confirmation" class="form-control"
                                        placeholder="*********" required>
                                </div>

                                <!-- Privacy Policy Agreement -->
                                <div class="form-group mb-0">
                                    <div class="checkbox p-0">
                                        <input id="checkbox1" type="checkbox" required>
                                        <label class="text-muted" for="checkbox1">
                                            Agree with <a href="#" class="ms-2">Privacy Policy</a>
                                        </label>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-block">Create Account</button>
                                </div>

                                <!-- Social Login -->
                                <h6 class="text-muted mt-4 or">Or sign up with</h6>
                                <div class="social mt-4">
                                    <div class="btn-showcase">
                                        <a href="https://www.linkedin.com/login" target="_blank" class="btn btn-light">
                                            <i class="txt-linkedin" data-feather="linkedin"></i> LinkedIn
                                        </a>
                                        <a href="https://twitter.com/login?lang=en" target="_blank" class="btn btn-light">
                                            <i class="txt-twitter" data-feather="twitter"></i> Twitter
                                        </a>
                                        <a href="https://www.facebook.com/" target="_blank" class="btn btn-light">
                                            <i class="txt-fb" data-feather="facebook"></i> Facebook
                                        </a>
                                    </div>
                                </div>

                                <!-- Sign-in Link -->
                                <p class="mt-4 mb-0">
                                    Already have an account? <a href="{{ route('login') }}" class="ms-2">Sign in</a>
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
    <!-- Add custom scripts if needed -->
@endsection
