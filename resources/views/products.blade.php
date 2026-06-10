<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Product Marketplace - Browse our collection">
    <meta name="author" content="Antigravity Developer">
    <title>Products Marketplace | Laravel CRUD Portal</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body class="bg-light d-flex flex-column min-vh-100">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg bg-white shadow-sm sticky-top border-bottom">
        <div class="container">
            <a class="navbar-brand fw-bold d-flex align-items-center gap-2" href="#">
                <span class="bg-primary text-white rounded-2 d-inline-flex align-items-center justify-content-center" style="width: 36px; height: 36px;">
                    <i class="bi bi-box-seam"></i>
                </span>
                MarketHub
            </a>

            <form class="d-flex flex-grow-1 mx-4" role="search">
                <div class="input-group">
                    <span class="input-group-text bg-white">
                        <i class="bi bi-search text-muted"></i>
                    </span>
                    <input class="form-control" type="search" placeholder="Cari produk..." aria-label="Search">
                </div>
            </form>

            <div class="d-flex align-items-center gap-2">
                <button class="btn btn-outline-primary btn-sm position-relative" type="button" data-bs-toggle="offcanvas" data-bs-target="#cartOffcanvas">
                    <i class="bi bi-cart3"></i>
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">{{ isset($carts) ? count($carts) : 0 }}</span>
                </button>

                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger btn-sm">
                        <i class="bi bi-box-arrow-right"></i> Logout
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <!-- Product Grid -->
    <main class="container py-4 flex-grow-1">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="fw-bold mb-0">Produk</h4>
            <span class="text-muted small">{{ $products->count() }} produk</span>
        </div>

        <div class="row g-3">
            @if ($products->count() > 0)
                @foreach ($products as $product)
                    <div class="col-6 col-md-4 col-lg-3">
                        <div class="card h-100 shadow-sm border-0 position-relative">
                            <div class="position-relative bg-light d-flex align-items-center justify-content-center" style="aspect-ratio: 1/1;">
                                @if ($product->discount)
                                    <span class="position-absolute top-0 start-0 badge bg-danger m-2">
                                        -{{ $product->discount }}%
                                    </span>
                                @endif

                                {{-- @if ($product->is_sold <= 0)
                                    <span class="position-absolute top-0 end-0 badge bg-secondary m-2">
                                        Sold
                                    </span>
                                @endif --}}

                                <i class="bi bi-laptop text-secondary" style="font-size: 3rem;"></i>
                            </div>

                            <div class="card-body d-flex flex-column">
                                <h6 class="card-title fw-semibold text-truncate-2" style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                                    {{ $product->name }}
                                </h6>

                                <div class="mt-auto d-flex justify-content-between align-items-end pt-2">
                                    <div>
                                        <span class="fw-bold text-warning">
                                            Rp {{ number_format($product->price, 0, ',', '.') }}
                                        </span>

                                        @if ($product->discount)
                                            @php
                                                $originalPrice = $product->price / (1 - $product->discount / 100);
                                            @endphp
                                            <br>
                                            <small class="text-muted text-decoration-line-through">
                                                Rp {{ number_format($originalPrice, 0, ',', '.') }}
                                            </small>
                                        @endif
                                    </div>
                                    <form action="{{ route('cart-store') }}" method="post">
                                        @csrf
                                        <input type="number" value="{{ $product->id }}" name="product_id" hidden>
                                        <button class="btn btn-warning btn-sm" type="submit">
                                            <i class="bi bi-cart-plus"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="col-12 text-center py-5">
                    <i class="bi bi-inbox text-secondary" style="font-size: 3rem;"></i>
                    <p class="text-muted mt-2">Belum ada produk tersedia.</p>
                </div>
            @endif
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-white border-top py-3 mt-auto">
        <div class="container text-center text-muted small">
            <p class="mb-0">&copy; 2026 MarketHub. All rights reserved.</p>
        </div>
    </footer>

    <!-- Cart Offcanvas -->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="cartOffcanvas" aria-labelledby="cartOffcanvasLabel">
        <div class="offcanvas-header border-bottom">
            <h5 class="offcanvas-title fw-bold" id="cartOffcanvasLabel">
                <i class="bi bi-cart3 me-2"></i>Keranjang Belanja
            </h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body d-flex flex-column p-0">
            <div class="list-group list-group-flush flex-grow-1">
                <!-- Item 1 -->
                @foreach ($carts as $cart)

                    <div class="list-group-item d-flex gap-3 align-items-center px-3 py-3">
                        <div class="bg-light rounded-2 d-flex align-items-center justify-content-center flex-shrink-0" style="width: 56px; height: 56px;">
                            {{ $cart->id }}
                        </div>
                        <div class="flex-grow-1 min-w-0">
                            <h6 class="mb-0 fw-semibold text-truncate">{{ $cart->name }}</h6>
                            <small class="text-muted">Rp </small>
                            <div class="d-flex align-items-center gap-1 mt-1">
                                <button class="btn btn-outline-secondary btn-sm rounded-2 d-flex" style="width: 28px; height: 28px; padding: 0;">-</button>
                                <span class="fw-semibold mx-1" style="min-width: 20px; text-align: center;">1</span>
                                <button class="btn btn-outline-secondary btn-sm rounded-2 d-flex" style="width: 28px; height: 28px; padding: 0;">+</button>
                            </div>
                        </div>
                        <button class="btn btn-sm text-danger flex-shrink-0">
                            <i class="bi bi-trash3"></i>
                        </button>
                    </div>
                @endforeach
            </div>

            <!-- Cart Footer -->
            <div class="border-top p-3">
                <div class="d-flex justify-content-between fw-bold mb-3">
                    <span>Total</span>
                    <span class="text-warning">Rp 37.998.000</span>
                </div>
                <button class="btn btn-primary w-100">
                    <i class="bi bi-credit-card me-2"></i>Checkout
                </button>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
