<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Categorie;
use App\Models\Product;
use App\Models\Brand;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Categorie::query()
            ->withCount('products')
            ->orderBy('name')
            ->take(8)
            ->get();

        $featuredProducts = Product::query()
            ->where('is_active', 1)
            ->with(['mainImage', 'brand'])
            ->latest()
            ->take(8)
            ->get();

        $brands = Brand::query()->where('is_visible', 1)->get();

        return view('user.pages.home', compact('categories', 'featuredProducts', 'brands'));
    }

    public function brands()
    {
        $brands = Brand::query()->where('is_active', 1)->get();

        return view('user.pages.brands', compact('brands'));
    }
}
