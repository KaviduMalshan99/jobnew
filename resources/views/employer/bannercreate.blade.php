@extends('layouts.employer.master')
@section('title', 'Manage Banners')

@section('css')
    <style>
        .banner-modal-image {
            width: 100%;
            max-height: 400px;
            object-fit: contain;
            border-radius: 8px;
        }

        .banner-details-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .banner-details-list li {
            padding: 8px 0;
            border-bottom: 1px solid #E5E7EB;
            display: flex;
            justify-content: space-between;
        }

        .banner-details-list li:last-child {
            border-bottom: none;
        }

        .banner-details-label {
            color: #6B7280;
            font-weight: 500;
        }

        .banner-details-value {
            color: #374151;
            font-weight: 400;
        }

        .btn-view {
            background-color: #F3F4F6;
            color: #374151;
            border: none;
            border-radius: 6px;
            padding: 0.375rem 0.75rem;
            font-size: 0.875rem;
            font-weight: 500;
            transition: all 0.2s;
        }

        .btn-view:hover {
            background-color: #E5E7EB;
            color: #1F2937;
        }

        .status-badge {
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.875rem;
            font-weight: 500;
        }

        .status-pending {
            background-color: #FEF3C7;
            color: #92400E;
        }

        .status-published {
            background-color: #D1FAE5;
            color: #065F46;
        }

        .status-rejected {
            background-color: #FEE2E2;
            color: #991B1B;
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">Banner Management</h4>
            </div>
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <ul class="nav nav-tabs" id="bannersTabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="pending-tab" data-bs-toggle="tab" href="#pending" role="tab">
                            Pending ({{ $pendingBanners->total() }})
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="published-tab" data-bs-toggle="tab" href="#published" role="tab">
                            Published ({{ $publishedBanners->total() }})
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="rejected-tab" data-bs-toggle="tab" href="#rejected" role="tab">
                            Rejected ({{ $rejectedBanners->total() }})
                        </a>
                    </li>
                </ul>

                <div class="tab-content mt-4" id="bannersTabContent">
                    @foreach (['pending' => $pendingBanners, 'published' => $publishedBanners, 'rejected' => $rejectedBanners] as $status => $banners)
                        <div class="tab-pane fade {{ $status === 'pending' ? 'show active' : '' }}" id="{{ $status }}"
                            role="tabpanel">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Title</th>
                                            <th>Details</th>
                                            <th>Stats</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($banners as $banner)
                                            <tr>
                                                <td>#{{ $banner->id }}</td>
                                                <td>{{ $banner->title }}</td>
                                                <td>
                                                    <div class="d-flex flex-column gap-1">
                                                        <small
                                                            class="text-muted">{{ $banner->category ? $banner->category->name : 'N/A' }}</small>
                                                        <small class="text-muted">{{ ucfirst($banner->placement) }}</small>
                                                        <button type="button" class="btn btn-view mt-1"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#bannerModal-{{ $banner->id }}">
                                                            View Details
                                                        </button>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex flex-column gap-1">
                                                        <small class="text-muted">Views:
                                                            {{ number_format($banner->view_count) }}</small>
                                                        <small class="text-muted">CTR:
                                                            {{ number_format($banner->ctr, 2) }}%</small>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="status-badge status-{{ $banner->status }}">
                                                        {{ ucfirst($banner->status) }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <form action="{{ route('admin.banners.update-status', $banner->id) }}"
                                                        method="POST" class="d-flex gap-2">
                                                        @csrf
                                                        @method('PUT')
                                                        @if ($errors->any())
                                                            <div class="alert alert-danger">
                                                                <ul>
                                                                    @foreach ($errors->all() as $error)
                                                                        <li>{{ $error }}</li>
                                                                    @endforeach
                                                                </ul>
                                                            </div>
                                                        @endif

                                                        <select name="status"
                                                            class="form-select form-select-sm status-select"
                                                            data-banner-id="{{ $banner->id }}">
                                                            <option value="pending"
                                                                {{ $banner->status === 'pending' ? 'selected' : '' }}>
                                                                Pending</option>
                                                            <option value="published"
                                                                {{ $banner->status === 'published' ? 'selected' : '' }}>
                                                                Publish</option>
                                                            <option value="rejected"
                                                                {{ $banner->status === 'rejected' ? 'selected' : '' }}>
                                                                Reject</option>
                                                        </select>
                                                        <div id="rejection-reason-{{ $banner->id }}"
                                                            style="display: none;">
                                                            <input type="text" name="rejection_reason"
                                                                class="form-control form-control-sm"
                                                                placeholder="Rejection reason"
                                                                value="{{ $banner->rejection_reason }}">
                                                        </div>
                                                        <button type="submit"
                                                            class="btn btn-primary btn-sm">Update</button>
                                                    </form>
                                                </td>
                                            </tr>

                                            <!-- Modal for banner details -->
                                            <div class="modal fade" id="bannerModal-{{ $banner->id }}" tabindex="-1"
                                                aria-hidden="true">
                                                <div class="modal-dialog modal-lg modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Banner Details - {{ $banner->title }}
                                                            </h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-12 mb-4">
                                                                    <img src="{{ Storage::url($banner->image) }}"
                                                                        class="banner-modal-image"
                                                                        alt="{{ $banner->title }}">
                                                                </div>
                                                                <div class="col-12">
                                                                    <ul class="banner-details-list">
                                                                        <li>
                                                                            <span class="banner-details-label">Title</span>
                                                                            <span
                                                                                class="banner-details-value">{{ $banner->title }}</span>
                                                                        </li>
                                                                        <li>
                                                                            <span
                                                                                class="banner-details-label">Category</span>
                                                                            <span class="banner-details-value">
                                                                                {{ $banner->category ? $banner->category->name : 'N/A' }}
                                                                            </span>
                                                                        </li>
                                                                        <li>
                                                                            <span
                                                                                class="banner-details-label">Placement</span>
                                                                            <span
                                                                                class="banner-details-value">{{ ucfirst($banner->placement) }}</span>
                                                                        </li>
                                                                        <li>
                                                                            <span
                                                                                class="banner-details-label">Package</span>
                                                                            <span
                                                                                class="banner-details-value">{{ $banner->package->name }}</span>
                                                                        </li>
                                                                        <li>
                                                                            <span class="banner-details-label">Total
                                                                                Views</span>
                                                                            <span
                                                                                class="banner-details-value">{{ number_format($banner->view_count) }}</span>
                                                                        </li>
                                                                        <li>
                                                                            <span class="banner-details-label">Click-through
                                                                                Rate</span>
                                                                            <span
                                                                                class="banner-details-value">{{ number_format($banner->ctr, 2) }}%</span>
                                                                        </li>
                                                                        @if ($banner->rejection_reason)
                                                                            <li>
                                                                                <span
                                                                                    class="banner-details-label">Rejection
                                                                                    Reason</span>
                                                                                <span
                                                                                    class="banner-details-value text-danger">{{ $banner->rejection_reason }}</span>
                                                                            </li>
                                                                        @endif
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="d-flex justify-content-end p-3">
                                {{ $banners->links() }}
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Handle status select changes
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

            // Initialize rejection reason visibility
            statusSelects.forEach(select => {
                if (select.value === 'rejected') {
                    const bannerId = select.getAttribute('data-banner-id');
                    const rejectionDiv = document.getElementById(`rejection-reason-${bannerId}`);
                    rejectionDiv.style.display = 'block';
                }
            });

            // Auto-hide alerts after 5 seconds
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                setTimeout(() => {
                    alert.classList.remove('show');
                    setTimeout(() => alert.remove(), 150);
                }, 5000);
            });
        });
    </script>
@endsection
