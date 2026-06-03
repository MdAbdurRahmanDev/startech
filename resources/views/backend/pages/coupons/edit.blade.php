@extends('layouts.admin')
@section('title', 'Edit Coupon')
@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-heading">Edit Coupon: {{ $coupon->code }}</h1>
    <p class="text-sm text-body mt-1">Update the coupon details below.</p>
</div>

<form action="{{ route('admin.coupons.update', $coupon) }}" method="POST" class="max-w-2xl">
    @csrf @method('PUT')
    <div class="bg-white rounded-lg shadow-sm border border-default p-6 space-y-5">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div>
                <label class="block text-xs font-bold text-gray-600 mb-1.5">Coupon Code <span class="text-red-500">*</span></label>
                <input type="text" name="code" value="{{ old('code', $coupon->code) }}" required
                    class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm font-mono uppercase focus:outline-none focus:border-fg-brand @error('code') border-red-400 @enderror">
                @error('code') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-600 mb-1.5">Discount Type <span class="text-red-500">*</span></label>
                <select name="type" required id="coupon-type" class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:border-fg-brand">
                    <option value="flat" {{ $coupon->type == 'flat' ? 'selected' : '' }}>Flat Amount (৳)</option>
                    <option value="percent" {{ $coupon->type == 'percent' ? 'selected' : '' }}>Percentage (%)</option>
                </select>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div>
                <label class="block text-xs font-bold text-gray-600 mb-1.5">Discount Value <span class="text-red-500">*</span></label>
                <input type="number" name="value" value="{{ old('value', $coupon->value) }}" step="0.01" min="1" required
                    class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:border-fg-brand">
            </div>

            <div id="max-discount-wrap" style="opacity: {{ $coupon->type === 'percent' ? '1' : '0.4' }}">
                <label class="block text-xs font-bold text-gray-600 mb-1.5">Max Discount Cap (৳)</label>
                <input type="number" name="max_discount" value="{{ old('max_discount', $coupon->max_discount) }}" step="0.01" min="0"
                    class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:border-fg-brand">
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div>
                <label class="block text-xs font-bold text-gray-600 mb-1.5">Minimum Order Amount (৳)</label>
                <input type="number" name="min_order" value="{{ old('min_order', $coupon->min_order) }}" step="0.01" min="0"
                    class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:border-fg-brand">
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-600 mb-1.5">Max Uses</label>
                <input type="number" name="max_uses" value="{{ old('max_uses', $coupon->max_uses) }}" min="1" placeholder="Unlimited"
                    class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:border-fg-brand">
                <p class="text-xs text-gray-400 mt-1">Used {{ $coupon->used_count }} times so far.</p>
            </div>
        </div>

        <div>
            <label class="block text-xs font-bold text-gray-600 mb-1.5">Expiry Date</label>
            <input type="date" name="expires_at" value="{{ old('expires_at', $coupon->expires_at?->format('Y-m-d')) }}"
                class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:border-fg-brand">
        </div>

        <div class="flex gap-3 pt-2">
            <button type="submit" class="px-8 py-2.5 bg-fg-brand text-white font-bold rounded-lg hover:bg-opacity-90 shadow-sm">
                Save Changes
            </button>
            <a href="{{ route('admin.coupons.index') }}" class="px-8 py-2.5 bg-gray-100 text-gray-700 font-bold rounded-lg hover:bg-gray-200">
                Cancel
            </a>
        </div>
    </div>
</form>

@push('scripts')
<script>
    document.getElementById('coupon-type').addEventListener('change', function() {
        document.getElementById('max-discount-wrap').style.opacity = this.value === 'percent' ? '1' : '0.4';
    });
</script>
@endpush
@endsection
