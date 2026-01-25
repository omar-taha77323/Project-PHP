@extends('user.layouts.app')

@section('content')
<main class="min-h-[70vh] px-6 md:px-10 py-12" dir="ltr">
    <div class="max-w-xl mx-auto">

        <div class="bg-white border rounded-2xl shadow-sm p-8 md:p-10 text-center">
            {{-- Icon --}}
            <div class="mx-auto w-20 h-20 rounded-full bg-green-50 flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                </svg>
            </div>

            <h1 class="text-3xl font-black mt-6">Order Successful!</h1>

            <p class="text-gray-600 mt-3 leading-relaxed">
                Thank you for your purchase. Your order has been placed successfully.
                You can view it anytime from <span class="font-bold">My Orders</span>.
            </p>

            {{-- Order number card --}}
            <div class="mt-7 border rounded-2xl p-5 bg-gray-50 text-left flex items-center justify-between gap-4">
                <div>
                    <div class="font-black text-gray-900">
                        Order Number: <span class="text-primary">#ORD-{{ $order->id }}</span>
                    </div>

                    <div class="text-sm text-gray-600 mt-2">
                        Placed on: {{ $order->created_at->format('M d, Y \a\t h:i A') }}
                    </div>

                    <div class="text-sm text-gray-600 mt-1">
                        Estimated delivery: 3-5 business days
                    </div>
                </div>

                <div class="shrink-0">
                    <img
                        src="{{ asset('images/box.jpg') }}"  {{-- ← هنا تحط اسم الصورة حقك --}}
                        alt="Package"
                        class="w-20 h-20 object-cover rounded-xl border"
                    >
                </div>
            </div>

            {{-- Buttons --}}
            <div class="mt-8 flex flex-col sm:flex-row gap-3 justify-center">
                <a href="{{ url('/') }}"
                   class="h-12 px-6 rounded-xl bg-primary text-white font-black inline-flex items-center justify-center hover:bg-primary/90 transition">
                    Continue Shopping
                </a>

                <a href="{{ route('user.orders.index') }}"
                   class="h-12 px-6 rounded-xl bg-gray-100 text-gray-900 font-black inline-flex items-center justify-center hover:bg-gray-200 transition">
                    My Orders
                </a>
            </div>

            {{-- Support --}}
            <div class="mt-7 text-sm text-gray-500">
                Need help?
                <a href="{{ url('/contact') }}" class="text-primary font-bold hover:underline">
                    Contact our support team
                </a>
            </div>
        </div>

    </div>
</main>
@endsection
