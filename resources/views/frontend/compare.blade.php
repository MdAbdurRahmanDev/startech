@extends('layouts.app')

@section('title', 'Product Comparison | IOS BD')

@section('content')
<div class="container pb-14">
    <!-- Breadcrumb -->
    <div class="py-4 text-[13px] text-gray-600">
        <a href="{{ url('/') }}" class="text-gray-800 no-underline hover:text-accent-orange transition-colors"><i class="fas fa-home"></i></a>
        / <span class="text-gray-500">Product Comparison</span>
    </div>

    <div class="bg-white p-5 md:p-[30px] rounded-lg shadow-sm border border-gray-100">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 border-b border-gray-100 pb-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Product Comparison</h1>
                <p class="text-sm text-gray-500 mt-1">Find and select products to see the differences and similarities between them</p>
            </div>
            <div class="flex gap-3 mt-4 md:mt-0">
                <button onclick="window.print()" class="bg-gray-100 text-gray-700 font-bold py-2 px-4 rounded text-sm hover:bg-gray-200 transition-colors flex items-center gap-2"><i class="fas fa-print"></i> Print</button>
                <button class="bg-[#3b5998] text-white font-bold py-2 px-4 rounded text-sm hover:opacity-90 transition-opacity flex items-center gap-2"><i class="fas fa-share"></i> Share</button>
            </div>
        </div>

        <div class="overflow-x-auto">
            @php
                $maxSlots = 4;
                $currentCount = count($products);
                $slotsToShow = max(2, min(4, $currentCount + 1));
                if ($currentCount >= 4) {
                    $slotsToShow = 4;
                }
            @endphp
            
            <table class="w-full text-left border-collapse min-w-[800px]">
                <!-- Header / Products -->
                <thead>
                    <tr>
                        <th class="w-[20%] p-4 border-b border-gray-100 align-top">
                            <span class="text-sm text-gray-500 font-normal">You can add Max 4 Products</span>
                        </th>
                        @for($i = 0; $i < $slotsToShow; $i++)
                            <th class="w-[20%] p-4 border-l border-b border-gray-100 align-top relative">
                                @if(isset($products[$i]))
                                    <form action="{{ route('compare.remove') }}" method="POST" class="absolute top-2 right-2">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $products[$i]->id }}">
                                        <button type="submit" class="text-gray-400 hover:text-red-500" title="Remove"><i class="fas fa-times"></i></button>
                                    </form>
                                    <div class="text-center">
                                        <img src="{{ $products[$i]->thumbnail ? asset('storage/' . $products[$i]->thumbnail) : 'https://placehold.co/200x200/f9fafb/a3a3a3?text=No+Image' }}" alt="{{ $products[$i]->name }}" class="w-[150px] h-[150px] object-contain mx-auto mb-4">
                                        <h3 class="text-sm font-bold text-gray-800 mb-2 min-h-[40px]"><a href="{{ url('product/' . $products[$i]->slug) }}" class="hover:text-accent-orange transition-colors">{{ $products[$i]->name }}</a></h3>
                                        <div class="text-lg font-bold text-accent-orange mb-3">
                                            @if($products[$i]->discount_price && $products[$i]->discount_price < $products[$i]->price)
                                                {{ number_format($products[$i]->discount_price, 0) }}৳
                                                <span class="text-xs text-gray-400 line-through font-normal">{{ number_format($products[$i]->price, 0) }}৳</span>
                                            @else
                                                {{ number_format($products[$i]->price, 0) }}৳
                                            @endif
                                        </div>
                                    </div>
                                @else
                                    <div class="relative">
                                        <input type="text" placeholder="Search and Select Product" class="w-full border border-gray-200 rounded p-2 text-sm focus:outline-none focus:border-accent-blue compare-search-input">
                                        <i class="fas fa-search absolute right-3 top-3 text-gray-400"></i>
                                        <div class="absolute w-full bg-white border border-gray-200 shadow-lg mt-1 rounded z-50 hidden compare-search-results max-h-[300px] overflow-y-auto"></div>
                                    </div>
                                    <div class="text-center text-gray-400 text-sm mt-10 mb-10">
                                        Find and select product to compare
                                    </div>
                                @endif
                            </th>
                        @endfor
                    </tr>
                </thead>
                
                <!-- Basic Info -->
                <tbody>
                    <!-- Model -->
                    <tr>
                        <td class="p-4 text-sm text-gray-600 border-b border-gray-100">Model</td>
                        @for($i = 0; $i < $slotsToShow; $i++)
                            <td class="p-4 text-sm text-gray-800 border-l border-b border-gray-100">
                                {{ isset($products[$i]) ? ($products[$i]->name) : '' }}
                            </td>
                        @endfor
                    </tr>
                    <!-- Brand -->
                    <tr>
                        <td class="p-4 text-sm text-gray-600 border-b border-gray-100">Brand</td>
                        @for($i = 0; $i < $slotsToShow; $i++)
                            <td class="p-4 text-sm text-gray-800 border-l border-b border-gray-100">
                                {{ isset($products[$i]) ? ($products[$i]->brand->name ?? 'N/A') : '' }}
                            </td>
                        @endfor
                    </tr>
                    <!-- Availability -->
                    <tr>
                        <td class="p-4 text-sm text-gray-600 border-b border-gray-100">Availability</td>
                        @for($i = 0; $i < $slotsToShow; $i++)
                            <td class="p-4 text-sm border-l border-b border-gray-100">
                                @if(isset($products[$i]))
                                    <span class="{{ $products[$i]->stock > 0 ? 'text-green-600' : 'text-red-500' }}">
                                        {{ $products[$i]->stock > 0 ? 'In Stock' : 'Out of Stock' }}
                                    </span>
                                @endif
                            </td>
                        @endfor
                    </tr>
                    <!-- Rating -->
                    <tr>
                        <td class="p-4 text-sm text-gray-600 border-b border-gray-100">Rating</td>
                        @for($i = 0; $i < $slotsToShow; $i++)
                            <td class="p-4 text-sm text-gray-800 border-l border-b border-gray-100">
                                @if(isset($products[$i]))
                                    @php
                                        $reviewsCount = $products[$i]->reviews ? $products[$i]->reviews->where('status', 1)->count() : 0;
                                    @endphp
                                    {{ $reviewsCount }} Review(s)
                                @endif
                            </td>
                        @endfor
                    </tr>
                    
                    <!-- Key Features -->
                    <tr>
                        <td class="p-4 text-sm text-gray-600 border-b border-gray-100 align-top font-bold text-gray-800">Key Features</td>
                        @for($i = 0; $i < $slotsToShow; $i++)
                            <td class="p-4 text-[12px] text-gray-800 border-l border-b border-gray-100 align-top">
                                @if(isset($products[$i]))
                                    <div class="short-description-list">
                                        {!! $products[$i]->short_description !!}
                                    </div>
                                @endif
                            </td>
                        @endfor
                    </tr>

                    <!-- Specifications Header -->
                    @if(!empty($specKeys))
                        @foreach($specKeys as $category => $keys)
                            <tr>
                                <td colspan="{{ $slotsToShow + 1 }}" class="p-4 bg-[#f4f7fc] text-accent-blue font-bold border-b border-gray-100">
                                    {{ $category }}
                                </td>
                            </tr>
                            @foreach($keys as $key)
                                <tr>
                                    <td class="p-4 text-sm text-gray-600 border-b border-gray-100">{{ $key }}</td>
                                    @for($i = 0; $i < $slotsToShow; $i++)
                                        <td class="p-4 text-sm text-gray-800 border-l border-b border-gray-100">
                                            @if(isset($products[$i]))
                                                {!! $products[$i]->parsed_specs[$category][$key] ?? '-' !!}
                                            @endif
                                        </td>
                                    @endfor
                                </tr>
                            @endforeach
                        @endforeach
                    @endif
                </tbody>
            </table>
            
            <form id="add-to-compare-form" action="{{ route('compare.add') }}" method="POST" class="hidden">
                @csrf
                <input type="hidden" name="product_id" id="compare_product_id">
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInputs = document.querySelectorAll('.compare-search-input');
        
        searchInputs.forEach(input => {
            let timeout = null;
            const resultsContainer = input.nextElementSibling.nextElementSibling;
            
            input.addEventListener('input', function() {
                clearTimeout(timeout);
                const query = this.value;
                
                if (query.length < 2) {
                    resultsContainer.classList.add('hidden');
                    return;
                }
                
                timeout = setTimeout(() => {
                    fetch(`{{ route('compare.search') }}?q=${encodeURIComponent(query)}`)
                        .then(res => res.json())
                        .then(data => {
                            resultsContainer.innerHTML = '';
                            if (data.length > 0) {
                                data.forEach(item => {
                                    const div = document.createElement('div');
                                    div.className = 'flex items-center gap-3 p-2 hover:bg-gray-50 cursor-pointer border-b border-gray-100 last:border-0';
                                    div.innerHTML = `
                                        <img src="${item.thumbnail}" class="w-10 h-10 object-contain">
                                        <div>
                                            <div class="text-xs font-bold text-gray-800">${item.name}</div>
                                            <div class="text-xs text-accent-orange font-bold">${item.price}৳</div>
                                        </div>
                                    `;
                                    div.onclick = function() {
                                        document.getElementById('compare_product_id').value = item.id;
                                        document.getElementById('add-to-compare-form').submit();
                                    };
                                    resultsContainer.appendChild(div);
                                });
                                resultsContainer.classList.remove('hidden');
                            } else {
                                resultsContainer.innerHTML = '<div class="p-3 text-xs text-gray-500">No products found</div>';
                                resultsContainer.classList.remove('hidden');
                            }
                        });
                }, 300);
            });
            
            // Hide on outside click
            document.addEventListener('click', function(e) {
                if (e.target !== input && !resultsContainer.contains(e.target)) {
                    resultsContainer.classList.add('hidden');
                }
            });
        });
    });
</script>
@endsection
