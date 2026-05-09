@extends('layouts.app')

@section('title', 'Star Tech | Leading IT Shop in Bangladesh')

@section('content')
<div class="container mx-auto px-1 md:px-2">
    <!-- Hero Section -->
    <section class="mt-2 md:mt-2 grid grid-cols-1 lg:grid-cols-[2.2fr_1fr] gap-4 md:gap-5">
        <div class="bg-white rounded-lg overflow-hidden relative shadow-sm h-[180px] md:h-[400px] lg:h-[450px] group" id="hero-slider">
            <div class="slider-container flex h-full transition-transform duration-500 ease-in-out">
                @forelse($sliders as $slider)
                    <div class="slide min-w-full h-full">
                        <a href="{{ $slider->link ?? '#' }}">
                            <img src="{{ asset('storage/' . $slider->image) }}" alt="Slider" class="w-full h-full object-cover">
                        </a>
                    </div>
                @empty
                    <div class="slide min-w-full h-full">
                        <img src="https://www.startech.com.bd/image/cache/catalog/home/banner/freezer-offer-home-banner-982x500.webp" alt="Main Banner 1" class="w-full h-full object-cover">
                    </div>
                    <div class="slide min-w-full h-full">
                        <img src="https://www.startech.com.bd/image/cache/catalog/home/banner/gigabyte-gaming-monitor-home-banner-982x500.webp" alt="Main Banner 2" class="w-full h-full object-cover">
                    </div>
                @endforelse
            </div>
            
            <!-- Slider Arrows -->
            @if($sliders->count() > 1 || $sliders->isEmpty())
                <div class="absolute top-1/2 -translate-y-1/2 left-2 md:left-4 w-8 h-8 md:w-10 md:h-10 bg-white/70 text-gray-800 rounded-full flex items-center justify-center cursor-pointer z-10 opacity-0 group-hover:opacity-100 transition-opacity hover:bg-accent-orange hover:text-white" onclick="prevSlide()">
                    <i class="fas fa-chevron-left text-sm md:text-base"></i>
                </div>
                <div class="absolute top-1/2 -translate-y-1/2 right-2 md:right-4 w-8 h-8 md:w-10 md:h-10 bg-white/70 text-gray-800 rounded-full flex items-center justify-center cursor-pointer z-10 opacity-0 group-hover:opacity-100 transition-opacity hover:bg-accent-orange hover:text-white" onclick="nextSlide()">
                    <i class="fas fa-chevron-right text-sm md:text-base"></i>
                </div>
            @endif

            <!-- Slider Dots -->
            <div class="absolute bottom-2 md:bottom-4 left-1/2 -translate-x-1/2 flex gap-1.5 md:gap-2 z-10" id="slider-dots">
                @php $dotCount = $sliders->count() > 0 ? $sliders->count() : 3; @endphp
                @for($i = 0; $i < $dotCount; $i++)
                    <div class="w-2 h-2 md:w-3 md:h-3 rounded-full bg-white/50 cursor-pointer hover:bg-accent-orange transition-colors" onclick="goToSlide({{ $i }})"></div>
                @endfor
            </div>
        </div>

        <!-- Side Banners -->
        <div class="flex flex-col gap-4 md:gap-5">
            @forelse($sideBanners as $banner)
                <div class="bg-white rounded-lg overflow-hidden shadow-sm flex-1 h-[120px] md:h-auto">
                    <a href="{{ $banner->link ?? '#' }}">
                        <img src="{{ asset('storage/' . $banner->image) }}" alt="Side Banner" class="w-full h-full object-cover hover:scale-105 transition-transform duration-500">
                    </a>
                </div>
            @empty
                <div class="bg-white rounded-lg overflow-hidden shadow-sm flex-1 h-[120px] md:h-auto">
                    <img src="https://www.startech.com.bd/image/cache/catalog/home/banner/summer-bonanza-hp-laptop-400x240.webp" alt="Side Banner 1" class="w-full h-full object-cover">
                </div>
                <div class="bg-white rounded-lg overflow-hidden shadow-sm flex-1 h-[120px] md:h-auto">
                    <img src="https://www.startech.com.bd/image/cache/catalog/home/banner/summer-bonanza-home-banner-400x240.webp" alt="Side Banner 2" class="w-full h-full object-cover">
                </div>
            @endforelse
        </div>
    </section>

    <!-- Rest of the home page content remains the same... -->
    <!-- (I'll keep the existing content here) -->
    
    <!-- Feature Section -->
    <div class="mt-6 md:mt-8 grid grid-cols-2 md:grid-cols-4 gap-3 md:gap-4">
        <div class="bg-white p-2 md:p-4 rounded-lg shadow-sm flex items-center gap-2 md:gap-3 border border-gray-50 hover:shadow-md transition-shadow">
            <i class="fas fa-shipping-fast text-accent-orange text-lg md:text-2xl"></i>
            <div>
                <h4 class="text-[11px] md:text-sm font-bold text-primary-dark">Fast Delivery</h4>
                <p class="text-[9px] md:text-xs text-gray-400">All over Bangladesh</p>
            </div>
        </div>
        <div class="bg-white p-2 md:p-4 rounded-lg shadow-sm flex items-center gap-2 md:gap-3 border border-gray-50 hover:shadow-md transition-shadow">
            <i class="fas fa-shield-alt text-accent-orange text-lg md:text-2xl"></i>
            <div>
                <h4 class="text-[11px] md:text-sm font-bold text-primary-dark">Secure Payment</h4>
                <p class="text-[9px] md:text-xs text-gray-400">100% secure payment</p>
            </div>
        </div>
        <div class="bg-white p-2 md:p-4 rounded-lg shadow-sm flex items-center gap-2 md:gap-3 border border-gray-50 hover:shadow-md transition-shadow">
            <i class="fas fa-headset text-accent-orange text-lg md:text-2xl"></i>
            <div>
                <h4 class="text-[11px] md:text-sm font-bold text-primary-dark">24/7 Support</h4>
                <p class="text-[9px] md:text-xs text-gray-400">Dedicated support</p>
            </div>
        </div>
        <div class="bg-white p-2 md:p-4 rounded-lg shadow-sm flex items-center gap-2 md:gap-3 border border-gray-50 hover:shadow-md transition-shadow">
            <i class="fas fa-undo text-accent-orange text-lg md:text-2xl"></i>
            <div>
                <h4 class="text-[11px] md:text-sm font-bold text-primary-dark">Easy Return</h4>
                <p class="text-[9px] md:text-xs text-gray-400">7 days return policy</p>
            </div>
        </div>
    </div>

    <!-- Category Section -->
    <section class="mt-8 md:mt-12">
        <div class="text-center mb-6 md:mb-8">
            <h2 class="text-xl md:text-2xl font-bold text-primary-dark">Featured Categories</h2>
            <p class="text-[11px] md:text-sm text-gray-500 mt-1">Get Your Desired Product from Featured Category!</p>
        </div>
        <div class="grid grid-cols-4 md:grid-cols-8 lg:grid-cols-10 gap-2 md:gap-4">
            @forelse($featuredCategories as $cat)
                <a href="{{ url('category/' . $cat->slug) }}" class="bg-white p-3 md:p-5 rounded-lg shadow-sm border border-gray-50 hover:shadow-md hover:text-accent-orange transition-all flex flex-col items-center gap-2 group text-center h-full">
                    <div class="w-10 h-10 md:w-12 md:h-12 flex items-center justify-center">
                        @if($cat->image)
                            <img src="{{ asset('storage/' . $cat->image) }}" alt="{{ $cat->name }}" class="max-w-full max-h-full object-contain group-hover:scale-110 transition-transform">
                        @elseif($cat->icon)
                            <i class="{{ $cat->icon }} text-xl md:text-3xl text-gray-400 group-hover:text-accent-orange transition-colors"></i>
                        @else
                            <i class="fas fa-folder text-xl md:text-3xl text-gray-400 group-hover:text-accent-orange transition-colors"></i>
                        @endif
                    </div>
                    <span class="text-[10px] md:text-xs font-bold text-primary-dark group-hover:text-accent-orange line-clamp-1">{{ $cat->name }}</span>
                </a>
            @empty
                <p class="col-span-full text-center text-gray-400 text-sm py-4">No featured categories yet.</p>
            @endforelse
        </div>
    </section>

    <!-- Product Grid -->
    <section class="mt-12 md:mt-16">
        <div class="flex justify-between items-end mb-6 md:mb-8">
            <div class="text-center md:text-left flex-grow">
                <h2 class="text-xl md:text-2xl font-bold text-primary-dark">Featured Products</h2>
                <p class="text-[11px] md:text-sm text-gray-500 mt-1">Check & Get Your Desired Product!</p>
            </div>
            <a href="{{ route('products.index') }}" class="hidden md:block text-accent-orange font-bold text-sm hover:underline">View All Products</a>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-3 md:gap-5">
            @forelse($featuredProducts as $product)
                <div class="bg-white rounded-lg shadow-sm border border-gray-50 overflow-hidden group hover:shadow-xl transition-all flex flex-col h-full relative">
                    <!-- Badge -->
                    @if($product->stock > 0)
                        <div class="absolute top-2 left-2 bg-accent-blue text-white text-[9px] md:text-[10px] font-bold px-2 py-0.5 rounded-full z-10">
                            In Stock
                        </div>
                    @else
                        <div class="absolute top-2 left-2 bg-red-500 text-white text-[9px] md:text-[10px] font-bold px-2 py-0.5 rounded-full z-10">
                            Out of Stock
                        </div>
                    @endif
                    
                    <a href="{{ url('product/' . $product->slug) }}" class="p-2 md:p-4 aspect-square overflow-hidden bg-gray-50 flex items-center justify-center block">
                        <img src="{{ $product->thumbnail ? asset('storage/' . $product->thumbnail) : 'https://placehold.co/228x228/f9fafb/a3a3a3?text=No+Image' }}" alt="{{ $product->name }}" class="w-full h-full object-contain group-hover:scale-110 transition-transform duration-500">
                    </a>
                    <div class="p-3 md:p-5 flex flex-col flex-grow">
                        <a href="{{ url('product/' . $product->slug) }}">
                            <h3 class="text-xs md:text-[13px] font-bold text-primary-dark hover:text-accent-orange cursor-pointer line-clamp-2 leading-snug h-8 md:h-10">
                                {{ $product->name }}
                            </h3>
                        </a>
                        <ul class="mt-3 space-y-1.5 md:space-y-2 flex-grow">
                            @if($product->specifications && $product->specifications->count() > 0)
                                @foreach($product->specifications->take(3) as $spec)
                                    <li class="text-[10px] md:text-[11px] text-gray-500 flex items-start gap-2">
                                        <span class="w-1 h-1 bg-gray-300 rounded-full mt-1.5 shrink-0"></span>
                                        <span class="line-clamp-1">{{ $spec->value }}</span>
                                    </li>
                                @endforeach
                            @else
                                <li class="text-[10px] md:text-[11px] text-gray-500 flex items-center gap-2">
                                    <span class="w-1 h-1 bg-gray-300 rounded-full"></span>
                                    No specifications added
                                </li>
                            @endif
                        </ul>
                        <div class="mt-4 pt-4 border-t border-gray-100 flex flex-col gap-3">
                            <div class="flex items-center gap-2 flex-wrap">
                                @if($product->discount_price && $product->discount_price < $product->price)
                                    <span class="text-accent-orange font-bold text-sm md:text-base">{{ number_format($product->discount_price, 0) }}৳</span>
                                    <span class="text-gray-400 line-through text-[10px] md:text-xs">{{ number_format($product->price, 0) }}৳</span>
                                @else
                                    <span class="text-accent-orange font-bold text-sm md:text-base">{{ number_format($product->price, 0) }}৳</span>
                                @endif
                            </div>
                            <button onclick="buyNow({{ $product->id }})" class="w-full bg-primary-dark text-white text-xs md:text-sm font-bold py-2 md:py-2.5 rounded hover:bg-accent-orange transition-all flex items-center justify-center gap-2">
                                <i class="fas fa-shopping-cart text-[10px] md:text-xs"></i>
                                Buy Now
                            </button>
                            <button class="w-full border border-gray-100 text-gray-500 text-xs md:text-sm font-bold py-1.5 md:py-2 rounded hover:bg-gray-50 transition-all flex items-center justify-center gap-2">
                                <i class="fas fa-plus text-[10px]"></i>
                                Add to Compare
                            </button>
                        </div>
                    </div>
                </div>
            @empty
                @for($i = 0; $i < 5; $i++)
                    <div class="bg-white rounded-lg shadow-sm border border-gray-50 overflow-hidden group hover:shadow-xl transition-all flex flex-col h-full relative opacity-50">
                        <!-- Badge -->
                        <div class="absolute top-2 left-2 bg-accent-blue text-white text-[9px] md:text-[10px] font-bold px-2 py-0.5 rounded-full z-10">
                            Demo
                        </div>
                        
                        <div class="p-2 md:p-4 aspect-square overflow-hidden bg-gray-50 flex items-center justify-center">
                            <img src="https://www.startech.com.bd/image/cache/catalog/monitor/msi/pro-mp225/pro-mp225-01-228x228.webp" alt="Product" class="w-full h-full object-contain group-hover:scale-110 transition-transform duration-500">
                        </div>
                        <div class="p-3 md:p-5 flex flex-col flex-grow">
                            <h3 class="text-xs md:text-[13px] font-bold text-primary-dark cursor-pointer line-clamp-2 leading-snug h-8 md:h-10">
                                Add Featured Products in Admin Panel
                            </h3>
                            <ul class="mt-3 space-y-1.5 md:space-y-2 flex-grow">
                                <li class="text-[10px] md:text-[11px] text-gray-500 flex items-center gap-2">
                                    <span class="w-1 h-1 bg-gray-300 rounded-full"></span>
                                    Demo Specification 1
                                </li>
                            </ul>
                            <div class="mt-4 pt-4 border-t border-gray-100 flex flex-col gap-3">
                                <div class="flex items-center gap-2 flex-wrap">
                                    <span class="text-accent-orange font-bold text-sm md:text-base">0৳</span>
                                </div>
                                <button disabled class="w-full bg-gray-300 text-white text-xs md:text-sm font-bold py-2 md:py-2.5 rounded cursor-not-allowed flex items-center justify-center gap-2">
                                    <i class="fas fa-shopping-cart text-[10px] md:text-xs"></i>
                                    Buy Now
                                </button>
                            </div>
                        </div>
                    </div>
                @endfor
            @endforelse
        </div>
        <div class="mt-8 md:hidden text-center">
            <a href="{{ route('products.index') }}" class="inline-block bg-white border border-accent-orange text-accent-orange px-8 py-2.5 rounded font-bold text-sm">View All Products</a>
        </div>
    </section>
</div>

@section('scripts')
<script>
    let currentSlide = 0;
    const slides = document.querySelectorAll('.slide');
    const container = document.querySelector('.slider-container');
    const dots = document.querySelectorAll('#slider-dots > div');
    const totalSlides = slides.length;

    function updateSlider() {
        container.style.transform = `translateX(-${currentSlide * 100}%)`;
        dots.forEach((dot, index) => {
            if (index === currentSlide) {
                dot.classList.remove('bg-white/50');
                dot.classList.add('bg-accent-orange');
            } else {
                dot.classList.remove('bg-accent-orange');
                dot.classList.add('bg-white/50');
            }
        });
    }

    function nextSlide() {
        currentSlide = (currentSlide + 1) % totalSlides;
        updateSlider();
    }

    function prevSlide() {
        currentSlide = (currentSlide - 1 + totalSlides) % totalSlides;
        updateSlider();
    }

    function goToSlide(index) {
        currentSlide = index;
        updateSlider();
    }

    // Auto-slide every 5 seconds
    let autoSlideInterval = setInterval(nextSlide, 5000);

    // Pause auto-slide on hover
    document.getElementById('hero-slider').addEventListener('mouseenter', () => {
        clearInterval(autoSlideInterval);
    });

    document.getElementById('hero-slider').addEventListener('mouseleave', () => {
        autoSlideInterval = setInterval(nextSlide, 5000);
    });

    // Initialize dots
    updateSlider();
</script>
@endsection
@endsection
