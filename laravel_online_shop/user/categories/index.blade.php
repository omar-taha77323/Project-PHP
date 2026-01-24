@extends('user.layouts.app')

@section('title', 'Categories - Laravel Shop')

@section('content')
<main class="flex-1 w-full max-w-[1280px] mx-auto px-4 sm:px-6 lg:px-10 py-8">

    {{-- Breadcrumbs --}}
    <nav class="flex items-center gap-2 mb-6">
        <a class="text-[#617c89] dark:text-gray-400 text-sm font-medium hover:text-primary transition-colors flex items-center"
           href="{{ route('user.home') }}">
            <span class="material-symbols-outlined text-base mr-1">home</span>
            Home
        </a>
        <span class="text-[#617c89] dark:text-gray-600">/</span>
        <span class="text-[#111618] dark:text-white text-sm font-semibold">Categories</span>
    </nav>

    {{-- Page Heading & Search Bar --}}
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-10">
        <div class="space-y-2">
            <h1 class="text-4xl font-black tracking-tight">Shop by Category</h1>
            <p class="text-[#617c89] dark:text-gray-400 text-lg">
                Browse through our curated collections ({{ $categories->count() }} Available)
            </p>
        </div>

        {{-- فلترة (Front فقط) --}}
        <div class="w-full md:w-80">
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-[#617c89]">
                    <span class="material-symbols-outlined">filter_list</span>
                </div>
                <input id="categoryFilter"
                       class="w-full h-12 pl-12 pr-4 bg-white dark:bg-white/5 border border-gray-200 dark:border-white/10 rounded-xl focus:ring-2 focus:ring-primary transition-all text-base"
                       placeholder="Filter categories..."
                       type="text" />
            </div>
        </div>
    </div>

    {{-- Categories Image Grid --}}
    <div id="categoriesGrid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">

        @forelse($categories as $category)
            @php
                // لا نفترض وجود صورة في DB: نستخدم placeholder ثابت
                // لو عندكم صور محلية لاحقاً غيّر هذا السطر فقط.
                $fallback = asset('images/category-placeholder.png');
            @endphp

            <a href="{{ route('user.categories.show', $category->id) }}"
               class="category-card group relative overflow-hidden rounded-xl bg-white dark:bg-white/5 shadow-sm hover:shadow-xl transition-all duration-300"
               data-name="{{ strtolower($category->name) }}">

                <div class="aspect-square w-full overflow-hidden">
                    <div class="w-full h-full bg-cover bg-center transition-transform duration-500 group-hover:scale-110"
                         style='background-image:
                            linear-gradient(0deg, rgba(0,0,0,0.70) 0%, rgba(0,0,0,0) 50%),
                            url("{{ $fallback }}");'>
                    </div>
                </div>

                <div class="absolute inset-0 flex flex-col justify-end p-6">
                    <p class="text-white/80 text-xs font-bold uppercase tracking-widest mb-1">
                        {{ number_format($category->products_count ?? 0) }} Products
                    </p>

                    <h3 class="text-white text-2xl font-bold mb-4">
                        {{ $category->name }}
                    </h3>

                    <div class="opacity-0 translate-y-4 group-hover:opacity-100 group-hover:translate-y-0 transition-all duration-300">
                        <div class="w-full bg-primary hover:bg-primary/90 text-white font-bold py-3 rounded-lg flex items-center justify-center gap-2">
                            Explore <span class="material-symbols-outlined text-lg">chevron_right</span>
                        </div>
                    </div>
                </div>
            </a>
        @empty
            <div class="col-span-full text-center py-16 text-[#617c89] dark:text-gray-400">
                No categories found.
            </div>
        @endforelse

    </div>

    {{-- Footer Section (Static like design) --}}
    <div class="mt-16 flex flex-col items-center justify-center gap-6 border-t border-[#f0f3f4] dark:border-white/10 pt-10 pb-20">
        <p class="text-[#617c89] dark:text-gray-400">
            Showing {{ min(8, $categories->count()) }} of {{ $categories->count() }} categories
        </p>

        {{-- زر شكلي فقط (لو تبغى pagination لاحقاً نربطه) --}}
        <button type="button"
                class="px-10 py-3 bg-white dark:bg-white/5 border border-primary text-primary font-bold rounded-lg hover:bg-primary hover:text-white transition-all">
            Load More Categories
        </button>
    </div>

    {{-- فلترة بسيطة بالـ JS داخل الصفحة (اختياري) --}}
    <script>
        (function () {
            const input = document.getElementById('categoryFilter');
            const cards = document.querySelectorAll('.category-card');

            if (!input) return;

            input.addEventListener('input', function () {
                const q = (this.value || '').toLowerCase().trim();
                cards.forEach(card => {
                    const name = card.getAttribute('data-name') || '';
                    card.style.display = name.includes(q) ? '' : 'none';
                });
            });
        })();
    </script>

</main>
@endsection
