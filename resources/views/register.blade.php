<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Create a new account on the Laravel User Management Portal">
    <meta name="author" content="Antigravity Developer">
    <title>Create Account | Laravel CRUD Portal</title>

    <!-- Google Fonts: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    <!-- CSS Reset and Minimalist Professional Styling -->
    <style>
        :root {
            --bg-body: #f8fafc;
            --bg-card: #ffffff;
            --border-color: #e2e8f0;
            --border-hover: #cbd5e1;
            --primary: #4f46e5;
            --primary-hover: #4338ca;
            --success: #16a34a;
            --success-bg: #f0fdf4;
            --success-border: #dcfce7;
            --text-main: #0f172a;
            --text-muted: #475569;
            --bg-input: #ffffff;
            --border-radius-lg: 12px;
            --border-radius-md: 8px;
            --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -2px rgba(0, 0, 0, 0.05);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.05), 0 4px 6px -4px rgba(0, 0, 0, 0.05);
            --transition-smooth: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            background-color: var(--bg-body);
            color: var(--text-main);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .container {
            width: 100%;
            max-width: 500px;
            margin: 0 auto;
            padding: 3rem 1.5rem;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            gap: 2rem;
            justify-content: center;
        }

        /* Header section */
        header {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.75rem;
            border-bottom: 1px solid var(--border-color);
            padding-bottom: 1.5rem;
        }

        .logo-icon {
            width: 36px;
            height: 36px;
            background: var(--primary);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .logo-icon svg {
            width: 20px;
            height: 20px;
            fill: none;
            stroke: white;
            stroke-width: 2.5;
        }

        h1 {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--text-main);
            letter-spacing: -0.5px;
        }

        /* Card styles */
        .card {
            background: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: var(--border-radius-lg);
            box-shadow: var(--shadow-md);
            padding: 2rem;
            transition: var(--transition-smooth);
        }

        .card:hover {
            box-shadow: var(--shadow-lg);
            border-color: var(--border-hover);
        }

        .card-title {
            font-size: 1.15rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            color: var(--text-main);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .card-title svg {
            width: 20px;
            height: 20px;
            stroke: var(--primary);
            stroke-width: 2;
            fill: none;
        }

        .card-subtitle {
            font-size: 0.85rem;
            color: var(--text-muted);
            margin-bottom: 1.25rem;
            line-height: 1.5;
        }

        /* Alert styles */
        .alert {
            padding: 0.85rem 1rem;
            border-radius: var(--border-radius-md);
            margin-bottom: 1.25rem;
            font-size: 0.85rem;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .alert-success {
            background: var(--success-bg);
            border: 1px solid var(--success-border);
            color: var(--success);
        }

        .alert-danger {
            background: #fef2f2;
            border: 1px solid #fecaca;
            color: #dc2626;
        }

        .alert svg {
            width: 18px;
            height: 18px;
            stroke: currentColor;
            stroke-width: 2;
            fill: none;
            flex-shrink: 0;
        }

        /* Form Controls */
        .form-group {
            margin-bottom: 1.25rem;
            position: relative;
        }

        .form-label {
            display: block;
            font-size: 0.85rem;
            font-weight: 600;
            color: var(--text-muted);
            margin-bottom: 0.5rem;
        }

        .input-wrapper {
            position: relative;
            display: flex;
            align-items: center;
        }

        .input-icon {
            position: absolute;
            left: 0.85rem;
            color: #94a3b8;
            pointer-events: none;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .input-icon svg {
            width: 18px;
            height: 18px;
            stroke: currentColor;
            stroke-width: 2;
            fill: none;
        }

        .form-input {
            width: 100%;
            padding: 0.75rem 1rem 0.75rem 2.5rem;
            background: var(--bg-input);
            border: 1px solid var(--border-color);
            border-radius: var(--border-radius-md);
            color: var(--text-main);
            font-size: 0.95rem;
            font-family: inherit;
            transition: var(--transition-smooth);
            box-shadow: var(--shadow-sm);
        }

        .form-input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.15);
        }

        .form-input::placeholder {
            color: #a8a8a8;
        }

        /* Button design */
        .btn-submit {
            width: 100%;
            padding: 0.75rem 1rem;
            margin-top: 1rem;
            background: var(--primary);
            border: none;
            border-radius: var(--border-radius-md);
            color: #ffffff;
            font-size: 0.95rem;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            transition: var(--transition-smooth);
            box-shadow: var(--shadow-sm);
        }

        .btn-submit:hover {
            background: var(--primary-hover);
        }

        .btn-submit:active {
            transform: scale(0.99);
        }

        .btn-login {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            width: 100%;
            padding: 0.75rem 1rem;
            margin-top: 0.75rem;
            background: #ffffff;
            border: 1px solid var(--border-color);
            border-radius: var(--border-radius-md);
            color: #374151;
            font-size: 0.95rem;
            font-weight: 600;
            text-decoration: none;
            text-align: center;
            transition: var(--transition-smooth);
            box-shadow: var(--shadow-sm);
        }

        .btn-login:hover {
            background: #f9fafb;
            border-color: #d1d5db;
            color: #111827;
        }

        /* Footer styling */
        footer {
            text-align: center;
            padding: 2rem 1rem;
            color: var(--text-muted);
            font-size: 0.8rem;
            border-top: 1px solid var(--border-color);
            margin-top: auto;
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Header -->
        <header>
            <div class="logo-icon">
                <svg viewBox="0 0 24 24">
                    <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5" />
                </svg>
            </div>
            <h1>Laravel CRUD Portal</h1>
        </header>

        <!-- Main Content -->
        <main class="card">
            <h2 class="card-title">
                <svg viewBox="0 0 24 24">
                    <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" />
                    <circle cx="8.5" cy="7" r="4" />
                    <line x1="20" y1="8" x2="20" y2="14" />
                    <line x1="17" y1="11" x2="23" y2="11" />
                </svg>
                Create New Account
            </h2>

            <p class="card-subtitle">
                Fill in your details below to create a new account and access the dashboard.
            </p>

            <form action="{{ route('buat-login') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="name" class="form-label">Full Name</label>
                    <div class="input-wrapper">
                        <span class="input-icon">
                            <svg viewBox="0 0 24 24">
                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" />
                                <circle cx="12" cy="7" r="4" />
                            </svg>
                        </span>
                        <input type="text" class="form-input" id="name" placeholder="John Doe"
                            name="nama-panjang" value="{{ old('nama-panjang') }}" required autofocus>
                    </div>
                </div>

                <div class="form-group">
                    <label for="email" class="form-label">Email Address</label>
                    <div class="input-wrapper">
                        <span class="input-icon">
                            <svg viewBox="0 0 24 24">
                                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z" />
                                <polyline points="22,6 12,13 2,6" />
                            </svg>
                        </span>
                        <input type="email" class="form-input" id="email" placeholder="john@example.com"
                            name="email" value="{{ old('email') }}" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="password" class="form-label">Password</label>
                    <div class="input-wrapper">
                        <span class="input-icon">
                            <svg viewBox="0 0 24 24">
                                <rect x="3" y="11" width="18" height="11" rx="2" ry="2" />
                                <path d="M7 11V7a5 5 0 0 1 10 0v4" />
                            </svg>
                        </span>
                        <input type="password" class="form-input" id="password" placeholder="••••••••" name="password"
                            required>
                    </div>
                </div>

                <button class="btn-submit" type="submit">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2">
                        <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" />
                        <circle cx="8.5" cy="7" r="4" />
                        <line x1="20" y1="8" x2="20" y2="14" />
                        <line x1="17" y1="11" x2="23" y2="11" />
                    </svg>
                    Create Account
                </button>

                <a href="{{ route('login') }}" class="btn-login">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2">
                        <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4" />
                        <polyline points="10 17 15 12 10 7" />
                        <line x1="15" y1="12" x2="3" y2="12" />
                    </svg>
                    Already have an account? Sign In
                </a>
            </form>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if ($errors->any())
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Registration Failed',
            text: '{{ $errors->first() }}',
            confirmButtonColor: '#4f46e5',
        });
    </script>
    @endif

    @if (session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Account Created',
            text: '{{ session('success') }}',
            confirmButtonColor: '#4f46e5',
        }).then(function () {
            window.location.href = '{{ route('login') }}';
        });
    </script>
    @endif
</body>

</html>
