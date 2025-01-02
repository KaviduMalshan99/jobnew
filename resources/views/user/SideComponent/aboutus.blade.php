<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>
    <link rel="stylesheet" href="{{ asset('css/about.css') }}">
    @vite(['resources/css/header.css' , 'resources/js/app.js','resources/css/home.css','resources/css/aboutus.css','resources/css/footer.css'])

</head>
<body>
    @include('home.header')
    <div class="container">
     <div class="about-section">
            <div class="content">
                <h1>About Us</h1>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In sed mauris commodo est rutrum tincidunt. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                <a href="#" class="learn-more">Learn More</a>
            </div>
            <div class="illustration">
                <img src="{{ asset('images/aboutus.png') }}" alt="Illustration">
            </div>
        </div>
    </div>
    @include('home.footer')
</body>
</html>
