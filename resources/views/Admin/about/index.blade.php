@extends('layouts.admin.master')

@section('title', 'About Us Details')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/animate.css') }}">
@endsection

@section('style')


@endsection
@section('breadcrumb-title')
    <h3 class="">About Us Details</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Dashboard</li>
    <li class="breadcrumb-item active" aria-current="page">About Us</li>
@endsection



@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card content-card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span>About Us Information</span>
                        <a href="{{ route('admin.about-us.create') }}" class="btn btn-primary action-button">
                            <i class="fa fa-plus-circle me-2"></i>Create New About Us
                        </a>
                    </div>

                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success animate__animated animate__fadeIn">
                                <i class="fa fa-check-circle me-2"></i>{{ session('success') }}
                            </div>
                        @endif

                        @if ($aboutUs)
                            <div class="about-content">
                                <h4 class="about-title">{{ $aboutUs->title }}</h4>
                                <p class="about-description">{{ $aboutUs->description }}</p>

                                <div class="mt-4">
                                    <a href="{{ route('admin.about-us.edit', $aboutUs->id) }}"
                                        class="btn btn-primary action-button">
                                        <i class="fa fa-edit me-2"></i>Edit Content
                                    </a>
                                </div>
                            </div>
                        @else
                            <div class="alert  animate__animated animate__fadeIn">
                                <i class="fa fa-exclamation-circle me-2 "></i> <br>No About Us information available.
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('assets/js/clock.js') }}"></script>
    <script src="{{ asset('assets/js/chart/apex-chart/moment.min.js') }}"></script>
    <script src="{{ asset('assets/js/notify/bootstrap-notify.min.js') }}"></script>
    <script src="{{ asset('assets/js/dashboard/default.js') }}"></script>
    <script src="{{ asset('assets/js/notify/index.js') }}"></script>
    <script src="{{ asset('assets/js/typeahead/handlebars.js') }}"></script>
    <script src="{{ asset('assets/js/typeahead/typeahead.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/typeahead/typeahead.custom.js') }}"></script>
    <script src="{{ asset('assets/js/typeahead-search/handlebars.js') }}"></script>
    <script src="{{ asset('assets/js/typeahead-search/typeahead-custom.js') }}"></script>
    <script src="{{ asset('assets/js/height-equal.js') }}"></script>
    <script src="{{ asset('assets/js/animation/wow/wow.min.js') }}"></script>
@endsection
