@extends('layouts.app')

@section('title', 'Tambah Produk')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-9">
        <div class="card">
            <div class="card-header bg-white py-3">
                <h5 class="m-0 fw-bold"><i class="bi bi-plus-circle me-2 text-primary"></i>Tambah Produk</h5>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('produk.store') }}" method="post" enctype="multipart/form-data">
                    @include('Produk._form')
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
