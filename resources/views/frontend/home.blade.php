@extends('layouts.app')

@section('title', 'Star Tech | Leading IT Shop in Bangladesh')

@section('content')
<div class="container mx-auto px-4">
    <section class="mt-6 grid grid-cols-1 lg:grid-cols-[2.2fr_1fr] gap-5">
        <div class="bg-white rounded-lg overflow-hidden relative shadow-sm h-[200px] md:h-[400px] lg:h-[450px]" id="hero-slider">
            <div class="slider-container flex h-full transition-transform duration-500 ease-in-out">
                <div class="slide min-w-full h-full">
                    <img src="https://www.startech.com.bd/image/cache/catalog/home/banner/freezer-offer-home-banner-982x500.webp" alt="Main Banner 1" class="w-full h-full object-cover">
                </div>
                <div class="slide min-w-full h-full">
                    <img src="https://www.startech.com.bd/image/cache/catalog/home/banner/gigabyte-gaming-monitor-home-banner-982x500.webp" alt="Main Banner 2" class="w-full h-full object-cover">
                </div>
                <div class="slide min-w-full h-full">
                    <img src="https://www.startech.com.bd/image/cache/catalog/home/banner/desktop-pc-offer-home-banner-982x500.webp" alt="Main Banner 3" class="w-full h-full object-cover">
                </div>
            </div>
            
            <div class="absolute top-1/2 -translate-y-1/2 left-4 w-10 h-10 bg-white/70 text-gray-800 rounded-full flex items-center justify-center cursor-pointer z-10 opacity-0 transition-opacity group hover:opacity-100 hover:bg-accent-orange hover:text-white" onclick="prevSlide()">
                <i class="fas fa-chevron-left"></i>
            </div>
            <div class="absolute top-1/2 -translate-y-1/2 right-4 w-10 h-10 bg-white/70 text-gray-800 rounded-full flex items-center justify-center cursor-pointer z-10 opacity-0 transition-opacity group hover:opacity-100 hover:bg-accent-orange hover:text-white" onclick="nextSlide()">
                <i class="fas fa-chevron-right"></i>
            </div>

            <div class="absolute bottom-4 left-1/2 -translate-x-1/2 flex gap-2 z-10">
                <span class="dot w-3 h-3 bg-gray-300 rounded-full cursor-pointer transition-all duration-300 active" onclick="currentSlide(0)"></span>
                <span class="dot w-3 h-3 bg-gray-300 rounded-full cursor-pointer transition-all duration-300" onclick="currentSlide(1)"></span>
                <span class="dot w-3 h-3 bg-gray-300 rounded-full cursor-pointer transition-all duration-300" onclick="currentSlide(2)"></span>
            </div>
        </div>

        <div class="flex flex-col gap-5">
            <div class="bg-white rounded-lg h-[120px] md:h-[215px] overflow-hidden shadow-sm relative">
                <img src="https://www.startech.com.bd/image/catalog/home/banner/app-home-banner.webp" alt="Mobile App" class="w-full h-full object-cover rounded-lg">
            </div>
            <div class="bg-white rounded-lg h-[120px] md:h-[215px] overflow-hidden shadow-sm relative">
                <img src="https://www.startech.com.bd/image/catalog/home/banner/ac-calculator-home-banner.webp" alt="AC Calculator" class="w-full h-full object-cover rounded-lg">
            </div>
        </div>
    </section>

    <div class="bg-white my-6 py-2.5 px-8 rounded-full shadow-sm overflow-hidden">
        <marquee behavior="scroll" direction="left" scrollamount="5" class="text-sm text-gray-600">
            Friday, 08 May, All our branches are open except Narayanganj, Mymensingh, Rajshahi, Chattogram Agrabad, Rangpur & Khulna branch. Additionally, our online activities are open and operational.
        </marquee>
    </div>

    <section class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5 mb-8">
        <div class="bg-white p-5 rounded-lg flex items-center gap-5 shadow-sm transition-transform hover:-translate-y-1 cursor-pointer">
            <div class="w-12 h-12 rounded-full bg-accent-orange flex items-center justify-center text-2xl text-white">
                <i class="fas fa-laptop"></i>
            </div>
            <div>
                <h4 class="text-base font-bold">Laptop Finder</h4>
                <p class="text-sm text-gray-500">Find Your Laptop Easily</p>
            </div>
        </div>
        <div class="bg-white p-5 rounded-lg flex items-center gap-5 shadow-sm transition-transform hover:-translate-y-1 cursor-pointer">
            <div class="w-12 h-12 rounded-full bg-accent-orange flex items-center justify-center text-2xl text-white">
                <i class="fas fa-comment-dots"></i>
            </div>
            <div>
                <h4 class="text-base font-bold">Raise a Complain</h4>
                <p class="text-sm text-gray-500">Share your experience</p>
            </div>
        </div>
        <div class="bg-white p-5 rounded-lg flex items-center gap-5 shadow-sm transition-transform hover:-translate-y-1 cursor-pointer">
            <div class="w-12 h-12 rounded-full bg-accent-orange flex items-center justify-center text-2xl text-white">
                <i class="fas fa-tools"></i>
            </div>
            <div>
                <h4 class="text-base font-bold">Home Service</h4>
                <p class="text-sm text-gray-500">Get expert help.</p>
            </div>
        </div>
        <div class="bg-white p-5 rounded-lg flex items-center gap-5 shadow-sm transition-transform hover:-translate-y-1 cursor-pointer">
            <div class="w-12 h-12 rounded-full bg-accent-orange flex items-center justify-center text-2xl text-white">
                <i class="fas fa-user-gear"></i>
            </div>
            <div>
                <h4 class="text-base font-bold">Servicing Center</h4>
                <p class="text-sm text-gray-500">Repair Your Device</p>
            </div>
        </div>
    </section>

    <div class="text-center mt-12 mb-8">
        <h2 class="text-2xl font-bold">Featured Category</h2>
        <p class="text-gray-600 text-sm mt-1">Get Your Desired Product from Featured Category!</p>
    </div>

    <section class="grid grid-cols-3 md:grid-cols-4 lg:grid-cols-8 gap-4">
        @php
            $categories = [
                ['icon' => 'fa-satellite', 'name' => 'Starlink'],
                ['icon' => 'fa-charging-station', 'name' => 'Portable Power'],
                ['icon' => 'fa-helicopter', 'name' => 'Drone'],
                ['icon' => 'fa-camera-rotate', 'name' => 'Gimbal'],
                ['icon' => 'fa-tablet-screen-button', 'name' => 'Tablet PC'],
                ['icon' => 'fa-tv', 'name' => 'TV'],
                ['icon' => 'fa-mobile-screen-button', 'name' => 'Mobile Phone'],
                ['icon' => 'fa-plug-circle-bolt', 'name' => 'Accessories'],
                ['icon' => 'fa-hard-drive', 'name' => 'Portable SSD'],
                ['icon' => 'fa-video', 'name' => 'WiFi Camera'],
                ['icon' => 'fa-scissors', 'name' => 'Trimmer'],
                ['icon' => 'fa-clock', 'name' => 'Smart Watch'],
                ['icon' => 'fa-camera', 'name' => 'Action Camera'],
                ['icon' => 'fa-ear-listen', 'name' => 'Earbuds'],
                ['icon' => 'fa-volume-high', 'name' => 'Speakers'],
                ['icon' => 'fa-gamepad', 'name' => 'Gaming Console'],
            ];
        @endphp
        @foreach($categories as $cat)
            <div class="bg-white rounded-xl p-5 text-center flex flex-col items-center gap-4 transition-all hover:shadow-lg hover:text-accent-orange cursor-pointer group">
                <i class="fas {{ $cat['icon'] }} text-4xl text-gray-700 group-hover:text-accent-orange transition-colors"></i>
                <span class="text-[13px] font-medium leading-tight">{{ $cat['name'] }}</span>
            </div>
        @endforeach
    </section>

    <section class="bg-gradient-to-r from-[#00d2ff] via-[#3a7bd5] to-primary-dark rounded-xl p-8 lg:p-10 my-12 flex flex-col lg:flex-row justify-between items-center text-white gap-8 lg:gap-0">
        <div class="flex items-center gap-5 text-center lg:text-left flex-col lg:flex-row">
            <i class="fas fa-location-dot text-4xl"></i>
            <div>
                <h2 class="text-2xl font-bold mb-1">20+ Physical Stores</h2>
                <p class="text-sm opacity-90">Visit Our Store & Get Your Desired IT Product!</p>
            </div>
        </div>
        <a href="#" class="bg-accent-orange text-white py-3 px-8 rounded-full font-bold flex items-center gap-2.5 transition-transform hover:scale-105">
            Find Our Store <i class="fas fa-search"></i>
        </a>
    </section>

    <div class="text-center mt-16 mb-8">
        <h2 class="text-2xl font-bold">Featured Products</h2>
        <p class="text-gray-600 text-sm mt-1">Check & Get Your Desired Product!</p>
    </div>

    <section class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4">
        <!-- Product Card -->
        <a href="{{ url('/product/beko-ac') }}" class="group">
            <div class="bg-white rounded-lg p-4 relative flex flex-col h-full shadow-sm hover:shadow-xl transition-shadow">
                <div class="absolute top-0 left-0 bg-[#6e2594] text-white py-1 px-2.5 rounded-tl-lg rounded-br-lg text-[11px] font-bold z-10">Save: 21,837৳ (-26%)</div>
                <div class="w-full h-48 flex items-center justify-center mb-4 p-2">
                    <img src="https://www.startech.com.bd/image/cache/catalog/air-conditioner/beko/bnvha-180-181/bnvha-180-181-01-228x228.webp" alt="Product" class="max-w-full max-h-full object-contain">
                </div>
                <div class="flex flex-col flex-grow">
                    <h3 class="text-sm font-medium text-gray-800 mb-4 line-clamp-2 group-hover:text-accent-orange group-hover:underline leading-relaxed h-10">Beko 1.5 Ton Inverter AC</h3>
                    <div class="flex flex-col gap-1 mt-auto">
                        <span class="text-accent-orange text-lg font-bold">62,153৳</span>
                        <span class="text-gray-500 text-xs line-through">83,990৳</span>
                    </div>
                </div>
            </div>
        </a>

        @for($i=0; $i<9; $i++)
            <div class="bg-white rounded-lg p-4 relative flex flex-col h-full shadow-sm hover:shadow-xl transition-shadow group cursor-pointer">
                <div class="absolute top-0 left-0 bg-[#6e2594] text-white py-1 px-2.5 rounded-tl-lg rounded-br-lg text-[11px] font-bold z-10">Hot Deal</div>
                <div class="w-full h-48 flex items-center justify-center mb-4 p-2">
                    <img src="https://www.startech.com.bd/image/cache/catalog/ups/ecoflow/river-3/river-3-01-228x228.webp" alt="Product" class="max-w-full max-h-full object-contain">
                </div>
                <div class="flex flex-col flex-grow">
                    <h3 class="text-sm font-medium text-gray-800 mb-4 line-clamp-2 group-hover:text-accent-orange group-hover:underline leading-relaxed h-10">EcoFlow River 3 UPS & Portable Power Station</h3>
                    <div class="mt-auto">
                        <span class="text-accent-orange text-lg font-bold">27,250৳</span>
                    </div>
                </div>
            </div>
        @endfor
    </section>

    <div class="text-center my-10 lg:my-16">
        <a href="#" class="bg-white text-gray-800 border border-gray-300 py-2.5 px-10 rounded font-semibold text-sm transition-all hover:bg-accent-orange hover:text-white hover:border-accent-orange">Load More</a>
    </div>

    <section class="mt-16 py-10 text-gray-700">
        <h1 class="text-lg font-bold mb-4 text-primary-dark">Leading Computer, Laptop & Gaming PC Retail & Online Shop in Bangladesh</h1>
        <p class="text-sm leading-relaxed mb-4">Technology has become a part of our daily lives, and we depend on tech products daily for a vast portion of our lives. There is hardly a home in Bangladesh without a tech product. This is where we come in. <a href="#" class="text-accent-orange hover:underline">Star Tech Ltd.</a>, started as a Tech Product Shop in March 2007. We focus on giving the best customer service in Bangladesh, following our motto of <strong>"Customer Comes First."</strong> This is why Star Tech is the most <strong>trusted computer shop in Bangladesh</strong> today, capturing the loyalty of a large customer base.</p>

        <h2 class="text-lg font-bold mt-6 mb-4 text-primary-dark">Best Laptop Shop in Bangladesh</h2>
        <p class="text-sm leading-relaxed mb-4">Star Tech is the most popular <a href="#" class="text-accent-orange hover:underline">Laptop Brand Shop in BD</a>. Star Tech <a href="#" class="text-accent-orange hover:underline">Laptop</a> Shop has the perfect device, whether you are a freelancer, officegoer, or student. Gamers love our collection of <a href="#" class="text-accent-orange hover:underline">Gaming Laptops</a> because we always bring the latest laptops in Bangladesh.</p>

        <h2 class="text-lg font-bold mt-6 mb-4 text-primary-dark">Best Desktop PC Shop In Bangladesh</h2>
        <p class="text-sm leading-relaxed mb-4"><a href="#" class="text-accent-orange hover:underline">Star Tech</a> has the most comprehensive array of <a href="#" class="text-accent-orange hover:underline">Desktop PCs</a>. We offer top-of-the-line Custom PC, <a href="#" class="text-accent-orange hover:underline">Brand PC</a>, All-in-One PC, and <a href="#" class="text-accent-orange hover:underline">Portable Mini PC</a> at Star Tech outlets.</p>
    </section>
