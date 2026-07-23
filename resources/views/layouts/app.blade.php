<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js']) 
</head>
<body>
    <div class="container">

        @if (session('status') || session('success'))
    <div id="autoDismissAlert" class="alert alert-success alert-dismissible fade show border-0 shadow position-fixed top-0 start-0 w-100 m-0" 
         style="z-index: 9999;" role="alert">
        <div class="container d-flex align-items-center justify-content-between">
            <div>
                <i class="bi bi-check-circle-fill me-2"></i>
                {{ session('status') ?? session('success') }}
            </div>
            <!-- Tombol X tetap aktif -->
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var alertEl = document.getElementById('autoDismissAlert');
            if (alertEl) {
                // Tunggu 3000ms (3 detik), lalu tutup alert menggunakan API Bootstrap
                setTimeout(function () {
                    var bsAlert = bootstrap.Alert.getOrCreateInstance(alertEl);
                    bsAlert.close();
                }, 3000); 
            }
        });
    </script>
@endif
        
        @yield('content')
    </div>
</body>
</html>