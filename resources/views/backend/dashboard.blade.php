@extends('layouts.admin')

@section('title', 'Admin Dashboard | IOS BD')

@section('content')
    <div class="p-6 space-y-8">
        <div class="flex items-center justify-between">
            <h1 class="text-2xl font-bold text-gray-800">Overview Dashboard</h1>
            <div class="text-sm text-gray-500">{{ now()->format('l, d F Y') }}</div>
        </div>

        <!-- Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-6">
            <!-- Total Users -->
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-4">
                <div class="w-12 h-12 bg-blue-50 rounded-xl flex items-center justify-center text-blue-600 text-xl shrink-0">
                    <i class="fas fa-users"></i>
                </div>
                <div>
                    <p class="text-xs font-medium text-gray-400 uppercase tracking-wide">Users</p>
                    <h3 class="text-xl font-bold text-gray-800">{{ number_format($totalUsers) }}</h3>
                </div>
            </div>

            <!-- Total Categories -->
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-4">
                <div
                    class="w-12 h-12 bg-orange-50 rounded-xl flex items-center justify-center text-accent-orange text-xl shrink-0">
                    <i class="fas fa-sitemap"></i>
                </div>
                <div>
                    <p class="text-xs font-medium text-gray-400 uppercase tracking-wide">Categories</p>
                    <h3 class="text-xl font-bold text-gray-800">{{ number_format($totalCategories) }}</h3>
                </div>
            </div>

            <!-- Total Brands -->
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-4">
                <div
                    class="w-12 h-12 bg-purple-50 rounded-xl flex items-center justify-center text-purple-600 text-xl shrink-0">
                    <i class="fas fa-tags"></i>
                </div>
                <div>
                    <p class="text-xs font-medium text-gray-400 uppercase tracking-wide">Brands</p>
                    <h3 class="text-xl font-bold text-gray-800">{{ number_format($totalBrands) }}</h3>
                </div>
            </div>

            <!-- Total Suppliers -->
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-4">
                <div
                    class="w-12 h-12 bg-teal-50 rounded-xl flex items-center justify-center text-teal-600 text-xl shrink-0">
                    <i class="fas fa-building"></i>
                </div>
                <div>
                    <p class="text-xs font-medium text-gray-400 uppercase tracking-wide">Suppliers</p>
                    <h3 class="text-xl font-bold text-gray-800">{{ number_format($totalSuppliers) }}</h3>
                </div>
            </div>

            <!-- Total Products -->
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-4">
                <div
                    class="w-12 h-12 bg-green-50 rounded-xl flex items-center justify-center text-green-600 text-xl shrink-0">
                    <i class="fas fa-box"></i>
                </div>
                <div>
                    <p class="text-xs font-medium text-gray-400 uppercase tracking-wide">Products</p>
                    <h3 class="text-xl font-bold text-gray-800">{{ number_format($totalProducts) }}</h3>
                </div>
            </div>
        </div>

        <!-- Order Stats Grid -->
        <h2 class="text-lg font-bold text-gray-800 mt-8 mb-4">Order Statistics</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 xl:grid-cols-5 gap-6">
            <!-- Total Orders -->
            <div
                class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-4 border-l-4 border-l-blue-600">
                <div
                    class="w-12 h-12 bg-blue-50 rounded-xl flex items-center justify-center text-blue-600 text-xl shrink-0">
                    <i class="fas fa-shopping-cart"></i>
                </div>
                <div class="flex-1">
                    <p class="text-xs font-medium text-gray-400 uppercase tracking-wide">Total Orders</p>
                    <div class="flex items-baseline gap-2">
                        <h3 class="text-xl font-bold text-gray-800">{{ number_format($totalOrders) }}</h3>
                    </div>
                </div>
            </div>

            <!-- Pending Orders -->
            <div
                class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-4 border-l-4 border-l-yellow-500">
                <div
                    class="w-12 h-12 bg-yellow-50 rounded-xl flex items-center justify-center text-yellow-600 text-xl shrink-0">
                    <i class="fas fa-clock"></i>
                </div>
                <div class="flex-1">
                    <p class="text-xs font-medium text-gray-400 uppercase tracking-wide">Pending</p>
                    <div class="flex flex-col">
                        <h3 class="text-xl font-bold text-gray-800">{{ number_format($pendingOrders) }}</h3>
                        <p class="text-[11px] font-bold text-yellow-600">{{ number_format($pendingAmount, 0) }}৳</p>
                    </div>
                </div>
            </div>

            <!-- On The Way -->
            <div
                class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-4 border-l-4 border-l-blue-400">
                <div
                    class="w-12 h-12 bg-blue-50 rounded-xl flex items-center justify-center text-blue-400 text-xl shrink-0">
                    <i class="fas fa-truck"></i>
                </div>
                <div class="flex-1">
                    <p class="text-xs font-medium text-gray-400 uppercase tracking-wide">On The Way</p>
                    <div class="flex flex-col">
                        <h3 class="text-xl font-bold text-gray-800">{{ number_format($onTheWayOrders) }}</h3>
                        <p class="text-[11px] font-bold text-blue-500">{{ number_format($onTheWayAmount, 0) }}৳</p>
                    </div>
                </div>
            </div>

            <!-- Delivered -->
            <div
                class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-4 border-l-4 border-l-green-600">
                <div
                    class="w-12 h-12 bg-green-50 rounded-xl flex items-center justify-center text-green-600 text-xl shrink-0">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div class="flex-1">
                    <p class="text-xs font-medium text-gray-400 uppercase tracking-wide">Total Sales</p>
                    <div class="flex flex-col">
                        <h3 class="text-xl font-bold text-gray-800">{{ number_format($deliveredOrders) }}</h3>
                        <p class="text-[11px] font-bold text-green-600">{{ number_format($totalSales, 0) }}৳</p>
                    </div>
                </div>
            </div>

            <!-- Rejected -->
            <div
                class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-4 border-l-4 border-l-red-600">
                <div class="w-12 h-12 bg-red-50 rounded-xl flex items-center justify-center text-red-600 text-xl shrink-0">
                    <i class="fas fa-times-circle"></i>
                </div>
                <div class="flex-1">
                    <p class="text-xs font-medium text-gray-400 uppercase tracking-wide">Rejected</p>
                    <div class="flex flex-col">
                        <h3 class="text-xl font-bold text-gray-800">{{ number_format($rejectedOrders) }}</h3>
                        <p class="text-[11px] font-bold text-red-600">{{ number_format($rejectedAmount, 0) }}৳</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Refund Reports Grid -->
        <h2 class="text-lg font-bold text-gray-800 mt-8 mb-4">Refund Reports</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Approved Refunds -->
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-4 bg-green-50/30">
                <div
                    class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center text-green-600 text-xl shrink-0">
                    <i class="fas fa-check-double"></i>
                </div>
                <div class="flex-1">
                    <p class="text-xs font-medium text-gray-500 uppercase tracking-wide">Approved Refunds</p>
                    <div class="flex items-baseline gap-3">
                        <h3 class="text-xl font-bold text-gray-800">{{ $approvedRefunds }}</h3>
                        <span
                            class="text-sm font-bold text-green-600">{{ number_format($approvedRefundAmount, 0) }}৳</span>
                    </div>
                </div>
            </div>

            <!-- Pending Refunds -->
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-4 bg-yellow-50/30">
                <div
                    class="w-12 h-12 bg-yellow-100 rounded-xl flex items-center justify-center text-yellow-600 text-xl shrink-0">
                    <i class="fas fa-spinner fa-spin"></i>
                </div>
                <div class="flex-1">
                    <p class="text-xs font-medium text-gray-500 uppercase tracking-wide">Pending Refunds</p>
                    <div class="flex items-baseline gap-3">
                        <h3 class="text-xl font-bold text-gray-800">{{ $pendingRefunds }}</h3>
                        <span
                            class="text-sm font-bold text-yellow-600">{{ number_format($pendingRefundAmount, 0) }}৳</span>
                    </div>
                </div>
            </div>

            <!-- Rejected Refunds -->
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-4 bg-red-50/30">
                <div class="w-12 h-12 bg-red-100 rounded-xl flex items-center justify-center text-red-600 text-xl shrink-0">
                    <i class="fas fa-ban"></i>
                </div>
                <div class="flex-1">
                    <p class="text-xs font-medium text-gray-500 uppercase tracking-wide">Rejected Refunds</p>
                    <h3 class="text-xl font-bold text-gray-800">{{ $rejectedRefunds }}</h3>
                </div>
            </div>
        </div>

        <!-- CMS & Communication Grid -->
        <h2 class="text-lg font-bold text-gray-800 mt-8 mb-4">CMS & Communications</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-5 gap-4">
            <!-- Total Pages -->
            <a href="{{ route('admin.cms.index') }}"
                class="bg-white p-4 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-3 hover:shadow-md transition-all group">
                <div
                    class="w-10 h-10 bg-indigo-50 rounded-xl flex items-center justify-center text-indigo-600 text-lg shrink-0 group-hover:bg-indigo-600 group-hover:text-white transition-all">
                    <i class="fas fa-file-alt"></i>
                </div>
                <div class="flex-1">
                    <p class="text-[10px] font-medium text-gray-500 uppercase tracking-wide">CMS Pages</p>
                    <h3 class="text-lg font-bold text-gray-800">{{ $totalPages }}</h3>
                </div>
            </a>

            <!-- Total Messages -->
            <a href="{{ route('admin.contacts.index') }}"
                class="bg-white p-4 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-3 hover:shadow-md transition-all group">
                <div
                    class="w-10 h-10 bg-blue-50 rounded-xl flex items-center justify-center text-blue-600 text-lg shrink-0 group-hover:bg-blue-600 group-hover:text-white transition-all">
                    <i class="fas fa-envelope-open-text"></i>
                </div>
                <div class="flex-1">
                    <p class="text-[10px] font-medium text-gray-500 uppercase tracking-wide">Messages</p>
                    <h3 class="text-lg font-bold text-gray-800">{{ $totalMessages }}</h3>
                </div>
            </a>

            <!-- Total Quotations -->
            <a href="{{ route('admin.quotations.index') }}"
                class="bg-white p-4 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-3 hover:shadow-md transition-all group">
                <div
                    class="w-10 h-10 bg-emerald-50 rounded-xl flex items-center justify-center text-emerald-600 text-lg shrink-0 group-hover:bg-emerald-600 group-hover:text-white transition-all">
                    <i class="fas fa-file-invoice-dollar"></i>
                </div>
                <div class="flex-1">
                    <p class="text-[10px] font-medium text-gray-500 uppercase tracking-wide">Quotations</p>
                    <h3 class="text-lg font-bold text-gray-800">{{ $totalQuotations }}</h3>
                </div>
            </a>

            <!-- Total Questions -->
            <a href="{{ route('admin.questions.index') }}"
                class="bg-white p-4 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-3 hover:shadow-md transition-all group">
                <div
                    class="w-10 h-10 bg-orange-50 rounded-xl flex items-center justify-center text-orange-600 text-lg shrink-0 group-hover:bg-orange-600 group-hover:text-white transition-all">
                    <i class="fas fa-question-circle"></i>
                </div>
                <div class="flex-1">
                    <p class="text-[10px] font-medium text-gray-500 uppercase tracking-wide">Questions</p>
                    <h3 class="text-lg font-bold text-gray-800">{{ $totalQuestions }}</h3>
                </div>
            </a>

            <!-- Total Reviews -->
            <a href="{{ route('admin.reviews.index') }}"
                class="bg-white p-4 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-3 hover:shadow-md transition-all group">
                <div
                    class="w-10 h-10 bg-yellow-50 rounded-xl flex items-center justify-center text-yellow-600 text-lg shrink-0 group-hover:bg-yellow-600 group-hover:text-white transition-all">
                    <i class="fas fa-star"></i>
                </div>
                <div class="flex-1">
                    <p class="text-[10px] font-medium text-gray-500 uppercase tracking-wide">Reviews</p>
                    <h3 class="text-lg font-bold text-gray-800">{{ $totalReviews }}</h3>
                </div>
            </a>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Recent Orders Table -->
            <div class="lg:col-span-2 bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="p-6 border-b border-gray-50 flex items-center justify-between">
                    <h2 class="text-lg font-bold text-gray-800">Recent Orders</h2>
                    <a href="{{ route('admin.orders.index') }}"
                        class="text-accent-blue text-sm font-bold hover:underline">View All</a>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead class="bg-gray-50 text-[11px] font-bold text-gray-500 uppercase tracking-wider">
                            <tr>
                                <th class="px-6 py-4">Order No</th>
                                <th class="px-6 py-4">Customer</th>
                                <th class="px-6 py-4">Amount</th>
                                <th class="px-6 py-4">Status</th>
                                <th class="px-6 py-4">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($recentOrders as $order)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4">
                                        <p class="text-sm font-bold text-gray-800">#{{ $order->order_number }}</p>
                                        <p class="text-[11px] text-gray-400">{{ $order->created_at->diffForHumans() }}</p>
                                    </td>
                                    <td class="px-6 py-4">
                                        <p class="text-sm text-gray-700">{{ $order->first_name }} {{ $order->last_name }}
                                        </p>
                                        <p class="text-xs text-gray-400">{{ $order->phone }}</p>
                                    </td>
                                    <td class="px-6 py-4">
                                        <p class="text-sm font-bold text-accent-orange">
                                            {{ number_format($order->total, 0) }}৳</p>
                                    </td>
                                    <td class="px-6 py-4">
                                        @php
                                            $statusClasses = [
                                                'pending' => 'bg-yellow-100 text-yellow-800',
                                                'on_the_way' => 'bg-blue-100 text-blue-800',
                                                'delivered' => 'bg-green-100 text-green-800',
                                                'rejected' => 'bg-red-100 text-red-800',
                                            ];
                                        @endphp
                                        <span
                                            class="px-2 py-0.5 rounded-full text-[10px] font-bold uppercase {{ $statusClasses[$order->status] }}">
                                            {{ str_replace('_', ' ', $order->status) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <a href="{{ route('admin.orders.show', $order->id) }}"
                                            class="text-gray-400 hover:text-accent-blue transition-colors"><i
                                                class="fas fa-eye"></i></a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-10 text-center text-gray-400 italic">No orders yet
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Recent Users Table -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="p-6 border-b border-gray-50 flex items-center justify-between">
                    <h2 class="text-lg font-bold text-gray-800">New Users</h2>
                    <a href="#" class="text-accent-blue text-sm font-bold hover:underline">View All</a>
                </div>
                <div class="p-4 space-y-4">
                    @forelse($recentUsers as $user)
                        <div class="flex items-center gap-3">
                            <div
                                class="w-10 h-10 rounded-full bg-gradient-to-tr from-accent-orange to-orange-400 flex items-center justify-center text-white font-bold shadow-sm shrink-0">
                                {{ strtoupper(substr($user->first_name ?? $user->name, 0, 1)) }}
                            </div>
                            <div class="min-w-0">
                                <p class="text-sm font-bold text-gray-800 truncate">{{ $user->name }}</p>
                                <p class="text-[11px] text-gray-400">{{ $user->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                    @empty
                        <p class="text-center text-gray-400 text-sm italic py-4">No users joined yet</p>
                    @endforelse
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Quick Actions -->
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                <h2 class="text-lg font-bold text-gray-800 mb-6">Quick Actions</h2>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <a href="{{ route('admin.orders.index') }}"
                        class="p-4 rounded-xl bg-blue-50 border border-blue-100 flex flex-col items-center gap-2 group hover:bg-accent-blue transition-all">
                        <i class="fas fa-shopping-cart text-blue-600 group-hover:text-white text-xl"></i>
                        <span class="text-[11px] font-bold text-gray-600 group-hover:text-white">All Orders</span>
                    </a>
                    <a href="{{ route('admin.products.create') }}"
                        class="p-4 rounded-xl bg-green-50 border border-green-100 flex flex-col items-center gap-2 group hover:bg-green-600 transition-all">
                        <i class="fas fa-plus-circle text-green-600 group-hover:text-white text-xl"></i>
                        <span class="text-[11px] font-bold text-gray-600 group-hover:text-white">Add Product</span>
                    </a>
                    <a href="{{ route('admin.categories.index') }}"
                        class="p-4 rounded-xl bg-orange-50 border border-orange-100 flex flex-col items-center gap-2 group hover:bg-accent-orange transition-all">
                        <i class="fas fa-sitemap text-accent-orange group-hover:text-white text-xl"></i>
                        <span class="text-[11px] font-bold text-gray-600 group-hover:text-white">Categories</span>
                    </a>
                    <a href="{{ route('admin.banners.index') }}"
                        class="p-4 rounded-xl bg-purple-50 border border-purple-100 flex flex-col items-center gap-2 group hover:bg-purple-600 transition-all">
                        <i class="fas fa-image text-purple-600 group-hover:text-white text-xl"></i>
                        <span class="text-[11px] font-bold text-gray-600 group-hover:text-white">Banners</span>
                    </a>
                </div>
            </div>

            <div
                class="bg-gradient-to-br from-primary-dark to-gray-800 p-6 rounded-2xl shadow-xl text-white flex items-center justify-between">
                <div>
                    <h3 class="font-bold text-xl mb-1">Total Revenue</h3>
                    <p class="text-xs text-gray-400 mb-4 leading-relaxed">Combined value of all delivered orders.</p>
                    <div class="text-3xl font-bold text-accent-orange">{{ number_format($totalSales, 0) }}৳</div>
                </div>
                <div class="hidden md:block">
                    <i class="fas fa-chart-line text-6xl text-gray-700 opacity-50"></i>
                </div>
            </div>
        </div>
    </div>
@endsection
