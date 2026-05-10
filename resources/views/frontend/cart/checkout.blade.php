@extends('layouts.app')

@section('title', 'Checkout | Iosbd')

@section('styles')
    <style>
        @media (max-width: 1023px) {
            .checkout-sidebar {
                flex: 1 1 100% !important;
                max-width: 100% !important;
            }
        }
    </style>
@endsection

@section('content')
    <div class="pb-14">
        <h1 class="text-[20px] font-bold text-gray-800 py-4">Checkout</h1>

        <!-- Warning Notice -->
        <div class="bg-[#e8f5e9] border border-[#c8e6c9] text-[13px] text-gray-700 px-4 py-3 rounded mb-4 leading-relaxed">
            <i class="fas fa-info-circle text-green-600 mr-1"></i>
            কারিগরি ত্রুটির কারণে পণ্যের মূল্য অসঙ্গতিপূর্ণ হলে, স্টার টেক কর্তৃপক্ষ অর্ডার বাতিলের অধিকার সংরক্ষণ করে।
            অনুগ্রহ করে কাস্টমার সাপোর্ট এজেন্টের কনফার্মেশন ব্যতীত কোনো ধরনের পেমেন্ট প্রদান না করার অনুরোধ করা হচ্ছে।
        </div>



        <form action="{{ route('order.place') }}" method="POST" id="checkoutForm">
            @csrf
            <div class="flex flex-col lg:flex-row gap-6 items-start">

                {{-- ── LEFT COLUMN ── --}}
                <div class="flex-1 min-w-0 space-y-5">

                    {{-- Shipping & Billing --}}
                    <div class="bg-white rounded-lg shadow-sm p-6">
                        <h2 class="text-[15px] font-bold text-gray-800 mb-5 flex items-center gap-2">
                            <i class="fas fa-map-marker-alt text-accent-orange"></i>
                            Shipping &amp; Billing
                        </h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-[12px] font-semibold text-gray-600 mb-1.5">First Name</label>
                                <input type="text" name="first_name" value="{{ auth()->user()->first_name ?? '' }}"
                                    placeholder="First Name*" required
                                    class="border border-gray-300 rounded px-3 py-2.5 text-[13px] w-full focus:outline-none focus:border-accent-blue transition-colors placeholder-gray-400">
                            </div>
                            <div>
                                <label class="block text-[12px] font-semibold text-gray-600 mb-1.5">Last Name</label>
                                <input type="text" name="last_name" value="{{ auth()->user()->last_name ?? '' }}"
                                    placeholder="Last Name*" required
                                    class="border border-gray-300 rounded px-3 py-2.5 text-[13px] w-full focus:outline-none focus:border-accent-blue transition-colors placeholder-gray-400">
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-[12px] font-semibold text-gray-600 mb-1.5">Address</label>
                                <input type="text" name="address" value="{{ auth()->user()->address ?? '' }}"
                                    placeholder="Address*" required
                                    class="border border-gray-300 rounded px-3 py-2.5 text-[13px] w-full focus:outline-none focus:border-accent-blue transition-colors placeholder-gray-400">
                            </div>
                            <div>
                                <label class="block text-[12px] font-semibold text-gray-600 mb-1.5">Upazila/Thana</label>
                                <input type="text" name="upazila" value="{{ auth()->user()->upazila ?? '' }}"
                                    placeholder="Upazila/Thana*"
                                    class="border border-gray-300 rounded px-3 py-2.5 text-[13px] w-full focus:outline-none focus:border-accent-blue transition-colors placeholder-gray-400">
                            </div>
                            <div>
                                <label class="block text-[12px] font-semibold text-gray-600 mb-1.5">District</label>
                                <input type="text" name="district" value="{{ auth()->user()->district ?? '' }}"
                                    placeholder="District*" required
                                    class="border border-gray-300 rounded px-3 py-2.5 text-[13px] w-full focus:outline-none focus:border-accent-blue transition-colors placeholder-gray-400">
                            </div>
                            <div>
                                <label class="block text-[12px] font-semibold text-gray-600 mb-1.5">Mobile</label>
                                <input type="tel" name="phone" value="{{ auth()->user()->phone ?? '' }}"
                                    placeholder="Telephone*" required
                                    class="border border-gray-300 rounded px-3 py-2.5 text-[13px] w-full focus:outline-none focus:border-accent-blue transition-colors placeholder-gray-400">
                            </div>
                            <div>
                                <label class="block text-[12px] font-semibold text-gray-600 mb-1.5">Email</label>
                                <input type="email" name="email" value="{{ auth()->user()->email ?? '' }}"
                                    placeholder="E-Mail*"
                                    class="border border-gray-300 rounded px-3 py-2.5 text-[13px] w-full focus:outline-none focus:border-accent-blue transition-colors placeholder-gray-400">
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-[12px] font-semibold text-gray-600 mb-1.5">Comment</label>
                                <textarea name="note" rows="4" placeholder="Any special requirement/instruction for us?"
                                    class="border border-gray-300 rounded px-3 py-2.5 text-[13px] w-full focus:outline-none focus:border-accent-blue transition-colors placeholder-gray-400 resize-none"></textarea>
                            </div>
                        </div>
                    </div>

                    {{-- Payment & Delivery Side by Side --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        {{-- Payment Method --}}
                        <div class="bg-white rounded-lg shadow-sm p-6">
                            <h2 class="text-[15px] font-bold text-gray-800 mb-1 flex items-center gap-2">
                                <i class="fas fa-credit-card text-accent-orange"></i>
                                Payment Method
                            </h2>
                            <p class="text-[12px] text-gray-500 mb-4">Select a payment method</p>
                            <div class="space-y-4">
                                <label class="flex items-center gap-2.5 cursor-pointer group">
                                    <input type="radio" name="payment_method" value="cash_on_delivery" checked
                                        onclick="toggleTrxField(false)" class="accent-accent-blue">
                                    <span
                                        class="text-[13px] text-gray-700 group-hover:text-accent-blue transition-colors">Cash
                                        on Delivery</span>
                                </label>

                                @foreach ($payment_methods as $method)
                                    <div
                                        class="payment-option border border-gray-100 rounded-lg p-3 hover:border-accent-blue transition-all">
                                        <label class="flex items-start gap-3 cursor-pointer group">
                                            <input type="radio" name="payment_method" value="{{ $method->name }}"
                                                onclick="toggleTrxField(true, '{{ $method->name }}', '{{ $method->number }}', '{{ $method->type }}')"
                                                class="mt-1 accent-accent-blue">
                                            <div class="flex-1">
                                                <div class="flex items-center justify-between mb-1">
                                                    <span
                                                        class="text-[14px] font-bold text-gray-800 group-hover:text-accent-blue transition-colors">{{ $method->name }}</span>
                                                    @if ($method->logo)
                                                        <img src="{{ asset('storage/' . $method->logo) }}"
                                                            class="h-6 object-contain">
                                                    @endif
                                                </div>
                                                <p class="text-[11px] text-gray-500">Number: <span
                                                        class="font-bold text-accent-orange">{{ $method->number }}</span>
                                                    ({{ ucfirst($method->type) }})</p>
                                                @if ($method->notes)
                                                    <p class="text-[10px] text-gray-400 mt-1 italic">{{ $method->notes }}
                                                    </p>
                                                @endif
                                            </div>
                                        </label>
                                    </div>
                                @endforeach

                                {{-- Transaction ID Field (Hidden by default) --}}
                                <div id="trx-field"
                                    class="hidden animate-fade-in mt-4 pt-4 border-t border-dashed border-gray-200">
                                    <div class="bg-blue-50 p-3 rounded-lg mb-3">
                                        <p class="text-[11px] text-blue-700 leading-relaxed">
                                            <i class="fas fa-info-circle mr-1"></i>
                                            Please send the total amount to the <span id="method-name-display"
                                                class="font-bold"></span> number above, then enter the Transaction ID below.
                                        </p>
                                    </div>
                                    <label class="block text-[12px] font-semibold text-gray-700 mb-1.5">Transaction ID <span
                                            class="text-red-500">*</span></label>
                                    <input type="text" name="transaction_id" id="transaction_id"
                                        placeholder="Enter your Transaction ID here"
                                        class="border-2 border-accent-blue/30 rounded-lg px-4 py-3 text-[14px] w-full focus:outline-none focus:border-accent-blue transition-all bg-white shadow-sm">
                                    <p class="text-[10px] text-gray-400 mt-1">Found in your payment confirmation SMS.</p>
                                </div>
                            </div>
                        </div>

                        {{-- Delivery Method --}}
                        <div class="bg-white rounded-lg shadow-sm p-6">
                            <h2 class="text-[15px] font-bold text-gray-800 mb-1 flex items-center gap-2">
                                <i class="fas fa-truck text-accent-orange"></i>
                                Delivery Method
                            </h2>
                            <p class="text-[12px] text-gray-500 mb-4">Select a delivery method</p>
                            <div class="space-y-2.5">
                                @foreach ($shipping_methods as $method)
                                    <label class="flex items-center gap-2.5 cursor-pointer">
                                        <input type="radio" name="delivery_method" value="{{ $method->id }}"
                                            data-name="{{ $method->name }}" data-charge="{{ $method->cost }}"
                                            {{ $loop->first ? 'checked' : '' }} class="accent-accent-blue">
                                        <span class="text-[13px] text-gray-700">{{ $method->name }} -
                                            <strong>{{ number_format($method->cost, 0) }}৳</strong></span>
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    {{-- Products List --}}
                    <div class="bg-white rounded-lg shadow-sm p-6">
                        <h2 class="text-[15px] font-bold text-gray-800 mb-4 flex items-center gap-2">
                            <i class="fas fa-box text-accent-orange"></i>
                            Products
                        </h2>
                        <div class="divide-y divide-gray-100">
                            @foreach ($cart as $item)
                                <div class="flex items-center justify-between py-3">
                                    <div>
                                        <p class="text-[13px] text-gray-800">
                                            <span class="font-semibold">{{ $item['quantity'] }} X</span>
                                            <a href="{{ url('product/' . $item['slug']) }}"
                                                class="text-accent-blue hover:underline ml-1">{{ $item['name'] }}</a>
                                        </p>
                                        <p class="text-[11px] text-gray-400 mt-0.5">Star Points:
                                            {{ round(($item['price'] * $item['quantity']) / 100) }}</p>
                                    </div>
                                    <div class="text-[13px] font-bold text-gray-800 shrink-0 ml-4">
                                        {{ number_format($item['price'] * $item['quantity'], 0) }}৳
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                {{-- ── RIGHT SIDEBAR ── --}}
                <div class="checkout-sidebar w-full shrink-0 sticky top-4 space-y-5"
                    style="width: 100%; max-width: 320px; flex: 0 0 320px;">
                    <div class="bg-white rounded-lg shadow-sm p-5">
                        <h2 class="text-[15px] font-bold text-gray-800 mb-4 flex items-center gap-2">
                            <i class="fas fa-receipt text-accent-orange"></i>
                            Order Summary
                        </h2>

                        {{-- Coupon / Gift Voucher --}}
                        <div class="mb-4">
                            <p class="text-[12px] font-semibold text-gray-600 mb-2">Get Some Extra</p>
                            <p class="text-[11px] text-gray-400 mb-3">Use coupon/voucher/star points</p>
                            <div class="flex gap-2 mb-3">
                                <button type="button" id="coupon-tab" onclick="switchCouponTab('coupon')"
                                    class="flex items-center gap-1.5 bg-accent-blue text-white px-3 py-1.5 rounded text-[12px] font-semibold transition-colors">
                                    <i class="fas fa-tag text-[10px]"></i> Coupon
                                </button>
                                <button type="button" id="gift-tab" onclick="switchCouponTab('gift')"
                                    class="flex items-center gap-1.5 bg-gray-100 text-gray-600 px-3 py-1.5 rounded text-[12px] font-semibold transition-colors hover:bg-gray-200">
                                    <i class="fas fa-gift text-[10px]"></i> Gift Voucher
                                </button>
                            </div>
                            <div class="flex gap-2">
                                <input type="text" id="coupon-input" placeholder="Promo / Coupon Code"
                                    class="border border-gray-300 rounded px-3 py-2 text-[12px] flex-1 focus:outline-none focus:border-accent-blue placeholder-gray-400">
                                <button type="button"
                                    class="text-accent-blue text-[12px] font-bold hover:text-accent-orange transition-colors px-1">Apply</button>
                            </div>
                        </div>

                        {{-- Totals --}}
                        <div class="border-t border-gray-100 pt-4 space-y-2.5 text-[13px]">
                            <div class="flex justify-between text-gray-600">
                                <span>Sub-Total:</span>
                                <span class="font-bold text-gray-800">{{ number_format($total, 0) }}৳</span>
                            </div>
                            <div class="flex justify-between text-gray-600">
                                <span id="delivery-label">{{ $shipping_methods->first()->name ?? 'Delivery' }}:</span>
                                <span id="delivery-charge"
                                    class="font-bold text-gray-800">{{ number_format($shipping_methods->first()->cost ?? 0, 0) }}৳</span>
                            </div>
                            <div
                                class="border-t border-gray-100 pt-2.5 flex justify-between text-[14px] font-bold text-gray-800">
                                <span>Total:</span>
                                <span id="grand-total"
                                    class="text-accent-orange text-[15px] font-bold">{{ number_format($total + ($shipping_methods->first()->cost ?? 0), 0) }}৳</span>
                            </div>
                        </div>

                        {{-- Terms & Confirm --}}
                        <div class="mt-5 pt-4 border-t border-gray-100">
                            <div class="flex items-start gap-2 mb-4">
                                <input type="checkbox" id="terms" name="terms" required
                                    class="mt-0.5 accent-accent-blue">
                                <label for="terms" class="text-[11px] text-gray-600 leading-relaxed">
                                    I have read and agree to the
                                    <a href="#" class="text-accent-orange hover:underline font-semibold">Terms and
                                        Conditions</a>,
                                    <a href="#" class="text-accent-orange hover:underline font-semibold">Privacy
                                        Policy</a> and
                                    <a href="#" class="text-accent-orange hover:underline font-semibold">Refund and
                                        Return Policy</a>
                                </label>
                            </div>
                            <button type="submit"
                                class="bg-accent-blue text-white py-3 px-6 rounded font-bold w-full text-center transition-colors hover:bg-blue-700 shadow-sm flex items-center justify-center gap-2 text-[14px]">
                                Confirm Order
                            </button>
                            <a href="{{ route('cart.show') }}"
                                class="mt-3 text-[12px] text-gray-400 hover:text-accent-blue transition-colors flex items-center justify-center gap-1.5">
                                <i class="fas fa-arrow-left text-[10px]"></i> Back to Cart
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </form>
    </div>

@section('scripts')
    <script>
        const subtotal = {{ $total }};

        // Delivery charge update
        document.querySelectorAll('input[name="delivery_method"]').forEach(radio => {
            radio.addEventListener('change', () => {
                const charge = parseFloat(radio.getAttribute('data-charge')) || 0;
                const name = radio.getAttribute('data-name');
                document.getElementById('delivery-label').textContent = name + ':';
                document.getElementById('delivery-charge').textContent = charge === 0 ? 'Free' : charge
                    .toLocaleString('en-BD') + '৳';
                document.getElementById('grand-total').textContent = (subtotal + charge).toLocaleString(
                    'en-BD') + '৳';
            });
        });

        // Toggle Transaction ID Field
        function toggleTrxField(show, name = '', number = '', type = '') {
            const field = document.getElementById('trx-field');
            const input = document.getElementById('transaction_id');
            const nameDisplay = document.getElementById('method-name-display');

            if (show) {
                field.classList.remove('hidden');
                field.classList.add('block');
                input.required = true;
                nameDisplay.textContent = name;
            } else {
                field.classList.remove('block');
                field.classList.add('hidden');
                input.required = false;
                input.value = '';
            }
        }

        // Form Validation
        document.getElementById('checkoutForm').addEventListener('submit', function(e) {
            const paymentMethod = document.querySelector('input[name="payment_method"]:checked').value;
            const trxId = document.getElementById('transaction_id').value;

            if (paymentMethod !== 'cash_on_delivery' && !trxId) {
                e.preventDefault();
                alert('Please enter the Transaction ID for your payment.');
                document.getElementById('transaction_id').focus();
            }
        });

        // Coupon / Gift tab switcher
        function switchCouponTab(tab) {
            const couponBtn = document.getElementById('coupon-tab');
            const giftBtn = document.getElementById('gift-tab');
            const input = document.getElementById('coupon-input');
            if (tab === 'coupon') {
                couponBtn.className =
                    'flex items-center gap-1.5 bg-accent-blue text-white px-3 py-1.5 rounded text-[12px] font-semibold transition-colors';
                giftBtn.className =
                    'flex items-center gap-1.5 bg-gray-100 text-gray-600 px-3 py-1.5 rounded text-[12px] font-semibold transition-colors hover:bg-gray-200';
                input.placeholder = 'Promo / Coupon Code';
            } else {
                giftBtn.className =
                    'flex items-center gap-1.5 bg-accent-blue text-white px-3 py-1.5 rounded text-[12px] font-semibold transition-colors';
                couponBtn.className =
                    'flex items-center gap-1.5 bg-gray-100 text-gray-600 px-3 py-1.5 rounded text-[12px] font-semibold transition-colors hover:bg-gray-200';
                input.placeholder = 'Gift Voucher Code';
            }
        }
    </script>
@endsection
@endsection
