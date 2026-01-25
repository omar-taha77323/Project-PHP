<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Categorie;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $categories = Categorie::query()
            ->withCount('products')
            ->orderBy('name')
            ->get();

        $brands = Brand::query()
            ->where('is_visible', 1)
            ->orderBy('name')
            ->get();

        $priceMin = (float) Product::query()->min('price');
        $priceMax = (float) Product::query()->max('price');

        $query = Product::query()
            ->where('is_active', 1)
            ->with(['category', 'brand', 'mainImage']);

        // Search
        if ($request->filled('q')) {
            $q = trim($request->q);
            $query->where(function ($sub) use ($q) {
                $sub->where('name', 'like', "%{$q}%")
                    ->orWhere('sku', 'like', "%{$q}%");
            });
        }

        // Categories filter (multiple)
        $catIds = (array) $request->input('categories', []);
        $catIds = array_values(array_filter($catIds, fn($v) => is_numeric($v)));
        if (!empty($catIds)) {
            $query->whereIn('category_id', $catIds);
        }

        // Brands filter (multiple)
        $brandIds = (array) $request->input('brands', []);
        $brandIds = array_values(array_filter($brandIds, fn($v) => is_numeric($v)));
        if (!empty($brandIds)) {
            $query->whereIn('brand_id', $brandIds);
        }

        // Price range
        if ($request->filled('min_price')) {
            $query->where('price', '>=', (float) $request->min_price);
        }
        if ($request->filled('max_price')) {
            $query->where('price', '<=', (float) $request->max_price);
        }

        // Sort
        $sort = $request->input('sort', 'new');
        if ($sort === 'price_asc') {
            $query->orderByRaw('COALESCE(sale_price, price) asc');
        } elseif ($sort === 'price_desc') {
            $query->orderByRaw('COALESCE(sale_price, price) desc');
        } else {
            $query->latest();
        }

        $products = $query->paginate(9);

        return view('user.products.index', compact(
            'products',
            'categories',
            'brands',
            'priceMin',
            'priceMax'
        ));
    }
    public function show(Product $product)
    {
        $product->load(['images' => function ($q) {
            $q->orderBy('is_main', 'desc')->orderBy('sort_order');
        }, 'mainImage', 'category', 'brand']);

        $related = Product::query()
            ->where('is_active', true)
            ->where('id', '!=', $product->id)
            ->when($product->category_id, fn ($q) => $q->where('category_id', $product->category_id))
            ->with(['mainImage'])
            ->latest()
            ->take(4)
            ->get();

        return view('user.products.show', compact('product', 'related'));
    }
}
