@extends('user.layouts.app')

@section('content')
    <main class="px-6 md:px-10 py-8" dir="ltr">
        <div class="max-w-6xl mx-auto">

            {{-- Breadcrumb --}}
            <div class="text-sm text-gray-500 mb-4">
                Home <span class="mx-1">/</span>
                Account <span class="mx-1">/</span>
                <a href="{{ route('user.orders.index') }}" class="hover:underline">My Orders</a>
                <span class="mx-1">/</span>
                <span class="text-gray-800 font-semibold">#ORD-{{ $order->id }}</span>
            </div>

            @php
                $status = $order->status ?? 'pending';

                $statusBadge = 'bg-yellow-50 text-yellow-700';
                if (in_array($status, ['completed', 'delivered'])) {
                    $statusBadge = 'bg-green-50 text-green-700';
                }
                if ($status === 'cancelled') {
                    $statusBadge = 'bg-red-50 text-red-700';
                }

                $method = match ($order->payment_method) {
                    'cod' => 'Cash',
                    'card' => 'Card',
                    'wallet' => 'Wallet',
                    default => $order->payment_method,
                };

                $payStatus = $order->payment_status ?? 'unpaid';
                $payBadge = $payStatus === 'paid' ? 'bg-green-50 text-green-700' : 'bg-yellow-50 text-yellow-700';
            @endphp

            {{-- Header bar (title + actions) --}}
            <div class="bg-white border rounded-2xl p-5 md:p-6 mb-6">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <div>
                        <div class="flex items-center gap-3 flex-wrap">
                            <h1 class="text-2xl md:text-3xl font-black tracking-tight">
                                Order #ORD-{{ $order->id }}
                            </h1>

                            <span
                                class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full text-xs font-bold border {{ $statusBadge }}">
                                <span class="w-2 h-2 rounded-full bg-current opacity-50"></span>
                                {{ $status }}
                            </span>

                            <span
                                class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full text-xs font-bold border {{ $payBadge }}">
                                {{ $payStatus }}
                            </span>
                        </div>

                        <p class="text-gray-500 mt-2 text-sm">
                            Placed on {{ $order->created_at->format('M d, Y \a\t h:i A') }}
                            <span class="mx-2">•</span>
                            Payment: <span class="font-bold">{{ $method }}</span>
                        </p>
                    </div>

                    {{-- Actions moved into header card --}}
                    <div class="flex items-center gap-3">
                        <a href="{{ route('user.orders.index') }}"
                            class="h-11 px-4 rounded-xl border font-bold hover:bg-gray-50 transition inline-flex items-center gap-2">
                            <span class="material-symbols-outlined text-[20px]">arrow_back</span>
                            Back
                        </a>

                        <button onclick="window.print()"
                            class="h-11 px-4 rounded-xl bg-gray-900 text-white font-bold hover:bg-gray-800 transition inline-flex items-center gap-2">
                            <span class="material-symbols-outlined text-[20px]">print</span>
                            Print
                        </button>
                    </div>
                </div>
            </div>

            {{-- 2 columns: Shipping + Totals --}}
            <div class="grid grid-cols-12 gap-6 mb-6">
                {{-- Shipping --}}
                <div class="col-span-12 lg:col-span-8 bg-white border rounded-2xl p-5">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="font-black text-lg">Shipping Information</h2>
                        <a href="{{ url('/contact') }}" class="text-sm text-primary font-bold hover:underline">
                            Contact Support
                        </a>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                        <div class="p-4 rounded-xl border bg-gray-50">
                            <div class="text-xs text-gray-500">Full Name</div>
                            <div class="font-bold mt-1">{{ $order->shipping_name }}</div>
                        </div>

                        <div class="p-4 rounded-xl border bg-gray-50">
                            <div class="text-xs text-gray-500">Phone</div>
                            <div class="font-bold mt-1">{{ $order->shipping_phone }}</div>
                        </div>

                        <div class="p-4 rounded-xl border bg-gray-50 md:col-span-2">
                            <div class="text-xs text-gray-500">Address</div>
                            <div class="font-bold mt-1">
                                {{ $order->shipping_address }} — {{ $order->shipping_city }}
                            </div>
                        </div>

                        @if ($order->shipping_notes)
                            <div class="p-4 rounded-xl border bg-gray-50 md:col-span-2">
                                <div class="text-xs text-gray-500">Notes</div>
                                <div class="font-bold mt-1">{{ $order->shipping_notes }}</div>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Totals (no Order Again button) --}}
                <div class="col-span-12 lg:col-span-4 bg-white border rounded-2xl p-5">
                    <h2 class="font-black text-lg mb-4">Payment Summary</h2>

                    <div class="space-y-3 text-sm">
                        <div class="flex justify-between">
                            <span class="text-gray-500">Subtotal</span>
                            <span class="font-bold">${{ number_format($order->subtotal, 2) }}</span>
                        </div>

                        <div class="flex justify-between">
                            <span class="text-gray-500">Shipping</span>
                            <span class="font-bold">${{ number_format($order->shipping_fee, 2) }}</span>
                        </div>

                        <div class="flex justify-between">
                            <span class="text-gray-500">Discount</span>
                            <span class="font-bold">-${{ number_format($order->discount, 2) }}</span>
                        </div>

                        <div class="border-t pt-4 flex justify-between items-end">
                            <span class="font-black">Total</span>
                            <span class="text-3xl font-black text-primary">${{ number_format($order->total, 2) }}</span>
                        </div>

                        <div class="pt-3 text-xs text-gray-500">
                            Items: <span class="font-bold text-gray-700">{{ $order->items?->count() ?? 0 }}</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Items Table (NO IMAGES) --}}
            <div class="bg-white border rounded-2xl overflow-hidden">
                <div class="px-6 py-4 bg-gray-50 border-b flex items-center justify-between">
                    <h2 class="font-black text-lg">Order Items</h2>
                    <span class="text-sm text-gray-600">
                        Total items: <span class="font-bold">{{ $order->items?->count() ?? 0 }}</span>
                    </span>
                </div>

                <div class="overflow-x-auto max-h-[260px] overflow-y-auto relative">
                    <div class="absolute bottom-0 left-0 right-0 h-6 bg-gradient-to-t from-white pointer-events-none"></div>
                    <table class="min-w-full text-sm">
                        <table class="min-w-full text-sm">
                            <thead class="text-gray-500 bg-white">
                                <tr class="border-b">
                                    <th class="text-left font-bold px-6 py-4">PRODUCT</th>
                                    <th class="text-center font-bold px-6 py-4">QTY</th>
                                    <th class="text-right font-bold px-6 py-4">PRICE</th>
                                    <th class="text-right font-bold px-6 py-4">TOTAL</th>
                                </tr>
                            </thead>

                            <tbody class="divide-y">
                                @foreach ($order->items as $item)
                                    <tr class="hover:bg-gray-50/50 transition">
                                        <td class="px-6 py-4">
                                            <div class="font-bold text-gray-900">{{ $item->product_name }}</div>
                                        </td>
                                        <td class="px-6 py-4 text-center font-bold">{{ $item->qty }}</td>
                                        <td class="px-6 py-4 text-right">${{ number_format($item->unit_price, 2) }}</td>
                                        <td class="px-6 py-4 text-right font-black">${{ number_format($item->total, 2) }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                </div>
            </div>

        </div>
    </main>
@endsection
