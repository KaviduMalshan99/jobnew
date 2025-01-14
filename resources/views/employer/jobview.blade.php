@extends('layouts.employer.master')

@section('title', 'Jobs')
@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/datatables.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/datatable-extension.css') }}">

@endsection

@section('css')
    <style>
        .btn-action {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 8px;
            border: none;
            background-color: transparent;
            cursor: pointer;
        }

        .btn-action i {
            font-size: 16px;
            /* Adjust size as needed */
            color: #333;
            /* Ensure visible color */
        }

        .btn-delete {
            color: red;
        }

        .btn-toggle-active {
            color: green;
        }

        .btn-toggle-inactive {
            color: gray;
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h3 class="mb-0">Job Postings</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="dt-ext table-responsive">
                            @if ($jobPostings->count() > 0)
                                <table class="display" id="keytable">
                                    <thead>
                                        <tr>
                                            <th>Job ID</th>
                                            <th>Title</th>
                                            <th>Category</th>
                                            <th>Subcategory</th>
                                            <th>Reviewed By</th>
                                            <th>Status</th>
                                            <th>Reviewed Date</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($jobPostings as $job)
                                            <tr>
                                                <td>{{ $job->job_id }}</td>
                                                <td>{{ $job->title }}</td>
                                                <td>{{ $job->category->name }}</td>
                                                <td>{{ $job->subcategory->name }}</td>
                                                <td>{{ $job->admin->name ?? 'N/A' }}</td>
                                                <td>
                                                    <span
                                                        class="status-badge {{ $job->status === 'approved' ? 'status-approved' : ($job->status === 'rejected' ? 'status-rejected' : 'status-pending') }}">
                                                        {{ ucfirst($job->status) }}
                                                    </span>
                                                </td>
                                                <td>
                                                    @if ($job->status === 'approved')
                                                        {{ $job->approved_date ? \Carbon\Carbon::parse($job->approved_date)->format('Y-m-d') : 'N/A' }}
                                                    @elseif ($job->status === 'rejected')
                                                        {{ $job->rejected_date ? \Carbon\Carbon::parse($job->rejected_date)->format('Y-m-d') : 'N/A' }}
                                                    @else
                                                        N/A
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="action-buttons">
                                                        <!-- View Applications Button -->
                                                        <a href="{{ route('employer.jobs.applications', ['job' => $job->id]) }}"
                                                            class="btn-action btn-view" title="View Applications">
                                                            <i class="icon-list"></i>
                                                        </a>

                                                        <!-- Edit Button -->
                                                        <a href="{{ route('employer.job_postings.post.edit', $job->id) }}"
                                                            class="btn-action btn-edit" title="Edit Job">
                                                            <i class="icon-pencil-alt"></i>
                                                        </a>

                                                        <!-- Delete Button -->
                                                        {{-- <form
                                                            action="{{ route('employer.job_postings.post.destroy', $job->id) }}"
                                                            method="POST" class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class=" btn-action btn-delete"
                                                                title="Delete Job"
                                                                onclick="return confirm('Are you sure you want to delete this job posting?');">
                                                                <i class="icon-trash"></i>
                                                            </button>
                                                        </form>

                                                        <!-- Toggle Active/Inactive Button -->
                                                        <form action="{{ route('job_postings.toggle_active', $job->id) }}"
                                                            method="POST" class="d-inline">
                                                            @csrf
                                                            @method('PATCH')
                                                            <button type="submit"
                                                                class="btn-action {{ $job->is_active ? 'btn-toggle-active' : 'btn-toggle-inactive' }}"
                                                                title="{{ $job->is_active ? 'Mark as Inactive' : 'Mark as Active' }}">
                                                                <i class="icon-receipt"></i>
                                                            </button>
                                                        </form> --}}
                                                    </div>
                                                </td>

                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @else
                                <div class="text-center py-4">
                                    <p class="text-gray-500">You haven't created any job postings yet.</p>
                                    <a href="{{ route('employer.job_postings.create') }}" class="btn btn-primary mt-3">
                                        Create Your First Job Posting
                                    </a>
                                </div>
                            @endif
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
    <script src="{{ asset('assets/js/datatable/datatable-extension/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatable/datatable-extension/dataTables.responsive.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#keytable').DataTable({
                responsive: true,
                order: [
                    [0, 'desc']
                ],
                pageLength: 10,
                language: {
                    search: "Search:",
                    lengthMenu: "Show _MENU_ entries",
                    info: "Showing _START_ to _END_ of _TOTAL_ entries",
                    paginate: {
                        first: "First",
                        last: "Last",
                        next: "Next",
                        previous: "Previous"
                    }
                },
                columnDefs: [{
                        orderable: false,
                        targets: -1
                    } // Disable sorting on action column
                ]
            });
        });
    </script>
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
