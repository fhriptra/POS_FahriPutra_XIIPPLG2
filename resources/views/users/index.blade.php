@extends('layouts.app')

@section('title', 'Manajemen Users')

@section('content')

<div class="card border-0 shadow-sm rounded-3">
    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
        <h5 class="m-0 fw-bold">Daftar User</h5>
        <a href="{{ route('admin.users.create') }}" class="btn btn-primary btn-sm">
            <i class="bi bi-plus-lg me-1"></i> Tambah User
        </a>

    <form action="{{ route('admin.users') }}" method="GET" class="mb-3">
        <div class="input-group">
            <input 
            type="text"
            name="search"
            value="{{ request('search') }}"
            class="form-control"
            placeholder="Search username or Email"
            >
            <button class="btn btn-outline-secondary" type="submit">
                Search
            </button>
        </div>
    </form>
    </div>
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Email</th>
                    <th scope="col">Role</th>
                    <th scope="col" class="text-end">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td>{{ $users->firstItem() + $loop->index }}</td>
                    <td class="fw-semibold">{{ $user->name }}</td>  
                    <td>{{ $user->email }}</td>
                    <td>
                        <span class="badge bg-info text-dark">
                            {{ ucfirst($user->role->name ?? '-') }}
                        </span>
                    </td>
                    <td class="text-end">
                        <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-sm btn-outline-warning me-1">
                            <i class="bi bi-pencil"></i> Edit
                        </a>
                        <form action="{{ route('admin.users.destroy', $user) }}" method="post" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus user ini?')">
                                <i class="bi bi-trash"></i> Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="card-footer bg-white">
        {{ $users->links() }}
    </div>
</div>

@endsection