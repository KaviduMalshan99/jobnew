@extends('layouts.admin.master')
@section('title', 'Employer Registration Report')

@section('css')
@endsection

@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/datatables.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/datatable-extension.css') }}">
@endsection

@section('breadcrumb-title')
    <h3>Employer Registration Report</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item active">Employer Registrations</li>
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
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Today's Registrations
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    {{ $dailyTotal }}
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
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
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">This Week's
                                    Registrations</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    {{ $weeklyTotal }}
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-chart-bar fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Detailed Reports -->
            <div class="col-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Registration Details</h6>
                    </div>
                    <div class="card-body">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-bs-toggle="tab" href="#daily">Daily</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#weekly">Weekly</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#monthly">Monthly</a>
                            </li>
                        </ul>

                        <!-- Tab content -->
                        <div class="tab-content">
                            <!-- Daily Tab -->
                            <div class="tab-pane active" id="daily">
                                <div class="table-responsive mt-3">
                                    <table class="display" id="daily-table">
                                        <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>Count</th>
                                                <th>Registered Companies</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($dailyCount as $daily)
                                                <tr>
                                                    <td>{{ $daily['date'] }}</td>
                                                    <td>{{ $daily['count'] }}</td>
                                                    <td>
                                                        <ul class="list-unstyled mb-0">
                                                            @foreach ($daily['employers'] as $employer)
                                                                <li class="mb-1">{{ $employer['company_name'] }}</li>
                                                            @endforeach
                                                        </ul>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <!-- Weekly Tab -->
                            <div class="tab-pane fade" id="weekly">
                                <div class="table-responsive mt-3">
                                    <table class="display" id="weekly-table">
                                        <thead>
                                            <tr>
                                                <th>Week</th>
                                                <th>Date Range</th>
                                                <th>Count</th>
                                                <th>Registered Companies</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($weeklyCount as $weekly)
                                                <tr>
                                                    <td>Week {{ $weekly['week'] }}</td>
                                                    <td>{{ $weekly['week_start'] }} to {{ $weekly['week_end'] }}</td>
                                                    <td>{{ $weekly['count'] }}</td>
                                                    <td>
                                                        <ul class="list-unstyled mb-0">
                                                            @foreach ($weekly['employers'] as $employer)
                                                                <li class="mb-1">{{ $employer['company_name'] }}</li>
                                                            @endforeach
                                                        </ul>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <!-- Monthly Tab -->
                            <div class="tab-pane fade" id="monthly">
                                <div class="table-responsive mt-3">
                                    <table class="display" id="monthly-table">
                                        <thead>
                                            <tr>
                                                <th>Month</th>
                                                <th>Count</th>
                                                <th>Registered Companies</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($monthlyCount as $monthly)
                                                <tr>
                                                    <td>{{ $monthly['month'] }}</td>
                                                    <td>{{ $monthly['count'] }}</td>
                                                    <td>
                                                        <ul class="list-unstyled mb-0">
                                                            @foreach ($monthly['employers'] as $employer)
                                                                <li class="mb-1">{{ $employer['company_name'] }}</li>
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
                daily: $('#daily-table').DataTable(dtConfig),
                weekly: $('#weekly-table').DataTable(dtConfig),
                monthly: $('#monthly-table').DataTable(dtConfig)
            };

            // Handle tab changes
            $('a[data-bs-toggle="tab"]').on('shown.bs.tab', function(e) {
                const targetId = $(e.target).attr('href').substring(1);
                if (tables[targetId]) {
                    tables[targetId].columns.adjust().draw();
                }
            });
        });
    </script>
@endsection
