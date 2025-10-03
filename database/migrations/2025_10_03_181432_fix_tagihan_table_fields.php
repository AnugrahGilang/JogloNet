<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tagihan', function (Blueprint $table) {
            // Hapus kolom produk lama
            if (Schema::hasColumn('tagihan', 'produk')) {
                $table->dropColumn('produk');
            }

            // Ubah nama kolom jumlah_tagihan → jumlah
            if (Schema::hasColumn('tagihan', 'jumlah_tagihan')) {
                $table->renameColumn('jumlah_tagihan', 'jumlah');
            }

            // Ubah nama kolom tanggal_terbit → tanggal_tagihan
            if (Schema::hasColumn('tagihan', 'tanggal_terbit')) {
                $table->renameColumn('tanggal_terbit', 'tanggal_tagihan');
            }
        });
    }

    public function down(): void
    {
        Schema::table('tagihan', function (Blueprint $table) {
            // Kembalikan perubahan
            if (!Schema::hasColumn('tagihan', 'produk')) {
                $table->string('produk')->nullable();
            }

            if (Schema::hasColumn('tagihan', 'jumlah')) {
                $table->renameColumn('jumlah', 'jumlah_tagihan');
            }

            if (Schema::hasColumn('tagihan', 'tanggal_tagihan')) {
                $table->renameColumn('tanggal_tagihan', 'tanggal_terbit');
            }
        });
    }
};
