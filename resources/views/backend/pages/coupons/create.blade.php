@extends('layouts.admin')
@section('title', 'Add Coupon')
@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-heading">Add New Coupon</h1>
    <p class="text-sm text-body mt-1">Create a new discount coupon for your customers.</p>
</div>

<form action="{{ route('admin.coupons.store') }}" method="POST" class="max-w-2xl">
    @csrf
    <div class="bg-white rounded-lg shadow-sm border border-default p-6 space-y-5">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div>
                <label class="block text-xs font-bold text-gray-600 mb-1.5">Coupon Code <span class="text-red-500">*</span></label>
                <input type="text" name="code" value="{{ old('code') }}" placeholder="e.g. SAVE20" required
                    class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm font-mono uppercase focus:outline-none focus:border-fg-brand @error('code') border-red-400 @enderror">
                @error('code') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                <p class="text-gray-400 text-xs mt-1">Will be stored in UPPERCASE automatically.</p>
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-600 mb-1.5">Discount Type <span class="text-red-500">*</span></label>
                <select name="type" required class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:border-fg-brand" id="coupon-type">
                    <option value="flat" {{ old('type') == 'flat' ? 'selected' : '' }}>Flat Amount (৳)</option>
                    <option value="percent" {{ old('type') == 'percent' ? 'selected' : '' }}>Percentage (%)</option>
                </select>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div>
                <label class="block text-xs font-bold text-gray-600 mb-1.5">Discount Value <span class="text-red-500">*</span></label>
                <input type="number" name="value" value="{{ old('value') }}" placeholder="e.g. 200 or 10" step="0.01" min="1" required
                    class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:border-fg-brand @error('value') border-red-400 @enderror">
                @error('value') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div id="max-discount-wrap">
                <label class="block text-xs font-bold text-gray-600 mb-1.5">Max Discount Cap (৳) <span class="text-gray-400 font-normal">— for % type only</span></label>
                <input type="number" name="max_discount" value="{{ old('max_discount') }}" placeholder="e.g. 500 (optional)" step="0.01" min="0"
                    class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:border-fg-brand">
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div>
                <label class="block text-xs font-bold text-gray-600 mb-1.5">Minimum Order Amount (৳)</label>
                <input type="number" name="min_order" value="{{ old('min_order', 0) }}" placeholder="e.g. 1000" step="0.01" min="0"
                    class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:border-fg-brand">
                <p class="text-gray-400 text-xs mt-1">Set 0 for no minimum.</p>
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-600 mb-1.5">Max Uses <span class="text-gray-400 font-normal">— leave blank for unlimited</span></label>
                <input type="number" name="max_uses" value="{{ old('max_uses') }}" placeholder="e.g. 100" min="1"
                    class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:border-fg-brand">
            </div>
        </div>

        <div>
            <label class="block text-xs font-bold text-gray-600 mb-1.5">Expiry Date <span class="text-gray-400 font-normal">— leave blank for no expiry</span></label>
            <input type="date" name="expires_at" value="{{ old('expires_at') }}"
                class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:border-fg-brand">
        </div>

        <div class="flex gap-3 pt-2">
            <button type="submit" class="px-8 py-2.5 bg-fg-brand text-white font-bold rounded-lg hover:bg-opacity-90 shadow-sm">
                Create Coupon
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
