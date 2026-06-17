<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Admin Portal - Manage Products">
    <meta name="author" content="Antigravity Developer">
    <title>Admin Products Panel | MarketHub</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body class="bg-light d-flex flex-column min-vh-100">
    @include('sweetalert::alert')

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg bg-dark navbar-dark shadow-sm sticky-top">
        <div class="container">
            <a class="navbar-brand fw-bold d-flex align-items-center gap-2" href="{{ route('product') }}">
                <span class="bg-primary text-white rounded-2 d-inline-flex align-items-center justify-content-center"
                    style="width: 36px; height: 36px;">
                    <i class="bi bi-shield-lock"></i>
                </span>
                MarketHub Admin
            </a>

            <div class="d-flex align-items-center gap-3">
                <a href="{{ route('product') }}" class="btn btn-outline-light btn-sm">
                    <i class="bi bi-arrow-left"></i> Lihat Toko
                </a>
                <form action="{{ route('logout') }}" method="POST" class="m-0">
                    @csrf
                    <button type="submit" class="btn btn-danger btn-sm">
                        <i class="bi bi-box-arrow-right"></i> Logout
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <!-- Main Panel -->
    <main class="container py-4 flex-grow-1">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-bottom py-3 d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="fw-bold mb-0 text-dark">Kelola Produk</h5>
                    <small class="text-muted">Kelola inventori produk, diskon, dan toko</small>
                </div>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addProductModal">
                    <i class="bi bi-plus-lg me-1"></i> Tambah Produk Baru
                </button>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th scope="col" style="width: 80px;">Gambar</th>
                            <th scope="col">Nama Produk</th>
                            <th scope="col">Toko</th>
                            <th scope="col">Harga</th>
                            <th scope="col" style="width: 100px;">Diskon</th>
                            <th scope="col" style="width: 120px;">Status</th>
                            <th scope="col" class="text-end" style="width: 150px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($products as $product)
                            <tr>
                                <td>
                                    <div class="bg-light rounded d-flex align-items-center justify-content-center border"
                                        style="width: 60px; height: 60px; overflow: hidden;">
                                        @if ($product->image)
                                            <img src="{{ asset('storage/' . $product->image) }}"
                                                class="w-100 h-100 object-fit-cover" alt="product">
                                        @else
                                            <i class="bi bi-image text-secondary" style="font-size: 1.5rem;"></i>
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    <div class="fw-semibold text-dark">{{ $product->name }}</div>
                                    <small class="text-muted">ID: #{{ $product->id }}</small>
                                </td>
                                <td>
                                    <span class="badge bg-info text-dark">
                                        <i
                                            class="bi bi-shop me-1"></i>{{ $product->store ? $product->store->name : 'Tanpa Toko' }}
                                    </span>
                                </td>
                                <td>
                                    <div class="fw-bold text-success">Rp
                                        {{ number_format($product->price, 0, ',', '.') }}</div>
                                </td>
                                <td>
                                    @if ($product->discount)
                                        <span class="badge bg-danger">{{ $product->discount }}%</span>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($product->is_sold == 1)
                                        <span class="badge bg-secondary">Sold Out</span>
                                    @else
                                        <span class="badge bg-success">Tersedia</span>
                                    @endif
                                </td>
                                <td class="text-end">
                                    <div class="d-inline-flex gap-2">
                                        <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal"
                                            data-bs-target="#editProductModal{{ $product->id }}">
                                            <i class="bi bi-pencil-square"></i>
                                        </button>
                                        <form action="{{ route('admin.products.destroy', $product->id) }}"
                                            method="POST" class="d-inline"
                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-5 text-muted">
                                    <i class="bi bi-inbox fs-1 d-block mb-3"></i>
                                    Belum ada produk yang ditambahkan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-white border-top py-3 mt-auto">
        <div class="container text-center text-muted small">
            <p class="mb-0">&copy; 2026 MarketHub Admin Panel. All rights reserved.</p>
        </div>
    </footer>

    <!-- Add Product Modal -->
    <div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title fw-bold" id="addProductModalLabel">Tambah Produk Baru</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="store_id" class="form-label">Toko / Store</label>
                            <select class="form-select" id="store_id" name="store_id" required>
                                <option value="" disabled selected>Pilih Toko</option>
                                @foreach ($stores as $store)
                                    <option value="{{ $store->id }}">{{ $store->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Produk</label>
                            <input type="text" class="form-control" id="name" name="name" required
                                placeholder="Contoh: Laptop Asus">
                        </div>
                        <div class="mb-3">
                            <label for="price" class="form-label">Harga (Rp)</label>
                            <input type="number" class="form-control" id="price" name="price" required
                                min="0" placeholder="Contoh: 15000000">
                        </div>
                        <div class="mb-3">
                            <label for="discount" class="form-label">Diskon (%)</label>
                            <input type="number" class="form-control" id="discount" name="discount"
                                min="0" max="100" placeholder="Contoh: 10 (kosongkan jika tidak ada)">
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Gambar Produk</label>
                            <input type="file" class="form-control" id="image" name="image"
                                accept="image/*">
                        </div>
                        <div class="mb-3">
                            <label for="is_sold" class="form-label">Status</label>
                            <select class="form-select" id="is_sold" name="is_sold" required>
                                <option value="0" selected>Tersedia (Aktif)</option>
                                <option value="1">Habis / Terjual (Sold)</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Product Modals -->
    @foreach ($products as $product)
        <div class="modal fade" id="editProductModal{{ $product->id }}" tabindex="-1"
            aria-labelledby="editProductModalLabel{{ $product->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ route('admin.products.update', $product->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="modal-header">
                            <h5 class="modal-title fw-bold" id="editProductModalLabel{{ $product->id }}">Edit Produk
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="store_id{{ $product->id }}" class="form-label">Toko / Store</label>
                                <select class="form-select" id="store_id{{ $product->id }}" name="store_id"
                                    required>
                                    @foreach ($stores as $store)
                                        <option value="{{ $store->id }}"
                                            {{ $product->store_id == $store->id ? 'selected' : '' }}>
                                            {{ $store->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="name{{ $product->id }}" class="form-label">Nama Produk</label>
                                <input type="text" class="form-control" id="name{{ $product->id }}"
                                    name="name" value="{{ $product->name }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="price{{ $product->id }}" class="form-label">Harga (Rp)</label>
                                <input type="number" class="form-control" id="price{{ $product->id }}"
                                    name="price" value="{{ $product->price }}" required min="0">
                            </div>
                            <div class="mb-3">
                                <label for="discount{{ $product->id }}" class="form-label">Diskon (%)</label>
                                <input type="number" class="form-control" id="discount{{ $product->id }}"
                                    name="discount" value="{{ $product->discount }}" min="0" max="100">
                            </div>
                            <div class="mb-3">
                                <label for="image{{ $product->id }}" class="form-label">Ganti Gambar Produk
                                    (Opsional)</label>
                                <input type="file" class="form-control" id="image{{ $product->id }}"
                                    name="image" accept="image/*">
                                @if ($product->image)
                                    <div class="mt-2 text-muted small">Gambar saat ini:</div>
                                    <img src="{{ asset('storage/' . $product->image) }}" class="img-thumbnail mt-1"
                                        style="max-height: 100px;" alt="current image">
                                @endif
                            </div>
                            <div class="mb-3">
                                <label for="is_sold{{ $product->id }}" class="form-label">Status</label>
                                <select class="form-select" id="is_sold{{ $product->id }}" name="is_sold" required>
                                    <option value="0" {{ $product->is_sold == 0 ? 'selected' : '' }}>Tersedia
                                        (Aktif)</option>
                                    <option value="1" {{ $product->is_sold == 1 ? 'selected' : '' }}>Habis /
                                        Terjual (Sold)</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
