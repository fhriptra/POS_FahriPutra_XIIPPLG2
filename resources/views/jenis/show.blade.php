@extends('layouts.app')

@section('title', 'Preview Jenis: ' . $jenis->nama)

@section('content')

<div class="card">
    <div class="card-header bg-white py-3 d-flex flex-wrap gap-2 justify-content-between align-items-center">
        <div>
            <h5 class="m-0 fw-bold">
                <i class="bi bi-tags me-2 text-primary"></i>
                Produk dengan Jenis: <span class="text-primary">{{ $jenis->nama }}</span>
            </h5>
            <small class="text-muted">{{ $produkList->total() }} produk memakai jenis ini</small>
        </div>
        <a href="{{ route('jenis.index') }}" class="btn btn-light border btn-sm">
            <i class="bi bi-arrow-left me-1"></i> Kembali
        </a>
    </div>

    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
          <thead class="table-light">
            <tr>
              <th scope="col">#</th>
              <th scope="col">Foto</th>
              <th scope="col">Nama Produk</th>
              <th scope="col">Ditambahkan Oleh</th>
              <th scope="col">Harga Jual</th>
              <th scope="col">Stok</th>
              <th scope="col" class="text-end">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($produkList as $produk)
            <tr>
                <th scope="row">{{ $produkList->firstItem() + $loop->index }}</th>
                <td>
                    <img src="{{ asset('storage/' . $produk->foto) }}"
                        width="48" height="48"
                        class="rounded-3 border"
                        style="object-fit:cover;">
                </td>
                <td class="fw-semibold">{{ $produk->nama }}</td>
                <td>{{ $produk->user->name }}</td>
                <td>Rp {{ number_format($produk->harga_jual, 0, ',', '.') }}</td>
                <td>
                    @if($produk->stok <= 0)
                        <span class="badge bg-danger">{{ $produk->stok }}</span>
                    @elseif($produk->stok <= 5)
                        <span class="badge bg-warning text-dark">{{ $produk->stok }}</span>
                    @else
                        <span class="badge bg-light text-dark border">{{ $produk->stok }}</span>
                    @endif
                </td>
                <td class="text-end">
                    @can('view', $produk)
                        <a href="{{ route('produk.show', $produk) }}" class="btn btn-sm btn-outline-info">
                            <i class="bi bi-eye"></i>
                        </a>
                    @endcan
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="text-muted text-center py-4">
                    Belum ada produk yang memakai jenis ini.
                </td>
            </tr>
            @endforelse
          </tbody>
        </table>
    </div>
    <div class="card-footer bg-white">
        {{ $produkList->links() }}
    </div>
</div>

@endsection
