@extends('layouts.admin.master')

@section('title', 'Bank Accounts List')

@section('css')
@endsection

@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/datatables.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/datatable-extension.css') }}">
    <style>
        .icon-fixed-size {
            width: 16px;
            height: 16px;
            font-size: 16px;
            line-height: 16px;
            display: inline-block;
            text-align: center;
        }

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
            /* Set a fixed width for uniform size */
            height: 40px;
            /* Set a fixed height for uniform size */
        }

        .custom-btn i {
            font-size: 16px;
            /* Icon size */
            margin-right: 6px;
            /* Space between icon and text */
        }

        .custom-btn-warning {
            background-color: #ffc107;
            color: #fff;
            border: 1px solid #ffc107;
        }

        .custom-btn-warning:hover {
            background-color: #e0a800;
            border-color: #d39e00;
        }

        .custom-btn-danger {
            background-color: #dc3545;
            color: #fff;
            border: 1px solid #dc3545;
        }

        .custom-btn-danger:hover {
            background-color: #c82333;
            border-color: #bd2130;
        }
    </style>
@endsection

@section('breadcrumb-title')
    <h3>Bank Accounts List</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Dashboard</li>
    <li class="breadcrumb-item active">Bank Accounts List</li>
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
                                <h3>Bank Accounts List</h3>
                            </div>
                            <div class="col-md-2 mb-4">
                                <div>
                                    <a href="{{ route('admin.bank-accounts.create') }}"
                                        class="btn btn-primary btn-sm rounded">Create new</a>
                                </div>
                            </div>
                        </div>

                        <div class="dt-ext table-responsive">
                            <table class="display" id="keytable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Bank Name</th>
                                        <th>Account Name</th>
                                        <th>Account No</th>
                                        <th>Bank Code</th>
                                        <th>Branch Code</th>
                                        <th>Branch Name</th>
                                        <th>SWIFT Code</th>
                                        <th>Currency</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($bankAccounts as $account)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $account->bank_name }}</td>
                                            <td>{{ $account->account_name }}</td>
                                            <td>{{ $account->account_no }}</td>
                                            <td>{{ $account->bank_code }}</td>
                                            <td>{{ $account->branch_code }}</td>
                                            <td>{{ $account->branch_name }}</td>
                                            <td>{{ $account->swift_code }}</td>
                                            <td>{{ $account->currency }}</td>
                                            <td>
                                                <a href="{{ route('admin.bank-accounts.edit', $account->id) }}"
                                                    class="btn custom-btn custom-btn-warning">
                                                    <i class="icon-pencil-alt"></i> Edit
                                                </a>
                                                <form action="{{ route('admin.bank-accounts.destroy', $account->id) }}"
                                                    method="POST" style="display: inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn custom-btn custom-btn-danger"
                                                        onclick="return confirm('Are you sure you want to delete this bank account?')">
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
    <script src="{{ asset('assets/js/datatable/datatable-extension/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatable/datatable-extension/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatable/datatable-extension/dataTables.keyTable.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatable/datatable-extension/dataTables.colReorder.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatable/datatable-extension/dataTables.fixedHeader.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatable/datatable-extension/dataTables.rowReorder.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatable/datatable-extension/dataTables.scroller.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatable/datatable-extension/custom.js') }}"></script>
@endsection
