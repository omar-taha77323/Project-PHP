<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
  public function run(): void
{
    $products = [
        ['name' => 'iPhone 15 Pro', 'price' => 1200, 'brand_id' => 1, 'category_id' => 1],
        ['name' => 'Samsung Galaxy S24', 'price' => 1000, 'brand_id' => 2, 'category_id' => 1],
        ['name' => 'MacBook Pro M3', 'price' => 2000, 'brand_id' => 1, 'category_id' => 2],
        ['name' => 'Sony PlayStation 5', 'price' => 500, 'brand_id' => 3, 'category_id' => 5],
        ['name' => 'HP Laptop 15', 'price' => 700, 'brand_id' => 4, 'category_id' => 2],
        ['name' => 'Dell Monitor 24"', 'price' => 300, 'brand_id' => 5, 'category_id' => 7],
    ];

    foreach ($products as $p) {
        \App\Models\Product::create([
            'name' => $p['name'],
            'description' => 'أحدث أجهزة ' . $p['name'] . ' متوفر الآن.',
            'price' => $p['price'],
            'brand_id' => $p['brand_id'],
            'category_id' => $p['category_id'],
            'sku' => 'ELEC-' . rand(100, 999),
            'stock' => 10,
            'is_active' => 1
        ]);
    }
}
    }

