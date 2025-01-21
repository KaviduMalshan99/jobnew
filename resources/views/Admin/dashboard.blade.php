@extends('layouts.admin.master')

@section('title', 'Dashboard')

@section('css')
    <style>
        .card {
            border-radius: 1rem;
            transition: all 0.3s ease;
            border: none;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            background: white;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }

        .stat-icon {
            width: 56px;
            height: 56px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }

        /* Applications Icon */
        .stat-icon.applications-icon {
            background: linear-gradient(135deg, #3B82F6 0%, #60A5FA 100%);
            box-shadow: 0 8px 16px -4px rgba(59, 130, 246, 0.3);
        }

        /* Jobs Icon */
        .stat-icon.jobs-icon {
            background: linear-gradient(135deg, #10B981 0%, #34D399 100%);
            box-shadow: 0 8px 16px -4px rgba(16, 185, 129, 0.3);
        }

        /* Jobseekers Icon */
        .stat-icon.jobseekers-icon {
            background: linear-gradient(135deg, #F59E0B 0%, #FBBF24 100%);
            box-shadow: 0 8px 16px -4px rgba(245, 158, 11, 0.3);
        }

        /* Views Icon */
        .stat-icon.views-icon {
            background: linear-gradient(135deg, #6366F1 0%, #818CF8 100%);
            box-shadow: 0 8px 16px -4px rgba(99, 102, 241, 0.3);
        }

        /* Earnings Icon */
        .stat-icon.earnings-icon {
            background: linear-gradient(135deg, #0EA5E9 0%, #38BDF8 100%);
            box-shadow: 0 8px 16px -4px rgba(14, 165, 233, 0.3);
        }

        .stat-icon i {
            color: white !important;
            font-size: 1.5rem;
            filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.1));
        }

        .stat-icon:hover {
            transform: translateY(-2px);
            filter: brightness(1.1);
        }

        .welcome-section {
            background: linear-gradient(135deg, #4158D0 0%, #C850C0 46%, #FFCC70 100%);
            border-radius: 1rem;
            color: white;
            padding: 2rem;
            margin-bottom: 2rem;
        }

        .animated-number {
            font-size: 2rem;
            font-weight: 700;
            color: #1F2937;
        }

        .stat-label {
            color: #6B7280;
            font-size: 0.875rem;
            font-weight: 500;
            margin-top: 0.5rem;
        }

        .card-body {
            padding: 1.5rem;
        }
    </style>
@endsection

@section('breadcrumb-title')
    <h3>Welcome Back, {{ auth('admin')->name }}</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Dashboard</li>
@endsection

@section('content')
    <div class="container-fluid p-4">
        <!-- Welcome Section -->
        <div class="row">
            <div class="col-12">
                <div class="welcome-section">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h2 class="mb-3 fw-bold">Welcome to JoBads.lk</h2>
                            <p class="mb-4 opacity-75">Here's your dashboard overview for today</p>
                            <button class="btn btn-light px-4 py-2">What's New</button>
                        </div>
                        <div class="col-md-4 d-none d-md-block">
                            <img src="{{ asset('assets/images/dashboard/welcome-illustration.svg') }}"
                                class="w-50 img-fluid" alt="Welcome">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="row g-4">
            <!-- Applications Card -->
            <div class="col-sm-6 col-xl-3">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <div class="stat-icon applications-icon">
                                <i class="fas fa-file-alt fa-lg"></i>
                            </div>
                            <div class="dropdown">
                                <button class="btn btn-link p-0" data-bs-toggle="dropdown">
                                    <i class="fas fa-ellipsis-v text-muted"></i>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#">View Details</a></li>
                                    <li><a class="dropdown-item" href="#">Generate Report</a></li>
                                </ul>
                            </div>
                        </div>
                        <h3 class="animated-number mb-1">
                            {{ number_format($statistics['total_applications'] ?? 0) }}
                        </h3>
                        <p class="stat-label mb-0">Total Applications</p>
                    </div>
                </div>
            </div>

            <!-- Jobs Posted Card -->
            <div class="col-sm-6 col-xl-3">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <div class="stat-icon jobs-icon">
                                <i class="fas fa-briefcase fa-lg"></i>
                            </div>
                            <div class="dropdown">
                                <button class="btn btn-link p-0" data-bs-toggle="dropdown">
                                    <i class="fas fa-ellipsis-v text-muted"></i>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#">View Jobs</a></li>
                                    <li><a class="dropdown-item" href="#">Post New Job</a></li>
                                </ul>
                            </div>
                        </div>
                        <h3 class="animated-number mb-1">
                            {{ number_format($statistics['total_jobs_posted'] ?? 0) }}
                        </h3>
                        <p class="stat-label mb-0">Jobs Posted</p>
                    </div>
                </div>
            </div>

            <!-- Jobseekers Card -->
            <div class="col-sm-6 col-xl-3">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <div class="stat-icon jobseekers-icon">
                                <i class="fas fa-users fa-lg"></i>
                            </div>
                            <div class="dropdown">
                                <button class="btn btn-link p-0" data-bs-toggle="dropdown">
                                    <i class="fas fa-ellipsis-v text-muted"></i>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#">View Jobseekers</a></li>
                                    <li><a class="dropdown-item" href="#">Export List</a></li>
                                </ul>
                            </div>
                        </div>
                        <h3 class="animated-number mb-1">
                            {{ number_format($statistics['total_jobseekers'] ?? 0) }}
                        </h3>
                        <p class="stat-label mb-0">Total Jobseekers</p>
                    </div>
                </div>
            </div>

            <!-- Views Card -->
            <div class="col-sm-6 col-xl-3">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <div class="stat-icon views-icon">
                                <i class="fas fa-eye fa-lg"></i>
                            </div>
                            <div class="dropdown">
                                <button class="btn btn-link p-0" data-bs-toggle="dropdown">
                                    <i class="fas fa-ellipsis-v text-muted"></i>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#">Views</a></li>
                                    <li><a class="dropdown-item" href="#">Export List</a></li>
                                </ul>
                            </div>
                        </div>
                        <h3 class="animated-number mb-1">
                            {{ number_format($statistics['total_views'] ?? 0) }}
                        </h3>
                        <p class="stat-label mb-0">Total Views</p>
                    </div>
                </div>
            </div>

            <!-- Earnings Card -->
            <div class="col-sm-6 col-xl-3">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <div class="stat-icon earnings-icon">
                                <i class="fas fa-dollar-sign fa-lg"></i>
                            </div>
                            <div class="dropdown">
                                <button class="btn btn-link p-0" data-bs-toggle="dropdown">
                                    <i class="fas fa-ellipsis-v text-muted"></i>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#">View Earnings</a></li>
                                    <li><a class="dropdown-item" href="#">Download Report</a></li>
                                </ul>
                            </div>
                        </div>
                        <h3 class=" mb-1">
                            Rs. {{ number_format($statistics['total_earnings'] ?? 0) }}
                        </h3>
                        <p class="stat-label mb-0">Total Earnings</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Applications Section -->
        <div class="row mt-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div>
                                <h5 class="card-title mb-0">Recent Applications</h5>
                                <p class="text-muted small mb-0">Last 7 days: {{ $statistics['recent_applications'] ?? 0 }}
                                    applications
                                    @if (isset($statistics['application_growth']))
                                        <span
                                            class="ms-2 {{ $statistics['application_growth'] > 0 ? 'text-success' : 'text-danger' }}">
                                            {{ $statistics['application_growth'] > 0 ? '+' : '' }}{{ $statistics['application_growth'] }}%
                                        </span>
                                    @endif
                                </p>
                            </div>
                            <a href="{{ route('admin.dashboard') }}" class="btn btn-primary btn-sm">View All</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('assets/js/dashboard/modern.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const animateValue = (element, start, end, duration) => {
                let current = start;
                const range = end - start;
                const increment = end > start ? 1 : -1;
                const stepTime = Math.abs(Math.floor(duration / range));

                const timer = setInterval(() => {
                    current += increment;
                    element.textContent = current.toLocaleString();
                    if (current === end) {
                        clearInterval(timer);
                    }
                }, stepTime);
            };

            document.querySelectorAll('.animated-number').forEach(element => {
                const finalValue = parseInt(element.textContent.replace(/,/g, ''));
                animateValue(element, 0, finalValue, 1000);
            });
        });
    </script>
@endsection
