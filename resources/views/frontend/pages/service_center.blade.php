@extends('layouts.app')

@section('title', 'Servicing Center | IOS BD')

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
        .service-carousel-container {
            position: relative;
            width: 100%;
            height: 260px; /* Mobile height */
            overflow: hidden;
        }
        @media (min-width: 768px) {
            .service-carousel-container {
                height: 420px; /* Desktop height */
            }
        }
        .timeline-step {
            position: relative;
            padding-left: 2.5rem;
            margin-bottom: 2rem;
        }
        .timeline-step::before {
            content: '';
            position: absolute;
            left: 0.5rem;
            top: 1.5rem;
            bottom: -2rem;
            width: 2px;
            background-color: #3b82f6;
        }
        .timeline-step:last-child::before {
            display: none;
        }
        .timeline-step-circle {
            position: absolute;
            left: 0;
            top: 0;
            width: 1.25rem;
            height: 1.25rem;
            border-radius: 50%;
            border: 2px solid #3b82f6;
            background-color: #ffffff;
            z-index: 10;
        }
        .outlet-card, .article-card {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .outlet-card:hover, .article-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.06);
        }
        .complain-steps-container {
            display: grid;
            grid-template-columns: 1fr;
            gap: 2rem;
        }
        @media (min-width: 992px) {
            .complain-steps-container {
                grid-template-columns: 1fr 1fr;
            }
        }
    </style>
@endsection

