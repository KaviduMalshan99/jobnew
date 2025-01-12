<?php
$email = request()->query('email');
$contact_number = request()->query('contact_number');
$message = request()->query('message');
$employer_id = request()->query('employer_id');
$job_posting_id = request()->query('job_posting_id');

// Optionally, you can use default values if the data isn't passed
$name = $name ?? '';
$email = $email ?? '';
$contact_number = $contact_number ?? '';
$message = $message ?? '';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CV - {{ $user->name }}</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #2c3e50;
            --secondary-color: #3498db;
            --text-color: #333;
            --light-gray: #f5f6fa;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Arial', sans-serif;
        }

        .download-btn {
            position: absolute;
            top: 20px;
            right: 20px;
            background: var(--secondary-color);
            color: white;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 0.9em;
            font-weight: bold;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: background 0.3s ease;
        }

        .download-btn:hover {
            background: #1a73e8;
        }

        @media print {
            .download-btn {
                display: none;
            }
        }

        body {
            color: var(--text-color);
            line-height: 1.6;
            max-width: 1000px;
            margin: 0 auto;
            padding: 20px;
            background: #fff;
        }

        .header {
            text-align: center;
            padding: 40px 0;
            background: var(--light-gray);
            border-radius: 8px;
            margin-bottom: 30px;
        }

        .header h1 {
            color: var(--primary-color);
            font-size: 2.5em;
            margin-bottom: 10px;
        }

        .contact-info {
            display: flex;
            justify-content: center;
            gap: 20px;
            flex-wrap: wrap;
            margin: 20px 0;
            padding: 0 20px;
        }

        .contact-item {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 5px 10px;
            background-color: white;
            border-radius: 5px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .contact-item i {
            color: var(--secondary-color);
        }

        .section {
            margin: 30px 0;
            padding: 0 20px;
        }

        .section-title {
            color: var(--primary-color);
            font-size: 1.5em;
            border-bottom: 2px solid var(--secondary-color);
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .summary {
            text-align: justify;
            margin-bottom: 30px;
            padding: 20px;
            background: var(--light-gray);
            border-radius: 8px;
        }

        .experience-item,
        .education-item {
            margin-bottom: 25px;
            padding: 20px;
            background: var(--light-gray);
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        .experience-header,
        .education-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 15px;
        }

        .job-title,
        .degree {
            color: var(--primary-color);
            font-weight: bold;
            font-size: 1.2em;
            margin-bottom: 5px;
        }

        .company-name,
        .institution {
            color: var(--secondary-color);
            font-weight: 600;
            font-size: 1.1em;
        }

        .date-range {
            color: #666;
            font-style: italic;
            background: white;
            padding: 5px 10px;
            border-radius: 4px;
            font-size: 0.9em;
        }

        .job-description {
            margin-top: 15px;
            line-height: 1.6;
            color: #444;
        }

        .social-links {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 20px;
        }

        .social-link {
            color: var(--secondary-color);
            text-decoration: none;
            padding: 8px 15px;
            background: white;
            border-radius: 5px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .social-link:hover {
            transform: translateY(-2px);
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }

        @media (max-width: 768px) {
            body {
                padding: 10px;
            }

            .header {
                padding: 20px;
            }

            .contact-info {
                flex-direction: column;
                align-items: center;
            }

            .experience-header,
            .education-header {
                flex-direction: column;
            }

            .date-range {
                margin-top: 10px;
            }
        }
    </style>
</head>

<body>

    <div class="header">
        <h1>{{ $user->name }}</h1>
        <div style="text-align: center; margin-bottom: 20px;">
            {{-- <a href="{{ route('generate.cv') }}" class="download-btn"
                style="{{ isset($hideButton) && $hideButton ? 'display: none;' : '' }}">
                <i class="fas fa-download"></i> Download as PDF
            </a> --}}
            <form action="{{ route('generate.cv') }}" method="POST">
                @csrf
                <!-- Hidden fields -->
                <input type="hidden" name="name" value="{{ $name ?? auth()->user()->name }}">
                <input type="hidden" name="email" value="{{ $email ?? $user->email }}">
                <input type="hidden" name="contact_number" value="{{ $contact_number ?? $user->phone_number }}">
                <input type="hidden" name="employer_id" value="{{ $employer_id }}">
                <input type="hidden" name="job_posting_id" value="{{ $job_posting_id }}">
                <input type="hidden" name="message" value="{{ $message }}">

                <!-- For debugging -->
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <button type="submit" class="download-btn"
                    style="{{ isset($hideButton) && $hideButton ? 'display: none;' : '' }}">
                    Submit
                </button>
            </form>
        </div>
        <div id="cv-content">
            <!-- CV content starts here -->
        </div>


        <div class="contact-info">
            @if ($user->email)
                <div class="contact-item">
                    <i class="fas fa-envelope"></i>
                    {{ $user->email }}
                </div>
            @endif
            @if ($user->phone_number)
                <div class="contact-item">
                    <i class="fas fa-phone"></i>
                    {{ $user->phone_number }}
                </div>
            @endif
            @if ($user->address)
                <div class="contact-item">
                    <i class="fas fa-map-marker-alt"></i>
                    {{ $user->address }}
                </div>
            @endif
        </div>
        <div class="social-links">
            @if ($user->linkedin)
                <a href="{{ $user->linkedin }}" class="social-link">
                    <i class="fab fa-linkedin"></i> LinkedIn
                </a>
            @endif
            @if ($user->portfolio_link)
                <a href="{{ $user->portfolio_link }}" class="social-link">
                    <i class="fas fa-globe"></i> Portfolio
                </a>
            @endif
        </div>
    </div>

    @if ($user->summary)
        <div class="section">
            <h2 class="section-title">Professional Summary</h2>
            <div class="summary">
                {{ $user->summary }}
            </div>
        </div>
    @endif

    @if ($experiences && $experiences->count() > 0)
        <div class="section">
            <h2 class="section-title">Work Experience</h2>
            @foreach ($experiences as $experience)
                <div class="experience-item">
                    <div class="experience-header">
                        <div>
                            <div class="job-title">{{ $experience->job_title }}</div>
                            <div class="company-name">{{ $experience->company_name }}</div>
                        </div>
                        <div class="date-range">
                            {{ \Carbon\Carbon::parse($experience->start_date)->format('M Y') }} -
                            {{ $experience->end_date ? \Carbon\Carbon::parse($experience->end_date)->format('M Y') : 'Present' }}
                        </div>
                    </div>
                    <div class="job-description">
                        {{ $experience->job_description }}
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    @if ($educations && $educations->count() > 0)
        <div class="section">
            <h2 class="section-title">Education</h2>
            @foreach ($educations as $education)
                <div class="education-item">
                    <div class="education-header">
                        <div>
                            <div class="degree">{{ $education->degree }} in {{ $education->field_of_study }}</div>
                            <div class="institution">{{ $education->institution_name }}</div>
                        </div>
                        <div class="date-range">
                            {{ \Carbon\Carbon::parse($education->start_date)->format('M Y') }} -
                            {{ $education->end_date ? \Carbon\Carbon::parse($education->end_date)->format('M Y') : 'Present' }}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

</body>

</html>
