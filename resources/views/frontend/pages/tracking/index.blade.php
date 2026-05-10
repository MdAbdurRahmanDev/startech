@extends('layouts.app')

@section('title', 'Order Tracking | Iosbd')

@section('content')
    <div class="bg-[#f2f4f8] py-12">
        <div class="container mx-auto px-4">
            <div
                class="max-w-5xl mx-auto bg-white rounded-2xl shadow-xl overflow-hidden flex flex-col md:flex-row items-center p-8 md:p-12 gap-12">

                <!-- Left Side: Illustration -->
                <div class="w-full md:w-1/2 flex justify-center">
                    <img src="{{ asset('frontend/assets/images/order-tracking.png') }}" alt="Order Tracking"
                        class="max-w-full h-auto rounded-xl">
                </div>

                <!-- Right Side: Tracking Form -->
                <div class="w-full md:w-1/2">
                    <h1 class="text-3xl font-black text-gray-800 mb-6 tracking-tight">Track Your Order Status</h1>
                    <p class="text-sm text-gray-500 mb-10 leading-relaxed">
                        To track your order status please enter your <span class="font-bold text-gray-700">'Invoice
                            No'</span> and <span class="font-bold text-gray-700">'Phone No'</span> (associated to your
                        order) in the box below and press "Track" button.
                    </p>

                    @if (session('error'))
                        <div
                            class="bg-red-50 border border-red-100 text-red-700 px-4 py-3 rounded-xl mb-6 text-sm font-medium flex items-center gap-2">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ session('error') }}
                        </div>
                    @endif

                    <form action="{{ route('order.track.post') }}" method="POST" class="space-y-6">
                        @csrf
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label
                                    class="block text-[11px] font-bold text-gray-400 uppercase tracking-widest mb-2">Invoice
                                    No*</label>
                                <input type="text" name="order_number" required placeholder="Enter invoice no"
                                    value="{{ old('order_number') }}"
                                    class="w-full bg-gray-50 border border-gray-200 rounded-lg py-3 px-4 focus:ring-2 focus:ring-accent-blue outline-none transition-all text-sm">
                            </div>
                            <div>
                                <label
                                    class="block text-[11px] font-bold text-gray-400 uppercase tracking-widest mb-2">Phone
                                    No*</label>
                                <input type="text" name="phone" required placeholder="Enter phone no"
                                    value="{{ old('phone') }}"
                                    class="w-full bg-gray-50 border border-gray-200 rounded-lg py-3 px-4 focus:ring-2 focus:ring-accent-blue outline-none transition-all text-sm">
                            </div>
                        </div>

                        <button type="submit"
                            class="w-full bg-primary-dark text-white py-4 rounded-lg font-black text-sm uppercase tracking-widest hover:shadow-2xl transition-all shadow-lg active:scale-95">
                            Track Now
                        </button>
                    </form>

                    @if (isset($order))
                        <div class="mt-12 pt-8 border-t border-gray-100 animate-fade-in">
                            <h3 class="text-lg font-bold text-gray-800 mb-6 flex items-center gap-2">
                                <i class="fas fa-map-marker-alt text-accent-orange"></i>
                                Tracking Result for #{{ $order->order_number }}
                            </h3>

                            <div class="relative">
                                <!-- Tracking Line -->
                                <div class="absolute left-3 top-0 bottom-0 w-0.5 bg-gray-100"></div>

                                <div class="space-y-8">
                                    @php
                                        $statuses = ['pending', 'on_the_way', 'delivered'];
                                        $currentIndex = array_search($order->status, $statuses);
                                        if ($order->status == 'rejected') {
                                            $currentIndex = -1;
                                        }
                                    @endphp

                                    <!-- Pending -->
                                    <div class="relative pl-10">
                                        <div
                                            class="absolute left-0 top-1 w-6 h-6 rounded-full {{ $currentIndex >= 0 ? 'bg-green-500' : 'bg-gray-200' }} border-4 border-white shadow-sm z-10 flex items-center justify-center">
                                            @if ($currentIndex >= 0)
                                                <i class="fas fa-check text-[10px] text-white"></i>
                                            @endif
                                        </div>
                                        <h4
                                            class="text-sm font-bold {{ $currentIndex >= 0 ? 'text-gray-800' : 'text-gray-400' }}">
                                            Order Placed</h4>
                                        <p class="text-xs text-gray-400">Your order has been received and is waiting for
                                            confirmation.</p>
                                    </div>

                                    <!-- On The Way -->
                                    <div class="relative pl-10">
                                        <div
                                            class="absolute left-0 top-1 w-6 h-6 rounded-full {{ $currentIndex >= 1 ? 'bg-green-500' : 'bg-gray-200' }} border-4 border-white shadow-sm z-10 flex items-center justify-center">
                                            @if ($currentIndex >= 1)
                                                <i class="fas fa-check text-[10px] text-white"></i>
                                            @endif
                                        </div>
                                        <h4
                                            class="text-sm font-bold {{ $currentIndex >= 1 ? 'text-gray-800' : 'text-gray-400' }}">
                                            On The Way</h4>
                                        <p class="text-xs text-gray-400">Your order is being shipped to your location.</p>
                                    </div>

                                    <!-- Delivered -->
                                    <div class="relative pl-10">
                                        <div
                                            class="absolute left-0 top-1 w-6 h-6 rounded-full {{ $currentIndex >= 2 ? 'bg-green-500' : 'bg-gray-200' }} border-4 border-white shadow-sm z-10 flex items-center justify-center">
                                            @if ($currentIndex >= 2)
                                                <i class="fas fa-check text-[10px] text-white"></i>
                                            @endif
                                        </div>
                                        <h4
                                            class="text-sm font-bold {{ $currentIndex >= 2 ? 'text-gray-800' : 'text-gray-400' }}">
                                            Delivered</h4>
                                        <p class="text-xs text-gray-400">The product has been successfully delivered to you.
                                        </p>
                                    </div>

                                    @if ($order->status == 'rejected')
                                        <div class="relative pl-10">
                                            <div
                                                class="absolute left-0 top-1 w-6 h-6 rounded-full bg-red-500 border-4 border-white shadow-sm z-10 flex items-center justify-center">
                                                <i class="fas fa-times text-[10px] text-white"></i>
                                            </div>
                                            <h4 class="text-sm font-bold text-red-600">Order Rejected</h4>
                                            <p class="text-xs text-gray-400">Unfortunately, your order has been rejected.
                                                Please contact support.</p>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="mt-10">
                                <a href="{{ route('order.invoice.show', $order->id) }}"
                                    class="inline-flex items-center gap-2 text-accent-blue font-bold text-sm hover:underline">
                                    <i class="fas fa-file-invoice"></i> View Full Invoice Details
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
