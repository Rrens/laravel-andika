<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Invoice Summary - Review your order">
    <title>Invoice Pembelian | MarketHub</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body class="bg-light d-flex flex-column min-vh-100">
    @include('sweetalert::alert')

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg bg-white shadow-sm sticky-top border-bottom">
        <div class="container">
            <a class="navbar-brand fw-bold d-flex align-items-center gap-2" href="{{ route('product') }}">
                <span class="bg-primary text-white rounded-2 d-inline-flex align-items-center justify-content-center" style="width: 36px; height: 36px;">
                    <i class="bi bi-box-seam"></i>
                </span>
                MarketHub
            </a>
            <a href="{{ route('product') }}" class="btn btn-outline-secondary btn-sm">
                <i class="bi bi-arrow-left me-1"></i> Kembali ke Toko
            </a>
        </div>
    </nav>

    <!-- Invoice Content -->
    <main class="container py-5 flex-grow-1">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm rounded-3">
                    <div class="card-body p-4 p-md-5">
                        
                        <!-- Header -->
                        <div class="d-flex justify-content-between align-items-center border-bottom pb-4 mb-4">
                            <div>
                                <h3 class="fw-bold text-primary mb-1">INVOICE</h3>
                                <span class="text-muted">No: #INV-{{ time() }}</span>
                            </div>
                            <div class="text-end">
                                <h4 class="fw-bold mb-0">MarketHub</h4>
                                <span class="text-muted small">Transaksi Digital</span>
                            </div>
                        </div>

                        <!-- Customer & Date Info -->
                        <div class="row mb-4">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <span class="text-muted small d-block">DITAGIHKAN KEPADA:</span>
                                <strong class="fs-5 d-block">{{ auth()->user()->name }}</strong>
                                <span class="text-muted">{{ auth()->user()->email }}</span>
                            </div>
                            <div class="col-sm-6 text-sm-end">
                                <span class="text-muted small d-block">TANGGAL:</span>
                                <strong>{{ date('d F Y') }}</strong>
                            </div>
                        </div>

                        <!-- Item Table -->
                        <div class="table-responsive mb-4">
                            <table class="table align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>Produk</th>
                                        <th class="text-center" style="width: 80px;">Qty</th>
                                        <th class="text-end" style="width: 150px;">Harga Unit</th>
                                        <th class="text-end" style="width: 180px;">Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $total = 0; @endphp
                                    @foreach ($carts as $cart)
                                        @if($cart->product)
                                            @php
                                                $itemPrice = $cart->product->price;
                                                if ($cart->product->discount) {
                                                    $itemPrice = $cart->product->price * (1 - $cart->product->discount / 100);
                                                }
                                                $subtotal = $itemPrice * $cart->quantity;
                                                $total += $subtotal;
                                            @endphp
                                            <tr>
                                                <td>
                                                    <div class="fw-semibold text-dark">{{ $cart->product->name }}</div>
                                                    @if($cart->product->discount)
                                                        <span class="badge bg-danger-subtle text-danger small">Diskon {{ $cart->product->discount }}%</span>
                                                    @endif
                                                </td>
                                                <td class="text-center">{{ $cart->quantity }}</td>
                                                <td class="text-end">Rp {{ number_format($itemPrice, 0, ',', '.') }}</td>
                                                <td class="text-end fw-semibold">Rp {{ number_format($subtotal, 0, ',', '.') }}</td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Summary & Pay Button -->
                        <div class="row align-items-center">
                            <div class="col-md-6 mb-3 mb-md-0">
                                <div class="alert alert-info py-2 px-3 small mb-0">
                                    <i class="bi bi-info-circle me-1"></i> Setelah mengklik bayar, invoice resmi akan otomatis dikirimkan ke email Anda.
                                </div>
                            </div>
                            <div class="col-md-6 text-end">
                                <div class="mb-3">
                                    <span class="text-muted me-2">Total Pembayaran:</span>
                                    <h3 class="fw-bold text-warning d-inline-block mb-0">Rp {{ number_format($total, 0, ',', '.') }}</h3>
                                </div>
                                
                                <form action="{{ route('invoice.checkout') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="total_amount" value="{{ $total }}">
                                    <button type="submit" class="btn btn-warning btn-lg w-100 fw-semibold">
                                        <i class="bi bi-wallet2 me-2"></i>Bayar & Kirim Email
                                    </button>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-white border-top py-3 mt-auto">
        <div class="container text-center text-muted small">
            <p class="mb-0">&copy; 2026 MarketHub. All rights reserved.</p>
        </div>
    </footer>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
