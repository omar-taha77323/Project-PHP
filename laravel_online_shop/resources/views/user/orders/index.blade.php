@extends('user.layouts.app')

@section('content')
<main class="px-6 md:px-10 py-8" dir="ltr">
    <div class="max-w-6xl mx-auto">

        {{-- Breadcrumb --}}
        <div class="text-sm text-gray-500 mb-4">
            Home <span class="mx-1">/</span> Account <span class="mx-1">/</span> <span class="text-gray-800">My Orders</span>
        </div>

        {{-- Header --}}
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
            <div>
                <h1 class="text-3xl font-black tracking-tight">Order History</h1>
                <p class="text-gray-500 mt-1 text-sm">
                    You have placed {{ $orders->total() }} orders in total.
                </p>
            </div>

            <div class="flex items-center gap-3">
                {{-- Search --}}
                <form method="GET" action="{{ route('user.orders.index') }}" class="relative">
                    <input
                        type="text"
                        name="q"
                        value="{{ request('q') }}"
                        placeholder="Search orders..."
                        class="w-64 h-11 rounded-xl border bg-gray-50 pl-10 pr-3 text-sm outline-none focus:bg-white"
                    />
                    <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-[20px]">search</span>

                    {{-- keep status --}}
                    @if(request('status'))
                        <input type="hidden" name="status" value="{{ request('status') }}">
                    @endif
                </form>

                <a href="{{ url('/') }}"
                   class="h-11 px-4 rounded-xl bg-primary text-white font-bold inline-flex items-center gap-2">
                    <span class="material-symbols-outlined text-[20px]">shopping_bag</span>
                    Start Shopping
                </a>
            </div>
        </div>

        {{-- Tabs --}}
        @php
            $active = request('status','all');
            $tabs = [
                'all' => 'All Orders',
                'progress' => 'In Progress',
                'completed' => 'Completed',
                'cancelled' => 'Cancelled',
            ];
        @endphp

        <div class="border-b mb-4">
            <div class="flex items-center gap-6 text-sm font-bold">
                @foreach($tabs as $key => $label)
                    <a href="{{ route('user.orders.index', array_filter(['status'=>$key, 'q'=>request('q')])) }}"
                       class="pb-3 border-b-2 {{ $active===$key ? 'border-primary text-primary' : 'border-transparent text-gray-500 hover:text-gray-800' }}">
                        {{ $label }}
                    </a>
                @endforeach
            </div>
        </div>

        {{-- Table --}}
        <div class="bg-white border rounded-2xl overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm">
                    <thead class="bg-gray-50 text-gray-500">
                        <tr>
                            <th class="text-left font-bold px-6 py-4">ORDER ID</th>
                            <th class="text-left font-bold px-6 py-4">DATE</th>
                            <th class="text-left font-bold px-6 py-4">TOTAL</th>
                            <th class="text-left font-bold px-6 py-4">STATUS</th>
                            <th class="text-left font-bold px-6 py-4">PAYMENT METHOD</th>
                            <th class="text-right font-bold px-6 py-4">ACTIONS</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y">
                        @forelse($orders as $order)
                            @php
                                $method = match($order->payment_method) {
                                    'cod' => 'Cash',
                                    'card' => 'Card',
                                    'wallet' => 'Wallet',
                                    default => $order->payment_method
                                };

                                // status badge style
                                $badge = 'bg-gray-100 text-gray-700';
                                if(($order->status ?? '') === 'completed') $badge = 'bg-green-50 text-green-700';
                                elseif(($order->status ?? '') === 'pending' || ($order->status ?? '') === 'progress') $badge = 'bg-yellow-50 text-yellow-700';
                                elseif(($order->status ?? '') === 'cancelled') $badge = 'bg-red-50 text-red-700';
                            @endphp

                            <tr class="hover:bg-gray-50/50 transition">
                                <td class="px-6 py-5 font-bold text-gray-900">
                                    #ORD-{{ $order->id }}
                                </td>
                                <td class="px-6 py-5 text-gray-600">
                                    {{ $order->created_at->format('M d, Y') }}
                                </td>
                                <td class="px-6 py-5 font-black">
                                    ${{ number_format($order->total, 2) }}
                                </td>
                                <td class="px-6 py-5">
                                    <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full text-xs font-bold {{ $badge }}">
                                        <span class="w-2 h-2 rounded-full bg-current opacity-50"></span>
                                        {{ $order->status ?? 'pending' }}
                                    </span>
                                </td>
                                <td class="px-6 py-5 text-gray-700">
                                    {{ $method }}
                                </td>
                                <td class="px-6 py-5 text-right">
                                    <a href="{{ route('user.orders.show', $order) }}"
                                       class="text-primary font-bold hover:underline">
                                        View Details
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-10 text-center text-gray-500">
                                    No orders found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Footer / Pagination --}}
            <div class="px-6 py-4 border-t bg-white">
                {{ $orders->appends(request()->query())->links() }}
            </div>
        </div>

        {{-- Help box --}}
        <div class="mt-8 bg-blue-50 border border-blue-100 rounded-2xl p-5 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div class="flex items-start gap-3">
                <div class="w-10 h-10 rounded-xl bg-white border flex items-center justify-center">
                    <span class="material-symbols-outlined text-[22px] text-primary">support_agent</span>
                </div>
                <div>
                    <div class="font-black">Need help with an order?</div>
                    <div class="text-sm text-gray-600 mt-1">Our support team is available for your assistance.</div>
                </div>
            </div>

            <a href="{{ url('/contact') }}"
               class="h-11 px-4 rounded-xl bg-white border font-bold hover:bg-gray-50 transition">
                Contact Support
            </a>
        </div>

    </div>
</main>
@endsection
