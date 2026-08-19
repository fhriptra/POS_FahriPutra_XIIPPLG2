@extends('layouts.app')

@section('title', 'Jenis Produk')

@section('content')

<div class="card">
    <div class="card-header bg-white py-3 d-flex flex-wrap gap-2 justify-content-between align-items-center">
        <h5 class="m-0 fw-bold"><i class="bi bi-tags me-2 text-primary"></i>Jenis Produk</h5>

        @can('create', App\Models\JenisProduk::class)
            <a href="{{ route('jenis.create') }}" class="btn btn-primary btn-sm">
                <i class="bi bi-plus-lg me-1"></i> Tambah Jenis
            </a>
        @endcan
    </div>

    <div class="card-body pb-0">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <form action="{{ route('jenis.index') }}" method="GET" class="mb-3">
            <div class="input-group">
                <span class="input-group-text bg-white text-muted"><i class="bi bi-search"></i></span>
                <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Cari nama jenis...">
                <button class="btn btn-outline-secondary" type="submit">Cari</button>
            </div>
        </form>
    </div>

    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
          <thead class="table-light">
            <tr>
              <th scope="col">#</th>
              <th scope="col">Nama Jenis</th>
              <th scope="col">Jumlah Produk</th>
              <th scope="col" class="text-end">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($jenisList as $jenis)
            <tr>
                <th scope="row">{{ $jenisList->firstItem() + $loop->index }}</th>
                <td class="fw-semibold">{{ $jenis->nama }}</td>
                <td>
                    <a href="{{ route('jenis.show', $jenis) }}" class="badge bg-light text-dark border text-decoration-none">
                        {{ $jenis->produk_count }} produk
                    </a>
                </td>
                <td class="text-end">
                    <div class="d-flex gap-1 justify-content-end">
                        @can('view', $jenis)
                            <a href="{{ route('jenis.show', $jenis) }}" class="btn btn-sm btn-outline-info" title="Lihat produk">
                                <i class="bi bi-eye"></i>
                            </a>
                        @endcan
                        @can('update', $jenis)
                            <a href="{{ route('jenis.edit', $jenis) }}" class="btn btn-sm btn-outline-warning">
                                <i class="bi bi-pencil"></i>
                            </a>
                        @endcan
                        @can('delete', $jenis)
                            <form action="{{ route('jenis.destroy', $jenis) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger" onclick="return confirm('Apakah Anda yakin akan menghapus jenis ini?')">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        @endcan
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="text-muted text-center py-4">Belum ada jenis produk.</td>
            </tr>
            @endforelse
          </tbody>
        </table>
    </div>
    <div class="card-footer bg-white">
        {{ $jenisList->links() }}
    </div>
</div>

@endsection
