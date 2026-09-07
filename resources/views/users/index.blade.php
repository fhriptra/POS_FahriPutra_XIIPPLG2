@extends('layouts.app')

@section('title', 'Manajemen Users')

@section('content')

<div class="card">
    <div class="card-header bg-white py-3 d-flex flex-wrap gap-2 justify-content-between align-items-center">
        <h5 class="m-0 fw-bold"><i class="bi bi-people me-2 text-primary"></i>Daftar User</h5>
        <a href="{{ route('admin.users.create') }}" class="btn btn-primary btn-sm">
            <i class="bi bi-plus-lg me-1"></i> Tambah User
        </a>
    </div>

    <div class="card-body pb-0">
        <form action="{{ route('admin.users') }}" method="GET" class="mb-3">
            <div class="input-group">
                <span class="input-group-text bg-white text-muted"><i class="bi bi-search"></i></span>
                <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                class="form-control"
                placeholder="Cari username atau email">
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
                        <span class="badge bg-light text-dark border">
                            {{ ucfirst($user->role->name ?? '-') }}
                        </span>
                    </td>
                    <td class="text-end">
                            <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-sm btn-outline-warning">
                                <i class="bi bi-pencil"></i>
                            </a>
                        <form action="{{ route('admin.users.destroy', $user) }}" method="post" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger" onclick="return confirm('Apakah Anda yakin akan menghapus user ini?')">
                                <i class="bi bi-trash"></i>
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
