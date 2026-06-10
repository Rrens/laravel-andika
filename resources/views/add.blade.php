<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Laravel User Management Dashboard and Login Portal">
    <meta name="author" content="Antigravity Developer">
    <title>User Portal & Management Dashboard</title>

    <!-- Google Fonts: Inter & JetBrains Mono -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">

    <!-- CSS Reset and Minimalist Professional Styling -->
    <style>
        :root {
            --bg-body: #f8fafc;
            --bg-card: #ffffff;
            --border-color: #e2e8f0;
            --border-hover: #cbd5e1;
            --primary: #4f46e5;
            --primary-hover: #4338ca;
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
            max-width: 1200px;
            margin: 0 auto;
            padding: 3rem 1.5rem;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            gap: 2.5rem;
            justify-content: center;
        }

        /* Header section */
        header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 1px solid var(--border-color);
            padding-bottom: 1.5rem;
        }

        .logo-area {
            display: flex;
            align-items: center;
            gap: 0.75rem;
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

        .badge-status {
            background: #f0fdf4;
            border: 1px solid #dcfce7;
            color: #166534;
            padding: 0.35rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.8rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 0.4rem;
        }

        .badge-status::before {
            content: "";
            width: 6px;
            height: 6px;
            background-color: #22c55e;
            border-radius: 50%;
            display: inline-block;
        }

        .header-actions {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .btn-logout {
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
            padding: 0.35rem 0.75rem;
            background: #fff5f5;
            color: #dc2626;
            border: 1px solid #fecaca;
            border-radius: 6px;
            font-size: 0.8rem;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition-smooth);
            font-family: inherit;
        }

        .btn-logout:hover {
            background: #fef2f2;
            border-color: #fca5a5;
        }

        .btn-logout svg {
            width: 14px;
            height: 14px;
            stroke: currentColor;
            stroke-width: 2;
            fill: none;
        }

        /* Main Dashboard Grid */
        .dashboard-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 2rem;
            align-items: start;
        }

        @media (min-width: 992px) {
            .dashboard-grid {
                grid-template-columns: 380px 1fr;
            }
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

        /* Responsive Table styling */
        .table-container {
            overflow-x: auto;
            border-radius: var(--border-radius-md);
            border: 1px solid var(--border-color);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
            font-size: 0.95rem;
        }

        th {
            background-color: #f8fafc;
            color: var(--text-muted);
            font-weight: 600;
            padding: 0.85rem 1.25rem;
            border-bottom: 1px solid var(--border-color);
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.5px;
        }

        td {
            padding: 0.95rem 1.25rem;
            border-bottom: 1px solid var(--border-color);
            color: var(--text-main);
            vertical-align: middle;
        }

        tr {
            transition: background-color 0.15s ease;
        }

        tr:last-child td {
            border-bottom: none;
        }

        tr:hover td {
            background-color: #f8fafc;
        }

        .user-id {
            font-family: 'JetBrains Mono', monospace;
            font-weight: 500;
            color: var(--text-muted);
            background: #f1f5f9;
            padding: 0.2rem 0.5rem;
            border-radius: 4px;
            font-size: 0.85rem;
            border: 1px solid var(--border-color);
        }

        .user-name {
            font-weight: 600;
            color: var(--text-main);
        }

        .user-email {
            color: var(--text-muted);
            font-size: 0.9rem;
        }

        /* Action Buttons styling */
        .actions-cell {
            display: flex;
            gap: 0.5rem;
        }

        .btn-action {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.4rem;
            padding: 0.4rem 0.75rem;
            border-radius: 6px;
            font-size: 0.8rem;
            font-weight: 600;
            text-decoration: none;
            transition: var(--transition-smooth);
            cursor: pointer;
        }

        .btn-edit {
            background: #ffffff;
            color: #374151;
            border: 1px solid var(--border-color);
            box-shadow: var(--shadow-sm);
        }

        .btn-edit:hover {
            background: #f9fafb;
            border-color: #d1d5db;
            color: #111827;
        }

        .btn-delete {
            background: #ffffff;
            color: #dc2626;
            border: 1px solid #fecaca;
            box-shadow: var(--shadow-sm);
        }

        .btn-delete:hover {
            background: #fef2f2;
            border-color: #fca5a5;
        }

        .btn-action svg {
            width: 14px;
            height: 14px;
            stroke: currentColor;
            stroke-width: 2;
            fill: none;
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

        /* Empty state style */
        .empty-state {
            text-align: center;
            padding: 3rem 1.5rem;
            color: var(--text-muted);
        }

        .empty-state svg {
            width: 40px;
            height: 40px;
            stroke: #cbd5e1;
            stroke-width: 1.5;
            fill: none;
            margin-bottom: 1rem;
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Header -->
        <header>
            <div class="logo-area">
                <div class="logo-icon">
                    <svg viewBox="0 0 24 24">
                        <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5" />
                    </svg>
                </div>
                <div>
                    <h1>Laravel CRUD Portal</h1>
                </div>
            </div>
            <div class="header-actions">
                <div class="badge-status">
                    Database Connected
                </div>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn-logout">
                        <svg viewBox="0 0 24 24">
                            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" />
                            <polyline points="16 17 21 12 16 7" />
                            <line x1="21" y1="12" x2="9" y2="12" />
                        </svg>
                        Logout
                    </button>
                </form>
            </div>
        </header>

        <!-- Main Dashboard Content -->
        <main class="dashboard-grid">
            <!-- Registration Form Card -->
            <section class="card">
                <h2 class="card-title" id="form-title">
                    <svg viewBox="0 0 24 24">
                        <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" />
                        <circle cx="8.5" cy="7" r="4" />
                        <line x1="20" y1="8" x2="20" y2="14" />
                        <line x1="17" y1="11" x2="23" y2="11" />
                    </svg>
                    Add New User
                </h2>
                <form action="{{ route('buat-login') }}" method="POST" id="create-user-form">
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
                            <input type="text" class="form-input" id="name" placeholder="John Doe" name="nama-panjang" required>
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
                            <input type="email" class="form-input" id="email" placeholder="john@example.com" name="email" required>
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
                            <input type="password" class="form-input" id="password" placeholder="••••••••" name="password" required>
                        </div>
                    </div>

                    <button class="btn-submit" type="submit" id="submit-btn">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z" />
                            <polyline points="17 21 17 13 7 13 7 21" />
                            <polyline points="7 3 7 8 15 8" />
                        </svg>
                        Save User
                    </button>
                </form>
            </section>

            <!-- Users List Table Card -->
            <section class="card">
                <h2 class="card-title">
                    <svg viewBox="0 0 24 24">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" />
                        <circle cx="9" cy="7" r="4" />
                        <path d="M23 21v-2a4 4 0 0 0-3-3.87" />
                        <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                    </svg>
                    Active Users Registry
                </h2>
                
                <div class="table-container">
                    @if(count($data) > 0)
                        <table>
                            <thead>
                                <tr>
                                    <th scope="col" style="width: 80px;">ID</th>
                                    <th scope="col">User Info</th>
                                    <th scope="col" style="width: 180px; text-align: right;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $i)
                                    <tr>
                                        <td>
                                            <span class="user-id">#{{ $i->id }}</span>
                                        </td>
                                        <td>
                                            <div class="user-name">{{ $i->name }}</div>
                                            <div class="user-email">{{ $i->email }}</div>
                                        </td>
                                        <td>
                                            <div class="actions-cell" style="justify-content: flex-end;">
                                                <a href="{{ route('update', ['id' => $i->id]) }}" class="btn-action btn-edit" id="btn-edit-{{ $i->id }}">
                                                    <svg viewBox="0 0 24 24">
                                                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" />
                                                        <path d="M18.5 2.5a2.121 2.121 0 1 1 3 3L12 15l-4 1 1-4 9.5-9.5z" />
                                                    </svg>
                                                    Edit
                                                </a>
                                                <a href="{{ route('delete', ['id' => $i->id]) }}" class="btn-action btn-delete" id="btn-delete-{{ $i->id }}" onclick="return confirm('Are you sure you want to delete this user?');">
                                                    <svg viewBox="0 0 24 24">
                                                        <polyline points="3 6 5 6 21 6" />
                                                        <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2" />
                                                        <line x1="10" y1="11" x2="10" y2="17" />
                                                        <line x1="14" y1="11" x2="14" y2="17" />
                                                    </svg>
                                                    Delete
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="empty-state">
                            <svg viewBox="0 0 24 24">
                                <circle cx="12" cy="12" r="10" />
                                <line x1="12" y1="8" x2="12" y2="12" />
                                <line x1="12" y1="16" x2="12.01" y2="16" />
                            </svg>
                            <p>No active users found in the system.</p>
                        </div>
                    @endif
                </div>
            </section>
        </main>

        <!-- Footer -->
        <footer>
            <p>&copy; 2026 Laravel CRUD Portal. Built with clean, minimalist design principles.</p>
        </footer>
    </div>
</body>

</html>
