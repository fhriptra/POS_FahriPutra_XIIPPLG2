@extends('layouts.app')

@section('title', 'Tambah User')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card border-0 shadow-sm rounded-3">
            <div class="card-header bg-white py-3">
                <h5 class="m-0 fw-bold">Tambah User Baru</h5>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('admin.users.store') }}" method="post">
                    @include('users._form')
                </form>
            </div>
        </div>
    </div>
</div>

@endsection