<?php

namespace App\Services;

use App\Models\Produk;

class MonitoringStokService
{
    /**
     * Create a new class instance.
     */
    public function produkStokRendah(int $batas = 5, int $perpage = 5)
    {
        return Produk::where('stok', '>', 0)
            ->where('stok', '<=', $batas)
            ->orderBy('stok', 'asc')
            ->paginate($perpage, ['*'], 'stok_rendah_page');
    }

    public function produkStokHabis(int $perpage = 5)
    {
        return Produk::where('stok', '=', 0)
            ->orderBy('nama')
            ->paginate($perpage, ['*'], 'stok_habis_page');
    }
}
