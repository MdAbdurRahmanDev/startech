<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @yield('styles')
</head>
<body>
    

<nav class="fixed top-0 z-50 w-full bg-neutral-primary-soft border-b border-default">
  <div class="px-3 py-3 lg:px-5 lg:pl-3">
    <div class="flex items-center justify-between">
      <div class="flex items-center justify-start rtl:justify-end">
        <button data-drawer-target="top-bar-sidebar" data-drawer-toggle="top-bar-sidebar" aria-controls="top-bar-sidebar" type="button" class="sm:hidden text-heading bg-transparent box-border border border-transparent hover:bg-neutral-secondary-medium focus:ring-4 focus:ring-neutral-tertiary font-medium leading-5 rounded-base text-sm p-2 focus:outline-none">
            <span class="sr-only">Open sidebar</span>
            <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
  <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="M5 7h14M5 12h14M5 17h10"/>
   </svg>
         </button>
        <a href="{{ route('dashboard') }}" class="flex ms-2 md:me-24">
          @if($setting && $setting->logo)
            <img src="{{ asset('storage/' . $setting->logo) }}" class="h-8 me-3" alt="Logo" />
          @else
            <img src="https://www.startech.com.bd/image/catalog/logo.png" class="h-8 me-3" alt="Logo" />
          @endif
          <span class="self-center text-lg font-bold whitespace-nowrap text-heading">{{ $setting->app_name ?? 'Star Tech' }}</span>
        </a>
      </div>
      <div class="flex items-center">
          <div class="flex items-center ms-3">
            <div>
              <button type="button" class="flex text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600" aria-expanded="false" data-dropdown-toggle="dropdown-user">
                <span class="sr-only">Open user menu</span>
                <img class="w-8 h-8 rounded-full" src="https://flowbite.com/docs/images/people/profile-picture-5.jpg" alt="user photo">
              </button>
            </div>
            <div class="z-50 hidden bg-neutral-primary-medium border border-default-medium rounded-base shadow-lg w-44" id="dropdown-user">
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
                  <a href="{{ route('dashboard') }}" class="inline-flex items-center w-full p-2 hover:bg-neutral-tertiary-medium hover:text-heading rounded" role="menuitem">Dashboard</a>
                </li>
                <li>
                  <a href="{{ route('admin.profile') }}" class="inline-flex items-center w-full p-2 hover:bg-neutral-tertiary-medium hover:text-heading rounded" role="menuitem">Profile Settings</a>
                </li>
                <li>
                  <a href="#" class="inline-flex items-center w-full p-2 hover:bg-neutral-tertiary-medium hover:text-heading rounded" role="menuitem">Earnings</a>
                </li>
                <li>
                  <form action="{{ route('logout') }}" method="POST" id="logout-form" class="hidden">@csrf</form>
                  <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="inline-flex items-center w-full p-2 hover:bg-neutral-tertiary-medium hover:text-heading rounded text-red-500" role="menuitem">Sign out</a>
                </li>
              </ul>
            </div>
          </div>
        </div>
    </div>
  </div>
</nav>

