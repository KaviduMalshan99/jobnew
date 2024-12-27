<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HomePage</title>
    @vite(['resources/css/home.css', 'resources/js/app.js', 'resources/css/footer.css'])
   
</head>

<body>
    @include('home.header')

    <!-- Feedback Section -->
    <section class="feedback-section">
        <div class="rectangle"></div>
        <a href="{{ route('feedback') }}">
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
        <section class="categories-container">
            <h3 class="categories-title">Job Categories</h3>
            <hr />
            <div class="categories-list">
                @foreach ($categories as $category)
                    <a href="javascript:void(0);" data-category-id="{{ $category->id }}" class="category-link">
                        {{ $category->name }}
                    </a>
                @endforeach
            </div>
        </section>

        <!-- Job Listings Section -->
        <section id="job-listings" class="job-listings-container">
            <h3 class="job-listings-title">Available Jobs</h3>
            <div class="job-grid">
                @if ($jobs->isEmpty())
                    <p>No jobs found matching your criteria.</p>
                @else
                    @foreach ($jobs as $job)
                        <div class="job-card">
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
</body>

</html>
