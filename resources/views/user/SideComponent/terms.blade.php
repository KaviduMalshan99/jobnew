<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Terms & Conditions</title>
    @vite(['resources/css/terms.css', 'resources/css/header.css', 'resources/css/home.css'])
</head>

<body>
    @include('home.header')
    <div class="terms-and-conditions">
        <header class="terms-and-conditions-header">
            <h1>Terms & Conditions</h1>
        </header>
        <p><strong>Updated: 14th December 2024, Revision 5</strong></p>

        <!-- Dynamic Navigation Menu -->
        <nav>
            <ul>
                @foreach ($terms as $term)
                    <li><a href="#{{ strtolower(str_replace(' ', '-', $term->title)) }}">{{ $term->title }}</a></li>
                @endforeach
            </ul>
        </nav>

        <!-- Dynamic Content Sections -->
        @foreach ($terms as $term)
            <div id="{{ strtolower(str_replace(' ', '-', $term->title)) }}" class="section">
                <h2>{{ $term->title }}</h2>
                <p>{{ $term->content }}</p>
            </div>
        @endforeach

        <div id="contacts">
            <h2>Contact Us</h2>
            <ul>
                @foreach ($contacts as $contact)
                    <li>{{ $contact->email }}</li>
                    <li>{{ $contact->phone }}</li>
                @endforeach
            </ul>
        </div>

    </div>
</body>

</html>
