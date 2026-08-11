@extends('layouts.app')

@section('title', 'Detail Produk')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card overflow-hidden">
            @if(!empty($produk->foto))
                <img src="{{ asset('storage/'.$produk->foto) }}" class="card-img-top" style="max-height:320px; object-fit:cover;" alt="{{ $produk->nama }}">
            @endif
            <div class="card-body p-4">
                <h4 class="fw-bold mb-3">{{ $produk->nama }}</h4>

                <ul class="list-group list-group-flush mb-3">
                    <li class="list-group-item d-flex justify-content-between px-0">
                        <span class="text-muted">Ditambahkan oleh</span>
                        <span class="fw-semibold">{{ $produk->user->name }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between px-0">
                        <span class="text-muted">Harga Beli</span>
                        <span class="fw-semibold">Rp {{ number_format($produk->harga_beli, 0, ',', '.') }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between px-0">
                        <span class="text-muted">Harga Jual</span>
                        <span class="fw-semibold text-primary">Rp {{ number_format($produk->harga_jual, 0, ',', '.') }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between px-0">
                        <span class="text-muted">Stok</span>
                        <span class="badge bg-{{ $produk->stok <= 0 ? 'danger' : ($produk->stok <= 5 ? 'warning text-dark' : 'success') }}">{{ $produk->stok }} unit</span>
                    </li>
                </ul>

                <a href="{{ route('produk.index') }}" class="btn btn-light border">
                    <i class="bi bi-arrow-left me-1"></i> Kembali
                </a>
            </div>
        </div>
    </div>
</div>

@endsection
