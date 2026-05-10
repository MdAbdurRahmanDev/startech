@extends('layouts.admin')

@section('title', 'Order Details')

@section('content')
<div class="p-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Order #{{ $order->order_number }}</h2>
        <a href="{{ route('admin.orders.index') }}" class="text-blue-600 hover:underline text-sm flex items-center gap-1">
            <i class="fas fa-arrow-left text-[10px]"></i> Back to Orders
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        {{-- Order Status --}}
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white rounded-lg shadow-sm border border-gray-100 p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-bold text-gray-800">Status Update</h3>
                    @php
                        $statusClasses = [
                            'pending' => 'bg-yellow-100 text-yellow-800',
                            'on_the_way' => 'bg-blue-100 text-blue-800',
                            'delivered' => 'bg-green-100 text-green-800',
                            'rejected' => 'bg-red-100 text-red-800',
                        ];
                    @endphp
                    <span class="px-3 py-1 rounded-full text-xs font-bold uppercase {{ $statusClasses[$order->status] }}">
                        {{ str_replace('_', ' ', $order->status) }}
                    </span>
                </div>
                
                <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST" class="flex items-center gap-3">
                    @csrf
                    <select name="status" class="flex-1 border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white">
                        <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="on_the_way" {{ $order->status == 'on_the_way' ? 'selected' : '' }}>On The Way</option>
                        <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }}>Delivered</option>
                        <option value="rejected" {{ $order->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                    </select>
                    <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg font-bold hover:bg-blue-700 transition-colors">
                        Update
                    </button>
                </form>
            </div>

            {{-- Items --}}
            <div class="bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden">
                <div class="p-4 border-b border-gray-100 bg-gray-50">
                    <h3 class="font-bold text-gray-800">Order Items</h3>
                </div>
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Product</th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Quantity</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Price</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($order->items as $item)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">
                                    {{ $item->product_name }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 text-center">
                                    {{ $item->quantity }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 text-right">
                                    {{ number_format($item->price, 0) }}৳
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-900 text-right">
                                    {{ number_format($item->price * $item->quantity, 0) }}৳
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot class="bg-gray-50 font-bold">
                        <tr>
                            <td colspan="3" class="px-6 py-3 text-right text-sm text-gray-600 uppercase">Subtotal</td>
                            <td class="px-6 py-3 text-right text-sm text-gray-900">{{ number_format($order->subtotal, 0) }}৳</td>
                        </tr>
                        <tr>
                            <td colspan="3" class="px-6 py-3 text-right text-sm text-gray-600 uppercase">Shipping ({{ $order->shippingMethod->name ?? 'Delivery' }})</td>
                            <td class="px-6 py-3 text-right text-sm text-gray-900">{{ number_format($order->shipping_cost, 0) }}৳</td>
                        </tr>
                        <tr class="bg-blue-50 text-blue-900 text-lg">
                            <td colspan="3" class="px-6 py-4 text-right uppercase">Grand Total</td>
                            <td class="px-6 py-4 text-right text-accent-orange font-bold">{{ number_format($order->total, 0) }}৳</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>

        {{-- Customer Info --}}
        <div class="space-y-6">
            <div class="bg-white rounded-lg shadow-sm border border-gray-100 p-6">
                <h3 class="text-lg font-bold text-gray-800 mb-4 pb-2 border-b border-gray-100">Customer Info</h3>
                <div class="space-y-3 text-sm">
                    <div>
                        <p class="text-gray-500 mb-0.5 text-xs font-bold uppercase tracking-wider">Full Name</p>
                        <p class="text-gray-900 font-semibold">{{ $order->first_name }} {{ $order->last_name }}</p>
                    </div>
                    <div>
                        <p class="text-gray-500 mb-0.5 text-xs font-bold uppercase tracking-wider">Phone</p>
                        <p class="text-gray-900 font-semibold">{{ $order->phone }}</p>
                    </div>
                    <div>
                        <p class="text-gray-500 mb-0.5 text-xs font-bold uppercase tracking-wider">Email</p>
                        <p class="text-gray-900 font-semibold">{{ $order->email }}</p>
                    </div>
                </div>
            </div>

            {{-- Payment Details --}}
            <div class="bg-white rounded-lg shadow-sm border border-gray-100 p-6">
                <h3 class="text-lg font-bold text-gray-800 mb-4 pb-2 border-b border-gray-100">Payment Details</h3>
                <div class="space-y-4">
                    <div>
                        <p class="text-gray-500 mb-1 text-xs font-bold uppercase tracking-wider">Payment Method</p>
                        <div class="flex items-center gap-2">
                            <span class="bg-blue-50 text-blue-700 px-3 py-1 rounded font-bold text-sm border border-blue-100">
                                {{ str_replace('_', ' ', $order->payment_method) }}
                            </span>
                            @if($order->payment_method == 'cash_on_delivery')
                                <span class="text-[10px] text-gray-400 font-bold uppercase">Pay on Receipt</span>
                            @endif
                        </div>
                    </div>

                    @if($order->transaction_id)
                    <div>
                        <p class="text-gray-500 mb-1 text-xs font-bold uppercase tracking-wider">Transaction ID (TrxID)</p>
                        <div class="bg-accent-orange/5 border border-accent-orange/20 p-3 rounded-lg flex items-center justify-between">
                            <code class="text-accent-orange font-bold text-base">{{ $order->transaction_id }}</code>
                            <button onclick="navigator.clipboard.writeText('{{ $order->transaction_id }}')" class="text-accent-orange hover:text-orange-700 p-1" title="Copy to clipboard">
                                <i class="fas fa-copy"></i>
                            </button>
                        </div>
                    </div>
                    @endif

                    <div>
                        <p class="text-gray-500 mb-1 text-xs font-bold uppercase tracking-wider">Payment Status</p>
                        @php
                            $pStatusClasses = [
                                'pending' => 'bg-gray-100 text-gray-800',
                                'awaiting_confirmation' => 'bg-purple-100 text-purple-800',
                                'paid' => 'bg-green-100 text-green-800',
                                'failed' => 'bg-red-100 text-red-800',
                            ];
                        @endphp
                        <span class="px-3 py-1 rounded-full text-xs font-bold uppercase {{ $pStatusClasses[$order->payment_status] ?? 'bg-gray-100' }}">
                            {{ str_replace('_', ' ', $order->payment_status) }}
                        </span>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-sm border border-gray-100 p-6">
                <h3 class="text-lg font-bold text-gray-800 mb-4 pb-2 border-b border-gray-100">Delivery Address</h3>
                <div class="space-y-3 text-sm">
                    <div>
                        <p class="text-gray-500 mb-0.5 text-xs font-bold uppercase tracking-wider">Address</p>
                        <p class="text-gray-900 font-semibold leading-relaxed">{{ $order->address }}</p>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <p class="text-gray-500 mb-0.5 text-xs font-bold uppercase tracking-wider">Upazila</p>
                            <p class="text-gray-900 font-semibold">{{ $order->upazila ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <p class="text-gray-500 mb-0.5 text-xs font-bold uppercase tracking-wider">District</p>
                            <p class="text-gray-900 font-semibold">{{ $order->district ?? 'N/A' }}</p>
                        </div>
                    </div>
                    @if($order->note)
                    <div>
                        <p class="text-gray-500 mb-0.5 text-xs font-bold uppercase tracking-wider">Order Note</p>
                        <p class="text-gray-700 italic">"{{ $order->note }}"</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
