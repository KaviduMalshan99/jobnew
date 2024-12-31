<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HomePage</title>
    @vite(['resources/css/home.css', 'resources/js/app.js', 'resources/css/footer.css'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>

<body>
    @include('home.header')

    <!-- Feedback Section -->
    <section class="feedback-section">
        <div class="rectangle"></div>
        <a href="#">
            <button class="feedback-btn">Jobs Feedback</button>
        </a>
    </section><br />

    <!-- Filters Section -->
    <section class="filters">
        <form method="GET" action="{{ route('home') }}">
            <input class="text-input" type="text" name="search"
                placeholder="Enter Vacancy Name/Company/Job Reference" value="{{ request('search') }}">
            <input class="text-input" type="text" name="location" placeholder="Enter your Location"
                value="{{ request('location') }}">
            <button class="view-btn" type="submit">Search</button>
        </form>
    </section>

    <main class="main-content">
        <!-- Categories Section -->
        <div class="job-categories-header">
            <div class="categories-grid">
                @foreach ($categories as $category)
                    <a href="javascript:void(0);" data-category-id="{{ $category->id }}" class="category-link">
                        {{ $category->name }}
                    </a>
                @endforeach
            </div>
        </div>

        <!-- Job Listings Section -->
        <section id="job-listings" class="job-listings-container">
            <h3 class="job-listings-title">Available Jobs</h3>
            <div class="job-grid">
                @if ($jobs->isEmpty())
                    <p>No jobs found matching your criteria.</p>
                @else
                    @foreach ($jobs as $job)
                        <div class="job-card">
                            @auth
                                <button class="flag-btn" data-job-id="{{ $job->id }}">
                                    <i
                                        class="fa {{ auth()->user()->flaggedJobs->contains($job->id)? 'fa-flag': 'fa-flag-o' }}"></i>
                                </button>
                            @endauth
                            <a href="{{ route('job.details', $job->id) }}" class="job-title">
                                {{ $job->title }}
                            </a>
                            <p><strong>{{ $job->employer->company_name }}</strong></p>
                            <p>{{ $job->location }}</p>
                        </div>
                    @endforeach
                @endif
            </div>

        </section>
    </main>

    @include('home.footer')
    <script>
        $(document).on('click', '.flag-btn', function() {
            let jobId = $(this).data('job-id');
            let button = $(this);

            $.ajax({
                url: `/jobs/${jobId}/flag`,
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.status === 'flagged') {
                        button.find('i').removeClass('fa-flag-o').addClass('fa-flag');
                    } else {
                        button.find('i').removeClass('fa-flag').addClass('fa-flag-o');
                    }
                    alert(response.message);
                }
            });
        });
    </script>
</body>

</html>
