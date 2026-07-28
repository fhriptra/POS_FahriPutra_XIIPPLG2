@csrf

@if (!empty($produk->foto))
    <div class="mb-2">
        <label>Foto saat ini</label><br>
        <img src="{{ asset('storage/' . $produk->foto) }}"
            width="150"
            class="img-thumbnail">
    </div>
@endif
<div class="row">
    <div class="col">
        <div>
            <label>Gambar</label>
            <input type="file" name="foto" accept="image/*" onchange="previewImage(this)" class="form-control @error('foto') is-invalid @enderror">
            @error('foto')
                <div class="invalid-feedback d-block">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>
    <div class="col">
        <div class="mb-2">
            <label>Preview Foto</label><br>
            <img id="preview" class="img-thumbnail mt-2" style="display:none" width="150">
        </div>
    </div>
</div>

<div>
    <label>Nama Produk</label><br>
    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $produk->nama ?? '') }}">
    @error('name')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

<div>
    <label>Harga Beli</label><br>
    <input type="number" name="purchase_price" class="form-control @error('purchase_price') is-invalid @enderror" value="{{ old('purchase_price', $produk->harga_beli ?? '') }}">
    @error('purchase_price')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

<div>
    <label>Harga Jual</label><br>
    <input type="number" name="selling_price" class="form-control @error('selling_price') is-invalid @enderror" value="{{ old('selling_price', $produk->harga_jual ?? '') }}">
    @error('selling_price')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

<div>
    <label>Stok</label><br>
    <input type="number" name="stock" class="form-control @error('stock') is-invalid @enderror" value="{{ old('stock', $produk->stok ?? '') }}">
    @error('stock')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

<button class="btn btn-success mt-3" type="submit">Simpan</button>

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

<a href="{{ route('produk.index') }}" class="btn btn-secondary mt-3">Kembali</a>