<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback</title>
    <link rel="stylesheet" href="feedback.css">
    @vite(['resources/css/home.css', 'resources/js/app.js', 'resources/css/footer.css','resources/css/header.css','resources/css/reviews.css'])

</head>
<body>
@include('home.header')
    <div class="feedback-container">
        <div class="feedback-card">
            <div class="quote-date">
                <span class="quote-icon">❝</span>
                <p>2024-10-31</p>
            </div>
            <p class="feedback-message">Dear topjobs Team, This is a small note of appreciation for the topjobs team for their outstanding support, which extended to solving the issues over time...</p>
            <div class="profile">
                <img src="#" alt="User Avatar">
                <p class="user-info">
                    <span class="name">Pabasara Weerasinghe</span><br>
                    <span class="position">Manager - Human Resources</span><br>
                    <span class="company">AIA Sri Lanka, Colombo 07</span>
                </p>
            </div>
        </div>

        <div class="feedback-card">
            <div class="quote-date">
                <span class="quote-icon">❝</span>
                <p>2024-11-01</p>
            </div>
            <p class="feedback-message">Dear topjobs Team, Would like to rate our feedback on the service you provide as very satisfactory...</p>
            <div class="profile">
                <img src="#" alt="User Avatar">
                <p class="user-info">
                    <span class="name">Udarie Wickramaratne</span><br>
                    <span class="position">Executive - Human Resources</span><br>
                    <span class="company">David Pieris Group of Companies, Piliyandala</span>
                </p>
            </div>
        </div>

        <div class="feedback-container">
        <div class="feedback-card">
            <div class="quote-date">
                <span class="quote-icon">❝</span>
                <p>2024-10-31</p>
            </div>
            <p class="feedback-message">Dear topjobs Team, This is a small note of appreciation for the topjobs team for their outstanding support, which extended to solving the issues over time...</p>
            <div class="profile">
                <img src="#" alt="User Avatar">
                <p class="user-info">
                    <span class="name">Pabasara Weerasinghe</span><br>
                    <span class="position">Manager - Human Resources</span><br>
                    <span class="company">AIA Sri Lanka, Colombo 07</span>
                </p>
            </div>
        </div>

        <div class="feedback-card">
            <div class="quote-date">
                <span class="quote-icon">❝</span>
                <p>2024-11-01</p>
            </div>
            <p class="feedback-message">Dear topjobs Team, Would like to rate our feedback on the service you provide as very satisfactory...</p>
            <div class="profile">
                <img src="#" alt="User Avatar">
                <p class="user-info">
                    <span class="name">Udarie Wickramaratne</span><br>
                    <span class="position">Executive - Human Resources</span><br>
                    <span class="company">David Pieris Group of Companies, Piliyandala</span>
                </p>
            </div>
        </div>


       
        <!-- Repeat similar cards for each feedback -->
    </div>
   
</body>
</html>
