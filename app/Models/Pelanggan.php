<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    use HasFactory;

    protected $table = 'pelanggan';

    protected $fillable = [
        'user_id',
        'nama_pelanggan',
        'alamat',
        'no_hp',
        'email',
        'group',
        'paket',
        'tanggal_pemasangan',
        'status'
    ];

    public function tagihan()
    {
        return $this->hasMany(Tagihan::class, 'pelanggan_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function produkWifi()
{
    return $this->belongsTo(ProdukWifi::class, 'produk_id');
}

}
