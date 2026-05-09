<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderInvoiceController extends Controller
{
    public function show($id)
    {
        $order = Order::with(['items.product', 'user'])->findOrFail($id);

        // Check if user is owner or admin
        if (Auth::guard('admin')->check() || (Auth::check() && Auth::id() == $order->user_id)) {
            return view('frontend.account.invoice.show', compact('order'));
        }

        abort(403);
    }

    public function download($id)
    {
        $order = Order::with(['items.product', 'user'])->findOrFail($id);

        if (Auth::guard('admin')->check() || (Auth::check() && Auth::id() == $order->user_id)) {
            // For now, we will return the view as a printable HTML
            // In a real production app, you might use barryvdh/laravel-dompdf
            return view('frontend.account.invoice.print', compact('order'));
        }

        abort(403);
    }
}
