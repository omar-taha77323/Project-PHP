<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Categorie;

class CategorieSeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'Smartphones',
            'Laptops',
            'Tablets',
            'Smart Watches',
            'Headphones',
            'Bluetooth Speakers',
            'Computer Accessories',
            'Gaming Consoles',
            'Gaming Accessories',
            'Monitors',
            'Keyboards & Mice',
            'Cameras',
            'Drones',
            'Networking Devices',
            'Storage Devices',
            'Power Banks',
            'Chargers & Cables',
            'Smart Home Devices',
            'TV & Home Entertainment',
            'Wearable Technology',
        ];

        foreach ($categories as $name) {
            Categorie::create([
                'name' => $name,
            ]);
        }
    }
}
