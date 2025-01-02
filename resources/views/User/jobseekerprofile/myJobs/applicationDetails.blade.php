<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Application Details</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
        }

        body {
            background-color: #f5f7fb;
            color: #333;
            line-height: 1.6;
            padding: 2rem;
        }

        .jobdetails-container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            padding: 2rem;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #2d3748;
            font-size: 1.8rem;
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 2px solid #e2e8f0;
        }

        h3 {
            color: #4a5568;
            font-size: 1.3rem;
            margin: 1.5rem 0 1rem 0;
        }

        p {
            margin: 0.8rem 0;
            color: #4a5568;
        }

        strong {
            color: #2d3748;
            font-weight: 600;
            min-width: 150px;
            display: inline-block;
        }

        .back-btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background-color: #3182ce;
            color: white;
            padding: 0.7rem 1.2rem;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 500;
            margin-top: 2rem;
            transition: all 0.3s ease;
        }

        .back-btn:hover {
            background-color: #2c5282;
            transform: translateY(-1px);
        }

        .back-btn i {
            font-size: 0.9rem;
        }

        @media (max-width: 768px) {
            body {
                padding: 1rem;
            }

            .jobdetails-container {
                padding: 1.5rem;
            }

            strong {
                display: block;
                margin-bottom: 0.2rem;
            }
        }
    </style>
</head>

<body>
    <div class="jobdetails-container">
        <h2>Application Details</h2>

        <h3>Job Information</h3>
        <p><strong>Job Ref No:</strong> {{ $application->job->job_id }}</p>
        <p><strong>Position:</strong> {{ $application->job->title }}</p>
        <p><strong>Employer:</strong> {{ $application->job->employer->company_name }}</p>
        <p><strong>Description:</strong> {{ $application->job->description }}</p>
        <p><strong>Closing Date:</strong> {{ $application->job->closing_date }}</p>

        <h3>Your Application</h3>
        <p><strong>Name:</strong> {{ $application->name }}</p>
        <p><strong>Email:</strong> {{ $application->email }}</p>
        <p><strong>Contact Number:</strong> {{ $application->contact_number }}</p>
        <p><strong>Message:</strong> {{ $application->message }}</p>

        <p><strong>Submitted On:</strong> {{ $application->created_at->format('d M Y') }}</p>

        <a href="{{ route('profile.edit') }}" class="back-btn">
            <i class="fas fa-arrow-left"></i>
            Back to My Applications
        </a>
    </div>
</body>

</html>
