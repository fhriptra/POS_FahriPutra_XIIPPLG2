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
    <input type="password" name="password" id="myInput"
           placeholder="••••••••"
           class="form-control @error('password') is-invalid @enderror">
    <div class="form-check custom-cool-check">
        <input class="form-check-input" type="checkbox" id="coolCheck1" onclick="myFunction()">
        <label class="form-check-label" for="coolCheck1">
            Show Password
        </label>
    </div>
    @error ('password')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

<script>
    function myFunction() {
  var x = document.getElementById("myInput");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
</script>

<style>
    .custom-cool-check {
    padding-left: 2.5em;
    position: relative;
    }

    .custom-cool-check .form-check-input {
    width: 1.5em;
    height: 1.5em;
    margin-left: -2.5em;
    cursor: pointer;
    border: 2px solid #6c757d;
    border-radius: 6px;
    transition: all 0.2s ease-in-out;
    }

    .custom-cool-check .form-check-input:focus {
    box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
    border-color: #0d6efd;
    }

    .custom-cool-check .form-check-input:checked {
    background-color: #020844; 
    border-color: #d6e9fc;
    transform: scale(1.1); 
    }

    .custom-cool-check .form-check-label {
    cursor: pointer;
    padding-top: 2px;
    user-select: none;
    }
</style>

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
