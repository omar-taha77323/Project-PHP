<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Categorie;
use App\Models\Product;

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
            ->take(4)
            ->get();

        return view('user.pages.home', compact('categories', 'featuredProducts'));
    }

}
