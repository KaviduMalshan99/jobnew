<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAQ - Jobads</title>
    <style>
        /* General Styles */
        body {
            font-family: Bahnschrift;
            background-color: #f7f7f7;
            color: #333;
            line-height: 1.8;
            margin: 0;
            padding: 0;

        }

        /* Page Header */
        h1 {
            background: #2f64eb;
            color: white;
            padding: 10px 20px;
            text-align: center;

        }

        /* Table of Contents */
        h2 {
            color: #4CAF50;
        }

        ul {
            list-style-type: disc;
            padding-left: 40px;
        }

        a {
            text-decoration: none;
            color: #007BFF;
            font-weight: bold;
        }

        a:hover {
            text-decoration: underline;
            color: #0056b3;
        }

        /* FAQ Sections */
        .faq-section {
            background-color: #fff;
            padding: 20px;
            margin: 20px auto;
            max-width: 800px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            border-left: 5px solid #4CAF50;
        }

        .faq-section h2 {
            margin-top: 0;
            margin-bottom: 10px;
        }

        .faq-section p {
            margin-bottom: 15px;
            color: #555;
        }

        /* Back to Top Link */
        .top-link {
            display: inline-block;
            margin-top: 15px;
            color: #4CAF50;
            font-size: 0.9em;
        }

        .top-link:hover {
            text-decoration: underline;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            body {
                padding: 10px;
            }

            .faq-section {
                margin: 10px auto;
                padding: 15px;
            }
        }
    </style>
</head>

<body>

    <h1>FAQ - Jobads</h1>

    <h2>Table of Contents</h2>
    <ul>
        @foreach ($faqs as $faq)
            <li><a href="#faq-{{ $faq->id }}">{{ $faq->question }}</a></li>
        @endforeach
    </ul>

    @foreach ($faqs as $faq)
        <div class="faq-section" id="faq-{{ $faq->id }}">
            <h2>{{ $faq->question }}</h2>
            <p>{{ $faq->answer }}</p>
            <a href="#top" class="top-link">Back to Top</a>
        </div>
    @endforeach

</body>

</html>
