@extends('layouts.admin')

@section('title', 'Admin Dashboard | Star Tech')

@section('content')
<div class="p-6 space-y-8">
    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-bold text-gray-800">Overview Dashboard</h1>
        <div class="text-sm text-gray-500">{{ now()->format('l, d F Y') }}</div>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Total Users -->
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-5">
            <div class="w-14 h-14 bg-blue-50 rounded-xl flex items-center justify-center text-blue-600 text-2xl">
                <i class="fas fa-users"></i>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-400">Total Users</p>
                <h3 class="text-2xl font-bold text-gray-800">{{ number_format($totalUsers) }}</h3>
            </div>
        </div>

        <!-- Total Categories -->
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-5">
            <div class="w-14 h-14 bg-orange-50 rounded-xl flex items-center justify-center text-accent-orange text-2xl">
                <i class="fas fa-th-large"></i>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-400">Total Categories</p>
                <h3 class="text-2xl font-bold text-gray-800">{{ number_format($totalCategories) }}</h3>
            </div>
        </div>

        <!-- Placeholder for Products (Future) -->
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-5">
            <div class="w-14 h-14 bg-green-50 rounded-xl flex items-center justify-center text-green-600 text-2xl">
                <i class="fas fa-box"></i>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-400">Total Products</p>
                <h3 class="text-2xl font-bold text-gray-800">0</h3>
            </div>
        </div>

        <!-- Placeholder for Orders (Future) -->
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-5">
            <div class="w-14 h-14 bg-purple-50 rounded-xl flex items-center justify-center text-purple-600 text-2xl">
                <i class="fas fa-shopping-cart"></i>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-400">New Orders</p>
                <h3 class="text-2xl font-bold text-gray-800">0</h3>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Recent Users Table -->
        <div class="lg:col-span-2 bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="p-6 border-b border-gray-50 flex items-center justify-between">
                <h2 class="text-lg font-bold text-gray-800">Recent Joined Users</h2>
                <a href="#" class="text-accent-blue text-sm font-bold hover:underline">View All</a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="bg-gray-50 text-[11px] font-bold text-gray-500 uppercase tracking-wider">
                        <tr>
                            <th class="px-6 py-4">User</th>
                            <th class="px-6 py-4">Contact</th>
                            <th class="px-6 py-4">Joined At</th>
                            <th class="px-6 py-4">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($recentUsers as $user)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-full bg-gradient-to-tr from-accent-orange to-orange-400 flex items-center justify-center text-white font-bold shadow-sm">
                                            {{ strtoupper(substr($user->first_name ?? $user->name, 0, 1)) }}
                                        </div>
                                        <div>
                                            <p class="text-sm font-bold text-gray-800">{{ $user->name }}</p>
                                            <p class="text-[11px] text-gray-400">ID: #{{ $user->id }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <p class="text-sm text-gray-700">{{ $user->email }}</p>
                                    <p class="text-xs text-gray-400">{{ $user->phone }}</p>
                                </td>
                                <td class="px-6 py-4">
                                    <p class="text-sm text-gray-700">{{ $user->created_at->format('d M, Y') }}</p>
                                    <p class="text-[11px] text-gray-400">{{ $user->created_at->diffForHumans() }}</p>
                                </td>
                                <td class="px-6 py-4">
                                    <button class="text-gray-400 hover:text-accent-blue transition-colors"><i class="fas fa-eye"></i></button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-10 text-center text-gray-400 italic">No users joined yet</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Quick Actions / Activity -->
        <div class="space-y-6">
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                <h2 class="text-lg font-bold text-gray-800 mb-6">Quick Actions</h2>
                <div class="grid grid-cols-2 gap-4">
                    <a href="{{ route('admin.categories.index') }}" class="p-4 rounded-xl bg-orange-50 border border-orange-100 flex flex-col items-center gap-2 group hover:bg-accent-orange transition-all">
                        <i class="fas fa-plus-circle text-accent-orange group-hover:text-white text-xl"></i>
                        <span class="text-[11px] font-bold text-gray-600 group-hover:text-white">Add Category</span>
                    </a>
                    <a href="{{ route('admin.banners.index') }}" class="p-4 rounded-xl bg-blue-50 border border-blue-100 flex flex-col items-center gap-2 group hover:bg-accent-blue transition-all">
                        <i class="fas fa-image text-blue-600 group-hover:text-white text-xl"></i>
                        <span class="text-[11px] font-bold text-gray-600 group-hover:text-white">Add Banner</span>
                    </a>
                </div>
            </div>

            <div class="bg-gradient-to-br from-primary-dark to-gray-800 p-6 rounded-2xl shadow-xl text-white">
                <h3 class="font-bold mb-2">Need Help?</h3>
                <p class="text-xs text-gray-400 mb-4 leading-relaxed">Having trouble managing your store? Contact our support team for assistance.</p>
                <a href="#" class="inline-block bg-accent-orange text-white text-[11px] font-bold px-4 py-2 rounded-lg hover:bg-white hover:text-accent-orange transition-all">Support Center</a>
            </div>
        </div>
    </div>
</div>
@endsection
