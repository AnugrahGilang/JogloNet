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
            'password' => Hash::make('superpassAnugrahG'),
            'role' => 'superadmin',
        ]);

        Admin::create([
            'name' => 'masendot',
            'email' => 'endot@gmail.com',
            'password' => Hash::make('passEndot'),
            'role' => 'admin',
        ]);
    }
}
