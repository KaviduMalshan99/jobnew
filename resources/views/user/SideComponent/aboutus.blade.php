<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>
    @vite(['resources/css/header.css', 'resources/js/app.js', 'resources/css/home.css', 'resources/css/aboutus.css', 'resources/css/footer.css'])
    <style>
        .more-content {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease;
        }

        .more-content.expanded {
            max-height: 300px;
            /* Adjust this value according to your content */
        }

        .learn-more {
            cursor: pointer;
            display: inline-block;
            padding: 10px 20px;
            background-color: #5a67d8;
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
            font-size: 14px;
        }

        .learn-more:hover {
            background-color: #4c51bf;
        }
    </style>
</head>

<body>
    @include('home.header')
    <div class="container">
        <div class="about-section">
            <div class="content">
                <h1>{{ $aboutUs->title }}</h1> <!-- Dynamically display the title -->

                <!-- Show part of the description initially -->
                <p id="description" class="description">{{ Str::limit($aboutUs->description, 150) }}</p>

                <!-- Full description hidden initially -->
                <div id="more-content" class="more-content">
                    <p>{{ $aboutUs->description }}</p> <!-- Full description -->
                </div>

                <!-- Toggle button for showing/hiding full content -->
                <a href="#" id="learn-more-btn" class="learn-more">Learn More</a>
            </div>
            <div class="illustration">
                <img src="{{ asset('images/aboutus.png') }}" alt="Illustration">
            </div>
        </div>
    </div>
    @include('home.footer')

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const learnMoreBtn = document.getElementById('learn-more-btn');
            const moreContent = document.getElementById('more-content');
            const description = document.getElementById('description');

            // Event listener for the Learn More button
            learnMoreBtn.addEventListener('click', function(e) {
                e.preventDefault();
                if (moreContent.classList.contains('expanded')) {
                    moreContent.classList.remove('expanded');
                    learnMoreBtn.textContent = 'Learn More';
                    description.style.display = 'block'; // Show part of the description
                } else {
                    moreContent.classList.add('expanded');
                    learnMoreBtn.textContent = 'Show Less';
                    description.style.display = 'none'; // Hide part of the description when expanded
                }
            });
        });
    </script>
</body>

</html>
