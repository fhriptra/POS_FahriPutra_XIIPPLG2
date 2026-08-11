<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('produk', function (Blueprint $table) {
            // only add foreign if column exists and table jenis_produk exists
            if (Schema::hasColumn('produk', 'jenis_produk_id') && Schema::hasTable('jenis_produk')) {
                $table->foreign('jenis_produk_id')->references('id')->on('jenis_produk')->onDelete('set null');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('produk', function (Blueprint $table) {
            if (Schema::hasColumn('produk', 'jenis_produk_id')) {
                $table->dropForeign(['jenis_produk_id']);
            }
        });
    }
};
