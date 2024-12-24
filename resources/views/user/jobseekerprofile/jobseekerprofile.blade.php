<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Profile</title>
    @vite(['resources/css/home.css', 'resources/js/app.js', 'resources/css/footer.css', 'resources/css/employeeprofile.css'])

</head>

<body>

    <!--update profile-->
    <div class = "profile-body">
        <div class="profile-container">
            @include('user.jobseekerprofile.updateprofile')

        </div>

    </div>
    <!--update password-->
    @include('user.jobseekerprofile.updatepassword')
    <!--delete account-->
    @include('user.jobseekerprofile.deleteaccount')
</body>

</html>
