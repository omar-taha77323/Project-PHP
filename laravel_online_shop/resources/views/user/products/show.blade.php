@extends('user.layouts.app')

@section('title', $product->name)

@section('content')
    @php
        use Illuminate\Support\Str;

        $wishlist = session('wishlist', []);
        $inWishlist = isset($wishlist[$product->id]);

        $images = $product->images ?? collect();
        $main = $product->mainImage ?: $images->first();

        $imgUrl = $main?->path
            ? (Str::startsWith($main->path, ['http://', 'https://'])
                ? $main->path
                : asset('storage/' . $main->path))
            : asset('images/hero.jpg');

        $price = $product->sale_price ?? $product->price;
    @endphp

    <main class="flex flex-col items-center py-6 px-4 md:px-10">
        <div class="max-w-[1200px] w-full flex flex-col">

            {{-- Breadcrumbs --}}
            <nav class="flex flex-wrap gap-2 py-4 mb-2">
                <a class="text-[#617c89] dark:text-gray-400 text-sm font-medium hover:text-primary"
                    href="{{ route('user.products.index') }}">Shop</a>
                <span class="text-[#617c89] dark:text-gray-400 text-sm font-medium">/</span>

                @if ($product->category)
                    <span class="text-[#617c89] dark:text-gray-400 text-sm font-medium">{{ $product->category->name }}</span>
                    <span class="text-[#617c89] dark:text-gray-400 text-sm font-medium">/</span>
                @endif

                <span class="text-primary text-sm font-medium">{{ $product->name }}</span>
            </nav>

            {{-- Product Section --}}
            <div
                class="grid grid-cols-12 gap-8 bg-white dark:bg-background-dark p-6 md:p-8 rounded-xl shadow-sm border border-gray-100 dark:border-gray-800">

                {{-- Gallery --}}
                <div class="col-span-12 lg:col-span-7 flex flex-col gap-4">
                    <div class="w-full aspect-[4/3] rounded-xl overflow-hidden bg-[#f0f3f4] dark:bg-gray-800">
                        <div class="w-full h-full bg-center bg-no-repeat bg-cover"
                            style="background-image:url('{{ $imgUrl }}')"></div>
                    </div>

                    {{-- Thumbnails --}}
                    @if ($images->count())
                        <div class="grid grid-cols-5 gap-3">
                            @foreach ($images->take(5) as $img)
                                @php
                                    $thumb = $img->path
                                        ? (Str::startsWith($img->path, ['http://', 'https://'])
                                            ? $img->path
                                            : asset('storage/' . $img->path))
                                        : asset('images/hero.jpg');

                                @endphp
                                <a href="{{ $thumb }}" target="_blank"
                                    class="aspect-square rounded-lg border-2 {{ $img->is_main ? 'border-primary' : 'border-transparent hover:border-primary/50' }}
                        overflow-hidden cursor-pointer bg-[#f0f3f4] transition-all">
                                    <div class="w-full h-full bg-center bg-no-repeat bg-cover"
                                        style="background-image:url('{{ $thumb }}')"></div>
                                </a>
                            @endforeach
                        </div>
                    @endif
                </div>

                {{-- Info --}}
                <div class="col-span-12 lg:col-span-5 flex flex-col">
                    <div class="mb-4">
                        <p class="text-[#617c89] dark:text-gray-400 text-sm font-medium uppercase">
                            {{ $product->brand?->name ?? 'Product' }}
                        </p>
                        <h1 class="text-[#111618] dark:text-white text-3xl md:text-4xl font-extrabold mb-2">
                            {{ $product->name }}
                        </h1>
                        <p class="text-[#617c89] dark:text-gray-400 text-sm">SKU: {{ $product->sku }}</p>
                    </div>

                    <div class="flex items-center gap-4 mb-6">
                        <span
                            class="text-3xl font-bold text-[#111618] dark:text-white">${{ number_format($price, 2) }}</span>

                        @if ($product->stock > 0)
                            <div
                                class="flex items-center gap-1.5 px-3 py-1 bg-green-50 dark:bg-green-950/30 text-green-600 dark:text-green-400 rounded-full border border-green-100 dark:border-green-900">
                                <span class="material-symbols-outlined text-[16px]">check_circle</span>
                                <span class="text-xs font-bold uppercase">In Stock</span>
                            </div>
                        @else
                            <div
                                class="flex items-center gap-1.5 px-3 py-1 bg-red-50 dark:bg-red-950/30 text-red-600 dark:text-red-400 rounded-full border border-red-100 dark:border-red-900">
                                <span class="material-symbols-outlined text-[16px]">cancel</span>
                                <span class="text-xs font-bold uppercase">Out of Stock</span>
                            </div>
                        @endif
                    </div>

                    <div class="mb-8 space-y-4">
                        <h3 class="text-sm font-bold text-[#111618] dark:text-white uppercase">Product Description</h3>
                        <p class="text-[#4b5563] dark:text-gray-300 text-base leading-relaxed">
                            {{ $product->description ?: 'No description available.' }}
                        </p>
                    </div>


                    {{-- Actions --}}
                    <div class="flex flex-col gap-4 mt-auto">

                        {{-- Add to Cart --}}
                        <form action="{{ route('user.cart.add', $product) }}" method="POST" class="flex gap-4">
                            @csrf

                            <div
                                class="flex items-center border border-gray-200 dark:border-gray-700 rounded-lg overflow-hidden h-12">
                                <button type="button" onclick="decQty()"
                                    class="px-4 hover:bg-gray-100 dark:hover:bg-gray-800 text-gray-500 h-full flex items-center justify-center">
                                    <span class="material-symbols-outlined text-[18px]">remove</span>
                                </button>

                                <input id="qty" name="qty" value="1"
                                    class="w-14 text-center font-bold bg-transparent border-0 focus:ring-0 text-[#111618] dark:text-white" />

                                <button type="button" onclick="incQty()"
                                    class="px-4 hover:bg-gray-100 dark:hover:bg-gray-800 text-gray-500 h-full flex items-center justify-center">
                                    <span class="material-symbols-outlined text-[18px]">add</span>
                                </button>
                            </div>

                            <button @disabled($product->stock <= 0)
                                class="flex-1 bg-primary hover:bg-primary/90 disabled:opacity-50 disabled:cursor-not-allowed text-white font-bold py-3 px-8 rounded-lg transition-all flex items-center justify-center gap-2 h-12 shadow-md shadow-primary/20">
                                <span class="material-symbols-outlined">shopping_bag</span>
                                Add to Cart
                            </button>
                        </form>

                        {{-- Wishlist --}}
                        @php
                            $wishlist = session('wishlist', []);
                            $inWishlist = in_array($product->id, $wishlist);
                        @endphp

                        <form action="{{ route('user.wishlist.toggle', $product->id) }}" method="POST" class="flex gap-3">
                            @csrf

                            <button type="submit"
                                class="flex-1 flex items-center justify-center gap-2 py-3 rounded-lg transition-colors text-sm font-medium h-12
               border {{ $inWishlist ? 'border-red-200 bg-red-50' : 'border-gray-200 dark:border-gray-700' }}
               hover:bg-gray-50 dark:hover:bg-gray-800">

                                <span
                                    class="material-symbols-outlined text-[20px] {{ $inWishlist ? 'text-red-500' : 'text-gray-700 dark:text-gray-200' }}">
                                    favorite
                                </span>

                                {{ $inWishlist ? 'Remove from Wishlist' : 'Add to Wishlist' }}
                            </button>
                        </form>


                    </div>
                </div>
            </div>

            {{-- Related Products --}}
            @if ($related->count())
                <div class="mt-10">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-xl font-bold text-[#111618] dark:text-white">Related Products</h2>
                        <a href="{{ route('user.products.index') }}"
                            class="text-primary text-sm font-semibold hover:underline">Back to shop</a>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                        @foreach ($related as $p)
                            @php
                                $rimg = $p->mainImage?->path
                                    ? (Str::startsWith($p->mainImage->path, ['http://', 'https://'])
                                        ? $p->mainImage->path
                                        : asset('storage/' . $p->mainImage->path))
                                    : 'https://via.placeholder.com/600x600?text=No+Image';
                                $rprice = $p->sale_price ?? $p->price;
                            @endphp
                            <a href="{{ route('user.products.show', $p) }}"
                                class="group bg-white dark:bg-gray-900 rounded-xl border border-gray-200 dark:border-gray-800 overflow-hidden hover:shadow-xl transition-all">
                                <div class="relative aspect-square overflow-hidden bg-gray-100">
                                    <img src="{{ $rimg }}"
                                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                                        alt="{{ $p->name }}">
                                </div>
                                <div class="p-4">
                                    <div class="text-sm font-bold text-[#111618] dark:text-white line-clamp-1">
                                        {{ $p->name }}</div>
                                    <div class="text-primary font-bold mt-2">${{ number_format($rprice, 2) }}</div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif

        </div>
    </main>

    <script>
        function incQty() {
            const el = document.getElementById('qty');
            const v = parseInt(el.value || '1', 10);
            el.value = Math.min(99, v + 1);
        }

        function decQty() {
            const el = document.getElementById('qty');
            const v = parseInt(el.value || '1', 10);
            el.value = Math.max(1, v - 1);
        }
    </script>
@endsection
