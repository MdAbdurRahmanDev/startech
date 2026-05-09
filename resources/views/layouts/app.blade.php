<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', $setting->app_name ?? 'Star Tech') | Leading IT Shop in Bangladesh</title>
    
    @if($setting && $setting->favicon)
        <link rel="icon" type="image/x-icon" href="{{ asset('storage/' . $setting->favicon) }}">
    @endif

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @yield('styles')
    <style>
        /* Custom smooth transitions for dropdowns and sub-dropdowns */
        .nav-dropdown, .sub-dropdown {
            opacity: 0;
            visibility: hidden;
            transform: translateY(10px);
            transition: all 0.3s ease-in-out;
        }
        
        .group:hover > .nav-dropdown {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        /* Sub-dropdown sliding from left/right or down */
        .sub-dropdown-trigger:hover > .sub-dropdown {
            opacity: 1;
            visibility: visible;
            transform: translateX(0);
        }

        .sub-dropdown {
            transform: translateX(10px); /* Slide from right */
            position: absolute;
            top: 0;
            left: 100%;
        }
    </style>
</head>
<body class="bg-bg-gray text-primary-dark font-sans min-h-screen">

    <!-- Toast Notifications -->
    <div id="toast-container" class="fixed top-20 right-5 z-[9999] flex flex-col gap-3">
        @if(session('success'))
            <div class="toast bg-green-600 text-white px-6 py-3 rounded-lg shadow-2xl flex items-center gap-3 animate-slide-in">
                <i class="fas fa-check-circle"></i>
                <span class="text-sm font-bold">{{ session('success') }}</span>
            </div>
        @endif
        @if(session('error'))
            <div class="toast bg-red-600 text-white px-6 py-3 rounded-lg shadow-2xl flex items-center gap-3 animate-slide-in">
                <i class="fas fa-exclamation-circle"></i>
                <span class="text-sm font-bold">{{ session('error') }}</span>
            </div>
        @endif
    </div>

    <style>
        @keyframes slide-in {
            from { transform: translateX(100%); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }
        .animate-slide-in { animation: slide-in 0.3s ease-out forwards; }
        .toast-fade-out { opacity: 0; transform: translateX(100%); transition: all 0.5s ease-in-out; }
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

<header class="bg-primary-dark py-4 text-white">
    <div class="max-w-[1320px] mx-auto px-1.5 md:px-2 flex items-center justify-between gap-4">
        <!-- Mobile Menu Toggle -->
        <div class="lg:hidden text-2xl cursor-pointer" id="menuToggle">
            <i class="fas fa-bars"></i>
        </div>

        <!-- Logo -->
        <div class="flex-shrink-0">
            <a href="{{ url('/') }}">
                @if($setting && $setting->logo)
                    <img src="{{ asset('storage/' . $setting->logo) }}" alt="{{ $setting->app_name }}" class="h-10 lg:h-12">
                @else
                    <img src="https://www.startech.com.bd/image/catalog/logo.png" alt="Star Tech" class="h-10 lg:h-12">
                @endif
            </a>
        </div>
        
        <!-- Search Bar Desktop -->
        <form action="{{ url('search') }}" method="GET" class="hidden lg:flex flex-grow max-w-[700px] relative mx-8">
            <input type="text" name="q" value="{{ request('q') }}" placeholder="Search" class="w-full py-2.5 pr-10 pl-4 rounded text-primary-dark focus:outline-none">
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
                <span id="cart-count-mobile" class="absolute -top-2 -right-2 bg-accent-orange text-white text-[10px] w-4 h-4 rounded-full flex items-center justify-center">{{ collect(session('cart', []))->sum('quantity') }}</span>
            </div>
        </div>

        <!-- Header Actions Desktop -->
        <div class="hidden lg:flex items-center gap-6">
            <a href="{{ route('offers.index') }}" class="flex items-center gap-2 cursor-pointer group">
                <i class="fas fa-gift text-accent-orange text-xl"></i>
                <div class="flex flex-col">
                    <span class="text-sm font-bold">Offers</span>
                    <span class="text-[11px] text-gray-400">Latest Offers</span>
                </div>
            </a>
            <a href="{{ route('services.index') }}" class="flex items-center gap-2 cursor-pointer group">
                <i class="fas fa-tools text-accent-orange text-xl"></i>
                <div class="flex flex-col">
                    <span class="text-sm font-bold">Services</span>
                    <span class="text-[11px] text-gray-400">Our Services</span>
                </div>
            </a>
            <div class="relative group cursor-pointer py-4">
                <div class="flex items-center gap-2">
                    <i class="fas fa-user text-accent-orange text-xl"></i>
                    <div class="flex flex-col">
                        <span class="text-sm font-bold">@auth {{ Auth::user()->first_name }} @else Account @endauth</span>
                        <span class="text-[11px] text-gray-400">@auth Dashboard @else Register or Login @endauth</span>
                    </div>
                </div>
                <!-- Account Dropdown -->
                <div class="absolute top-full right-0 bg-white min-w-[180px] shadow-xl py-2 z-[100] border-t-2 border-accent-orange opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 translate-y-2 group-hover:translate-y-0">
                    @guest
                        <a href="{{ route('user.register') }}" class="block px-4 py-2 text-sm text-primary-dark hover:bg-gray-50 hover:text-accent-orange transition-colors">Register</a>
                        <a href="{{ route('user.login') }}" class="block px-4 py-2 text-sm text-primary-dark hover:bg-gray-50 hover:text-accent-orange transition-colors">Login</a>
                    @else
                        <a href="{{ route('user.account') }}" class="block px-4 py-2 text-sm text-primary-dark hover:bg-gray-50 hover:text-accent-orange transition-colors">My Account</a>
                        <a href="{{ route('user.order') }}" class="block px-4 py-2 text-sm text-primary-dark hover:bg-gray-50 hover:text-accent-orange transition-colors">Orders</a>
                        <hr class="my-1 border-gray-100">
                        <form action="{{ route('user.logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-500 hover:bg-gray-50 transition-colors">Logout</button>
                        </form>
                    @endguest
                </div>
            </div>
            <a href="#" class="bg-accent-blue hover:bg-opacity-90 text-white py-3 px-6 rounded font-bold text-sm transition-all">PC Builder</a>
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
    <div class="max-w-[1320px] mx-auto px-1.5 md:px-2">
        <ul class="flex justify-between">
            @foreach($headerCategories as $category)
                <li class="group py-4 relative">
                    <a href="{{ url('category/' . $category->slug) }}" class="text-[13px] font-semibold text-primary-dark hover:text-accent-orange transition-colors flex items-center gap-1.5">
                        @if($category->image)
                            <img src="{{ asset('storage/' . $category->image) }}" class="w-4 h-4 object-contain">
                        @elseif($category->icon)
                            <i class="{{ $category->icon }} text-xs opacity-70"></i>
                        @endif
                        {{ $category->name }}
                        @if($category->children->count() > 0)
                            <i class="fas fa-chevron-down text-[10px] opacity-50"></i>
                        @endif
                    </a>
                    @if($category->children->count() > 0)
                        <div class="nav-dropdown absolute top-full left-0 bg-white min-w-[220px] shadow-xl py-2 z-[60] border-t-2 border-accent-orange">
                            @foreach($category->children as $sub)
                                <div class="relative sub-dropdown-trigger">
                                    <a href="{{ url('category/' . $sub->slug) }}" class="flex justify-between items-center px-4 py-2.5 text-sm text-primary-dark hover:bg-gray-50 hover:text-accent-orange transition-colors">
                                        <div class="flex items-center gap-2">
                                            @if($sub->image)
                                                <img src="{{ asset('storage/' . $sub->image) }}" class="w-4 h-4 object-contain">
                                            @endif
                                            {{ $sub->name }}
                                        </div>
                                        @if($sub->children->count() > 0)
                                            <i class="fas fa-chevron-right text-[10px] opacity-50"></i>
                                        @endif
                                    </a>
                                    @if($sub->children->count() > 0)
                                        <div class="sub-dropdown bg-white min-w-[200px] shadow-xl py-2 border-l border-gray-100">
                                            @foreach($sub->children as $subSub)
                                                <a href="{{ url('category/' . $subSub->slug) }}" class="block px-4 py-2 text-sm text-primary-dark hover:bg-gray-50 hover:text-accent-orange transition-colors">{{ $subSub->name }}</a>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @endif
                </li>
            @endforeach
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
                <div class="flex items-center gap-4 bg-[#11212d] py-4 px-6 rounded-full mb-4 border border-[#1e2e3a]">
                    <i class="fas fa-phone text-accent-orange text-xl"></i>
                    <div>
                        <span class="text-[11px] text-gray-400 block">9 AM - 8 PM</span>
                        <span class="text-lg font-bold text-accent-orange">{{ $setting->phone_number ?? '16793' }}</span>
                    </div>
                </div>
                <div class="flex items-center gap-4 bg-[#11212d] py-4 px-6 rounded-full mb-4 border border-[#1e2e3a]">
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
                    @foreach($footerPages as $fPage)
                        <li><a href="{{ url('info/' . $fPage->slug) }}" class="text-gray-400 hover:text-accent-orange text-sm transition-colors">{{ $fPage->title }}</a></li>
                    @endforeach
                    <li><a href="{{ route('order.track') }}" class="text-gray-400 hover:text-accent-orange text-sm transition-colors font-bold">Order Tracking</a></li>
                    <li><a href="{{ route('contact') }}" class="text-gray-400 hover:text-accent-orange text-sm transition-colors">Contact Us</a></li>
                </ul>
            </div>
            <div>
                <h3 class="text-base font-bold uppercase mb-6 tracking-wider">Stay Connected</h3>
                <p class="text-sm text-gray-400 leading-relaxed mb-4">
                    <strong>{{ $setting->app_name ?? 'Star Tech Ltd' }}</strong><br>
                    {!! nl2br(e($setting->address ?? "Head Office: 28 Kazi Nazrul Islam\nAve, Navana Zohura Square, Dhaka 1000")) !!}
                </p>
                <p class="text-sm text-gray-400">
                    Email:<br>
                    <a href="mailto:{{ $setting->contact_email ?? 'webteam@startechbd.com' }}" class="text-accent-orange hover:underline">{{ $setting->contact_email ?? 'webteam@startechbd.com' }}</a>
                </p>
            </div>
            <div>
                <div class="flex gap-4 mt-8">
                    <a href="#"><img src="https://www.startech.com.bd/catalog/view/theme/starship/images/google-play.png" alt="Google Play" class="h-9"></a>
                    <a href="#"><img src="https://www.startech.com.bd/catalog/view/theme/starship/images/app-store.png" alt="App Store" class="h-9"></a>
                </div>
                <div class="flex gap-4 mt-8">
                    @if($setting && $setting->facebook_url)
                        <a href="{{ $setting->facebook_url }}" target="_blank" class="text-white opacity-70 hover:opacity-100 hover:text-accent-orange transition-all text-xl"><i class="fab fa-facebook-f"></i></a>
                    @endif
                    @if($setting && $setting->youtube_url)
                        <a href="{{ $setting->youtube_url }}" target="_blank" class="text-white opacity-70 hover:opacity-100 hover:text-accent-orange transition-all text-xl"><i class="fab fa-youtube"></i></a>
                    @endif
                    @if($setting && $setting->instagram_url)
                        <a href="{{ $setting->instagram_url }}" target="_blank" class="text-white opacity-70 hover:opacity-100 hover:text-accent-orange transition-all text-xl"><i class="fab fa-instagram"></i></a>
                    @endif
                    @if($setting && $setting->whatsapp_number)
                        <a href="https://wa.me/{{ $setting->whatsapp_number }}" target="_blank" class="text-white opacity-70 hover:opacity-100 hover:text-accent-orange transition-all text-xl"><i class="fab fa-whatsapp"></i></a>
                    @endif
                </div>
            </div>
        </div>

        <div class="mt-16 pt-6 border-t border-[#1e2e3a] flex flex-col md:flex-row justify-between items-center text-gray-400 text-[12px] gap-4">
            <p>{{ $setting->footer_text ?? '© 2026 Star Tech Ltd | All rights reserved' }}</p>
            <p>Powered By: {{ $setting->app_name ?? 'Star Tech' }}</p>
        </div>
    </div>
</footer>

<!-- Floating Actions -->
<div class="fixed right-0 top-1/2 -translate-y-1/2 flex flex-col gap-1 z-[60]">
    <div class="bg-primary-dark text-white w-14 h-14 flex flex-col items-center justify-center rounded-l-md cursor-pointer relative shadow-lg">
        <div class="absolute top-1 right-1 bg-accent-orange text-white text-[10px] w-4 h-4 rounded-full flex items-center justify-center">0</div>
        <i class="fas fa-shuffle text-lg"></i>
        <span class="text-[8px] uppercase font-bold mt-1">Compare</span>
    </div>
    <a href="{{ url('/cart') }}" class="bg-primary-dark text-white w-14 h-14 flex flex-col items-center justify-center rounded-l-md cursor-pointer relative shadow-lg hover:bg-accent-orange transition-colors">
        <div id="cart-count-float" class="absolute top-1 right-1 bg-accent-orange text-white text-[10px] w-4 h-4 rounded-full flex items-center justify-center">{{ collect(session('cart', []))->sum('quantity') }}</div>
        <i class="fas fa-shopping-basket text-lg"></i>
        <span class="text-[8px] uppercase font-bold mt-1">Cart</span>
    </a>
</div>

<!-- Mobile Bottom Nav -->
<div class="fixed bottom-0 left-0 w-full bg-primary-dark flex justify-around py-2.5 z-[100] shadow-2xl lg:hidden border-t border-gray-800">
    <a href="{{ url('/') }}" class="flex flex-col items-center text-white text-[10px] gap-1 opacity-80 hover:opacity-100 hover:text-accent-orange {{ Request::is('/') ? 'text-accent-orange opacity-100' : '' }}">
        <i class="fas fa-home text-lg"></i>
        <span>Home</span>
    </a>
    <a href="{{ url('/offers') }}" class="flex flex-col items-center text-white text-[10px] gap-1 opacity-80 hover:opacity-100 hover:text-accent-orange {{ Request::is('offers') ? 'text-accent-orange opacity-100' : '' }}">
        <i class="fas fa-gift text-lg"></i>
        <span>Offers</span>
    </a>
    <a href="#" class="flex flex-col items-center text-white text-[10px] gap-1 opacity-80">
        <i class="fas fa-tools text-lg"></i>
        <span>PC Builder</span>
    </a>
    <a href="{{ url('/account/account') }}" class="flex flex-col items-center text-white text-[10px] gap-1 opacity-80 hover:opacity-100 hover:text-accent-orange">
        <i class="fas fa-user text-lg"></i>
        <span>Account</span>
    </a>
</div>

<!-- Off-canvas Sidebar -->
<div class="fixed inset-0 bg-black bg-opacity-0 z-[200] hidden transition-all duration-300 pointer-events-none" id="menuOverlay"></div>
<div class="fixed top-0 left-0 w-[280px] h-full bg-white z-[201] -translate-x-full transition-transform duration-500 ease-in-out p-6 shadow-2xl overflow-y-auto" id="offCanvasSidebar">
    <div class="flex justify-between items-center mb-8 pb-4 border-b border-gray-100">
        @if($setting && $setting->logo)
            <img src="{{ asset('storage/' . $setting->logo) }}" alt="{{ $setting->app_name }}" class="h-8">
        @else
            <img src="https://www.startech.com.bd/image/catalog/logo.png" alt="Star Tech" class="h-8">
        @endif
        <div class="text-2xl cursor-pointer text-primary-dark" id="closeMenu">
            <i class="fas fa-times"></i>
        </div>
    </div>
    <ul class="space-y-4">
        @foreach($headerCategories as $category)
            <li>
                <a href="{{ url('category/' . $category->slug) }}" class="flex items-center gap-3 text-primary-dark text-base font-medium py-2 hover:text-accent-orange transition-colors border-b border-gray-50">
                    @if($category->image)
                        <img src="{{ asset('storage/' . $category->image) }}" class="w-5 h-5 object-contain">
                    @elseif($category->icon)
                        <i class="{{ $category->icon }} text-sm"></i>
                    @endif
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

    if(menuToggle) menuToggle.addEventListener('click', openSidebar);
    if(closeMenu) closeMenu.addEventListener('click', closeSidebar);
    if(menuOverlay) menuOverlay.addEventListener('click', closeSidebar);

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
        form.action = '{{ route("cart.buy-now") }}';
        
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
</script>

@yield('scripts')

</body>
</html>
