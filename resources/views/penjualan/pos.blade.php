@extends('layouts.app')

@section('title', 'POS')

@section('content')

@if(session('errors'))
    <div class="alert alert-danger">
        {{ session('errors') }}
    </div>
@endif

<h4 class="mb-3">
    {{ $mode === 'edit' ? 'Edit Penjualan' : 'Tambah Penjualan' }}
</h4>

<div class="row">
    {{-- =================== PRODUK =================== --}}
    <div class="col-md-6">
        <div class="card">
            <div class="card-body" style="max-height:70vh; overflow:auto">
                <div class="mb-3">
                    <input type="text"
                        id="product-search"
                        name="search"
                        value="{{ request('search') }}"
                        class="form-control"
                        placeholder="Cari produk...">
                </div>

                <div id="product-empty" class="text-muted d-none">Produk tidak ditemukan.</div>

                @foreach($products as $product)
                    <div class="product-item mb-2" data-name="{{ strtolower($product->nama ?? $product->name ?? '-') }}">
                        <form method="POST" action="{{ route('itempenjualan.store') }}" class="row mb-0">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">

                            <div class="col-7">
                                <button class="btn btn-outline-primary w-100 text-start p-2 {{ $sale->status === 'COMPLETED' ? 'disabled' : '' }}">
                                    <div class="d-flex align-items-center gap-2">
                                        {{-- Gambar produk --}}
                                        <img src="{{ asset('storage/' . $product->foto) }}"
                                            alt="Gambar"
                                            class="rounded-circle"
                                            style="width:45px; height:45px; object-fit:cover;">

                                        {{-- Nama & harga --}}
                                        <div>
                                            <div class="fw-semibold">{{ $product->nama ?? $product->name ?? '-' }}</div>
                                            <small class="text-muted">{{ number_format($product->harga_jual) }}</small>
                                        </div>
                                    </div>
                                </button>
                            </div>

                            <div class="col-3">
                                <input type="number" name="quantity" value="1" min="1"
                                    onchange="this.form.submit()"
                                    class="form-control {{ $sale->status === 'COMPLETED' ? 'readonly' : '' }}">
                            </div>

                            <div class="col-2">
                                <button type="button"
                                    class="btn btn-primary w-100 {{ $sale->status === 'COMPLETED' ? 'disabled' : '' }}"
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
        <div class="card">
            <table class="table table-bordered mb-0">
                <thead>
                    <tr>
                        <th>Produk</th>
                        <th>Harga</th>
                        <th>Qty</th>
                        <th>Subtotal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($sale->itemPenjualan as $item)
                        <tr>
                            <td>{{ $item->produk->nama ?? $item->produk->name ?? '-' }}</td>
                            <td>Rp.{{ number_format($item->produk->harga_jual) }}</td>
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
                                        class="form-control form-control-sm">
                                    <button type="button"
                                        class="btn btn-outline-secondary btn-sm"
                                        onclick="const input = this.form.querySelector('input[name=\'quantity\']'); input.value = (parseInt(input.value || 1, 10) + 1); this.form.submit();">
                                        +
                                    </button>
                                </form>
                            </td>
                            <td>Rp {{ number_format($item->subtotal) }}</td>
                            <td>
                            @can('delete', $sale)
                                <form method="POST" action="{{ route('itempenjualan.destroy', $item->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm">Hapus</button>
                                </form>
                            @endcan
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted">Belum ada item</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="card-footer">
                <strong>Total: Rp. {{ number_format($sale->total_pembayaran) }}</strong>

                <form method="POST" action="{{ route('penjualan.update', $sale->id) }}" class="mt-2" onsubmit="return confirm('Yakin ingin checkout?')">
                    @csrf
                    @method('PUT')
                    <select name="payment_method" class="form-select mb-2">
                        <option value="">Pilih Pembayaran</option>
                        <option value="CASH">Cash</option>
                        <option value="QRIS">QRIS</option>
                    </select>

                    <button class="btn btn-success w-100 {{ $sale->status === 'COMPLETED' ? 'disabled' : '' }}">Checkout</button>
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