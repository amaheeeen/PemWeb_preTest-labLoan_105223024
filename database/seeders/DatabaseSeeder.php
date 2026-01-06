<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Item;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Buat User ID 1 (PENTING karena controller pakai User ID 1)
        User::factory()->create([
            'name' => 'Mahasiswa Lab',
            'email' => 'admin@labloan.com',
            'password' => bcrypt('password'), // password dummy
        ]);

        // 2. Buat Barang-barang Lab
        Item::create([
            'name' => 'Mikroskop Digital',
            'description' => 'Mikroskop zoom 1000x',
            'stock' => 5
        ]);

        Item::create([
            'name' => 'Kabel HDMI 5m',
            'description' => 'Kabel display proyektor',
            'stock' => 2
        ]);

        Item::create([
            'name' => 'Laptop ROG (Aset Lab)',
            'description' => 'Khusus rendering',
            'stock' => 1
        ]);
    }
}