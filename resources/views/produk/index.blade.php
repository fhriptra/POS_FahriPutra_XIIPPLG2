@extends('layouts.app')

@section('title', 'Produk')

@section('content')

<h1>Halaman Produk</h1>

<a href="{{ route('admin.produk.create') }}" method="GET" class="btn btn-primary mb-3">create</a>

<form action="{{ route('admin.produk.index') }}" method="GET" class="mb-3">
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
            <a href="{{ route('admin.produk.edit', $product) }}" class="btn btn-warning">Edit</a>
            ||
            <form action="" method="" class="d-inline">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger" onclick="return confirm('Apakah Anda yakin akan menghapus produk ini?')">
                    Hapus
                </button>
            </form>
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