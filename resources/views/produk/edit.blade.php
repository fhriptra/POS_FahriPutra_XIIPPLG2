@extends('layouts.app')

@section('title', 'Edit Produk')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-9">
        <div class="card">
            <div class="card-header bg-white py-3">
                <h5 class="m-0 fw-bold"><i class="bi bi-pencil-square me-2 text-warning"></i>Edit Produk</h5>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('produk.update', $produk) }}"
                    method="POST"
                    enctype="multipart/form-data">
                    @method('PUT')
                    @include('Produk._form')
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
