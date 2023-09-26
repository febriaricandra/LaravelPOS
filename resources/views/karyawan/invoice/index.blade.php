<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receipt</title>
    <style>
        /* Style for the receipt */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .receipt {
            max-width: 300px;
            margin: 0 auto;
            padding: 10px;
            border: 1px solid #ccc;
        }

        .receipt-header {
            text-align: center;
        }

        .receipt-title {
            font-size: 20px;
            margin-bottom: 10px;
        }

        .receipt-details {
            margin-top: 10px;
        }

        .receipt-details p {
            margin: 0;
            font-size: 14px;
        }

        .receipt-table {
            width: 100%;
            margin-top: 20px;
        }

        .receipt-table th,
        .receipt-table td {
            padding: 5px 0;
        }

        .receipt-total {
            margin-top: 10px;
            text-align: right;
        }
    </style>
</head>
<body>
    <div class="receipt">
        <div class="receipt-header">
            <h2 class="receipt-title">Receipt</h2>
        </div>
        <div class="receipt-details">
            <p><strong>Receipt Number:</strong> RCT-2023-001</p>
            <p><strong>Receipt Date:</strong> September 26, 2023</p>
            <p><strong>Customer Name:</strong> John Doe</p>
            <!-- Add more details as needed -->
        </div>
        <table class="receipt-table">
            <thead>
                <tr>
                    <th>Item</th>
                    <th>Qty</th>
                    <th>Unit Price</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Product 1</td>
                    <td>2</td>
                    <td>$50.00</td>
                    <td>$100.00</td>
                </tr>
                <!-- Add more rows for other items -->
            </tbody>
        </table>
        <div class="receipt-total">
            <p><strong>Total:</strong> $200.00</p>
        </div>
    </div>
</body>
</html>
