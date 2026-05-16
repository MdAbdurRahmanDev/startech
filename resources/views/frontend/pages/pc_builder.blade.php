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
            border-radius: 4px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
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
            color: #666;
            cursor: pointer;
            transition: color 0.2s;
        }

        .action-item:hover {
            color: #ef4a23;
        }

        .action-item i {
            font-size: 20px;
        }

        .action-item span {
            font-size: 11px;
            font-bold: 600;
        }

        .builder-title-bar {
            background: #fff;
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }

        .wattage-box {
            border: 1px dashed #ef4a23;
            padding: 10px 20px;
            border-radius: 8px;
            text-align: center;
            position: relative;
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
        }

        .component-group-title {
            background: #666e7a;
            color: #fff;
            padding: 8px 15px;
            font-size: 13px;
            font-weight: bold;
        }

        .component-row {
            display: flex;
            align-items: center;
            padding: 15px;
            border-bottom: 1px solid #f1f1f1;
            background: #fff;
            transition: background 0.2s;
        }

        .component-row:hover {
            background: #fafafa;
        }

        .component-icon {
            width: 50px;
            height: 50px;
            background: #f8f9fa;
            border-radius: 8px;
            display: flex;
            items-center: center;
            justify-content: center;
            color: #3749bb;
            font-size: 24px;
            margin-right: 20px;
        }

        .component-info {
            flex: 1;
        }

        .component-name {
            font-size: 14px;
            font-weight: 600;
            color: #333;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .required-tag {
            background: #666e7a;
            color: #fff;
            font-size: 10px;
            padding: 2px 6px;
            border-radius: 3px;
            font-weight: normal;
        }

        .skeleton-line {
            height: 8px;
            background: #f0f0f0;
            width: 60%;
            margin-top: 10px;
            border-radius: 4px;
        }

        .btn-choose {
            border: 2px solid #3749bb;
            color: #3749bb;
            padding: 8px 25px;
            border-radius: 4px;
            font-weight: bold;
            font-size: 13px;
            transition: all 0.2s;
        }

        .btn-choose:hover {
            background: #3749bb;
            color: #fff;
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
            gap: 10px;
            font-size: 13px;
            color: #666;
            margin-top: 10px;
        }
    </style>
@endsection

