@extends('layouts.admin.master')
@section('title', 'Manage Job Postings')

@section('css')
@endsection

@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/animate.css') }}">
@endsection

@section('breadcrumb-title')
    <h3>Manage Job Postings</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Dashboard</li>
    <li class="breadcrumb-item active">Manage Job Postings</li>
@endsection

@section('content')
    <div class="container">

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <ul class="nav nav-tabs" id="jobPostingsTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="pending-tab" data-bs-toggle="tab" data-bs-target="#pending"
                    type="button" role="tab" aria-controls="pending" aria-selected="true">Pending</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="published-tab" data-bs-toggle="tab" data-bs-target="#published" type="button"
                    role="tab" aria-controls="published" aria-selected="false">Published</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="rejected-tab" data-bs-toggle="tab" data-bs-target="#rejected" type="button"
                    role="tab" aria-controls="rejected" aria-selected="false">Rejected</button>
            </li>
        </ul>

        <div class="tab-content" id="jobPostingsTabContent">

            <!-- Pending Tab -->
            <div class="tab-pane fade show active" id="pending" role="tabpanel" aria-labelledby="pending-tab">
                <table class="table table-bordered mt-3">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Employer</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pendingJobs as $job)
                            <tr>
                                <td>{{ $job->id }}</td>
                                <td>{{ $job->title }}</td>
                                <td>{{ $job->category->name }}</td>
                                <td>{{ $job->employer->company_name }}</td>
                                <td>{{ $job->status }}</td>
                                <td>
                                    <a href="{{ route('job_postings.show', $job->id) }}" class="btn btn-info">View</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $pendingJobs->links() }}
            </div>

            <!-- Published Tab -->
            <div class="tab-pane fade" id="published" role="tabpanel" aria-labelledby="published-tab">
                <table class="table table-bordered mt-3">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Employer</th>
                            <th>views</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($jobPostings as $job)
                            <tr>
                                <td>{{ $job->id }}</td>
                                <td>{{ $job->title }}</td>
                                <td>{{ $job->category->name }}</td>
                                <td>{{ $job->employer->company_name }}</td>
                                <td>{{ $job->view_count }}</td>
                                <td>{{ $job->status }}</td>
                                <td>
                                    <form action="{{ route('job_postings.updateStatus', $job->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')

                                        <select name="status" class="form-select status-select"
                                            data-job-id="{{ $job->id }}">
                                            <option value="pending" {{ $job->status == 'pending' ? 'selected' : '' }}>
                                                Pending</option>
                                            <option value="approved" {{ $job->status == 'approved' ? 'selected' : '' }}>
                                                Approved</option>
                                            <option value="reject" {{ $job->status == 'reject' ? 'selected' : '' }}>
                                                Rejected</option>
                                        </select>

                                        <!-- Rejection Reason -->
                                        <div id="rejection-reason-{{ $job->id }}" class="rejection-reason mt-2"
                                            style="display: none;">
                                            <textarea name="rejection_reason" class="form-control" placeholder="Enter rejection reason"></textarea>
                                        </div>

                                        <button type="submit" class="btn btn-primary mt-2">Submit</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $jobPostings->links() }}
            </div>

            <!-- Rejected Tab -->
            <div class="tab-pane fade" id="rejected" role="tabpanel" aria-labelledby="rejected-tab">
                <table class="table table-bordered mt-3">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Employer</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($rejectedJobs as $job)
                            <tr>
                                <td>{{ $job->id }}</td>
                                <td>{{ $job->title }}</td>
                                <td>{{ $job->category->name }}</td>
                                <td>{{ $job->employer->company_name }}</td>
                                <td>{{ $job->status }}</td>
                                <td>
                                    <form action="{{ route('job_postings.updateStatus', $job->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')

                                        <select name="status" class="form-select status-select"
                                            data-job-id="{{ $job->id }}">
                                            <option value="pending" {{ $job->status == 'pending' ? 'selected' : '' }}>
                                                Pending</option>
                                            <option value="approved" {{ $job->status == 'approved' ? 'selected' : '' }}>
                                                Approved</option>
                                            <option value="reject" {{ $job->status == 'reject' ? 'selected' : '' }}>
                                                Rejected</option>
                                        </select>

                                        <!-- Rejection Reason -->
                                        <div id="rejection-reason-{{ $job->id }}" class="rejection-reason mt-2"
                                            style="display: none;">
                                            <textarea name="rejection_reason" class="form-control" placeholder="Enter rejection reason"></textarea>
                                        </div>

                                        <button type="submit" class="btn btn-primary mt-2">Submit</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $rejectedJobs->links() }}
            </div>
        </div>
    </div>
@endsection
