<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Package</title>
</head>

<body>
    <h1>Create a New Package</h1>
    <form action="{{ route('admin.packages.store') }}" method="POST">
        @csrf
        <label for="package_size">Package Size (Number of Posts):</label>
        <input type="number" name="package_size" id="package_size" required><br><br>

        <label for="duration_days">Duration (Days):</label>
        <input type="number" name="duration_days" id="duration_days" required><br><br>

        <label for="lkr_price">LKR Price (VAT Inclusive):</label>
        <input type="text" name="lkr_price" id="lkr_price" required><br><br>

        <label for="usd_price">USD Price:</label>
        <input type="text" name="usd_price" id="usd_price" required><br><br>

        <button type="submit">Create Package</button>
    </form>
</body>

</html>
