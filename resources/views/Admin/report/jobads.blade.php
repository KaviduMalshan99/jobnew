@extends('layouts.admin.master')
@section('title', 'Job Ads Report')

@section('css')
@endsection

@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/datatables.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/datatable-extension.css') }}">
@endsection

@section('breadcrumb-title')
    <h3>Job Ads Report</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item active">Job Ads</li>
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
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Today's Ads</div>
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
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">This Week</div>
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
            <div class="col-12 mb-4">
                <div class="card shadow">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Date Range Report</h6>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.job.report.daterange') }}" method="GET" class="mb-4">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Start Date</label>
                                        <input type="date" name="start_date" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>End Date</label>
                                        <input type="date" name="end_date" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>&nbsp;</label>
                                        <button type="submit" class="btn btn-primary btn-block mt-4">Generate
                                            Report</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Detailed Reports -->
            <div class="col-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Detailed Reports</h6>
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
                                                <th>Recent Jobs</th>
                                                <th>Earnings (LKR)</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($dailyCount as $daily)
                                                <tr>
                                                    <td>{{ $daily->date }}</td>
                                                    <td>{{ $daily->count }}</td>
                                                    <td>
                                                        <ul class="list-unstyled mb-0">
                                                            @foreach ($daily->jobs as $job)
                                                                <li class="mb-1">{{ $job }}</li>
                                                            @endforeach
                                                        </ul>
                                                    </td>
                                                    <td>{{ number_format($daily->earnings, 2) }}</td>
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
                                                <th>Recent Jobs</th>
                                                <th>Earnings (LKR)</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($weeklyCount as $weekly)
                                                <tr>
                                                    <td>Week <br>{{ $weekly->week }}</td>
                                                    <td>{{ $weekly->week_start }} to {{ $weekly->week_end }}</td>
                                                    <td>{{ $weekly->count }}</td>
                                                    <td>
                                                        <ul class="list-unstyled mb-0">
                                                            @foreach ($weekly->jobs as $job)
                                                                <li class="mb-1">{{ $job }}</li>
                                                            @endforeach
                                                        </ul>
                                                    </td>
                                                    <td>{{ number_format($weekly->earnings, 2) }}</td>
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
                                                <th>Recent Jobs</th>
                                                <th>Earnings (LKR)</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($monthlyCount as $monthly)
                                                <tr>
                                                    <td>{{ $monthly->month }}</td>
                                                    <td>{{ $monthly->count }}</td>
                                                    <td>
                                                        <ul class="list-unstyled mb-0">
                                                            @foreach ($monthly->jobs as $job)
                                                                <li class="mb-1">{{ $job }}</li>
                                                            @endforeach
                                                        </ul>
                                                    </td>
                                                    <td>{{ number_format($monthly->earnings, 2) }}</td>
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

            <!-- Additional Statistics -->
            <div class="col-md-6">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Payment Methods</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="display" id="payment-table">
                                <thead>
                                    <tr>
                                        <th>Method</th>
                                        <th>Count</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($paymentDetails as $payment)
                                        <tr>
                                            <td>{{ $payment->payment_method }}</td>
                                            <td>{{ $payment->count }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Posted By</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="display" id="posted-by-table">
                                <thead>
                                    <tr>
                                        <th>User</th>
                                        <th>Posts</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($postedBy as $post)
                                        <tr>
                                            <td>{{ $post->posted_by }}</td>
                                            <td>{{ $post->count }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Repeated Employers -->
            <div class="col-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Repeated Employers</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="display" id="employers-table">
                                <thead>
                                    <tr>
                                        <th>Employer ID</th>
                                        <th>Company</th>
                                        <th>Posts Count</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($repeatedEmployers as $employer)
                                        <tr>
                                            <td>{{ $employer->employer_id }}</td>
                                            <td>{{ $employer->company_name }}</td>
                                            <td>{{ $employer->post_count }}</td>
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
@endsection

@section('script')
    <script src="{{ asset('assets/js/datatable/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatable/datatable-extension/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatable/datatable-extension/jszip.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatable/datatable-extension/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatable/datatable-extension/buttons.print.min.js') }}"></script>

    {{-- <script>
        $(document).ready(function() {
            // Initialize DataTables
            const tables = {};
            const dtConfig = {
                dom: 'Bfrtip',
                buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
                pageLength: 10,
                ordering: true,
                responsive: true
            };

            // Initialize all tables
            ['daily-table', 'weekly-table', 'monthly-table', 'payment-table', 'posted-by-table', 'employers-table']
            .forEach(tableId => {
                tables[tableId] = $(`#${tableId}`).DataTable(dtConfig);
            });

            // Handle tab switching
            $('#reportTabs a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
                const targetId = $(e.target).attr('href');
                const tableId = `${targetId.substring(1)}-table`;

                if (tables[tableId]) {
                    tables[tableId].columns.adjust().draw();
                }
            });

            // Handle collapse toggle
            $('#reportsCollapse').on('shown.bs.collapse', function() {
                Object.values(tables).forEach(table => {
                    table.columns.adjust().draw();
                });
            });
        });
    </script> --}}
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
                monthly: $('#monthly-table').DataTable(dtConfig),
                payment: $('#payment-table').DataTable(dtConfig),
                postedBy: $('#posted-by-table').DataTable(dtConfig),
                employers: $('#employers-table').DataTable(dtConfig)
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
