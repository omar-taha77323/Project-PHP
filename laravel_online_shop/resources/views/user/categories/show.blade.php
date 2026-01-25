@extends('user.layouts.app')

@section('title', 'Category Products - ShopEase')

@section('content')
<main class="flex-1 w-full max-w-[1280px] mx-auto px-6 py-8">

    {{-- Breadcrumbs --}}
    <nav class="flex items-center gap-2 text-sm mb-6 text-gray-500 dark:text-gray-400">
        <a class="hover:text-primary" href="{{ route('user.home') }}">Home</a>
        <span class="material-symbols-outlined text-xs">chevron_right</span>
        <a class="hover:text-primary" href="{{ route('user.categories.index') }}">Categories</a>
        <span class="material-symbols-outlined text-xs">chevron_right</span>
        <span class="text-[#111618] dark:text-white font-medium">{{ $category->name }}</span>
    </nav>

    {{-- Heading + Toolbar --}}
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-8 border-b border-gray-200 dark:border-gray-800 pb-8">
        <div class="max-w-2xl">
            <h1 class="text-4xl font-black tracking-tight mb-2">
                Category: {{ $category->name }}
            </h1>
            <p class="text-gray-600 dark:text-gray-400 leading-relaxed">
                Explore our wide range of premium products in this category.
            </p>
        </div>

        <div class="flex items-center gap-4">
            <div class="text-sm font-medium text-gray-500 dark:text-gray-400">
                {{ $products->total() }} products
            </div>

            <div class="flex items-center gap-2">
                <button class="flex items-center gap-2 px-4 py-2 border border-gray-200 dark:border-gray-700 rounded-lg bg-white dark:bg-gray-800 hover:bg-gray-50 transition-colors font-medium text-sm">
                    <span class="material-symbols-outlined text-xl">filter_list</span>
                    Filter
                </button>

                <div class="relative group">
                    <form method="GET" action="{{ route('user.categories.show', $category->id) }}">
                        <select name="sort"
                                onchange="this.form.submit()"
                                class="appearance-none pl-4 pr-10 py-2 border border-gray-200 dark:border-gray-700 rounded-lg bg-white dark:bg-gray-800 hover:bg-gray-50 transition-colors font-medium text-sm focus:ring-primary focus:border-primary outline-none cursor-pointer">
                            <option value="newest" {{ ($sort ?? request('sort','newest')) === 'newest' ? 'selected' : '' }}>
                                Sort by: Newest
                            </option>
                            <option value="price_asc" {{ ($sort ?? request('sort')) === 'price_asc' ? 'selected' : '' }}>
                                Price: Low to High
                            </option>
                            <option value="price_desc" {{ ($sort ?? request('sort')) === 'price_desc' ? 'selected' : '' }}>
                                Price: High to Low
                            </option>
                            <option value="popular" {{ ($sort ?? request('sort')) === 'popular' ? 'selected' : '' }}>
                                Popularity
                            </option>
                        </select>
                        <span class="material-symbols-outlined absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none">
                            expand_more
                        </span>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Product Grid --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
        @forelse($products as $product)
            <a href="{{ route('user.products.show', $product->id) }}" class="group cursor-pointer block">
                <div class="relative aspect-square rounded-xl overflow-hidden bg-gray-100 dark:bg-gray-800 mb-4 transition-all duration-300 group-hover:shadow-xl group-hover:-translate-y-1">

                    {{-- صورة المنتج: عدّلها حسب مشروعك --}}
                    <img
                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                        src="{{ $product->image_url ?? asset('images/hero.jpg') }}"
                        alt="{{ $product->name }}"
                    />

                    <div class="absolute bottom-4 left-4 right-4 translate-y-8 opacity-0 group-hover:translate-y-0 group-hover:opacity-100 transition-all duration-300">
                        <form method="POST" action="{{ route('user.cart.add', $product->id) }}">
                            @csrf
                            <button type="submit" class="w-full bg-primary text-white py-2.5 rounded-lg font-bold text-sm shadow-lg shadow-primary/30">
                                Add to Cart
                            </button>
                        </form>
                    </div>
                </div>

                <div class="space-y-1">
                    <div class="flex justify-between items-start">
                        <h3 class="font-bold text-lg group-hover:text-primary transition-colors">
                            {{ $product->name }}
                        </h3>

                        @if(!empty($product->badge))
                            <span class="text-sm bg-primary/10 text-primary px-2 py-0.5 rounded font-medium">
                                {{ $product->badge }}
                            </span>
                        @endif
                    </div>

                    @if(!empty($product->short_description))
                        <p class="text-gray-500 text-sm">{{ $product->short_description }}</p>
                    @endif

                    <p class="font-black text-xl text-primary">
                        ${{ number_format((float)$product->price, 2) }}
                    </p>
                </div>
            </a>
        @empty
            <div class="col-span-full text-center text-gray-500 py-16">
                No products found in this category.
            </div>
        @endforelse
    </div>

    {{-- Pagination --}}
    @if ($products->hasPages())
        <div class="mt-16 flex flex-col items-center gap-6 border-t border-gray-200 dark:border-gray-800 pt-10">
            <div>
                {{ $products->links() }}
            </div>

            <p class="text-sm text-gray-500">
                Showing {{ $products->firstItem() ?? 0 }} to {{ $products->lastItem() ?? 0 }} of {{ $products->total() }} products
            </p>
        </div>
    @endif

</main>
@endsection
