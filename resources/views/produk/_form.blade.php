@csrf

<div class="row g-4">
    <div class="col-md-5">
        @if (!empty($produk->foto))
            <label class="form-label fw-semibold small text-muted">Foto saat ini</label>
            <div class="mb-3">
                <img src="{{ asset('storage/' . $produk->foto) }}"
                    class="rounded-3 border w-100"
                    style="max-width:220px; object-fit:cover;">
            </div>
        @endif

        <label class="form-label fw-semibold small text-muted">Preview Foto</label>
        <div>
            <img id="preview" class="rounded-3 border mt-1" style="display:none; max-width:220px; object-fit:cover;">
        </div>
    </div>

    <div class="col-md-7">
        <div class="mb-3">
            <label class="form-label fw-semibold">Gambar Produk</label>
            <input type="file" name="foto" accept="image/*" onchange="previewImage(this)" class="form-control @error('foto') is-invalid @enderror">
            @error('foto')
                <div class="invalid-feedback d-block">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold">Nama Produk</label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Contoh: Kaset Elden Ring PS5" value="{{ old('name', $produk->nama ?? '') }}">
            @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label fw-semibold">Harga Beli</label>
                <div class="input-group">
                    <span class="input-group-text">Rp</span>
                    <input type="number" name="purchase_price" class="form-control @error('purchase_price') is-invalid @enderror" value="{{ old('purchase_price', $produk->harga_beli ?? '') }}">
                </div>
                @error('purchase_price')
                    <div class="invalid-feedback d-block">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label fw-semibold">Harga Jual</label>
                <div class="input-group">
                    <span class="input-group-text">Rp</span>
                    <input type="number" name="selling_price" class="form-control @error('selling_price') is-invalid @enderror" value="{{ old('selling_price', $produk->harga_jual ?? '') }}">
                </div>
                @error('selling_price')
                    <div class="invalid-feedback d-block">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold">Jenis Produk</label>
            <select name="jenis_produk_id" class="form-select @error('jenis_produk_id') is-invalid @enderror">
                <option value="">Pilih Jenis</option>
                @foreach(($jenis ?? []) as $j)
                    <option value="{{ $j->id }}" {{ old('jenis_produk_id', $produk->jenis_produk_id ?? '') == $j->id ? 'selected' : '' }}>{{ $j->nama }}</option>
                @endforeach
            </select>
            @error('jenis_produk_id')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4">
            <label class="form-label fw-semibold">Stok</label>
            <input type="number" name="stock" class="form-control @error('stock') is-invalid @enderror" value="{{ old('stock', $produk->stok ?? '') }}">
            @error('stock')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="d-flex gap-2">
            <button class="btn btn-primary" type="submit"><i class="bi bi-save me-1"></i> Simpan</button>
            <a href="{{ route('produk.index') }}" class="btn btn-light border">Kembali</a>
        </div>
    </div>
</div>

<script>
    function previewImage(input) {
        const preview = document.getElementById('preview');
        const file = input.files[0];

        if (file) {
            preview.src = URL.createObjectURL(file);
            preview.style.display = 'block';
        }
    }
</script>
