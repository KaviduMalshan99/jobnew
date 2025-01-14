<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Posting Platform</title>
    @vite(['resources/css/postjob.css', 'resources/css/header.css', 'resources/css/bannerposting.css', 'resources/css/topads.css', 'resources/js/app.js', 'resources/css/home.css'])
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    @include('home.header')
    <div class="postcontainer">
        <div class="postheader">
            jobads is the best way to post jobs and recruit talent from Sri Lanka. Choose from any of the following
            options.
        </div>
        @foreach ($posts as $post)
            <div class="postcontent">
                <ul>

                    {!! $post->description_one !!}

                </ul>
            </div>
        @endforeach
    </div><br />

    <!-- Buttons to Load Components -->
    <div class="btn-group mb-4">
        <button class="btn btn-top-ads" id="topAdsButton">Top Ads</button>
        <button class="btn btn-banner-posting" id="bannerPostingButton">Banner Posting</button>
    </div>

    <!-- Component Content Section -->
    <div id="componentContainer" style="padding: 0px 0px 0px 20px">

        @include('user.postvacancy.topads')<br />

    </div>
    <br />

    <!-- Payment method buttons (ALWAYS VISIBLE) -->
    <div class="payment-methods">
        <div class="btn-group mb-4">
            <button class="btn btn-ipg" id="IPG">IPG</button>
            <button class="btn btn-onlinefund" id="onlinefundtransfer">Online Fund Transfer</button>
            <button class="btn btn-overthecounter" id="Overthecounter">Over-the-Counter</button>
            <button class="btn btn-QRCodeforjobads" id="QRCodeforjobads">QR Code for Job Ads</button>
        </div>
    </div>

    <br />
    <!-- Payment Options Content -->
    <div id="componentContainer-payment">
        @include('user.postvacancy.paymentmethod.ipg')
    </div>

    <!-- Script for Dynamic Component Loading -->
    <script>
        $(document).ready(function() {
            // Load Top Ads Component
            $('#topAdsButton').on('click', function() {
                $('#componentContainer').load('{{ route('user.postvacancy.topads') }}');
                location.reload();
            });

            // Load Banner Posting Component
            $('#bannerPostingButton').on('click', function() {
                $('#componentContainer').load('{{ route('user.postvacancy.bannerposting') }}');

            });

            // Payment Methods
            $('#IPG').on('click', function() {
                $('#componentContainer-payment').load('{{ route('user.postvacancy.paymentmethod.ipg') }}');
            });

            $('#onlinefundtransfer').on('click', function() {
                $('#componentContainer-payment').load(
                    '{{ route('user.postvacancy.paymentmethod.onlinefundtransfer') }}');
            });

            $('#Overthecounter').on('click', function() {
                $('#componentContainer-payment').load(
                    '{{ route('user.postvacancy.paymentmethod.overthecounter') }}');
            });

            $('#QRCodeforjobads').on('click', function() {
                $('#componentContainer-payment').load(
                    '{{ route('user.postvacancy.paymentmethod.qrcodeforjobads') }}');
            });
        });
    </script>


</body>

</html>
