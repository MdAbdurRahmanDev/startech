@extends('layouts.admin')

@section('title', 'Process Refund')

@section('content')
<div class="p-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Process Refund Request</h2>
        <a href="{{ route('admin.refunds.index') }}" class="text-blue-600 hover:underline text-sm flex items-center gap-1">
            <i class="fas fa-arrow-left text-[10px]"></i> Back to List
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2 space-y-6">
            {{-- Refund Status Update --}}
            <div class="bg-white rounded-lg shadow-sm border border-gray-100 p-6">
                <h3 class="text-lg font-bold text-gray-800 mb-4">Update Refund Status</h3>
                <form action="{{ route('admin.refunds.updateStatus', $refund->id) }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Status</label>
                        <select name="status" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white">
                            <option value="pending" {{ $refund->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="approved" {{ $refund->status == 'approved' ? 'selected' : '' }}>Approved</option>
                            <option value="rejected" {{ $refund->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Admin Note</label>
                        <textarea name="admin_note" rows="3" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Internal note or message to customer...">{{ $refund->admin_note }}</textarea>
                    </div>
                    <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg font-bold hover:bg-blue-700 transition-colors">
                        Update Refund Request
                    </button>
                </form>
            </div>

            {{-- Refund Reason --}}
            <div class="bg-white rounded-lg shadow-sm border border-gray-100 p-6">
                <h3 class="text-lg font-bold text-gray-800 mb-2">Refund Reason</h3>
                <div class="bg-gray-50 rounded-xl p-4 border border-gray-100 italic text-gray-700">
                    "{{ $refund->reason }}"
                </div>
            </div>

            {{-- Order Details --}}
            <div class="bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden">
                <div class="p-4 border-b border-gray-100 bg-gray-50 flex justify-between items-center">
                    <h3 class="font-bold text-gray-800">Original Order #{{ $refund->order->order_number }}</h3>
                    <a href="{{ route('admin.orders.show', $refund->order_id) }}" class="text-xs text-blue-600 font-bold hover:underline">View Full Order</a>
                </div>
                <table class="min-w-full divide-y divide-gray-200 text-sm">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">Product</th>
                            <th class="px-6 py-3 text-center font-medium text-gray-500 uppercase tracking-wider">Qty</th>
                            <th class="px-6 py-3 text-right font-medium text-gray-500 uppercase tracking-wider">Total</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($refund->order->items as $item)
                            <tr>
                                <td class="px-6 py-3 text-gray-800">{{ $item->product_name }}</td>
                                <td class="px-6 py-3 text-gray-800 text-center">{{ $item->quantity }}</td>
                                <td class="px-6 py-3 text-gray-900 font-bold text-right">{{ number_format($item->price * $item->quantity, 0) }}৳</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot class="bg-gray-50">
                        <tr class="font-bold text-accent-orange">
                            <td colspan="2" class="px-6 py-3 text-right uppercase">Refund Amount</td>
                            <td class="px-6 py-3 text-right">{{ number_format($refund->amount, 0) }}৳</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>

        <div class="space-y-6">
            {{-- Customer Card --}}
            <div class="bg-white rounded-lg shadow-sm border border-gray-100 p-6">
                <h3 class="text-lg font-bold text-gray-800 mb-4 pb-2 border-b border-gray-100">Customer Info</h3>
                <div class="space-y-3 text-sm">
                    <div>
                        <p class="text-gray-500 text-xs font-bold uppercase tracking-wider">Name</p>
                        <p class="text-gray-900 font-semibold">{{ $refund->user->name }}</p>
                    </div>
                    <div>
                        <p class="text-gray-500 text-xs font-bold uppercase tracking-wider">Phone</p>
                        <p class="text-gray-900 font-semibold">{{ $refund->user->phone }}</p>
                    </div>
                    <div>
                        <p class="text-gray-500 text-xs font-bold uppercase tracking-wider">Email</p>
                        <p class="text-gray-900 font-semibold">{{ $refund->user->email }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
