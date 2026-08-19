@csrf

<div class="mb-4">
    <label class="form-label fw-semibold">Nama Jenis</label>
    <input type="text" name="nama"
           class="form-control @error('nama') is-invalid @enderror"
           placeholder="Contoh: Konsol, Aksesoris, Voucher"
           value="{{ old('nama', $jenis->nama ?? '') }}">
    @error('nama')
        <div class="invalid-feedback d-block">{{ $message }}</div>
    @enderror
</div>

<div class="d-flex gap-2">
    <button class="btn btn-primary" type="submit"><i class="bi bi-save me-1"></i> Simpan</button>
    <a href="{{ route('jenis.index') }}" class="btn btn-light border">Kembali</a>
</div>
