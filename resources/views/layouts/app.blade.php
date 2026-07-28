<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') - Management System</title>
    <!-- Bootstrap Icons CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js']) 
    <style>
        body {
            background-color: #f8f9fa;
            min-height: 100vh;
        }
        #wrapper {
            display: flex;
            min-height: 100vh;
        }
        #sidebar-wrapper {
            min-width: 250px;
            max-width: 250px;
            background: #212529;
            color: #fff;
            transition: all 0.3s;
        }
        #sidebar-wrapper .sidebar-heading {
            padding: 1.25rem 1.5rem;
            font-size: 1.2rem;
            font-weight: bold;
        }
        #sidebar-wrapper .list-group-item {
            border: none;
            background: transparent;
            color: #060606;
            padding: 0.75rem 1.5rem;
        }
        #sidebar-wrapper .list-group-item:hover,
        #sidebar-wrapper .list-group-item.active {
            color: #fff;
            background: #0d6efd;
        }
        #page-content-wrapper {
            flex: 1;
            width: 100%;
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
            <nav class="navbar navbar-expand-lg navbar-white bg-light px-4 py-3 shadow-sm" style="margin: 0;">
                <div class="d-flex align-items-center justify-content-between w-100">
                    <h5 class="m-0 text-black fw-bold">@yield('title')</h5>
                    <div class="dropdown">
                        <button class="btn btn-white border-secondary text-black dropdown-toggle btn-sm px-3" type="button" data-bs-toggle="dropdown">
                            <i class="bi bi-person-circle me-1"></i> {{ Auth::user()->name ?? 'User' }}
                        </button>
                        <ul class="dropdown-menu dropdown-menu-dark dropdown-menu-end shadow border-0">
                            <li>
                                <form action="{{ route('logout') }}" method="post">
                                    @csrf
                                    <button type="submit" class="dropdown-content dropdown-item text-danger">
                                        <i class="bi bi-box-arrow-right me-2"></i>Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
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