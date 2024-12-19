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
            <div class="job-categories-wrapper max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
                <!-- Job Category List -->
                <section class="job-titles-section bg-white shadow-2xl rounded-2xl overflow-hidden">
                    <div class="job-titles-container grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8 p-8">
                        @foreach ($categories as $category)
                            <div class="job-titles-column text-center category-card">
                                <h4 class="category-title">
                                    <a href="#"
                                        class="main-category block px-6 py-4 text-blue-700 font-bold text-lg
                                              bg-white border border-blue-100
                                              rounded-xl
                                              transition-all duration-300
                                              hover:bg-blue-50 hover:text-blue-900
                                              hover:translate-y-[-5px]"
                                        data-category-id="{{ $category->id }}">
                                        <span class="block">{{ $category->name }}</span>
                                        <span class="text-sm text-gray-500 mt-2 block">
                                            {{ $category->jobs_count ?? 'Explore' }} Jobs
                                        </span>
                                    </a>
                                </h4>
                            </div>
                        @endforeach
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
                <div class="job-listingsss">
                    <!-- First row with job cards -->
                    <div class="job-listingsss-row">
                        <div class="job-card">
                            <a href="job-details.html" class="job-title">Assistant Manager - Sales & Marketing</a>
                            <p>Cleanline Linen Management (Pvt) Ltd</p>
                        </div>
                        <div class="job-card">
                            <a href="job-details.html" class="job-title">Finance Controller - Fiji</a>
                            <p>Ba Industries Pte Ltd</p>
                        </div>
                        <div class="job-card">
                            <a href="job-details.html" class="job-title">Trainee Technical Consultant - D365</a>
                            <p>Business Central</p>
                        </div>
                        <div class="job-card">
                            <a href="job-details.html" class="job-title">Receptionist (Female)</a>
                            <p>Sky Sport Lanka (Pvt) Ltd</p>
                        </div>
                    </div>

                    <!-- Second row with job cards -->
                    <div class="job-listingsss-row">
                        <div class="job-card">
                            <a href="job-details.html" class="job-title">Senior Waiter | Commi</a>
                            <p>The Bungalow Galle Fort</p>
                        </div>
                        <div class="job-card">
                            <a href="job-details.html" class="job-title">Accounts Assistant</a>
                            <p>B Plus (Pvt) Ltd</p>
                        </div>
                        <div class="job-card">
                            <a href="job-details.html" class="job-title">Senior Waiter | Commi</a>
                            <p>The Bungalow Galle Fort</p>
                        </div>
                        <div class="job-card">
                            <a href="job-details.html" class="job-title">Accounts Assistant</a>
                            <p>B Plus (Pvt) Ltd</p>
                        </div>
                    </div>

                    <!-- Third row with job cards -->
                    <div class="job-listingsss-row">
                        <div class="job-card">
                            <a href="job-details.html" class="job-title">Senior Waiter | Commi</a>
                            <p>The Bungalow Galle Fort</p>
                        </div>
                        <div class="job-card">
                            <a href="job-details.html" class="job-title">Accounts Assistant</a>
                            <p>B Plus (Pvt) Ltd</p>
                        </div>
                        <div class="job-card">
                            <a href="job-details.html" class="job-title">Senior Waiter | Commi</a>
                            <p>The Bungalow Galle Fort</p>
                        </div>
                        <div class="job-card">
                            <a href="job-details.html" class="job-title">Accounts Assistant</a>
                            <p>B Plus (Pvt) Ltd</p>
                        </div>
                    </div>

                    <!-- Third row with job cards -->
                    <div class="job-listingsss-row">
                        <div class="job-card">
                            <a href="job-details.html" class="job-title">Senior Waiter | Commi</a>
                            <p>The Bungalow Galle Fort</p>
                        </div>
                        <div class="job-card">
                            <a href="job-details.html" class="job-title">Accounts Assistant</a>
                            <p>B Plus (Pvt) Ltd</p>
                        </div>
                        <div class="job-card">
                            <a href="job-details.html" class="job-title">Senior Waiter | Commi</a>
                            <p>The Bungalow Galle Fort</p>
                        </div>
                        <div class="job-card">
                            <a href="job-details.html" class="job-title">Accounts Assistant</a>
                            <p>B Plus (Pvt) Ltd</p>
                        </div>
                    </div>
                    <!-- Third row with job cards -->
                    <div class="job-listingsss-row">
                        <div class="job-card">
                            <a href="job-details.html" class="job-title">Senior Waiter | Commi</a>
                            <p>The Bungalow Galle Fort</p>
                        </div>
                        <div class="job-card">
                            <a href="job-details.html" class="job-title">Accounts Assistant</a>
                            <p>B Plus (Pvt) Ltd</p>
                        </div>
                        <div class="job-card">
                            <a href="job-details.html" class="job-title">Senior Waiter | Commi</a>
                            <p>The Bungalow Galle Fort</p>
                        </div>
                        <div class="job-card">
                            <a href="job-details.html" class="job-title">Accounts Assistant</a>
                            <p>B Plus (Pvt) Ltd</p>
                        </div>
                    </div>
                    <!-- Third row with job cards -->
                    <div class="job-listingsss-row">
                        <div class="job-card">
                            <a href="job-details.html" class="job-title">Senior Waiter | Commi</a>
                            <p>The Bungalow Galle Fort</p>
                        </div>
                        <div class="job-card">
                            <a href="job-details.html" class="job-title">Accounts Assistant</a>
                            <p>B Plus (Pvt) Ltd</p>
                        </div>
                        <div class="job-card">
                            <a href="job-details.html" class="job-title">Senior Waiter | Commi</a>
                            <p>The Bungalow Galle Fort</p>
                        </div>
                        <div class="job-card">
                            <a href="job-details.html" class="job-title">Accounts Assistant</a>
                            <p>B Plus (Pvt) Ltd</p>
                        </div>
                    </div>
                    <!-- Third row with job cards -->
                    <div class="job-listingsss-row">
                        <div class="job-card">
                            <a href="job-details.html" class="job-title">Senior Waiter | Commi</a>
                            <p>The Bungalow Galle Fort</p>
                        </div>
                        <div class="job-card">
                            <a href="job-details.html" class="job-title">Accounts Assistant</a>
                            <p>B Plus (Pvt) Ltd</p>
                        </div>
                        <div class="job-card">
                            <a href="job-details.html" class="job-title">Senior Waiter | Commi</a>
                            <p>The Bungalow Galle Fort</p>
                        </div>
                        <div class="job-card">
                            <a href="job-details.html" class="job-title">Accounts Assistant</a>
                            <p>B Plus (Pvt) Ltd</p>
                        </div>
                    </div>
                    <!-- Third row with job cards -->
                    <div class="job-listingsss-row">
                        <div class="job-card">
                            <a href="job-details.html" class="job-title">Senior Waiter | Commi</a>
                            <p>The Bungalow Galle Fort</p>
                        </div>
                        <div class="job-card">
                            <a href="job-details.html" class="job-title">Accounts Assistant</a>
                            <p>B Plus (Pvt) Ltd</p>
                        </div>
                        <div class="job-card">
                            <a href="job-details.html" class="job-title">Senior Waiter | Commi</a>
                            <p>The Bungalow Galle Fort</p>
                        </div>
                        <div class="job-card">
                            <a href="job-details.html" class="job-title">Accounts Assistant</a>
                            <p>B Plus (Pvt) Ltd</p>
                        </div>
                    </div>
                    <!-- Third row with job cards -->
                    <div class="job-listingsss-row">
                        <div class="job-card">
                            <a href="job-details.html" class="job-title">Senior Waiter | Commi</a>
                            <p>The Bungalow Galle Fort</p>
                        </div>
                        <div class="job-card">
                            <a href="job-details.html" class="job-title">Accounts Assistant</a>
                            <p>B Plus (Pvt) Ltd</p>
                        </div>
                        <div class="job-card">
                            <a href="job-details.html" class="job-title">Senior Waiter | Commi</a>
                            <p>The Bungalow Galle Fort</p>
                        </div>
                        <div class="job-card">
                            <a href="job-details.html" class="job-title">Accounts Assistant</a>
                            <p>B Plus (Pvt) Ltd</p>
                        </div>
                    </div>
                    <!-- Third row with job cards -->
                    <div class="job-listingsss-row">
                        <div class="job-card">
                            <a href="job-details.html" class="job-title">Senior Waiter | Commi</a>
                            <p>The Bungalow Galle Fort</p>
                        </div>
                        <div class="job-card">
                            <a href="job-details.html" class="job-title">Accounts Assistant</a>
                            <p>B Plus (Pvt) Ltd</p>
                        </div>
                        <div class="job-card">
                            <a href="job-details.html" class="job-title">Senior Waiter | Commi</a>
                            <p>The Bungalow Galle Fort</p>
                        </div>
                        <div class="job-card">
                            <a href="job-details.html" class="job-title">Accounts Assistant</a>
                            <p>B Plus (Pvt) Ltd</p>
                        </div>
                    </div>
                </div>

    </main><br />

    @include('home.footer')

</body>

</html>
