<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Star Tech | Leading IT Shop in Bangladesh')</title>
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

<header class="bg-primary-dark py-4 text-white">
    <div class="max-w-[1320px] mx-auto px-4 flex items-center justify-between gap-4">
        <!-- Mobile Menu Toggle -->
        <div class="lg:hidden text-2xl cursor-pointer" id="menuToggle">
            <i class="fas fa-bars"></i>
        </div>

        <!-- Logo -->
        <div class="flex-shrink-0">
            <a href="{{ url('/') }}">
                <img src="https://www.startech.com.bd/image/catalog/logo.png" alt="Star Tech" class="h-10 lg:h-12">
            </a>
        </div>
        
        <!-- Search Bar Desktop -->
        <div class="hidden lg:flex flex-grow max-w-[700px] relative mx-8">
            <input type="text" placeholder="Search" class="w-full py-2.5 pr-10 pl-4 rounded text-primary-dark focus:outline-none">
            <i class="fas fa-search absolute right-3 top-1/2 -translate-y-1/2 text-primary-dark"></i>
        </div>

        <!-- Mobile Icons -->
        <div class="lg:hidden flex gap-4 items-center">
            <div class="cursor-pointer">
                <i class="fas fa-search text-xl"></i>
            </div>
            <div class="relative cursor-pointer">
                <i class="fas fa-shopping-basket text-xl"></i>
                <span class="absolute -top-2 -right-2 bg-accent-orange text-white text-[10px] w-4 h-4 rounded-full flex items-center justify-center">0</span>
            </div>
        </div>

        <!-- Header Actions Desktop -->
        <div class="hidden lg:flex items-center gap-6">
            <div class="flex items-center gap-2 cursor-pointer group">
                <i class="fas fa-gift text-accent-orange text-xl"></i>
                <div class="flex flex-col">
                    <span class="text-sm font-bold">Offers</span>
                    <span class="text-[11px] text-gray-400">Latest Offers</span>
                </div>
            </div>
            <div class="flex items-center gap-2 cursor-pointer group">
                <i class="fas fa-bolt text-accent-orange text-xl"></i>
                <div class="flex flex-col">
                    <span class="text-sm font-bold">Happy Hour</span>
                    <span class="text-[11px] text-gray-400">Special Deals</span>
                </div>
            </div>
            <div class="flex items-center gap-2 cursor-pointer group">
                <i class="fas fa-user text-accent-orange text-xl"></i>
                <div class="flex flex-col">
                    <span class="text-sm font-bold">Account</span>
                    <span class="text-[11px] text-gray-400">Register or Login</span>
                </div>
            </div>
            <a href="#" class="bg-accent-blue hover:bg-opacity-90 text-white py-3 px-6 rounded font-bold text-sm transition-all">PC Builder</a>
        </div>
    </div>
</header>

<!-- Main Navigation Desktop -->
<nav class="bg-white shadow-sm sticky top-0 z-[50] hidden lg:block">
    <div class="max-w-[1320px] mx-auto px-4">
        <ul class="flex justify-between">
            @php
                $navItems = [
                    'Desktop' => [
                        'All Desktop' => [],
                        'Gaming PC' => [],
                        'Brand PC' => [],
                        'All-in-One PC' => []
                    ],
                    'Laptop' => [
                        'All Laptop' => [],
                        'Gaming Laptop' => [],
                        'Premium Ultrabook' => [],
                        'Laptop Brands' => ['Lenovo', 'HP', 'Asus', 'Apple', 'MSI', 'Gigabyte', 'Acer']
                    ],
                    'Component' => [
                        'Processor' => ['Intel', 'AMD'],
                        'Motherboard' => ['Asus', 'Gigabyte', 'MSI'],
                        'RAM' => ['Desktop RAM', 'Laptop RAM'],
                        'Graphics Card' => []
                    ],
                    'Monitor' => [],
                    'Power' => [],
                    'Phone' => [],
                    'Tablet' => [],
                    'Office Equipment' => [],
                    'Camera' => [],
                    'Security' => [],
                    'Networking' => [],
                    'Software' => [],
                    'Server & Storage' => [],
                    'Accessories' => [],
                    'Gadget' => [],
                    'Gaming' => [],
                    'TV' => [],
                    'Appliance' => []
                ];
            @endphp
            @foreach($navItems as $item => $subItems)
                <li class="group py-4 relative">
                    <a href="#" class="text-[13px] font-semibold text-primary-dark hover:text-accent-orange transition-colors flex items-center gap-1">
                        {{ $item }}
                        @if(!empty($subItems))
                            <i class="fas fa-chevron-down text-[10px] opacity-50"></i>
                        @endif
                    </a>
                    @if(!empty($subItems))
                        <div class="nav-dropdown absolute top-full left-0 bg-white min-w-[220px] shadow-xl py-2 z-[60] border-t-2 border-accent-orange">
                            @foreach($subItems as $sub => $nestedItems)
                                <div class="relative sub-dropdown-trigger">
                                    <a href="#" class="flex justify-between items-center px-4 py-2.5 text-sm text-primary-dark hover:bg-gray-50 hover:text-accent-orange transition-colors">
                                        {{ $sub }}
                                        @if(!empty($nestedItems))
                                            <i class="fas fa-chevron-right text-[10px] opacity-50"></i>
                                        @endif
                                    </a>
                                    @if(!empty($nestedItems))
                                        <div class="sub-dropdown bg-white min-w-[200px] shadow-xl py-2 border-l border-gray-100">
                                            @foreach($nestedItems as $nested)
                                                <a href="#" class="block px-4 py-2 text-sm text-primary-dark hover:bg-gray-50 hover:text-accent-orange transition-colors">{{ $nested }}</a>
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

