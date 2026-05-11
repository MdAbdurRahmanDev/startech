@extends('layouts.app')

@section('title', 'Shopping Cart | IOS BD')

@section('content')
    <div class="container pb-14">
        <!-- Breadcrumb -->
        <div class="py-4 text-[13px] text-gray-600">
            <a href="{{ url('/') }}" class="text-gray-800 no-underline hover:text-accent-orange transition-colors"><i
                    class="fas fa-home"></i></a>
            / <span class="text-gray-500">Shopping Cart</span>
        </div>

        <h1 class="text-[22px] font-bold text-gray-800 mb-6">Shopping Cart</h1>

        @if (count($cart) > 0)
            <div class="grid grid-cols-1 lg:grid-cols-[1fr_340px] gap-6 items-start">

                <!-- Cart Items Table -->
                <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                    <div
                        class="hidden md:grid grid-cols-[2fr_1fr_1fr_1fr_40px] bg-[#f2f4f8] text-[13px] font-bold text-gray-600 px-5 py-3">
                        <div>Product</div>
                        <div class="text-center">Unit Price</div>
                        <div class="text-center">Quantity</div>
                        <div class="text-center">Subtotal</div>
                        <div></div>
                    </div>

                    @foreach ($cart as $id => $item)
                        <div class="grid grid-cols-1 md:grid-cols-[2fr_1fr_1fr_1fr_40px] items-center px-5 py-4 border-b border-gray-100 last:border-b-0 gap-4"
                            id="cart-row-{{ $id }}">
                            <!-- Product -->
                            <div class="flex items-center gap-4">
                                <img src="{{ $item['thumbnail'] ? asset('storage/' . $item['thumbnail']) : 'https://placehold.co/80x80/f9fafb/a3a3a3?text=No+Image' }}"
                                    alt="{{ $item['name'] }}"
                                    class="w-16 h-16 object-contain shrink-0 border border-gray-100 rounded p-1">
                                <div>
                                    <a href="{{ url('product/' . $item['slug']) }}"
                                        class="text-[14px] font-semibold text-gray-800 hover:text-accent-orange transition-colors no-underline leading-snug block">
                                        {{ $item['name'] }}
                                    </a>
                                    <span class="text-[12px] text-gray-400 mt-1 block">In Stock</span>
                                </div>
                            </div>

                            <!-- Unit Price -->
                            <div
                                class="text-center text-[14px] font-bold text-accent-orange md:block flex items-center gap-2">
                                <span class="md:hidden text-gray-500 font-normal text-[12px]">Price: </span>
                                {{ number_format($item['price'], 0) }}৳
                            </div>

                            <!-- Quantity -->
                            <div class="flex items-center justify-center md:justify-center gap-2">
                                <div class="flex items-center border border-gray-300 rounded overflow-hidden">
                                    <button onclick="updateQty({{ $id }}, -1)"
                                        class="px-2.5 py-1.5 bg-gray-50 hover:bg-gray-100 transition-colors text-[16px] leading-none text-gray-700">−</button>
                                    <input type="number" id="qty-{{ $id }}" value="{{ $item['quantity'] }}"
                                        min="1"
                                        class="w-12 text-center border-x border-gray-300 py-1.5 outline-none text-[14px] font-semibold text-gray-800 [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none">
                                    <button onclick="updateQty({{ $id }}, 1)"
                                        class="px-2.5 py-1.5 bg-gray-50 hover:bg-gray-100 transition-colors text-[16px] leading-none text-gray-700">+</button>
                                </div>
                            </div>

                            <!-- Subtotal -->
                            <div class="text-center text-[14px] font-bold text-gray-800 md:block flex items-center gap-2">
                                <span class="md:hidden text-gray-500 font-normal text-[12px]">Subtotal: </span>
                                <span
                                    id="subtotal-{{ $id }}">{{ number_format($item['price'] * $item['quantity'], 0) }}৳</span>
                            </div>

                            <!-- Remove -->
                            <div class="flex justify-end md:justify-center">
                                <button onclick="removeFromCart({{ $id }})"
                                    class="text-gray-400 hover:text-red-500 transition-colors text-[16px]" title="Remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                    @endforeach

                    <!-- Cart Actions -->
                    <div class="flex flex-wrap justify-between items-center px-5 py-4 bg-[#f9fafb] gap-3">
                        <a href="{{ url('/') }}"
                            class="border border-gray-300 text-gray-700 py-2 px-5 rounded text-[13px] font-semibold hover:border-accent-blue hover:text-accent-blue transition-colors flex items-center gap-2">
                            <i class="fas fa-arrow-left text-[11px]"></i> Continue Shopping
                        </a>
                        <button onclick="clearCart()"
                            class="border border-red-300 text-red-500 py-2 px-5 rounded text-[13px] font-semibold hover:bg-red-50 transition-colors flex items-center gap-2">
                            <i class="fas fa-trash-alt text-[11px]"></i> Clear Cart
                        </button>
                    </div>
                </div>

                <!-- Order Summary -->
                <div class="bg-white rounded-lg shadow-sm p-6">
                    <h2 class="text-[16px] font-bold text-gray-800 mb-5 pb-4 border-b border-gray-100">Order Summary</h2>

                    <div class="space-y-3 mb-5">
                        <div class="flex justify-between text-[14px] text-gray-600">
                            <span>Subtotal</span>
                            <span id="order-total"
                                class="font-semibold text-gray-800">{{ number_format($total, 0) }}৳</span>
                        </div>
                        <div class="flex justify-between text-[14px] text-gray-600">
                            <span>Shipping</span>
                            <span class="text-green-600 font-semibold">Free</span>
                        </div>
                        <div class="border-t border-gray-100 pt-3 flex justify-between text-[15px] font-bold text-gray-800">
                            <span>Total</span>
                            <span id="order-grand-total" class="text-accent-orange">{{ number_format($total, 0) }}৳</span>
                        </div>
                    </div>

                    <a href="{{ route('cart.checkout') }}"
                        class="bg-accent-blue text-white py-3 px-6 rounded font-bold w-full text-center transition-colors hover:bg-accent-orange shadow-sm flex items-center justify-center gap-2 mb-3">
                        <i class="fas fa-lock text-[13px]"></i> Proceed to Checkout
                    </a>

                    <div class="mt-5 pt-4 border-t border-gray-100">
                        <p class="text-[12px] text-gray-500 text-center mb-3">We accept</p>
                        <div class="flex flex-wrap gap-2 justify-center">
                            <span
                                class="border border-gray-200 rounded px-2 py-1 text-[11px] font-bold text-gray-600">Cash</span>
                            <span
                                class="border border-gray-200 rounded px-2 py-1 text-[11px] font-bold text-gray-600">bKash</span>
                            <span
                                class="border border-gray-200 rounded px-2 py-1 text-[11px] font-bold text-gray-600">Nagad</span>
                            <span class="border border-gray-200 rounded px-2 py-1 text-[11px] font-bold text-gray-600">Visa
                                / MC</span>
                            <span class="border border-gray-200 rounded px-2 py-1 text-[11px] font-bold text-gray-600">0%
                                EMI</span>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <!-- Empty Cart -->
            <div class="bg-white rounded-lg shadow-sm p-16 text-center">
                <i class="fas fa-shopping-cart text-[60px] text-gray-200 mb-6 block"></i>
                <h2 class="text-[20px] font-bold text-gray-700 mb-2">Your cart is empty!</h2>
                <p class="text-[14px] text-gray-400 mb-8">Looks like you haven't added anything to your cart yet.</p>
                <a href="{{ url('/') }}"
                    class="bg-accent-blue text-white py-3 px-10 rounded font-bold transition-colors hover:bg-accent-orange inline-flex items-center gap-2">
                    <i class="fas fa-arrow-left text-[13px]"></i> Continue Shopping
                </a>
            </div>
        @endif
    </div>

