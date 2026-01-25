<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Product;

class WishlistController extends Controller
{
   public function toggle(Product $product)
{
    $wishlist = session()->get('wishlist', []);

    // لو المنتج موجود → احذفه
    if (in_array($product->id, $wishlist)) {
        $wishlist = array_diff($wishlist, [$product->id]);
        session()->put('wishlist', $wishlist);

        return back()->with('success', 'Product removed from wishlist');
    }

    // لو غير موجود → أضفه
    $wishlist[] = $product->id;
    session()->put('wishlist', $wishlist);

    return back()->with('success', 'Product added to wishlist');
}
    public function moveToCart(Product $product)
{
    $wishlist = session()->get('wishlist', []);

    // إضافة للسلة بنفس نظام cart الحالي
    $cart = session()->get('cart', []);
    $id = (string) $product->id;

    if (isset($cart[$id])) {
        $cart[$id]['qty'] += 1;
    } else {
        $cart[$id] = [
            'product_id' => $product->id,
            'name'       => $product->name,
            'price'      => $product->price,
            'qty'        => 1,
            'image'      => $product->image,
        ];
    }

    session()->put('cart', $cart);

    // حذف من wishlist
    unset($wishlist[$product->id]);
    session()->put('wishlist', $wishlist);

    return back()->with('success', 'Product moved to cart');
}

public function moveAllToCart()
{
    $wishlistIds = session()->get('wishlist', []);

    if (empty($wishlistIds)) {
        return back();
    }

    $products = Product::whereIn('id', $wishlistIds)->get();
    $cart = session()->get('cart', []);

    foreach ($products as $product) {
        $id = (string) $product->id;

        if (isset($cart[$id])) {
            $cart[$id]['qty'] += 1;
        } else {
            $cart[$id] = [
                'product_id' => $product->id,
                'name'       => $product->name,
                'price'      => $product->price,
                'qty'        => 1,
                'image'      => $product->image,
            ];
        }
    }

    session()->put('cart', $cart);
    session()->forget('wishlist');

    return back()->with('success', 'All products moved to cart');
}
public function index()
{
    $ids = session()->get('wishlist', []);

    $items = Product::whereIn('id', $ids)->get();

    return view('user.wishlist.index', compact('items'));
}
public function clear()
{
    session()->forget('wishlist');
    return redirect()->route('user.wishlist.index')->with('success', 'Wishlist cleared');
}

}

