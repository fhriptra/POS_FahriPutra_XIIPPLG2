<?php

namespace Database\Seeders;

use App\Models\JenisProduk;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JenisProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = [
            'Headset',
            'PC',
            'Laptop',
            'Perkabelan',
            'Keyboard',
            'Mouse',
            'Monitor',
            'Controller',
        ];

        foreach ($items as $item) {
            JenisProduk::create(['nama' => $item]);
        }
    }
}
