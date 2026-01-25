@extends('user.layouts.app')

@section('content')
    <main class="max-w-[1280px] mx-auto px-4 sm:px-6 lg:px-10 py-8">

        {{-- Breadcrumbs --}}
        <nav class="flex flex-wrap gap-2 py-4 mb-2">
            <a class="text-[#617c89] text-sm font-medium hover:text-primary" href="{{ route('user.home') }}">Home</a>
            <span class="text-[#617c89] text-sm font-medium">/</span>
            <span class="text-[#111618] text-sm font-medium">Shopping Cart</span>
        </nav>

        {{-- Page Heading --}}
        <div class="flex flex-col gap-1 mb-8">
            <h1 class="text-[#111618] text-3xl md:text-4xl font-black leading-tight tracking-[-0.033em]">
                Your Shopping Cart
            </h1>
            <p class="text-[#617c89] text-base font-normal">
                Manage the items in your current session
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
            {{-- ✅ LEFT (كبرنا المساحة: 8 من 12) --}}
            <section class="lg:col-span-8 w-full">
                <div class="bg-white rounded-xl border border-[#dbe2e6] overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead class="bg-[#f6f7f8]">
                                <tr>
                                    <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-[#617c89]">
                                        Product</th>
                                    <th
                                        class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-[#617c89] hidden sm:table-cell">
                                        Price</th>
                                    <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-[#617c89]">
                                        Quantity</th>
                                    <th
                                        class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-[#617c89] text-right">
                                        Total</th>
                                    <th class="px-6 py-4"></th>
                                </tr>
                            </thead>

                            <tbody class="divide-y divide-[#dbe2e6]">
                                @forelse($cart as $item)
                                    @php
                                        $id = $item['product_id'];
                                        $qty = (int) ($item['qty'] ?? 1);
                                        $price = (float) ($item['price'] ?? 0);
                                        $rowTotal = $price * $qty;
                                        $img = $item['image'] ?? null;
                                    @endphp

                                    <tr class="hover:bg-[#f6f7f8]/40 transition-colors">
                                        <td class="px-6 py-5">
                                            <div class="flex items-center gap-4">
                                                <div
                                                    class="w-16 h-16 rounded-lg bg-[#f0f3f4] border border-[#f0f3f4] overflow-hidden flex items-center justify-center">
                                                    @if ($img)
                                                        <img src="{{ asset('storage/' . $img) }}"
                                                            class="w-full h-full object-cover" alt="">
                                                    @else
                                                        <span class="text-[#617c89] text-xs">No image</span>
                                                    @endif
                                                </div>

                                                <div class="flex flex-col">
                                                    <span class="text-[#111618] font-bold text-base leading-tight">
                                                        {{ $item['name'] ?? 'Product' }}
                                                    </span>
                                                    <span class="text-[#617c89] text-xs">
                                                        ID: {{ $id }}
                                                    </span>
                                                    <span class="sm:hidden mt-1 text-primary font-semibold text-sm">
                                                        ${{ number_format($price, 2) }}
                                                    </span>
                                                </div>
                                            </div>
                                        </td>

                                        <td class="px-6 py-5 hidden sm:table-cell text-[#617c89] font-medium">
                                            ${{ number_format($price, 2) }}
                                        </td>

                                        <td class="px-6 py-5">
                                            <form action="{{ route('user.cart.update', $id) }}" method="POST"
                                                class="inline-flex items-center gap-2">
                                                @csrf
                                                @method('PATCH')

                                                <div
                                                    class="flex items-center border border-[#dbe2e6] rounded-lg overflow-hidden">
                                                    <button type="button"
                                                        class="p-1 px-2 text-[#617c89] hover:bg-[#f0f3f4] flex items-center"
                                                        onclick="var i=this.parentElement.querySelector('input'); i.value=Math.max(1, parseInt(i.value||1)-1); this.closest('form').submit();">
                                                        <span class="material-symbols-outlined text-[18px]">remove</span>
                                                    </button>

                                                    <input name="qty"
                                                        class="w-12 text-center border-none bg-transparent p-0 text-sm font-bold text-[#111618] focus:ring-0"
                                                        type="text" value="{{ $qty }}" />

                                                    <button type="button"
                                                        class="p-1 px-2 text-[#617c89] hover:bg-[#f0f3f4] flex items-center"
                                                        onclick="var i=this.parentElement.querySelector('input'); i.value=Math.min(99, parseInt(i.value||1)+1); this.closest('form').submit();">
                                                        <span class="material-symbols-outlined text-[18px]">add</span>
                                                    </button>
                                                </div>
                                            </form>
                                        </td>

                                        <td class="px-6 py-5 text-right font-bold text-[#111618]">
                                            ${{ number_format($rowTotal, 2) }}
                                        </td>

                                        <td class="px-6 py-5 text-right">
                                            <form action="{{ route('user.cart.remove', $id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="text-[#617c89] hover:text-red-500 transition-colors"
                                                    type="submit">
                                                    <span class="material-symbols-outlined">delete</span>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-10 text-center text-[#617c89]">
                                            Your cart is empty.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="p-4 bg-[#f6f7f8]/40">
                        <a class="inline-flex items-center gap-2 text-primary font-semibold text-sm hover:underline"
                            href="{{ route('user.products.index') }}">
                            <span class="material-symbols-outlined text-[18px]">arrow_back</span>
                            Continue Shopping
                        </a>
                    </div>
                </div>
            </section>

            {{-- ✅ RIGHT (صغرناه: 4 من 12) + Total أكبر --}}
            <aside class="lg:col-span-4 w-full lg:sticky lg:top-24">
                <div class="bg-white rounded-xl border border-[#dbe2e6] p-6 shadow-sm">
                    <h2 class="text-[#111618] text-xl font-bold mb-6">Order Summary</h2>

                    <div class="flex flex-col gap-4 mb-6">
                        <div class="flex justify-between items-center">
                            <span class="text-[#617c89] font-medium">Subtotal</span>
                            <span class="text-[#111618] font-semibold">${{ number_format($subtotal ?? 0, 2) }}</span>
                        </div>

                        <div class="flex justify-between items-center text-sm">
                            <span class="text-[#617c89]">Shipping</span>
                            <span class="text-green-600 font-medium">Calculated at next step</span>
                        </div>

                        <div class="flex justify-between items-center text-sm">
                            <span class="text-[#617c89]">Taxes</span>
                            <span class="text-[#111618] font-medium">$0.00</span>
                        </div>
                    </div>

                    <div class="mb-6 pt-6 border-t border-[#f0f3f4]">
                        <p class="text-sm font-semibold text-[#111618] mb-3">Promo Code</p>
                        <div class="flex gap-2">
                            <input
                                class="form-input flex-1 h-10 bg-[#f0f3f4] border-none rounded-lg text-sm placeholder:text-[#617c89] focus:ring-1 focus:ring-primary"
                                placeholder="Enter code" type="text" />
                            <button
                                class="h-10 px-4 bg-[#f0f3f4] text-[#111618] text-sm font-bold rounded-lg hover:bg-primary/10 transition-colors">
                                Apply
                            </button>
                        </div>
                    </div>

                    {{-- ✅ Total أكبر مثل طلبك --}}
                    <div class="pt-6 border-t border-[#f0f3f4] mb-8">
                        <div class="flex justify-between items-end mb-2">
                            <span class="text-[#111618] text-lg font-bold">Total</span>
                            <span class="text-primary text-4xl font-black leading-none">
                                ${{ number_format($total ?? 0, 2) }}
                            </span>
                        </div>
                        <p class="text-[#617c89] text-[11px] leading-normal uppercase tracking-widest font-semibold">
                            Session ID: #{{ strtoupper(substr(md5(session()->getId()), 0, 8)) }}
                        </p>
                    </div>

                    <a href="{{ route('user.checkout.index') }}"
                        class="w-full h-12 bg-primary text-white font-bold rounded-xl shadow-lg shadow-primary/20 hover:bg-primary/90 transition-all flex items-center justify-center gap-2 group">
                        Proceed to Checkout
                        <span
                            class="material-symbols-outlined text-[20px] group-hover:translate-x-1 transition-transform">chevron_right</span>
                    </a>


                    <div class="mt-6 flex flex-col gap-3">
                        <div class="flex items-center gap-3 text-[#617c89] text-xs">
                            <span class="material-symbols-outlined text-[18px]">lock</span>
                            Secure encrypted checkout
                        </div>
                        <div class="flex items-center gap-3 text-[#617c89] text-xs">
                            <span class="material-symbols-outlined text-[18px]">local_shipping</span>
                            Free delivery on orders over $1,000
                        </div>
                    </div>
                </div>

                <div class="mt-4 p-4 bg-primary/10 border border-primary/20 rounded-xl">
                    <p class="text-[#13a4ec] text-xs font-medium leading-relaxed">
                        <strong>Session Note:</strong> Items in your cart are temporarily stored for this session.
                    </p>
                </div>
            </aside>
        </div>
    </main>
@endsection
