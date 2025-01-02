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
    <h1 class="maintopic"></h1><br/>
    <div class=profileview-container>
        <div class ="profileview-header">
            Profile View
        </div>
        <br />
        <p>Manage your CV, photograph, certificates, online profile. featured employers, View/Edit your login details.
        </p>,<br />
        <div class="btn-group mb-4">
    <a href="/mainprofileview/common" class="btn btn-common" id="commonprofile">Common Profile</a>
<<<<<<< Updated upstream
    <a href="/mainprofileview/personal" class="btn btn-common" id="personalprofile">Personal Profile</a>
    <a href="/mainprofileview/education" class="btn btn-common" id="education">Education</a>
    <a href="/mainprofileview/expirience" class="btn btn-common" id="expirience">Experience</a>
=======
    <a href="/mainprofileview/personal" class="btn btn-personal" id="personalprofile">Personal Profile</a>
    <a href="/mainprofileview/education" class="btn btn-education" id="education">Education</a>
    <a href="/mainprofileview/expirience" class="btn btn-expirience" id="expirience">Experience</a>
>>>>>>> Stashed changes
</div>

    </div>
    <br />

<div class = profileview-container>
<div class ="profileview-header">
   My Jobs
</div>
<br/>
<p>Manage your CV, photograph, certificates, online profile. featured employers, View/Edit your login details.</p>,<br/>
<div class="btn-group mb-4">
        <a href="/mainprofileview/application" class="btn btn-common" id="myapplication">My Applications</a>
<<<<<<< Updated upstream
        <a href="/mainprofileview/flaggedjob" class="btn btn-common" id="flagged">Flagged Jobs</a>
        <a href="/mainprofileview/preferredcompany" class="btn btn-common" id="preferred">Preferred Companies</a>
        <a href="/mainprofileview/recentjob" class="btn btn-common" id="recent">Recent Jobs</a>
=======
        <a href="/mainprofileview/flaggedjob" class="btn btn-personal" id="flagged">Flagged Jobs</a>
        <a href="/mainprofileview/preferredcompany" class="btn btn-education" id="preferred">Preferred Companies</a>
        <a href="/mainprofileview/recentjob" class="btn btn-expirience" id="recent">Recent Jobs</a>
>>>>>>> Stashed changes
</div>
</div>

<div class = profileview-container>
<div class ="profileview-header">
    My Preferences
</div>
<br/>
<p>Choose how job information is delivered; configure your account</p>,<br/>
<div class="btn-group mb-4">
        <a href="/mainprofileview/alerts" class="btn btn-common" id="jobalerts">Job Alerts</a>
        
</div>
</div>


    
</body>

</html>
