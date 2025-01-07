<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Packages</title>
</head>

<body>
    <h1>All Packages</h1>
    <a href="{{ route('packages.create') }}">Create New Package</a>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Package Size</th>
                <th>Duration (Days)</th>
                <th>LKR Price</th>
                <th>USD Price</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($packages as $package)
                <tr>
                    <td>{{ $package->id }}</td>
                    <td>{{ $package->package_size }}</td>
                    <td>{{ $package->duration_days }}</td>
                    <td>{{ $package->lkr_price }}</td>
                    <td>{{ $package->usd_price }}</td>
                    <td>
                        <a href="{{ route('packages.show', $package->id) }}">View</a>
                        <a href="{{ route('packages.edit', $package->id) }}">Edit</a>
                        <form action="{{ route('packages.destroy', $package->id) }}" method="POST"
                            style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
