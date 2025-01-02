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
            max-height: 300px; /* Adjust based on the height of your expanded content */
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
                <h1>About Us</h1>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In sed mauris commodo est rutrum tincidunt. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                <div id="more-content" class="more-content">
                    <p>Here is additional content that gets revealed when you click the "Learn More" button. This could include more detailed information about your company, mission, or services.</p>
                </div>
                <a href="#" id="learn-more-btn" class="learn-more">Learn More</a>
            </div>
            <div class="illustration">
                <img src="{{ asset('images/aboutus.png') }}" alt="Illustration">
            </div>
        </div>
    </div>
    @include('home.footer')

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const learnMoreBtn = document.getElementById('learn-more-btn');
            const moreContent = document.getElementById('more-content');

            learnMoreBtn.addEventListener('click', function (e) {
                e.preventDefault();
                if (moreContent.classList.contains('expanded')) {
                    moreContent.classList.remove('expanded');
                    learnMoreBtn.textContent = 'Learn More';
                } else {
                    moreContent.classList.add('expanded');
                    learnMoreBtn.textContent = 'Show Less';
                }
            });
        });
    </script>
</body>
</html>
