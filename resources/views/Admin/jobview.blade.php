@extends('layouts.admin.master')
@section('title', 'Default')

@section('css')

@endsection

@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/animate.css') }}">
@endsection

@section('breadcrumb-title')
    <h3>Default</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Dashboard</li>
    <li class="breadcrumb-item active">Default</li>
@endsection
@section('content')
    <div class="container">
        <h1>Manage Job Postings</h1>
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered">
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
                @foreach ($jobPostings as $job)
                    <tr>
                        <td>{{ $job->id }}</td>
                        <td>{{ $job->title }}</td>
                        <td>{{ $job->category->name }}</td>
                        <td>{{ $job->employer->name }}</td>
                        <td>{{ $job->status }}</td>
                        <td>
                            <form action="{{ route('job_postings.updateStatus', $job->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <select name="status" class="form-select" onchange="this.form.submit()">
                                    <option value="pending" {{ $job->status == 'pending' ? 'selected' : '' }}>Pending
                                    </option>
                                    <option value="approved" {{ $job->status == 'approved' ? 'selected' : '' }}>Approved
                                    </option>
                                    <option value="reject" {{ $job->status == 'reject' ? 'selected' : '' }}>Rejected
                                    </option>
                                </select>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $jobPostings->links() }}
    </div>
@endsection
