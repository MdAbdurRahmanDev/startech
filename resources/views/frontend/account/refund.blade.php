@extends('layouts.account')

@section('title', 'Request Refund | Star Tech')

@section('breadcrumb_extra')
    <i class="fas fa-chevron-right opacity-30"></i>
    <a href="{{ route('user.order') }}" class="hover:text-accent-orange transition-colors">Order History</a>
    <i class="fas fa-chevron-right opacity-30"></i>
    <span>Request Refund</span>
@endsection

@section('account_content')
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="p-6 border-b border-gray-50">
        <h2 class="text-xl font-bold text-gray-800">Request Refund for Order #{{ $order->order_number }}</h2>
    </div>
    
    <div class="p-6">
        <div class="bg-blue-50 border border-blue-100 rounded-xl p-4 mb-8 flex items-start gap-3">
            <i class="fas fa-info-circle text-blue-500 mt-1"></i>
            <div>
                <p class="text-sm text-blue-800 font-medium">Refund Information</p>
                <p class="text-xs text-blue-600 mt-1 leading-relaxed">
                    You are requesting a refund for <strong>{{ number_format($order->total, 0) }}৳</strong>. 
                    Please provide a valid reason for your refund request. Our team will review your request and get back to you within 3-5 business days.
                </p>
            </div>
        </div>

        <form action="{{ route('user.order.refund.store', $order->id) }}" method="POST">
            @csrf
            <div class="space-y-6">
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Reason for Refund <span class="text-red-500">*</span></label>
                    <textarea name="reason" rows="5" required minlength="10"
                              class="w-full border border-gray-200 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-accent-blue/20 focus:border-accent-blue transition-all text-sm"
                              placeholder="Please describe why you are requesting a refund (minimum 10 characters)..."></textarea>
                    @error('reason')
                        <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-end gap-4 pt-4">
                    <a href="{{ route('user.order') }}" class="text-sm font-bold text-gray-400 hover:text-gray-600 transition-colors">Cancel</a>
                    <button type="submit" class="bg-accent-blue text-white px-8 py-3 rounded-lg font-bold hover:bg-blue-700 transition-all shadow-lg shadow-blue-100 text-sm">
                        Submit Refund Request
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
