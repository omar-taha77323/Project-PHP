@extends('user.layouts.app')

@section('title', 'Product Listing - Shop')

@section('content')
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 w-full">
        {{-- Breadcrumbs --}}
        <nav aria-label="Breadcrumb" class="flex text-sm text-gray-500 dark:text-gray-400 mb-6">
            <ol class="flex items-center space-x-2">
                <li><a class="hover:text-primary" href="{{ route('user.home') }}">Home</a></li>
                <li class="flex items-center space-x-2">
                    <span class="material-symbols-outlined text-base">chevron_right</span>
                    <a class="hover:text-primary" href="{{ route('user.products.index') }}">Shop</a>
                </li>
                <li class="flex items-center space-x-2">
                    <span class="material-symbols-outlined text-base">chevron_right</span>
                    <span class="text-gray-900 dark:text-white font-medium">All Products</span>
                </li>
            </ol>
        </nav>

        <div class="flex flex-col lg:flex-row gap-8">

            {{-- Sidebar Filters --}}
            <aside class="w-full lg:w-64 flex-shrink-0">
                <form method="GET" action="{{ route('user.products.index') }}"
                      class="sticky top-24 bg-white dark:bg-gray-900 rounded-xl border border-gray-200 dark:border-gray-800 p-5 space-y-8">

                    <div class="flex items-center justify-between mb-2">
                        <h3 class="text-gray-900 dark:text-white font-bold text-lg">Filters</h3>
                        <a href="{{ route('user.products.index') }}" class="text-primary text-xs font-semibold hover:underline">Reset</a>
                    </div>

                    {{-- preserve search --}}
                    @if(request('q'))
                        <input type="hidden" name="q" value="{{ request('q') }}">
                    @endif

                    {{-- Categories --}}
                    <div class="space-y-3">
                        <h4 class="text-gray-900 dark:text-white text-sm font-semibold uppercase tracking-wider">Categories</h4>
                        <div class="space-y-2">
                            @foreach($categories as $cat)
                                @php
                                    $checked = in_array((string)$cat->id, (array)request('categories', []), true);
                                @endphp
                                <label class="flex items-center justify-between group cursor-pointer">
                                    <div class="flex items-center gap-3">
                                        <input
                                            name="categories[]"
                                            value="{{ $cat->id }}"
                                            @checked($checked)
                                            class="h-5 w-5 rounded border-gray-300 dark:border-gray-700 text-primary focus:ring-primary checkbox-custom"
                                            type="checkbox"
                                        />
                                        <span class="text-gray-600 dark:text-gray-400 text-sm group-hover:text-primary transition-colors {{ $checked ? 'font-medium' : '' }}">
                                            {{ $cat->name }}
                                        </span>
                                    </div>
                                    <span class="text-xs text-gray-400">{{ $cat->products_count }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    {{-- Price Range --}}
                    <div>
                        <h4 class="text-gray-900 dark:text-white text-sm font-semibold uppercase tracking-wider mb-4">Price Range</h4>
                        <div class="grid grid-cols-2 gap-3">
                            <div>
                                <label class="text-xs text-gray-500">Min</label>
                                <input
                                    name="min_price"
                                    value="{{ request('min_price') }}"
                                    type="number" step="0.01" min="0"
                                    class="mt-1 block w-full border-none bg-gray-100 dark:bg-gray-800 rounded-lg text-sm placeholder-gray-500 focus:ring-2 focus:ring-primary dark:text-gray-200"
                                    placeholder="0"
                                />
                            </div>
                            <div>
                                <label class="text-xs text-gray-500">Max</label>
                                <input
                                    name="max_price"
                                    value="{{ request('max_price') }}"
                                    type="number" step="0.01" min="0"
                                    class="mt-1 block w-full border-none bg-gray-100 dark:bg-gray-800 rounded-lg text-sm placeholder-gray-500 focus:ring-2 focus:ring-primary dark:text-gray-200"
                                    placeholder="9999"
                                />
                            </div>
                        </div>
                        <p class="text-[11px] text-gray-400 mt-2">
                            Range: {{ number_format($priceMin, 2) }} - {{ number_format($priceMax, 2) }}
                        </p>
                    </div>

                    {{-- Brands --}}
                    <div>
                        <h4 class="text-gray-900 dark:text-white text-sm font-semibold uppercase tracking-wider mb-4">Brands</h4>
                        <div class="space-y-2">
                            @foreach($brands as $b)
                                @php
                                    $bChecked = in_array((string)$b->id, (array)request('brands', []), true);
                                @endphp
                                <label class="flex items-center gap-3 cursor-pointer">
                                    <input
                                        name="brands[]"
                                        value="{{ $b->id }}"
                                        @checked($bChecked)
                                        class="h-5 w-5 rounded border-gray-300 dark:border-gray-700 text-primary checkbox-custom"
                                        type="checkbox"
                                    />
                                    <span class="text-gray-600 dark:text-gray-400 text-sm">{{ $b->name }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    {{-- Apply --}}
                    <button class="w-full bg-primary hover:bg-primary/90 text-white font-bold py-3 rounded-lg transition-colors flex items-center justify-center gap-2">
                        <span>Apply Filters</span>
                    </button>
                </form>
            </aside>

            {{-- Product Listing Main Area --}}
            <div class="flex-1">

                {{-- Toolbar --}}
                <div class="flex flex-col sm:flex-row sm:items-center justify-between mb-8 gap-4 bg-white dark:bg-gray-900 p-4 rounded-xl border border-gray-200 dark:border-gray-800">
                    <div class="text-sm text-gray-600 dark:text-gray-400">
                        Showing
                        <span class="font-bold text-gray-900 dark:text-white">{{ $products->count() }}</span>
                        of
                        <span class="font-bold text-gray-900 dark:text-white">{{ $products->total() }}</span>
                        products
                    </div>

                    <div class="flex items-center gap-3">
                        <span class="text-sm text-gray-600 dark:text-gray-400 whitespace-nowrap">Sort by:</span>

                        <form method="GET" action="{{ route('user.products.index') }}">
                            {{-- keep filters when changing sort --}}
                            @foreach(request()->except('sort', 'page') as $k => $v)
                                @if(is_array($v))
                                    @foreach($v as $vv)
                                        <input type="hidden" name="{{ $k }}[]" value="{{ $vv }}">
                                    @endforeach
                                @else
                                    <input type="hidden" name="{{ $k }}" value="{{ $v }}">
                                @endif
                            @endforeach

                            <select name="sort" onchange="this.form.submit()"
                                    class="bg-gray-50 dark:bg-gray-800 border-none rounded-lg text-sm text-gray-900 dark:text-white focus:ring-primary pr-10">
                                <option value="new" @selected(request('sort', 'new') === 'new')>Newest Arrivals</option>
                                <option value="price_asc" @selected(request('sort') === 'price_asc')>Price: Low to High</option>
                                <option value="price_desc" @selected(request('sort') === 'price_desc')>Price: High to Low</option>
                            </select>
                        </form>
                    </div>
                </div>

                {{-- Grid --}}
                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">

                    @forelse($products as $p)
                        @php
                            $img = $p->mainImage?->path;
                            $finalPrice = $p->sale_price ?? $p->price;
                            $hasSale = !is_null($p->sale_price) && (float)$p->sale_price < (float)$p->price;
                        @endphp

                        <div class="group bg-white dark:bg-gray-900 rounded-xl border border-gray-200 dark:border-gray-800 overflow-hidden hover:shadow-xl transition-all duration-300">
                            <a href="{{ route('user.products.show', $p->id) }}" class="block relative aspect-square overflow-hidden bg-gray-100">
                                @if($img)
                                    <img class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                                         alt="{{ $p->name }}"
                                         src="{{ asset($img) }}"/>
                                @else
                                    <img class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                                         alt="{{ $p->name }}"
                                         src="https://picsum.photos/seed/product-{{ $p->id }}/800/800"/>
                                @endif

                                @if($hasSale)
                                    <div class="absolute top-3 left-3 bg-red-500 text-white text-[10px] font-bold px-2 py-1 rounded uppercase">
                                        SALE
                                    </div>
                                @endif

                                {{-- wishlist toggle --}}
                                <form method="POST" action="{{ route('user.wishlist.toggle', $p->id) }}"
                                      class="absolute top-3 right-3">
                                    @csrf
                                    <button type="submit"
                                            class="p-2 bg-white/80 dark:bg-black/40 backdrop-blur-md rounded-full text-gray-900 dark:text-white opacity-0 group-hover:opacity-100 transition-opacity">
                                        <span class="material-symbols-outlined text-xl">favorite</span>
                                    </button>
                                </form>
                            </a>

                            <div class="p-5">
                                <p class="text-xs text-primary font-bold uppercase tracking-wider mb-1">
                                    {{ $p->category?->name ?? '—' }}
                                </p>

                                <h3 class="text-gray-900 dark:text-white font-bold text-lg mb-2 line-clamp-1">
                                    {{ $p->name }}
                                </h3>

                                <div class="flex items-center justify-between">
                                    <div class="flex flex-col">
                                        <span class="text-gray-900 dark:text-white font-bold text-xl">
                                            ${{ number_format($finalPrice, 2) }}
                                        </span>

                                        @if($hasSale)
                                            <span class="text-gray-400 text-sm line-through">
                                                ${{ number_format($p->price, 2) }}
                                            </span>
                                        @endif
                                    </div>

                                    <form method="POST" action="{{ route('user.cart.add', $p->id) }}">
                                        @csrf
                                        <button class="p-3 bg-gray-100 dark:bg-gray-800 text-gray-900 dark:text-white rounded-lg hover:bg-primary hover:text-white transition-colors"
                                                type="submit">
                                            <span class="material-symbols-outlined">shopping_cart</span>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-gray-500">No products found.</div>
                    @endforelse

                </div>

                {{-- Pagination --}}
                <div class="mt-12">
                    {{ $products->links() }}
                </div>

            </div>
        </div>
    </main>
@endsection
