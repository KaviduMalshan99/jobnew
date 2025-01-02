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
            <a href="/">
                <img src="/images/jobss.png" alt="LOGO" width="120px" height="auto">
            </a>
        </div>
        <nav class="nav-links unique-nav-links">
            <a href="/postjob">Post Your Vacancy</a>
            <a href="#">Happy Customers</a>
            <a href="/topemployees">Top Employers</a>
            <a href="#" id="contact-us-btn">Contact Us</a>
        </nav>
        <div class="search-bar unique-search-bar">
            <input type="text" placeholder="Search Job Titles" id="search-input" class="animated-input">
            <button id="search-button" class="animated-button">Search</button>
        </div>



        </div>
        <div class="auth-buttons unique-auth-buttons">
            <button id="login-button" class="login-btn unique-login-btn">LOG IN</button>
            <button id="signup-button" class="signup-btn unique-signup-btn">SIGN UP</button>
        </div>
        <!-- Profile Dropdown -->
        <div class="profile-dropdown">
            <!-- Replace Button with Image -->
            <img src="/images/profileimage.png" alt="Profile Image" class="profile-image">
            <div class="profile-dropdown-content">
                <x-dropdown-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-dropdown-link>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-dropdown-link :href="route('logout')"
                        onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-dropdown-link>
                </form>
            </div>
        </div>
    </header>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>
        const searchButton = document.getElementById('search-button');
        const searchInput = document.getElementById('search-input');
        let hideTimeout;

        // Function to show the input bar
        function showInputBar() {
            clearTimeout(hideTimeout); // Clear any previous hide timeout
            searchInput.classList.add('visible');
        }

        // Function to hide the input bar
        function hideInputBar() {
            hideTimeout = setTimeout(() => {
                searchInput.classList.remove('visible');
            }, 10000); // Hide after 10 seconds
        }

        // Event listeners for the search button
        searchButton.addEventListener('mouseover', () => {
            showInputBar();
            hideInputBar(); // Start hide timer
        });

        searchButton.addEventListener('mouseout', () => {
            hideInputBar();
        });

        // Reset timer when the input is hovered over
        searchInput.addEventListener('mouseover', () => {
            clearTimeout(hideTimeout);
        });

        searchInput.addEventListener('mouseout', () => {
            hideInputBar();
        });
        $(document).ready(function() {
            $('#login-button').on('click', function() {
                window.location.href = '/login';
            });

            $('#signup-button').on('click', function() {
                window.location.href = '/register';
            });
        });
    </script>

    <!-- Include Contact Us Popup Blade Component -->
    @include('contactus.contactus')
</body>

</html>
