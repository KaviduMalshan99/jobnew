@extends('layouts.admin.master')

@section('title', 'Edit Package')

@section('css')
    <!-- Add any CSS files related to the page here -->
@endsection

@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/animate.css') }}">
@endsection

@section('breadcrumb-title')
    <h3>Edit Package</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Dashboard</li>
    <li class="breadcrumb-item"><a href="{{ route('admin.packages.index') }}">Package List</a></li>
    <li class="breadcrumb-item active">Edit Package</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Edit Package</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.packages.update', $package->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="form-group mb-3">
                                <label for="package_size">Package Size (Number of Posts):</label>
                                <input type="number" name="package_size" id="package_size" class="form-control"
                                    value="{{ $package->package_size }}" required>
                            </div>

                            <div class="form-group mb-3">
                                <label for="duration_days">Duration (Days):</label>
                                <input type="number" name="duration_days" id="duration_days" class="form-control"
                                    value="{{ $package->duration_days }}" required>
                            </div>

                            <div class="form-group mb-3">
                                <label for="lkr_price">LKR Price (VAT Inclusive):</label>
                                <input type="text" name="lkr_price" id="lkr_price" class="form-control"
                                    value="{{ $package->lkr_price }}" required>
                            </div>

                            <div class="form-group mb-3">
                                <label for="usd_price">USD Price:</label>
                                <input type="text" name="usd_price" id="usd_price" class="form-control"
                                    value="{{ $package->usd_price }}" required>
                            </div>

                            <button type="submit" class="btn btn-primary">Update Package</button>
                        </form>
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
