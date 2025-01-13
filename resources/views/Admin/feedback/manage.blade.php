@extends('layouts.admin.master')

@section('title', 'Feedback Management')

@section('content')
    <div class="container my-5">
        <div class="card">
            <h1 class="mb-4">Feedback Management</h1>

            <!-- Tabs for Feedback Status -->
            <ul class="nav nav-tabs mb-4" id="feedbackTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="all-tab" data-bs-toggle="tab" data-bs-target="#all" type="button"
                        role="tab" aria-controls="all" aria-selected="true">All</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pending-tab" data-bs-toggle="tab" data-bs-target="#pending" type="button"
                        role="tab" aria-controls="pending" aria-selected="false">Pending</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="approve-tab" data-bs-toggle="tab" data-bs-target="#approve" type="button"
                        role="tab" aria-controls="approve" aria-selected="false">Approved</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="reject-tab" data-bs-toggle="tab" data-bs-target="#reject" type="button"
                        role="tab" aria-controls="reject" aria-selected="false">Rejected</button>
                </li>
            </ul>

            <!-- Feedback Table -->
            <div class="tab-content" id="feedbackTabContent">
                @foreach (['all', 'pending', 'approve', 'reject'] as $status)
                    <div class="tab-pane fade {{ $status === 'all' ? 'show active' : '' }}" id="{{ $status }}"
                        role="tabpanel" aria-labelledby="{{ $status }}-tab">
                        <table class="table table-bordered table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>ID</th>
                                    <th>Message</th>
                                    <th>Rating</th>
                                    <th>User</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($feedback as $item)
                                    @if ($status === 'all' || $item->status === $status)
                                        <tr>
                                            <td>{{ $item->id }}</td>
                                            <td>{{ $item->message }}</td>
                                            <td>
                                                <div class="star-rating">
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        @if ($i <= $item->rating)
                                                            ★
                                                        @else
                                                            ☆
                                                        @endif
                                                    @endfor
                                                </div>
                                            </td>
                                            <td>{{ $item->user->name ?? 'Unknown' }}</td>
                                            <td>{{ ucfirst($item->status) }}</td>
                                            <td>
                                                <form method="POST" action="{{ route('admin.feedback.update', $item) }}"
                                                    style="display:inline;">
                                                    @csrf
                                                    <button type="submit" name="status" value="approve"
                                                        class="btn btn-success btn-sm">Approve</button>
                                                    <button type="submit" name="status" value="reject"
                                                        class="btn btn-danger btn-sm">Reject</button>
                                                </form>
                                                <form method="POST" action="{{ route('admin.feedback.destroy', $item) }}"
                                                    style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-warning btn-sm"
                                                        onclick="return confirm('Are you sure?')">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
