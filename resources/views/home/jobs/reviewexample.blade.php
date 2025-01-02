<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback</title>
    <link rel="stylesheet" href="feedback.css">
    <style>
body {
    font-family: Arial, sans-serif;
    background-color: #f9f9f9;
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
}

.feedback-container {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 20px;
    max-width: 1200px;
    margin: 20px auto;
}

.feedback-card {
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    width: 300px; /* Adjust card width */
    overflow: hidden;
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
    position: relative;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

/* Hover effect for interaction */
.feedback-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 15px rgba(0, 0, 0, 0.2);
}

.quote-date {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    margin: 15px 0;
}

.quote-icon {
    font-size: 20px;
    color: #888;
}

.feedback-message {
    font-size: 14px;
    color: #333;
    margin: 0 15px 20px;
    line-height: 1.5;
    height: 90px; /* Adjust height for text */
    overflow: hidden;
    text-overflow: ellipsis;
}

.profile {
    width: 100%;
    background-color: #007bff; /* Blue background */
    color: #fff;
    padding: 20px 10px;
    display: flex;
    flex-direction: column;
    align-items: center;
    margin-top: auto; /* Push this section to the bottom */
}

.profile img {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    border: 3px solid #fff;
    margin-top: -30px; /* Position the image overlapping the white section */
    background-color: #eaeaea;
}

.user-info {
    font-size: 12px;
    color: #fff;
    line-height: 1.4;
    margin-top: 10px;
}

.name {
    font-weight: bold;
    font-size: 14px;
}

.position {
    color: #d6e4ff; /* Lighter text for the position */
}

.company {
    color: #bbd2ff; /* Even lighter text for the company */
    font-style: italic;
}

    </style>
</head>
<body>
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
