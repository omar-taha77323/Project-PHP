@extends('user.layouts.app')

@section('title', 'Home Page - Laravel Store')

@section('content')
    <div class="layout-content-container flex flex-col max-w-[1200px] w-full px-4 md:px-10">

        {{-- Hero --}}
        <div class="py-6">
            <div class="@container">
                <div class="flex min-h-[520px] flex-col gap-6 bg-cover bg-center bg-no-repeat rounded-xl items-start justify-end px-6 pb-16 md:px-12 md:pb-20 relative overflow-hidden group"
                    style='background-image: linear-gradient(rgba(0, 0, 0, 0.2) 0%, rgba(0, 0, 0, 0.6) 100%), url("{{ asset('images/hero.jpg') }}");'>
                    <div class="flex flex-col gap-4 text-left max-w-2xl z-10">
                        <h1 class="text-white text-5xl font-black leading-tight tracking-[-0.033em] md:text-6xl">
                            Discover Your Next Favorite Essential
                        </h1>
                        <p class="text-white/90 text-lg font-normal leading-relaxed md:text-xl">
                            Curated collections designed for your lifestyle. High-quality products, minimalist design, and
                            sustainable materials at your fingertips.
                        </p>
                    </div>

                    <a href="{{ route('user.products.index') }}"
                        class="flex min-w-[160px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-12 px-6 bg-primary text-white text-base font-bold leading-normal tracking-[0.015em] hover:bg-primary/90 transition-all z-10 shadow-lg shadow-primary/20">
                        <span class="truncate">Shop Collection</span>
                    </a>
                </div>
            </div>
        </div>

        {{-- Categories Header --}}
        <div class="flex items-center justify-between px-4 pb-4 pt-8">
            <h2 class="text-[#111618] dark:text-white text-2xl font-bold leading-tight tracking-[-0.015em]">Shop by Category
            </h2>
            <a class="text-primary font-semibold text-sm hover:underline" href="{{ route('user.categories.index') }}">View
                all</a>
        </div>

        {{-- Categories Grid (Dynamic) --}}
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 px-4 pb-8">
            @forelse($categories as $cat)
                <a href="{{ route('user.categories.show', $cat->id) }}" class="group cursor-pointer">
                    <div class="relative aspect-square rounded-xl overflow-hidden mb-3 bg-gray-100 dark:bg-gray-800">
                        {{-- لو عندك صورة للتصنيف لاحقاً نحطها هنا --}}
                        <div class="w-full h-full bg-cover bg-center transition-transform duration-500 group-hover:scale-110"
                        style='background-image: url("{{ asset('images/hero.jpg') }}");'>
                        </div>

                        <div
                            class="absolute inset-0 bg-black/20 group-hover:bg-black/40 transition-colors flex items-center justify-center">
                            <span class="text-white font-bold text-lg">{{ $cat->name }}</span>
                        </div>
                    </div>
                </a>
            @empty
                <div class="col-span-full text-gray-500 px-4">No categories found.</div>
            @endforelse
        </div>

        {{-- Featured Products Header --}}
        <div class="flex items-center justify-between px-4 pb-4 pt-8">
            <h2 class="text-[#111618] dark:text-white text-2xl font-bold leading-tight tracking-[-0.015em]">Featured
                Products</h2>
            <a class="text-primary font-semibold text-sm hover:underline" href="{{ route('user.products.index') }}">See all
                products</a>
        </div>

        {{-- Products Grid (Dynamic) --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 p-4">
            @forelse($featuredProducts as $p)
                <div
                    class="flex flex-col group bg-white dark:bg-gray-900 rounded-xl p-3 border border-transparent hover:border-gray-200 dark:hover:border-gray-800 transition-all hover:shadow-xl hover:shadow-gray-200/50 dark:hover:shadow-none">
                    <a href="{{ route('user.products.show', $p->id) }}"
                        class="relative w-full aspect-square bg-center bg-no-repeat bg-cover rounded-lg overflow-hidden"
                            style='background-image: url("{{ $p->mainImage?->path ? asset($p->mainImage->path) : asset('images/hero.jpg') }}");'>

                        <div class="absolute top-2 right-2">
                            {{-- زر مفضلة (سنربطه بصفحة wishlist لاحقاً) --}}
                            @php
                                $wishlist = session('wishlist', []);
                                $inWishlist = in_array($p->id, $wishlist);
                            @endphp

                            <form method="POST" action="{{ route('user.wishlist.toggle', $p->id) }}">
                                @csrf
                                <button type="submit"
                                    class="absolute top-3 right-3 w-10 h-10 rounded-full flex items-center justify-center transition
               border {{ $inWishlist ? 'bg-red-50 border-red-200' : 'bg-white border-gray-200' }}">
                                    <span style="font-size:18px;">
                                        {{ $inWishlist ? '❤️' : '🤍' }}
                                    </span>
                                </button>
                            </form>

                        </div>
                    </a>

                    <div class="mt-4 flex flex-col gap-1">
                        <p class="text-[#111618] dark:text-white text-base font-bold leading-normal truncate">
                            {{ $p->name }}</p>
                        <p class="text-[#617c89] dark:text-gray-400 text-sm font-normal leading-normal">
                            {{ $p->brand?->name ?? '—' }}
                        </p>

                        <div class="flex items-center justify-between mt-3">
                            <p class="text-primary text-lg font-bold leading-normal">
                                ${{ number_format($p->sale_price ?? $p->price, 2) }}
                            </p>

                            <form method="POST" action="{{ route('user.cart.add', $p->id) }}">
                                @csrf
                                <button
                                    class="bg-primary/10 text-primary hover:bg-primary hover:text-white px-3 py-1.5 rounded-lg text-sm font-bold transition-all flex items-center gap-1">
                                    <span class="material-symbols-outlined text-base">add_shopping_cart</span>
                                    Add
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-gray-500 px-4">No products found.</div>
            @endforelse
        </div>

    </div>
@endsection
