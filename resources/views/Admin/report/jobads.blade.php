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

            <!-- Detailed Reports -->
            <div class="col-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex justify-content-between align-items-center">
                        <h6 class="m-0 font-weight-bold text-primary">Detailed Reports</h6>
                        <div class="card-tools">
                            <button class="btn btn-sm btn-primary" type="button" data-toggle="collapse"
                                data-target="#reportsCollapse">
                                Toggle Reports
                            </button>
                        </div>
                    </div>
                    <div class="collapse show" id="reportsCollapse">
                        <div class="card-body">
                            <div class="nav-tabs-custom">
                                <!-- Updated Tab Navigation -->
                                <ul class="nav nav-tabs" id="reportTabs" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" href="#daily" role="tab">Daily</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#weekly" role="tab">Weekly</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#monthly" role="tab">Monthly</a>
                                    </li>
                                </ul>

                                <div class="tab-content">
                                    <!-- Daily Tab -->
                                    <div class="tab-pane fade show active" id="daily" role="tabpanel">
                                        <div class="table-responsive">
                                            <table class="table table-hover">
                                                <thead class="thead-light">
                                                    <tr>
                                                        <th>Date</th>
                                                        <th>Count</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($dailyCount as $daily)
                                                        <tr>
                                                            <td>{{ $daily->date }}</td>
                                                            <td>{{ $daily->count }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <!-- Weekly Tab -->
                                    <div class="tab-pane fade" id="weekly" role="tabpanel">
                                        <div class="table-responsive">
                                            <table class="table table-hover">
                                                <thead class="thead-light">
                                                    <tr>
                                                        <th>Week</th>
                                                        <th>Count</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($weeklyCount as $weekly)
                                                        <tr>
                                                            <td>Week {{ $weekly->week }}</td>
                                                            <td>{{ $weekly->count }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <!-- Monthly Tab -->
                                    <div class="tab-pane fade" id="monthly" role="tabpanel">
                                        <div class="table-responsive">
                                            <table class="table table-hover">
                                                <thead class="thead-light">
                                                    <tr>
                                                        <th>Month</th>
                                                        <th>Count</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($monthlyCount as $monthly)
                                                        <tr>
                                                            <td>{{ $monthly->month }}</td>
                                                            <td>{{ $monthly->count }}</td>
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

            <!-- Additional Statistics -->
            <div class="col-md-6">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Payment Methods</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="thead-light">
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
                            <table class="table table-hover">
                                <thead class="thead-light">
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
                            <table class="table table-hover" id="employersTable">
                                <thead class="thead-light">
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

    <script>
        $(document).ready(function() {
            // Initialize all tables with DataTables
            $('.table').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'excel', 'csv', 'pdf', 'print'
                ],
                pageLength: 10,
                ordering: true,
                responsive: true
            });

            // Initialize tooltips
            $('[data-toggle="tooltip"]').tooltip();

            // Fix for tab switching
            $('.nav-tabs a').on('click', function(e) {
                e.preventDefault();
                $(this).tab('show');
            });

            // Handle DataTables redraw on tab change
            $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
                $.fn.dataTable.tables({
                    visible: true,
                    api: true
                }).columns.adjust();
            });
        });
    </script>
@endsection
