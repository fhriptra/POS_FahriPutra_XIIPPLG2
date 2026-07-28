@csrf

<div class="mb-3">
    <label class="form-label fw-semibold">Nama Lengkap</label>
    <input type="text" name="name"
           class="form-control @error('name') is-invalid @enderror"
           placeholder="Masukkan nama"
           value="{{ old('name', $user->name ?? '') }}">
    @error ('name')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

<div class="mb-3">
    <label class="form-label fw-semibold">Alamat Email</label>
    <input type="email" name="email"
           class="form-control @error('email') is-invalid @enderror"
           placeholder="nama@email.com"
           value="{{ old('email', $user->email ?? '' ) }}">
    @error ('email')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

<div class="mb-3">
    <label class="form-label fw-semibold">Password</label>
    <input type="password" name="password"
           placeholder="••••••••"
           class="form-control @error('password') is-invalid @enderror">
    @error ('password')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

<div class="mb-4">
    <label class="form-label fw-semibold">Role User</label>
    <select class="form-select @error('role_id') is-invalid @enderror" name="role_id">
        <option value="">-- Pilih Role --</option>
        @foreach($roles as $role)
            <option value="{{ $role->id }}"
                @selected(old('role_id', $user->role_id ?? '') == $role->id)>
                {{ ucfirst($role->name) }}
            </option>
        @endforeach
    </select>
    @error ('role_id')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

<div class="d-flex gap-2">
    <button class="btn btn-primary"><i class="bi bi-save me-1"></i> Simpan Data</button>
    <a href="{{ route('admin.users') }}" class="btn btn-light border">Batal</a>
</div>