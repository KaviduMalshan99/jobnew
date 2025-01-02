<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FlaggedJobs</title>
    @vite(['resources/css/header.css', 'resources/js/app.js', 'resources/css/profileview.css', 'resources/css/home.css', 'resources/css/myapplication.css'])
</head>
<body>
@include('user.jobseekerprofile.mainview.profilelayout')
<div class="jobcontainer">
<div class="jobsection">
            <h2>Flagged Vacancies</h2>
            <p>You have not flagged any vacancies</p>
            <table>
                <thead>
                    <tr>
                        <th></th>
                        <th>Vacancy</th>
                        <th>Company</th>
                        <th>Closing Date</th>
                        <th>Status</th>
                       
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td></td>
                        <td>0001304267 - Lowcode Minds</a></td>
                        <td>Data Management Systems (Pvt) Ltd</td>
                        <td>2024/12/27 10:34 AM</td>
                        <td><a href="#">View&Apply</td>
                       
                    </tr>
                  
                </tbody>
            </table>
        </div>
        </div>
</body>
</html>