@extends('layouts.account')

@section('title', 'My Address | Iosbd')

@section('breadcrumb_extra')
    <i class="fas fa-chevron-right opacity-30"></i>
    <span>Address</span>
@endsection

@section('account_content')
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-6 border-b border-gray-50 flex items-center justify-between">
            <h2 class="text-xl font-bold text-gray-800">My Address</h2>
            <p class="text-xs text-gray-400">Update your default shipping address</p>
        </div>

        <div class="p-6">
            @if (session('success'))
                <div
                    class="bg-green-50 border border-green-100 text-green-700 px-4 py-3 rounded-xl mb-6 text-sm font-medium flex items-center gap-2">
                    <i class="fas fa-check-circle"></i>
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('user.address.update') }}" method="POST">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="md:col-span-2">
                        <label class="block text-sm font-bold text-gray-700 mb-2">Full Address <span
                                class="text-red-500">*</span></label>
                        <textarea name="address" rows="3" required
                            class="w-full border border-gray-200 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-accent-blue/20 focus:border-accent-blue transition-all text-sm"
                            placeholder="House #, Road #, Area...">{{ old('address', $user->address) }}</textarea>
                        @error('address')
                            <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Upazila / Thana <span
                                class="text-red-500">*</span></label>
                        <input type="text" name="upazila" value="{{ old('upazila', $user->upazila) }}" required
                            class="w-full border border-gray-200 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-accent-blue/20 focus:border-accent-blue transition-all text-sm">
                        @error('upazila')
                            <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">District <span
                                class="text-red-500">*</span></label>
                        <input type="text" name="district" value="{{ old('district', $user->district) }}" required
                            class="w-full border border-gray-200 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-accent-blue/20 focus:border-accent-blue transition-all text-sm">
                        @error('district')
                            <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="flex items-center justify-end gap-4 mt-8">
                    <button type="submit"
                        class="bg-accent-blue text-white px-8 py-3 rounded-lg font-bold hover:bg-blue-700 transition-all shadow-lg shadow-blue-100 text-sm">
                        Save Address
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="mt-8 bg-blue-50 border border-blue-100 rounded-2xl p-6 flex items-start gap-4 animate-fade-in">
        <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center text-blue-600 text-xl shrink-0">
            <i class="fas fa-shipping-fast"></i>
        </div>
        <div>
            <h4 class="font-bold text-blue-900 mb-1">Fast Checkout</h4>
            <p class="text-sm text-blue-700 leading-relaxed">
                By saving your address here, we will automatically pre-fill your information during checkout. This makes
                your shopping experience much faster and easier!
            </p>
        </div>
    </div>
@endsection