<main class="py-6">
    <div class="max-w-[1320px] mx-auto px-4">
        @yield('content')
    </div>
</main>

<footer class="bg-primary-dark text-white pt-16 pb-8 mt-12">
    <div class="max-w-[1320px] mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12">
            <div>
                <h3 class="text-base font-bold uppercase mb-6 tracking-wider">Support</h3>
                <div class="flex items-center gap-4 bg-[#11212d] py-4 px-6 rounded-full mb-4 border border-[#1e2e3a]">
                    <i class="fas fa-phone text-accent-orange text-xl"></i>
                    <div>
                        <span class="text-[11px] text-gray-400 block">9 AM - 8 PM</span>
                        <span class="text-lg font-bold text-accent-orange">16793</span>
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
                    <li><a href="#" class="text-gray-400 hover:text-accent-orange text-sm transition-colors">EMI Terms</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-accent-orange text-sm transition-colors">Privacy Policy</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-accent-orange text-sm transition-colors">Star Point Policy</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-accent-orange text-sm transition-colors">Brands</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-accent-orange text-sm transition-colors">About Us</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-accent-orange text-sm transition-colors">Terms and Conditions</a></li>
                </ul>
            </div>
            <div>
                <h3 class="text-base font-bold uppercase mb-6 tracking-wider">Stay Connected</h3>
                <p class="text-sm text-gray-400 leading-relaxed mb-4">
                    <strong>Star Tech Ltd</strong><br>
                    Head Office: 28 Kazi Nazrul Islam<br>
                    Ave, Navana Zohura Square, Dhaka 1000
                </p>
                <p class="text-sm text-gray-400">
                    Email:<br>
                    <a href="mailto:webteam@startechbd.com" class="text-accent-orange hover:underline">webteam@startechbd.com</a>
                </p>
            </div>
            <div>
                <div class="flex gap-4 mt-8">
                    <a href="#"><img src="https://www.startech.com.bd/catalog/view/theme/starship/images/google-play.png" alt="Google Play" class="h-9"></a>
                    <a href="#"><img src="https://www.startech.com.bd/catalog/view/theme/starship/images/app-store.png" alt="App Store" class="h-9"></a>
                </div>
                <div class="flex gap-4 mt-8">
                    <a href="#" class="text-white opacity-70 hover:opacity-100 hover:text-accent-orange transition-all text-xl"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="text-white opacity-70 hover:opacity-100 hover:text-accent-orange transition-all text-xl"><i class="fab fa-youtube"></i></a>
                    <a href="#" class="text-white opacity-70 hover:opacity-100 hover:text-accent-orange transition-all text-xl"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>

        <div class="mt-16 pt-6 border-t border-[#1e2e3a] flex flex-col md:flex-row justify-between items-center text-gray-400 text-[12px] gap-4">
            <p>© 2026 Star Tech Ltd | All rights reserved</p>
            <p>Powered By: Star Tech</p>
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
    <div class="bg-primary-dark text-white w-14 h-14 flex flex-col items-center justify-center rounded-l-md cursor-pointer relative shadow-lg">
        <div class="absolute top-1 right-1 bg-accent-orange text-white text-[10px] w-4 h-4 rounded-full flex items-center justify-center">0</div>
        <i class="fas fa-shopping-basket text-lg"></i>
        <span class="text-[8px] uppercase font-bold mt-1">Cart</span>
    </div>
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
        <img src="https://www.startech.com.bd/image/catalog/logo.png" alt="Star Tech" class="h-8">
        <div class="text-2xl cursor-pointer text-primary-dark" id="closeMenu">
            <i class="fas fa-times"></i>
        </div>
    </div>
    <ul class="space-y-4">
        @foreach($navItems as $item => $subItems)
            <li><a href="#" class="text-primary-dark text-base font-medium block py-2 hover:text-accent-orange transition-colors border-b border-gray-50">{{ $item }}</a></li>
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
</script>

@yield('scripts')

</body>
</html>
