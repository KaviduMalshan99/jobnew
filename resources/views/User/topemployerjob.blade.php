<!-- resources/views/top-employers.blade.php -->
<!DOCTYPE html>
<html lang="en">
<style>
    /* resources/css/topemployees.css */
    .job-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
        margin-top: 20px;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }

    .job-table th {
        background-color: #007bff;
        /* Primary color for header */
        color: #fff;
        text-align: left;
        padding: 12px 16px;
        font-weight: bold;
    }

    .job-table td {
        padding: 12px 16px;
        color: #333;
        border-bottom: 1px solid #f0f0f0;
    }

    .job-table tr:last-child td {
        border-bottom: none;
    }

    .job-table tr:hover {
        background-color: #f8f9fa;
        /* Light gray hover effect */
    }

    .job-table tr:nth-child(even) {
        background-color: #fdfdfd;
    }

    .job-table th:first-child,
    .job-table td:first-child {
        border-top-left-radius: 8px;
        border-bottom-left-radius: 8px;
    }

    .job-table th:last-child,
    .job-table td:last-child {
        border-top-right-radius: 8px;
        border-bottom-right-radius: 8px;
    }

    .job-table a {
        color: #007bff;
        text-decoration: none;
    }

    .job-table a:hover {
        text-decoration: underline;
    }
</style>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Top Employers</title>
    @vite(['resources/css/topemployees.css'])
</head>

<body>
    @include('home.header')
    <div class="container">
        <h1>Jobs by {{ $employer->name }}</h1>

        @if ($jobs->isEmpty())
            <p>No jobs posted by this employer yet.</p>
        @else
            <table class="job-table">
                <thead>
                    <tr>
                        <th>Job Title</th>
                        <th>Location</th>
                        <th>Closing Date</th>
                        <th>Details</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($jobs as $job)
                        <tr>
                            <td>{{ $job->title }}</td>
                            <td>{{ $job->location }}</td>
                            <td>{{ $job->closing_date }}</td>
                            <td>
                                <a href="{{ route('job.details', $job->id) }}">View Details</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</body>

</html>
