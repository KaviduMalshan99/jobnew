<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback</title>
    @vite(['resources/css/home.css', 'resources/js/app.js', 'resources/css/header.css'])
    <style>
     
    </style>
    @vite(['resources/css/home.css', 'resources/js/app.js', 'resources/css/header.css', 'resources/css/feedback.css'])
    
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
            <div>
                <label for="feedback-name">Name:</label>
                <input type="text" id="feedback-name" name="name" required>
            </div>
            <div>
                <label for="feedback-message">Describe Your Feedback:</label>
                <textarea id="feedback-message" name="message" rows="4" required></textarea>
            </div>
            <button type="submit">Submit Feedback</button>
        </form>
    </div>

    <div class="history-container">
        <h2>Your Feedback History</h2>
        <table class="history-table">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Rating</th>
                    <th>Message</th>

                </tr>
            </thead>
            <tbody>
                @foreach (auth()->user()->feedback as $feedback)
                    <tr>
                        <td>{{ $feedback->created_at->format('Y-m-d') }}</td>
                        <td>
                            <div class="star-rating">
                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($i <= $feedback->rating)
                                        ★
                                    @else
                                        ☆
                                    @endif
                                @endfor
                            </div>
                        </td>
                        <td>{{ $feedback->message }}</td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>
