@extends('layouts.app')

@section('content')
<div class="bg-gray-50 min-h-screen py-8">
    <div class="max-w-[1320px] mx-auto px-4">
        <!-- Breadcrumb -->
        <div class="flex items-center gap-2 text-xs md:text-sm text-gray-500 mb-6">
            <a href="/" class="hover:text-accent-orange transition-colors"><i class="fas fa-home"></i></a>
            <i class="fas fa-chevron-right text-[10px] opacity-30"></i>
            <a href="{{ route('user.account') }}" class="hover:text-accent-orange transition-colors">Account</a>
            @yield('breadcrumb_extra')
        </div>

        <!-- Profile Header Card -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 md:p-8 flex flex-col md:flex-row justify-between items-center gap-6 mb-8 animate-fade-in">
            <div class="flex items-center gap-5">
                <div class="w-16 h-16 md:w-20 md:h-20 bg-gradient-to-tr from-accent-orange to-orange-400 rounded-full flex items-center justify-center text-white text-2xl md:text-3xl font-bold shadow-lg shadow-orange-100">
                    {{ strtoupper(substr(Auth::user()->first_name, 0, 1)) }}
                </div>
                <div>
                    <p class="text-sm text-gray-400">Hello,</p>
                    <h1 class="text-xl md:text-2xl font-bold text-primary-dark">{{ Auth::user()->name }}</h1>
                </div>
            </div>
            <div class="flex gap-8 md:gap-12 text-center">
                <div>
                    <p class="text-[10px] md:text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Star Points</p>
                    <p class="text-xl md:text-2xl font-black text-accent-orange">0</p>
                </div>
                <div class="w-px h-10 bg-gray-100 self-center"></div>
                <div>
                    <p class="text-[10px] md:text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Store Credit</p>
                    <p class="text-xl md:text-2xl font-black text-accent-orange">0৳</p>
                </div>
            </div>
        </div>

        <!-- Account Navigation -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 mb-8 overflow-x-auto scrollbar-hide sticky top-[72px] z-30">
            <ul class="flex whitespace-nowrap p-1">
                @php
                    $navItems = [
                        ['route' => 'user.order', 'icon' => 'fas fa-list-alt', 'label' => 'Orders'],
                        ['route' => 'user.edit', 'icon' => 'fas fa-user-edit', 'label' => 'Edit Profile'],
                        ['route' => 'user.account', 'icon' => 'fas fa-lock', 'label' => 'Change Password'], // Reuse edit page for now or separate
                        ['route' => 'user.address', 'icon' => 'fas fa-address-book', 'label' => 'Addresses'],
                        ['route' => 'user.account', 'icon' => 'fas fa-heart', 'label' => 'Saved List'],
                        ['route' => 'user.account', 'icon' => 'fas fa-star', 'label' => 'Star Points'],
                    ];
                @endphp
                @foreach($navItems as $item)
                    <li>
                        <a href="{{ route($item['route']) }}" class="flex items-center gap-2 px-6 py-4 text-sm font-bold transition-all border-b-2 {{ Request::routeIs($item['route']) ? 'text-accent-orange border-accent-orange bg-orange-50/50' : 'text-gray-500 border-transparent hover:text-accent-orange hover:bg-gray-50' }}">
                            <i class="{{ $item['icon'] }} {{ Request::routeIs($item['route']) ? 'text-accent-orange' : 'text-gray-300' }}"></i>
                            {{ $item['label'] }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>

        <!-- Page Content -->
        <div class="animate-fade-in-up">
            @yield('account_content')
        </div>
    </div>
</div>

<style>
@keyframes fade-in {
    from { opacity: 0; transform: translateY(-10px); }
    to { opacity: 1; transform: translateY(0); }
}
@keyframes fade-in-up {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}
.animate-fade-in { animation: fade-in 0.5s ease-out; }
.animate-fade-in-up { animation: fade-in-up 0.5s ease-out; }
.scrollbar-hide::-webkit-scrollbar { display: none; }
.scrollbar-hide { -ms-overflow-style: none; scrollbar-width: none; }
</style>
@endsection
