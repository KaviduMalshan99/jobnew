<!-- resources/views/top-employers.blade.php -->
<!DOCTYPE html>
<html lang="en">

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
            <ul class="job-list">
                @foreach ($jobs as $job)
                    <li>
                        <a href="{{ route('job.details', $job->id) }}">{{ $job->title }}</a>
                        <p>{{ $job->location }}</p>
                        <p>Closing Date: {{ $job->closing_date }}</p>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
</body>

</html>