@section('scripts')
    <script>
        const CSRF = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        function showToast(message, type = 'success') {
            const container = document.getElementById('toast-container');
            if (!container) return;
            const bgClass = type === 'success' ? 'bg-green-600' : 'bg-red-500';
            const icon = type === 'success' ? 'fa-check-circle' : 'fa-times-circle';
            const toast = document.createElement('div');
            toast.className = `toast ${bgClass} text-white px-6 py-3 rounded-lg shadow-2xl flex items-center gap-3`;
            toast.innerHTML = `<i class="fas ${icon} text-lg"></i><span>${message}</span>`;
            container.appendChild(toast);
            setTimeout(() => toast.remove(), 4000);
        }

        function updateCartCounters(count) {
            document.querySelectorAll('#cart-count-float, #cart-count-mobile').forEach(el => el.textContent = count);
        }

        async function removeFromCart(productId) {
            const res = await fetch('{{ route('cart.remove') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': CSRF,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    product_id: productId
                }),
            });
            const data = await res.json();
            if (data.success) {
                document.getElementById('cart-row-' + productId)?.remove();
                updateCartCounters(data.cart_count);
                showToast('Item removed from cart.', 'success');
                if (data.cart_count === 0) location.reload();
            }
        }

        async function updateQty(productId, delta) {
            const input = document.getElementById('qty-' + productId);
            let qty = parseInt(input.value) + delta;
            if (qty < 1) qty = 1;
            input.value = qty;

            const res = await fetch('{{ route('cart.add') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': CSRF,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    product_id: productId,
                    quantity: delta
                }),
            });
            const data = await res.json();
            if (data.success) {
                updateCartCounters(data.cart_count);
                // Reload to recalculate all subtotals accurately
                location.reload();
            } else {
                showToast(data.message, 'error');
                input.value = qty - delta;
            }
        }

        async function clearCart() {
            const items = document.querySelectorAll('[id^="cart-row-"]');
            const ids = Array.from(items).map(el => el.id.replace('cart-row-', ''));
            for (const id of ids) {
                await fetch('{{ route('cart.remove') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': CSRF,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        product_id: id
                    }),
                });
            }
            location.reload();
        }
    </script>
@endsection
@endsection
