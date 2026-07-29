@extends('layouts.app')

@section('title', 'Detail Produk')

@section('content')

<h1>Detail Produk</h1>

<div class="card" style="max-width: 500px;">
    @if(!empty($produk->foto))
        <img src="{{ asset('storage/'.$produk->foto) }}" class="card-img-top" alt="{{ $produk->nama }}">
    @endif
    <div class="card-body">
        <h5 class="card-title">{{ $produk->nama }}</h5>
        <p class="card-text mb-1"><strong>User:</strong> {{ $produk->user->name }}</p>
        <p class="card-text mb-1"><strong>Harga Beli:</strong> Rp {{ number_format($produk->harga_beli, 0, ',', '.') }}</p>
        <p class="card-text mb-1"><strong>Harga Jual:</strong> Rp {{ number_format($produk->harga_jual, 0, ',', '.') }}</p>
        <p class="card-text mb-3"><strong>Stok:</strong> {{ $produk->stok }}</p>

        <a href="{{ route('produk.index') }}" class="btn btn-secondary">Kembali</a>
    </div>
</div>

@endsection