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
        <h1 class="title">Top Employers</h1>
        <div class="filter-options">
            <label><input type="radio" name="filter" checked> All</label>
            <label><input type="radio" name="filter"> With Open Jobs</label>
            <label><input type="radio" name="filter"> By Industry</label>
            <label><input type="radio" name="filter"> Alphabetical</label>
        </div>
        <div class="employers-grid">

            @foreach ($topEmployers as $employer)
                <div class="employer-card">
                    <img src="{{ $employer->logo ? asset('storage/' . $employer->logo) : asset('images/default-logo.png') }}"
                        alt="{{ $employer['alt'] }}">
                </div>
            @endforeach

        </div>
    </div>
</body>

</html>
