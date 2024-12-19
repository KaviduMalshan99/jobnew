<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us Popup</title>
    @vite(['resources/css/header.css']) <!-- Laravel Vite for including CSS -->
</head>

<body>
    <header class="unique-header">
        <div class="logo">
            <img src="/images/jobss.png" alt="LOGO" width="120px" height="auto">
        </div>
        <nav class="nav-links unique-nav-links">
            <a href="/postjob">Post Your Vacancy</a>
            <a href="#">Happy Customers</a>
            <a href="#">Top Employers</a>
            <a href="#" id="contact-us-btn">Contact Us</a>
        </nav>
        <div class="search-bar unique-search-bar">
            <input type="text" placeholder="Search Job Titles">
            <button>Search</button>
        </div>
        <div class="auth-buttons unique-auth-buttons">
            <button class="login-btn unique-login-btn">LOG IN</button>
            <button class="signup-btn unique-signup-btn">SIGN UP</button>
        </div>
    </header>


    <!-- Include Contact Us Popup Blade Component -->
    {{-- @include('contactus.contactus') --}}

</body>

</html>
