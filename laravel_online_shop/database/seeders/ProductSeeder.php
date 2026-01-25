<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Brand;
use App\Models\Categorie;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // لازم يكون عندك Brands + Categories مزروعة قبل هذا seeder
        $brandIds = Brand::pluck('id')->toArray();

        if (empty($brandIds)) {
            // لو ما في براندات، لا تكمل عشان ما يطلع خطأ
            $this->command?->warn('No brands found. Run BrandSeeder first.');
            return;
        }

        $products = [
            ['name' => 'iPhone 15 Pro', 'category' => 'Smartphones', 'price' => 1199],
            ['name' => 'Samsung Galaxy S24', 'category' => 'Smartphones', 'price' => 1099],
            ['name' => 'MacBook Pro 14"', 'category' => 'Laptops', 'price' => 1999],
            ['name' => 'Dell XPS 13', 'category' => 'Laptops', 'price' => 1499],
            ['name' => 'iPad Air 5', 'category' => 'Tablets', 'price' => 699],
            ['name' => 'Apple Watch Series 9', 'category' => 'Smart Watches', 'price' => 399],
            ['name' => 'Samsung Galaxy Watch 6', 'category' => 'Smart Watches', 'price' => 349],
            ['name' => 'Sony WH-1000XM5', 'category' => 'Headphones', 'price' => 379],
            ['name' => 'AirPods Pro 2', 'category' => 'Headphones', 'price' => 249],
            ['name' => 'JBL Flip 6 Speaker', 'category' => 'Bluetooth Speakers', 'price' => 129],
            ['name' => 'Logitech MX Master 3S', 'category' => 'Computer Accessories', 'price' => 99],
            ['name' => 'PlayStation 5', 'category' => 'Gaming Consoles', 'price' => 499],
            ['name' => 'Xbox Series X', 'category' => 'Gaming Consoles', 'price' => 499],
            ['name' => 'Gaming Mechanical Keyboard', 'category' => 'Keyboards & Mice', 'price' => 149],
            ['name' => 'Wireless Gaming Mouse', 'category' => 'Keyboards & Mice', 'price' => 79],
            ['name' => 'LG UltraWide Monitor', 'category' => 'Monitors', 'price' => 599],
            ['name' => 'ASUS 27" Gaming Monitor', 'category' => 'Monitors', 'price' => 429],
            ['name' => 'Canon EOS R10 Camera', 'category' => 'Cameras', 'price' => 979],
            ['name' => 'DJI Mini 3 Drone', 'category' => 'Drones', 'price' => 469],
            ['name' => 'TP-Link WiFi 6 Router', 'category' => 'Networking Devices', 'price' => 199],
            ['name' => 'Samsung 1TB SSD', 'category' => 'Storage Devices', 'price' => 129],
            ['name' => 'Seagate 2TB External HDD', 'category' => 'Storage Devices', 'price' => 89],
            ['name' => 'Anker Power Bank 20000mAh', 'category' => 'Power Banks', 'price' => 59],
            ['name' => 'USB-C Fast Charger 65W', 'category' => 'Chargers & Cables', 'price' => 49],
            ['name' => 'Smart LED Light Bulb', 'category' => 'Smart Home Devices', 'price' => 29],
            ['name' => 'Smart Plug WiFi', 'category' => 'Smart Home Devices', 'price' => 25],
            ['name' => '55" 4K Smart TV', 'category' => 'TV & Home Entertainment', 'price' => 799],
            ['name' => 'Soundbar Home Theater', 'category' => 'TV & Home Entertainment', 'price' => 349],
            ['name' => 'Fitness Tracker Band', 'category' => 'Wearable Technology', 'price' => 99],
            ['name' => 'VR Headset', 'category' => 'Gaming Accessories', 'price' => 399],
        ];

        foreach ($products as $p) {
            // احصل على category_id من اسم القسم
            $categoryId = Categorie::where('name', $p['category'])->value('id');

            // لو القسم غير موجود (مثلاً خطأ إملائي)، خذ أول قسم موجود
            if (!$categoryId) {
                $categoryId = Categorie::query()->value('id');
            }

            $name = $p['name'];

            // SKU مرتب من الاسم
            $skuBase = strtoupper(Str::slug($name, '-'));
            $sku = 'ELEC-' . $skuBase . '-' . rand(100, 999);

            // اختياري: sale_price (إذا عندك العمود)
            $price = (float) $p['price'];
            $salePrice = max(1, $price - rand(10, 120));

            Product::create([
                'name' => $name,
                'description' => 'Latest ' . $name . ' now available in our store.',
                'price' => $price,
                // إذا جدولك فيه sale_price اتركه، إذا ما فيه احذفه
                'sale_price' => $salePrice,

                'brand_id' => $brandIds[array_rand($brandIds)],
                'category_id' => $categoryId,

                'sku' => $sku,
                'stock' => rand(5, 50),
                'is_active' => 1,
            ]);
        }
    }
}
