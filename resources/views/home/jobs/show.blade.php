<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $job->title }} - Job Details</title>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/js/all.min.js"></script>

    @vite(['resources/css/home.css', 'resources/js/app.js', 'resources/css/footer.css', 'resources/css/header.css'])
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7fafc;

        }

        main {
            max-width: 900px;
            margin: 0 auto;
            padding-top: 20px;
        }

        .job-cardn {
            background-color: white;
            border-radius: 20px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .job-cardn .header {
            position: relative;
        }

        .job-cardn .header img {
            width: 100%;
            height: auto;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .job-cardn .header img:hover {
            transform: scale(1.05);
        }

        .job-cardn .header .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(to bottom, transparent, rgba(0, 0, 0, 0.5));
        }

        .job-cardn .content {
            padding: 30px;
        }

        .job-cardn .content h1 {
            font-size: 30px;
            font-weight: bold;
            color: #1a202c;
            margin-bottom: 10px;
        }

        .job-cardn .content p.company-name {
            font-size: 18px;
            color: #718096;
        }

        .job-cardn .details {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 40px;
        }

        .job-cardn .details .detail {
            display: flex;
            align-items: center;
            color: #4a5568;
        }

        .job-cardn .details .detail i {

            margin-left: 5px;
            color: #3182ce;
        }

        .detail i {
            margin-left: 5px !important;
        }

        .job-cardn .description,
        .job-cardn .requirements {
            margin-bottom: 40px;
        }

        .job-cardn .description h2,
        .job-cardn .requirements h2 {
            font-size: 22px;
            font-weight: bold;
            color: #1a202c;
            margin-bottom: 15px;
        }

        .job-cardn .description p,
        .job-cardn .requirements p {
            color: #4a5568;
            line-height: 1.8;
        }

        .job-cardn .apply-button {
            text-align: center;
        }

        .job-cardn .apply-button a {
            display: inline-block;
            padding: 15px 30px;
            background-color: #3182ce;
            color: white;
            font-weight: bold;
            border-radius: 10px;
            text-decoration: none;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .job-cardn .apply-button a:hover {
            background-color: #2b6cb0;
            transform: translateY(-4px);
        }

        .job-cardn .apply-button a i {
            margin-right: 10px;
        }

        /* Button Styling */

        .back-button {
            position: fixed;

            background-color: white;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            border: none;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            z-index: 1000;
            color: white;
            background-color: blue;
        }

        .back-button i {
            color: #4a5568;
            font-size: 1.2rem;
        }

        .back-button:hover {
            transform: scale(1.1);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            background-color: white;
            color: blue;
        }

        .back-button:active {
            transform: scale(0.95);

        }

        .btn-apply {
            background-color: #007bff;
            color: white;
            font-size: 1.2rem;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.3s ease;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            margin-left: 40px;
        }

        .stat-icon {
            width: 56px;
            height: 56px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }

        /* Hover Effect */
        .btn-apply:hover {
            background-color: #0056b3;
            transform: scale(1.05);
            box-shadow: 0 6px 8px rgba(0, 0, 0, 0.15);
        }

        /* Active/Pressed Effect */
        .btn-apply:active {
            transform: scale(0.95);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        /* Animation */
        @keyframes button-bounce {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-5px);
            }
        }

        #apply {
            animation: button-bounce 1s infinite alternate;
        }


        .btn-flag {
            background-color: #e53e3e;
            color: white;
            font-size: 1.2rem;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.3s ease;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-left: 10px;
            margin-top: -150px;
            /* Add space above */
        }

        .btn-back {
            background-color: #4a5568;
            /* Gray color */
            color: white;
            font-size: 1rem;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.3s ease;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-top: -150px;
            /* Add space above */
        }

        .btn-back:hover {
            background-color: #2d3748;
            /* Darker gray */
            transform: scale(1.05);
            box-shadow: 0 6px 8px rgba(0, 0, 0, 0.15);
        }

        .btn-back:active {
            transform: scale(0.95);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        .backbutton {
            text-align: center;
            /* Center the button */
            margin-left: 650px;
            margin-bottom: -70px;

        }
    </style>

    <style>
        .btn-flag {
            background-color: #e53e3e;
            color: white;
            font-size: 1.2rem;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.3s ease;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-left: 10px;
            margin-top: -150px;
            /* Add space above */
        }

        .btn-back {
            background-color: #4a5568;
            /* Gray color */
            color: white;
            font-size: 1rem;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.3s ease;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-top: -150px;
            /* Add space above */
        }

        .btn-back:hover {
            background-color: #2d3748;
            /* Darker gray */
            transform: scale(1.05);
            box-shadow: 0 6px 8px rgba(0, 0, 0, 0.15);
        }

        .btn-back:active {
            transform: scale(0.95);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        .backbutton {
            text-align: center;
            /* Center the button */
            margin-left: 700px;
            margin-bottom: 20px;

        }

        /* Flag Button Styles */
        .flag-btn {
            background-color: yellow;
            /* Transparent background */
            border: none;
            /* Removes default button border */
            cursor: pointer;
            /* Changes cursor to pointer for interactivity */
            padding: 5px;
            /* Adds slight padding for clickability */
            transition: transform 0.2s ease-in-out, color 0.3s ease;
            /* Smooth hover and click effects */
            width: 30px;
        }

        /* Flag Button Hover Effect */
        .flag-btn:hover {
            transform: scale(1.1);
            /* Slight scaling on hover */
            color: red;
        }

        /* Icon Styles */
        .flag-btn i {
            font-size: 80px;
            /* Adjusts the icon size */
            color: rgb(255, 0, 0);
            /* Default icon color */
            transition: color 0.3s ease;
            /* Smooth color change */

        }

        /* Active Flag Icon Color */
        .flag-btn i.fa-flag {
            color: #ff4747;
            /* Red for flagged items */
        }

        /* Hover Effect for Unflagged Icons */
        .flag-btn i.fa-regular.fa-flag:hover {
            color: #007bff;
            /* Blue on hover for unflagged items */
        }
    </style>

    </style>
</head>

<body>
    @include('home.header')


    <main>
        <!-- Job Card -->
        <div class="job-cardn">
            <button class="back-button" onclick="window.history.back()">
                <i class="fas fa-arrow-left"></i>
            </button>
            <!-- Header Section -->
            <div class="header">
                @if (!empty($job->image))
                    <img src="{{ asset('storage/' . $job->image) }}" alt="Company banner">
                    <div class="overlay"></div>
                @endif

            </div>

            <!-- Content Section -->
            <div class="content">
                <!-- Job Title and Company -->
                <div class="job-title">
                    <h1>{{ $job->title }}</h1>
                    <p class="company-name">{{ $job->employer->company_name }}</p>
                    <p class="view-count"> <i class="fas fa-eye"></i>
                        <span>{{ $job->view_count }} views</span>
                    </p>
                </div>


                <!-- Key Details -->
                <div class="details">
                    @if (!empty($job->location))
                        <div class="">
                            <i class="fas fa-map-marker-alt"></i>
                            <span>{{ $job->location }}</span>
                        </div>
                    @endif
                    @if (!empty($job->country))
                        <div class="">
                            <i class="fas fa-map-marker-alt"></i>
                            <span>{{ $job->country }}</span>
                        </div>
                    @endif
                    @if (!empty($job->created_at))
                        <div class="">
                            <i class="fas fa-calendar"></i>
                            <span>Posted: {{ $job->created_at->format('M d, Y') }}</span>
                        </div>
                    @endif
                    @if (!empty($job->salary_range))
                        <div class="">
                            <i class="fas fa-money-bill-wave"></i>
                            <span>Salary: {{ number_format($job->salary_range, 2) }}</span>
                        </div>
                    @endif
                    @if (!empty($job->closing_date))
                        <div class="">
                            <i class="fas fa-hourglass-end"></i>
                            <span>Closes: {{ $job->closing_date }}</span>
                        </div>
                    @endif
                </div>

                <!-- Description -->
                @if (!empty($job->description))
                    <div class="description">
                        <h2>Job Description</h2>
                        <p>{{ $job->description }}</p>
                    </div>
                @endif

                <!-- Requirements -->
                @if (!empty($job->requirements))
                    <div class="requirements">
                        <h2>Requirements</h2>
                        <p>{{ $job->requirements }}</p>
                    </div>
                @endif



            </div>
            <div class="btn-group mb-4">
                <button class="btn btn-apply" id="apply">Apply Now</button>
                @auth
                    <button class="flag-btn" data-job-id="{{ $job->id }}">
                        <i
                            class="fa-solid {{ auth()->user()->flaggedJobs->contains($job->id)? 'fa-flag': 'fa-regular fa-flag' }}"></i>
                    </button>
                @endauth
            </div>


        </div>
        </div>
    </main>
    <!-- apply Options Content -->
    <div id="componentContainer-apply">

    </div>

    <!-- Script for Dynamic Component Loading -->
    <script>
        $(document).ready(function() {
            // Load Top Ads Component
            $('#apply').on('click', function() {
                const jobId = '{{ $job->id }}'; // Pass the job ID
                $('#componentContainer-apply').load(`/apply/${jobId}`);

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
