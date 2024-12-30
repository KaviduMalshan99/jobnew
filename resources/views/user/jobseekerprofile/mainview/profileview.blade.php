<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    @vite(['resources/css/header.css', 'resources/js/app.js', 'resources/css/profileview.css', 'resources/css/home.css', 'resources/css/education.css', 'resources/css/myapplication.css'])
</head>

<body>
    @include('home.header')
    <h1 class="maintopic">My Profile</h1>
    <div class=profileview-container>
        <div class ="profileview-header">
            Profile View
        </div>
        <br />
        <p>Manage your CV, photograph, certificates, online profile. featured employers, View/Edit your login details.
        </p>,<br />
        <div class="btn-group mb-4">
            <button class="btn btn-common" id="commonprofile">Common Profile</button>
            <button class="btn btn-personal" id="personalprofile">Personal Profile</button>
            <button class="btn btn-education" id="education">Education</button>
            <button class="btn btn-expirience" id="expirience">Expirience</button>
            <button class="btn btn-cv" id="cv">Create Resume</button>
        </div>
    </div>
    <br />

    <div class=profileview-container>
        <div class ="profileview-header">
            My Jobs
        </div>
        <br />
        <p>Manage your CV, photograph, certificates, online profile. featured employers, View/Edit your login details.
        </p>,<br />
        <div class="btn-group mb-4">
            <button class="btn btn-common" id="myapplication">My Applications</button>
            <button class="btn btn-personal" id="flagged">Flagged Jobs</button>
            <button class="btn btn-education" id="preferred">Preferred Companies</button>
            <button class="btn btn-expirience" id="recent">Recent Jobs</button>
        </div>
    </div>

    <div class=profileview-container>
        <div class ="profileview-header">
            My Preferences
        </div>
        <br />
        <p>Choose how job information is delivered; configure your account</p>,<br />
        <div class="btn-group mb-4">
            <button class="btn btn-common" id="jobalerts">Job Alerts</button>

        </div>
    </div>



    <!-- Component Content Section -->
    <div id="componentContainer">
        @include('user.jobseekerprofile.jobseekerprofile')

    </div>

    <!-- Script for Dynamic Component Loading -->
    <script>
        $(document).ready(function() {
            // my profile
            $('#commonprofile').on('click', function() {
                $('#componentContainer').load('{{ route('user.jobseekerprofile.jobseekerprofile') }}');

            });
            $('#cv').on('click', function() {
                window.location.href = '{{ route('generate.index') }}';
            });



            $('#personalprofile').on('click', function() {
                $('#componentContainer').load('{{ route('user.jobseekerprofile.personal') }}');

            });


            $('#education').on('click', function() {
                $('#componentContainer').load('{{ route('user.jobseekerprofile.education') }}');
            });

            $('#expirience').on('click', function() {
                $('#componentContainer').load('{{ route('user.jobseekerprofile.expirience') }}');
            });

            //my Jobs

            $('#myapplication').on('click', function() {
                console.log('My Applications clicked');
                $('#componentContainer').load('{{ route('user.jobseekerprofile.myjobs.myapplication') }}');
                window.scrollTo(0, 0);
            });
            $('#flagged').on('click', function() {
                $('#componentContainer').load('{{ route('user.jobseekerprofile.myjobs.myapplication') }}');
                window.scrollTo(0, 0);
            });
            $('#preferred').on('click', function() {
                $('#componentContainer').load('{{ route('user.jobseekerprofile.myjobs.myapplication') }}');
                window.scrollTo(0, 0);
            });
            $('#recent').on('click', function() {
                $('#componentContainer').load('{{ route('user.jobseekerprofile.myjobs.myapplication') }}');
                window.scrollTo(0, 0);
            });

            // jo alerts

            $('#jobalerts').on('click', function() {
                $('#componentContainer').load('{{ route('user.jobseekerprofile.jobalerts.jobalerts') }}');
                window.scrollTo(0, 0);
            });

        });
    </script>

    <br />

</body>

</html>
