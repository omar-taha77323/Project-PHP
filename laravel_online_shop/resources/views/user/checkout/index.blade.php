@extends('user.layouts.app')

@section('content')
<main class="px-10 py-8">
    <h1 class="text-2xl font-bold mb-6">Checkout</h1>

    @if(session('error'))
        <div class="p-4 mb-4 rounded-lg bg-red-50 text-red-700">{{ session('error') }}</div>
    @endif

    <div class="grid grid-cols-12 gap-8">
        <div class="col-span-12 lg:col-span-7">
            <div class="bg-white rounded-xl border p-5">
                <h2 class="text-lg font-bold mb-4">Cart Items</h2>

                <div class="space-y-3">
                    @foreach($cart as $item)
                        <div class="flex justify-between items-center border rounded-lg p-3">
                            <div>
                                <div class="font-semibold">{{ $item['name'] }}</div>
                                <div class="text-sm text-gray-500">
                                    Qty: {{ $item['qty'] }} • ${{ number_format($item['price'], 2) }}
                                </div>
                            </div>
                            <div class="font-bold">
                                ${{ number_format($item['price'] * $item['qty'], 2) }}
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-6 border-t pt-4 space-y-2 text-sm">
                    <div class="flex justify-between"><span>Subtotal</span><span class="font-semibold">${{ number_format($subtotal, 2) }}</span></div>
                    <div class="flex justify-between"><span>Discount</span><span class="font-semibold">${{ number_format($discount, 2) }}</span></div>
                    <div class="flex justify-between"><span>Shipping</span><span class="font-semibold">${{ number_format($shipping_fee, 2) }}</span></div>
                    <div class="flex justify-between text-base"><span class="font-bold">Total</span><span class="font-black text-primary">${{ number_format($total, 2) }}</span></div>
                </div>
            </div>
        </div>

        <div class="col-span-12 lg:col-span-5">
            <form method="POST" action="{{ route('user.checkout.store') }}" class="bg-white rounded-xl border p-5 space-y-4">
                @csrf

                <h2 class="text-lg font-bold">Shipping Info</h2>

                <div>
                    <label class="text-sm font-medium">Full Name</label>
                    <input name="shipping_name" value="{{ old('shipping_name', auth()->user()->name) }}"
                           class="w-full mt-1 h-10 rounded-lg bg-gray-50 border px-3">
                    @error('shipping_name') <div class="text-xs text-red-600 mt-1">{{ $message }}</div> @enderror
                </div>

                <div>
                    <label class="text-sm font-medium">Phone</label>
                    <input name="shipping_phone" value="{{ old('shipping_phone') }}"
                           class="w-full mt-1 h-10 rounded-lg bg-gray-50 border px-3">
                    @error('shipping_phone') <div class="text-xs text-red-600 mt-1">{{ $message }}</div> @enderror
                </div>

                <div>
                    <label class="text-sm font-medium">Address</label>
                    <textarea name="shipping_address" rows="3"
                              class="w-full mt-1 rounded-lg bg-gray-50 border px-3 py-2">{{ old('shipping_address') }}</textarea>
                    @error('shipping_address') <div class="text-xs text-red-600 mt-1">{{ $message }}</div> @enderror
                </div>

                <div>
                    <label class="text-sm font-medium">City</label>
                    <input name="shipping_city" value="{{ old('shipping_city') }}"
                           class="w-full mt-1 h-10 rounded-lg bg-gray-50 border px-3">
                    @error('shipping_city') <div class="text-xs text-red-600 mt-1">{{ $message }}</div> @enderror
                </div>

                <div>
                    <label class="text-sm font-medium">Notes (Optional)</label>
                    <textarea name="shipping_notes" rows="2"
                              class="w-full mt-1 rounded-lg bg-gray-50 border px-3 py-2">{{ old('shipping_notes') }}</textarea>
                </div>

                <div class="pt-2">
                    <h2 class="text-lg font-bold mb-2">Payment Method (Dummy)</h2>

                    <div class="space-y-2 text-sm">
                        <label class="flex items-center gap-2">
                            <input type="radio" name="payment_method" value="cod" {{ old('payment_method')==='cod'?'checked':'' }}>
                            Cash on Delivery
                        </label>

                        <label class="flex items-center gap-2">
                            <input type="radio" name="payment_method" value="card" {{ old('payment_method')==='card'?'checked':'' }}>
                            Card
                        </label>

                        <label class="flex items-center gap-2">
                            <input type="radio" name="payment_method" value="wallet" {{ old('payment_method')==='wallet'?'checked':'' }}>
                            Wallet
                        </label>
                    </div>

                    @error('payment_method') <div class="text-xs text-red-600 mt-1">{{ $message }}</div> @enderror
                </div>

                <button class="w-full h-12 bg-primary text-white font-bold rounded-xl hover:bg-primary/90 transition-all">
                    Place Order
                </button>
            </form>
        </div>
    </div>
</main>
@endsection
