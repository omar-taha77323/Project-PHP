<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Categorie;
use App\Models\Product;

class CategoryController extends Controller
{
    // (اختياري) لو صفحة الأقسام جاهزة لاحقًا
    public function index()
    {
        $categories = Categorie::query()
            ->withCount('products')
            ->orderBy('name')
            ->paginate(12);

        return view('user.categories.index', compact('categories'));
    }

    public function show(Request $request, Categorie $category)
    {
        $sort = $request->get('sort', 'newest');

        $productsQuery = Product::query()
            ->where('category_id', $category->id);

        // Sorting (اختياري)
        if ($sort === 'price_asc') {
            $productsQuery->orderBy('price', 'asc');
        } elseif ($sort === 'price_desc') {
            $productsQuery->orderBy('price', 'desc');
        } elseif ($sort === 'popular') {
            // عدّلها حسب مشروعك لو عندك عمود views/sales
            $productsQuery->orderBy('created_at', 'desc');
        } else {
            // newest
            $productsQuery->latest();
        }

        $products = $productsQuery->paginate(8);


        return view('user.categories.show', compact('category', 'products', 'sort'));
    }
}
