<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FlaggedJobs</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    @vite(['resources/css/header.css', 'resources/js/app.js', 'resources/css/profileview.css', 'resources/css/home.css', 'resources/css/myapplication.css'])
</head>

<body>
    @include('user.jobseekerprofile.mainview.profilelayout')
    <div class="jobcontainer">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <div class="jobsection">
            <h2>Flagged Vacancies</h2>
            @if ($flaggedJobs->isEmpty())
                <p>You have not flagged any vacancies</p>
            @else
                <table>
                    <thead>
                        <tr>
                            <th></th>
                            <th>Vacancy</th>
                            <th>Company</th>
                            <th>Closing Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($flaggedJobs as $job)
                            <tr>
                                <td>
                                    @if ($job->jobPosting)
                                        <form method="POST" action="{{ route('jobs.flag', $job->jobPosting->id) }}">
                                            @csrf
                                            <button type="submit" class="unflag-btn" title="Unflag this job">
                                                <i class="fa fa-flag"></i>
                                            </button>
                                        </form>
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td>{{ $job->jobPosting->title ?? 'N/A' }}</td>
                                <td>{{ $job->jobPosting->employer->company_name ?? 'N/A' }}</td>
                                <td>{{ $job->jobPosting->closing_date ?? 'N/A' }}</td>
                                <td>
                                    @if ($job->jobPosting)
                                        <a href="{{ route('job.details', $job->jobPosting->id) }}">View & Apply</a>
                                    @else
                                        N/A
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif

        </div>
    </div>
    <script></script>
</body>

</html>
