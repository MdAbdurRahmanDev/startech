<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @yield('styles')
    @stack('styles')
</head>

<body>


    <nav class="fixed top-0 z-50 w-full bg-neutral-primary-soft border-b border-default">
        <div class="px-3 py-3 lg:px-5 lg:pl-3">
            <div class="flex items-center justify-between">
                <div class="flex items-center justify-start rtl:justify-end">
                    <button data-drawer-target="top-bar-sidebar" data-drawer-toggle="top-bar-sidebar"
                        aria-controls="top-bar-sidebar" type="button"
                        class="sm:hidden text-heading bg-transparent box-border border border-transparent hover:bg-neutral-secondary-medium focus:ring-4 focus:ring-neutral-tertiary font-medium leading-5 rounded-base text-sm p-2 focus:outline-none">
                        <span class="sr-only">Open sidebar</span>
                        <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-width="2"
                                d="M5 7h14M5 12h14M5 17h10" />
                        </svg>
                    </button>
                    <a href="{{ route('dashboard') }}" class="flex ms-2 md:me-24">
                        @if ($setting && $setting->logo)
                            <img src="{{ asset('storage/' . $setting->logo) }}" class="h-8 me-3" alt="Logo" />
                        @endif
                        <span
                            class="self-center text-lg font-bold whitespace-nowrap text-heading">{{ $setting->app_name ?? 'Admin' }}</span>
                    </a>
                </div>
                <div class="flex items-center">
                    <div class="flex items-center ms-3">
                        <div>
                            <button type="button"
                                class="flex text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600"
                                aria-expanded="false" data-dropdown-toggle="dropdown-user">
                                <span class="sr-only">Open user menu</span>
                                <img class="w-8 h-8 rounded-full"
                                    src="https://flowbite.com/docs/images/people/profile-picture-5.jpg"
                                    alt="user photo">
                            </button>
                        </div>
                        <div class="z-50 hidden bg-neutral-primary-medium border border-default-medium rounded-base shadow-lg w-44"
                            id="dropdown-user">
                            <div class="px-4 py-3 border-b border-default-medium" role="none">
                                <p class="text-sm font-medium text-heading" role="none">
                                    {{ Auth::guard('admin')->user()->name }}
                                </p>
                                <p class="text-sm text-body truncate" role="none">
                                    {{ Auth::guard('admin')->user()->email }}
                                </p>
                            </div>
                            <ul class="p-2 text-sm text-body font-medium" role="none">
                                <li>
                                    <a href="{{ route('dashboard') }}"
                                        class="inline-flex items-center w-full p-2 hover:bg-neutral-tertiary-medium hover:text-heading rounded"
                                        role="menuitem">Dashboard</a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.profile') }}"
                                        class="inline-flex items-center w-full p-2 hover:bg-neutral-tertiary-medium hover:text-heading rounded"
                                        role="menuitem">Profile Settings</a>
                                </li>
                                <li>
                                    <a href="#"
                                        class="inline-flex items-center w-full p-2 hover:bg-neutral-tertiary-medium hover:text-heading rounded"
                                        role="menuitem">Earnings</a>
                                </li>
                                <li>
                                    <form action="{{ route('logout') }}" method="POST" id="logout-form" class="hidden">
                                        @csrf</form>
                                    <a href="#"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                        class="inline-flex items-center w-full p-2 hover:bg-neutral-tertiary-medium hover:text-heading rounded text-red-500"
                                        role="menuitem">Sign out</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <aside id="top-bar-sidebar"
        class="fixed top-0 left-0 z-40 w-64 h-full transition-transform -translate-x-full sm:translate-x-0"
        aria-label="Sidebar">
        <div class="h-full px-3 py-4 overflow-y-auto bg-neutral-primary-soft border-e border-default">
            <a href="{{ route('dashboard') }}" class="flex items-center ps-2.5 mb-5">
                @if ($setting && $setting->logo)
                    <img src="{{ asset('storage/' . $setting->logo) }}" class="h-6 me-3" alt="Logo" />
                @endif
                <span class="self-center text-lg text-heading font-semibold whitespace-nowrap">{{ $setting->app_name ?? 'Admin' }}</span>
            </a>
            <ul class="space-y-4 font-medium">
                <!-- Dashboard -->
                <li>
                    <a href="{{ route('dashboard') }}"
                        class="flex items-center px-3 py-2 text-sm text-body rounded-lg {{ request()->routeIs('dashboard') ? 'bg-neutral-tertiary text-fg-brand font-bold shadow-sm' : '' }} hover:bg-neutral-tertiary hover:text-fg-brand group transition-all">
                        <i class="fas fa-home w-5 text-center text-base transition duration-75 text-gray-500 group-hover:text-fg-brand {{ request()->routeIs('dashboard') ? 'text-fg-brand' : '' }}"></i>
                        <span class="ms-3">Dashboard</span>
                    </a>
                </li>

                <!-- SECTION 1: CORE CATALOG -->
                <li class="pt-2">
                    <span class="px-3 text-[10px] font-bold text-gray-400 uppercase tracking-widest block mb-2">Catalog & Store</span>
                    <ul class="space-y-1">
                        <li>
                            <a href="{{ route('admin.products.index') }}"
                                class="flex items-center px-3 py-1.5 text-xs text-body rounded-lg {{ request()->routeIs('admin.products.*') ? 'bg-neutral-tertiary text-fg-brand font-bold' : '' }} hover:bg-neutral-tertiary hover:text-fg-brand group transition-all">
                                <i class="fas fa-box w-5 text-center text-gray-500 group-hover:text-fg-brand {{ request()->routeIs('admin.products.*') ? 'text-fg-brand' : '' }}"></i>
                                <span class="ms-3">Products</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.categories.index') }}"
                                class="flex items-center px-3 py-1.5 text-xs text-body rounded-lg {{ request()->routeIs('admin.categories.*') ? 'bg-neutral-tertiary text-fg-brand font-bold' : '' }} hover:bg-neutral-tertiary hover:text-fg-brand group transition-all">
                                <i class="fas fa-sitemap w-5 text-center text-gray-500 group-hover:text-fg-brand {{ request()->routeIs('admin.categories.*') ? 'text-fg-brand' : '' }}"></i>
                                <span class="ms-3">Categories</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.brands.index') }}"
                                class="flex items-center px-3 py-1.5 text-xs text-body rounded-lg {{ request()->routeIs('admin.brands.*') ? 'bg-neutral-tertiary text-fg-brand font-bold' : '' }} hover:bg-neutral-tertiary hover:text-fg-brand group transition-all">
                                <i class="fas fa-tags w-5 text-center text-gray-500 group-hover:text-fg-brand {{ request()->routeIs('admin.brands.*') ? 'text-fg-brand' : '' }}"></i>
                                <span class="ms-3">Brands</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.suppliers.index') }}"
                                class="flex items-center px-3 py-1.5 text-xs text-body rounded-lg {{ request()->routeIs('admin.suppliers.*') ? 'bg-neutral-tertiary text-fg-brand font-bold' : '' }} hover:bg-neutral-tertiary hover:text-fg-brand group transition-all">
                                <i class="fas fa-building w-5 text-center text-gray-500 group-hover:text-fg-brand {{ request()->routeIs('admin.suppliers.*') ? 'text-fg-brand' : '' }}"></i>
                                <span class="ms-3">Suppliers</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.stock.index') }}"
                                class="flex items-center px-3 py-1.5 text-xs text-body rounded-lg {{ request()->routeIs('admin.stock.*') ? 'bg-neutral-tertiary text-fg-brand font-bold' : '' }} hover:bg-neutral-tertiary hover:text-fg-brand group transition-all">
                                <i class="fas fa-cubes w-5 text-center text-gray-500 group-hover:text-fg-brand {{ request()->routeIs('admin.stock.*') ? 'text-fg-brand' : '' }}"></i>
                                <span class="ms-3">Stock Management</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.outlets.index') }}"
                                class="flex items-center px-3 py-1.5 text-xs text-body rounded-lg {{ request()->routeIs('admin.outlets.*') ? 'bg-neutral-tertiary text-fg-brand font-bold' : '' }} hover:bg-neutral-tertiary hover:text-fg-brand group transition-all">
                                <i class="fas fa-store w-5 text-center text-gray-500 group-hover:text-fg-brand {{ request()->routeIs('admin.outlets.*') ? 'text-fg-brand' : '' }}"></i>
                                <span class="ms-3">Manage Outlets</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- SECTION 2: SALES & OPERATIONS -->
                <li class="pt-2">
                    <span class="px-3 text-[10px] font-bold text-gray-400 uppercase tracking-widest block mb-2">Sales & Operations</span>
                    <ul class="space-y-1">
                        <li>
                            <a href="{{ route('admin.orders.index') }}"
                                class="flex items-center px-3 py-1.5 text-xs text-body rounded-lg {{ request()->routeIs('admin.orders.*') ? 'bg-neutral-tertiary text-fg-brand font-bold' : '' }} hover:bg-neutral-tertiary hover:text-fg-brand group transition-all">
                                <i class="fas fa-shopping-cart w-5 text-center text-gray-500 group-hover:text-fg-brand {{ request()->routeIs('admin.orders.*') ? 'text-fg-brand' : '' }}"></i>
                                <span class="ms-3">Orders</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.refunds.index') }}"
                                class="flex items-center px-3 py-1.5 text-xs text-body rounded-lg {{ request()->routeIs('admin.refunds.*') ? 'bg-neutral-tertiary text-fg-brand font-bold' : '' }} hover:bg-neutral-tertiary hover:text-fg-brand group transition-all">
                                <i class="fas fa-undo w-5 text-center text-gray-500 group-hover:text-fg-brand {{ request()->routeIs('admin.refunds.*') ? 'text-fg-brand' : '' }}"></i>
                                <span class="ms-3">Refund Requests</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.quotations.index') }}"
                                class="flex items-center px-3 py-1.5 text-xs text-body rounded-lg {{ request()->routeIs('admin.quotations.*') ? 'bg-neutral-tertiary text-fg-brand font-bold' : '' }} hover:bg-neutral-tertiary hover:text-fg-brand group transition-all">
                                <i class="fas fa-file-invoice-dollar w-5 text-center text-gray-500 group-hover:text-fg-brand {{ request()->routeIs('admin.quotations.*') ? 'text-fg-brand' : '' }}"></i>
                                <span class="ms-3">Project Quotations</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- SECTION 3: CUSTOMER ENGAGEMENT -->
                <li class="pt-2">
                    <span class="px-3 text-[10px] font-bold text-gray-400 uppercase tracking-widest block mb-2">Customer Relations</span>
                    <ul class="space-y-1">
                        <li>
                            <a href="{{ route('admin.questions.index') }}"
                                class="flex items-center px-3 py-1.5 text-xs text-body rounded-lg {{ request()->routeIs('admin.questions.*') ? 'bg-neutral-tertiary text-fg-brand font-bold' : '' }} hover:bg-neutral-tertiary hover:text-fg-brand group transition-all">
                                <i class="fas fa-question-circle w-5 text-center text-gray-500 group-hover:text-fg-brand {{ request()->routeIs('admin.questions.*') ? 'text-fg-brand' : '' }}"></i>
                                <span class="ms-3">Product Questions</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.reviews.index') }}"
                                class="flex items-center px-3 py-1.5 text-xs text-body rounded-lg {{ request()->routeIs('admin.reviews.*') ? 'bg-neutral-tertiary text-fg-brand font-bold' : '' }} hover:bg-neutral-tertiary hover:text-fg-brand group transition-all">
                                <i class="fas fa-star w-5 text-center text-gray-500 group-hover:text-fg-brand {{ request()->routeIs('admin.reviews.*') ? 'text-fg-brand' : '' }}"></i>
                                <span class="ms-3">Product Reviews</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.contacts.index') }}"
                                class="flex items-center px-3 py-1.5 text-xs text-body rounded-lg {{ request()->routeIs('admin.contacts.*') ? 'bg-neutral-tertiary text-fg-brand font-bold' : '' }} hover:bg-neutral-tertiary hover:text-fg-brand group transition-all">
                                <i class="fas fa-envelope w-5 text-center text-gray-500 group-hover:text-fg-brand {{ request()->routeIs('admin.contacts.*') ? 'text-fg-brand' : '' }}"></i>
                                <span class="ms-3">Messages</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- SECTION 4: PROMOTIONS & CMS CONTENT -->
                <li class="pt-2">
                    <span class="px-3 text-[10px] font-bold text-gray-400 uppercase tracking-widest block mb-2">Marketing & Content</span>
                    <ul class="space-y-1">
                        <li>
                            <a href="{{ route('admin.offers.index') }}"
                                class="flex items-center px-3 py-1.5 text-xs text-body rounded-lg {{ request()->routeIs('admin.offers.*') ? 'bg-neutral-tertiary text-fg-brand font-bold' : '' }} hover:bg-neutral-tertiary hover:text-fg-brand group transition-all">
                                <i class="fas fa-gift w-5 text-center text-gray-500 group-hover:text-fg-brand {{ request()->routeIs('admin.offers.*') ? 'text-fg-brand' : '' }}"></i>
                                <span class="ms-3">Offers Management</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.services.index') }}"
                                class="flex items-center px-3 py-1.5 text-xs text-body rounded-lg {{ request()->routeIs('admin.services.*') ? 'bg-neutral-tertiary text-fg-brand font-bold' : '' }} hover:bg-neutral-tertiary hover:text-fg-brand group transition-all">
                                <i class="fas fa-tools w-5 text-center text-gray-500 group-hover:text-fg-brand {{ request()->routeIs('admin.services.*') ? 'text-fg-brand' : '' }}"></i>
                                <span class="ms-3">Services Management</span>
                            </a>
                        </li>
                        <!-- Sliders Dropdown -->
                        <li>
                            <button type="button"
                                class="flex items-center w-full px-3 py-1.5 text-xs text-body transition duration-75 rounded-lg group hover:bg-neutral-tertiary hover:text-fg-brand {{ request()->routeIs('admin.banners.*') ? 'bg-neutral-tertiary text-fg-brand' : '' }}"
                                aria-controls="dropdown-sliders" data-collapse-toggle="dropdown-sliders">
                                <i class="fas fa-images w-5 text-center text-gray-500 group-hover:text-fg-brand {{ request()->routeIs('admin.banners.*') ? 'text-fg-brand' : '' }}"></i>
                                <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">Sliders</span>
                                <svg class="w-3 h-3 transition-transform" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
                                </svg>
                            </button>
                            <ul id="dropdown-sliders" class="{{ request()->routeIs('admin.banners.*') ? '' : 'hidden' }} py-1.5 space-y-1">
                                <li>
                                    <a href="{{ route('admin.banners.index', ['type' => 'slider']) }}"
                                        class="flex items-center w-full p-1.5 text-xs text-body transition duration-75 rounded-lg pl-11 group hover:bg-neutral-tertiary hover:text-fg-brand {{ (request()->routeIs('admin.banners.index') && request()->query('type', 'slider') === 'slider') ? 'bg-neutral-tertiary text-fg-brand font-bold' : '' }}">
                                        Main Slider
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.banners.index', ['type' => 'home_services']) }}"
                                        class="flex items-center w-full p-1.5 text-xs text-body transition duration-75 rounded-lg pl-11 group hover:bg-neutral-tertiary hover:text-fg-brand {{ (request()->routeIs('admin.banners.index') && request()->query('type') === 'home_services') ? 'bg-neutral-tertiary text-fg-brand font-bold' : '' }}">
                                        Home Services Slider
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.banners.index', ['type' => 'service_center']) }}"
                                        class="flex items-center w-full p-1.5 text-xs text-body transition duration-75 rounded-lg pl-11 group hover:bg-neutral-tertiary hover:text-fg-brand {{ (request()->routeIs('admin.banners.index') && request()->query('type') === 'service_center') ? 'bg-neutral-tertiary text-fg-brand font-bold' : '' }}">
                                        Services Center Slider
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="{{ route('admin.cms.index') }}"
                                class="flex items-center px-3 py-1.5 text-xs text-body rounded-lg {{ request()->routeIs('admin.cms.*') ? 'bg-neutral-tertiary text-fg-brand font-bold' : '' }} hover:bg-neutral-tertiary hover:text-fg-brand group transition-all">
                                <i class="fas fa-file-alt w-5 text-center text-gray-500 group-hover:text-fg-brand {{ request()->routeIs('admin.cms.*') ? 'text-fg-brand' : '' }}"></i>
                                <span class="ms-3">CMS Pages</span>
                            </a>
                        </li>
                        <!-- Blog Dropdown -->
                        <li>
                            <button type="button"
                                class="flex items-center w-full px-3 py-1.5 text-xs text-body transition duration-75 rounded-lg group hover:bg-neutral-tertiary hover:text-fg-brand {{ request()->routeIs('admin.blogs.*') || request()->routeIs('admin.blog-categories.*') ? 'bg-neutral-tertiary text-fg-brand' : '' }}"
                                aria-controls="dropdown-blog" data-collapse-toggle="dropdown-blog">
                                <i class="fas fa-blog w-5 text-center text-gray-500 group-hover:text-fg-brand {{ request()->routeIs('admin.blogs.*') || request()->routeIs('admin.blog-categories.*') ? 'text-fg-brand' : '' }}"></i>
                                <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">Blog Management</span>
                                <svg class="w-3 h-3 transition-transform" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
                                </svg>
                            </button>
                            <ul id="dropdown-blog" class="{{ request()->routeIs('admin.blogs.*') || request()->routeIs('admin.blog-categories.*') ? '' : 'hidden' }} py-1.5 space-y-1">
                                <li>
                                    <a href="{{ route('admin.blogs.index') }}"
                                        class="flex items-center w-full p-1.5 text-xs text-body transition duration-75 rounded-lg pl-11 group hover:bg-neutral-tertiary hover:text-fg-brand {{ request()->routeIs('admin.blogs.index') ? 'bg-neutral-tertiary text-fg-brand font-bold' : '' }}">
                                        All Blog Posts
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.blog-categories.index') }}"
                                        class="flex items-center w-full p-1.5 text-xs text-body transition duration-75 rounded-lg pl-11 group hover:bg-neutral-tertiary hover:text-fg-brand {{ request()->routeIs('admin.blog-categories.index') ? 'bg-neutral-tertiary text-fg-brand font-bold' : '' }}">
                                        Blog Categories
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>

                <!-- SECTION 5: CONFIGURATION -->
                <li class="pt-2">
                    <span class="px-3 text-[10px] font-bold text-gray-400 uppercase tracking-widest block mb-2">Settings & Setup</span>
                    <ul class="space-y-1">
                        <li>
                            <a href="{{ route('admin.shipping.index') }}"
                                class="flex items-center px-3 py-1.5 text-xs text-body rounded-lg {{ request()->routeIs('admin.shipping.*') ? 'bg-neutral-tertiary text-fg-brand font-bold' : '' }} hover:bg-neutral-tertiary hover:text-fg-brand group transition-all">
                                <i class="fas fa-truck w-5 text-center text-gray-500 group-hover:text-fg-brand {{ request()->routeIs('admin.shipping.*') ? 'text-fg-brand' : '' }}"></i>
                                <span class="ms-3">Shipping Methods</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.payment-methods.index') }}"
                                class="flex items-center px-3 py-1.5 text-xs text-body rounded-lg {{ request()->routeIs('admin.payment-methods.*') ? 'bg-neutral-tertiary text-fg-brand font-bold' : '' }} hover:bg-neutral-tertiary hover:text-fg-brand group transition-all">
                                <i class="fas fa-credit-card w-5 text-center text-gray-500 group-hover:text-fg-brand {{ request()->routeIs('admin.payment-methods.*') ? 'text-fg-brand' : '' }}"></i>
                                <span class="ms-3">Payment Methods</span>
                            </a>
                        </li>
                        <!-- Settings Dropdown -->
                        <li>
                            <button type="button"
                                class="flex items-center w-full px-3 py-1.5 text-xs text-body transition duration-75 rounded-lg group hover:bg-neutral-tertiary hover:text-fg-brand"
                                aria-controls="dropdown-settings" data-collapse-toggle="dropdown-settings">
                                <i class="fas fa-cog w-5 text-center text-gray-500 group-hover:text-fg-brand"></i>
                                <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">System Settings</span>
                                <svg class="w-3 h-3 transition-transform" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
                                </svg>
                            </button>
                            <ul id="dropdown-settings" class="hidden py-1.5 space-y-1">
                                <li>
                                    <a href="{{ route('admin.settings.general') }}"
                                        class="flex items-center w-full p-1.5 text-xs text-body transition duration-75 rounded-lg pl-11 group hover:bg-neutral-tertiary hover:text-fg-brand">General Settings</a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.banners.index') }}"
                                        class="flex items-center w-full p-1.5 text-xs text-body transition duration-75 rounded-lg pl-11 group hover:bg-neutral-tertiary hover:text-fg-brand">Manage Banners</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>

                <!-- Log Out -->
                <li class="pt-4 border-t border-gray-100">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a href="{{ route('logout') }}"
                            onclick="event.preventDefault(); this.closest('form').submit();"
                            class="flex items-center px-3 py-2 text-sm text-body rounded-lg hover:bg-red-50 hover:text-red-600 group transition-all">
                            <i class="fas fa-sign-out-alt w-5 text-center text-base transition duration-75 text-gray-500 group-hover:text-red-600"></i>
                            <span class="ms-3 font-semibold">Sign Out</span>
                        </a>
                    </form>
                </li>
            </ul>
        </div>
    </aside>

    <div class="p-4 sm:ml-64 mt-14">
        @yield('content')
    </div>

    @stack('scripts')
</body>

</html>
