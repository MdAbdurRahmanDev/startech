@extends('layouts.app')

@section('title', 'Search - ' . ($q ?? '') . ' | IOS BD')

@section('styles')
    <style>
        .search-tag {
            background-color: #fff;
            border: 1px solid #ddd;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 12px;
            color: #333;
            transition: all 0.2s;
            white-space: nowrap;
        }

        .search-tag:hover {
            border-color: #ef4a23;
            color: #ef4a23;
        }

        .save-badge {
            position: absolute;
            top: 0;
            left: 0;
            background-color: #6e2594;
            color: white;
            padding: 3px 10px;
            border-radius: 0 0 10px 0;
            font-size: 11px;
            font-weight: bold;
            z-index: 10;
        }
    </style>
@endsection

@section('content')
    <div class="container pb-10">
        <!-- Breadcrumb -->
        <div class="py-4 text-[13px] text-gray-500">
            <a href="{{ url('/') }}" class="text-gray-700 hover:text-accent-orange transition-colors"><i
                    class="fas fa-home"></i></a>
            <span class="mx-1">/</span> <span class="text-gray-900">Search</span>
        </div>

        <!-- Suggested Tags -->
        @if (count($suggestedCategories) > 0)
            <div class="flex flex-wrap gap-2.5 mb-8">
                @foreach ($suggestedCategories as $sCat)
                    <a href="{{ url('category/' . $sCat->slug) }}" class="search-tag shadow-sm hover:shadow-md">
                        {{ $sCat->name }}
                    </a>
                @endforeach
            </div>
        @endif

        <!-- Search Header -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-100 p-4 mb-6 flex justify-between items-center">
            <h1 class="text-[16px] font-bold text-primary-dark">Search - {{ $q ?? '' }}</h1>
            <div class="flex items-center gap-3 text-[13px] text-gray-600">
                <label>Show:</label>
                <select name="show" class="border border-gray-200 rounded py-1 px-2 focus:outline-none bg-gray-50"
                    onchange="window.location.href = updateQueryStringParameter(window.location.href, 'show', this.value)">
                    <option value="20" {{ request('show') == 20 ? 'selected' : '' }}>20</option>
                    <option value="40" {{ request('show') == 40 ? 'selected' : '' }}>40</option>
                </select>
            </div>
        </div>

        <!-- Product Grid -->
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4">
            @forelse($products as $product)
                <div
                    class="bg-white rounded-lg p-4 flex flex-col shadow-sm border border-gray-50 hover:shadow-xl transition-all relative group">

                    <!-- Save Badge -->
                    @if ($product->discount_price && $product->discount_price < $product->price)
                        <div class="save-badge">
                            Save: {{ number_format($product->price - $product->discount_price, 0) }}৳
                        </div>
                    @endif

                    <!-- Product Image -->
                    <a href="{{ url('product/' . $product->slug) }}"
                        class="block mb-4 h-44 bg-gray-50 rounded flex items-center justify-center p-2 overflow-hidden">
                        <img src="{{ $product->thumbnail ? asset('storage/' . $product->thumbnail) : 'https://placehold.co/228x228/f9fafb/a3a3a3?text=No+Image' }}"
                            alt="{{ $product->name }}"
                            class="w-full h-full object-contain group-hover:scale-110 transition-transform duration-500">
                    </a>

                    <!-- Product Title -->
                    <a href="{{ url('product/' . $product->slug) }}" class="block mb-4">
                        <h3
                            class="text-[14px] font-bold text-primary-dark hover:text-accent-orange transition-colors line-clamp-2 leading-snug h-10">
                            {{ $product->name }}</h3>
                    </a>

                    <div class="mb-4 text-[12px] text-gray-500 flex-grow short-description-list">
                        @if ($product->short_description)
                            {!! $product->short_description !!}
                        @else
                            <p>No features listed</p>
                        @endif
                    </div>

                    <!-- Price and Actions -->
                    <div class="border-t border-gray-100 pt-4 text-center mt-auto">
                        <div class="flex items-center justify-center gap-2 mb-3">
                            @if ($product->discount_price && $product->discount_price < $product->price)
                                <span
                                    class="text-[15px] font-bold text-accent-orange">{{ number_format($product->discount_price, 0) }}৳</span>
                                <span
                                    class="text-[12px] text-gray-400 line-through">{{ number_format($product->price, 0) }}৳</span>
                            @else
                                <span
                                    class="text-[15px] font-bold text-accent-orange">{{ number_format($product->price, 0) }}৳</span>
                            @endif
                        </div>

                        <button type="button" onclick="buyNow({{ $product->id }})"
                            class="w-full bg-primary-dark text-white text-xs md:text-sm font-bold py-2 md:py-2.5 rounded hover:bg-accent-orange transition-all flex items-center justify-center gap-2 cursor-pointer">
                            <i class="fas fa-shopping-cart text-[11px]"></i> Buy Now
                        </button>

                        <button
                            class="text-[11px] font-bold text-gray-500 hover:text-accent-orange transition-colors flex items-center justify-center gap-1.5 w-full py-1">
                            <i class="fas fa-plus"></i> Add to Compare
                        </button>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-20 text-center bg-white rounded-lg shadow-sm border border-gray-100">
                    <i class="fas fa-search text-5xl text-gray-200 mb-4"></i>
                    <h3 class="text-xl text-gray-800 mb-2 font-bold">No results found for "{{ $q }}"</h3>
                    <p class="text-gray-500">Try searching with different keywords or browse our categories.</p>
                    <a href="{{ url('/') }}"
                        class="inline-block mt-6 bg-primary-dark text-white px-8 py-2.5 rounded font-bold hover:bg-opacity-90">Back
                        to Home</a>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if ($products->hasPages())
            <div class="mt-10 flex justify-center">
                {{ $products->links() }}
            </div>
        @endif
    </div>
@endsection

@section('scripts')
    <script>
        function updateQueryStringParameter(uri, key, value) {
            var re = new RegExp("([?&])" + key + "=.*?(&|$)", "i");
            var separator = uri.indexOf('?') !== -1 ? "&" : "?";
            if (uri.match(re)) {
                return uri.replace(re, '$1' + key + "=" + value + '$2');
            } else {
                return uri + separator + key + "=" + value;
            }
        }
    </script>
@endsection
