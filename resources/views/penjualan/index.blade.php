@extends('layouts.app')

@section('title', 'Penjualan')

@section('content')

@if(session('errors'))
    <div class="alert alert-danger">
        {{ session('errors') }}
    </div>
@endif

<div class="card">
    <div class="card-header bg-white py-3 d-flex flex-wrap gap-2 justify-content-between align-items-center">
        <h5 class="m-0 fw-bold"><i class="bi bi-receipt me-2 text-primary"></i>Daftar Penjualan</h5>
        <a href="{{ route('penjualan.create') }}" class="btn btn-primary btn-sm">
            <i class="bi bi-plus-lg me-1"></i> Transaksi Baru
        </a>
    </div>

    <div class="card-body pb-0">
        <form action="{{ route('penjualan.index') }}" method="GET" class="mb-3">
            <div class="input-group">
                <span class="input-group-text bg-white text-muted"><i class="bi bi-search"></i></span>
                <input
                    type="text"
                    name="search"
                    value="{{ request()->search }}"
                    class="form-control"
                    placeholder="Cari penjualan...">
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
                    <th scope="col">Tanggal Transaksi</th>
                    <th scope="col">Kasir</th>
                    <th scope="col">Total Pembayaran</th>
                    <th scope="col">Metode Pembayaran</th>
                    <th scope="col">Status</th>
                    <th scope="col" class="text-end">Aksi</th>
                </tr>
            </thead>
            <tbody>
            @forelse($sales as $sale)
                <tr>
                    <th scope="row">{{ $sales->firstItem() + $loop->index }}</th>
                    <td>{{ $sale->created_at->translatedFormat('d-m-y H:i:s') }}</td>
                    <td>{{ $sale->user->name }}</td>
                    <td class="fw-semibold">Rp {{ number_format($sale->total_pembayaran) }}</td>
                    <td>
                        @if($sale->metode_pembayaran)
                            <span class="badge bg-light text-dark border">{{ $sale->metode_pembayaran }}</span>
                        @else
                            <span class="text-muted">-</span>
                        @endif
                    </td>
                    <td>
                        @if($sale->status === 'COMPLETED')
                            <span class="badge bg-success">Selesai</span>
                        @else
                            <span class="badge bg-secondary">{{ $sale->status }}</span>
                        @endif
                    </td>
                    <td class="text-end">
                        <div class="d-flex gap-1 justify-content-end">
                            <a href="{{ route('penjualan.show', $sale) }}" class="btn btn-sm btn-outline-primary">Detail</a>
                            @can('view', $sale)
                                <a href="{{ route('penjualan.edit', $sale) }}" class="btn btn-sm btn-outline-warning">Edit</a>
                            @endcan
                            @can('delete', $sale)
                                <form action="{{ route('penjualan.destroy', $sale) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger" onclick="return confirm('Apakah anda yakin akan menghapus penjualan ini?')">
                                        Hapus
                                    </button>
                                </form>
                            @endcan
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-muted text-center py-4">Data tidak ditemukan.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
