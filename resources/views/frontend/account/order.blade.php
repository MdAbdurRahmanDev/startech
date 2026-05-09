@extends('layouts.account')

@section('title', 'Order History | Star Tech')

@section('breadcrumb_extra')
    <i class="fas fa-chevron-right"></i>
    <span>Order History</span>
@endsection

@section('account_content')
@if(session('success'))
    <div class="bg-green-50 border border-green-100 text-green-700 px-4 py-3 rounded-xl mb-6 text-sm font-medium flex items-center gap-2">
        <i class="fas fa-check-circle"></i>
        {{ session('success') }}
    </div>
@endif
@if(session('error'))
    <div class="bg-red-50 border border-red-100 text-red-700 px-4 py-3 rounded-xl mb-6 text-sm font-medium flex items-center gap-2">
        <i class="fas fa-exclamation-circle"></i>
        {{ session('error') }}
    </div>
@endif

<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="p-6 border-b border-gray-50 flex items-center justify-between">
        <h2 class="text-xl font-bold text-gray-800">Order History</h2>
        <div class="text-xs text-gray-400">Total: {{ $orders->total() }} Orders</div>
    </div>
    
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead class="bg-gray-50 text-[11px] font-bold text-gray-500 uppercase tracking-wider">
                <tr>
                    <th class="px-6 py-4">Order ID</th>
                    <th class="px-6 py-4">Customer</th>
                    <th class="px-6 py-4">Items</th>
                    <th class="px-6 py-4">Status</th>
                    <th class="px-6 py-4 text-right">Total</th>
                    <th class="px-6 py-4">Date</th>
                    <th class="px-6 py-4 text-center">Action</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($orders as $order)
                    <tr class="hover:bg-gray-50 transition-colors group">
                        <td class="px-6 py-4">
                            <span class="text-sm font-bold text-gray-900">#{{ $order->order_number }}</span>
                        </td>
                        <td class="px-6 py-4">
                            <p class="text-sm text-gray-700 font-medium">{{ $order->first_name }} {{ $order->last_name }}</p>
                            <p class="text-[10px] text-gray-400">{{ $order->phone }}</p>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="text-xs font-bold text-gray-500 bg-gray-100 px-2 py-1 rounded">{{ $order->items->count() }}</span>
                        </td>
                        <td class="px-6 py-4">
                            @php
                                $statusClasses = [
                                    'pending' => 'bg-yellow-50 text-yellow-700 border-yellow-100',
                                    'on_the_way' => 'bg-blue-50 text-blue-700 border-blue-100',
                                    'delivered' => 'bg-green-50 text-green-700 border-green-100',
                                    'rejected' => 'bg-red-50 text-red-700 border-red-100',
                                ];
                            @endphp
                            <span class="px-2.5 py-1 rounded-full text-[10px] font-bold uppercase border {{ $statusClasses[$order->status] ?? 'bg-gray-50 text-gray-600 border-gray-100' }}">
                                {{ str_replace('_', ' ', $order->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <span class="text-sm font-bold text-accent-orange">{{ number_format($order->total, 0) }}৳</span>
                        </td>
                        <td class="px-6 py-4">
                            <p class="text-xs text-gray-500">{{ $order->created_at->format('d M, Y') }}</p>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <div class="flex items-center justify-center gap-2">
                                <a href="#" class="w-8 h-8 rounded-full bg-gray-50 flex items-center justify-center text-gray-400 group-hover:bg-accent-orange group-hover:text-white transition-all shadow-sm" title="View Order">
                                    <i class="fa fa-eye text-sm"></i>
                                </a>
                                @if(!$order->refundRequest)
                                    <a href="{{ route('user.order.refund', $order->id) }}" 
                                       class="px-3 py-1 bg-red-50 text-red-600 rounded text-[10px] font-bold border border-red-100 hover:bg-red-600 hover:text-white transition-all">
                                        Refund
                                    </a>
                                @else
                                    <span class="px-2 py-0.5 bg-gray-100 text-gray-500 rounded text-[9px] font-bold uppercase border border-gray-200" 
                                          title="Refund status: {{ $order->refundRequest->status }}">
                                        Refund {{ $order->refundRequest->status }}
                                    </span>
                                @endif
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center gap-3">
                                <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center text-gray-300 text-2xl">
                                    <i class="fas fa-shopping-bag"></i>
                                </div>
                                <p class="text-gray-400 text-sm font-medium">You have not made any previous orders!</p>
                                <a href="{{ url('/') }}" class="mt-2 text-accent-blue text-xs font-bold hover:underline">Start Shopping</a>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($orders->hasPages())
        <div class="p-6 border-t border-gray-50 bg-gray-50/50">
            {{ $orders->links() }}
        </div>
    @endif
</div>

<div class="mt-8 flex justify-end">
    <a href="{{ url('/account/account') }}" class="bg-accent-blue text-white px-8 py-3 rounded-lg font-bold hover:bg-blue-700 transition-all shadow-lg shadow-blue-100 text-sm">
        Continue to Account
    </a>
</div>
@endsection
