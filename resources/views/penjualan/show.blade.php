@extends('layouts.app')

@section('title', 'Detail Penjualan #' . ($sale->no_nota ?? $sale->id))

@section('content')



    {{-- Tombol Kembali & Cetak (Sembunyi saat dicetak) --}}
    <div class="d-flex justify-content-between align-items-center mb-4 mt-4 d-print-none">
        <a href="{{ route('penjualan.index') }}" class="btn btn-outline-secondary rounded-3 d-inline-flex align-items-center gap-2">
            <i class="bi bi-arrow-left"></i>
            <span>Kembali ke Penjualan</span>
        </a>

        <div class="d-flex gap-2">
            <button onclick="window.print()" class="btn btn-primary fw-semibold rounded-3 d-inline-flex align-items-center gap-2">
                <i class="bi bi-printer"></i>
                <span>Cetak Struk</span>
            </button>
        </div>
    </div>

    {{-- Container Struk / Transaksi --}}
    <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-7">
            <div class="card border-0 shadow-sm rounded-3 overflow-hidden bg-white">
                
                {{-- Header Card / Nota --}}
                <div class="card-header bg-light border-bottom p-4 text-center">
                    <h4 class="fw-bold text-dark mb-1">STRUK PENJUALAN</h4>
                    <span class="font-monospace text-muted small">No. Nota: #{{ $sale->no_nota ?? $sale->id }}</span>
                    
                    <div class="mt-2">
                        @php
                            $status = strtolower($sale->status ?? 'selesai');
                            $badgeClass = match($status) {
                                'selesai', 'lunas', 'completed' => 'bg-success bg-opacity-10 text-success border border-success',
                                default => 'bg-warning bg-opacity-10 text-warning border border-warning'
                            };
                        @endphp
                        <span class="badge {{ $badgeClass }} fw-bold px-3 py-1.5 rounded-pill text-uppercase">
                            {{ $sale->status ?? 'COMPLETED' }}
                        </span>
                    </div>
                </div>

                {{-- Informasi Transaksi (2 Kolom) --}}
                <div class="card-body p-4">
                    <div class="row g-3 mb-4 pb-3 border-bottom small">
                        <div class="col-6">
                            <span class="text-muted d-block mb-1">Kasir:</span>
                            <span class="fw-bold text-dark d-block">{{ $sale->user->name ?? 'Kasir System' }}</span>
                        </div>
                        <div class="col-6 text-end">
                            <span class="text-muted d-block mb-1">Waktu Transaksi:</span>
                            <span class="fw-semibold text-dark font-monospace d-block">
                                {{ $sale->created_at ? $sale->created_at->translatedFormat('d M Y, H:i') : '-' }}
                            </span>
                        </div>
                    </div>

                    {{-- Tabel Item Penjualan --}}
                    <h6 class="fw-bold text-dark mb-3">Rincian Produk</h6>
                    <div class="table-responsive mb-4">
                        <table class="table table-borderless align-middle mb-0">
                            <thead class="bg-light text-uppercase text-secondary small fw-bold">
                                <tr>
                                    <th class="ps-3" style="width: 50%;">Produk</th>
                                    <th class="text-center">Harga</th>
                                    <th class="text-center">Qty</th>
                                    <th class="text-end pe-3">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($sale->itemPenjualan as $item)
                                    <tr class="border-bottom">
                                        <td class="ps-3">
                                            <div class="fw-semibold text-dark">{{ $item->produk->nama ?? 'Produk Dihapus' }}</div>
                                        </td>
                                        <td class="text-center text-muted small">
                                            Rp {{ number_format($item->produk->harga_jual ?? ($item->subtotal / max($item->kuantitas, 1)), 0, ',', '.') }}
                                        </td>
                                        <td class="text-center fw-semibold">
                                            {{ $item->kuantitas }}
                                        </td>
                                        <td class="text-end pe-3 fw-bold text-dark">
                                            Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center py-4 text-muted">
                                            Tidak ada item pada transaksi ini.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- Summary & Pembayaran --}}
                    <div class="row justify-content-end w-100 m-0">
                            <div class="bg-light rounded-3 p-3 border">
                                
                                <!-- Baris 1: Metode Pembayaran -->
                                <div class="d-flex justify-content-between align-items-center mb-2 small">
                                    <span class="text-muted">Metode Pembayaran:</span>
                                    <span class="fw-bold text-uppercase badge bg-dark text-white px-2 py-1">
                                        {{ $sale->metode_pembayaran ?? $sale->payment_method ?? 'CASH' }}
                                    </span>
                                </div>
                                
                                <hr class="my-2 text-muted opacity-25">

                                <!-- Baris 2: Total Pembayaran (Kiri vs Kanan) -->
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="fw-bold text-dark">Total Pembayaran:</span>
                                    <span class="fs-4 fw-bold text-primary text-end">
                                        Rp {{ number_format($sale->total_pembayaran ?? $sale->total_harga ?? 0, 0, ',', '.') }}
                                    </span>
                                </div>

                            </div>
                    </div>

                {{-- Footer Struk --}}
                <div class="card-footer bg-white border-0 p-4 text-center text-muted small">
                    <p class="mb-1">Terima kasih telah berbelanja!</p>
                    <span class="font-monospace opacity-50">-- Simpan struk ini sebagai bukti pembayaran --</span>
                </div>

            </div>
        </div>
    </div>

    {{-- CSS Khusus untuk Print/Cetak Struk --}}
    <style>
        @media print {
            body {
                background-color: #fff !important;
            }
            .card {
                border: none !important;
                shadow: none !important;
            }
        }
    </style>

@endsection