@section('content')
    <div class="pc-builder-container">
        <div class="max-w-[1100px] mx-auto pt-8">
            
            <!-- Top Actions -->
            <div class="builder-card builder-header">
                <div class="logo">
                    <!-- Brand Logo -->
                    <img src="{{ $setting && $setting->logo ? asset('storage/' . $setting->logo) : asset('frontend/images/logo.png') }}" class="h-12">
                </div>
                <div class="builder-actions">
                    <form action="{{ route('pc-builder.add-to-cart') }}" method="POST">
                        @csrf
                        <button type="submit" class="action-item bg-transparent border-none p-0 outline-none">
                            <i class="fas fa-cart-plus"></i>
                            <span>Add to Cart</span>
                        </button>
                    </form>
                    <form action="{{ route('pc-builder.save') }}" method="POST">
                        @csrf
                        <button type="submit" class="action-item bg-transparent border-none p-0 outline-none">
                            <i class="fas fa-save"></i>
                            <span>Save PC</span>
                        </button>
                    </form>
                    <div class="action-item">
                        <i class="fas fa-print"></i>
                        <span>Print</span>
                    </div>
                    <div class="action-item">
                        <i class="fas fa-camera"></i>
                        <span>Screenshot</span>
                    </div>
                </div>
            </div>

            @php
                $totalPrice = 0;
                $itemCount = count($selectedProducts);
                foreach($selectedProducts as $prod) {
                    $totalPrice += ($prod->discount_price && $prod->discount_price < $prod->price) ? $prod->discount_price : $prod->price;
                }
            @endphp

            <!-- Title and Stats -->
            <div class="builder-card builder-title-bar">
                <div>
                    <h1 class="text-[#3749bb] font-bold text-[15px]">PC Builder - Build Your Own Computer - Star Tech</h1>
                    <div class="custom-checkbox">
                        <input type="checkbox" id="hide-unconfigured">
                        <label for="hide-unconfigured">Hide Unconfigured Components</label>
                    </div>
                </div>
                <div class="flex gap-4">
                    <div class="wattage-box">
                        <span class="beta-tag">BETA</span>
                        <div class="text-[18px] font-bold text-gray-800">0W</div>
                        <div class="text-[10px] text-gray-500 uppercase font-bold">Estimated Wattage</div>
                    </div>
                    <div class="price-box">
                        <div class="text-[18px] font-bold">{{ number_format($totalPrice, 0) }}৳</div>
                        <div class="text-[10px] uppercase font-bold">{{ $itemCount }} Items</div>
                    </div>
                </div>
            </div>

            <!-- Core Components -->
            <div class="builder-card overflow-hidden">
                <div class="component-group-title uppercase">Core Components</div>
                
                <!-- CPU -->
                <div class="component-row">
                    <div class="component-icon">
                        <i class="fas fa-microchip"></i>
                    </div>
                    <div class="component-info">
                        <div class="component-name">
                            CPU <span class="required-tag">Required</span>
                        </div>
                        @if(isset($selectedProducts['cpu']))
                            <div class="selected-product flex items-center gap-4 mt-2">
                                <img src="{{ asset('storage/' . $selectedProducts['cpu']->thumbnail) }}" class="h-10 w-10 object-contain">
                                <div class="text-sm font-bold text-gray-700">{{ $selectedProducts['cpu']->name }}</div>
                            </div>
                        @else
                            <div class="skeleton-line"></div>
                        @endif
                    </div>
                    <div class="component-price px-10 font-bold text-[#3749bb]">
                        @if(isset($selectedProducts['cpu']))
                            {{ number_format(($selectedProducts['cpu']->discount_price && $selectedProducts['cpu']->discount_price < $selectedProducts['cpu']->price) ? $selectedProducts['cpu']->discount_price : $selectedProducts['cpu']->price, 0) }}৳
                        @endif
                    </div>
                    <div class="flex items-center gap-3">
                        @if(isset($selectedProducts['cpu']))
                            <form action="{{ route('pc-builder.remove') }}" method="POST">
                                @csrf
                                <input type="hidden" name="component" value="cpu">
                                <button type="submit" class="text-gray-400 hover:text-red-500 transition-colors">
                                    <i class="fas fa-times-circle text-xl"></i>
                                </button>
                            </form>
                        @endif
                        <a href="{{ url('category/' . ($categories['processor'] ?? 'processor')) }}?builder=cpu" class="btn-choose">
                            {{ isset($selectedProducts['cpu']) ? 'Change' : 'Choose' }}
                        </a>
                    </div>
                </div>

                <!-- CPU Cooler -->
                <div class="component-row">
                    <div class="component-icon">
                        <i class="fas fa-fan"></i>
                    </div>
                    <div class="component-info">
                        <div class="component-name">CPU Cooler</div>
                        @if(isset($selectedProducts['cpu-cooler']))
                            <div class="selected-product flex items-center gap-4 mt-2">
                                <img src="{{ asset('storage/' . $selectedProducts['cpu-cooler']->thumbnail) }}" class="h-10 w-10 object-contain">
                                <div class="text-sm font-bold text-gray-700">{{ $selectedProducts['cpu-cooler']->name }}</div>
                            </div>
                        @else
                            <div class="skeleton-line"></div>
                        @endif
                    </div>
                    <div class="component-price px-10 font-bold text-[#3749bb]">
                        @if(isset($selectedProducts['cpu-cooler']))
                            {{ number_format(($selectedProducts['cpu-cooler']->discount_price && $selectedProducts['cpu-cooler']->discount_price < $selectedProducts['cpu-cooler']->price) ? $selectedProducts['cpu-cooler']->discount_price : $selectedProducts['cpu-cooler']->price, 0) }}৳
                        @endif
                    </div>
                    <div class="flex items-center gap-3">
                        @if(isset($selectedProducts['cpu-cooler']))
                            <form action="{{ route('pc-builder.remove') }}" method="POST">
                                @csrf
                                <input type="hidden" name="component" value="cpu-cooler">
                                <button type="submit" class="text-gray-400 hover:text-red-500 transition-colors">
                                    <i class="fas fa-times-circle text-xl"></i>
                                </button>
                            </form>
                        @endif
                        <a href="{{ url('category/' . ($categories['cpu cooler'] ?? 'cpu-cooler')) }}?builder=cpu-cooler" class="btn-choose">
                            {{ isset($selectedProducts['cpu-cooler']) ? 'Change' : 'Choose' }}
                        </a>
                    </div>
                </div>

                <!-- Motherboard -->
                <div class="component-row">
                    <div class="component-icon">
                        <i class="fas fa-memory"></i>
                    </div>
                    <div class="component-info">
                        <div class="component-name">
                            Motherboard <span class="required-tag">Required</span>
                        </div>
                        @if(isset($selectedProducts['motherboard']))
                            <div class="selected-product flex items-center gap-4 mt-2">
                                <img src="{{ asset('storage/' . $selectedProducts['motherboard']->thumbnail) }}" class="h-10 w-10 object-contain">
                                <div class="text-sm font-bold text-gray-700">{{ $selectedProducts['motherboard']->name }}</div>
                            </div>
                        @else
                            <div class="skeleton-line"></div>
                        @endif
                    </div>
                    <div class="component-price px-10 font-bold text-[#3749bb]">
                        @if(isset($selectedProducts['motherboard']))
                            {{ number_format(($selectedProducts['motherboard']->discount_price && $selectedProducts['motherboard']->discount_price < $selectedProducts['motherboard']->price) ? $selectedProducts['motherboard']->discount_price : $selectedProducts['motherboard']->price, 0) }}৳
                        @endif
                    </div>
                    <div class="flex items-center gap-3">
                        @if(isset($selectedProducts['motherboard']))
                            <form action="{{ route('pc-builder.remove') }}" method="POST">
                                @csrf
                                <input type="hidden" name="component" value="motherboard">
                                <button type="submit" class="text-gray-400 hover:text-red-500 transition-colors">
                                    <i class="fas fa-times-circle text-xl"></i>
                                </button>
                            </form>
                        @endif
                        <a href="{{ url('category/' . ($categories['motherboard'] ?? 'motherboard')) }}?builder=motherboard" class="btn-choose">
                            {{ isset($selectedProducts['motherboard']) ? 'Change' : 'Choose' }}
                        </a>
                    </div>
                </div>

                <!-- RAM -->
                <div class="component-row">
                    <div class="component-icon">
                        <i class="fas fa-sim-card"></i>
                    </div>
                    <div class="component-info">
                        <div class="component-name">
                            RAM <span class="required-tag">Required</span>
                        </div>
                        @if(isset($selectedProducts['ram']))
                            <div class="selected-product flex items-center gap-4 mt-2">
                                <img src="{{ asset('storage/' . $selectedProducts['ram']->thumbnail) }}" class="h-10 w-10 object-contain">
                                <div class="text-sm font-bold text-gray-700">{{ $selectedProducts['ram']->name }}</div>
                            </div>
                        @else
                            <div class="skeleton-line"></div>
                        @endif
                    </div>
                    <div class="component-price px-10 font-bold text-[#3749bb]">
                        @if(isset($selectedProducts['ram']))
                            {{ number_format(($selectedProducts['ram']->discount_price && $selectedProducts['ram']->discount_price < $selectedProducts['ram']->price) ? $selectedProducts['ram']->discount_price : $selectedProducts['ram']->price, 0) }}৳
                        @endif
                    </div>
                    <div class="flex items-center gap-3">
                        @if(isset($selectedProducts['ram']))
                            <form action="{{ route('pc-builder.remove') }}" method="POST">
                                @csrf
                                <input type="hidden" name="component" value="ram">
                                <button type="submit" class="text-gray-400 hover:text-red-500 transition-colors">
                                    <i class="fas fa-times-circle text-xl"></i>
                                </button>
                            </form>
                        @endif
                        <a href="{{ url('category/' . ($categories['ram'] ?? 'ram')) }}?builder=ram" class="btn-choose">
                            {{ isset($selectedProducts['ram']) ? 'Change' : 'Choose' }}
                        </a>
                    </div>
                </div>

                <!-- Storage -->
                <div class="component-row">
                    <div class="component-icon">
                        <i class="fas fa-hdd"></i>
                    </div>
                    <div class="component-info">
                        <div class="component-name">
                            Storage <span class="required-tag">Required</span>
                        </div>
                        @if(isset($selectedProducts['storage']))
                            <div class="selected-product flex items-center gap-4 mt-2">
                                <img src="{{ asset('storage/' . $selectedProducts['storage']->thumbnail) }}" class="h-10 w-10 object-contain">
                                <div class="text-sm font-bold text-gray-700">{{ $selectedProducts['storage']->name }}</div>
                            </div>
                        @else
                            <div class="skeleton-line"></div>
                        @endif
                    </div>
                    <div class="component-price px-10 font-bold text-[#3749bb]">
                        @if(isset($selectedProducts['storage']))
                            {{ number_format(($selectedProducts['storage']->discount_price && $selectedProducts['storage']->discount_price < $selectedProducts['storage']->price) ? $selectedProducts['storage']->discount_price : $selectedProducts['storage']->price, 0) }}৳
                        @endif
                    </div>
                    <div class="flex items-center gap-3">
                        @if(isset($selectedProducts['storage']))
                            <form action="{{ route('pc-builder.remove') }}" method="POST">
                                @csrf
                                <input type="hidden" name="component" value="storage">
                                <button type="submit" class="text-gray-400 hover:text-red-500 transition-colors">
                                    <i class="fas fa-times-circle text-xl"></i>
                                </button>
                            </form>
                        @endif
                        <a href="{{ url('category/' . ($categories['ssd'] ?? 'ssd')) }}?builder=storage" class="btn-choose">
                            {{ isset($selectedProducts['storage']) ? 'Change' : 'Choose' }}
                        </a>
                    </div>
                </div>

                <!-- Graphics Card -->
                <div class="component-row">
                    <div class="component-icon">
                        <i class="fas fa-video"></i>
                    </div>
                    <div class="component-info">
                        <div class="component-name">Graphics Card</div>
                        @if(isset($selectedProducts['graphics-card']))
                            <div class="selected-product flex items-center gap-4 mt-2">
                                <img src="{{ asset('storage/' . $selectedProducts['graphics-card']->thumbnail) }}" class="h-10 w-10 object-contain">
                                <div class="text-sm font-bold text-gray-700">{{ $selectedProducts['graphics-card']->name }}</div>
                            </div>
                        @else
                            <div class="skeleton-line"></div>
                        @endif
                    </div>
                    <div class="component-price px-10 font-bold text-[#3749bb]">
                        @if(isset($selectedProducts['graphics-card']))
                            {{ number_format(($selectedProducts['graphics-card']->discount_price && $selectedProducts['graphics-card']->discount_price < $selectedProducts['graphics-card']->price) ? $selectedProducts['graphics-card']->discount_price : $selectedProducts['graphics-card']->price, 0) }}৳
                        @endif
                    </div>
                    <div class="flex items-center gap-3">
                        @if(isset($selectedProducts['graphics-card']))
                            <form action="{{ route('pc-builder.remove') }}" method="POST">
                                @csrf
                                <input type="hidden" name="component" value="graphics-card">
                                <button type="submit" class="text-gray-400 hover:text-red-500 transition-colors">
                                    <i class="fas fa-times-circle text-xl"></i>
                                </button>
                            </form>
                        @endif
                        <a href="{{ url('category/' . ($categories['graphics card'] ?? 'graphics-card')) }}?builder=graphics-card" class="btn-choose">
                            {{ isset($selectedProducts['graphics-card']) ? 'Change' : 'Choose' }}
                        </a>
                    </div>
                </div>

                <!-- Power Supply -->
                <div class="component-row">
                    <div class="component-icon">
                        <i class="fas fa-plug"></i>
                    </div>
                    <div class="component-info">
                        <div class="component-name">Power Supply</div>
                        @if(isset($selectedProducts['power-supply']))
                            <div class="selected-product flex items-center gap-4 mt-2">
                                <img src="{{ asset('storage/' . $selectedProducts['power-supply']->thumbnail) }}" class="h-10 w-10 object-contain">
                                <div class="text-sm font-bold text-gray-700">{{ $selectedProducts['power-supply']->name }}</div>
                            </div>
                        @else
                            <div class="skeleton-line"></div>
                        @endif
                    </div>
                    <div class="component-price px-10 font-bold text-[#3749bb]">
                        @if(isset($selectedProducts['power-supply']))
                            {{ number_format(($selectedProducts['power-supply']->discount_price && $selectedProducts['power-supply']->discount_price < $selectedProducts['power-supply']->price) ? $selectedProducts['power-supply']->discount_price : $selectedProducts['power-supply']->price, 0) }}৳
                        @endif
                    </div>
                    <div class="flex items-center gap-3">
                        @if(isset($selectedProducts['power-supply']))
                            <form action="{{ route('pc-builder.remove') }}" method="POST">
                                @csrf
                                <input type="hidden" name="component" value="power-supply">
                                <button type="submit" class="text-gray-400 hover:text-red-500 transition-colors">
                                    <i class="fas fa-times-circle text-xl"></i>
                                </button>
                            </form>
                        @endif
                        <a href="{{ url('category/' . ($categories['power supply'] ?? 'power-supply')) }}?builder=power-supply" class="btn-choose">
                            {{ isset($selectedProducts['power-supply']) ? 'Change' : 'Choose' }}
                        </a>
                    </div>
                </div>

                <!-- Casing -->
                <div class="component-row">
                    <div class="component-icon">
                        <i class="fas fa-desktop"></i>
                    </div>
                    <div class="component-info">
                        <div class="component-name">Casing</div>
                        @if(isset($selectedProducts['casing']))
                            <div class="selected-product flex items-center gap-4 mt-2">
                                <img src="{{ asset('storage/' . $selectedProducts['casing']->thumbnail) }}" class="h-10 w-10 object-contain">
                                <div class="text-sm font-bold text-gray-700">{{ $selectedProducts['casing']->name }}</div>
                            </div>
                        @else
                            <div class="skeleton-line"></div>
                        @endif
                    </div>
                    <div class="component-price px-10 font-bold text-[#3749bb]">
                        @if(isset($selectedProducts['casing']))
                            {{ number_format(($selectedProducts['casing']->discount_price && $selectedProducts['casing']->discount_price < $selectedProducts['casing']->price) ? $selectedProducts['casing']->discount_price : $selectedProducts['casing']->price, 0) }}৳
                        @endif
                    </div>
                    <div class="flex items-center gap-3">
                        @if(isset($selectedProducts['casing']))
                            <form action="{{ route('pc-builder.remove') }}" method="POST">
                                @csrf
                                <input type="hidden" name="component" value="casing">
                                <button type="submit" class="text-gray-400 hover:text-red-500 transition-colors">
                                    <i class="fas fa-times-circle text-xl"></i>
                                </button>
                            </form>
                        @endif
                        <a href="{{ url('category/' . ($categories['casing'] ?? 'casing')) }}?builder=casing" class="btn-choose">
                            {{ isset($selectedProducts['casing']) ? 'Change' : 'Choose' }}
                        </a>
                    </div>
                </div>
            </div>

            <!-- Peripherals & Others -->
            <div class="builder-card overflow-hidden">
                <div class="component-group-title uppercase">Peripherals & Others</div>
                
                <!-- Monitor -->
                <div class="component-row">
                    <div class="component-icon">
                        <i class="fas fa-tv"></i>
                    </div>
                    <div class="component-info">
                        <div class="component-name">Monitor</div>
                        @if(isset($selectedProducts['monitor']))
                            <div class="selected-product flex items-center gap-4 mt-2">
                                <img src="{{ asset('storage/' . $selectedProducts['monitor']->thumbnail) }}" class="h-10 w-10 object-contain">
                                <div class="text-sm font-bold text-gray-700">{{ $selectedProducts['monitor']->name }}</div>
                            </div>
                        @else
                            <div class="skeleton-line"></div>
                        @endif
                    </div>
                    <div class="component-price px-10 font-bold text-[#3749bb]">
                        @if(isset($selectedProducts['monitor']))
                            {{ number_format(($selectedProducts['monitor']->discount_price && $selectedProducts['monitor']->discount_price < $selectedProducts['monitor']->price) ? $selectedProducts['monitor']->discount_price : $selectedProducts['monitor']->price, 0) }}৳
                        @endif
                    </div>
                    <div class="flex items-center gap-3">
                        @if(isset($selectedProducts['monitor']))
                            <form action="{{ route('pc-builder.remove') }}" method="POST">
                                @csrf
                                <input type="hidden" name="component" value="monitor">
                                <button type="submit" class="text-gray-400 hover:text-red-500 transition-colors">
                                    <i class="fas fa-times-circle text-xl"></i>
                                </button>
                            </form>
                        @endif
                        <a href="{{ url('category/' . ($categories['monitor'] ?? 'monitor')) }}?builder=monitor" class="btn-choose">
                            {{ isset($selectedProducts['monitor']) ? 'Change' : 'Choose' }}
                        </a>
                    </div>
                </div>

                <!-- Casing Cooler -->
                <div class="component-row">
                    <div class="component-icon">
                        <i class="fas fa-wind"></i>
                    </div>
                    <div class="component-info">
                        <div class="component-name">Casing Cooler</div>
                        @if(isset($selectedProducts['casing-cooler']))
                            <div class="selected-product flex items-center gap-4 mt-2">
                                <img src="{{ asset('storage/' . $selectedProducts['casing-cooler']->thumbnail) }}" class="h-10 w-10 object-contain">
                                <div class="text-sm font-bold text-gray-700">{{ $selectedProducts['casing-cooler']->name }}</div>
                            </div>
                        @else
                            <div class="skeleton-line"></div>
                        @endif
                    </div>
                    <div class="component-price px-10 font-bold text-[#3749bb]">
                        @if(isset($selectedProducts['casing-cooler']))
                            {{ number_format(($selectedProducts['casing-cooler']->discount_price && $selectedProducts['casing-cooler']->discount_price < $selectedProducts['casing-cooler']->price) ? $selectedProducts['casing-cooler']->discount_price : $selectedProducts['casing-cooler']->price, 0) }}৳
                        @endif
                    </div>
                    <div class="flex items-center gap-3">
                        @if(isset($selectedProducts['casing-cooler']))
                            <form action="{{ route('pc-builder.remove') }}" method="POST">
                                @csrf
                                <input type="hidden" name="component" value="casing-cooler">
                                <button type="submit" class="text-gray-400 hover:text-red-500 transition-colors">
                                    <i class="fas fa-times-circle text-xl"></i>
                                </button>
                            </form>
                        @endif
                        <a href="{{ url('category/' . ($categories['casing cooler'] ?? 'casing-cooler')) }}?builder=casing-cooler" class="btn-choose">
                            {{ isset($selectedProducts['casing-cooler']) ? 'Change' : 'Choose' }}
                        </a>
                    </div>
                </div>

                <!-- Keyboard -->
                <div class="component-row">
                    <div class="component-icon">
                        <i class="fas fa-keyboard"></i>
                    </div>
                    <div class="component-info">
                        <div class="component-name">Keyboard</div>
                        @if(isset($selectedProducts['keyboard']))
                            <div class="selected-product flex items-center gap-4 mt-2">
                                <img src="{{ asset('storage/' . $selectedProducts['keyboard']->thumbnail) }}" class="h-10 w-10 object-contain">
                                <div class="text-sm font-bold text-gray-700">{{ $selectedProducts['keyboard']->name }}</div>
                            </div>
                        @else
                            <div class="skeleton-line"></div>
                        @endif
                    </div>
                    <div class="component-price px-10 font-bold text-[#3749bb]">
                        @if(isset($selectedProducts['keyboard']))
                            {{ number_format(($selectedProducts['keyboard']->discount_price && $selectedProducts['keyboard']->discount_price < $selectedProducts['keyboard']->price) ? $selectedProducts['keyboard']->discount_price : $selectedProducts['keyboard']->price, 0) }}৳
                        @endif
                    </div>
                    <div class="flex items-center gap-3">
                        @if(isset($selectedProducts['keyboard']))
                            <form action="{{ route('pc-builder.remove') }}" method="POST">
                                @csrf
                                <input type="hidden" name="component" value="keyboard">
                                <button type="submit" class="text-gray-400 hover:text-red-500 transition-colors">
                                    <i class="fas fa-times-circle text-xl"></i>
                                </button>
                            </form>
                        @endif
                        <a href="{{ url('category/' . ($categories['keyboard'] ?? 'keyboard')) }}?builder=keyboard" class="btn-choose">
                            {{ isset($selectedProducts['keyboard']) ? 'Change' : 'Choose' }}
                        </a>
                    </div>
                </div>

                <!-- Mouse -->
                <div class="component-row">
                    <div class="component-icon">
                        <i class="fas fa-mouse"></i>
                    </div>
                    <div class="component-info">
                        <div class="component-name">Mouse</div>
                        @if(isset($selectedProducts['mouse']))
                            <div class="selected-product flex items-center gap-4 mt-2">
                                <img src="{{ asset('storage/' . $selectedProducts['mouse']->thumbnail) }}" class="h-10 w-10 object-contain">
                                <div class="text-sm font-bold text-gray-700">{{ $selectedProducts['mouse']->name }}</div>
                            </div>
                        @else
                            <div class="skeleton-line"></div>
                        @endif
                    </div>
                    <div class="component-price px-10 font-bold text-[#3749bb]">
                        @if(isset($selectedProducts['mouse']))
                            {{ number_format(($selectedProducts['mouse']->discount_price && $selectedProducts['mouse']->discount_price < $selectedProducts['mouse']->price) ? $selectedProducts['mouse']->discount_price : $selectedProducts['mouse']->price, 0) }}৳
                        @endif
                    </div>
                    <div class="flex items-center gap-3">
                        @if(isset($selectedProducts['mouse']))
                            <form action="{{ route('pc-builder.remove') }}" method="POST">
                                @csrf
                                <input type="hidden" name="component" value="mouse">
                                <button type="submit" class="text-gray-400 hover:text-red-500 transition-colors">
                                    <i class="fas fa-times-circle text-xl"></i>
                                </button>
                            </form>
                        @endif
                        <a href="{{ url('category/' . ($categories['mouse'] ?? 'mouse')) }}?builder=mouse" class="btn-choose">
                            {{ isset($selectedProducts['mouse']) ? 'Change' : 'Choose' }}
                        </a>
                    </div>
                </div>
            </div>

            <!-- Bottom Banner -->
            <div class="bottom-banner shadow-sm">
                <img src="https://www.startech.com.bd/image/cache/catalog/home/banner/monitor/benq/benq-monitor-pc-builder-982x181.png" alt="Bottom Banner">
            </div>

        </div>
    </div>
@endsection
