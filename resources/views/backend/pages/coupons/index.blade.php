@extends('layouts.admin')

@section('title', 'Coupon Management')

@section('content')
<div class="mb-6 flex items-center justify-between">
    <div>
        <h1 class="text-2xl font-bold text-heading">Coupon Management</h1>
        <p class="text-sm text-body mt-1">Create and manage discount coupons.</p>
    </div>
    <a href="{{ route('admin.coupons.create') }}" class="bg-fg-brand text-white px-5 py-2.5 rounded-lg font-semibold text-sm hover:bg-opacity-90 flex items-center gap-2 shadow-sm">
        <i class="fas fa-plus"></i> Add Coupon
    </a>
</div>

@if(session('success'))
    <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg mb-4 text-sm">
        <i class="fas fa-check-circle mr-1"></i> {{ session('success') }}
    </div>
@endif

<div class="bg-white rounded-lg shadow-sm border border-default overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left">
            <thead class="bg-neutral-primary-soft border-b border-default text-xs text-body font-bold uppercase tracking-wider">
                <tr>
                    <th class="px-5 py-3">Code</th>
                    <th class="px-5 py-3">Type</th>
                    <th class="px-5 py-3">Value</th>
                    <th class="px-5 py-3">Min Order</th>
                    <th class="px-5 py-3">Uses</th>
                    <th class="px-5 py-3">Expires</th>
                    <th class="px-5 py-3">Status</th>
                    <th class="px-5 py-3">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse($coupons as $coupon)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-5 py-3 font-mono font-bold text-accent-blue text-sm">{{ $coupon->code }}</td>
                    <td class="px-5 py-3">
                        <span class="px-2 py-0.5 rounded-full text-[11px] font-bold {{ $coupon->type === 'percent' ? 'bg-purple-50 text-purple-600' : 'bg-blue-50 text-blue-600' }}">
                            {{ $coupon->type === 'percent' ? 'Percent (%)' : 'Flat (৳)' }}
                        </span>
                    </td>
                    <td class="px-5 py-3 font-bold text-gray-800">
                        {{ $coupon->type === 'percent' ? $coupon->value . '%' : number_format($coupon->value, 0) . '৳' }}
                        @if($coupon->max_discount && $coupon->type === 'percent')
                            <span class="text-[11px] text-gray-400 font-normal block">Max: {{ number_format($coupon->max_discount, 0) }}৳</span>
                        @endif
                    </td>
                    <td class="px-5 py-3 text-gray-600">{{ number_format($coupon->min_order, 0) }}৳</td>
                    <td class="px-5 py-3 text-gray-600">
                        {{ $coupon->used_count }}{{ $coupon->max_uses ? ' / ' . $coupon->max_uses : ' / ∞' }}
                    </td>
                    <td class="px-5 py-3 text-gray-600">
                        @if($coupon->expires_at)
                            <span class="{{ $coupon->expires_at->isPast() ? 'text-red-500' : 'text-gray-600' }}">
                                {{ $coupon->expires_at->format('d M Y') }}
                            </span>
                        @else
                            <span class="text-gray-400">No expiry</span>
                        @endif
                    </td>
                    <td class="px-5 py-3">
                        <form action="{{ route('admin.coupons.toggle', $coupon) }}" method="POST">
                            @csrf
                            <button type="submit" class="px-2.5 py-1 rounded-full text-[11px] font-bold {{ $coupon->status ? 'bg-green-50 text-green-600 hover:bg-green-100' : 'bg-red-50 text-red-500 hover:bg-red-100' }} transition-colors">
                                {{ $coupon->status ? 'Active' : 'Inactive' }}
                            </button>
                        </form>
                    </td>
                    <td class="px-5 py-3">
                        <div class="flex items-center gap-2">
                            <a href="{{ route('admin.coupons.edit', $coupon) }}" class="text-blue-500 hover:text-blue-700 text-xs font-semibold">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <form action="{{ route('admin.coupons.destroy', $coupon) }}" method="POST" onsubmit="return confirm('Delete this coupon?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700 text-xs font-semibold">
                                    <i class="fas fa-trash"></i> Delete
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="px-5 py-12 text-center text-gray-400">
                        <i class="fas fa-tag text-3xl mb-3 block opacity-30"></i>
                        No coupons created yet.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($coupons->hasPages())
        <div class="px-5 py-4 border-t border-default">{{ $coupons->links() }}</div>
    @endif
</div>
@endsection
