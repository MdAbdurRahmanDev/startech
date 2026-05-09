<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderTrackingController extends Controller
{
    public function index()
    {
        return view('frontend.pages.tracking.index');
    }

    public function track(Request $request)
    {
        $request->validate([
            'order_number' => 'required|string',
            'phone' => 'required|string',
        ]);

        $order = Order::where('order_number', $request->order_number)
            ->where('phone', $request->phone)
            ->first();

        if (!$order) {
            return back()->with('error', 'Order not found with these details. Please check your Invoice No and Phone No.');
        }

        return view('frontend.pages.tracking.index', compact('order'));
    }
}
