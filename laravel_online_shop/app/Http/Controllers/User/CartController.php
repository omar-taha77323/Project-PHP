<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = session('cart', []);

        $subtotal = collect($cart)->sum(function ($item) {
            return ((float) $item['price']) * ((int) $item['qty']);
        });

        $tax = 0;
        $shipping = null; // محسوب لاحقاً
        $total = $subtotal + $tax;

        return view('user.cart.index', compact('cart', 'subtotal', 'tax', 'shipping', 'total'));
    }

    public function add(Product $product)
    {
        $cart = session('cart', []);

        $id = (string) $product->id;
        $price = $product->sale_price ?? $product->price;

        if (!isset($cart[$id])) {
            $cart[$id] = [
                'product_id' => $product->id,
                'name'       => $product->name,
                'price'      => (float) $price,
                'qty'        => 1,
                'image'      => optional($product->mainImage)->path,
            ];
        } else {
            $cart[$id]['qty'] = (int) $cart[$id]['qty'] + 1;
        }

        session(['cart' => $cart]);

        return back()->with('success', 'Added to cart');
    }

    // اختياري (لأزرار + و -)
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'qty' => ['required', 'integer', 'min:1', 'max:99'],
        ]);

        $cart = session('cart', []);
        $id = (string) $product->id;

        if (isset($cart[$id])) {
            $cart[$id]['qty'] = (int) $request->qty;
            session(['cart' => $cart]);
        }

        return back();
    }

    // اختياري (زر delete)
    public function remove(Product $product)
    {
        $cart = session('cart', []);
        $id = (string) $product->id;

        unset($cart[$id]);
        session(['cart' => $cart]);

        return back();
    }
}
