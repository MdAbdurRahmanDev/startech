@extends('layouts.app')

@section('title', 'Promotional Offers | IOS BD')

@section('content')
    <div class="container mx-auto px-2 md:px-4 mb-10">
        <!-- Breadcrumb -->
        <div class="py-4 text-[13px] text-gray-500">
            <a href="{{ url('/') }}" class="text-gray-700 hover:text-accent-orange transition-colors"><i
                    class="fas fa-home"></i></a>
            <span class="mx-1">/</span> <span class="text-gray-900">Offer</span>
        </div>

        <!-- Offers Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($offers as $offer)
                <div
                    class="bg-white rounded-lg shadow-sm overflow-hidden border border-gray-100 flex flex-col hover:shadow-xl transition-shadow duration-300">
                    <!-- Offer Image -->
                    <a href="{{ route('offers.show', $offer->slug) }}" class="block relative aspect-[4/3] overflow-hidden">
                        <img src="{{ asset('storage/' . $offer->image) }}" alt="{{ $offer->title }}"
                            class="w-full h-full object-cover hover:scale-105 transition-transform duration-500">
                    </a>

                    <!-- Offer Info -->
                    <div class="p-5 flex flex-col flex-grow">
                        <!-- Meta Info -->
                        <div
                            class="flex items-center justify-between text-[12px] text-gray-500 mb-4 pb-4 border-b border-gray-50">
                            <div class="flex items-center gap-1.5">
                                <i class="far fa-calendar-alt text-accent-orange"></i>
                                <span>{{ $offer->start_date->format('d M Y') }} -
                                    {{ $offer->end_date->format('d M Y') }}</span>
                            </div>
                            <div class="flex items-center gap-1.5 font-bold uppercase">
                                <i class="fas fa-store text-accent-orange"></i>
                                <span>{{ $offer->type }}</span>
                            </div>
                        </div>

                        <!-- Title & Description -->
                        <h2 class="text-[18px] font-bold text-primary-dark mb-3 line-clamp-2 min-h-[54px]">
                            {{ $offer->title }}</h2>
                        <p class="text-[13px] text-gray-600 mb-6 line-clamp-2 leading-relaxed">
                            {{ $offer->short_description }}</p>

                        <!-- Action Button -->
                        <div class="mt-auto">
                            <a href="{{ route('offers.show', $offer->slug) }}"
                                class="inline-block bg-accent-blue text-white px-8 py-2.5 rounded font-bold text-sm hover:bg-opacity-90 transition-all">
                                View Details
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-20 text-center bg-white rounded-lg border border-gray-100 shadow-sm">
                    <i class="fas fa-gift text-5xl text-gray-200 mb-4"></i>
                    <h3 class="text-xl text-gray-800 font-bold mb-2">No Active Offers Available</h3>
                    <p class="text-gray-500">Stay tuned! We'll have exciting deals for you soon.</p>
                    <a href="{{ url('/') }}"
                        class="inline-block mt-6 bg-accent-blue text-white px-8 py-2.5 rounded font-bold hover:bg-opacity-90">Back
                        to Home</a>
                </div>
            @endforelse
        </div>
    </div>
@endsection
