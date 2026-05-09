<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard(){
        $totalUsers = \App\Models\User::count();
        $totalCategories = \App\Models\Category::count();
        $totalBrands = \App\Models\Brand::count();
        $totalSuppliers = \App\Models\Supplier::count();
        $totalProducts = \App\Models\Product::count();
        
        // Order Stats (Counts)
        $pendingOrders = \App\Models\Order::where('status', 'pending')->count();
        $onTheWayOrders = \App\Models\Order::where('status', 'on_the_way')->count();
        $deliveredOrders = \App\Models\Order::where('status', 'delivered')->count();
        $rejectedOrders = \App\Models\Order::where('status', 'rejected')->count();
        $totalOrders = \App\Models\Order::count();

        // Order Stats (Amounts)
        $totalSales = \App\Models\Order::where('status', 'delivered')->sum('total');
        $pendingAmount = \App\Models\Order::where('status', 'pending')->sum('total');
        $onTheWayAmount = \App\Models\Order::where('status', 'on_the_way')->sum('total');
        $rejectedAmount = \App\Models\Order::where('status', 'rejected')->sum('total');

        // Refund Stats
        $approvedRefunds = \App\Models\RefundRequest::where('status', 'approved')->count();
        $pendingRefunds = \App\Models\RefundRequest::where('status', 'pending')->count();
        $rejectedRefunds = \App\Models\RefundRequest::where('status', 'rejected')->count();
        $approvedRefundAmount = \App\Models\RefundRequest::where('status', 'approved')->sum('amount');
        $pendingRefundAmount = \App\Models\RefundRequest::where('status', 'pending')->sum('amount');

        $recentUsers = \App\Models\User::latest()->take(10)->get();
        $recentOrders = \App\Models\Order::latest()->take(10)->get();

        return view("backend.dashboard", compact(
            'totalUsers', 'totalCategories', 'totalBrands', 'totalSuppliers', 'totalProducts', 
            'pendingOrders', 'onTheWayOrders', 'deliveredOrders', 'rejectedOrders', 'totalOrders',
            'totalSales', 'pendingAmount', 'onTheWayAmount', 'rejectedAmount',
            'recentUsers', 'recentOrders',
            'approvedRefunds', 'pendingRefunds', 'rejectedRefunds', 'approvedRefundAmount', 'pendingRefundAmount'
        ));
    }
}
