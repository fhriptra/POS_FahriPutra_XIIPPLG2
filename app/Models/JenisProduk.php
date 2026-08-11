<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JenisProduk extends Model
{
    use HasFactory;

    protected $table = 'jenis_produk';

    protected $fillable = [
        'nama',
    ];

    public function produk()
    {
        return $this->hasMany(Produk::class, 'jenis_produk_id');
    }
}