@section('content')
    <div class="container mx-auto px-4 py-6 mb-12">
        
        <!-- AUTO IMAGE SLIDER BANNER -->
        <div class="relative bg-white rounded-2xl shadow-md border border-gray-100 overflow-hidden mb-12" id="service-carousel">
            <div class="service-carousel-container">
                @if(isset($serviceSliders) && $serviceSliders->count() > 0)
                    @foreach($serviceSliders as $index => $slide)
                        <div class="carousel-slide {{ $index === 0 ? 'active' : '' }}">
                            <img src="{{ asset('storage/' . $slide->image) }}" class="w-full h-full object-cover" alt="Service Center Slide">
                        </div>
                    @endforeach
                @else
                    <!-- Slide 1: Laptop & Desktop Services -->
                    <div class="carousel-slide active">
                        <img src="https://images.unsplash.com/photo-1588508065123-287b28e013da?q=80&w=1600" class="w-full h-full object-cover" alt="Laptop & PC Repair">
                    </div>

                    <!-- Slide 2: Printer & Corporate Support -->
                    <div class="carousel-slide">
                        <img src="https://images.unsplash.com/photo-1618005182384-a83a8bd57fbe?q=80&w=1600" class="w-full h-full object-cover" alt="Printer Servicing">
                    </div>

                    <!-- Slide 3: Smart Devices & UPS Care -->
                    <div class="carousel-slide">
                        <img src="https://images.unsplash.com/photo-1597740985671-2a8a3b80ef02?q=80&w=1600" class="w-full h-full object-cover" alt="Smart Devices Repair">
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

            <!-- Carousel Indicators -->
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

        <!-- FORM & STEPS SECTION -->
        <div class="complain-steps-container mb-16" id="complain-section">
            <!-- Left Side: Custom Styled Form -->
            <div class="bg-[#f4ebe6] p-8 rounded-2xl border border-gray-100 flex flex-col justify-between shadow-xs">
                <div>
                    <span class="text-[10px] md:text-xs font-bold text-gray-500 uppercase tracking-widest block mb-1">FILL THE FORM</span>
                    <h3 class="text-2xl md:text-3xl font-extrabold text-gray-800 mb-6">Get Help From Experts</h3>
                    
                    <form action="{{ route('complain') }}" method="GET" class="space-y-4">
                        <div>
                            <label class="text-[11px] md:text-xs font-bold text-gray-600 block mb-1.5">Service You Are Looking For</label>
                            <input type="text" name="service_name" placeholder="Service Name" class="w-full bg-white border border-gray-200 rounded-lg px-4 py-2.5 text-xs md:text-sm focus:outline-none focus:border-orange-400">
                        </div>
                        
                        <div>
                            <label class="text-[11px] md:text-xs font-bold text-gray-600 block mb-1.5">A Little About The Issue</label>
                            <textarea name="description" rows="3" placeholder="Write here" class="w-full bg-white border border-gray-200 rounded-lg px-4 py-2.5 text-xs md:text-sm focus:outline-none focus:border-orange-400"></textarea>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="text-[11px] md:text-xs font-bold text-gray-600 block mb-1.5">Name</label>
                                <input type="text" name="name" placeholder="Name" class="w-full bg-white border border-gray-200 rounded-lg px-4 py-2.5 text-xs md:text-sm focus:outline-none focus:border-orange-400">
                            </div>
                            <div>
                                <label class="text-[11px] md:text-xs font-bold text-gray-600 block mb-1.5">Phone</label>
                                <input type="text" name="phone" placeholder="Phone" class="w-full bg-white border border-gray-200 rounded-lg px-4 py-2.5 text-xs md:text-sm focus:outline-none focus:border-orange-400">
                            </div>
                        </div>
                        
                        <div>
                            <label class="text-[11px] md:text-xs font-bold text-gray-600 block mb-1.5">Email</label>
                            <input type="email" name="email" placeholder="Email" class="w-full bg-white border border-gray-200 rounded-lg px-4 py-2.5 text-xs md:text-sm focus:outline-none focus:border-orange-400">
                        </div>
                        
                        <button type="submit" class="w-full bg-[#ef4a23] hover:bg-[#d83a15] text-white py-3 rounded-lg font-bold text-xs md:text-sm shadow-md transition-colors border-0 mt-2">
                            Submit Your Request
                        </button>
                    </form>
                </div>
            </div>

            <!-- Right Side: Simple Steps timeline -->
            <div class="bg-white p-8 rounded-2xl border border-gray-100 flex flex-col justify-between shadow-xs">
                <div>
                    <span class="text-[10px] md:text-xs font-bold text-gray-500 uppercase tracking-widest block mb-1">GET SERVED</span>
                    <h3 class="text-2xl md:text-3xl font-extrabold text-gray-800 mb-8">Follow These Simple Steps</h3>
                    
                    <div class="timeline-container pl-2">
                        @forelse($steps as $step)
                        <div class="timeline-step">
                            <div class="timeline-step-circle"></div>
                            <h4 class="text-sm md:text-base font-bold text-gray-800 mb-1">{{ $step['title'] }}</h4>
                            <p class="text-xs text-gray-500 leading-relaxed">{{ $step['description'] }}</p>
                        </div>
                        @empty
                        <p class="text-sm text-gray-400">No steps added yet.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

        <!-- SERVICE CENTERS LIST (OUTLETS) -->
        <div class="mb-16">
            <div class="text-center mb-12">
                <h2 class="text-2xl md:text-3xl font-extrabold text-gray-900 tracking-tight">Our Servicing Outlets</h2>
                <div class="w-16 h-1 bg-[#ef4a23] mx-auto mt-4 rounded-full"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($outlets as $outlet)
                <div class="outlet-card bg-white p-6 rounded-xl border border-gray-100 shadow-sm flex flex-col justify-between">
                    @php
                        // Phone label mapping
                        $phoneLabels = [
                            'desktop_1'  => 'Desktop',
                            'desktop_2'  => 'Desktop 2',
                            'laptop'     => 'Laptop',
                            'accessories'=> 'Accessories',
                            'corporate'  => 'Corporate',
                        ];
                        // Get unique phone numbers (values), ignoring empty ones
                        $uniquePhones = [];
                        if (is_array($outlet->phones)) {
                            foreach ($outlet->phones as $key => $num) {
                                $num = trim($num);
                                if ($num && !in_array($num, array_column($uniquePhones, 'number'))) {
                                    $uniquePhones[] = [
                                        'label'  => $phoneLabels[$key] ?? ucfirst($key),
                                        'number' => $num,
                                    ];
                                }
                            }
                        }
                    @endphp
                    <div>
                        <h3 class="text-base md:text-lg font-bold text-gray-800 mb-2">{{ $outlet->name }}</h3>
                        <p class="text-xs text-gray-500 mb-3 leading-relaxed">{{ $outlet->address }}</p>
                        @if(count($uniquePhones) > 0)
                        <div class="space-y-1 mb-3">
                            @foreach($uniquePhones as $p)
                            <div class="flex items-center gap-2 text-xs">
                                <i class="fas fa-phone text-gray-400 w-3 shrink-0"></i>
                                <span class="text-[10px] font-bold text-gray-400 uppercase tracking-wide w-20 shrink-0">{{ $p['label'] }}</span>
                                <a href="tel:{{ $p['number'] }}" class="text-gray-800 font-semibold hover:text-[#ef4a23] transition-colors">{{ $p['number'] }}</a>
                            </div>
                            @endforeach
                        </div>
                        @endif
                    </div>
                    <div class="flex items-center justify-between mt-2 pt-4 border-t border-gray-100">
                        <div class="flex items-center gap-2 flex-wrap">
                            @if($outlet->off_day)
                                <span class="bg-red-50 text-red-500 px-3 py-1 rounded-full text-[10px] font-bold">{{ $outlet->off_day }} Off</span>
                            @endif
                            @if($outlet->timing)
                                <span class="bg-emerald-50 text-emerald-600 px-3 py-1 rounded-full text-[10px] font-bold">{{ $outlet->timing }}</span>
                            @endif
                        </div>
                        @if($outlet->map_link)
                        <a href="{{ $outlet->map_link }}" target="_blank" class="bg-[#2a4365] hover:bg-[#1a365d] text-white px-3 py-1.5 rounded-lg text-[10px] font-bold flex items-center gap-1 transition-colors shrink-0">
                            Get Direction <i class="fas fa-external-link-alt text-[8px]"></i>
                        </a>
                        @endif
                    </div>
                </div>
                @empty
                    <p class="text-gray-400 text-sm col-span-3 text-center py-6">No outlets found.</p>
                @endforelse
            </div>
        </div>

        <!-- EXPERT BLOGS FROM DATABASE -->
        <div class="mb-16">
            <div class="text-center mb-10">
                <h2 class="text-2xl md:text-3xl font-extrabold text-gray-900 tracking-tight">Expert Suggestion & Servicing Tips</h2>
                <p class="text-gray-500 mt-2 text-xs md:text-sm">Here you can find experts suggestion and servicing tips of your Tech products!</p>
                <div class="w-16 h-1 bg-[#ef4a23] mx-auto mt-4 rounded-full"></div>
            </div>

            @if($expertBlogs->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($expertBlogs as $blog)
                <a href="{{ route('blogs.show', $blog->slug) }}" class="article-card bg-white rounded-xl border border-gray-100 overflow-hidden shadow-sm flex flex-col justify-between group">
                    <div class="relative h-44 bg-gradient-to-br from-blue-900 to-indigo-800 overflow-hidden">
                        @if($blog->thumbnail)
                            <img src="{{ asset('storage/' . $blog->thumbnail) }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-400" alt="{{ $blog->title }}">
                        @else
                            <div class="w-full h-full flex items-center justify-center flex-col text-white/20 p-4 text-center">
                                <i class="fas fa-file-alt text-4xl mb-2 opacity-30"></i>
                            </div>
                        @endif
                        <span class="absolute top-2 left-2 bg-white/90 text-[10px] font-bold text-gray-700 px-2 py-0.5 rounded-full">Expert</span>
                        @if($blog->featured)
                        <span class="absolute top-2 right-2 bg-[#ef4a23] text-white text-[9px] font-bold px-2 py-0.5 rounded-full">⭐</span>
                        @endif
                    </div>
                    <div class="p-4 flex flex-col flex-1">
                        <h4 class="text-sm font-extrabold text-gray-900 mb-1.5 leading-snug line-clamp-2">{{ $blog->title }}</h4>
                        @if($blog->excerpt)
                        <p class="text-xs text-gray-500 mb-3 line-clamp-2 flex-1">{{ $blog->excerpt }}</p>
                        @else
                        <div class="flex-1"></div>
                        @endif
                        <div class="border-t border-gray-50 pt-3 flex items-center justify-between">
                            <span class="text-[10px] text-gray-400"><i class="fas fa-clock mr-1"></i>{{ $blog->read_time }}</span>
                            <span class="text-blue-600 text-sm font-bold group-hover:text-[#ef4a23] transition-colors"><i class="fas fa-arrow-right"></i></span>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
            <div class="text-center mt-8">
                <a href="{{ route('blogs.category', 'expert') }}" class="inline-flex items-center gap-2 bg-[#ef4a23] hover:bg-[#d83a15] text-white px-6 py-3 rounded-xl font-bold text-sm transition-colors shadow-md">
                    View All Expert Tips <i class="fas fa-arrow-right text-xs"></i>
                </a>
            </div>
            @else
            <div class="text-center py-12 bg-white rounded-2xl border border-gray-100 shadow-sm">
                <i class="fas fa-newspaper text-4xl text-gray-200 mb-3 block"></i>
                <p class="text-gray-400 text-sm font-semibold">No expert articles yet.</p>
                <p class="text-gray-300 text-xs mt-1">Add blogs in the <strong>Expert</strong> category from Admin Panel to show them here.</p>
            </div>
            @endif
        </div>

        <!-- DETAILED DESCRIPTION AT BOTTOM -->
        <div class="bg-white rounded-2xl border border-gray-100 p-8 shadow-xs">
            {!! $bottomDescription !!}
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
    </script>
@endsection
