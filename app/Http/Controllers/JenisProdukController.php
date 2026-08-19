<?php

namespace App\Http\Controllers;

use App\Http\Requests\JenisProduk\StoreRequest;
use App\Http\Requests\JenisProduk\UpdateRequest;
use App\Http\Requests\SearchRequest;
use App\Models\JenisProduk;
use Illuminate\Http\Request;

class JenisProdukController extends Controller
{
    /**
     * Tampilkan daftar jenis produk.
     */
    public function index(SearchRequest $request)
    {
        $this->authorize('viewAny', JenisProduk::class);

        $keyword = $request->input('search');

        $query = JenisProduk::withCount('produk'); // hitung berapa produk pakai jenis ini

        if ($keyword) {
            $query->where('nama', 'like', '%' . $keyword . '%')->orderBy('nama');
        } else {
            $query->latest();
        }

        $jenisList = $query->paginate(10)->withQueryString();

        return view('jenis.index', compact('jenisList'));
    }

    /**
     * Form tambah jenis baru.
     */
    public function create()
    {
        $this->authorize('create', JenisProduk::class);

        return view('jenis.create');
    }

    /**
     * Simpan jenis baru ke database.
     */
    public function store(StoreRequest $request)
    {
        $this->authorize('create', JenisProduk::class);

        JenisProduk::create($request->validated());

        return redirect()->route('jenis.index')->with('success', 'Jenis produk berhasil ditambahkan.');
    }

    /**
     * Form edit jenis.
     */
    public function edit(JenisProduk $jeni)
    {
        $this->authorize('update', $jeni);

        return view('jenis.edit', ['jenis' => $jeni]);
    }

    /**
     * Update jenis.
     */
    public function update(UpdateRequest $request, JenisProduk $jeni)
    {
        $this->authorize('update', $jeni);

        $jeni->update($request->validated());

        return redirect()->route('jenis.index')->with('success', 'Jenis produk berhasil diperbarui.');
    }

    /**
     * Hapus jenis.
     */
    public function destroy(JenisProduk $jeni)
    {
        $this->authorize('delete', $jeni);

        // Jaga integritas data: jangan hapus jenis yang masih dipakai produk
        if ($jeni->produk()->exists()) {
            return redirect()->route('jenis.index')
                ->with('error', 'Jenis tidak bisa dihapus karena masih dipakai oleh produk.');
        }

        $jeni->delete();

        return redirect()->route('jenis.index')->with('success', 'Jenis produk berhasil dihapus.');
    }

    public function show(JenisProduk $jeni)
    {
        $this->authorize('view', $jeni);

        $produkList = $jeni->produk()
            ->with('user')
            ->latest()
            ->paginate(10);

        return view('jenis.show', [
            'jenis' => $jeni,
            'produkList' => $produkList,
        ]);
    }
}
