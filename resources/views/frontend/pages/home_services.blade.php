@extends('layouts.app')

@section('title', 'Home Services | IOS BD')

@section('styles')
    <style>
        .carousel-slide {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.5s ease-in-out, visibility 0.5s ease-in-out;
        }
        .carousel-slide.active {
            opacity: 1;
            visibility: visible;
        }
        /* Custom slide backgrounds and text colors */
        .slide-1-left {
            background: linear-gradient(135deg, #ef4a23 0%, #ff7849 100%) !important;
            color: #ffffff !important;
        }
        .slide-1-right {
            background-color: #1a2332 !important;
            color: #ffffff !important;
        }
        
        .slide-2-left {
            background: linear-gradient(135deg, #2e3192 0%, #4b6cb7 100%) !important;
            color: #ffffff !important;
        }
        .slide-2-right {
            background-color: #141b26 !important;
            color: #ffffff !important;
        }
        
        .slide-3-left {
            background: linear-gradient(135deg, #0d9488 0%, #10b981 100%) !important;
            color: #ffffff !important;
        }
        .slide-3-right {
            background-color: #0f172a !important;
            color: #ffffff !important;
        }
        
        .slide-title {
            color: #30a7d7 !important;
        }
        .slide-subtitle {
            color: #ffffff !important;
        }
        .slide-desc {
            color: #e2e8f0 !important;
        }
        .gradient-blue-purple {
            background: linear-gradient(135deg, #1e3a8a 0%, #2e3192 100%);
        }
        .brand-logo-card {
            transition: all 0.3s ease;
        }
        .brand-logo-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.05);
        }
        .service-type-card {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .service-type-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 30px rgba(239, 74, 35, 0.08);
        }
        .faq-trigger:after {
            font-family: "Font Awesome 5 Free";
            font-weight: 900;
            content: "\f078";
            float: right;
            transition: transform 0.3s ease;
        }
        .faq-active .faq-trigger:after {
            transform: rotate(180deg);
        }
        .faq-content {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease-out;
        }
        .faq-active .faq-content {
            max-height: 200px;
        }
        .service-carousel-container {
            position: relative;
            width: 100%;
            height: 260px; /* Mobile height */
            overflow: hidden;
        }
        @media (min-width: 768px) {
            .service-carousel-container {
                height: 400px; /* Desktop/Tablet height */
            }
        }
    </style>
@endsection

@section('content')
    <div class="container mx-auto px-4 py-6 mb-12">


        <!-- MAIN CAROUSEL BANNER WRAPPER -->
        <div class="relative bg-white rounded-3xl shadow-lg border border-gray-100 overflow-hidden mb-12" id="service-carousel">
            <!-- Slides Container -->
            <div class="service-carousel-container">
                @if(isset($serviceSliders) && $serviceSliders->count() > 0)
                    @foreach($serviceSliders as $index => $slide)
                        <div class="carousel-slide {{ $index === 0 ? 'active' : '' }}">
                            <div class="flex flex-col md:flex-row h-full w-full">
                                <!-- Left Side: Uploaded Image -->
                                <div class="w-full md:w-1/2 flex items-center justify-center relative overflow-hidden bg-gray-100">
                                    <img src="{{ asset('storage/' . $slide->image) }}" class="absolute inset-0 w-full h-full object-cover">
                                    <!-- A subtle overlay on the image -->
                                    <div class="absolute inset-0 bg-gradient-to-tr from-black/20 to-transparent"></div>
                                </div>
                                
                                <!-- Right Side: Text info -->
                                <div class="w-full md:w-1/2 flex flex-col justify-center p-6 md:p-12 text-white relative" style="background-color: #1a2332;">
                                    
                                    <div class="relative z-10" style="z-index: 10; position: relative;">
                                        @if($slide->title)
                                        <h2 class="text-xl md:text-3xl font-extrabold leading-snug mb-3 text-[#30a7d7]">
                                            {{ $slide->title }}
                                        </h2>
                                        @endif
                                        @if($slide->subtitle)
                                        <h3 class="text-lg md:text-2xl font-bold mb-4 text-white">
                                            {{ $slide->subtitle }}
                                        </h3>
                                        @endif
                                        @if($slide->description)
                                        <p class="text-xs md:text-sm mb-6 max-w-md leading-relaxed text-gray-300">
                                            {{ $slide->description }}
                                        </p>
                                        @endif
                                        @if($slide->button_text || $slide->link)
                                        <div>
                                            <a href="{{ $slide->link ?? route('complain') }}" class="inline-flex items-center gap-2 bg-[#ef4a23] hover:bg-[#d83a15] text-white px-6 py-2.5 rounded-xl font-bold text-xs md:text-sm transition-all shadow-md border-0">
                                                <i class="fas fa-wrench"></i> {{ $slide->button_text ?: 'Book Service Now' }}
                                            </a>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <!-- Slide 1: Printer Servicing -->
                    <div class="carousel-slide active">
                        <div class="flex flex-col md:flex-row h-full w-full">
                            <!-- Left Side: Graphic -->
                            <div class="w-full md:w-1/2 flex items-center justify-center relative overflow-hidden p-6 md:p-12 slide-1-left">
                                <div class="absolute inset-0 bg-gradient-to-tr from-[#ef4a23] to-[#ff7849]"></div>
                                <!-- Diagonal cutout look -->
                                <div class="absolute -right-20 -bottom-20 w-80 h-80 bg-white/10 rounded-full blur-2xl"></div>
                                
                                <!-- Content Illustration -->
                                <div class="relative z-10 flex flex-col items-center text-center text-white">
                                    <i class="fas fa-print text-6xl md:text-8xl mb-4 drop-shadow-md"></i>
                                    <span class="bg-white/20 px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-widest">Printer Support</span>
                                </div>
                            </div>
                            
                            <!-- Right Side: Text info -->
                            <div class="w-full md:w-1/2 flex flex-col justify-center p-6 md:p-12 text-white relative slide-1-right">
                                
                                <div class="relative z-10" style="z-index: 10; position: relative;">
                                    <h2 class="text-xl md:text-3xl font-extrabold leading-snug mb-3 slide-title">
                                        প্রিন্টারের সব সমস্যার একটাই সমাধান
                                    </h2>
                                    <h3 class="text-lg md:text-2xl font-bold mb-4 slide-subtitle">
                                        আমাদের সার্টিফাইড টেকনিশিয়ান
                                    </h3>
                                    <p class="text-xs md:text-sm mb-6 max-w-md leading-relaxed slide-desc">
                                        আর কত টানাটানি করবেন? আমরাই আসছি আপনার ঠিকানায়! এখন স্টার টেক হোম সার্ভিসের মাধ্যমে ঘরে বসেই পান সেরা সলিউশন!
                                    </p>
                                    <div>
                                        <a href="{{ route('complain') }}" class="inline-flex items-center gap-2 bg-[#ef4a23] hover:bg-[#d83a15] text-white px-6 py-2.5 rounded-xl font-bold text-xs md:text-sm transition-all shadow-md border-0">
                                            <i class="fas fa-wrench"></i> Book Service Now
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
     
                    <!-- Slide 2: Laptop & Desktop Servicing -->
                    <div class="carousel-slide">
                        <div class="flex flex-col md:flex-row h-full w-full">
                            <!-- Left Side: Graphic -->
                            <div class="w-full md:w-1/2 flex items-center justify-center relative overflow-hidden p-6 md:p-12 slide-2-left">
                                <div class="absolute inset-0 bg-gradient-to-tr from-[#2e3192] to-[#4b6cb7]"></div>
                                <div class="absolute -right-20 -bottom-20 w-80 h-80 bg-white/10 rounded-full blur-2xl"></div>
                                
                                <div class="relative z-10 flex flex-col items-center text-center text-white">
                                    <i class="fas fa-laptop-medical text-6xl md:text-8xl mb-4 drop-shadow-md"></i>
                                    <span class="bg-white/20 px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-widest">Laptop & PC Repair</span>
                                </div>
                            </div>
                            
                            <!-- Right Side: Text info -->
                            <div class="w-full md:w-1/2 flex flex-col justify-center p-6 md:p-12 text-white relative slide-2-right">
                                
                                <div class="relative z-10" style="z-index: 10; position: relative;">
                                    <h2 class="text-xl md:text-3xl font-extrabold leading-snug mb-3 slide-title">
                                        ল্যাপটপ ও পিসি রিপেয়ার সার্ভিস
                                    </h2>
                                    <h3 class="text-lg md:text-2xl font-bold mb-4 slide-subtitle">
                                        দ্রুত ও জেনুইন পার্টসের নিশ্চয়তা
                                    </h3>
                                    <p class="text-xs md:text-sm mb-6 max-w-md leading-relaxed slide-desc">
                                        মাদারবোর্ড, ডিসপ্লে, কিবোর্ড রিপ্লেসমেন্ট এবং হিটিং সমস্যার স্থায়ী সমাধান পান অভিজ্ঞ টেকনিশিয়ানদের নিকট থেকে।
                                    </p>
                                    <div>
                                        <a href="{{ route('complain') }}" class="inline-flex items-center gap-2 bg-[#ef4a23] hover:bg-[#d83a15] text-white px-6 py-2.5 rounded-xl font-bold text-xs md:text-sm transition-all shadow-md border-0">
                                            <i class="fas fa-cog"></i> Request Repair
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
    
                    <!-- Slide 3: Smart Devices & UPS Servicing -->
                    <div class="carousel-slide">
                        <div class="flex flex-col md:flex-row h-full w-full">
                            <!-- Left Side: Graphic -->
                            <div class="w-full md:w-1/2 flex items-center justify-center relative overflow-hidden p-6 md:p-12 slide-3-left">
                                <div class="absolute inset-0 bg-gradient-to-tr from-teal-600 to-emerald-500"></div>
                                <div class="absolute -right-20 -bottom-20 w-80 h-80 bg-white/10 rounded-full blur-2xl"></div>
                                
                                <div class="relative z-10 flex flex-col items-center text-center text-white">
                                    <i class="fas fa-bolt text-6xl md:text-8xl mb-4 drop-shadow-md"></i>
                                    <span class="bg-white/20 px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-widest">UPS & Gadgets</span>
                                </div>
                            </div>
                            
                            <!-- Right Side: Text info -->
                            <div class="w-full md:w-1/2 flex flex-col justify-center p-6 md:p-12 text-white relative slide-3-right">
                                
                                <div class="relative z-10" style="z-index: 10; position: relative;">
                                    <h2 class="text-xl md:text-3xl font-extrabold leading-snug mb-3 slide-title">
                                        ইউপিএস ও গ্যাজেট সার্ভিসিং
                                    </h2>
                                    <h3 class="text-lg md:text-2xl font-bold mb-4 slide-subtitle">
                                        ব্যাটারি ও পাওয়ার সমস্যার সমাধান
                                    </h3>
                                    <p class="text-xs md:text-sm mb-6 max-w-md leading-relaxed slide-desc">
                                        আপনার ইউপিএস এর ব্যাকআপ সমস্যা বা পাওয়ার অন না হওয়া সমস্যার তাৎক্ষণিক সমাধান করে দিতে আমরা প্রস্তুত।
                                    </p>
                                    <div>
                                        <a href="{{ route('complain') }}" class="inline-flex items-center gap-2 bg-[#ef4a23] hover:bg-[#d83a15] text-white px-6 py-2.5 rounded-xl font-bold text-xs md:text-sm transition-all shadow-md border-0">
                                            <i class="fas fa-plug"></i> Fix My Device
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Carousel Controls -->
            <button class="absolute left-4 top-1/2 -translate-y-1/2 w-10 h-10 rounded-full bg-black/30 hover:bg-black/50 text-white flex items-center justify-center backdrop-blur-sm z-20 transition-colors" onclick="prevServiceSlide()">
                <i class="fas fa-chevron-left"></i>
            </button>
            <button class="absolute right-4 top-1/2 -translate-y-1/2 w-10 h-10 rounded-full bg-black/30 hover:bg-black/50 text-white flex items-center justify-center backdrop-blur-sm z-20 transition-colors" onclick="nextServiceSlide()">
                <i class="fas fa-chevron-right"></i>
            </button>

            <!-- Carousel Dots (Indicators) -->
            <div class="absolute bottom-4 left-1/2 -translate-x-1/2 flex items-center gap-2 z-20" id="service-carousel-dots">
                @if(isset($serviceSliders) && $serviceSliders->count() > 0)
                    @foreach($serviceSliders as $index => $slide)
                        <div class="w-2.5 h-2.5 rounded-full cursor-pointer bg-white{{ $index === 0 ? '' : '/50' }} transition-all{{ $index === 0 ? ' scale-125' : '' }}" onclick="goToServiceSlide({{ $index }})" id="service-dot-{{ $index }}"></div>
                    @endforeach
                @else
                    <div class="w-2.5 h-2.5 rounded-full cursor-pointer bg-white transition-all scale-125" onclick="goToServiceSlide(0)" id="service-dot-0"></div>
                    <div class="w-2.5 h-2.5 rounded-full cursor-pointer bg-white/50 transition-all" onclick="goToServiceSlide(1)" id="service-dot-1"></div>
                    <div class="w-2.5 h-2.5 rounded-full cursor-pointer bg-white/50 transition-all" onclick="goToServiceSlide(2)" id="service-dot-2"></div>
                @endif
            </div>
        </div>

        <!-- TRUSTED BADGES / PARTNERS ROW -->
        <div class="bg-gray-50 rounded-2xl py-6 px-8 border border-gray-100 mb-16 shadow-sm">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6 items-center text-center">
                @if(isset($badges) && count($badges) > 0)
                    @foreach($badges as $badge)
                    <div class="brand-logo-card flex flex-col md:flex-row items-center justify-center gap-3 p-3 bg-white rounded-xl shadow-xs border border-gray-100">
                        <div class="{{ $badge['color'] ?? 'text-[#ef4a23]' }} text-2xl flex items-center justify-center h-10 w-10">
                            @if(isset($badge['icon_type']) && $badge['icon_type'] === 'image' && !empty($badge['icon']))
                                <img src="{{ asset('storage/' . $badge['icon']) }}" alt="{{ $badge['title'] }}" class="max-h-full max-w-full object-contain">
                            @else
                                <i class="{{ $badge['icon'] ?? '' }}"></i>
                            @endif
                        </div>
                        <div class="text-left">
                            <p class="text-xs font-bold text-gray-800">{{ $badge['title'] }}</p>
                            <p class="text-[10px] text-gray-500 font-medium">{{ $badge['subtitle'] }}</p>
                        </div>
                    </div>
                    @endforeach
                @endif
            </div>
        </div>

        <!-- SERVICE CATEGORIES GRID -->
        <div class="mb-16">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-extrabold text-primary-dark tracking-tight">আমাদের সেবাসমূহ</h2>
                <p class="text-gray-500 mt-2 text-sm md:text-base">আমরা আপনার গ্যাজেটের সর্বোত্তম যত্ন নিতে আধুনিক প্রযুক্তির সেবা প্রদান করি</p>
                <div class="w-16 h-1 bg-[#ef4a23] mx-auto mt-4 rounded-full"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @if(isset($categories) && count($categories) > 0)
                    @foreach($categories as $category)
                    <div class="service-type-card bg-white p-8 rounded-2xl border border-gray-100 shadow-sm flex flex-col">
                        <div class="w-14 h-14 {{ $category['bg'] ?? 'bg-orange-50' }} {{ $category['color'] ?? 'text-[#ef4a23]' }} rounded-xl flex items-center justify-center mb-6 text-2xl flex-shrink-0 shadow-sm overflow-hidden p-2">
                            @if(isset($category['icon_type']) && $category['icon_type'] === 'image' && !empty($category['icon']))
                                <img src="{{ asset('storage/' . $category['icon']) }}" alt="{{ $category['title'] }}" class="max-h-full max-w-full object-contain">
                            @else
                                <i class="{{ $category['icon'] ?? '' }}"></i>
                            @endif
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 mb-3">{{ $category['title'] }}</h3>
                        <p class="text-gray-500 text-sm leading-relaxed mb-6">
                            {{ $category['description'] }}
                        </p>
                        <a href="{{ $category['link'] ?? route('complain') }}" class="mt-auto inline-flex items-center justify-between text-xs font-bold text-[#ef4a23] hover:text-[#d83a15] transition-colors group">
                            Book Servicing <span class="transform group-hover:translate-x-1 transition-transform">→</span>
                        </a>
                    </div>
                    @endforeach
                @endif
            </div>
        </div>

        <!-- FREQUENTLY ASKED QUESTIONS (FAQ) -->
        <div class="bg-gray-50 rounded-3xl p-8 md:p-12 border border-gray-100 mb-16 shadow-xs">
            <div class="text-center mb-10">
                <h2 class="text-2xl md:text-3xl font-extrabold text-gray-800 tracking-tight">সাধারণ কিছু প্রশ্ন উত্তর (FAQ)</h2>
                <p class="text-gray-500 mt-2 text-sm">হোম সার্ভিস বুকিং করার আগে সাধারণ কিছু জিজ্ঞাসা</p>
            </div>

            <div class="max-w-3xl mx-auto space-y-4">
                @if(isset($faqs) && count($faqs) > 0)
                    @foreach($faqs as $faq)
                    <div class="bg-white rounded-xl border border-gray-100 overflow-hidden shadow-xs" onclick="toggleFaq(this)">
                        <button class="w-full text-left py-4 px-6 font-bold text-gray-800 text-sm md:text-base flex items-center justify-between focus:outline-none faq-trigger">
                            {{ $faq['question'] }}
                        </button>
                        <div class="faq-content px-6 transition-all duration-300">
                            <p class="text-xs md:text-sm text-gray-500 pb-4 leading-relaxed">
                                {{ $faq['answer'] }}
                            </p>
                        </div>
                    </div>
                    @endforeach
                @endif
            </div>
        </div>

        <!-- BOTTOM CALL TO ACTION -->
        <div class="bg-accent-blue rounded-3xl p-8 md:p-12 text-center text-white relative overflow-hidden">
            <div class="absolute -top-12 -left-12 w-48 h-48 bg-white/5 rounded-full blur-2xl"></div>
            <div class="absolute -bottom-12 -right-12 w-48 h-48 bg-white/5 rounded-full blur-2xl"></div>
            
            <h3 class="text-2xl md:text-3xl font-extrabold mb-4 relative z-10">আপনার ডিভাইসটি কি সমস্যা করছে?</h3>
            <p class="text-blue-100 mb-8 max-w-xl mx-auto text-sm md:text-base relative z-10">
                দেরি না করে আজই অনলাইনে কমপ্লেইন বা সার্ভিস রিকোয়েস্ট জমা দিন। আমাদের এক্সপার্ট টিম অতি দ্রুত আপনার সাথে যোগাযোগ করবে।
            </p>
            <div class="relative z-10 flex flex-wrap justify-center gap-4">
                <a href="{{ route('complain') }}" class="bg-[#ef4a23] hover:bg-[#d83a15] text-white px-8 py-3 rounded-xl font-bold text-sm transition-all shadow-lg flex items-center gap-2">
                    <i class="fas fa-comment-alt"></i> Raise a Complain / Request Service
                </a>
                <a href="{{ route('contact') }}" class="bg-white/10 hover:bg-white/20 border border-white/20 text-white px-8 py-3 rounded-xl font-bold text-sm transition-all flex items-center gap-2">
                    <i class="fas fa-map-marker-alt"></i> Find Our Outlets
                </a>
            </div>
        </div>

    </div>
@endsection

@section('scripts')
    <script>
        let currentSlide = 0;
        const slides = document.querySelectorAll('.carousel-slide');
        const dots = document.querySelectorAll('#service-carousel-dots > div');
        const totalSlides = slides.length;
        let slideInterval;

        function showSlide(index) {
            slides.forEach((slide, i) => {
                if (i === index) {
                    slide.classList.add('active');
                    dots[i].classList.remove('bg-white/50');
                    dots[i].classList.add('bg-white');
                    dots[i].classList.add('scale-125');
                } else {
                    slide.classList.remove('active');
                    dots[i].classList.remove('bg-white');
                    dots[i].classList.remove('scale-125');
                    dots[i].classList.add('bg-white/50');
                }
            });
            currentSlide = index;
        }

        function nextServiceSlide() {
            let next = (currentSlide + 1) % totalSlides;
            showSlide(next);
        }

        function prevServiceSlide() {
            let prev = (currentSlide - 1 + totalSlides) % totalSlides;
            showSlide(prev);
        }

        function goToServiceSlide(index) {
            showSlide(index);
            resetInterval();
        }

        function startInterval() {
            slideInterval = setInterval(nextServiceSlide, 5000);
        }

        function resetInterval() {
            clearInterval(slideInterval);
            startInterval();
        }

        // Initialize Carousel
        startInterval();

        // FAQ Toggle function
        function toggleFaq(element) {
            const isActive = element.classList.contains('faq-active');
            
            // Close all first
            document.querySelectorAll('.faq-active').forEach(item => {
                item.classList.remove('faq-active');
            });
            
            if (!isActive) {
                element.classList.add('faq-active');
            }
        }
    </script>
@endsection
