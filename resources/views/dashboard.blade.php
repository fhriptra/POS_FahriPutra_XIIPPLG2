@extends('layouts.app')

@section('title', 'Dashboard Ringkasan Hari Ini')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-bold mb-1">
            <i class="bi bi-speedometer2 me-2 text-primary"></i>Ringkasan Hari Ini
        </h3>
        <p class="text-muted small mb-0">
            <i class="bi bi-calendar-event me-1"></i>{{ $tanggalHariIni->translatedFormat('l, d F Y') }}
        </p>
    </div>
</div>

@can('viewAny', App\Models\User::class)
<!-- Ringkasan Penjualan & Transaksi -->
<div class="row g-3 mb-4">
    <div class="col-md-6 col-xl-3">
        <div class="card">
            <div class="card-body d-flex align-items-start gap-3">
                <div class="stat-icon" style="background: var(--accent-soft);">
                    <i class="bi bi-cash-stack text-primary"></i>
                </div>
                <div>
                    <span class="text-muted small fw-semibold">TOTAL NILAI PENJUALAN</span>
                    <h4 class="fw-bold mt-1 mb-0">Rp {{ number_format($ringkasan['total_penjualan']) }}</h4>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xl-3">
        <div class="card">
            <div class="card-body d-flex align-items-start gap-3">
                <div class="stat-icon" style="background: #f1f2fb;">
                    <i class="bi bi-receipt-cutoff" style="color:#4b4f6b;"></i>
                </div>
                <div>
                    <span class="text-muted small fw-semibold">JUMLAH TRANSAKSI</span>
                    <h4 class="fw-bold mt-1 mb-0">{{ $ringkasan['total_transaksi'] }}</h4>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xl-3">
        <div class="card">
            <div class="card-body d-flex align-items-start gap-3">
                <div class="stat-icon" style="background: #e9f9ef;">
                    <i class="bi bi-wallet2" style="color: var(--success);"></i>
                </div>
                <div>
                    <span class="text-muted small fw-semibold">PEMBAYARAN TUNAI</span>
                    <h4 class="fw-bold mt-1 mb-0" style="color: var(--success);">Rp {{ number_format($ringkasan['total_cash']) }}</h4>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xl-3">
        <div class="card">
            <div class="card-body d-flex align-items-start gap-3">
                <div class="stat-icon" style="background: #e6f7fb;">
                    <i class="bi bi-qr-code" style="color: var(--info);"></i>
                </div>
                <div>
                    <span class="text-muted small fw-semibold">PEMBAYARAN NON-TUNAI</span>
                    <h4 class="fw-bold mt-1 mb-0" style="color: var(--info);">Rp {{ number_format($ringkasan['total_non_tunai']) }}</h4>
                </div>
            </div>
        </div>
    </div>
</div>
@endcan

<!-- Critical Inventory Status -->
<div class="row g-4 mb-4">
    <div class="col-12">
        <h5 class="fw-bold mb-0" style="color: var(--danger);"><i class="bi bi-exclamation-triangle-fill me-2"></i>Status Stok Kritis</h5>
    </div>

    <!-- Stok Rendah -->
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-white py-3">
                <h6 class="m-0 fw-bold" style="color: var(--warning);">Stok Item Rendah</h6>
            </div>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Nama Produk</th>
                            <th class="text-end">Stok</th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse ($produkStokRendah as $index => $produk)
                        <tr>
                            <td>{{ $produkStokRendah->firstItem() + $index }}</td>
                            <td class="fw-semibold">{{ $produk->nama }}</td>
                            <td class="text-end"><span class="badge bg-warning text-dark">{{ $produk->stok }}</span></td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-muted text-center py-4">
                                <i class="bi bi-check-circle text-success me-1"></i>Seluruh produk dalam kondisi aman.
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
            <div class="card-footer bg-white">
                {{ $produkStokRendah->links() }}
            </div>
        </div>
    </div>

    <!-- Stok Habis -->
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-white py-3">
                <h6 class="m-0 fw-bold" style="color: var(--danger);">Produk Habis Stok</h6>
            </div>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Nama Produk</th>
                            <th class="text-end">Stok</th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse ($produkStokHabis as $index => $produk)
                        <tr>
                            <td>{{ $produkStokHabis->firstItem() + $index }}</td>
                            <td class="fw-semibold">{{ $produk->nama }}</td>
                            <td class="text-end"><span class="badge bg-danger">{{ $produk->stok }}</span></td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-muted text-center py-4">
                                <i class="bi bi-check-circle text-success me-1"></i>Seluruh produk dalam kondisi aman.
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
            <div class="card-footer bg-white">
                {{ $produkStokHabis->links() }}
            </div>
        </div>
    </div>
</div>

<!-- Best Selling Products -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-white py-3">
                <h6 class="m-0 fw-bold text-primary"><i class="bi bi-graph-up-arrow me-2"></i>Produk Terlaris</h6>
            </div>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Nama Produk</th>
                            <th>Stok Tersedia</th>
                            <th>Unit Terjual</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($produkTerlaris as $produk)
                            <tr>
                                <td class="fw-semibold">{{ $produk->nama }}</td>
                                <td>{{ $produk->stok }}</td>
                                <td><span class="badge bg-success">{{ $produk->total_terjual }} Unit</span></td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-muted text-center py-4">
                                    Belum ada data produk terlaris.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
