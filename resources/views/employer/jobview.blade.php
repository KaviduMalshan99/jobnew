@extends('layouts.employer.master')

@section('title', 'Jobs')

@section('css')
    <style>
        /* Custom Button Styles */
        .btn {
            display: inline-flex;
            align-items: center;
            padding: 8px 16px;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.3s ease;
            gap: 8px;
            cursor: pointer;
        }

        .btn i {
            font-size: 16px;
        }

        .btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .btn-primary {
            background-color: #4f46e5;
            color: white;
            border: none;
        }

        .btn-primary:hover {
            background-color: #4338ca;
        }

        .btn-danger {
            background-color: #ef4444;
            color: white;
            border: none;
        }

        .btn-danger:hover {
            background-color: #dc2626;
        }

        .btn-warning {
            background-color: #f59e0b;
            color: white;
            border: none;
        }

        .btn-warning:hover {
            background-color: #d97706;
        }

        .btn-success {
            background-color: #10b981;
            color: white;
            border: none;
        }

        .btn-success:hover {
            background-color: #059669;
        }

        .btn-sm {
            padding: 6px 12px;
            font-size: 13px;
        }

        .action-buttons {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }

        .action-buttons form {
            margin: 0;
        }

        /* Responsive styles */
        @media (max-width: 768px) {
            .action-buttons {
                flex-direction: column;
                gap: 6px;
            }

            .btn {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
@endsection

@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/animate.css') }}">
@endsection

@section('breadcrumb-title')
    <h3>Jobs</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Dashboard</li>
    <li class="breadcrumb-item active">Jobs</li>
@endsection

@section('content')

    <div class="container">
        <h2>Your Job Postings</h2>

        @if ($jobPostings->count() > 0)
            <div class="overflow-x-auto shadow-sm rounded-lg">
                <table class="min-w-full divide-y divide-gray-200 bg-white">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Job ID
                            </th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title
                            </th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Category</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Subcategory</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Reviewed By</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Reviewed Date</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Review Reason</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach ($jobPostings as $job)
                            <tr class="hover:bg-gray-50">

                                <td class="px-4 py-3 whitespace-nowrap">{{ $job->job_id }}</td>



                                <td class="px-4 py-3 whitespace-nowrap">{{ $job->title }}</td>


                                <td class="px-4 py-3 whitespace-nowrap">{{ $job->category->name }}</td>
                                <td class="px-4 py-3 whitespace-nowrap">{{ $job->subcategory->name }}</td>
                                <td class="px-4 py-3 whitespace-nowrap">{{ $job->admin->name ?? 'N/A' }}</td>
                                <td class="px-4 py-3 whitespace-nowrap">
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                    {{ ($job->status === 'approved'
                                            ? 'bg-green-100 text-green-800'
                                            : $job->status === 'rejected')
                                        ? 'bg-red-100 text-red-800'
                                        : 'bg-yellow-100 text-yellow-800' }}">
                                        {{ ucfirst($job->status) }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 whitespace-nowrap">
                                    @if ($job->status === 'approved')
                                        {{ $job->approved_date ? \Carbon\Carbon::parse($job->approved_date)->format('Y-m-d') : 'N/A' }}
                                    @elseif ($job->status === 'rejected')
                                        {{ $job->rejected_date ? \Carbon\Carbon::parse($job->rejected_date)->format('Y-m-d') : 'N/A' }}
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td class="px-4 py-3 whitespace-nowrap">{{ $job->review_reason ?? 'N/A' }}</td>
                                <td class="px-4 py-3 whitespace-nowrap">
                                    <div class="action-buttons">
                                        <a href="{{ route('employer.jobs.applications', ['job' => $job->id]) }}"
                                            class="btn btn-primary btn-sm">
                                            <i class="fa fa-users" aria-hidden="true"></i>
                                            view
                                        </a>

                                        <a href="{{ route('employer.job_postings.post.edit', $job->id) }}"
                                            class="btn btn-primary btn-sm">
                                            <i class="fa fa-pencil" aria-hidden="true"></i>

                                        </a>

                                        <form action="{{ route('employer.job_postings.post.destroy', $job->id) }}"
                                            method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Are you sure you want to delete this job posting?');">
                                                <i class="fa fa-trash" aria-hidden="true"></i>

                                            </button>
                                        </form>

                                        <form action="{{ route('job_postings.toggle_active', $job->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit"
                                                class="btn btn-sm {{ $job->is_active ? 'btn-warning' : 'btn-success' }}">
                                                <i class="fa {{ $job->is_active ? 'fa-pause' : 'fa-play' }}"
                                                    aria-hidden="true"></i>
                                                {{ $job->is_active ? 'Mark as Inactive' : 'Mark as Active' }}
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination Links -->
            {{ $jobPostings->links() }}
        @else
            <p>You have not created any job postings yet.</p>
        @endif
    </div>
    <script type="text/javascript">
        var session_layout = '{{ session()->get('layout') }}';
    </script>
@endsection

@section('script')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="{{ asset('assets/js/clock.js') }}"></script>
    <script src="{{ asset('assets/js/chart/apex-chart/moment.min.js') }}"></script>
    <script src="{{ asset('assets/js/notify/bootstrap-notify.min.js') }}"></script>
    <script src="{{ asset('assets/js/dashboard/default.js') }}"></script>
    <script src="{{ asset('assets/js/notify/index.js') }}"></script>
    <script src="{{ asset('assets/js/typeahead/handlebars.js') }}"></script>
    <script src="{{ asset('assets/js/typeahead/typeahead.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/typeahead/typeahead.custom.js') }}"></script>
    <script src="{{ asset('assets/js/typeahead-search/handlebars.js') }}"></script>
    <script src="{{ asset('assets/js/typeahead-search/typeahead-custom.js') }}"></script>
    <script src="{{ asset('assets/js/height-equal.js') }}"></script>
    <script src="{{ asset('assets/js/animation/wow/wow.min.js') }}"></script>
    <script>
        document.getElementById('category_id').addEventListener('change', function() {
            const categoryId = this.value;
            const subcategorySelect = document.getElementById('subcategory_id');

            // Clear existing subcategory options
            subcategorySelect.innerHTML = '<option value="">Select a subcategory</option>';

            if (categoryId) {
                fetch(`/subcategories/${categoryId}`)
                    .then(response => response.json())
                    .then(data => {
                        data.forEach(subcategory => {
                            const option = document.createElement('option');
                            option.value = subcategory.id;
                            option.textContent = subcategory.name;
                            subcategorySelect.appendChild(option);
                        });
                    })
                    .catch(error => console.error('Error fetching subcategories:', error));
            }
        });
    </script>
    <script>
        document.getElementById('image').addEventListener('change', function(event) {
            const imagePreview = document.getElementById('imagePreview');
            const file = event.target.files[0];

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    imagePreview.src = e.target.result;
                    imagePreview.style.display = 'block';
                };
                reader.readAsDataURL(file);
            } else {
                imagePreview.style.display = 'none';
            }
        });
    </script>

@endsection
