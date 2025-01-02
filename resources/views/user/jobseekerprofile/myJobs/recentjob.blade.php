<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RecentJobs</title>
    @vite(['resources/css/header.css', 'resources/js/app.js', 'resources/css/profileview.css', 'resources/css/home.css', 'resources/css/myapplication.css'])
</head>
<body>
@include('user.jobseekerprofile.mainview.profilelayout')
<div class="jobcontainer">
<div class="jobsection">
            <h2>Recent Vacancies</h2>
            <div class="jobfilter">
                <label for="jobvacancy-filter">Recent Vacancies for:</label>
                <select id="jobvacancy-filter">
                    <option>All</option>
                    <!-- Add other options if needed -->
                </select>
                <p>Showing only recent 10 vacancies... <a href="#">View All</a></p>
            </div>

            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Job Ref No.</th>
                        <th>Position and Employer</th>
                        <th>Opening Date</th>
                        <th>Closing Date</th>
                        <th>Details</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="background-color: blue;">1</td>
                        <td>0001303770</td>
                        <td>Senior Mechatronics Engineers <br> Data Management Systems (Pvt) Ltd</td>
                        <td>Mon Dec 23 2024</td>
                        <td>Thu Jan 23 2025</td>
                        <td><a href="#">Full View</a></td>
                    </tr>
                    <tr>
                        <td style="background-color: blue;">1</td>
                        <td>0001303770</td>
                        <td>Senior Mechatronics Engineers <br> Data Management Systems (Pvt) Ltd</td>
                        <td>Mon Dec 23 2024</td>
                        <td>Thu Jan 23 2025</td>
                        <td><a href="#">Full View</a></td>
                    </tr>
                    <tr>
                        <td style="background-color: blue;">1</td>
                        <td>0001303770</td>
                        <td>Senior Mechatronics Engineers <br> Data Management Systems (Pvt) Ltd</td>
                        <td>Mon Dec 23 2024</td>
                        <td>Thu Jan 23 2025</td>
                        <td><a href="#">Full View</a></td>
                    </tr> <tr>
                        <td style="background-color: blue;">1</td>
                        <td>0001303770</td>
                        <td>Senior Mechatronics Engineers <br> Data Management Systems (Pvt) Ltd</td>
                        <td>Mon Dec 23 2024</td>
                        <td>Thu Jan 23 2025</td>
                        <td><a href="#">Full View</a></td>
                    </tr> <tr>
                        <td style="background-color: blue;">1</td>
                        <td>0001303770</td>
                        <td>Senior Mechatronics Engineers <br> Data Management Systems (Pvt) Ltd</td>
                        <td>Mon Dec 23 2024</td>
                        <td>Thu Jan 23 2025</td>
                        <td><a href="#">Full View</a></td>
                    </tr> <tr>
                        <td style="background-color: blue;">1</td>
                        <td>0001303770</td>
                        <td>Senior Mechatronics Engineers <br> Data Management Systems (Pvt) Ltd</td>
                        <td>Mon Dec 23 2024</td>
                        <td>Thu Jan 23 2025</td>
                        <td><a href="#">Full View</a></td>
                    </tr> <tr>
                        <td style="background-color: blue;">1</td>
                        <td>0001303770</td>
                        <td>Senior Mechatronics Engineers <br> Data Management Systems (Pvt) Ltd</td>
                        <td>Mon Dec 23 2024</td>
                        <td>Thu Jan 23 2025</td>
                        <td><a href="#">Full View</a></td>
                    </tr>
                    <!-- Repeat similar rows for more entries -->
                </tbody>
            </table>
        </div>
    </div>
    </div>
</body>
</html>