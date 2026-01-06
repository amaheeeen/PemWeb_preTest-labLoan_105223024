<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Item;
use App\Models\Category;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Buat User Default (Agar bisa langsung Login)
        User::create([
            'name' => 'Farhan Admin',
            'email' => 'admin@labloan.com',
            'password' => Hash::make('password123'), // Password default
        ]);

        // 2. Buat Kategori
        $cat1 = Category::create(['name' => 'Elektronik']);
        $cat2 = Category::create(['name' => 'Alat Ukur']);
        $cat3 = Category::create(['name' => 'Safety Gear']);

        // 3. Buat Barang
        Item::create([
            'category_id' => $cat1->id,
            'name' => 'Arduino Uno R3',
            'stock' => 15,
            'description' => 'Mikrokontroler untuk praktikum IoT dasar.'
        ]);
        
        Item::create([
            'category_id' => $cat2->id,
            'name' => 'Multimeter Digital',
            'stock' => 5,
            'description' => 'Alat ukur tegangan, arus, dan hambatan presisi tinggi.'
        ]);

        Item::create([
            'category_id' => $cat3->id,
            'name' => 'Jas Lab Putih (L)',
            'stock' => 0, // Sengaja 0 buat tes tombol disable
            'description' => 'Pelindung tubuh standar laboratorium kimia.'
        ]);
    }
}