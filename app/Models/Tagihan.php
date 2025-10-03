<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tagihan extends Model
{
    use HasFactory;

    protected $table = 'tagihan';

    protected $fillable = [
        'pelanggan_id',
        'produk_id',
        'periode',
        'jumlah',
        'status',
        'tanggal_tagihan',
        'tanggal_jatuh_tempo',
    ];



    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'pelanggan_id');
    }

    public function produk() {
        return $this->belongsTo(ProdukWifi::class, 'produk_id');
    }

    public function produkWifi()
{
    return $this->belongsTo(ProdukWifi::class, 'produk_id');
}

}
