<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Admin::create([
            'name' => 'Anugrah',
            'email' => 'anugrah@gmail.com',
            'password' => Hash::make('superpass123'),
            'role' => 'superadmin',
        ]);

        Admin::create([
            'name' => 'gilang',
            'email' => 'gilang@gmail.com',
            'password' => Hash::make('pass123'),
            'role' => 'admin',
        ]);
    }
}
