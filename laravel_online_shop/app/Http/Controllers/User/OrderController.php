<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;

use Illuminate\Http\Request;

class OrderController extends Controller
{
     public function index(Request $request)
    {
        $orders = Order::where('user_id', $request->user()->id)
            ->latest()
            ->paginate(5);

        return view('user.orders.index', compact('orders'));
    }

    public function show(Request $request, Order $order)
    {
        abort_unless($order->user_id === $request->user()->id, 403);

        $order->load('items');

        return view('user.orders.show', compact('order'));
    }

    public function success(Request $request, Order $order)
    {
        // حماية: المستخدم ما يشوف إلا طلبه
        abort_unless($order->user_id === $request->user()->id, 403);

        // لو تحب تعرض العناصر داخل صفحة النجاح
        $order->load('items');

        return view('user.orders.success', compact('order'));
    }
}
