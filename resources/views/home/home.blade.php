<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HomePage</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    @vite(['resources/css/home.css', 'resources/js/app.js', 'resources/css/footer.css', 'resources/css/header.css'])

</head>

<body>
    @include('home.header')

    <!-- Categories Section -->
    <section class="categories-container">
        <div class="categories-header">
            <a href="/login" class="jobseeker-btn">JOBSEEKER LOGIN</a>
            <a href="{{ route('feedback.home') }}" class=" feedback-btn2">Feedback</a>
        </div>

        <div class="scroll-wrapper">
            <div class="categories-list">
                @foreach ($categories as $category)
                    <a href="javascript:void(0);" data-category-id="{{ $category->id }}" class="category-link">
                        {{ $category->name }}
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Filters Section -->
    <section class="filters">
        <p class="jobtitle">
            Available Jobs : {{ $jobs->count() }} new hot jobs
        </p>
        <form method="GET" action="{{ route('home') }}">
            <input class="text-input" type="text" name="search"
                placeholder="Enter Vacancy Name/Company/Job Reference" value="{{ request('search') }}">
            <input class="text-input" type="text" name="location" placeholder="Enter your Location"
                value="{{ request('location') }}">
            <button class="view-btn" type="submit">Search</button>
        </form>
        <hr class>
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
                        <p><strong class="company-name">{{ $job->employer->company_name }}</strong></p>
                        <p class="location">{{ $job->location }}</p>
                        <p class="closing-date">{{ $job->closing_date }}</p>
                    </div>
                @endforeach
            @endif
        </div>

    </section>




    </main><br /><br /><br /><br />

    @include('home.footer')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const categoryLinks = document.querySelectorAll('.category-link');

            categoryLinks.forEach(link => {
                link.addEventListener('click', function() {
                    // Remove the 'visited' class from all links
                    categoryLinks.forEach(l => l.classList.remove('visited'));

                    // Add the 'visited' class to the clicked link
                    this.classList.add('visited');
                });
            });
        });
    </script>
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
