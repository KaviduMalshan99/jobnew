<!DOCTYPE html>
<html>

<head>
    <title>CV - {{ $user->name }}</title>
</head>

<body>
    <h1>{{ $user->name }}</h1>
    <p>Email: {{ $user->email }}</p>
    <p>Phone: {{ $user->phone_number }}</p>
    <p>Address: {{ $user->address }}</p>

    <h2>Work Experience</h2>
    @foreach ($experiences as $experience)
        <div>
            <h3>{{ $experience->job_title }} at {{ $experience->company_name }}</h3>
            <p>{{ $experience->start_date }} - {{ $experience->end_date ?? 'Present' }}</p>
            <p>{{ $experience->job_description }}</p>
        </div>
    @endforeach

    <h2>Education</h2>
    @foreach ($educations as $education)
        <div>
            <h3>{{ $education->degree }} in {{ $education->field_of_study }}</h3>
            <p>{{ $education->institution_name }}</p>
            <p>{{ $education->start_date }} - {{ $education->end_date }}</p>
        </div>
    @endforeach
</body>

</html>
