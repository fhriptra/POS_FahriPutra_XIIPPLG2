@extends('layouts.app')

@section('title', 'POS')

@section('content')

<h4 class="mb-3">
    Tambah dan Edit
</h4>

<div class="row">

{{-- =================== PRODUK =================== --}}
<div class="col-md-6">
    <div class="card">
        <div class="card-body" style="max-height:70vh; overflow:auto">
            <div class="mb-3">
                <form method="" action="">
                    <input type="text"
                        name="search"
                        value="{{ request('search') }}"
                        class="form-control"
                        placeholder="Cari produk..."
                        onkeyup="this.form.submit()">
                </form>
            </div>
            <form method="" action="" class="row mb-2">
                @csrf
                <input type="hidden" name="product_id" value="">

                <div class="col-7">
                    <button class="btn btn-outline-primary w-100 text-start p-2">
                        <div class="d-flex align-items-center gap-2">

                            {{-- Gambar produk --}}
                            <img src=""
                                alt="Gambar"
                                class="rounded-circle"
                                style="width:45px; height:45px; object-fit:cover;">

                            {{-- Nama & harga --}}
                            <div>
                                <div class="fw-semibold">Coki-Coki</div>
                                <small class="text-muted">Rp 20.000</small>
                            </div>

                        </div>
                    </button>
                </div>

                <div class="col-3">
                            <input type="number" name="quantity" value="1" min="1"
                                class="form-control">
                        </div>

                        <div class="col-2">
                            <button class="btn btn-primary w-100">+</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- =================== KERANJANG =================== --}}
        <div class="col-md-6">
            <div class="card">
                <table class="table table-bordered mb-0">
                    <thead>
                        <tr>
                            <th>Produk</th>
                            <th>Qty</th>
                            <th>Subtotal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>coki-coki</td>
                            <td>
                                <form method="" action="">
                                    @csrf @method('PUT')
                                    <input type="number" name="quantity"
                                        value=""
                                        class="form-control form-control-sm">
                                </form>
                            </td>
                            <td>Rp 20.000</td>
                            <td>
                                <form method="" action="">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-danger btn-sm">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <div class="card-footer">
                    <strong>Total: Rp. 20.000</strong>

                    <form method="" action="" class="mt-2">
                        @csrf
                        <select name="payment_method" class="form-select mb-2">
                            <option value="">Pilih Pembayaran</option>
                            <option value="CASH">Cash</option>
                            <option value="QRIS">QRIS</option>
                        </select>

                        <button class="btn btn-success w-100">
                            Checkout
                        </button>
                    </form>
                    <form method=""
                        action=""
                        class="mt-2">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-outline-danger w-100">
                            Batal Transaksi
                        </button>
                    </form>
                </div>
            </div>
        </div>

        </div>
        @endsection