@extends('layouts.employer.master')

@section('title', 'Dashboard')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/animate.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/fontawesome.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/line-awesome.css') }}">
@endsection

@section('style')
    <style>
        /* General styling improvements */
        .dashboard-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .dashboard-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .stat-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            font-size: 24px;
        }

        /* Gradient button */
        .btn-gradient {
            background: linear-gradient(45deg, #6a11cb, #2575fc);
            color: white;
            border-radius: 30px;
            font-weight: bold;
            padding: 10px 20px;
            transition: background-color 0.3s;
        }

        .btn-gradient:hover {
            background: linear-gradient(45deg, #2575fc, #6a11cb);
        }

        /* Table styling */
        .table thead {
            background-color: #f8f9fa;
        }

        .table th,
        .table td {
            vertical-align: middle;
        }

        .table-hover tbody tr:hover {
            background-color: #f1f1f1;
        }
    </style>
@endsection

@section('breadcrumb-title')
    <h3>Welcome Back, {{ auth()->user()->company_name }}</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Dashboard</li>
@endsection

@section('content')
    <div class="container-fluid p-4">
        <!-- Welcome Section -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="welcome-section p-4 shadow-sm rounded-lg">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h2 class="mb-3 fw-bold text-primary">Welcome to JoBads.lk</h2>
                            <p class="mb-4 opacity-75">Here’s your dashboard overview for today.</p>
                            <button class="btn btn-gradient px-4 py-2 rounded-pill">What's New?</button>
                        </div>
                        <div class="col-md-4 d-none d-md-block">
                            <img src="{{ asset('assets/images/dashboard/welcome-illustration.svg') }}"
                                class="w-50 img-fluid" alt="Welcome">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stats Cards Section -->
        <div class="row g-4">
            <!-- Applications Card -->
            <div class="col-sm-6 col-xl-3">
                <div class="dashboard-card h-100 shadow-lg rounded-lg">
                    <div class="card-body d-flex align-items-center justify-content-between">
                        <div class="stat-icon bg-primary bg-opacity-10 p-3 rounded-circle">
                            <i class="fas fa-file-alt text-primary fa-lg"></i>
                        </div>
                        <div class="text-end">
                            <h3 class="animated-number mb-1">{{ number_format($totalApplications ?? 0) }}</h3>
                            <p class="stat-label mb-0">Total Applications</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Jobs Posted Card -->
            <div class="col-sm-6 col-xl-3">
                <div class="dashboard-card h-100 shadow-lg rounded-lg">
                    <div class="card-body d-flex align-items-center justify-content-between">
                        <div class="stat-icon bg-success bg-opacity-10 p-3 rounded-circle">
                            <i class="fas fa-briefcase text-success fa-lg"></i>
                        </div>
                        <div class="text-end">
                            <h3 class="animated-number mb-1">{{ number_format($totalJobsPosted ?? 0) }}</h3>
                            <p class="stat-label mb-0">Jobs Posted</p>
                        </div>
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
    <script src="{{ asset('assets/js/height-equal.js') }}"></script>
    <script src="{{ asset('assets/js/animation/wow/wow.min.js') }}"></script>
@endsection
