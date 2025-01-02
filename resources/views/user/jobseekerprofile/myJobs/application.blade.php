<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>myApplication</title>
    @vite(['resources/css/header.css', 'resources/js/app.js', 'resources/css/profileview.css', 'resources/css/home.css', 'resources/css/myapplication.css'])
</head>
<body>

@include('user.jobseekerprofile.mainview.profilelayout')
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
            
        </div>

</body>
</html>