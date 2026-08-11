@extends('layouts.app')

@section('title', 'Edit User')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header bg-white py-3">
                <h5 class="m-0 fw-bold"><i class="bi bi-pencil-square me-2 text-warning"></i>Edit User</h5>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('admin.users.update', $user) }}" method="post">
                    @include('users._form')
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
