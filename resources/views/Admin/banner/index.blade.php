@extends('layouts.admin.master')
@section('title', 'Manage Banners')

@section('css')
    <style>
        .banner-preview {
            max-width: 150px;
            height: auto;
        }
    </style>
@endsection

@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/animate.css') }}">
@endsection

@section('breadcrumb-title')
    <h3>Manage Banners</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Dashboard</li>
    <li class="breadcrumb-item active">Manage Banners</li>
@endsection

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <ul class="nav nav-tabs" id="bannersTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="pending-tab" data-bs-toggle="tab" data-bs-target="#pending"
                            type="button" role="tab" aria-controls="pending" aria-selected="true">Pending</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="published-tab" data-bs-toggle="tab" data-bs-target="#published"
                            type="button" role="tab" aria-controls="published" aria-selected="false">Published</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="rejected-tab" data-bs-toggle="tab" data-bs-target="#rejected"
                            type="button" role="tab" aria-controls="rejected" aria-selected="false">Rejected</button>
                    </li>
                </ul>

                <div class="tab-content" id="bannersTabContent">
                    <!-- Pending Tab -->
                    <div class="tab-pane fade show active" id="pending" role="tabpanel" aria-labelledby="pending-tab">
                        <table class="table table-bordered mt-3">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Title</th>
                                    <th>Image</th>
                                    <th>Category</th>
                                    <th>Placement</th>
                                    <th>Package</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pendingBanners as $banner)
                                    <tr>
                                        <td>{{ $banner->id }}</td>
                                        <td>{{ $banner->title }}</td>
                                        <td>
                                            <img src="{{ Storage::url($banner->image) }}" class="banner-preview"
                                                alt="Banner">
                                        </td>
                                        <td>{{ $banner->category ? $banner->category->name : 'N/A' }}</td>
                                        <td>{{ ucfirst($banner->placement) }}</td>
                                        <td>{{ $banner->package->name }}</td>
                                        <td>{{ ucfirst($banner->status) }}</td>
                                        <td>
                                            <form action="{{ route('banners.updateStatus', $banner->id) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <select name="status" class="form-select status-select mb-2"
                                                    data-banner-id="{{ $banner->id }}">
                                                    <option value="pending"
                                                        {{ $banner->status == 'pending' ? 'selected' : '' }}>
                                                        Pending
                                                    </option>
                                                    <option value="approved"
                                                        {{ $banner->status == 'approved' ? 'selected' : '' }}>
                                                        Approved
                                                    </option>
                                                    <option value="rejected"
                                                        {{ $banner->status == 'rejected' ? 'selected' : '' }}>
                                                        Rejected
                                                    </option>
                                                </select>

                                                <div id="rejection-reason-{{ $banner->id }}"
                                                    class="rejection-reason mt-2" style="display: none;">
                                                    <textarea name="rejection_reason" class="form-control" placeholder="Enter rejection reason"></textarea>
                                                </div>

                                                <button type="submit" class="btn btn-primary mt-2">Update Status</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $pendingBanners->links() }}
                    </div>

                    <!-- Published Tab -->
                    <div class="tab-pane fade" id="published" role="tabpanel" aria-labelledby="published-tab">
                        <table class="table table-bordered mt-3">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Title</th>
                                    <th>Image</th>
                                    <th>Category</th>
                                    <th>Placement</th>
                                    <th>Package</th>
                                    <th>Views</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($approvedBanners as $banner)
                                    <tr>
                                        <td>{{ $banner->id }}</td>
                                        <td>{{ $banner->title }}</td>
                                        <td>
                                            <img src="{{ Storage::url($banner->image) }}" class="banner-preview"
                                                alt="Banner">
                                        </td>
                                        <td>{{ $banner->category ? $banner->category->name : 'N/A' }}</td>
                                        <td>{{ ucfirst($banner->placement) }}</td>
                                        <td>{{ $banner->package->name }}</td>
                                        <td>{{ $banner->view_count }}</td>
                                        <td>
                                            <form action="{{ route('banners.updateStatus', $banner->id) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <select name="status" class="form-select status-select mb-2"
                                                    data-banner-id="{{ $banner->id }}">
                                                    <option value="pending"
                                                        {{ $banner->status == 'pending' ? 'selected' : '' }}>
                                                        Pending
                                                    </option>
                                                    <option value="approved"
                                                        {{ $banner->status == 'approved' ? 'selected' : '' }}>
                                                        Approved
                                                    </option>
                                                    <option value="rejected"
                                                        {{ $banner->status == 'rejected' ? 'selected' : '' }}>
                                                        Rejected
                                                    </option>
                                                </select>

                                                <div id="rejection-reason-{{ $banner->id }}"
                                                    class="rejection-reason mt-2" style="display: none;">
                                                    <textarea name="rejection_reason" class="form-control" placeholder="Enter rejection reason"></textarea>
                                                </div>

                                                <button type="submit" class="btn btn-primary mt-2">Update Status</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $approvedBanners->links() }}
                    </div>

                    <!-- Rejected Tab -->
                    <div class="tab-pane fade" id="rejected" role="tabpanel" aria-labelledby="rejected-tab">
                        <table class="table table-bordered mt-3">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Title</th>
                                    <th>Image</th>
                                    <th>Category</th>
                                    <th>Placement</th>
                                    <th>Package</th>
                                    <th>Rejection Reason</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($rejectedBanners as $banner)
                                    <tr>
                                        <td>{{ $banner->id }}</td>
                                        <td>{{ $banner->title }}</td>
                                        <td>
                                            <img src="{{ Storage::url($banner->image) }}" class="banner-preview"
                                                alt="Banner">
                                        </td>
                                        <td>{{ $banner->category ? $banner->category->name : 'N/A' }}</td>
                                        <td>{{ ucfirst($banner->placement) }}</td>
                                        <td>{{ $banner->package->name }}</td>
                                        <td>{{ $banner->rejection_reason }}</td>
                                        <td>
                                            <form action="{{ route('banners.updateStatus', $banner->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <select name="status" class="form-select status-select mb-2"
                                                    data-banner-id="{{ $banner->id }}">
                                                    <option value="pending"
                                                        {{ $banner->status == 'pending' ? 'selected' : '' }}>
                                                        Pending
                                                    </option>
                                                    <option value="approved"
                                                        {{ $banner->status == 'approved' ? 'selected' : '' }}>
                                                        Approved
                                                    </option>
                                                    <option value="rejected"
                                                        {{ $banner->status == 'rejected' ? 'selected' : '' }}>
                                                        Rejected
                                                    </option>
                                                </select>

                                                <div id="rejection-reason-{{ $banner->id }}"
                                                    class="rejection-reason mt-2" style="display: none;">
                                                    <textarea name="rejection_reason" class="form-control" placeholder="Enter rejection reason"></textarea>
                                                </div>

                                                <button type="submit" class="btn btn-primary mt-2">Update Status</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $rejectedBanners->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const statusSelects = document.querySelectorAll('.status-select');

            statusSelects.forEach(select => {
                select.addEventListener('change', function() {
                    const bannerId = this.getAttribute('data-banner-id');
                    const rejectionDiv = document.getElementById(`rejection-reason-${bannerId}`);

                    if (this.value === 'rejected') {
                        rejectionDiv.style.display = 'block';
                    } else {
                        rejectionDiv.style.display = 'none';
                    }
                });
            });
        });
    </script>
@endsection
@endsection
