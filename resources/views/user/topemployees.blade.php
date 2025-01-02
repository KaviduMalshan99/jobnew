<!-- resources/views/top-employers.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
<<<<<<< Updated upstream
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Top Employers</title>
    @vite(['resources/css/topemployees.css'])
=======
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Top Employers</title>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  @vite(['resources/css/topemployees.css','resources/css/home.css','resources/css/header.css'])
  <style>

    /* Container for the buttons */
.topemployers {
    text-align: center;
    margin: 20px 0;
}

/* Button group layout */
.btn-group {
    display: inline-flex;
    gap: 10px;
}

/* All button */
#all {
    background-color: #007bff; /* Blue color */
    color: #ffffff;
    padding: 12px 24px;
    border-radius: 5px;
    border: none;
    font-size: 16px;
    font-weight: bold;
    cursor: pointer;
    transition: all 0.3s ease;
}

#all:hover {
    background-color: #0056b3; /* Darker blue */
    transform: scale(1.05);
}

/* With Open Jobs button */
#withopenjobs {
    background-color: #28a745; /* Green color */
    color: #ffffff;
    padding: 12px 24px;
    border-radius: 5px;
    border: none;
    font-size: 16px;
    font-weight: bold;
    cursor: pointer;
    transition: all 0.3s ease;
}

#withopenjobs:hover {
    background-color: #1e7e34; /* Darker green */
    transform: scale(1.05);
}

/* By Industry button */
#byindustry {
    background-color: #ffc107; /* Yellow color */
    color: #000000;
    padding: 12px 24px;
    border-radius: 5px;
    border: none;
    font-size: 16px;
    font-weight: bold;
    cursor: pointer;
    transition: all 0.3s ease;
}

#byindustry:hover {
    background-color: #e0a800; /* Darker yellow */
    transform: scale(1.05);
}

/* Alphabetical button */
#Alphabetical {
    background-color: #dc3545; /* Red color */
    color: #ffffff;
    padding: 12px 24px;
    border-radius: 5px;
    border: none;
    font-size: 16px;
    font-weight: bold;
    cursor: pointer;
    transition: all 0.3s ease;
}

#Alphabetical:hover {
    background-color: #b21f2d; /* Darker red */
    transform: scale(1.05);
}

  </style>
>>>>>>> Stashed changes
</head>

<body>
<<<<<<< Updated upstream
    <div class="container">
        <h1 class="title">Top Employers</h1>
        <div class="filter-options">
            <label><input type="radio" name="filter" checked> All</label>
            <label><input type="radio" name="filter"> With Open Jobs</label>
            <label><input type="radio" name="filter"> By Industry</label>
            <label><input type="radio" name="filter"> Alphabetical</label>
        </div>
        <div class="employers-grid">

            @foreach ($topEmployers as $employer)
                <div class="employer-card">

                    <img src="{{ asset('storage/' . $employer->logo) }}" alt="{{ $employer['alt'] }}">


                </div>
            @endforeach
        </div>
    </div>
=======
  @include('home.header')
  <div class="container">
    <h1 class="title">Top Employers</h1>

    <div class="topemployers"> 
        <div class="btn-group mb-4">
            <button class="btn btn-ipg" id="all">All</button>
            <button class="btn btn-onlinefund" id="withopenjobs">With Open Jobs</button>
            <button class="btn btn-overthecounter" id="byindustry">By Industry</button>
            <button class="btn btn-QRCodeforjobads" id="Alphabetical">Alphabetical</button>
        </div>
    </div>
    <div id="componentContainer-topemployers">
        @include('user.all')
  </div>
  </div>
  <script>
        $(document).ready(function () {
            
            $('#all').on('click', function () {
                $('#componentContainer-topemployers').load('{{ route('user.all') }}');
                location.reload();
            });

            
            $('#withopenjobs').on('click', function () {
                $('#componentContainer-topemployers').load('{{ route('user.withopen') }}');
                
            });

           
            $('#byindustry').on('click', function () {
                $('#componentContainer-topemployers').load('{{ route('user.byindustry') }}');
            });

            $('#Alphabetical').on('click', function () {
                $('#componentContainer-topemployers').load('{{ route('user.alphabetical') }}');
            });

          
        });
    </script>

>>>>>>> Stashed changes
</body>

</html>
