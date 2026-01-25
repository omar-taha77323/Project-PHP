@extends('user.layouts.app')

@section('content')
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 w-full">

        {{-- Breadcrumb --}}
        <nav aria-label="Breadcrumb" class="flex text-sm text-gray-500 dark:text-gray-400 mb-6">
            <ol class="flex items-center space-x-2">
                <li><a class="hover:text-primary" href="{{ route('user.home') }}">Home</a></li>
                <li class="flex items-center space-x-2">
                    <span class="material-symbols-outlined text-base">chevron_right</span>
                    <span class="text-gray-900 dark:text-white font-medium">My Wishlist</span>
                </li>
            </ol>
        </nav>

        {{-- Title + Guest Box --}}
        <div
            class="bg-white dark:bg-gray-900 rounded-xl border border-gray-200 dark:border-gray-800 p-5 flex items-center justify-between gap-6 mb-6">
            <div>
                <h2 class="text-3xl font-extrabold text-gray-900 dark:text-white">
                    My Wishlist ({{ $items->count() }} items)
                </h2>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">
                    You are viewing a guest wishlist.
                    <a href="{{ route('login') }}" class="text-primary font-semibold hover:underline">Sign in</a>
                    to save these items permanently.
                </p>
            </div>

            <a href="{{ route('login') }}"
                class="bg-primary hover:bg-primary/90 text-white font-bold px-5 py-3 rounded-lg transition">
                Sign In / Join
            </a>
        </div>

        {{-- Table Card --}}
        <div class="bg-white dark:bg-gray-900 rounded-xl border border-gray-200 dark:border-gray-800 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead
                        class="bg-gray-50 dark:bg-gray-800 text-xs uppercase tracking-wider text-gray-500 dark:text-gray-300">
                        <tr>
                            <th class="p-4">Product Info</th>
                            <th class="p-4">Price</th>
                            <th class="p-4">Stock Status</th>
                            <th class="p-4 text-right">Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($items as $product)
                            @php
                                $img = $product->mainImage?->path ?? ($product->image ?? null);
                                $finalPrice = $product->sale_price ?? $product->price;
                                $hasLowStock = isset($product->stock) && (int) $product->stock <= 5;
                            @endphp
                            <tr class="border-t border-gray-200 dark:border-gray-800">
                                {{-- Product --}}
                                <td class="p-4">
                                    <div class="flex items-center gap-4">
                                        <div class="w-16 h-16 rounded-lg overflow-hidden bg-gray-100 flex-shrink-0">
                                            @if ($img)
                                                <img class="w-full h-full object-cover" src="{{ asset($img) }}"
                                                    alt="{{ $product->name }}">
                                            @else
                                                <img class="w-full h-full object-cover"
                                                    src="https://picsum.photos/seed/wishlist-{{ $product->id }}/200/200"
                                                    alt="{{ $product->name }}">
                                            @endif
                                        </div>
                                        <div>
                                            <div class="font-bold text-gray-900 dark:text-white">{{ $product->name }}</div>
                                            <div class="text-xs text-gray-500 dark:text-gray-400">
                                                {{ $product->category?->name ?? '—' }}
                                            </div>
                                        </div>
                                    </div>
                                </td>

                                {{-- Price --}}
                                <td class="p-4">
                                    <div class="font-extrabold text-gray-900 dark:text-white">
                                        ${{ number_format($finalPrice, 2) }}
                                    </div>
                                    @if (isset($product->sale_price) && $product->sale_price && (float) $product->sale_price < (float) $product->price)
                                        <div class="text-sm text-gray-400 line-through">
                                            ${{ number_format($product->price, 2) }}
                                        </div>
                                    @endif
                                </td>

                                {{-- Stock --}}
                                <td class="p-4">
                                    @if ($hasLowStock)
                                        <span
                                            class="inline-flex items-center gap-2 bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-xs font-semibold">
                                            ● Low Stock
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center gap-2 bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-semibold">
                                            ● In Stock
                                        </span>
                                    @endif
                                </td>

                                {{-- Actions --}}
                                <td class="p-4">
                                    <div class="flex items-center justify-end gap-3">

                                        {{-- Move to Cart --}}
                                        <form method="POST" action="{{ route('user.wishlist.moveToCart', $product->id) }}"
                                            class="shrink-0">
                                            @csrf
                                            <button type="submit"
                                                class="inline-flex items-center justify-center gap-2
                       bg-primary hover:bg-primary/90 text-white font-bold
                       px-4 py-2 rounded-lg text-sm transition
                       min-w-[140px]">
                                                <span
                                                    class="material-symbols-outlined text-[18px] pointer-events-none">shopping_cart</span>
                                                <span class="pointer-events-none">Move to Cart</span>
                                            </button>
                                        </form>

                                        {{-- Delete --}}
                                        <form method="POST" action="{{ route('user.wishlist.remove', $product->id) }}"
                                            class="shrink-0">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="inline-flex items-center justify-center
                       w-10 h-10 rounded-lg
                       bg-gray-100 hover:bg-red-50
                       text-gray-600 hover:text-red-600 transition">
                                                <span class="material-symbols-outlined pointer-events-none">delete</span>
                                            </button>
                                        </form>

                                    </div>
                                </td>
                                iv>
                                </td>
                            </tr>
                        @empty
                            <tr class="border-t border-gray-200 dark:border-gray-800">
                                <td colspan="4" class="p-10 text-center text-gray-500 dark:text-gray-400">
                                    Wishlist is empty
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Footer row under table --}}
            <div
                class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 p-5 border-t border-gray-200 dark:border-gray-800">
                <div class="text-sm text-gray-500 dark:text-gray-400 flex items-center gap-2">
                    <span class="material-symbols-outlined text-base">info</span>
                    Wishlist items are stored in your browser session.
                </div>

                <div class="flex items-center justify-end gap-3">
                    <form method="POST" action="{{ route('user.wishlist.clear') }}">
                        @csrf
                        @method('DELETE')
                        <button
                            class="border border-gray-200 dark:border-gray-700 px-5 py-2 rounded-lg font-semibold hover:bg-gray-50 dark:hover:bg-gray-800 transition">
                            Clear All Wishlist
                        </button>
                    </form>

                    <form method="POST" action="{{ route('user.wishlist.moveAllToCart') }}">
                        @csrf
                        <button class="bg-primary hover:bg-primary/90 text-white font-bold px-5 py-2 rounded-lg transition">
                            Move All to Cart
                        </button>
                    </form>
                </div>
            </div>
        </div>

        {{-- Want to see more block --}}
        <div
            class="mt-10 bg-gray-50 dark:bg-gray-900/40 border border-dashed border-gray-300 dark:border-gray-700 rounded-2xl p-10 text-center">
            <div class="mx-auto w-14 h-14 rounded-full bg-primary/10 flex items-center justify-center mb-4">
                <span class="material-symbols-outlined text-primary">shopping_bag</span>
            </div>
            <h3 class="text-xl font-extrabold text-gray-900 dark:text-white">Want to see more?</h3>
            <p class="text-gray-500 dark:text-gray-400 mt-2 max-w-xl mx-auto">
                Explore our curated collections and keep saving the products you love.
            </p>
            <a href="{{ route('user.products.index') }}"
                class="inline-flex mt-6 px-6 py-3 rounded-lg border border-primary text-primary font-bold hover:bg-primary hover:text-white transition">
                Continue Shopping
            </a>
        </div>

    </main>
@endsection
