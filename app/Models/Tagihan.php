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
        'periode',
        'produk',
        'jumlah_tagihan',
        'status',
        'tanggal_terbit',
        'tanggal_jatuh_tempo',
        'tanggal_pemasangan',
        'status'
    ];

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'pelanggan_id');
    }
}
