<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', $setting->app_name ?? 'Site') | International Office Solution</title>

    @if ($setting && $setting->favicon)
        <link rel="icon" type="image/x-icon" href="{{ asset('storage/' . $setting->favicon) }}">
    @endif

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @yield('styles')
    <style>
        /* Custom smooth transitions for dropdowns and sub-dropdowns */
        .nav-dropdown,
        .sub-dropdown {
            opacity: 0;
            visibility: hidden;
            transform: translateY(10px);
            transition: all 0.3s ease-in-out;
        }

        .group:hover>.nav-dropdown {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        /* Sub-dropdown sliding from left/right or down */
        .sub-dropdown-trigger:hover>.sub-dropdown {
            opacity: 1;
            visibility: visible;
            transform: translateX(0);
        }

        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }

        .no-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        .sub-dropdown {
            transform: translateX(10px);
            /* Slide from right */
            position: absolute;
            top: 0;
            left: 100%;
        }
    </style>
</head>

<body class="bg-bg-gray text-primary-dark font-sans min-h-screen">

    <!-- Toast Notifications -->
    <div id="toast-container" class="fixed top-20 right-5 z-[9999] flex flex-col gap-3">
        @if (session('success'))
            <div
                class="toast bg-green-600 text-white px-6 py-3 rounded-lg shadow-2xl flex items-center gap-3 animate-slide-in">
                <i class="fas fa-check-circle"></i>
                <span class="text-sm font-bold">{{ session('success') }}</span>
            </div>
        @endif
        @if (session('error'))
            <div
                class="toast bg-red-600 text-white px-6 py-3 rounded-lg shadow-2xl flex items-center gap-3 animate-slide-in">
                <i class="fas fa-exclamation-circle"></i>
                <span class="text-sm font-bold">{{ session('error') }}</span>
            </div>
        @endif
    </div>

    <style>
        @keyframes slide-in {
            from {
                transform: translateX(100%);
                opacity: 0;
            }

            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        .animate-slide-in {
            animation: slide-in 0.3s ease-out forwards;
        }

        .toast-fade-out {
            opacity: 0;
            transform: translateX(100%);
            transition: all 0.5s ease-in-out;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toasts = document.querySelectorAll('.toast');
            toasts.forEach(toast => {
                setTimeout(() => {
                    toast.classList.add('toast-fade-out');
                    setTimeout(() => toast.remove(), 500);
                }, 4000);
            });
        });
    </script>

    {{-- Top Header Bar --}}
    <div class="bg-[#0a1520] text-white text-xs py-1.5 border-b border-white/10">
        <div class="max-w-[1320px] mx-auto px-1.5 md:px-2 flex items-center justify-center">
            <span class="flex items-center gap-2 font-semibold tracking-wide">
                INTERNATIONAL OFFICE SOLUTION
            </span>
        </div>
    </div>

    <header class="bg-primary-dark py-4 text-white">
        <div class="max-w-[1320px] mx-auto px-1.5 md:px-2 flex items-center justify-between gap-4">
            <!-- Mobile Menu Toggle -->
            <div class="lg:hidden text-2xl cursor-pointer" id="menuToggle">
                <i class="fas fa-bars"></i>
            </div>

            <!-- Logo -->
            <div class="flex-shrink-0">
                <a href="{{ url('/') }}" class="inline-block bg-white p-1.5 shadow-sm hover:opacity-90 transition-opacity" style="border-radius: 10px;">
                    @if ($setting && $setting->logo)
                        <img src="{{ asset('storage/' . $setting->logo) }}" alt="{{ $setting->app_name }}"
                            class="h-10 lg:h-11 object-contain block" style="border-radius: 8px;">
                    @else
                        <span class="text-xl font-bold text-gray-800 px-2">{{ $setting->app_name ?? 'Logo' }}</span>
                    @endif
                </a>
            </div>

            <!-- Search Bar Desktop -->
            <form action="{{ url('search') }}" method="GET"
                class="hidden lg:flex flex-grow max-w-[700px] relative mx-8">
                <input type="text" name="q" value="{{ request('q') }}" placeholder="Search"
                    class="w-full py-2.5 pr-10 pl-4 rounded text-primary-dark focus:outline-none">
                <button type="submit" class="absolute right-3 top-1/2 -translate-y-1/2 text-primary-dark">
                    <i class="fas fa-search"></i>
                </button>
            </form>

            <!-- Mobile Icons -->
            <div class="lg:hidden flex gap-4 items-center">
                <div class="cursor-pointer" onclick="toggleMobileSearch()">
                    <i class="fas fa-search text-xl"></i>
                </div>
                <div class="relative cursor-pointer">
                    <i class="fas fa-shopping-basket text-xl"></i>
                    <span id="cart-count-mobile"
                        class="absolute -top-2 -right-2 bg-accent-orange text-white text-[10px] w-4 h-4 rounded-full flex items-center justify-center">{{ collect(session('cart', []))->sum('quantity') }}</span>
                </div>
            </div>

            <!-- Header Actions Desktop -->
            <div class="hidden lg:flex items-center gap-6">
                <a href="{{ route('offers.index') }}" class="flex items-center gap-2 cursor-pointer group">
                    <i class="fas fa-gift text-accent-white text-xl"></i>
                    <div class="flex flex-col">
                        <span class="text-sm font-bold">Offers</span>
                        <span class="text-[11px] text-gray-400">Latest Offers</span>
                    </div>
                </a>
                <a href="{{ route('services.index') }}" class="flex items-center gap-2 cursor-pointer group">
                    <i class="fas fa-tools text-accent-white text-xl"></i>
                    <div class="flex flex-col">
                        <span class="text-sm font-bold">Services</span>
                        <span class="text-[11px] text-gray-400">Our Services</span>
                    </div>
                </a>
                <div class="relative group cursor-pointer py-4">
                    <div class="flex items-center gap-2">
                        <i class="fas fa-user text-accent-white text-xl"></i>
                        <div class="flex flex-col">
                            <span class="text-sm font-bold">@auth {{ Auth::user()->first_name }}
                                @else
                                Account @endauth
                            </span>
                            <span class="text-[11px] text-gray-400">@auth Dashboard
                                @else
                                Register or Login @endauth
                            </span>
                        </div>
                    </div>
                    <!-- Account Dropdown -->
                    <div
                        class="absolute top-full right-0 bg-white min-w-[180px] shadow-xl py-2 z-[100] border-t-2 border-accent-orange opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 translate-y-2 group-hover:translate-y-0">
                        @guest
                            <a href="{{ route('user.register') }}"
                                class="block px-4 py-2 text-sm text-primary-dark hover:bg-gray-50 hover:text-accent-orange transition-colors">Register</a>
                            <a href="{{ route('login') }}"
                                class="block px-4 py-2 text-sm text-primary-dark hover:bg-gray-50 hover:text-accent-orange transition-colors">Login</a>
                        @else
                            <a href="{{ route('user.account') }}"
                                class="block px-4 py-2 text-sm text-primary-dark hover:bg-gray-50 hover:text-accent-orange transition-colors">My
                                Account</a>
                            <a href="{{ route('user.order') }}"
                                class="block px-4 py-2 text-sm text-primary-dark hover:bg-gray-50 hover:text-accent-orange transition-colors">Orders</a>
                            <hr class="my-1 border-gray-100">
                            <form action="{{ route('user.logout') }}" method="POST">
                                @csrf
                                <button type="submit"
                                    class="w-full text-left px-4 py-2 text-sm text-red-500 hover:bg-gray-50 transition-colors">Logout</button>
                            </form>
                        @endguest
                    </div>
                </div>

                <!-- AC Calculator Button -->
                <a href="{{ route('ac-calculator') }}"
                    class="border-2 border-accent-orange text-accent-orange hover:bg-accent-orange hover:text-white px-5 py-2.5 rounded-lg font-bold text-sm transition-all flex items-center gap-2 group shadow-sm hover:shadow-orange-500/10">
                    <i class="fas fa-calculator text-accent-orange group-hover:text-white transition-colors"></i>
                    AC Calculator
                </a>

                <!-- PC Builder Button -->
                <a href="{{ url('pc-builder') }}"
                    class="bg-accent-orange text-white px-5 py-2.5 rounded-lg font-bold text-sm hover:bg-[#d83d1b] transition-all shadow-lg shadow-orange-500/20 flex items-center gap-2">
                    <i class="fas fa-tools"></i>
                    PC Builder
                </a>

            </div>
        </div>
    </header>
    <!-- Mobile Search Overlay -->
    <div id="mobileSearchOverlay" class="fixed inset-0 bg-primary-dark z-[250] hidden flex-col p-6 animate-fade-in">
        <div class="flex justify-between items-center mb-8">
            <span class="text-white font-bold">Search Products</span>
            <button onclick="toggleMobileSearch()" class="text-white text-2xl">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <form action="{{ url('search') }}" method="GET" class="relative">
            <input type="text" name="q" placeholder="What are you looking for?"
                class="w-full bg-white/10 border border-white/20 rounded-lg py-4 px-6 text-white focus:outline-none focus:border-accent-orange">
            <button type="submit" class="absolute right-4 top-1/2 -translate-y-1/2 text-accent-orange text-xl">
                <i class="fas fa-search"></i>
            </button>
        </form>
    </div>

    <!-- Main Navigation Desktop -->
    <nav class="bg-white shadow-sm sticky top-0 z-[50] hidden lg:block">
        <div class="max-w-[1320px] mx-auto px-2">
            <ul class="flex justify-start flex-nowrap gap-3">
                @foreach ($headerCategories as $category)
                    <li class="group py-4 relative flex-shrink-0">
                        <a href="{{ url('category/' . $category->slug) }}"
                            class="text-[12px] font-bold text-primary-dark hover:text-accent-orange transition-colors flex items-center whitespace-nowrap">
                            {{ $category->name }}
                        </a>
                        @if ($category->children->count() > 0)
                            <div
                                class="nav-dropdown absolute top-full left-0 bg-white min-w-[220px] shadow-xl py-2 z-[60] border-t-2 border-accent-orange">
                                @foreach ($category->children as $sub)
                                    <div class="relative sub-dropdown-trigger group/sub">
                                        <a href="{{ url('category/' . $sub->slug) }}"
                                            class="flex justify-between items-center px-4 py-2.5 text-sm text-primary-dark hover:bg-gray-50 hover:text-accent-orange transition-colors">
                                            <div class="flex items-center gap-2">
                                                {{ $sub->name }}
                                            </div>
                                            @if ($sub->children->count() > 0 || $sub->brands->count() > 0)
                                                <i class="fas fa-chevron-right text-[10px] opacity-50"></i>
                                            @endif
                                        </a>
                                        @if ($sub->children->count() > 0 || $sub->brands->count() > 0)
                                            <div
                                                class="sub-dropdown absolute top-0 left-full bg-white min-w-[200px] shadow-xl py-2 border-l border-gray-100 hidden group-hover/sub:block">
                                                @foreach ($sub->children as $subSub)
                                                    <a href="{{ url('category/' . $subSub->slug) }}"
                                                        class="block px-4 py-2 text-sm text-primary-dark hover:bg-gray-50 hover:text-accent-orange transition-colors">{{ $subSub->name }}</a>
                                                @endforeach
                                                @if ($sub->brands->count() > 0)
                                                    @foreach ($sub->brands as $b)
                                                        <a href="{{ url('category/' . $sub->slug) }}?brand={{ $b->slug }}"
                                                            class="block px-4 py-2 text-sm text-primary-dark hover:bg-gray-50 hover:text-accent-orange transition-colors">
                                                            {{ $b->name }}
                                                        </a>
                                                    @endforeach
                                                @endif
                                            </div>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </li>
                @endforeach

                <!-- Software Services Menu -->
                <li class="group py-4 relative flex-shrink-0">
                    <a href="{{ route('services.index') }}"
                        class="text-[12px] font-bold text-primary-dark hover:text-accent-orange transition-colors flex items-center whitespace-nowrap">
                        Software Services
                    </a>
                    <div
                        class="nav-dropdown absolute top-full left-0 bg-white min-w-[220px] shadow-xl py-2 z-[60] border-t-2 border-accent-orange">
                        <a href="{{ url('services/custom-web-development') }}"
                            class="block px-4 py-2.5 text-sm text-primary-dark hover:bg-gray-50 hover:text-accent-orange transition-colors">
                            Custom Web Development
                        </a>
                        <a href="{{ url('services/apps-development') }}"
                            class="block px-4 py-2.5 text-sm text-primary-dark hover:bg-gray-50 hover:text-accent-orange transition-colors">
                            Apps Development
                        </a>
                        <a href="{{ url('services/ai-automation') }}"
                            class="block px-4 py-2.5 text-sm text-primary-dark hover:bg-gray-50 hover:text-accent-orange transition-colors">
                            AI Automation & Services
                        </a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

    <main class="pt-2 pb-6">
        <div class="max-w-[1320px] mx-auto px-1.5 md:px-2">
            @yield('content')
        </div>
    </main>

    <footer class="bg-primary-dark text-white pt-16 pb-8 mt-12">
        <div class="max-w-[1320px] mx-auto px-1.5 md:px-2">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12">
                <div>
                    <h3 class="text-base font-bold uppercase mb-6 tracking-wider">Support</h3>
                    <div
                        class="flex items-center gap-4 bg-[#11212d] py-4 px-6 rounded-full mb-4 border border-[#1e2e3a]">
                        <i class="fas fa-phone text-accent-orange text-xl"></i>
                        <div>
                            <span class="text-[11px] text-gray-400 block">9 AM - 8 PM</span>
                            <span
                                class="text-lg font-bold text-accent-orange">{{ $setting->phone_number ?? '16793' }}</span>
                        </div>
                    </div>
                    <div
                        class="flex items-center gap-4 bg-[#11212d] py-4 px-6 rounded-full mb-4 border border-[#1e2e3a]">
                        <i class="fas fa-location-dot text-accent-orange text-xl"></i>
                        <div>
                            <span class="text-[11px] text-gray-400 block">Store Locator</span>
                            <span class="text-lg font-bold text-accent-orange">Find Our Stores</span>
                        </div>
                    </div>
                </div>
                <div>
                    <h3 class="text-base font-bold uppercase mb-6 tracking-wider">About Us</h3>
                    <ul class="space-y-3">
                        @foreach ($footerPages as $fPage)
                            <li><a href="{{ url('info/' . $fPage->slug) }}"
                                    class="text-gray-400 hover:text-accent-orange text-sm transition-colors">{{ $fPage->title }}</a>
                            </li>
                        @endforeach
                        <li><a href="{{ route('order.track') }}"
                                class="text-gray-400 hover:text-accent-orange text-sm transition-colors font-bold">Order
                                Tracking</a></li>
                        <li><a href="{{ route('blogs.index') }}"
                                class="text-gray-400 hover:text-accent-orange text-sm transition-colors">Blog & Tips</a></li>
                        <li><a href="{{ route('contact') }}"
                                class="text-gray-400 hover:text-accent-orange text-sm transition-colors">Contact Us</a>
                        </li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-base font-bold uppercase mb-6 tracking-wider">Stay Connected</h3>
                    <p class="text-sm text-gray-400 leading-relaxed mb-4">
                        <strong>{{ $setting->app_name ?? 'Site Ltd' }}</strong><br>
                        {!! nl2br(e($setting->address ?? "Head Office: 28 Kazi Nazrul Islam\nAve, Navana Zohura Square, Dhaka 1000")) !!}
                    </p>
                    <p class="text-sm text-gray-400">
                        Email:<br>
                        <a href="mailto:{{ $setting->contact_email ?? 'contact@iosbd.com.bd' }}"
                            class="text-accent-orange hover:underline">{{ $setting->contact_email ?? 'contact@iosbd.com.bd' }}</a>
                    </p>
                </div>
                <div>
                    <div class="flex gap-4 mt-8">
                        <a href="{{ asset('apk/iosbd.apk') }}" download><img
                                src="{{ asset('icon/GetItOnGooglePlay_Badge_Web_color_English.png') }}"
                                alt="Google Play" class="h-9"></a>
                        <a href="#"><img src="{{ asset('icon/5a902db97f96951c82922874.png') }}"
                                alt="App Store" class="h-9"></a>
                    </div>
                    <div class="flex gap-4 mt-8">
                        @if ($setting && $setting->facebook_url)
                            <a href="{{ $setting->facebook_url }}" target="_blank"
                                class="text-white opacity-70 hover:opacity-100 hover:text-accent-orange transition-all text-xl"><img
                                    class="w-8" src="{{ asset('icon/facebook.png') }}"></a>
                        @endif
                        @if ($setting && $setting->youtube_url)
                            <a href="{{ $setting->youtube_url }}" target="_blank"
                                class="text-white opacity-70 hover:opacity-100 hover:text-accent-orange transition-all text-xl"><img
                                    class="w-8" src="{{ asset('icon/youtube.png') }}"></a>
                        @endif
                        @if ($setting && $setting->instagram_url)
                            <a href="{{ $setting->instagram_url }}" target="_blank"
                                class="text-white opacity-70 hover:opacity-100 hover:text-accent-orange transition-all text-xl"><img
                                    class="w-8" src="{{ asset('icon/instagram.png') }}"></a>
                        @endif
                        @if ($setting && $setting->whatsapp_number)
                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $setting->whatsapp_number) }}?text={{ urlencode('Hello Sir, I would like to inquire about your products and services. Page: ' . url()->current()) }}"
                                target="_blank"
                                class="text-white opacity-70 hover:opacity-100 hover:text-accent-orange transition-all text-xl"><img
                                    class="w-8" src="{{ asset('icon/whatsapp.png') }}"></a>
                        @endif
                    </div>
                    <div class="mt-8">
                        <img src="{{ asset('icon/payment_logo.png') }}" alt="Payment Methods"
                            class="w-full max-w-[300px] opacity-90 hover:opacity-100 transition-opacity">
                    </div>
                </div>
            </div>

            <div
                class="mt-16 pt-6 border-t border-[#1e2e3a] flex flex-col md:flex-row justify-between items-center text-gray-400 text-[12px] gap-4">
                <p>{{ $setting->footer_text ?? '© 2026 ' . ($setting->app_name ?? 'Site') . ' | All rights reserved' }}
                </p>
                <p>Powered By: {{ $setting->app_name ?? 'Site' }}</p>
            </div>
        </div>
    </footer>

    <!-- Floating Actions -->
    <div class="fixed right-0 top-1/2 -translate-y-1/2 flex flex-col gap-1 z-[60]">
        <div
            class="bg-primary-dark text-white w-14 h-14 flex flex-col items-center justify-center rounded-l-md cursor-pointer relative shadow-lg">
            <div
                class="absolute top-1 right-1 bg-accent-orange text-white text-[10px] w-4 h-4 rounded-full flex items-center justify-center">
                0</div>
            <i class="fas fa-shuffle text-lg"></i>
            <span class="text-[8px] uppercase font-bold mt-1">Compare</span>
        </div>
        <a href="{{ url('/cart') }}"
            class="bg-primary-dark text-white w-14 h-14 flex flex-col items-center justify-center rounded-l-md cursor-pointer relative shadow-lg hover:bg-accent-orange transition-colors">
            <div id="cart-count-float"
                class="absolute top-1 right-1 bg-accent-orange text-white text-[10px] w-4 h-4 rounded-full flex items-center justify-center">
                {{ collect(session('cart', []))->sum('quantity') }}</div>
            <i class="fas fa-shopping-basket text-lg"></i>
            <span class="text-[8px] uppercase font-bold mt-1">Cart</span>
        </a>
        @if ($setting && $setting->whatsapp_number)
            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $setting->whatsapp_number) }}?text={{ urlencode('Hello Sir, I would like to inquire about your products and services. Page: ' . url()->current()) }}"
                target="_blank"
                class="bg-[#25D366] text-white w-14 h-14 flex flex-col items-center justify-center rounded-l-md cursor-pointer shadow-xl hover:bg-[#128C7E] transition-all duration-300 transform hover:-translate-x-1 group">
                <div class="flex flex-col items-center justify-center">
                    <img src="{{ asset('icon/whatsapp.png') }}"
                        class="w-7 h-7 object-contain mb-0.5 group-hover:scale-110 transition-transform"
                        alt="WhatsApp">
                    <span class="text-[9px] uppercase font-bold">Chat</span>
                </div>
            </a>
        @endif
    </div>

    <!-- Mobile Bottom Nav -->
    <div
        class="fixed bottom-0 left-0 w-full bg-primary-dark flex justify-around py-2.5 z-[100] shadow-2xl lg:hidden border-t border-gray-800">
        <a href="{{ url('/') }}"
            class="flex flex-col items-center text-white text-[10px] gap-1 opacity-80 hover:opacity-100 hover:text-accent-orange {{ Request::is('/') ? 'text-accent-orange opacity-100' : '' }}">
            <i class="fas fa-home text-lg"></i>
            <span>Home</span>
        </a>
        <a href="{{ url('/offers') }}"
            class="flex flex-col items-center text-white text-[10px] gap-1 opacity-80 hover:opacity-100 hover:text-accent-orange {{ Request::is('offers') ? 'text-accent-orange opacity-100' : '' }}">
            <i class="fas fa-gift text-lg"></i>
            <span>Offers</span>
        </a>
        <a href="#" class="flex flex-col items-center text-white text-[10px] gap-1 opacity-80">
            <i class="fas fa-tools text-lg"></i>
            <span>PC Builder</span>
        </a>
        <a href="{{ url('/account/account') }}"
            class="flex flex-col items-center text-white text-[10px] gap-1 opacity-80 hover:opacity-100 hover:text-accent-orange">
            <i class="fas fa-user text-lg"></i>
            <span>Account</span>
        </a>
    </div>

    <!-- Off-canvas Sidebar -->
    <div class="fixed inset-0 bg-black bg-opacity-0 z-[200] hidden transition-all duration-300 pointer-events-none"
        id="menuOverlay"></div>
    <div class="fixed top-0 left-0 w-[280px] h-full bg-white z-[201] -translate-x-full transition-transform duration-500 ease-in-out p-6 shadow-2xl overflow-y-auto"
        id="offCanvasSidebar">
        <div class="flex justify-between items-center mb-8 pb-4 border-b border-gray-100">
            @if ($setting && $setting->logo)
                <img src="{{ asset('storage/' . $setting->logo) }}" alt="{{ $setting->app_name }}" class="h-8">
            @else
                <span class="text-lg font-bold text-primary-dark">{{ $setting->app_name ?? 'Logo' }}</span>
            @endif
            <div class="text-2xl cursor-pointer text-primary-dark" id="closeMenu">
                <i class="fas fa-times"></i>
            </div>
        </div>
        <ul class="space-y-4">
            @foreach ($headerCategories as $category)
                <li>
                    <a href="{{ url('category/' . $category->slug) }}"
                        class="flex items-center gap-3 text-primary-dark text-base font-bold py-2 hover:text-accent-orange transition-colors border-b border-gray-50">
                        {{ $category->name }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>

    <script>
        const menuToggle = document.getElementById('menuToggle');
        const menuOverlay = document.getElementById('menuOverlay');
        const offCanvasSidebar = document.getElementById('offCanvasSidebar');
        const closeMenu = document.getElementById('closeMenu');

        function openSidebar() {
            menuOverlay.classList.remove('hidden');
            menuOverlay.classList.remove('pointer-events-none');
            setTimeout(() => {
                menuOverlay.classList.remove('bg-opacity-0');
                menuOverlay.classList.add('bg-opacity-50');
                offCanvasSidebar.classList.remove('-translate-x-full');
            }, 10);
        }

        function closeSidebar() {
            menuOverlay.classList.remove('bg-opacity-50');
            menuOverlay.classList.add('bg-opacity-0');
            offCanvasSidebar.classList.add('-translate-x-full');
            setTimeout(() => {
                menuOverlay.classList.add('hidden');
                menuOverlay.classList.add('pointer-events-none');
            }, 500);
        }

        if (menuToggle) menuToggle.addEventListener('click', openSidebar);
        if (closeMenu) closeMenu.addEventListener('click', closeSidebar);
        if (menuOverlay) menuOverlay.addEventListener('click', closeSidebar);

        function toggleMobileSearch() {
            const overlay = document.getElementById('mobileSearchOverlay');
            if (overlay.classList.contains('hidden')) {
                overlay.classList.remove('hidden');
                overlay.classList.add('flex');
                document.body.style.overflow = 'hidden';
            } else {
                overlay.classList.add('hidden');
                overlay.classList.remove('flex');
                document.body.style.overflow = 'auto';
            }
        }
    </script>

    <script>
        const CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        function buyNow(productId) {
            const qty = 1; // Default for home/category pages
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = '{{ route('cart.buy-now') }}';

            const csrfInput = document.createElement('input');
            csrfInput.type = 'hidden';
            csrfInput.name = '_token';
            csrfInput.value = CSRF_TOKEN;

            const idInput = document.createElement('input');
            idInput.type = 'hidden';
            idInput.name = 'product_id';
            idInput.value = productId;

            const qtyInput = document.createElement('input');
            qtyInput.type = 'hidden';
            qtyInput.name = 'quantity';
            qtyInput.value = qty;

            form.appendChild(csrfInput);
            form.appendChild(idInput);
            form.appendChild(qtyInput);
            document.body.appendChild(form);
            form.submit();
        }

        function toggleWishlist(productId, element) {
            fetch('{{ route('wishlist.toggle') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        product_id: productId
                    })
                })
                .then(response => {
                    if (response.status === 401) {
                        showLoginModal();
                        return;
                    }
                    return response.json();
                })
                .then(data => {
                    if (data && data.status === 'removed') {
                        const icon = element.querySelector('i');
                        icon.classList.remove('fas');
                        icon.classList.add('far');
                        showToast(data.message, 'success');
                    } else if (data && data.status === 'added') {
                        const icon = element.querySelector('i');
                        icon.classList.remove('far');
                        icon.classList.add('fas');
                        showToast(data.message, 'success');
                    }
                });
        }

        function showLoginModal() {
            const modal = document.getElementById('wishlist-login-modal');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            document.body.style.overflow = 'hidden';
        }

        function closeWishlistModal() {
            const modal = document.getElementById('wishlist-login-modal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
            document.body.style.overflow = 'auto';
        }

        function showToast(message, type = 'success') {
            const container = document.getElementById('toast-container');
            const toast = document.createElement('div');
            toast.className =
                `toast ${type === 'success' ? 'bg-green-600' : 'bg-red-600'} text-white px-6 py-3 rounded-lg shadow-2xl flex items-center gap-3 animate-slide-in`;
            toast.innerHTML = `
                <i class="fas ${type === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle'}"></i>
                <span class="text-sm font-bold">${message}</span>
            `;
            container.appendChild(toast);
            setTimeout(() => {
                toast.classList.add('toast-fade-out');
                setTimeout(() => toast.remove(), 500);
            }, 4000);
        }
    </script>

    <!-- App Download Popup -->
    <div id="app-popup-overlay"
        class="fixed inset-0 bg-black/60 z-[9999] hidden items-center justify-center p-4 backdrop-blur-sm animate-fade-in">
        <div class="bg-white w-full max-w-[400px] rounded-2xl overflow-hidden relative shadow-2xl animate-pop-in">
            <button onclick="closeAppPopup()"
                class="absolute top-3 right-3 w-8 h-8 flex items-center justify-center rounded-full bg-gray-100 text-gray-500 hover:bg-gray-200 transition-colors z-10">
                <i class="fas fa-times"></i>
            </button>

            <div class="bg-gradient-to-br from-primary-dark to-[#1a2b3c] p-8 text-center text-white relative">
                <div class="absolute top-0 left-0 w-full h-full opacity-10 pointer-events-none">
                    <div
                        class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-64 h-64 bg-accent-orange rounded-full blur-3xl">
                    </div>
                </div>

                @if ($setting && $setting->logo)
                    <img src="{{ asset('storage/' . $setting->logo) }}" alt="App Logo"
                        class="w-16 h-16 mx-auto mb-4 rounded-xl shadow-lg border border-white/20 p-2 bg-white object-contain">
                @endif
                <h3 class="text-xl font-bold mb-2">Get the {{ $setting->app_name ?? 'IOS BD' }} App</h3>
                <p class="text-sm text-gray-300 leading-relaxed">Shop your favorite gadgets faster and easier with our
                    mobile app.</p>
            </div>

            <div class="p-8 bg-white">
                <div class="flex flex-col gap-4">
                    <a href="{{ asset('apk/iosbd.apk') }}" download
                        class="flex items-center justify-center gap-3 bg-black text-white px-6 py-3 rounded-xl hover:scale-105 transition-transform">
                        <i class="fab fa-google-play text-2xl"></i>
                        <div class="text-left">
                            <p class="text-[10px] uppercase opacity-70 leading-none">Get it on</p>
                            <p class="text-sm font-bold leading-tight">Google Play</p>
                        </div>
                    </a>

                    <a href="#"
                        class="flex items-center justify-center gap-3 bg-black text-white px-6 py-3 rounded-xl hover:scale-105 transition-transform">
                        <i class="fab fa-apple text-2xl"></i>
                        <div class="text-left">
                            <p class="text-[10px] uppercase opacity-70 leading-none">Download on the</p>
                            <p class="text-sm font-bold leading-tight">App Store</p>
                        </div>
                    </a>
                </div>

                <div class="mt-6 text-center">
                    <button onclick="closeAppPopup()"
                        class="text-sm text-gray-400 hover:text-accent-orange transition-colors">Continue to
                        website</button>
                </div>
            </div>
        </div>
    </div>

    <style>
        @keyframes pop-in {
            from {
                transform: scale(0.9);
                opacity: 0;
            }

            to {
                transform: scale(1);
                opacity: 1;
            }
        }

        .animate-pop-in {
            animation: pop-in 0.4s cubic-bezier(0.34, 1.56, 0.64, 1) forwards;
        }

        @keyframes fade-in {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        .animate-fade-in {
            animation: fade-in 0.3s ease-out forwards;
        }

        @keyframes slide-in {
            from {
                transform: translateX(100%);
                opacity: 0;
            }

            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        .animate-slide-in {
            animation: slide-in 0.4s cubic-bezier(0.34, 1.56, 0.64, 1) forwards;
        }

        .toast-fade-out {
            opacity: 0;
            transform: translateX(20px);
            transition: all 0.5s ease-out;
        }

        .short-description-list ul {
            list-style-type: disc;
            margin-left: 15px;
            margin-bottom: 0;
        }

        .short-description-list li {
            margin-bottom: 4px;
            line-height: 1.4;
        }

        .short-description-list p {
            margin-bottom: 4px;
        }

        .rich-text-content {
            width: 100%;
            padding: 0;
            margin: 0;
        }

        .rich-text-content table {
            width: 100% !important;
            border-collapse: collapse;
            margin-bottom: 0;
            border: none !important;
            table-layout: fixed;
        }

        .rich-text-content table td,
        .rich-text-content table th {
            padding: 12px 15px;
            text-align: left;
            font-size: 14px;
            border-bottom: 1px solid #f2f4f8 !important;
            border-left: none !important;
            border-right: none !important;
            border-top: none !important;
        }

        /* Styling for header rows (Section titles like General Information) */
        .rich-text-content table th,
        .rich-text-content table td[colspan],
        .rich-text-content table td[style*="background-color"] {
            background-color: #f8faff !important;
            color: #3749bb !important;
            font-weight: bold !important;
            font-size: 14px !important;
            width: 100% !important;
        }

        .rich-text-content table tr:last-child td {
            border-bottom: none !important;
        }

        /* Styling for the first column (Labels like Battery Type) */
        .rich-text-content table td:first-child:not([colspan]) {
            width: 30%;
            color: #666;
            background-color: transparent !important;
            /* Ensure labels don't get the header background */
        }

        /* Styling for the second column (Values like LiFePO4) */
        .rich-text-content table td:last-child:not([colspan]) {
            color: #111;
            font-weight: 500;
        }

        @keyframes scale-up {
            0% {
                transform: scale(0.8);
                opacity: 0;
            }

            100% {
                transform: scale(1);
                opacity: 1;
            }
        }

        .animate-scale-up {
            animation: scale-up 0.2s ease-out forwards;
        }
    </style>

    <script>
        function showAppPopup() {
            const overlay = document.getElementById('app-popup-overlay');
            const hasShown = localStorage.getItem('app_popup_shown');

            if (!hasShown) {
                overlay.classList.remove('hidden');
                overlay.classList.add('flex');
                document.body.style.overflow = 'hidden';
            }
        }

        function closeAppPopup() {
            const overlay = document.getElementById('app-popup-overlay');
            overlay.classList.add('hidden');
            overlay.classList.remove('flex');
            document.body.style.overflow = 'auto';
            // Set it so it doesn't show again for 24 hours
            const expiry = new Date().getTime() + (24 * 60 * 60 * 1000);
            localStorage.setItem('app_popup_shown', expiry);
        }

        document.addEventListener('DOMContentLoaded', function() {
            const hasShown = localStorage.getItem('app_popup_shown');
            const now = new Date().getTime();

            // If shown more than 24 hours ago, clear it
            if (hasShown && now > parseInt(hasShown)) {
                localStorage.removeItem('app_popup_shown');
            }

            if (!localStorage.getItem('app_popup_shown')) {
                setTimeout(showAppPopup, 5000);
            }
        });
    </script>

    <!-- Toast Container -->
    <div id="toast-container" class="fixed bottom-10 right-10 z-[11000] flex flex-col gap-3"></div>

    <!-- Link Copied Modal -->
    <div id="link-copied-modal"
        class="fixed inset-0 bg-black/40 z-[20000] hidden items-center justify-center backdrop-blur-sm">
        <div class="bg-white rounded-lg p-6 shadow-2xl text-center animate-scale-up">
            <div
                class="w-12 h-12 bg-green-100 text-green-600 rounded-full flex items-center justify-center mx-auto mb-3">
                <i class="fas fa-check text-xl"></i>
            </div>
            <h3 class="text-lg font-bold text-gray-800">Link Copied!</h3>
            <p class="text-gray-500 text-sm mt-1">The product link has been copied to your clipboard.</p>
        </div>
    </div>

    <!-- Wishlist Login Prompt Modal -->
    <div id="wishlist-login-modal"
        class="fixed inset-0 bg-black/60 z-[10000] hidden items-center justify-center p-4 backdrop-blur-sm">
        <div class="bg-white w-full max-w-[500px] rounded-lg overflow-hidden relative shadow-2xl animate-pop-in">
            <button onclick="closeWishlistModal()"
                class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 transition-colors">
                <i class="fas fa-times text-xl"></i>
            </button>

            <div class="p-8 text-center">
                <div
                    class="w-16 h-16 bg-orange-50 text-accent-orange rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-info-circle text-3xl"></i>
                </div>

                <h3 class="text-xl font-bold text-gray-800 mb-3">Login Required</h3>
                <p class="text-gray-600 mb-8">Please login to your account to save products in your Wish List!</p>

                <div class="flex gap-4 justify-center">
                    <a href="{{ route('login') }}"
                        class="px-8 py-3 bg-primary-dark text-white rounded-md font-bold hover:bg-opacity-90 transition-all">Login
                        Now</a>
                    <button onclick="closeWishlistModal()"
                        class="px-8 py-3 border border-gray-200 text-gray-600 rounded-md font-bold hover:bg-gray-50 transition-all">Continue</button>
                </div>
            </div>
        </div>
    </div>

    @yield('scripts')

</body>

</html>