</div>

<style>
    /* Slider active dot state */
    .dot.active {
        background-color: var(--color-accent-orange) !important;
        width: 25px !important;
        border-radius: 10px !important;
    }
    #hero-slider:hover div[onclick] {
        opacity: 1;
    }
</style>
@endsection

@section('scripts')
<script>
    let currentIndex = 0;
    const slides = document.querySelectorAll('.slide');
    const dots = document.querySelectorAll('.dot');
    const container = document.querySelector('.slider-container');
    const totalSlides = slides.length;
    let slideInterval;

    function showSlide(index) {
        if (index >= totalSlides) currentIndex = 0;
        else if (index < 0) currentIndex = totalSlides - 1;
        else currentIndex = index;

        container.style.transform = `translateX(-${currentIndex * 100}%)`;
        
        dots.forEach((dot, i) => {
            dot.classList.toggle('active', i === currentIndex);
        });
    }

    function nextSlide() {
        showSlide(currentIndex + 1);
        resetTimer();
    }

    function prevSlide() {
        showSlide(currentIndex - 1);
        resetTimer();
    }

    function currentSlide(index) {
        showSlide(index);
        resetTimer();
    }

    function startTimer() {
        slideInterval = setInterval(nextSlide, 5000);
    }

    function resetTimer() {
        clearInterval(slideInterval);
        startTimer();
    }

    startTimer();

    const sliderElement = document.getElementById('hero-slider');
    if (sliderElement) {
        sliderElement.addEventListener('mouseenter', () => clearInterval(slideInterval));
        sliderElement.addEventListener('mouseleave', startTimer);
    }
</script>
@endsection
