<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
   public function run(): void
{
    $categories = [
        ['name' => 'الهواتف الذكية'],
        ['name' => 'أجهزة اللابتوب'],
        ['name' => 'الساعات الذكية'],
        ['name' => 'السماعات والملحقات'],
        ['name' => 'الألعاب والكونسول'],
        ['name' => 'كاميرات ديجيتال'],
        ['name' => 'شاشات ومنصات عرض'],
        ['name' => 'أجهزة التابلت'],
    ];

    foreach ($categories as $cat) {
        \App\Models\Categorie::create($cat); // حذفنا الـ slug لأنه غير موجود في جدولك
    }
}
    }