<aside id="top-bar-sidebar" class="fixed top-0 left-0 z-40 w-64 h-full transition-transform -translate-x-full sm:translate-x-0" aria-label="Sidebar">
   <div class="h-full px-3 py-4 overflow-y-auto bg-neutral-primary-soft border-e border-default">
      <a href="https://flowbite.com/" class="flex items-center ps-2.5 mb-5">
         <img src="https://flowbite.com/docs/images/logo.svg" class="h-6 me-3" alt="Flowbite Logo" />
         <span class="self-center text-lg text-heading font-semibold whitespace-nowrap">Flowbite</span>
      </a>
      <ul class="space-y-2 font-medium">
         <li>
            <a href="{{ route('dashboard') }}" class="flex items-center px-2 py-1.5 text-body rounded-base {{ request()->routeIs('dashboard') ? 'bg-neutral-tertiary text-fg-brand' : '' }} hover:bg-neutral-tertiary hover:text-fg-brand group transition-all">
               <i class="fas fa-home w-5 text-center text-lg transition duration-75 text-gray-500 group-hover:text-fg-brand {{ request()->routeIs('dashboard') ? 'text-fg-brand' : '' }}"></i>
               <span class="ms-3">Dashboard</span>
            </a>
         </li>
         <li>
            <a href="{{ route('admin.categories.index') }}" class="flex items-center px-2 py-1.5 text-body rounded-base {{ request()->routeIs('admin.categories.*') ? 'bg-neutral-tertiary text-fg-brand' : '' }} hover:bg-neutral-tertiary hover:text-fg-brand group transition-all">
               <i class="fas fa-sitemap w-5 text-center text-lg transition duration-75 text-gray-500 group-hover:text-fg-brand {{ request()->routeIs('admin.categories.*') ? 'text-fg-brand' : '' }}"></i>
               <span class="flex-1 ms-3 whitespace-nowrap">Categories</span>
            </a>
         </li>
         <li>
            <a href="{{ route('admin.brands.index') }}" class="flex items-center px-2 py-1.5 text-body rounded-base {{ request()->routeIs('admin.brands.*') ? 'bg-neutral-tertiary text-fg-brand' : '' }} hover:bg-neutral-tertiary hover:text-fg-brand group transition-all">
               <i class="fas fa-tags w-5 text-center text-lg transition duration-75 text-gray-500 group-hover:text-fg-brand {{ request()->routeIs('admin.brands.*') ? 'text-fg-brand' : '' }}"></i>
               <span class="flex-1 ms-3 whitespace-nowrap">Brands</span>
            </a>
         </li>
         <li>
            <a href="{{ route('admin.suppliers.index') }}" class="flex items-center px-2 py-1.5 text-body rounded-base {{ request()->routeIs('admin.suppliers.*') ? 'bg-neutral-tertiary text-fg-brand' : '' }} hover:bg-neutral-tertiary hover:text-fg-brand group transition-all">
               <i class="fas fa-building w-5 text-center text-lg transition duration-75 text-gray-500 group-hover:text-fg-brand {{ request()->routeIs('admin.suppliers.*') ? 'text-fg-brand' : '' }}"></i>
               <span class="flex-1 ms-3 whitespace-nowrap">Suppliers</span>
            </a>
         </li>
         <li>
            <a href="{{ route('admin.products.index') }}" class="flex items-center px-2 py-1.5 text-body rounded-base {{ request()->routeIs('admin.products.*') ? 'bg-neutral-tertiary text-fg-brand' : '' }} hover:bg-neutral-tertiary hover:text-fg-brand group transition-all">
               <i class="fas fa-box w-5 text-center text-lg transition duration-75 text-gray-500 group-hover:text-fg-brand {{ request()->routeIs('admin.products.*') ? 'text-fg-brand' : '' }}"></i>
               <span class="flex-1 ms-3 whitespace-nowrap">Products</span>
            </a>
         </li>
         <li>
            <a href="{{ route('admin.banners.index') }}" class="flex items-center px-2 py-1.5 text-body rounded-base {{ request()->routeIs('admin.banners.index') ? 'bg-neutral-tertiary text-fg-brand' : '' }} hover:bg-neutral-tertiary hover:text-fg-brand group transition-all">
               <i class="fas fa-image w-5 text-center text-lg transition duration-75 text-gray-500 group-hover:text-fg-brand {{ request()->routeIs('admin.banners.*') ? 'text-fg-brand' : '' }}"></i>
               <span class="flex-1 ms-3 whitespace-nowrap">Banners</span>
            </a>
         </li>
         <li>
            <a href="{{ route('admin.stock.index') }}" class="flex items-center px-2 py-1.5 text-body rounded-base {{ request()->routeIs('admin.stock.*') ? 'bg-neutral-tertiary text-fg-brand' : '' }} hover:bg-neutral-tertiary hover:text-fg-brand group transition-all">
               <i class="fas fa-cubes w-5 text-center text-lg transition duration-75 text-gray-500 group-hover:text-fg-brand {{ request()->routeIs('admin.stock.*') ? 'text-fg-brand' : '' }}"></i>
               <span class="flex-1 ms-3 whitespace-nowrap">Stock Management</span>
            </a>
         </li>
         <li>
            <a href="{{ route('admin.offers.index') }}" class="flex items-center px-2 py-1.5 text-body rounded-base {{ request()->routeIs('admin.offers.*') ? 'bg-neutral-tertiary text-fg-brand' : '' }} hover:bg-neutral-tertiary hover:text-fg-brand group transition-all">
               <i class="fas fa-gift w-5 text-center text-lg transition duration-75 text-gray-500 group-hover:text-fg-brand {{ request()->routeIs('admin.offers.*') ? 'text-fg-brand' : '' }}"></i>
               <span class="flex-1 ms-3 whitespace-nowrap">Offers Management</span>
            </a>
         </li>
         <li>
            <a href="{{ route('admin.orders.index') }}" class="flex items-center px-2 py-1.5 text-body rounded-base {{ request()->routeIs('admin.orders.*') ? 'bg-neutral-tertiary text-fg-brand' : '' }} hover:bg-neutral-tertiary hover:text-fg-brand group transition-all">
               <i class="fas fa-shopping-cart w-5 text-center text-lg transition duration-75 text-gray-500 group-hover:text-fg-brand {{ request()->routeIs('admin.orders.*') ? 'text-fg-brand' : '' }}"></i>
               <span class="flex-1 ms-3 whitespace-nowrap">Orders</span>
            </a>
         </li>
         <li>
            <a href="{{ route('admin.refunds.index') }}" class="flex items-center px-2 py-1.5 text-body rounded-base {{ request()->routeIs('admin.refunds.*') ? 'bg-neutral-tertiary text-fg-brand' : '' }} hover:bg-neutral-tertiary hover:text-fg-brand group transition-all">
               <i class="fas fa-undo w-5 text-center text-lg transition duration-75 text-gray-500 group-hover:text-fg-brand {{ request()->routeIs('admin.refunds.*') ? 'text-fg-brand' : '' }}"></i>
               <span class="flex-1 ms-3 whitespace-nowrap">Refund Requests</span>
            </a>
         </li>
         <li>
            <a href="{{ route('admin.shipping.index') }}" class="flex items-center px-2 py-1.5 text-body rounded-base {{ request()->routeIs('admin.shipping.*') ? 'bg-neutral-tertiary text-fg-brand' : '' }} hover:bg-neutral-tertiary hover:text-fg-brand group transition-all">
               <i class="fas fa-truck w-5 text-center text-lg transition duration-75 text-gray-500 group-hover:text-fg-brand {{ request()->routeIs('admin.shipping.*') ? 'text-fg-brand' : '' }}"></i>
               <span class="flex-1 ms-3 whitespace-nowrap">Shipping Methods</span>
            </a>
         </li>
         
         <!-- Settings Dropdown -->
         <li>
            <button type="button" class="flex items-center w-full px-2 py-1.5 text-body transition duration-75 rounded-base group hover:bg-neutral-tertiary hover:text-fg-brand" aria-controls="dropdown-settings" data-collapse-toggle="dropdown-settings">
               <i class="fas fa-cog w-5 text-center text-lg transition duration-75 text-gray-500 group-hover:text-fg-brand"></i>
               <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">Settings</span>
               <svg class="w-3 h-3 transition-transform" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
               </svg>
            </button>
            <ul id="dropdown-settings" class="hidden py-2 space-y-2">
               <li>
                  <a href="{{ route('admin.settings.general') }}" class="flex items-center w-full p-2 text-body transition duration-75 rounded-base pl-11 group hover:bg-neutral-tertiary hover:text-fg-brand">General Settings</a>
               </li>
               <li>
                  <a href="{{ route('admin.banners.index') }}" class="flex items-center w-full p-2 text-body transition duration-75 rounded-base pl-11 group hover:bg-neutral-tertiary hover:text-fg-brand">Manage Banners</a>
               </li>
               <li>
                  <a href="{{ route('admin.categories.index') }}" class="flex items-center w-full p-2 text-body transition duration-75 rounded-base pl-11 group hover:bg-neutral-tertiary hover:text-fg-brand">Manage Categories</a>
               </li>
               <li>
                  <a href="{{ route('admin.brands.index') }}" class="flex items-center w-full p-2 text-body transition duration-75 rounded-base pl-11 group hover:bg-neutral-tertiary hover:text-fg-brand">Manage Brands</a>
               </li>
               <li>
                  <a href="{{ route('admin.suppliers.index') }}" class="flex items-center w-full p-2 text-body transition duration-75 rounded-base pl-11 group hover:bg-neutral-tertiary hover:text-fg-brand">Manage Suppliers</a>
               </li>
            </ul>
         </li>
         <li>
            <form method="POST" action="{{ route('logout') }}">
               @csrf
               <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();" class="flex items-center px-2 py-1.5 text-body rounded-base hover:bg-neutral-tertiary hover:text-fg-brand group">
                  <i class="fas fa-sign-out-alt w-5 text-center text-lg transition duration-75 text-gray-500 group-hover:text-fg-brand"></i>
                  <span class="flex-1 ms-3 whitespace-nowrap">Sign Out</span>
               </a>
            </form>
         </li>
      </ul>
   </div>
</aside>

<div class="p-4 sm:ml-64 mt-14">
   @yield('content')
</div>

</body>
</html>