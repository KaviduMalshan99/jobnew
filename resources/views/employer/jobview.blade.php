@extends('layouts.employer.master')

@section('title', 'Jobs')

@section('css')

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
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Job ID</th>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Subcategory</th>
                        <th>Reviewed By</th>
                        <th>Status</th>
                        <th>Reviewed Date</th>
                        <th>Review Reason</th>
                        <th>Acttion</th>
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
                            <td>{{ ucfirst($job->status) }}</td>
                            <td>
                                @if ($job->status === 'approved')
                                    {{ $job->approved_date ? \Carbon\Carbon::parse($job->approved_date)->format('Y-m-d') : 'N/A' }}
                                @elseif ($job->status === 'rejected')
                                    {{ $job->rejected_date ? \Carbon\Carbon::parse($job->rejected_date)->format('Y-m-d') : 'N/A' }}
                                @else
                                    N/A
                                @endif
                            </td>


                            <td>{{ $job->review_reason ?? 'N/A' }}</td>
                            <td>
                                <!-- Edit button -->
                                <a href="{{ route('employer.job_postings.post.edit', $job->id) }}"
                                    class="btn btn-primary btn-sm">Edit</a>

                                <!-- Delete button -->
                                <form action="{{ route('employer.job_postings.post.destroy', $job->id) }}" method="POST"
                                    style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Are you sure you want to delete this job posting?');">
                                        Delete
                                    </button>
                                </form>
                            </td>


                        </tr>
                    @endforeach
                </tbody>
            </table>

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
