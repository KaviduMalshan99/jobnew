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
                                <a href=""
                                    class="block px-4 py-2 text-blue-700 font-bold text-sm bg-blue-50 border border-blue-100 rounded-md
                                          hover:bg-blue-100 hover:text-blue-900 transition">
                                    {{ $category->name }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                </section>

                <!-- Subcategories Section -->
                <section id="subcategories-section"
                    class="subcategories-section hidden mt-12 bg-white shadow-2xl rounded-2xl overflow-hidden
                                transition-all duration-700 ease-in-out">
                    <div class="subcategories-container p-8">
                        <h4 id="selected-category-name"
                            class="text-3xl font-extrabold text-center text-blue-700 mb-10
                                   tracking-tight uppercase">
                        </h4>

                        <div id="subcategories-list" class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6"></div>
                    </div>
                </section>
            </div>

            <hr class="hr" />

            <!-- Filters Section -->
            <section class="filters">
                <input class="text-input" type="text" placeholder="Enter Vacancy Name/Company/Job Reference">
                <input class="text-input" type="text" id="town-input" list="town-options"
                    placeholder="Type and Select a Town Name" />
                <datalist id="town-options">
                    <option value="Town 1"></option>
                    <option value="Town 2"></option>
                    <option value="Town 3"></option>
                    <option value="Town 4"></option>
                </datalist>
                <button class="view-btn">View As List</button>
            </section>

            <hr class="hr2" /><br />

            <!-- Full Job Listings -->
            <section class="job-listingsss-container">
                <div class="ob-listingsss">
                    @foreach ($jobs->chunk(4) as $jobChunk)
                        <!-- Divide job postings into rows of 4 -->
                        <div class="job-listings-row">
                            @foreach ($jobChunk as $job)
                                <div class="job-card">
                                    <a href="{{ route('job.details', $job->id) }} class="job-title">
                                        {{ $job->title }}
                                    </a>
                                    <p>{{ $job->employer->company_name }}</p>
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                </div>
            </section>

    </main><br />

    @include('home.footer')

</body>

</html>
