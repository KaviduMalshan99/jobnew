@extends('layouts.admin.master')

@section('title', 'Banner Packages List')

@section('css')
@endsection

@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/datatables.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/datatable-extension.css') }}">
    <style>
        .custom-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 8px 12px;
            font-size: 14px;
            border-radius: 4px;
            text-transform: uppercase;
            font-weight: bold;
            width: 100px;
            height: 40px;
        }

        .custom-btn i {
            font-size: 16px;
            margin-right: 6px;
        }

        .custom-btn-warning {
            background-color: #ffc107;
            color: #fff;
            border: 1px solid #ffc107;
        }

        .custom-btn-danger {
            background-color: #dc3545;
            color: #fff;
            border: 1px solid #dc3545;
        }
    </style>
@endsection

@section('breadcrumb-title')
    <h3>Banner Packages List</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Dashboard</li>
    <li class="breadcrumb-item active">Banner Packages List</li>
@endsection

@section('content')
    <div class="container-fluid">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header pb-0 card-no-border">
                    </div>
                    <div class="card-body">
                        <div class="row gx-3">
                            <div class="col-md-10 mb-4">
                                <h3>Banner Packages List</h3>
                            </div>
                            <div class="col-md-2 mb-4">
                                <div>
                                    <a href="{{ route('banner_packages.create') }}"
                                        class="btn btn-primary btn-sm rounded">Create new</a>
                                </div>
                            </div>
                        </div>

                        <div class="dt-ext table-responsive">
                            <table class="display" id="keytable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>7 Days Price (LKR)</th>
                                        <th>7 Days Price (USD)</th>
                                        <th>21 Days Price (LKR)</th>
                                        <th>21 Days Price (USD)</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($packages as $package)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $package->price_lkr_7days }}</td>
                                            <td>{{ $package->price_usd_7days }}</td>
                                            <td>{{ $package->price_lkr_21days }}</td>
                                            <td>{{ $package->price_usd_21days }}</td>
                                            <td>
                                                <a href="{{ route('banner_packages.edit', $package->id) }}"
                                                    class="btn custom-btn custom-btn-warning">
                                                    <i class="icon-pencil-alt"></i> Edit
                                                </a>
                                                <form action="{{ route('banner_packages.destroy', $package->id) }}"
                                                    method="POST" style="display: inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn custom-btn custom-btn-danger"
                                                        onclick="return confirm('Are you sure you want to delete this banner package?')">
                                                        <i class="icon-trash"></i> Delete
                                                    </button>
                                                </form>
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
@endsection

@section('script')
    <script src="{{ asset('assets/js/datatable/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatable/datatable-extension/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatable/datatable-extension/jszip.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatable/datatable-extension/buttons.colVis.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatable/datatable-extension/pdfmake.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatable/datatable-extension/vfs_fonts.js') }}"></script>
    <script src="{{ asset('assets/js/datatable/datatable-extension/dataTables.autoFill.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatable/datatable-extension/dataTables.select.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatable/datatable-extension/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatable/datatable-extension/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatable/datatable-extension/buttons.print.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatable/datatable-extension/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatable/datatable-extension/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatable/datatable-extension/dataTables.keyTable.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatable/datatable-extension/dataTables.colReorder.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatable/datatable-extension/dataTables.fixedHeader.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatable/datatable-extension/dataTables.rowReorder.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatable/datatable-extension/dataTables.scroller.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatable/datatable-extension/custom.js') }}"></script>
@endsection
