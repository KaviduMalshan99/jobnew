@extends('layouts.employer.master')

@section('title', 'Dashboard')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/animate.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/fontawesome.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/line-awesome.css') }}">
@endsection

@section('style')
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

        /* Rating Styles */
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

        /* History Table Styles */
        .history-container {
            max-width: 800px;
            margin: 30px auto;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .history-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .history-table th,
        .history-table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .history-table th {
            background-color: #f5f5f5;
            font-weight: bold;
        }

        .history-table tr:hover {
            background-color: #f9f9f9;
        }

        .star-rating {
            color: #ffd700;
        }

        .status-badge {
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 0.9em;
            font-weight: bold;
        }

        .status-pending {
            background-color: #ffd700;
            color: #000;
        }

        .status-approve {
            background-color: #4caf50;
            color: #fff;
        }

        .status-reject {
            background-color: #f44336;
            color: #fff;
        }
    </style>
@endsection

@section('breadcrumb-title')

@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Dashboard</li>
@endsection

@section('content')
    <div class="container-fluid p-4">
        <div class="feedback-container">
            <h2>Feedback Form</h2>
            @if (session('success'))
                <div class="message">{{ session('success') }}</div>
            @endif
            <form method="POST" action="{{ route('employer.feedback.store') }}">
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
                    @if (auth('employer')->check())
                        @foreach (auth('employer')->user()->feedback as $feedback)
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
                    @endif
                </tbody>
            </table>
        </div>



    </div>
@endsection

@section('script')
    <script src="{{ asset('assets/js/clock.js') }}"></script>
    <script src="{{ asset('assets/js/chart/apex-chart/moment.min.js') }}"></script>
    <script src="{{ asset('assets/js/notify/bootstrap-notify.min.js') }}"></script>
    <script src="{{ asset('assets/js/dashboard/default.js') }}"></script>
    <script src="{{ asset('assets/js/notify/index.js') }}"></script>
    <script src="{{ asset('assets/js/typeahead/handlebars.js') }}"></script>
    <script src="{{ asset('assets/js/typeahead/typeahead.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/height-equal.js') }}"></script>
    <script src="{{ asset('assets/js/animation/wow/wow.min.js') }}"></script>
@endsection
