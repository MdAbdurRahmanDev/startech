@extends('layouts.app')

@section('title', $service->title . ' | Our Services')

@section('content')
<div class="container mx-auto px-2 md:px-4 mb-10">
    <!-- Breadcrumb -->
    <div class="py-4 text-[13px] text-gray-500">
        <a href="{{ url('/') }}" class="text-gray-700 hover:text-accent-orange transition-colors"><i class="fas fa-home"></i></a> 
        <span class="mx-1">/</span> <a href="{{ route('services.index') }}" class="text-gray-700 hover:text-accent-orange transition-colors">Services</a>
        <span class="mx-1">/</span> <span class="text-gray-900">{{ $service->title }}</span>
    </div>

    <!-- Hero Section -->
    <div class="bg-primary-dark rounded-2xl p-8 md:p-16 mb-10 text-white relative overflow-hidden flex flex-col md:flex-row items-center gap-10">
        <div class="flex-1 relative z-10">
            <div class="inline-flex items-center gap-2 bg-accent-orange bg-opacity-20 text-accent-orange px-4 py-1.5 rounded-full text-xs font-bold uppercase mb-6 tracking-widest">
                <i class="fas fa-star text-[10px]"></i> Specialized Service
            </div>
            <h1 class="text-3xl md:text-5xl font-bold mb-6 leading-tight">{{ $service->title }}</h1>
            <p class="text-lg text-gray-300 mb-8 leading-relaxed max-w-xl">{{ $service->short_description }}</p>
            <div class="flex flex-wrap gap-4">
                <a href="{{ url('/contact') }}" class="bg-accent-orange text-white px-8 py-3 rounded-lg font-bold hover:bg-opacity-90 transition-all shadow-lg">Get Started</a>
                <a href="#details" class="bg-white bg-opacity-10 text-white px-8 py-3 rounded-lg font-bold hover:bg-opacity-20 transition-all border border-white border-opacity-20">View Details</a>
            </div>
        </div>
        <div class="flex-shrink-0 w-64 h-64 md:w-80 md:h-80 bg-white bg-opacity-5 rounded-3xl flex items-center justify-center relative z-10 shadow-2xl overflow-hidden border border-white border-opacity-10">
            @if($service->image)
                <img src="{{ asset('storage/' . $service->image) }}" alt="{{ $service->title }}" class="w-full h-full object-cover">
            @else
                <i class="{{ $service->icon ?? 'fas fa-tools' }} text-7xl md:text-9xl text-accent-orange opacity-80"></i>
            @endif
        </div>
        
        <!-- Abstract Decorations -->
        <div class="absolute -top-20 -right-20 w-80 h-80 bg-accent-blue opacity-10 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-20 -left-20 w-80 h-80 bg-accent-orange opacity-10 rounded-full blur-3xl"></div>
    </div>

    <!-- Details Content -->
    <div id="details" class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 md:p-12 mb-10">
        <div class="max-w-4xl mx-auto prose prose-lg prose-blue service-content">
            {!! $service->long_description !!}
        </div>
    </div>

    <!-- Call to Action -->
    <div class="bg-accent-blue rounded-2xl p-10 text-center text-white">
        <h3 class="text-2xl md:text-3xl font-bold mb-4">Ready to build something amazing?</h3>
        <p class="text-blue-100 mb-8 max-w-xl mx-auto text-lg">Contact our expert team today to discuss your project requirements and get a customized quote.</p>
        <a href="{{ url('/contact') }}" class="inline-block bg-white text-accent-blue px-10 py-4 rounded-xl font-bold text-lg hover:bg-gray-100 transition-all shadow-xl">Contact Us Now</a>
    </div>
</div>

<style>
    .service-content p { margin-bottom: 1.5rem; line-height: 1.8; color: #4B5563; }
    .service-content h2 { font-size: 1.875rem; font-weight: bold; margin: 2.5rem 0 1.25rem; color: #111827; border-left: 4px solid #ef4a23; padding-left: 1rem; }
    .service-content h3 { font-size: 1.5rem; font-weight: bold; margin: 2rem 0 1rem; color: #1F2937; }
    .service-content ul { list-style: disc; margin-left: 1.5rem; margin-bottom: 1.5rem; }
    .service-content li { margin-bottom: 0.75rem; color: #4B5563; }
</style>
@endsection
