@php
    $hideFooter = true;
@endphp

@extends('user.layouts.app')

@section('content')
<main class="min-h-[70vh] px-6 md:px-10 py-14" dir="ltr">
    <div class="max-w-2xl mx-auto">
        <div class="bg-white border rounded-2xl p-8 md:p-10 text-center shadow-sm">
            <div class="text-7xl font-black text-gray-900">404</div>

            <h1 class="text-2xl md:text-3xl font-black mt-3">
                Page Not Found
            </h1>

            <p class="text-gray-600 mt-3 leading-relaxed">
                The page you are looking for doesn’t exist or has been moved.
            </p>

            <div class="mt-8 flex flex-col sm:flex-row gap-3 justify-center">
                <a href="{{ url('/') }}"
                   class="h-12 px-6 rounded-xl bg-primary text-white font-black inline-flex items-center justify-center hover:bg-primary/90 transition">
                    Back to Home
                </a>

                <a href="{{ url('/shop') }}"
                   class="h-12 px-6 rounded-xl bg-gray-100 text-gray-900 font-black inline-flex items-center justify-center hover:bg-gray-200 transition">
                    Go to Shop
                </a>
            </div>

            <div class="mt-7 text-sm text-gray-500">
                If you think this is a mistake,
                <a href="{{ url('/contact') }}" class="text-primary font-bold hover:underline">contact us</a>.
            </div>
        </div>
    </div>
</main>
@endsection
