@extends('layouts.app')

@section('title', 'Order Success | Star Tech')

@section('content')
<div class="container py-16">
    <div class="max-w-xl mx-auto text-center">
        <div class="mb-6">
            <div class="w-20 h-20 bg-green-100 text-green-600 rounded-full flex items-center justify-center mx-auto text-4xl">
                <i class="fas fa-check-circle"></i>
            </div>
        </div>
        
        <h1 class="text-3xl font-bold text-gray-800 mb-2">Thank You for Your Order!</h1>
        <p class="text-gray-600 mb-8">Your order has been placed successfully. Our team will contact you shortly for confirmation.</p>
        
        <div class="bg-gray-50 border border-gray-200 rounded-lg p-6 mb-8 text-left">
            <div class="flex justify-between mb-2">
                <span class="text-gray-500">Order Number:</span>
                <span class="font-bold text-gray-800">#{{ $order->order_number }}</span>
            </div>
            <div class="flex justify-between mb-2">
                <span class="text-gray-500">Status:</span>
                <span class="px-2 py-0.5 bg-yellow-100 text-yellow-800 rounded text-xs font-bold uppercase">{{ $order->status }}</span>
            </div>
            <div class="flex justify-between">
                <span class="text-gray-500">Total Amount:</span>
                <span class="font-bold text-accent-orange">{{ number_format($order->total, 0) }}৳</span>
            </div>
        </div>
        
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ url('/') }}" class="bg-accent-blue text-white px-8 py-3 rounded font-bold hover:bg-blue-700 transition-colors">
                Continue Shopping
            </a>
            <a href="{{ route('user.order') }}" class="bg-white border border-gray-300 text-gray-700 px-8 py-3 rounded font-bold hover:bg-gray-50 transition-colors">
                View My Orders
            </a>
        </div>
    </div>
</div>
@endsection
