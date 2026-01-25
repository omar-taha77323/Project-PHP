<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = session('cart', []);

        if (empty($cart)) {
            return redirect()->route('user.cart.index')
                ->with('error', 'سلتك فارغة، أضف منتجات أولاً.');
        }

        $subtotal = collect($cart)->sum(fn ($item) => ((float)$item['price']) * ((int)$item['qty']));
        $discount = 0;
        $shipping_fee = 0; // لاحقاً ممكن تحسبه
        $total = ($subtotal - $discount) + $shipping_fee;

        return view('user.checkout.index', compact('cart', 'subtotal', 'discount', 'shipping_fee', 'total'));
    }

    public function store(Request $request)
    {
        $cart = session('cart', []);

        if (empty($cart)) {
            return redirect()->route('user.cart.index')
                ->with('error', 'سلتك فارغة، لا يمكن إتمام الطلب.');
        }

        $request->validate([
            'shipping_name'    => ['required', 'string', 'max:191'],
            'shipping_phone'   => ['required', 'string', 'max:191'],
            'shipping_address' => ['required', 'string'],
            'shipping_city'    => ['required', 'string', 'max:191'],
            'shipping_notes'   => ['nullable', 'string'],

            'payment_method'   => ['required', 'in:cod,card,wallet'],
        ]);

        $subtotal = collect($cart)->sum(fn ($item) => ((float)$item['price']) * ((int)$item['qty']));
        $discount = 0;
        $shipping_fee = 0;
        $total = ($subtotal - $discount) + $shipping_fee;

        // دفع وهمي:
        $paymentStatus = $request->payment_method === 'cod' ? 'unpaid' : 'paid';

        $order = DB::transaction(function () use (
            $request, $cart, $subtotal, $discount, $shipping_fee, $total, $paymentStatus
        ) {
            $order = Order::create([
                'user_id' => auth()->id(),

                'subtotal' => $subtotal,
                'discount' => $discount,
                'shipping_fee' => $shipping_fee,
                'total' => $total,

                'status' => 'pending',

                'payment_method' => $request->payment_method,
                'payment_status' => $paymentStatus,

                'shipping_name' => $request->shipping_name,
                'shipping_phone' => $request->shipping_phone,
                'shipping_address' => $request->shipping_address,
                'shipping_city' => $request->shipping_city,
                'shipping_notes' => $request->shipping_notes,
            ]);

            foreach ($cart as $item) {
                $qty = (int) $item['qty'];
                $unit = (float) $item['price'];

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => (int) $item['product_id'],
                    'product_name' => $item['name'],
                    'unit_price' => $unit,
                    'qty' => $qty,
                    'total' => $unit * $qty,
                ]);
            }

            return $order;
        });

        // فضي السلة بعد نجاح الطلب
        session()->forget('cart');

        // مؤقتاً نرجّع للسلة برسالة نجاح (وبعدين نسوي صفحة success)
       return redirect()->route('user.orders.success', $order);
    }
}
