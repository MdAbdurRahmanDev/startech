@extends('layouts.app')

@section('title', $category->name . ' Price in Bangladesh | IOS BD')

@section('content')
    <div class="container mx-auto px-2 md:px-4 mb-10">
        <!-- Breadcrumb -->
        <div class="py-4 text-[13px] text-gray-500">
            <a href="{{ url('/') }}" class="text-gray-700 hover:text-accent-orange transition-colors"><i
                    class="fas fa-home"></i></a>
            <span class="mx-1">/</span> <a href="#"
                class="text-gray-700 hover:text-accent-orange transition-colors">Category</a>
            <span class="mx-1">/</span> <span class="text-gray-900">{{ $category->name }}</span>
        </div>

        <!-- Category Header -->
        <div class="mb-6">
            <h1 class="text-[22px] md:text-2xl font-bold text-primary-dark mb-2">{{ $category->name }} Price in Bangladesh
            </h1>
            <p class="text-[13px] text-gray-600 mb-6 max-w-3xl">
                {{ $category->name }} Price in Bangladesh depends on the brand, model, and features. Find the best deals on
                {{ $setting->app_name ?? 'Iosbd' }}.
            </p>

            <div class="flex flex-wrap gap-2.5 mb-4">
                @foreach ($brands as $brand)
                    <a href="{{ url()->current() }}?brand={{ $brand->slug }}"
                        class="bg-white border {{ request('brand') == $brand->slug ? 'border-accent-orange text-accent-orange' : 'border-gray-200 text-gray-700' }} px-4 py-1.5 rounded-full text-[13px] hover:border-accent-orange hover:text-accent-orange transition-colors cursor-pointer shadow-sm font-medium">
                        {{ $brand->name }}
                    </a>
                @endforeach
            </div>
        </div>

        <!-- Layout Container -->
        <form id="filter-form" action="{{ url()->current() }}" method="GET">
            <div class="grid grid-cols-1 lg:grid-cols-[280px_1fr] gap-5">
                <!-- Sidebar Filters -->
                <aside class="hidden lg:block space-y-5">
                    <!-- Price Range -->
                    <div class="bg-white rounded-lg p-5 shadow-sm border border-gray-100">
                        <h3 class="text-base font-bold text-gray-800 border-b border-gray-100 pb-3 mb-4">Price Range</h3>
                        <div class="mt-2">
                            <div class="flex justify-between items-center gap-2">
                                <input type="number" name="min_price" value="{{ request('min_price') }}" placeholder="Min"
                                    class="w-full p-1.5 border border-gray-300 text-center text-[13px] rounded focus:ring-accent-orange focus:border-accent-orange outline-none">
                                <span class="text-gray-400">-</span>
                                <input type="number" name="max_price" value="{{ request('max_price') }}" placeholder="Max"
                                    class="w-full p-1.5 border border-gray-300 text-center text-[13px] rounded focus:ring-accent-orange focus:border-accent-orange outline-none">
                            </div>
                            <button type="submit"
                                class="mt-3 w-full bg-accent-orange text-white py-1.5 rounded text-[13px] font-bold hover:bg-orange-600 transition-colors">Apply
                                Price</button>
                        </div>
                    </div>

                    <!-- Availability -->
                    <div class="bg-white rounded-lg p-5 shadow-sm border border-gray-100">
                        <h3 class="text-base font-bold text-gray-800 border-b border-gray-100 pb-3 mb-4">Availability</h3>
                        <ul class="space-y-3">
                            <li
                                class="flex items-center gap-2 text-[14px] text-gray-700 cursor-pointer hover:text-accent-orange">
                                <input type="checkbox" name="availability[]" value="in_stock"
                                    class="rounded border-gray-300 text-accent-orange focus:ring-accent-orange cursor-pointer"
                                    onchange="document.getElementById('filter-form').submit();"
                                    {{ in_array('in_stock', request('availability', [])) ? 'checked' : '' }}> <span>In
                                    Stock</span>
                            </li>
                        </ul>
                    </div>

                    <!-- Brand Filter -->
                    <div class="bg-white rounded-lg p-5 shadow-sm border border-gray-100">
                        <h3 class="text-base font-bold text-gray-800 border-b border-gray-100 pb-3 mb-4">Brand</h3>
                        <ul class="space-y-3 max-h-60 overflow-y-auto pr-2">
                            @foreach ($brands as $brand)
                                <li
                                    class="flex items-center gap-2 text-[14px] text-gray-700 cursor-pointer hover:text-accent-orange">
                                    <input type="checkbox" name="brands[]" value="{{ $brand->id }}"
                                        class="rounded border-gray-300 text-accent-orange focus:ring-accent-orange cursor-pointer"
                                        onchange="document.getElementById('filter-form').submit();"
                                        {{ in_array($brand->id, request('brands', [])) ? 'checked' : '' }}>
                                    <span>{{ $brand->name }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </aside>

                <!-- Main Product Content -->
                <section>
                    <!-- Content Header -->
                    <div
                        class="bg-white px-5 py-3 rounded-lg shadow-sm border border-gray-50 flex flex-col sm:flex-row justify-between items-center mb-5 gap-3">
                        <h2 class="text-base font-bold text-primary-dark">{{ $category->name }}</h2>
                        <div class="flex items-center gap-4 text-[13px] text-gray-600">
                            <div class="flex items-center gap-2">
                                <label>Show:</label>
                                <select name="show"
                                    class="border border-gray-200 rounded py-1 px-2 focus:ring-accent-orange focus:border-accent-orange outline-none bg-gray-50"
                                    onchange="document.getElementById('filter-form').submit();">
                                    <option value="20" {{ request('show') == 20 ? 'selected' : '' }}>20</option>
                                    <option value="40" {{ request('show') == 40 ? 'selected' : '' }}>40</option>
                                    <option value="60" {{ request('show') == 60 ? 'selected' : '' }}>60</option>
                                </select>
                            </div>
                            <div class="flex items-center gap-2">
                                <label>Sort By:</label>
                                <select name="sort"
                                    class="border border-gray-200 rounded py-1 px-2 focus:ring-accent-orange focus:border-accent-orange outline-none bg-gray-50"
                                    onchange="document.getElementById('filter-form').submit();">
                                    <option value="default" {{ request('sort') == 'default' ? 'selected' : '' }}>Default
                                    </option>
                                    <option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : '' }}>Price
                                        (Low > High)</option>
                                    <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>
                                        Price (High > Low)</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Product Grid -->
                    <div class="grid grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-3 md:gap-4">
                        @forelse($products as $product)
                            <div
                                class="bg-white rounded-lg p-3 md:p-4 flex flex-col shadow-sm border border-gray-50 hover:shadow-lg transition-shadow relative group">

                                <!-- Stock Badge -->
                                @if ($product->stock <= 0)
                                    <div
                                        class="absolute top-3 left-3 bg-red-500 text-white text-[10px] font-bold px-2 py-0.5 rounded-full z-10">
                                        Out of Stock
                                    </div>
                                @else
                                    <div
                                        class="absolute top-3 left-3 bg-accent-blue text-white text-[10px] font-bold px-2 py-0.5 rounded-full z-10">
                                        In Stock
                                    </div>
                                @endif

                                <!-- Product Image -->
                                <a href="{{ url('product/' . $product->slug) }}"
                                    class="block mb-4 h-40 md:h-48 bg-gray-50 rounded flex items-center justify-center p-2 overflow-hidden">
                                    <img src="{{ $product->thumbnail ? asset('storage/' . $product->thumbnail) : 'https://placehold.co/228x228/f9fafb/a3a3a3?text=No+Image' }}"
                                        alt="{{ $product->name }}"
                                        class="w-full h-full object-contain group-hover:scale-110 transition-transform duration-500">
                                </a>

                                <!-- Product Title -->
                                <a href="{{ url('product/' . $product->slug) }}" class="block mb-3">
                                    <h3
                                        class="text-[13px] md:text-[14px] font-bold text-primary-dark hover:text-accent-orange transition-colors line-clamp-2 leading-snug h-10">
                                        {{ $product->name }}</h3>
                                </a>

                                <!-- Specifications -->
                                <ul class="space-y-1.5 mb-4 flex-grow text-gray-500">
                                    @if ($product->specifications && $product->specifications->count() > 0)
                                        @foreach ($product->specifications->take(3) as $spec)
                                            <li class="text-[11px] flex items-start gap-1.5">
                                                <span class="w-1 h-1 rounded-full bg-gray-300 mt-1.5 shrink-0"></span>
                                                <span class="line-clamp-1">{{ $spec->value }}</span>
                                            </li>
                                        @endforeach
                                    @else
                                        <li class="text-[11px] flex items-start gap-1.5">
                                            <span class="w-1 h-1 rounded-full bg-gray-300 mt-1.5 shrink-0"></span>
                                            <span>No specifications available</span>
                                        </li>
                                    @endif
                                </ul>

                                <!-- Price and Actions -->
                                <div class="border-t border-gray-100 pt-4 text-center mt-auto">
                                    <div class="flex items-center justify-center gap-2 mb-3">
                                        @if ($product->discount_price && $product->discount_price < $product->price)
                                            <span
                                                class="text-base md:text-lg font-bold text-accent-orange">{{ number_format($product->discount_price, 0) }}৳</span>
                                            <span
                                                class="text-xs text-gray-400 line-through">{{ number_format($product->price, 0) }}৳</span>
                                        @else
                                            <span
                                                class="text-base md:text-lg font-bold text-accent-orange">{{ number_format($product->price, 0) }}৳</span>
                                        @endif
                                    </div>

                                    <button type="button" onclick="buyNow({{ $product->id }})"
                                        class="w-full bg-primary-dark text-white text-xs md:text-sm font-bold py-2 md:py-2.5 rounded hover:bg-accent-orange transition-all flex items-center justify-center gap-2 cursor-pointer"
                                        {{ $product->stock <= 0 ? 'disabled' : '' }}>
                                        <i class="fas fa-shopping-cart text-[11px]"></i> Buy Now
                                    </button>

                                    <button
                                        class="text-[11px] text-gray-500 hover:text-accent-orange transition-colors flex items-center justify-center gap-1 w-full py-1">
                                        <i class="fas fa-plus"></i> Add to Compare
                                    </button>
                                </div>
                            </div>
                        @empty
                            <div class="col-span-full py-16 text-center bg-white rounded-lg border border-gray-100">
                                <i class="fas fa-box-open text-4xl text-gray-300 mb-3"></i>
                                <h3 class="text-lg text-gray-600 mb-1">No products found</h3>
                                <p class="text-sm text-gray-400">Try adjusting your filters or check back later.</p>
                            </div>
                        @endforelse
                    </div>

                    <!-- Pagination -->
                    @if ($products->hasPages())
                        <div class="mt-8 flex justify-center">
                            {{ $products->links() }}
                        </div>
                    @endif
                </section>
            </div>
        </form>
    </div>
@endsection
