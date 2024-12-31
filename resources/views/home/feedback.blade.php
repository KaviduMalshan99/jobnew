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

        /* New Rating Styles */
        .rating-container {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .rating-stars {
            display: flex;
            flex-direction: row-reverse;
            justify-content: flex-end;
        }

        .rating-stars input {
            display: none;
        }

        .rating-stars label {
            cursor: pointer;
            font-size: 25px;
            color: #ddd;
            padding: 0 2px;
        }

        .rating-stars label:before {
            content: '★';
        }

        .rating-stars input:checked~label {
            color: #ffd700;
        }

        .rating-stars label:hover,
        .rating-stars label:hover~label {
            color: #ffd700;
        }
    </style>
</head>

<body>
    @include('home.header')
    <div class="feedback-container">
        <h2>Feedback Form</h2>
        @if (session('success'))
            <div class="message">{{ session('success') }}</div>
        @endif
        <form method="POST" action="{{ route('feedback.store') }}">
            @csrf
            <div class="rating-container">
                <label>Rate your experience (1-5 stars):</label>
                <div class="rating-stars">
                    <input type="radio" id="star5" name="rating" value="5" required>
                    <label for="star5"></label>
                    <input type="radio" id="star4" name="rating" value="4">
                    <label for="star4"></label>
                    <input type="radio" id="star3" name="rating" value="3">
                    <label for="star3"></label>
                    <input type="radio" id="star2" name="rating" value="2">
                    <label for="star2"></label>
                    <input type="radio" id="star1" name="rating" value="1">
                    <label for="star1"></label>
                </div>
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
