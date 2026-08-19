@extends('layouts.app')

@section('title', 'Tambah Jenis Produk')

@section('content')
<div class="card">
    <div class="card-header bg-white py-3">
        <h5 class="m-0 fw-bold"><i class="bi bi-tag me-2 text-primary"></i>Tambah Jenis Produk</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('jenis.store') }}" method="POST">
            @include('jenis._form')
        </form>
    </div>
</div>
@endsection
