<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    @vite(['resources/css/home.css', 'resources/js/app.js','resources/css/footer.css'])
</head>
<body>
@include('home.header')
@include('home.footer')
</body>
</html>