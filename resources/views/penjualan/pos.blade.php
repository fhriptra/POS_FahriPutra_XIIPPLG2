@extends('layouts.app')

@section('title', 'POS')

@section('content')

@if(session('errors'))
    <div class="alert alert-danger">
        {{ session('errors') }}
    </div>
@endif

<div class="d-flex align-items-center justify-content-between mb-3">
    <h4 class="fw-bold mb-0">
        <i class="bi bi-cart3 me-2 text-primary"></i>{{ $mode === 'edit' ? 'Edit Penjualan' : 'Tambah Penjualan' }}
    </h4>
    @if($sale->status === 'COMPLETED')
        <span class="badge bg-success">Transaksi Selesai</span>
    @endif
</div>

<div class="row g-3">
    {{-- =================== PRODUK =================== --}}
    <div class="col-md-6">
        <div class="card h-100">
            <div class="card-header bg-white py-3">
                <h6 class="m-0 fw-bold text-muted">PILIH PRODUK</h6>
            </div>
            <div class="card-body" style="max-height:65vh; overflow:auto;">
                <div class="mb-3">
                    <div class="input-group">
                        <span class="input-group-text bg-white text-muted"><i class="bi bi-search"></i></span>
                        <input type="text"
                            id="product-search"
                            name="search"
                            value="{{ request('search') }}"
                            class="form-control"
                            placeholder="Cari produk...">
                    </div>
                </div>

                <div id="product-empty" class="text-muted d-none text-center py-4">Produk tidak ditemukan.</div>

                @foreach($products as $product)
                    <div class="product-item mb-2" data-name="{{ strtolower($product->nama ?? $product->name ?? '-') }}">
                        <form method="POST" action="{{ route('itempenjualan.store') }}" class="row g-2 align-items-center mb-0">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">

                            <div class="col-7">
                                <button class="btn btn-outline-primary w-100 text-start p-2 {{ $sale->status === 'COMPLETED' ? 'disabled' : '' }}">
                                    <div class="d-flex align-items-center gap-2">
                                        {{-- Gambar produk --}}
                                        <img src="{{ asset('storage/' . $product->foto) }}"
                                            alt="Gambar"
                                            class="rounded-circle border"
                                            style="width:42px; height:42px; object-fit:cover;">

                                        {{-- Nama & harga --}}
                                        <div>
                                            <div class="fw-semibold small">{{ $product->nama ?? $product->name ?? '-' }}</div>
                                            <small class="text-muted">Rp {{ number_format($product->harga_jual) }}</small>
                                        </div>
                                    </div>
                                </button>
                            </div>

                            <div class="col-3">
                                <input type="number" name="quantity" value="1" min="1"
                                    onchange="this.form.submit()"
                                    class="form-control form-control-sm {{ $sale->status === 'COMPLETED' ? 'readonly' : '' }}">
                            </div>

                            <div class="col-2">
                                <button type="button"
                                    class="btn btn-primary btn-sm w-100 {{ $sale->status === 'COMPLETED' ? 'disabled' : '' }}"
                                    onclick="const input = this.form.querySelector('input[name=\'quantity\']'); input.value = (parseInt(input.value || 1, 10) + 1); this.form.submit();">
                                    +
                                </button>
                            </div>
                        </form>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- =================== KERANJANG =================== --}}
    <div class="col-md-6">
        <div class="card h-100 d-flex flex-column">
            <div class="card-header bg-white py-3">
                <h6 class="m-0 fw-bold text-muted">KERANJANG</h6>
            </div>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Produk</th>
                            <th>Harga</th>
                            <th>Qty</th>
                            <th>Subtotal</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($sale->itemPenjualan as $item)
                            <tr>
                                <td class="fw-semibold">{{ $item->produk->nama ?? $item->produk->name ?? '-' }}</td>
                                <td>Rp {{ number_format($item->produk->harga_jual) }}</td>
                                <td>
                                    <form method="POST" action="{{ route('itempenjualan.update', $item->id) }}" class="d-flex gap-1">
                                        @csrf
                                        @method('PUT')
                                        <button type="button"
                                            class="btn btn-outline-secondary btn-sm"
                                            onclick="const input = this.form.querySelector('input[name=\'quantity\']'); input.value = (parseInt(input.value || 1, 10) - 1); this.form.submit();">
                                            -
                                        </button>
                                        <input type="number" name="quantity"
                                            value="{{ $item->kuantitas }}"
                                            min="1"
                                            onchange="this.form.submit()"
                                            class="form-control form-control-sm text-center" style="width:56px;">
                                        <button type="button"
                                            class="btn btn-outline-secondary btn-sm"
                                            onclick="const input = this.form.querySelector('input[name=\'quantity\']'); input.value = (parseInt(input.value || 1, 10) + 1); this.form.submit();">
                                            +
                                        </button>
                                    </form>
                                </td>
                                <td class="fw-semibold">Rp {{ number_format($item->subtotal) }}</td>
                                <td>
                                @can('delete', $sale)
                                    <form method="POST" action="{{ route('itempenjualan.destroy', $item->id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-outline-danger btn-sm"><i class="bi bi-trash"></i></button>
                                    </form>
                                @endcan
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted py-4">Belum ada item</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="card-footer bg-white mt-auto">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-muted fw-semibold">Total</span>
                    <span class="fs-5 fw-bold text-primary">Rp {{ number_format($sale->total_pembayaran) }}</span>
                </div>

                <form method="POST" action="{{ route('penjualan.update', $sale->id) }}" onsubmit="return confirm('Yakin ingin checkout?')">
                    @csrf
                    @method('PUT')
                    <select name="payment_method" class="form-select mb-2">
                        <option value="">Pilih Pembayaran</option>
                        <option value="CASH">Cash</option>
                        <option value="QRIS">QRIS</option>
                    </select>

                    <button class="btn btn-success w-100 fw-semibold {{ $sale->status === 'COMPLETED' ? 'disabled' : '' }}">
                        <i class="bi bi-check-circle me-1"></i> Checkout
                    </button>
                </form>
                @can('delete', $sale)
                    <form method="POST" action="{{ route('penjualan.destroy', $sale->id) }}" class="mt-2" onsubmit="return confirm('Yakin ingin membatalkan transaksi?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-outline-danger w-100">Batal Transaksi</button>
                    </form>
                @endcan
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('product-search');
    const productItems = Array.from(document.querySelectorAll('.product-item'));
    const emptyState = document.getElementById('product-empty');

    if (!searchInput || productItems.length === 0) {
        return;
    }

    searchInput.addEventListener('input', function () {
        const query = this.value.trim().toLowerCase();
        let visibleCount = 0;

        productItems.forEach(function (item) {
            const name = (item.getAttribute('data-name') || '').toLowerCase();
            const isMatch = name.includes(query);
            item.style.display = isMatch ? '' : 'none';

            if (isMatch) {
                visibleCount++;
            }
        });

        if (emptyState) {
            emptyState.classList.toggle('d-none', visibleCount > 0);
        }
    });
});
</script>

@endsection
