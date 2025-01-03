<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback</title>
    <link rel="stylesheet" href="feedback.css">
    @vite(['resources/css/home.css', 'resources/js/app.js', 'resources/css/footer.css', 'resources/css/header.css', 'resources/css/reviews.css'])
    <style>
        .star-rating {
            font-size: 24px;
            /* Adjust the size of the stars */
            color: #d3d3d3;
            /* Default color for empty stars (grey) */
        }

        .star-rating .filled {
            color: #ffcc00;
            /* Yellow color for filled stars */
        }
    </style>

</head>

<body>
    @include('home.header')

    <div class="feedback-container">
        @foreach ($feedback as $feedbackItem)
            <!-- Loop through each feedback -->
            <div class="feedback-card">
                <div class="quote-date">
                    <span class="quote-icon">❝</span>
                    <p>{{ $feedbackItem->created_at->format('Y-m-d') }}</p> <!-- Display the date -->
                </div>
                <p class="feedback-message">{{ $feedbackItem->message }}</p> <!-- Display feedback message -->

                <div class="star-rating">
                    @for ($i = 1; $i <= 5; $i++)
                        @if ($i <= $feedbackItem->rating)
                            <span class="filled">★</span> <!-- Filled star -->
                        @else
                            <span>☆</span> <!-- Empty star -->
                        @endif
                    @endfor
                </div>

                <div class="profile">
                    <img src="{{ asset('assets/images/dashboard/profile.jpg') }}" alt="User Avatar">
                    <!-- Display user avatar (if available) -->
                    <p class="user-info">
                        <span class="name">{{ $feedbackItem->user->name }}</span><br> <!-- Display user name -->
                        <span class="position">{{ $feedbackItem->user->position }}</span><br>
                        <!-- Display user position -->
                        <span class="company">{{ $feedbackItem->user->company }}</span> <!-- Display user company -->
                    </p>
                </div>
            </div>
        @endforeach
    </div>

</body>

</html>
