<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $job->title }} - Job Details</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/js/all.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7fafc;
            padding: 50px 20px;
        }

        main {
            max-width: 900px;
            margin: 0 auto;
        }

        .job-card {
            background-color: white;
            border-radius: 20px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .job-card .header {
            position: relative;
        }

        .job-card .header img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .job-card .header img:hover {
            transform: scale(1.05);
        }

        .job-card .header .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(to bottom, transparent, rgba(0, 0, 0, 0.5));
        }

        .job-card .content {
            padding: 30px;
        }

        .job-card .content h1 {
            font-size: 30px;
            font-weight: bold;
            color: #1a202c;
            margin-bottom: 10px;
        }

        .job-card .content p.company-name {
            font-size: 18px;
            color: #718096;
        }

        .job-card .details {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 40px;
        }

        .job-card .details .detail {
            display: flex;
            align-items: center;
            color: #4a5568;
        }

        .job-card .details .detail i {
            margin-right: 8px;
            color: #3182ce;
        }

        .job-card .description,
        .job-card .requirements {
            margin-bottom: 40px;
        }

        .job-card .description h2,
        .job-card .requirements h2 {
            font-size: 22px;
            font-weight: bold;
            color: #1a202c;
            margin-bottom: 15px;
        }

        .job-card .description p,
        .job-card .requirements p {
            color: #4a5568;
            line-height: 1.8;
        }

        .job-card .apply-button {
            text-align: center;
        }

        .job-card .apply-button a {
            display: inline-block;
            padding: 15px 30px;
            background-color: #3182ce;
            color: white;
            font-weight: bold;
            border-radius: 10px;
            text-decoration: none;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .job-card .apply-button a:hover {
            background-color: #2b6cb0;
            transform: translateY(-4px);
        }

        .job-card .apply-button a i {
            margin-right: 10px;
        }
    </style>
</head>

<body>
    <main>
        <!-- Job Card -->
        <div class="job-card">
            <!-- Header Section -->
            <div class="header">
                @if ($job->image)
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
                </div>

                <!-- Key Details -->
                <div class="details">
                    @if ($job->location)
                        <div class="detail">
                            <i class="fas fa-map-marker-alt"></i>
                            <span>{{ $job->location }}</span>
                        </div>
                    @endif
                    @if ($job->created_at)
                        <div class="detail">
                            <i class="fas fa-calendar"></i>
                            <span>Posted: {{ $job->created_at->format('M d, Y') }}</span>
                        </div>
                    @endif
                    @if ($job->salary_range)
                        <div class="detail">
                            <i class="fas fa-money-bill-wave"></i>
                            <span>Salary: {{ number_format($job->salary_range, 2) }}</span>
                        </div>
                    @endif
                    @if ($job->closing_date)
                        <div class="detail">
                            <i class="fas fa-hourglass-end"></i>
                            <span>Closes: {{ $job->closing_date }}</span>
                        </div>
                    @endif
                </div>

                <!-- Description -->
                @if ($job->description)
                    <div class="description">
                        <h2>Job Description</h2>
                        <p>{{ $job->description }}</p>
                    </div>
                @endif

                <!-- Requirements -->
                @if ($job->requirements)
                    <div class="requirements">
                        <h2>Requirements</h2>
                        <p>{{ $job->requirements }}</p>
                    </div>
                @endif

                <!-- Apply Button -->
                <div class="apply-button">
                    <a href="#">
                        <i class="fas fa-paper-plane"></i>
                        Apply Now
                    </a>
                </div>
            </div>
        </div>
    </main>
</body>

</html>
