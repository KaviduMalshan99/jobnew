<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Preferred Companies</title>
    @vite(['resources/css/header.css', 'resources/js/app.js', 'resources/css/profileview.css', 'resources/css/home.css', 'resources/css/myapplication.css'])
</head>
<body>
@include('user.jobseekerprofile.mainview.profilelayout')
<div class="jobcontainer">
<div class="jobsection">
            <h2>Preferred Companies</h2>
            <p><a href="#">Add companies to my list...</a></p>
            <p>You do not have any preferred companies.</p>
        </div>
        </div>
</body>
</html>