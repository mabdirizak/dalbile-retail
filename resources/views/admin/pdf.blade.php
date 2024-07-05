<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Details</title>
    <base href="/public">
</head>
<body>
    <style>
        @page {
            size: A4; /* Set page size */
            margin: 1cm; /* Adjust page margins */
        }
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 5px 0;
            font-size: 12px; /* Smaller font size for print */
            text-align: left;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 4px; /* Adjusted padding for smaller screens */
            text-align: left;
            white-space: nowrap; /* Prevent text wrapping */
        }
        th {
            background-color: #f2f2f2;
            color: black;
            font-weight: normal; /* Reduce font weight for headers */
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        .text-white {
            color: #000;
        }

        /* Hide non-essential columns for printing */
        @media print {
            .no-print {
                display: none;
            }
        }
    </style>
    

    <table class="table small-table m-auto pb-3">
        <thead>
            <tr class="text-info m-auto">
                <th>Client Name</th>
                <th>Client Email</th>
                <th>Client Phone</th>
                <th>Client Address</th>
                <th>Product</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Payment Status</th>
                <th>Delivery Status</th>
            </tr>
        </thead>
        <tbody>
                <tr class="text-white">
                    <td>{{ $order->name }}</td>
                    <td>{{ $order->email }}</td>
                    <td>{{ $order->phone }}</td>
                    <td>{{ $order->address }}</td>
                    <td>{{ $order->product_title }}</td>
                    <td>{{ $order->quantity }}</td>
                    <td>{{ $order->price }}</td>
                    <td>{{ $order->payment_status }}</td>
                    <td>{{ $order->delivery_status }}</td>
                </tr>
           
        </tbody>
    </table>
    

</body>
</html>