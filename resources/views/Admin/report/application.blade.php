@extends('layouts.admin.master')
@section('title', 'Applications & Users Report')

@section('css')
@endsection

@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/datatables.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/datatable-extension.css') }}">
@endsection

@section('breadcrumb-title')
    <h3>Applications & Users Report</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item active">Applications & Users</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <!-- Summary Cards -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Today's Applications
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $dailyApplications }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-file-alt fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Today's New Users
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $dailyUsers }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-users fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Applications Report -->
            <div class="col-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Applications Report</h6>
                    </div>
                    <div class="card-body">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-bs-toggle="tab" href="#daily-apps">Daily</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#weekly-apps">Weekly</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#monthly-apps">Monthly</a>
                            </li>
                        </ul>

                        <!-- Tab content -->
                        <div class="tab-content">
                            <!-- Daily Applications -->
                            <div class="tab-pane active" id="daily-apps">
                                <div class="table-responsive mt-3">
                                    <table class="display" id="daily-apps-table">
                                        <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>Applications Count</th>
                                                <th>Recent Applications</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($dailyApplicationsData as $daily)
                                                <tr>
                                                    <td>{{ $daily['date'] }}</td>
                                                    <td>{{ $daily['count'] }}</td>
                                                    <td>
                                                        <ul class="list-unstyled mb-0">
                                                            @foreach ($daily['applications'] ?? [] as $application)
                                                                <li class="mb-1">
                                                                    {{ $application['user_name'] ?? 'N/A' }} -
                                                                    {{ $application['job_title'] ?? 'N/A' }}
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <!-- Weekly Applications -->
                            <div class="tab-pane fade" id="weekly-apps">
                                <div class="table-responsive mt-3">
                                    <table class="display" id="weekly-apps-table">
                                        <thead>
                                            <tr>
                                                <th>Week</th>
                                                <th>Date Range</th>
                                                <th>Applications Count</th>
                                                <th>Details</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($weeklyApplicationsData as $weekly)
                                                <tr>
                                                    <td>Week {{ $weekly['week'] ?? 'N/A' }}</td>
                                                    <td>{{ $weekly['start_date'] ?? 'N/A' }} to
                                                        {{ $weekly['end_date'] ?? 'N/A' }}</td>
                                                    <td>{{ $weekly['count'] ?? 0 }}</td>
                                                    <td>
                                                        <ul class="list-unstyled mb-0">
                                                            @foreach ($weekly['summary'] ?? [] as $detail)
                                                                <li class="mb-1">{{ $detail }}</li>
                                                            @endforeach
                                                        </ul>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <!-- Monthly Applications -->
                            <div class="tab-pane fade" id="monthly-apps">
                                <div class="table-responsive mt-3">
                                    <table class="display" id="monthly-apps-table">
                                        <thead>
                                            <tr>
                                                <th>Month</th>
                                                <th>Applications Count</th>
                                                <th>Details</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($monthlyApplicationsData as $monthly)
                                                <tr>
                                                    <td>{{ $monthly['month'] ?? 'N/A' }}</td>
                                                    <td>{{ $monthly['count'] ?? 0 }}</td>
                                                    <td>
                                                        <ul class="list-unstyled mb-0">
                                                            @foreach ($monthly['summary'] ?? [] as $detail)
                                                                <li class="mb-1">{{ $detail }}</li>
                                                            @endforeach
                                                        </ul>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- User Registrations Report -->
            <div class="col-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">User Registrations</h6>
                    </div>
                    <div class="card-body">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-bs-toggle="tab" href="#daily-users">Daily</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#weekly-users">Weekly</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#monthly-users">Monthly</a>
                            </li>
                        </ul>

                        <!-- Tab content -->
                        <div class="tab-content">
                            <!-- Daily Users -->
                            <div class="tab-pane active" id="daily-users">
                                <div class="table-responsive mt-3">
                                    <table class="display" id="daily-users-table">
                                        <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>Registrations</th>
                                                <th>New Users</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($dailyUsersData as $daily)
                                                <tr>
                                                    <td>{{ $daily['date'] ?? 'N/A' }}</td>
                                                    <td>{{ $daily['count'] ?? 0 }}</td>
                                                    <td>
                                                        <ul class="list-unstyled mb-0">
                                                            @foreach ($daily['users'] ?? [] as $user)
                                                                <li class="mb-1">
                                                                    {{ $user['name'] ?? 'N/A' }} -
                                                                    {{ $user['email'] ?? 'N/A' }}
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <!-- Weekly Users -->
                            <div class="tab-pane fade" id="weekly-users">
                                <div class="table-responsive mt-3">
                                    <table class="display" id="weekly-users-table">
                                        <thead>
                                            <tr>
                                                <th>Week</th>
                                                <th>Date Range</th>
                                                <th>Registrations</th>
                                                <th>Users List</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($weeklyUsersData as $weekly)
                                                <tr>
                                                    <td>Week {{ $weekly['week'] ?? 'N/A' }}</td>
                                                    <td>{{ $weekly['start_date'] ?? 'N/A' }} to
                                                        {{ $weekly['end_date'] ?? 'N/A' }}</td>
                                                    <td>{{ $weekly['count'] ?? 0 }}</td>
                                                    <td>
                                                        <ul class="list-unstyled mb-0">
                                                            @foreach ($weekly['users'] ?? [] as $user)
                                                                <li class="mb-1">{{ $user['name'] ?? 'N/A' }}</li>
                                                            @endforeach
                                                        </ul>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <!-- Monthly Users -->
                            <div class="tab-pane fade" id="monthly-users">
                                <div class="table-responsive mt-3">
                                    <table class="display" id="monthly-users-table">
                                        <thead>
                                            <tr>
                                                <th>Month</th>
                                                <th>Registrations</th>
                                                <th>Users Summary</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($monthlyUsersData as $monthly)
                                                <tr>
                                                    <td>{{ $monthly['month'] ?? 'N/A' }}</td>
                                                    <td>{{ $monthly['count'] ?? 0 }}</td>
                                                    <td>
                                                        <ul class="list-unstyled mb-0">
                                                            @foreach ($monthly['summary'] ?? [] as $detail)
                                                                <li class="mb-1">{{ $detail }}</li>
                                                            @endforeach
                                                        </ul>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('assets/js/datatable/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatable/datatable-extension/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatable/datatable-extension/jszip.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatable/datatable-extension/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatable/datatable-extension/buttons.print.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            // DataTable configuration
            const dtConfig = {
                dom: 'Bfrtip',
                buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
                pageLength: 20,
                ordering: true,
                responsive: true
            };

            // Initialize all tables
            const tables = {
                'daily-apps-table': $('#daily-apps-table').DataTable(dtConfig),
                'weekly-apps-table': $('#weekly-apps-table').DataTable(dtConfig),
                'monthly-apps-table': $('#monthly-apps-table').DataTable(dtConfig),
                'daily-users-table': $('#daily-users-table').DataTable(dtConfig),
                'weekly-users-table': $('#weekly-users-table').DataTable(dtConfig),
                'monthly-users-table': $('#monthly-users-table').DataTable(dtConfig)
            };

            // Handle tab changes
            $('a[data-bs-toggle="tab"]').on('shown.bs.tab', function(e) {
                const targetId = $(e.target).attr('href').substring(1);
                const tableId = `${targetId}-table`;
                if (tables[tableId]) {
                    tables[tableId].columns.adjust().draw();
                }
            });
        });
    </script>
@endsection
