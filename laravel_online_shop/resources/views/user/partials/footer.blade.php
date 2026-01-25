<footer class="bg-white dark:bg-background-dark border-t border-gray-200 dark:border-gray-800 pt-12 pb-8 px-10">
    <div class="max-w-[1200px] mx-auto grid grid-cols-1 md:grid-cols-4 gap-12 mb-12">
        <div class="flex flex-col gap-4">
            <div class="flex items-center gap-2 text-primary">
                <span class="material-symbols-outlined text-2xl">shopping_bag</span>
                <span class="text-xl font-bold text-[#111618] dark:text-white">
                    {{ $siteSettings->site_name ?? 'Laravel Store' }}
                </span>
            </div>
            <p class="text-sm text-gray-500 dark:text-gray-400">
                {{ $siteSettings->address ?? 'The premium destination for minimalist lifestyle essentials. High quality, sustainably sourced, and beautifully designed.' }}
            </p>
        </div>

        <div>
            <h4 class="font-bold mb-4 text-[#111618] dark:text-white">Shop</h4>
            <ul class="text-sm text-gray-500 dark:text-gray-400 space-y-2">
                <li><a class="hover:text-primary" href="{{ route('user.products.index') }}">All Products</a></li>
                <li><a class="hover:text-primary" href="{{ route('user.products.index', ['sort' => 'new']) }}">New Arrivals</a></li>
                <li><a class="hover:text-primary" href="{{ route('user.products.index', ['sort' => 'best']) }}">Best Sellers</a></li>
                <li><a class="hover:text-primary" href="{{ route('user.products.index', ['sort' => 'sale']) }}">Sales & Offers</a></li>
            </ul>
        </div>

        <div>
            <h4 class="font-bold mb-4 text-[#111618] dark:text-white">Support</h4>
            <ul class="text-sm text-gray-500 dark:text-gray-400 space-y-2">
                <li><a class="hover:text-primary" href="#">Help Center</a></li>
                <li><a class="hover:text-primary" href="#">Shipping Info</a></li>
                <li><a class="hover:text-primary" href="#">Returns & Refunds</a></li>
                <li><a class="hover:text-primary" href="{{ route('user.pages.contact') }}">Contact Us</a></li>
            </ul>
        </div>

        <div>
            <h4 class="font-bold mb-4 text-[#111618] dark:text-white">Connect</h4>
            <div class="flex gap-4">
                <a class="bg-gray-100 dark:bg-gray-800 p-2 rounded-full text-gray-600 dark:text-gray-400 hover:bg-primary hover:text-white transition-colors"
                   href="{{ $siteSettings->facebook ?? '#' }}" target="_blank" rel="noopener">
                    <span class="material-symbols-outlined text-xl">social_leaderboard</span>
                </a>
                <a class="bg-gray-100 dark:bg-gray-800 p-2 rounded-full text-gray-600 dark:text-gray-400 hover:bg-primary hover:text-white transition-colors"
                   href="{{ $siteSettings->instagram ?? '#' }}" target="_blank" rel="noopener">
                    <span class="material-symbols-outlined text-xl">share_reviews</span>
                </a>
                <a class="bg-gray-100 dark:bg-gray-800 p-2 rounded-full text-gray-600 dark:text-gray-400 hover:bg-primary hover:text-white transition-colors"
                   href="mailto:{{ $siteSettings->contact_email ?? '' }}">
                    <span class="material-symbols-outlined text-xl">alternate_email</span>
                </a>
            </div>
        </div>
    </div>

    <div class="border-t border-gray-100 dark:border-gray-800 pt-8 text-center text-xs text-gray-400">
        <p>{{ $siteSettings->copyright_text ?? ('© '.date('Y').' Laravel Store. All rights reserved.') }}</p>
    </div>
</footer>
