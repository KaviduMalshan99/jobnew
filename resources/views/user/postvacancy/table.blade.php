<!---table---->
<div class="table-container">
    <table>
        <thead>
            <tr>
                <th>Package Size (Nos Vacancy Posts)</th>
                <th>Duration</th>
                <th>LKR Price (VAT Inclusive)</th>
                <th>USD Price</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($packages as $package)
                <tr>
                    <td>{{ $package->package_size }}</td>
                    <td>{{ $package->duration_days }}</td>
                    <td>{{ number_format($package->lkr_price, 2) }}</td>
                    <td>{{ number_format($package->usd_price, 2) }}</td>
                </tr>
            @endforeach

        </tbody>
    </table>
</div>
