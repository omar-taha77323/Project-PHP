@extends('user.layouts.app')

@section('title', 'Home')

@section('content')
<!-- Hero Section -->
<section class="relative overflow-hidden gradient-bg">
    <div class="absolute inset-0 bg-black/20"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 md:py-32 relative z-10">
        <div class="text-center text-white">
            <h1 class="text-4xl md:text-6xl font-bold mb-6 leading-tight">
                Premium Electronics
                <span class="block text-primary-200">For Modern Living</span>
            </h1>
            <p class="text-lg md:text-xl text-white/80 mb-8 max-w-2xl mx-auto">
                Discover the latest tech innovations at unbeatable prices. Quality you can trust, service you deserve.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('user.products.index') }}" class="px-8 py-4 bg-white text-primary-600 font-semibold rounded-full hover:bg-gray-100 transition-all transform hover:scale-105 shadow-lg">
                    Shop Now
                </a>
                <a href="{{ route('user.categories.index') }}" class="px-8 py-4 bg-transparent border-2 border-white text-white font-semibold rounded-full hover:bg-white/10 transition-all">
                    Browse Categories
                </a>
            </div>
        </div>
    </div>
    
    <!-- Decorative elements -->
    <div class="absolute top-20 left-10 w-72 h-72 bg-white/10 rounded-full blur-3xl"></div>
    <div class="absolute bottom-20 right-10 w-96 h-96 bg-accent-500/20 rounded-full blur-3xl"></div>
</section>

<!-- Categories Section -->
@if($categories->count() > 0)
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Shop by Category</h2>
            <p class="text-gray-600 max-w-xl mx-auto">Find exactly what you need from our curated collections</p>
        </div>
        
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-6">
            @foreach($categories as $category)
            <a href="{{ route('user.categories.show', $category->id) }}" class="group">
                <div class="bg-gradient-to-br from-gray-50 to-gray-100 rounded-2xl p-6 text-center card-hover border border-gray-100">
                    <div class="w-16 h-16 mx-auto mb-4 bg-gradient-to-br from-primary-500 to-accent-600 rounded-full flex items-center justify-center group-hover:scale-110 transition-transform">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                    </div>
                    <h3 class="font-semibold text-gray-800 group-hover:text-primary-600 transition-colors">{{ $category->name }}</h3>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- Featured Products Section -->
@if($featuredProducts->count() > 0)
<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-12">
            <div>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-2">Featured Products</h2>
                <p class="text-gray-600">Handpicked selections just for you</p>
            </div>
            <a href="{{ route('user.products.index') }}" class="mt-4 md:mt-0 inline-flex items-center text-primary-600 font-semibold hover:text-primary-700">
                View All
                <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                </svg>
            </a>
        </div>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            @foreach($featuredProducts as $product)
            @include('user.partials.product-card', ['product' => $product])
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- Brands Section -->
@if($brands->count() > 0)
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Trusted Brands</h2>
            <p class="text-gray-600">Shop from the world's leading electronics brands</p>
        </div>
        
        <div class="flex flex-wrap justify-center items-center gap-8 md:gap-12">
            @foreach($brands as $brand)
            <div class="grayscale hover:grayscale-0 opacity-60 hover:opacity-100 transition-all duration-300">
                @if($brand->logo)
                <img src="{{ asset('storage/brands/' . $brand->logo) }}" alt="{{ $brand->name }}" class="h-12 w-auto">
                @else
                <span class="text-2xl font-bold text-gray-400">{{ $brand->name }}</span>
                @endif
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- CTA Section -->
<section class="py-20 gradient-bg relative overflow-hidden">
    <div class="absolute inset-0 bg-black/10"></div>
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
        <h2 class="text-3xl md:text-4xl font-bold text-white mb-6">Stay Updated</h2>
        <p class="text-white/80 mb-8 text-lg">Subscribe to our newsletter for exclusive deals and latest products</p>
        <form class="flex flex-col sm:flex-row gap-4 max-w-md mx-auto">
            <input type="email" placeholder="Enter your email" class="flex-1 px-6 py-4 rounded-full outline-none focus:ring-4 focus:ring-white/30">
            <button type="submit" class="px-8 py-4 bg-gray-900 text-white font-semibold rounded-full hover:bg-gray-800 transition-colors">
                Subscribe
            </button>
        </form>
    </div>
</section>
@endsection
