<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') - GameKu POS</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;600;700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --bg: #f5f6fb;
            --surface: #ffffff;
            --sidebar-bg: #14162b;
            --sidebar-bg-hover: #1f2242;
            --accent: #5b5fef;
            --accent-dark: #4547c9;
            --accent-soft: #eef0ff;
            --accent-cyan: #22d3ee;
            --text: #1b1d2a;
            --text-muted: #6b7280;
            --border: #e7e8f1;
            --success: #16a34a;
            --warning: #d97706;
            --danger: #dc2626;
            --info: #0891b2;
            --radius: 14px;
        }

        * { font-family: 'Inter', system-ui, -apple-system, sans-serif; }
        h1, h2, h3, h4, h5, h6, .brand-font { font-family: 'Space Grotesk', 'Inter', sans-serif; }

        body {
            background-color: var(--bg);
            color: var(--text);
            min-height: 100vh;
        }

        #wrapper { display: flex; min-height: 100vh; }

        /* Sidebar */
        #sidebar-wrapper {
            min-width: 260px;
            max-width: 300px;
            background: var(--sidebar-bg);
            color: #fff;
            display: flex;
            flex-direction: column;
        }
        #sidebar-wrapper .sidebar-heading {
            padding: 1.4rem 1.4rem;
            display: flex;
            align-items: center;
            gap: .65rem;
            border-bottom: 1px solid rgba(255,255,255,.06);
        }
        #sidebar-wrapper .brand-badge {
            width: 38px; height: 38px;
            border-radius: 10px;
            background: linear-gradient(135deg, var(--accent), var(--accent-cyan));
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }
        #sidebar-wrapper .brand-badge i { font-size: 1.15rem; color: #fff; }
        #sidebar-wrapper .brand-name { font-family: 'Space Grotesk', sans-serif; font-weight: 700; font-size: 1.05rem; line-height: 1.1; }
        #sidebar-wrapper .brand-sub { font-size: .68rem; color: rgba(255,255,255,.45); letter-spacing: .04em; }

        #sidebar-wrapper .nav-section-label {
            font-size: .68rem;
            text-transform: uppercase;
            letter-spacing: .08em;
            color: rgba(255,255,255,.35);
            padding: 1.1rem 1.4rem .4rem;
        }

        #sidebar-wrapper .list-group-item {
            border: none;
            background: transparent;
            color: rgba(255,255,255,.65);
            padding: .68rem 1.4rem;
            font-size: .92rem;
            font-weight: 500;
            border-left: 3px solid transparent;
            transition: all .15s ease;
        }
        #sidebar-wrapper .list-group-item i { width: 18px; text-align: center; font-size: 1rem; }
        #sidebar-wrapper .list-group-item:hover {
            color: #fff;
            background: var(--sidebar-bg-hover);
        }
        #sidebar-wrapper .list-group-item.active {
            color: #fff;
            background: var(--sidebar-bg-hover);
            border-left-color: var(--accent-cyan);
        }

        #page-content-wrapper { flex: 1; width: 100%; min-width: 0; }

        /* Topbar */
        .topbar {
            background: var(--surface);
            border-bottom: 1px solid var(--border);
            padding: 1.1rem 1.75rem;
        }
        .topbar h5 { font-weight: 700; letter-spacing: -.01em; }
        .topbar .btn-user {
            background: var(--bg);
            border: 1px solid var(--border);
            color: var(--text);
            font-weight: 500;
        }

        .container-fluid.p-4 { padding: 1.75rem !important; }

        /* Cards */
        .card {
            border: 1px solid var(--border);
            border-radius: var(--radius);
            box-shadow: 0 1px 2px rgba(15,17,38,.03);
        }
        .card-header { border-bottom: 1px solid var(--border); border-radius: var(--radius) var(--radius) 0 0 !important; }
        .card-footer { border-top: 1px solid var(--border); border-radius: 0 0 var(--radius) var(--radius) !important; }

        /* Buttons */
        .btn-primary {
            background-color: var(--accent);
            border-color: var(--accent);
            font-weight: 600;
        }
        .btn-primary:hover, .btn-primary:focus {
            background-color: var(--accent-dark);
            border-color: var(--accent-dark);
        }
        .btn-outline-primary { color: var(--accent); border-color: var(--accent); }
        .btn-outline-primary:hover { background-color: var(--accent); border-color: var(--accent); }
        .text-primary { color: var(--accent) !important; }
        .btn, .form-control, .form-select, .badge { border-radius: 9px; }

        /* Table */
        .table thead.table-light th, .table > :not(caption) > * > th {
            background-color: var(--accent-soft);
            color: var(--text);
            font-size: .78rem;
            text-transform: uppercase;
            letter-spacing: .04em;
            font-weight: 700;
            border-bottom: none;
        }
        .table > :not(:first-child) { border-top: none; }
        .table-hover > tbody > tr:hover > * { background-color: var(--accent-soft); }
        .table td, .table th { vertical-align: middle; }

        /* Stat card icon chip */
        .stat-icon {
            width: 44px; height: 44px;
            border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.2rem;
        }

        @media (max-width: 991.98px) {
            #sidebar-wrapper { min-width: 74px; max-width: 74px; }
            #sidebar-wrapper .brand-name, #sidebar-wrapper .brand-sub,
            #sidebar-wrapper .nav-section-label, #sidebar-wrapper .list-group-item span { display: none; }
            #sidebar-wrapper .sidebar-heading { justify-content: center; padding: 1.4rem .6rem; }
            #sidebar-wrapper .list-group-item { justify-content: center; padding: .75rem; }
        }
    </style>
</head>
<body>
    <div id="wrapper">
        <!-- Sidebar Navigation -->
        @include('layouts.sidebar')

        <!-- Page Content -->
        <div id="page-content-wrapper" class="d-flex flex-column">

            <!-- Top Navbar Header -->
            <nav class="topbar d-flex align-items-center justify-content-between">
                <h5 class="m-0">@yield('title')</h5>
                <div class="dropdown">
                    <button class="btn btn-user dropdown-toggle btn-sm px-3" type="button" data-bs-toggle="dropdown">
                        <i class="bi bi-person-circle me-1"></i> {{ Auth::user()->name ?? 'User' }}
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 mt-2">
                        <li>
                            <form action="{{ route('logout') }}" method="post">
                                @csrf
                                <button type="submit" class="dropdown-item text-danger">
                                    <i class="bi bi-box-arrow-right me-2"></i>Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Alert Flash Notification -->
            @if (session('status') || session('success'))
                <div id="autoDismissAlert" class="alert alert-success alert-dismissible fade show rounded-0 m-0 border-0 shadow-sm" role="alert">
                    <div class="container-fluid d-flex align-items-center justify-content-between">
                        <div>
                            <i class="bi bi-check-circle-fill me-2"></i>
                            {{ session('status') ?? session('success') }}
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
                <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        var alertEl = document.getElementById('autoDismissAlert');
                        if (alertEl) {
                            setTimeout(function () {
                                var bsAlert = bootstrap.Alert.getOrCreateInstance(alertEl);
                                bsAlert.close();
                            }, 3000);
                        }
                    });
                </script>
            @endif

            <!-- Main Content Area -->
            <div class="container-fluid p-4">
                @yield('content')
            </div>
        </div>
    </div>
</body>
</html>
