<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>myApplication</title>
    @vite(['resources/css/header.css', 'resources/js/app.js', 'resources/css/profileview.css', 'resources/css/home.css', 'resources/css/myapplication.css'])
</head>

<body>

    @include('user.jobseekerprofile.mainview.profilelayout')
    <div class="jobcontainer">
        <div class="jobsection">
            <h2>Recent Vacancies</h2>
            <div class="jobfilter">
                <label for="jobvacancy-filter">Recent Vacancies for:</label>
                <select id="jobvacancy-filter">
                    <option>All</option>
                    <!-- Add other options if needed -->
                </select>
                <p>Showing only recent 10 vacancies... <a href="#">View All</a></p>
            </div>

            @if ($applications->isEmpty())
                <p>No applications found.</p>
            @else
                <table>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Job Ref No.</th>
                            <th>Position and Employer</th>
                            <th>Closing Date</th>
                            <th>Apply Date</th>

                            <th>Details</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($applications as $index => $application)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $application->job->job_id }}</td>
                                <td>{{ $application->job->title }} <br> {{ $application->job->employer->company_name }}
                                </td>
                                <td>{{ $application->job->closing_date }}</td>
                                <td>{{ $application->created_at->format('Y-m-d') }}</td>

                                <td><a href="{{ route('user.jobseekerprofile.myjobs.view', $application->id) }}">Full
                                        View</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>

</body>

</html>
