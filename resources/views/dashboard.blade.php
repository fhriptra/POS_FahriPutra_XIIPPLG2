@extends('layouts.app')

@section('title', 'Dashboard Ringkasan Hari Ini')

@section('content')

<div class="bg-white text-dark p-4 rounded-3 mb-4 shadow-sm">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h3 class="fw-bold mb-1 text-dark">
                <i class="bi bi-speedometer2 me-2 text-primary"></i>Ringkasan Hari Ini
            </h3>
            <p class="text-dark-50 small mb-0">
                <i class="bi bi-calendar-event me-1"></i>{{ $tanggalHariIni->translatedFormat('l, d F Y') }}
            </p>
        </div>
    </div>
</div>

@can('viewAny', App\Models\User::class)
<!-- Ringkasan Penjualan & Transaksi -->
<div class="row g-3 mb-4">
    <div class="col-md-6 col-xl-3">
        <div class="card border-0 shadow-sm rounded-3">
            <div class="card-body">
                <span class="text-muted small fw-semibold">TOTAL NILAI PENJUALAN</span>
                <h3 class="text-primary fw-bold mt-2 mb-0">Rp {{ number_format($ringkasan['total_penjualan']) }}</h3>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xl-3">
        <div class="card border-0 shadow-sm rounded-3">
            <div class="card-body">
                <span class="text-muted small fw-semibold">JUMLAH TRANSAKSI</span>
                <h3 class="text-dark fw-bold mt-2 mb-0">{{ $ringkasan['total_transaksi'] }}</h3>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xl-3">
        <div class="card border-0 shadow-sm rounded-3">
            <div class="card-body">
                <span class="text-muted small fw-semibold">PEMBAYARAN TUNAI</span>
                <h3 class="text-success fw-bold mt-2 mb-0">Rp {{ number_format($ringkasan['total_cash']) }}</h3>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xl-3">
        <div class="card border-0 shadow-sm rounded-3">
            <div class="card-body">
                <span class="text-muted small fw-semibold">PEMBAYARAN NON-TUNAI</span>
                <h3 class="text-info fw-bold mt-2 mb-0">Rp {{ number_format($ringkasan['total_non_tunai']) }}</h3>
            </div>
        </div>
    </div>
</div>
@endcan

<!-- Critical Inventory Status -->
<div class="row g-4 mb-4">
    <div class="col-12">
        <h5 class="fw-bold mb-0 text-danger"><i class="bi bi-exclamation-triangle-fill me-2"></i>Critical Inventory Status</h5>
    </div>
    
    <!-- Stok Rendah -->
    <div class="col-md-6">
        <div class="card border-0 shadow-sm rounded-3">
            <div class="card-header bg-white py-3">
                <h6 class="m-0 fw-bold text-warning">Stok Item Rendah</h6>
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
                            <td colspan="3" class="text-muted text-center py-3">
                                Seluruh produk dalam kondisi aman.
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
        <div class="card border-0 shadow-sm rounded-3">
            <div class="card-header bg-white py-3">
                <h6 class="m-0 fw-bold text-danger">Produk Habis Stok</h6>
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
                            <td colspan="3" class="text-muted text-center py-3">
                                Seluruh produk dalam kondisi aman.
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
        <div class="card border-0 shadow-sm rounded-3">
            <div class="card-header bg-white py-3">
                <h6 class="m-0 fw-bold text-primary"><i class="bi bi-graph-up-arrow me-2"></i>Best Selling Products</h6>
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
                                <td colspan="3" class="text-muted text-center py-3">
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