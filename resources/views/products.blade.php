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
    @include('sweetalert::alert')

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
            <div class="d-flex align-items-center gap-3">
                <h4 class="fw-bold mb-0">Produk</h4>
                <span class="badge bg-secondary">{{ $products->count() }} produk</span>
            </div>
            @if(auth()->user() && auth()->user()->role === 'admin')
                <a href="{{ route('admin.products.index') }}" class="btn btn-outline-primary">
                    <i class="bi bi-shield-lock me-1"></i> Admin Panel
                </a>
            @endif
        </div>

        <div class="row g-3">
            @if ($products->count() > 0)
                @foreach ($products as $product)
                    <div class="col-6 col-md-4 col-lg-3">
                        <div class="card h-100 shadow-sm border-0 position-relative">
                            <div class="position-relative bg-light d-flex align-items-center justify-content-center" style="aspect-ratio: 1/1; overflow: hidden;">
                                @if ($product->discount)
                                    <span class="position-absolute top-0 start-0 badge bg-danger m-2" style="z-index: 5;">
                                        -{{ $product->discount }}%
                                    </span>
                                @endif

                                @if ($product->is_sold == 1)
                                    <span class="position-absolute bottom-0 start-0 badge bg-secondary m-2" style="z-index: 5;">
                                        Sold
                                    </span>
                                @endif

                                @if ($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" class="w-100 h-100 object-fit-cover" alt="{{ $product->name }}">
                                @else
                                    <i class="bi bi-laptop text-secondary" style="font-size: 3rem;"></i>
                                @endif
                            </div>

                            <div class="card-body d-flex flex-column">
                                <h6 class="card-title fw-semibold text-truncate-2 mb-1" style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                                    {{ $product->name }}
                                </h6>
                                <p class="text-muted small mb-2">
                                    <i class="bi bi-shop me-1"></i> {{ $product->store ? $product->store->name : 'Tanpa Toko' }}
                                </p>

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
            <div class="list-group list-group-flush flex-grow-1" style="overflow-y: auto;">
                @php $cartTotal = 0; @endphp
                @forelse ($carts as $cart)
                    @if($cart->product)
                        @php
                            $itemPrice = $cart->product->price;
                            if ($cart->product->discount) {
                                $itemPrice = $cart->product->price * (1 - $cart->product->discount / 100);
                            }
                            $itemTotal = $itemPrice * $cart->quantity;
                            $cartTotal += $itemTotal;
                        @endphp
                        <div class="list-group-item d-flex gap-3 align-items-center px-3 py-3">
                            <div class="bg-light rounded-2 d-flex align-items-center justify-content-center flex-shrink-0" style="width: 56px; height: 56px; overflow: hidden;">
                                @if ($cart->product->image)
                                    <img src="{{ asset('storage/' . $cart->product->image) }}" class="w-100 h-100 object-fit-cover" alt="product">
                                @else
                                    <i class="bi bi-image text-secondary" style="font-size: 1.2rem;"></i>
                                @endif
                            </div>
                            <div class="flex-grow-1 min-w-0">
                                <h6 class="mb-0 fw-semibold text-truncate">{{ $cart->product->name }}</h6>
                                <small class="text-muted">Rp {{ number_format($itemPrice, 0, ',', '.') }} x {{ $cart->quantity }}</small>
                            </div>
                            <form action="{{ route('cart.destroy', $cart->id) }}" method="POST" class="m-0">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm text-danger flex-shrink-0 border-0 bg-transparent">
                                    <i class="bi bi-trash3"></i>
                                </button>
                            </form>
                        </div>
                    @endif
                @empty
                    <div class="text-center py-5 text-muted">
                        <i class="bi bi-cart-x fs-1 d-block mb-2"></i>
                        Keranjang Anda kosong.
                    </div>
                @endforelse
            </div>

            <!-- Cart Footer -->
            <div class="border-top p-3 bg-light">
                <div class="d-flex justify-content-between fw-bold mb-3">
                    <span>Total</span>
                    <span class="text-warning">Rp {{ number_format($cartTotal, 0, ',', '.') }}</span>
                </div>
                @if ($carts->count() > 0)
                    <a href="{{ route('invoice.index') }}" class="btn btn-primary w-100">
                        <i class="bi bi-credit-card me-2"></i>Checkout
                    </a>
                @else
                    <button class="btn btn-primary w-100" disabled>
                        <i class="bi bi-credit-card me-2"></i>Checkout
                    </button>
                @endif
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
