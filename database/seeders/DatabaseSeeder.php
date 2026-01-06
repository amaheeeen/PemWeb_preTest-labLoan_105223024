<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Item;
use App\Models\Category;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Mahasiswa Lab',
            'email' => 'admin@labloan.com',
            'password' => bcrypt('password'),
        ]);

        $catElektronik = Category::create(['name' => 'Elektronik']);
        $catKimia = Category::create(['name' => 'Bahan Kimia']);
        $catFurniture = Category::create(['name' => 'Perabot']);

        Item::create([
            'category_id' => $catElektronik->id, // Masukkan ke Elektronik
            'name' => 'Mikroskop Digital',
            'description' => 'Zoom 1000x',
            'stock' => 5
        ]);

        Item::create([
            'category_id' => $catElektronik->id, // Masukkan ke Elektronik
            'name' => 'Laptop ROG',
            'description' => 'Aset Lab Multimedia',
            'stock' => 1
        ]);

        Item::create([
            'category_id' => $catKimia->id, // Masukkan ke Kimia
            'name' => 'Gelas Ukur',
            'description' => 'Ukuran 500ml',
            'stock' => 10
        ]);
    }
}