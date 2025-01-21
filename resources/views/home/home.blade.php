<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HomePage</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    @vite(['resources/css/home.css', 'resources/js/app.js', 'resources/css/footer.css', 'resources/css/header.css'])

    <style>
        .dropdown {
            padding: 8px;
            margin: 10px 0;
            width: 100%;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
        }

        < !-- Replace only the slider styles in the <style>section -->.ads-banner {
            width: 100%;
            max-width: 1200px;
            margin: 20px auto;
            position: relative;
            overflow: hidden;
        }

        .slider-container {
            position: relative;
            height: 400px;
            overflow: hidden;
        }

        .slider {
            position: relative;
            height: 100%;
        }

        .slide {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            transform: translateY(100%);
            transition: opacity 0.5s ease, transform 0.5s ease;
        }

        .slide.active {
            opacity: 1;
            transform: translateY(0);
        }

        .slide img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .slider-btn {
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            background-color: rgba(0, 0, 0, 0.5);
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            z-index: 10;
            transition: background-color 0.3s;
        }

        .slider-btn:hover {
            background-color: rgba(0, 0, 0, 0.8);
        }

        .prev {
            top: 10px;
        }

        .next {
            bottom: 10px;
        }
    </style>
</head>

<body>
    @include('home.header')

    <!-- Categories Section -->
    <section class="categories-container">
        <div class="categories-header">
            <a href="/login" class="jobseeker-btn">JOBSEEKER LOGIN</a>
            {{-- <a href="{{ route('feedback.home') }}" class=" feedback-btn2">Feedback</a> --}}
            <a href="{{ route('employer.login') }}" class=" employer-btn">EMPLOYER LOGIN</a>

        </div>
        <div class="scroll-wrapper">
            <button class="scroll-btn left-scroll" id="scrollLeft">
                << </button>
                    <div class="categories-list" id="categoriesList">
                        @foreach ($categories as $category)
                            <a href="javascript:void(0);" data-category-id="{{ $category->id }}" class="category-link">
                                {{ $category->name }}
                            </a>
                        @endforeach
                    </div>
                    <button class="scroll-btn right-scroll" id="scrollRight">>></button>
        </div>
    </section>
    <div class="ads-banner" id="rotatingSidebar">
        <img id="rotatingImage" src="{{ asset('assets/images/ads.jpg') }}" alt="Rotating Ad"
            class="img-fluid w-100 h-100">
    </div>

    <!-- Filters Section -->
    <section class="filters">
        <p class="jobtitle">
            Available Jobs: {{ $jobs->count() }} new hot jobs
        </p>
        <form method="GET" action="{{ route('home') }}">
            <input class="text-input" type="text" name="search"
                placeholder="Enter Vacancy Name/Company/Job Reference" value="{{ request('search') }}">
            <input class="text-input" type="text" name="location" placeholder="Enter your Location"
                value="{{ request('location') }}">

            <select name="country" class="dropdown">
                <option value="">Select Country</option>
                @foreach ($countries as $country)
                    <option value="{{ $country->country }}"
                        {{ request('country') == $country->country ? 'selected' : '' }}>
                        {{ $country->country }}
                    </option>
                @endforeach
            </select>


            <button class="view-btn" type="submit">
                <i class="fa fa-search"></i> <!-- This is the search icon -->
            </button>
        </form>
        <hr>
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
            const categoryIdInput = document.getElementById('selected-category-id');

            categoryLinks.forEach(link => {
                link.addEventListener('click', function() {
                    const categoryId = this.getAttribute('data-category-id');
                    categoryIdInput.value = categoryId;
                    document.querySelector('form').submit();
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
    <script>
        document.getElementById('scrollLeft').addEventListener('click', function() {
            document.getElementById('categoriesList').scrollBy({
                left: -100,
                behavior: 'smooth'
            });
        });

        document.getElementById('scrollRight').addEventListener('click', function() {
            document.getElementById('categoriesList').scrollBy({
                left: 100,
                behavior: 'smooth'
            });
        });
    </script>


</body>

</html>
