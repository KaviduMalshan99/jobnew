<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Job Applications</title>
    <link rel="stylesheet" href="styles.css">


</head>

<body>

    <br />
    <div class="jobcontainer">
        <div class="jobsection">
            <h2>My Applications</h2>
            <p><strong>Online Applications:</strong> None</p>
            <p><strong>Email Applications:</strong></p>
            <p class="note">Note: Applications only for the past 6 months are displayed.</p>
            <table>
                <thead>
                    <tr>
                        <th></th>
                        <th>Vacancy</th>
                        <th>Company</th>
                        <th>Date Applied</th>
                       
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td></td>
                        <td><a href="#">0001304267 - Lowcode Minds</a></td>
                        <td>Data Management Systems (Pvt) Ltd</td>
                        <td>2024/12/27 10:34 AM</td>


                    </tr>

                </tbody>
            </table>

                        
                       
                    </tr>
                  
                </tbody>
            </table>
            
        </div>

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
                                <td>{{ optional($job->jobPosting->closing_date)->format('Y/m/d h:i A') ?? 'N/A' }}</td>
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
            <p>You have not flagged any vacancies</p>
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
                    <tr>
                        <td></td>
                        <td>0001304267 - Lowcode Minds</a></td>
                        <td>Data Management Systems (Pvt) Ltd</td>
                        <td>2024/12/27 10:34 AM</td>
                        <td><a href="#">View&Apply</td>
                       
                    </tr>
                  
                </tbody>
            </table>
        </div>

        <div class="jobsection">
            <h2>Preferred Companies</h2>
            <p><a href="#">Add companies to my list...</a></p>
            <p>You do not have any preferred companies.</p>
        </div>

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
