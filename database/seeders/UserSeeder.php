<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'pelanggan01',
            'email' => 'pelanggan01@gmail.com',
            'password' => Hash::make('pelanggan01'), // default password
        ]);

        User::create([
            'name' => 'pelanggan02',
            'email' => 'pelanggan02@gmail.com',
            'password' => Hash::make('pelanggan02'),
        ]);
    }
}
