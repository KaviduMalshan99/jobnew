<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback</title>
    @vite(['resources/css/home.css', 'resources/js/app.js', 'resources/css/header.css'])
    <style>
        .feedback-container {
            max-width: 600px;
            margin: 50px auto;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .feedback-container h2 {
            text-align: center;
            color: #333;
        }
        .feedback-container form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }
        .feedback-container label {
            font-weight: bold;
        }
        .feedback-container input, 
        .feedback-container textarea, 
        .feedback-container button {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .feedback-container button {
            background-color: #4caf50;
            color: white;
            font-weight: bold;
            cursor: pointer;
            border: none;
        }
        .feedback-container button:hover {
            background-color: #45a049;
        }
        .feedback-container .message {
            text-align: center;
            margin: 10px 0;
            color: green;
        }
    </style>
</head>
<body>
    @include('home.header')
    <div class="feedback-container">
        <h2>Feedback Form</h2>
        @if(session('success'))
            <div class="message">{{ session('success') }}</div>
        @endif
        <form method="POST" action="">
            @csrf
            <div>
                <label for="feedback-name">Name:</label>
                <input type="text" id="feedback-name" name="name" required>
            </div>
            <div>
                <label for="feedback-email">Email:</label>
                <input type="email" id="feedback-email" name="email" required>
            </div>
            <div>
                <label for="feedback-message">Describe Your Feedback:</label>
                <textarea id="feedback-message" name="message" rows="4" required></textarea>
            </div>
            <button type="submit">Submit Feedback</button>
        </form>
    </div>
</body>
</html>
