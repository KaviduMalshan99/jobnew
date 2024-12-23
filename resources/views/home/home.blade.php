<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link rel="stylesheet" href="styles.css">
    @vite(['resources/css/home.css', 'resources/js/app.js', 'resources/css/footer.css'])

</head>

<body>

    @include('home.header')

    <main>
        <!-- Feedback Section -->
        <section class="feedback-section">
            <div class="rectangle"></div>
            <button class="feedback-btn">Jobs Feedback</button>
        </section><br />

        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Job Categories</title>
            @vite('resources/css/app.css')
            <style>
                /* Additional custom styles for enhanced interactivity */
                .category-card {
                    @apply relative overflow-hidden group;
                }

                .category-card::before {
                    content: '';
                    @apply absolute inset-0 bg-gradient-to-br from-blue-100 to-blue-200 opacity-0 group-hover:opacity-100 transition-opacity duration-500 transform scale-110 group-hover:scale-100;
                }

                .main-category {
                    @apply relative z-10 transition-all duration-300 hover:shadow-lg hover:ring-4 hover:ring-blue-200;
                }

                .subcategory-enter {
                    animation: subcategory-slide-in 0.5s ease-out;
                }

                @keyframes subcategory-slide-in {
                    from {
                        opacity: 0;
                        transform: translateY(20px);
                    }

                    to {
                        opacity: 1;
                        transform: translateY(0);
                    }
                }

                .subcategory-card {
                    @apply relative overflow-hidden group;
                }

                .subcategory-card::after {
                    content: '';
                    @apply absolute bottom-0 left-0 right-0 h-1 bg-blue-500 transform -translate-x-full group-hover:translate-x-0 transition-transform duration-300;
                }
            </style>
        </head>

        <body class="bg-gray-50">
            <div class="job-categories-wrapper max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 ">
                <!-- Job Category List -->
                <section class="job-categories-wrapper max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
                    <div class="job-categories-container bg-white shadow-md rounded-md p-6">
                        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-4">
                            @foreach ($categories as $category)
                                <a href="javascript:void(0);" data-category-id="{{ $category->id }}"
                                    class="block px-4 py-2 text-blue-700 font-bold text-sm bg-blue-50 border border-blue-100 rounded-md
                                   hover:bg-blue-100 hover:text-blue-900 transition category-link">
                                    {{ $category->name }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                </section>


            </div>

            <hr class="hr" />

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

            <hr class="hr2" /><br />

            <!-- Full Job Listings -->
            <section id="job-listings" class="job-listings-container">
                @if ($jobs->isEmpty())
                    <p>No jobs found matching your criteria.</p>
                @else
                    <div class="job-listings">
                        @foreach ($jobs as $job)
                            <div class="job-card">
                                <a href="{{ route('job.details', $job->id) }}" class="job-title">
                                    {{ $job->title }}
                                </a>
                                <p>{{ $job->employer->company_name }}</p>
                                <p>{{ $job->location }}</p>
                            </div>
                        @endforeach
                    </div>
                @endif
            </section>

    </main><br />

    @include('home.footer')

</body>

</html>
