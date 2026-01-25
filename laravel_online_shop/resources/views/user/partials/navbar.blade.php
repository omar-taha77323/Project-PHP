@php
$q = request('q');
$cartCount = collect(session('cart', []))->sum(fn($item) => (int) ($item['qty'] ?? 0));

$wishlistCount = count(session('wishlist', []));
$isWishlistPage = request()->routeIs('user.wishlist.*');

// ✅ نفس منطق الأدمن عندك في الكود الثاني
$role = (int) (auth()->user()->role_id ?? 3);
$isAdmin = auth()->check() && in_array($role, [1, 2]); // 1 = super admin, 2 = admin
$isSuperAdmin = auth()->check() && $role === 1;
@endphp

{{-- ✅ Spacer عشان المحتوى ما يدخل تحت النافبار --}}
<div class="h-16"></div>

<header
    class="fixed top-0 left-0 right-0 z-50
           flex items-center justify-between whitespace-nowrap
           border-b border-solid border-[#e5e7eb] dark:border-gray-800
           bg-white/95 dark:bg-background-dark/95 backdrop-blur
           px-10 py-3">

    <div class="flex items-center gap-8">
        <a href="{{ route('user.home') }}" class="flex items-center gap-4 text-[#111618] dark:text-white">
            <div class="size-6 text-primary flex items-center justify-center">
                <span class="material-symbols-outlined text-3xl">shopping_bag</span>
            </div>
            <h2 class="text-[#111618] dark:text-white text-xl font-bold leading-tight tracking-[-0.015em]">
                {{ $siteSettings->site_name ?? 'Electronics Store' }}
            </h2>
        </a>

        <nav class="hidden lg:flex items-center gap-9">
            <a class="text-[#111618] dark:text-gray-300 text-sm font-medium leading-normal hover:text-primary transition-colors"
                href="{{ route('user.home') }}">Home</a>

            <a class="text-[#111618] dark:text-gray-300 text-sm font-medium leading-normal hover:text-primary transition-colors"
                href="{{ route('user.products.index') }}">Shop</a>

            <a class="text-[#111618] dark:text-gray-300 text-sm font-medium leading-normal hover:text-primary transition-colors"
                href="{{ route('user.categories.index') }}">Categories</a>

            @auth
            <a class="text-[#111618] dark:text-gray-300 text-sm font-medium leading-normal hover:text-primary transition-colors"
                href="{{ route('user.orders.index') }}">My Orders</a>
            @endauth

            <a class="text-[#111618] dark:text-gray-300 text-sm font-medium leading-normal hover:text-primary transition-colors"
                href="{{ route('user.pages.about') }}">About</a>

            <a href="{{ url('/contact') }}"
                class="text-sm font-medium leading-normal hover:text-primary transition-colors text-[#111618] dark:text-gray-300">
                Contact
            </a>
        </nav>
    </div>

    <div class="flex flex-1 justify-end gap-6 items-center">

        {{-- Search -> Products page --}}
        <form class="flex flex-col min-w-40 !h-10 max-w-sm flex-1" action="{{ route('user.products.index') }}"
            method="GET">
            <div class="flex w-full flex-1 items-stretch rounded-lg h-full">
                <div class="text-[#617c89] flex border-none bg-[#f0f3f4] dark:bg-gray-800 items-center justify-center pl-4 rounded-l-lg">
                    <span class="material-symbols-outlined text-xl">search</span>
                </div>

                <input name="q" value="{{ $q }}"
                    class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-[#111618] dark:text-white focus:outline-0 focus:ring-2 focus:ring-primary/50 border-none bg-[#f0f3f4] dark:bg-gray-800 h-full placeholder:text-[#617c89] px-4 rounded-l-none pl-2 text-base font-normal leading-normal"
                    placeholder="Search for products..." />
            </div>
        </form>

        {{-- Wishlist --}}
        <a href="{{ route('user.wishlist.index') }}"
            class="relative inline-flex items-center justify-center w-10 h-10 rounded-lg
           {{ $isWishlistPage ? 'bg-red-50 text-red-600' : 'hover:bg-gray-100 text-gray-700 dark:text-gray-300 dark:hover:bg-gray-800' }}">
            <span style="font-size:18px;">❤️</span>

            @if ($wishlistCount > 0)
            <span class="absolute -top-2 -right-2 bg-red-600 text-white text-xs w-5 h-5 flex items-center justify-center rounded-full">
                {{ $wishlistCount }}
            </span>
            @endif
        </a>

        <div class="flex gap-2">
            {{-- Cart --}}
            <a href="{{ route('user.cart.index') }}"
                class="relative flex items-center justify-center rounded-lg h-10 w-10 bg-[#f0f3f4] dark:bg-gray-800 text-[#111618] dark:text-white hover:bg-primary hover:text-white transition-all">
                <span class="material-symbols-outlined">shopping_cart</span>

                <span class="absolute -top-1 -right-1 text-[10px] bg-primary text-white rounded-full px-1.5 py-0.5">
                    {{ $cartCount }}
                </span>
            </a>

            @guest
            <a href="{{ route('login') }}"
                class="flex min-w-[84px] max-w-[480px] items-center justify-center rounded-lg h-10 px-4 bg-primary text-white text-sm font-bold hover:bg-primary/90 transition-all">
                Sign In
            </a>
            @endguest

            @auth
            {{-- ✅ أيقونة الأدمن (للأدمن فقط) --}}
            @if($isAdmin)
            <a href="{{ url('/dashboard') }}"
                class="p-2 hover:bg-[#f0f3f4] dark:hover:bg-gray-800 rounded-lg transition-colors"
                title="Dashboard Panel">
                <span class="material-symbols-outlined">admin_panel_settings</span>
            </a>
            @endif

            {{-- Profile --}}
            <a href="{{ url('/profile') }}"
                class="p-2 hover:bg-[#f0f3f4] dark:hover:bg-gray-800 rounded-lg transition-colors"
                title="Profile">
                <span class="material-symbols-outlined">person</span>
            </a>
            @endauth
        </div>
    </div>
</header>