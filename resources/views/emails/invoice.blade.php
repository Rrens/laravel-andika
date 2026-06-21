<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice Pembelian</title>
    <style>
        body { font-family: Arial, sans-serif; color: #333333; line-height: 1.6; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #dddddd; border-radius: 8px; }
        .header { text-align: center; border-bottom: 2px solid #efefef; padding-bottom: 20px; }
        .header h2 { color: #0d6efd; margin: 0; }
        .details { margin: 20px 0; }
        .table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        .table th, .table td { padding: 10px; border-bottom: 1px solid #eeeeee; text-align: left; }
        .table th { background-color: #f8f9fa; }
        .total { font-weight: bold; text-align: right; font-size: 1.1em; color: #e09d00; margin-top: 20px; }
        .footer { text-align: center; font-size: 0.8em; color: #777777; margin-top: 30px; border-top: 1px solid #efefef; padding-top: 20px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>MarketHub</h2>
            <p>Terima kasih atas pembelian Anda!</p>
        </div>
        
        <div class="details">
            <p><strong>Nama Pelanggan:</strong> {{ $user->name }}</p>
            <p><strong>Email:</strong> {{ $user->email }}</p>
            <p><strong>Tanggal Transaksi:</strong> {{ date('d-m-Y H:i') }}</p>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th>Produk</th>
                    <th>Harga Unit</th>
                    <th>Qty</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($carts as $cart)
                    @if($cart->product)
                        @php
                            $itemPrice = $cart->product->price;
                            if ($cart->product->discount) {
                                $itemPrice = $cart->product->price * (1 - $cart->product->discount / 100);
                            }
                            $subtotal = $itemPrice * $cart->quantity;
                        @endphp
                        <tr>
                            <td>{{ $cart->product->name }}</td>
                            <td>Rp {{ number_format($itemPrice, 0, ',', '.') }}</td>
                            <td>{{ $cart->quantity }}</td>
                            <td>Rp {{ number_format($subtotal, 0, ',', '.') }}</td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>

        <div class="total">
            Total Pembayaran: Rp {{ number_format($total, 0, ',', '.') }}
        </div>

        <div class="footer">
            <p>&copy; 2026 MarketHub. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
