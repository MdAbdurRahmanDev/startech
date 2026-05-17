@extends('layouts.app')

@section('title', 'PC Builder - Build Your Own Computer | IOS BD')

@section('styles')
    <style>
        .pc-builder-container {
            background-color: #f2f4f8;
            padding-bottom: 50px;
        }

        .builder-card {
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
            margin-bottom: 20px;
        }

        .builder-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 20px;
            border-bottom: 1px solid #eee;
            background: #fff;
        }

        .builder-actions {
            display: flex;
            gap: 20px;
        }

        .action-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 5px;
            color: #ef4a23;
            cursor: pointer;
            transition: transform 0.2s, opacity 0.2s;
        }

        .action-item:hover {
            transform: translateY(-2px);
            opacity: 0.9;
        }

        .action-item i {
            font-size: 22px;
        }

        .action-item span {
            font-size: 11px;
            font-weight: 600;
        }

        .builder-title-bar {
            background: #fff;
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
            border-radius: 8px;
        }

        .wattage-box {
            border: 1px dashed #ef4a23;
            padding: 10px 20px;
            border-radius: 8px;
            text-align: center;
            position: relative;
            background: #fff8f6;
        }

        .wattage-box .beta-tag {
            position: absolute;
            top: -10px;
            right: 10px;
            background: #ef4a23;
            color: #fff;
            font-size: 8px;
            padding: 2px 5px;
            border-radius: 4px;
            font-weight: bold;
        }

        .price-box {
            background: #3749bb;
            color: #fff;
            padding: 10px 30px;
            border-radius: 8px;
            text-align: center;
            min-width: 140px;
        }

        .component-group-title {
            background: #666e7a;
            color: #fff;
            padding: 10px 20px;
            font-size: 13px;
            font-weight: bold;
            letter-spacing: 0.5px;
        }

        .component-row {
            display: flex;
            align-items: center;
            padding: 18px 20px;
            border-bottom: 1px solid #f1f1f1;
            background: #fff;
            transition: background 0.2s;
        }

        .component-row:hover {
            background: #fafafa;
        }

        .component-icon {
            width: 52px;
            height: 52px;
            background: #eff4fc;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #3749bb;
            font-size: 24px;
            margin-right: 20px;
            flex-shrink: 0;
        }

        .component-thumbnail {
            width: 52px;
            height: 52px;
            background: #fff;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 20px;
            flex-shrink: 0;
            padding: 4px;
        }

        .component-info {
            flex: 1;
            min-width: 0; /* Prevents overflow */
        }

        .component-name {
            font-size: 13px;
            font-weight: 700;
            color: #3749bb;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .component-name.selected {
            color: #3749bb;
        }

        .required-tag {
            background: #666e7a;
            color: #fff;
            font-size: 9px;
            padding: 2px 6px;
            border-radius: 3px;
            font-weight: 600;
            text-transform: uppercase;
        }

        .product-title {
            font-size: 14px;
            font-weight: 500;
            color: #111827;
            margin-top: 4px;
            line-height: 1.4;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            padding-right: 15px;
        }

        .wattage-spec {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            font-size: 11px;
            color: #ef4a23;
            font-weight: 600;
            margin-top: 6px;
        }

        .skeleton-line {
            height: 6px;
            background: #f3f4f6;
            width: 65%;
            margin-top: 12px;
            border-radius: 3px;
        }

        .component-price {
            min-width: 120px;
            text-align: right;
            font-weight: 700;
            font-size: 15px;
            color: #111827;
            padding-right: 25px;
        }

        .btn-choose {
            border: 2px solid #3749bb;
            color: #3749bb;
            padding: 7px 22px;
            border-radius: 6px;
            font-weight: bold;
            font-size: 13px;
            transition: all 0.2s;
            text-align: center;
            min-width: 90px;
        }

        .btn-choose:hover {
            background: #3749bb;
            color: #fff;
        }

        .action-buttons-cell {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .btn-remove-item {
            color: #9ca3af;
            background: transparent;
            border: none;
            cursor: pointer;
            transition: color 0.2s;
            font-size: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .btn-remove-item:hover {
            color: #ef4a23;
        }

        .btn-swap-item {
            color: #9ca3af;
            font-size: 18px;
            transition: color 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .btn-swap-item:hover {
            color: #3749bb;
        }

        .bottom-banner {
            margin-top: 30px;
            border-radius: 8px;
            overflow: hidden;
        }

        .bottom-banner img {
            width: 100%;
            display: block;
        }

        .custom-checkbox {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 13px;
            color: #4b5563;
            margin-top: 8px;
        }

        .custom-checkbox input {
            cursor: pointer;
            accent-color: #ef4a23;
        }
    </style>
@endsection

@section('content')
    <div class="pc-builder-container">
        <div class="max-w-[1100px] mx-auto pt-8 px-4">
            
            <!-- Top Actions -->
            <div class="builder-card builder-header">
                <div class="logo bg-white p-1.5 shadow-sm border border-gray-100 flex items-center justify-center" style="border-radius: 10px;">
                    <!-- Brand Logo -->
                    <img src="{{ $setting && $setting->logo ? asset('storage/' . $setting->logo) : asset('frontend/images/logo.png') }}" class="h-9 object-contain" style="border-radius: 8px;">
                </div>
                <div class="builder-actions">
                    <form action="{{ route('pc-builder.add-to-cart') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="action-item bg-transparent border-none p-0 outline-none">
                            <i class="fas fa-shopping-basket"></i>
                            <span>Add to Cart</span>
                        </button>
                    </form>
                    <form action="{{ route('pc-builder.save') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="action-item bg-transparent border-none p-0 outline-none">
                            <i class="fas fa-save"></i>
                            <span>Save PC</span>
                        </button>
                    </form>
                    <button onclick="window.print()" class="action-item bg-transparent border-none p-0 outline-none">
                        <i class="fas fa-print"></i>
                        <span>Print</span>
                    </button>
                    <div class="action-item" onclick="alert('Screenshot functionality is ready. Press Ctrl+P or print to save as PDF.')">
                        <i class="fas fa-images"></i>
                        <span>Screenshot</span>
                    </div>
                </div>
            </div>

            @php
                $totalPrice = 0;
                $totalWattage = 0;
                $itemCount = count($selectedProducts);
                
                // Smart Wattage Extractor helper
                $getWattage = function($product, $componentKey) {
                    $name = strtolower($product->name);
                    
                    // Fallback baseline wattages
                    $fallbacks = [
                        'cpu' => 65,
                        'cpu-cooler' => 15,
                        'motherboard' => 45,
                        'ram' => 5,
                        'storage' => 5,
                        'graphics-card' => 120,
                        'power-supply' => 0,
                        'casing' => 0,
                        'monitor' => 25,
                        'casing-cooler' => 3,
                        'keyboard' => 2,
                        'mouse' => 2
                    ];
                    $baseWatt = $fallbacks[$componentKey] ?? 10;
                    
                    // Try extracting from product name (e.g. 35W, 65W)
                    if (preg_match('/(\d+)\s*(W|w)(att)?\b/', $name, $matches)) {
                        $val = (int)$matches[1];
                        if ($val > 0 && $val < 1500) {
                            return $val;
                        }
                    }
                    return $baseWatt;
                };

                foreach($selectedProducts as $key => $prod) {
                    $totalPrice += ($prod->discount_price && $prod->discount_price < $prod->price) ? $prod->discount_price : $prod->price;
                    $totalWattage += $getWattage($prod, $key);
                }
            @endphp

            <!-- Title and Stats -->
            <div class="builder-card builder-title-bar">
                <div>
                    <h1 class="text-[#3749bb] font-extrabold text-[16px] md:text-[18px]">PC Builder - Build Your Own Computer - IOS BD</h1>
                    <div class="custom-checkbox">
                        <input type="checkbox" id="hide-unconfigured">
                        <label for="hide-unconfigured" class="cursor-pointer font-medium select-none">Hide Unconfigured Components</label>
                    </div>
                </div>
                <div class="flex gap-4">
                    <div class="wattage-box">
                        <span class="beta-tag">BETA</span>
                        <div class="text-[18px] font-extrabold text-gray-800">{{ $totalWattage }}W</div>
                        <div class="text-[9px] text-gray-500 uppercase font-bold tracking-wider">Estimated Wattage</div>
                    </div>
                    <div class="price-box flex flex-col justify-center">
                        <div class="text-[18px] font-extrabold">{{ number_format($totalPrice, 0) }}৳</div>
                        <div class="text-[9px] uppercase font-bold tracking-wider">{{ $itemCount }} {{ $itemCount == 1 ? 'Item' : 'Items' }}</div>
                    </div>
                </div>
            </div>

            <!-- Core Components -->
            <div class="builder-card overflow-hidden">
                <div class="component-group-title uppercase">Core Components</div>
                
                @php
                    $components = [
                        [
                            'key' => 'cpu',
                            'label' => 'CPU',
                            'required' => true,
                            'icon' => 'fas fa-microchip',
                            'route' => 'processor',
                        ],
                        [
                            'key' => 'cpu-cooler',
                            'label' => 'CPU Cooler',
                            'required' => false,
                            'icon' => 'fas fa-fan',
                            'route' => 'cpu cooler',
                        ],
                        [
                            'key' => 'motherboard',
                            'label' => 'Motherboard',
                            'required' => true,
                            'icon' => 'fas fa-memory',
                            'route' => 'motherboard',
                        ],
                        [
                            'key' => 'ram',
                            'label' => 'RAM',
                            'required' => true,
                            'icon' => 'fas fa-sim-card',
                            'route' => 'ram',
                        ],
                        [
                            'key' => 'storage',
                            'label' => 'Storage',
                            'required' => true,
                            'icon' => 'fas fa-hdd',
                            'route' => 'ssd',
                        ],
                        [
                            'key' => 'graphics-card',
                            'label' => 'Graphics Card',
                            'required' => false,
                            'icon' => 'fas fa-video',
                            'route' => 'graphics card',
                        ],
                        [
                            'key' => 'power-supply',
                            'label' => 'Power Supply',
                            'required' => false,
                            'icon' => 'fas fa-plug',
                            'route' => 'power supply',
                        ],
                        [
                            'key' => 'casing',
                            'label' => 'Casing',
                            'required' => false,
                            'icon' => 'fas fa-desktop',
                            'route' => 'casing',
                        ],
                    ];
                @endphp

                @foreach($components as $comp)
                    @php
                        $isSelected = isset($selectedProducts[$comp['key']]);
                        $product = $isSelected ? $selectedProducts[$comp['key']] : null;
                    @endphp
                    <div class="component-row" data-component="{{ $comp['key'] }}">
                        @if($isSelected)
                            <div class="component-thumbnail">
                                <img src="{{ asset('storage/' . $product->thumbnail) }}" class="h-full w-full object-contain">
                            </div>
                        @else
                            <div class="component-icon">
                                <i class="{{ $comp['icon'] }}"></i>
                            </div>
                        @endif

                        <div class="component-info">
                            <div class="component-name {{ $isSelected ? 'selected' : '' }}">
                                {{ $comp['label'] }}
                                @if($comp['required'])
                                    <span class="required-tag">Required</span>
                                @endif
                            </div>
                            
                            @if($isSelected)
                                <div class="product-title font-semibold">{{ $product->name }}</div>
                                <div class="wattage-spec">
                                    <i class="fas fa-bolt"></i>
                                    <span>{{ $getWattage($product, $comp['key']) }}W</span>
                                </div>
                            @else
                                <div class="skeleton-line"></div>
                            @endif
                        </div>

                        <div class="component-price">
                            @if($isSelected)
                                {{ number_format(($product->discount_price && $product->discount_price < $product->price) ? $product->discount_price : $product->price, 0) }}৳
                            @endif
                        </div>

                        <div class="action-buttons-cell">
                            @if($isSelected)
                                <form action="{{ route('pc-builder.remove') }}" method="POST" class="inline">
                                    @csrf
                                    <input type="hidden" name="component" value="{{ $comp['key'] }}">
                                    <button type="submit" class="btn-remove-item" title="Remove Component">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </form>
                                <a href="{{ url('category/' . ($categories[$comp['route']] ?? str_replace(' ', '-', $comp['route']))) }}?builder={{ $comp['key'] }}" class="btn-swap-item" title="Change Component">
                                    <i class="fas fa-sync-alt"></i>
                                </a>
                            @else
                                <a href="{{ url('category/' . ($categories[$comp['route']] ?? str_replace(' ', '-', $comp['route']))) }}?builder={{ $comp['key'] }}" class="btn-choose">
                                    Choose
                                </a>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Peripherals & Others -->
            <div class="builder-card overflow-hidden">
                <div class="component-group-title uppercase">Peripherals & Others</div>
                
                @php
                    $peripherals = [
                        [
                            'key' => 'monitor',
                            'label' => 'Monitor',
                            'required' => false,
                            'icon' => 'fas fa-tv',
                            'route' => 'monitor',
                        ],
                        [
                            'key' => 'casing-cooler',
                            'label' => 'Casing Cooler',
                            'required' => false,
                            'icon' => 'fas fa-wind',
                            'route' => 'casing cooler',
                        ],
                        [
                            'key' => 'keyboard',
                            'label' => 'Keyboard',
                            'required' => false,
                            'icon' => 'fas fa-keyboard',
                            'route' => 'keyboard',
                        ],
                        [
                            'key' => 'mouse',
                            'label' => 'Mouse',
                            'required' => false,
                            'icon' => 'fas fa-mouse',
                            'route' => 'mouse',
                        ],
                    ];
                @endphp

                @foreach($peripherals as $comp)
                    @php
                        $isSelected = isset($selectedProducts[$comp['key']]);
                        $product = $isSelected ? $selectedProducts[$comp['key']] : null;
                    @endphp
                    <div class="component-row" data-component="{{ $comp['key'] }}">
                        @if($isSelected)
                            <div class="component-thumbnail">
                                <img src="{{ asset('storage/' . $product->thumbnail) }}" class="h-full w-full object-contain">
                            </div>
                        @else
                            <div class="component-icon">
                                <i class="{{ $comp['icon'] }}"></i>
                            </div>
                        @endif

                        <div class="component-info">
                            <div class="component-name {{ $isSelected ? 'selected' : '' }}">
                                {{ $comp['label'] }}
                                @if($comp['required'])
                                    <span class="required-tag">Required</span>
                                @endif
                            </div>
                            
                            @if($isSelected)
                                <div class="product-title font-semibold">{{ $product->name }}</div>
                                <div class="wattage-spec">
                                    <i class="fas fa-bolt"></i>
                                    <span>{{ $getWattage($product, $comp['key']) }}W</span>
                                </div>
                            @else
                                <div class="skeleton-line"></div>
                            @endif
                        </div>

                        <div class="component-price">
                            @if($isSelected)
                                {{ number_format(($product->discount_price && $product->discount_price < $product->price) ? $product->discount_price : $product->price, 0) }}৳
                            @endif
                        </div>

                        <div class="action-buttons-cell">
                            @if($isSelected)
                                <form action="{{ route('pc-builder.remove') }}" method="POST" class="inline">
                                    @csrf
                                    <input type="hidden" name="component" value="{{ $comp['key'] }}">
                                    <button type="submit" class="btn-remove-item" title="Remove Component">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </form>
                                <a href="{{ url('category/' . ($categories[$comp['route']] ?? str_replace(' ', '-', $comp['route']))) }}?builder={{ $comp['key'] }}" class="btn-swap-item" title="Change Component">
                                    <i class="fas fa-sync-alt"></i>
                                </a>
                            @else
                                <a href="{{ url('category/' . ($categories[$comp['route']] ?? str_replace(' ', '-', $comp['route']))) }}?builder={{ $comp['key'] }}" class="btn-choose">
                                    Choose
                                </a>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Bottom Banner -->
            <div class="bottom-banner shadow-sm">
                <img src="https://www.startech.com.bd/image/cache/catalog/home/banner/monitor/benq/benq-monitor-pc-builder-982x181.png" alt="Bottom Banner">
            </div>

        </div>
    </div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const hideUnconfiguredCheckbox = document.getElementById('hide-unconfigured');
        
        hideUnconfiguredCheckbox.addEventListener('change', function() {
            const rows = document.querySelectorAll('.component-row');
            rows.forEach(row => {
                const isSelected = row.querySelector('.component-thumbnail') !== null;
                if (this.checked) {
                    if (!isSelected) {
                        row.style.display = 'none';
                    }
                } else {
                    row.style.display = 'flex';
                }
            });
        });
    });
</script>
@endsection
