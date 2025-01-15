<!-- resources/views/fund-transfer.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Fund Transfer</title>
    <style>
        .paymentmethod-header {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .fundtransfer-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            padding: 20px;
        }

        .bank-info {
            border: 1px solid #ddd;
            padding: 15px;
            border-radius: 5px;
            background-color: #fff;
        }

        .bank-info table {
            border-collapse: collapse;
            width: 100%;
        }

        .bank-info th,
        .bank-info td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .bank-info th {
            font-weight: bold;
            width: 150px;
        }
    </style>
</head>

<body>
    <!-- Bank Information Section -->
    <div class="paymentmethod-header">For Online Fund Transfers</div>
    <div class="fundtransfer-container">
        @foreach ($banks as $bank)
            <div class="bank-info">
                <table>
                    <tr>
                        <th>Bank Name</th>
                        <td>{{ $bank->bank_name }}</td>
                    </tr>

                    <tr>
                        <th>Account Name</th>
                        <td>{{ $bank->account_name }}</td>
                    </tr>
                    <tr>
                        <th>Account Number</th>
                        <td>{{ $bank->account_no }}</td>
                    </tr>
                    <tr>
                        <th>Bank Code</th>
                        <td>{{ $bank->bank_code }}</td>
                    </tr>
                    <tr>
                        <th>Branch</th>
                        <td>{{ $bank->branch_name }}</td>
                    </tr>
                    <tr>
                        <th>Branch Code</th>
                        <td>{{ $bank->branch_code }}</td>
                    </tr>
                    <tr>
                        <th> SWIFT Code</th>
                        <td>{{ $bank->swift_code }}</td>
                    </tr>
                    <tr>
                        <th>Currency</th>
                        <td>{{ $bank->currency }}</td>
                    </tr>
                </table>
            </div>
        @endforeach
    </div>
</body>

</html>
