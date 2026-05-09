@extends('layouts.app')

@section('title', 'Our Services | Star Tech')

@section('content')
<div class="container mx-auto px-2 md:px-4 mb-10">
    <!-- Breadcrumb -->
    <div class="py-4 text-[13px] text-gray-500">
        <a href="{{ url('/') }}" class="text-gray-700 hover:text-accent-orange transition-colors"><i class="fas fa-home"></i></a> 
        <span class="mx-1">/</span> <span class="text-gray-900">Services</span>
    </div>

    <!-- Page Header -->
    <div class="text-center mb-12">
        <h1 class="text-3xl md:text-4xl font-bold text-primary-dark mb-4">Web & App Development Services</h1>
        <p class="text-gray-600 max-w-2xl mx-auto">We provide premium digital solutions to help your business grow. Explore our specialized services below.</p>
    </div>

    <!-- Services Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @forelse($services as $service)
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden flex flex-col hover:shadow-xl transition-all duration-300 group">
                <!-- Service Banner -->
                <a href="{{ route('services.show', $service->slug) }}" class="block relative aspect-[4/3] overflow-hidden bg-neutral-primary-soft">
                    @if($service->image)
                        <img src="{{ asset('storage/' . $service->image) }}" alt="{{ $service->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    @else
                        <div class="w-full h-full flex items-center justify-center">
                            <i class="{{ $service->icon ?? 'fas fa-tools' }} text-7xl text-accent-blue opacity-20"></i>
                        </div>
                    @endif
                    <div class="absolute top-4 right-4 bg-accent-orange text-white text-[10px] font-bold px-3 py-1 rounded-full z-10 shadow-sm uppercase tracking-wider">
                        Premium Service
                    </div>
                </a>

                <!-- Service Info -->
                <div class="p-6 flex flex-col flex-grow">
                    <div class="flex items-center gap-2 text-[12px] text-gray-500 mb-4 pb-4 border-b border-gray-50">
                        <i class="fas fa-check-circle text-accent-orange"></i>
                        <span class="font-bold uppercase tracking-wide">Professional Solution</span>
                    </div>

                    <h2 class="text-[20px] font-bold text-primary-dark mb-3 group-hover:text-accent-blue transition-colors line-clamp-2 min-h-[60px]">{{ $service->title }}</h2>
                    <p class="text-[13px] text-gray-600 mb-6 line-clamp-2 leading-relaxed">{{ $service->short_description }}</p>

                    <!-- Action -->
                    <div class="mt-auto">
                        <a href="{{ route('services.show', $service->slug) }}" class="inline-block bg-accent-blue text-white px-8 py-2.5 rounded-lg font-bold text-sm hover:bg-opacity-90 transition-all shadow-md">
                            View Details
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full py-20 text-center bg-white rounded-xl border border-gray-100">
                <i class="fas fa-tools text-5xl text-gray-200 mb-4"></i>
                <h3 class="text-xl font-bold text-gray-800">Coming Soon</h3>
                <p class="text-gray-500">We are preparing exciting new services for you. Stay tuned!</p>
            </div>
        @endforelse
    </div>
</div>
@endsection
