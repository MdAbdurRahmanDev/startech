@extends('layouts.app')

@section('title', 'Our Sales Outlets')

@section('content')
<div class="py-8 md:py-12">
    <div class="container mx-auto px-4">
        <!-- Contact Header Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex items-center gap-5 hover:shadow-md transition-shadow">
                <div class="w-12 h-12 bg-blue-50 rounded-full flex items-center justify-center text-blue-600 text-xl">
                    <i class="fas fa-phone-alt"></i>
                </div>
                <div>
                    <p class="text-xs text-gray-500 font-bold uppercase tracking-wider">Contact Us</p>
                    <h4 class="text-lg font-black text-primary-dark">{{ $setting->phone_number ?? '16793 / 09678002003' }}</h4>
                </div>
            </div>
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex items-center gap-5 hover:shadow-md transition-shadow">
                <div class="w-12 h-12 bg-orange-50 rounded-full flex items-center justify-center text-accent-orange text-xl">
                    <i class="fas fa-comment-dots"></i>
                </div>
                <div class="flex-grow">
                    <p class="text-xs text-gray-500 font-bold uppercase tracking-wider">Share Your Experience</p>
                    <h4 class="text-lg font-black text-primary-dark">Any Complain On Us?</h4>
                </div>
                <a href="{{ route('contact') }}" class="text-accent-orange hover:translate-x-1 transition-transform">
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex items-center gap-5 hover:shadow-md transition-shadow">
                <div class="w-12 h-12 bg-green-50 rounded-full flex items-center justify-center text-green-600 text-xl">
                    <i class="fas fa-headset"></i>
                </div>
                <div class="flex-grow">
                    <p class="text-xs text-gray-500 font-bold uppercase tracking-wider">Talk to Experts</p>
                    <h4 class="text-lg font-black text-primary-dark">Get Online Support</h4>
                </div>
                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $setting->whatsapp_number) }}?text={{ urlencode('Hello Sir, I would like to inquire about your products and services. Page: ' . url()->current()) }}" class="text-green-600 hover:translate-x-1 transition-transform">
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>

        <!-- Section Title & Search -->
        <div class="flex flex-col md:flex-row justify-between items-center mb-8 gap-6">
            <h2 class="text-2xl md:text-3xl font-black text-primary-dark relative">
                Our Sales Outlet
                <span class="absolute -bottom-2 left-0 w-12 h-1 bg-accent-orange rounded-full"></span>
            </h2>
            <div class="relative w-full md:w-96">
                <input type="text" id="outletSearch" placeholder="What's Your City?" 
                       class="w-full bg-white border border-gray-200 rounded-full px-6 py-3 focus:outline-none focus:ring-2 focus:ring-accent-orange/20 shadow-sm">
                <button class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-accent-orange">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>

        <!-- Outlets Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
            @forelse($outlets as $outlet)
            <div class="outlet-card bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-xl transition-all duration-300 flex flex-col group" data-name="{{ strtolower($outlet->name) }}" data-address="{{ strtolower($outlet->address) }}">
                <div class="p-6 md:p-8 flex-grow">
                    <h3 class="text-lg font-black text-primary-dark group-hover:text-accent-orange transition-colors mb-6">{{ $outlet->name }}</h3>
                    
                    <div class="space-y-6">
                        {{-- Address --}}
                        <div class="flex gap-4">
                            <div class="mt-1 text-accent-orange">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <div>
                                <p class="text-[11px] font-bold text-gray-400 uppercase tracking-widest mb-1">Address</p>
                                <p class="text-sm text-gray-600 leading-relaxed font-medium">{{ $outlet->address }}</p>
                            </div>
                        </div>

                        {{-- Phone Numbers --}}
                        <div class="flex gap-4">
                            <div class="mt-1 text-accent-orange">
                                <i class="fas fa-phone-alt"></i>
                            </div>
                            <div class="flex-grow">
                                <p class="text-[11px] font-bold text-gray-400 uppercase tracking-widest mb-3">Phone</p>
                                <div class="grid grid-cols-2 gap-x-4 gap-y-4">
                                    @if($outlet->phones)
                                        @foreach($outlet->phones as $key => $value)
                                            @if($value)
                                            <div>
                                                <p class="text-[10px] text-gray-400 font-bold mb-0.5">{{ ucfirst(str_replace('_', ' ', $key)) }}</p>
                                                <p class="text-[13px] font-black text-primary-dark">{{ $value }}</p>
                                            </div>
                                            @endif
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>

                        {{-- Timing & Off Day --}}
                        <div class="flex items-center justify-between pt-6 border-t border-gray-50">
                            <div>
                                <p class="text-sm font-black text-accent-orange">{{ $outlet->timing }}</p>
                                <p class="text-xs text-gray-400 font-bold mt-0.5">{{ $outlet->off_day }}</p>
                            </div>
                            @if($outlet->map_link)
                            <a href="{{ $outlet->map_link }}" target="_blank" class="flex items-center gap-2 text-xs font-bold text-gray-400 hover:text-accent-orange border border-gray-100 px-4 py-2 rounded-lg hover:border-accent-orange/20 transition-all">
                                Get Direction
                                <i class="fas fa-external-link-alt text-[10px]"></i>
                            </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-full py-20 text-center">
                <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center text-gray-400 text-3xl mx-auto mb-4">
                    <i class="fas fa-store-slash"></i>
                </div>
                <h3 class="text-xl font-bold text-primary-dark">No outlets found</h3>
                <p class="text-gray-500 mt-2">We are coming soon to your city!</p>
            </div>
            @endforelse
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.getElementById('outletSearch').addEventListener('input', function(e) {
        const term = e.target.value.toLowerCase();
        const cards = document.querySelectorAll('.outlet-card');
        
        cards.forEach(card => {
            const name = card.getAttribute('data-name');
            const address = card.getAttribute('data-address');
            
            if (name.includes(term) || address.includes(term)) {
                card.classList.remove('hidden');
            } else {
                card.classList.add('hidden');
            }
        });
    });
</script>
@endpush
@endsection
