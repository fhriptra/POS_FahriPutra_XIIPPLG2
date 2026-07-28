<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - GameKu POS</title>
    <!-- Bootstrap 5 CSS & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <style>
        body {
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
            background-image: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)), url('https://img.magnific.com/free-vector/online-videogame-controller-background-with-text-space_1017-54747.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            min-height: 100vh;
        }
        .login-card {
            border: none;
            border-radius: 1rem;
            overflow: hidden;
            box-shadow: 0 1rem 3rem rgba(0, 0, 0, 0.25);
        }
        .brand-section {
            background: linear-gradient(135deg, #000e5a 0%, #120ee6 100%);
            color: #ffffff;
        }
        .form-control:focus {
            border-color: #0262c9;
            box-shadow: 0 0 0 0.25rem rgba(2, 98, 201, 0.15);
        }
        .btn-primary {
            background-color: #0c5ab9;
            border-color: #0262c9;
            padding: 0.75rem 1rem;
            font-weight: 600;
        }
        .btn-primary:hover {
            background-color: #0a4896;
            border-color: #0256b3;
        }
    </style>
</head>
<body class="d-flex align-items-center justify-content-center py-5">

<div class="container">
    <div class="row justify-content-center">
        <div class="col-xl-10 col-lg-12">
            <div class="card login-card">
                <div class="row g-0">
                    <!-- Kolom Kiri: Branding / Info POS -->
                    <div class="col-lg-6 d-none d-lg-flex flex-column justify-content-between p-5 brand-section">
                        <div class="d-flex align-items-center gap-2">
                            <i class="bi bi-joystick fs-3 text-warning"></i>
                            <span class="fs-4 fw-bold">GameKu POS</span>
                        </div>
                        
                        <div class="my-auto pe-4">
                            <h2 class="fw-bold mb-3">Level Up Transaksi & Stok Game Kamu.</h2>
                            <p class="text-white-50 lead fs-6">
                                Kelola kaset game, konsol, hingga <em>gaming gear</em> dalam satu sistem kasir yang cepat dan presisi.
                            </p>
                        </div>

                        <div class="small text-white-50">
                            &copy; {{ date('Y') }} Fahri Israhadi Putra. All rights reserved.
                        </div>
                    </div>

                    <!-- Kolom Kanan: Form Login -->
                    <div class="col-lg-6 d-flex align-items-center justify-content-center p-4 p-sm-5 bg-white">
                        <div class="w-100">
                            <!-- Header Form -->
                            <div class="text-center text-lg-start mb-4">
                                <div class="d-lg-none d-inline-flex align-items-center gap-2 mb-3">
                                    <i class="bi bi-joystick fs-2 text-primary"></i>
                                    <span class="fs-3 fw-bold">GameKu POS</span>
                                </div>
                                <h3 class="fw-bold text-dark mb-1">Selamat Datang</h3>
                                <p class="text-muted small">Masukkan akun kasir atau admin untuk masuk</p>
                            </div>

                            <!-- Alert Error Laravel -->
                            @if ($errors->any())
                                <div class="alert alert-danger alert-dismissible fade show rounded-3 mb-4" role="alert">
                                    <div class="d-flex align-items-center gap-2">
                                        <i class="bi bi-exclamation-triangle-fill"></i>
                                        <span>{{ $errors->first() }}</span>
                                    </div>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif

                            <form action="{{ route('auth') }}" method="POST">
                                @csrf

                                <!-- Field Email -->
                                <div class="mb-3">
                                    <label for="email" class="form-label fw-semibold text-secondary small">Email / Username</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light text-muted border-end-0">
                                            <i class="bi bi-person"></i>
                                        </span>
                                        <input type="email" class="form-control bg-light border-start-0" id="email" name="email" value="{{ old('email') }}" placeholder="kasir@tokoku.com" required autofocus>
                                    </div>
                                </div>

                                <!-- Field Password -->
                                <div class="mb-4">
                                    <label for="password" class="form-label fw-semibold text-secondary small">Password</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light text-muted border-end-0">
                                            <i class="bi bi-lock"></i>
                                        </span>
                                        <input type="password" class="form-control bg-light border-start-0" id="password" name="password" placeholder="••••••••" required>
                                    </div>
                                </div>

                                <!-- Submit Button -->
                                <button type="submit" class="btn btn-primary w-100 rounded-3 shadow-sm">
                                    <i class="bi bi-box-arrow-in-right me-2"></i> Masuk ke Kasir
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>