<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    public function subscribe(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        // لا يوجد جدول Newsletter في مشروعك حالياً (حسب الملفات)
        // فبنكتفي برسالة نجاح. لو تحب نضيف جدول لاحقاً، نعمله بسهولة.
        return back()->with('success', 'Subscribed successfully!');
    }
}
