<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProdukWifi;

class HomepageController extends Controller
{
    public function index()
    {
        $produkList = ProdukWifi::all(); // ambil semua produk dari database
        return view('welcome', compact('produkList'));
    }
}
