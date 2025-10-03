<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProdukWifi extends Model
{
    protected $table = 'produk_wifi';
    protected $fillable = ['nama_paket', 'kecepatan', 'harga', 'deskripsi'];
}
