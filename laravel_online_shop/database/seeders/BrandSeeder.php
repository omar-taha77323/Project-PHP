<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
{
    $brands = [
        ['name' => 'Apple', 'slug' => 'apple'],
        ['name' => 'Samsung', 'slug' => 'samsung'],
        ['name' => 'Sony', 'slug' => 'sony'],
        ['name' => 'HP', 'slug' => 'hp'],
        ['name' => 'Dell', 'slug' => 'dell'],
        ['name' => 'Xiaomi', 'slug' => 'xiaomi'],
    ];

    foreach ($brands as $brand) {
        \App\Models\Brand::create($brand);

    }
}
}
