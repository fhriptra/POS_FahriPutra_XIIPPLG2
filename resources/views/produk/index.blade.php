@extends('layouts.app')

@section('title', 'Produk')

@section('content')

<div class="card">
    <div class="card-header bg-white py-3 d-flex flex-wrap gap-2 justify-content-between align-items-center">
        <h5 class="m-0 fw-bold"><i class="bi bi-box-seam me-2 text-primary"></i>Daftar Produk</h5>

        @can('create', App\Models\Produk::class)
            <a href="{{ route('produk.create') }}" class="btn btn-primary btn-sm">
                <i class="bi bi-plus-lg me-1"></i> Tambah Produk
            </a>
        @endcan
    </div>

    <div class="card-body pb-0">
        <form action="{{ route('produk.index') }}" method="GET" class="mb-3">
            <div class="input-group">
                <span class="input-group-text bg-white text-muted"><i class="bi bi-search"></i></span>
                <input
                type="text"
                name="search"
                value=""
                class="form-control"
                placeholder="Cari nama produk...">
                <button class="btn btn-outline-secondary" type="submit">
                    Cari
                </button>
            </div>
        </form>
    </div>

    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
          <thead class="table-light">
            <tr>
              <th scope="col">#</th>
              <th scope="col">User</th>
              <th scope="col">Foto</th>
              <th scope="col">Jenis</th>
              <th scope="col">Nama</th>
              <th scope="col">Harga Beli</th>
              <th scope="col">Harga Jual</th>
              <th scope="col">Stok</th>
              <th scope="col" class="text-end">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($products as $product)
            <tr>
                <th scope="row">{{ $products->firstItem() + $loop->index }}</th>
                <td>{{ $product->user->name }}</td>
                <td>
                    <img src="{{ asset('storage/' .$product->foto) }}"
                        width="52" height="52"
                        class="rounded-3 border"
                        style="object-fit:cover;">
                </td>
                <td>{{ $product->jenisProduk->nama ?? '-' }}</td>
                <td class="fw-semibold">{{ $product->nama }}</td>
                <td>Rp {{ number_format($product->harga_beli) }}</td>
                <td>Rp {{ number_format($product->harga_jual) }}</td>
                <td>
                    @if($product->stok <= 0)
                        <span class="badge bg-danger">{{ $product->stok }}</span>
                    @elseif($product->stok <= 5)
                        <span class="badge bg-warning text-dark">{{ $product->stok }}</span>
                    @else
                        <span class="badge bg-light text-dark border">{{ $product->stok }}</span>
                    @endif
                </td>
                <td class="text-end">
                    <div class="d-flex gap-1 justify-content-end">
                        @can('view', $product)
                            <a href="{{ route('produk.show', $product) }}" class="btn btn-sm btn-outline-info">
                                <i class="bi bi-eye"></i>
                            </a>
                        @endcan
                        @can('update', $product)
                            <a href="{{ route('produk.edit', $product) }}" class="btn btn-sm btn-outline-warning">
                                <i class="bi bi-pencil"></i>
                            </a>
                        @endcan
                        @can('delete', $product)
                            <form action="{{ route('produk.destroy', $product) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger" onclick="return confirm('Apakah Anda yakin akan menghapus produk ini?')">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        @endcan
                    </div>
              </td>
            </tr>
                @empty
                <tr>
                    <td colspan="9" class="text-muted text-center py-4">Data tidak tersedia.</td>
                </tr>
            @endforelse
          </tbody>
        </table>
    </div>
    <div class="card-footer bg-white">
        {{ $products->links() }}
    </div>
</div>

@endsection
