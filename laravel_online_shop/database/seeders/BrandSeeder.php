<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Brand;

class BrandSeeder extends Seeder
{
    public function run(): void
    {
        $brands = [
            'Apple',
            'Samsung',
            'Sony',
            'Dell',
            'Logitech',
        ];

        foreach ($brands as $name) {
            Brand::create([
                'name' => $name,
            ]);
        }
    }
}
