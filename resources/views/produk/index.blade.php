@extends('layouts.app')

@section('title', 'Produk')

@section('content')

<h1>Halaman Produk</h1>

@can('create', App\Models\Produk::class)
    <a href="{{ route('produk.create') }}" method="GET" class="btn btn-primary mb-3">Create</a>
@endcan

<form action="{{ route('produk.index') }}" method="GET" class="mb-3">
    <div class="input-group">
        <input 
        type="text"
        name="search"
        value=""
        class="form-control"
        placeholder="Search Name produk"
        >
        <button class="btn btn-outline-secondary" type="submit">
            Search
        </button>
    </div>
</form>

<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">User</th>
      <th scope="col">Foto</th>
      <th scope="col">Nama</th>
      <th scope="col">Harga Beli</th>
      <th scope="col">Harga Jual</th>
      <th scope="col">Stok</th>
      <th scope="col">Aksi</th>
    </tr>
  </thead>
  <tbody>
    @forelse ($products as $product)
    <tr>
        <th scope="row">{{ $products->firstItem() + $loop->index }}</th>
        <td>{{ $product->user->name }}</td>
        <td>
            <img src="{{ asset('storage/' .$product->foto) }}"
                width="100"
                class="img-thumbnail">
        </td>
        <td>{{ $product->nama }}</td>
        <td>{{ $product->harga_beli }}</td>
        <td>{{ $product->harga_jual }}</td>
        <td>{{ $product->stok }}</td>
        <td class="d-flex gap-1">
            @can('view', $product)
                <a href="{{ route('produk.show', $product) }}" class="btn btn-info">Detail</a>
            @endcan
            ||
            @can('update', $product)
                <a href="{{ route('produk.edit', $product) }}" class="btn btn-warning">Edit</a>
            @endcan
            ||
            @can('delete', $product)
                <form action="{{ route('produk.destroy', $product) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger" onclick="return confirm('Apakah Anda yakin akan menghapus produk ini?')">
                        Hapus
                    </button>
                </form>
            @endcan
      </td>
    </tr>
    @empty
        <tr>
            <td colspan="8">Data tidak tersedia.</td>
        </tr>
    @endforelse
  </tbody>
</table>
{{ $products->links() }}

@endsection