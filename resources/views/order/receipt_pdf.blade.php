<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk Pembayaran</title>
    <style>
        body { 
            font-family: 'Arial', sans-serif; 
            background-color: #f8f9fa; 
            display: flex; 
            justify-content: center; 
            align-items: center; 
            height: 100vh; 
            margin: 0;
        }
        .container { 
            width: 100%; 
            max-width: 400px; 
            background: white; 
            padding: 20px; 
            border-radius: 10px; 
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1); 
            text-align: center;
        }
        h2 { 
            color: #343a40; 
            border-bottom: 2px solid #007bff; 
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        p { 
            font-size: 16px; 
            color: #555; 
            margin: 5px 0; 
        }
        .highlight { 
            font-weight: bold; 
            color: #007bff; 
        }
        .status { 
            font-weight: bold; 
            padding: 5px 10px; 
            border-radius: 5px; 
            display: inline-block;
            margin-top: 10px;
        }
        .status-pending { background: #ffc107; color: #212529; }
        .status-success { background: #28a745; color: white; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Struk Pembayaran</h2>
        <p><strong>Order ID:</strong> <span class="highlight">{{ $order->order_id }}</span></p>
        <p><strong>Nama:</strong> {{ $order->customer_name }}</p>
        <p><strong>No. Telepon:</strong> {{ $order->customer_phone }}</p>
        <p><strong>Catatan:</strong> {{ $order->notes ?? '-' }}</p>
        <p><strong>Total Bayar:</strong> <span class="highlight">Rp {{ number_format($order->total_price, 2, ',', '.') }}</span></p>
        <p class="status 
            {{ $order->payment_status == 'pending' ? 'status-pending' : 'status-success' }}">
            {{ ucfirst($order->payment_status) }}
        </p>
    </div>
</body>
</html>
