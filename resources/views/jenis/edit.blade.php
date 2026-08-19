@extends('layouts.app')

@section('title', 'Edit Jenis Produk')

@section('content')
<div class="card">
    <div class="card-header bg-white py-3">
        <h5 class="m-0 fw-bold"><i class="bi bi-tag me-2 text-primary"></i>Edit Jenis Produk</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('jenis.update', $jenis) }}" method="POST">
            @method('PUT')
            @include('jenis._form')
        </form>
    </div>
</div>
@endsection
