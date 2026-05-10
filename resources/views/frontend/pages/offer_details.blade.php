@extends('layouts.app')

@section('title', $offer->title . ' | Iosbd')

@section('content')
    <div class="container mx-auto px-2 md:px-4 mb-10">
        <!-- Breadcrumb -->
        <div class="py-4 text-[13px] text-gray-500">
            <a href="{{ url('/') }}" class="text-gray-700 hover:text-accent-orange transition-colors"><i
                    class="fas fa-home"></i></a>
            <span class="mx-1">/</span> <a href="{{ route('offers.index') }}"
                class="text-gray-700 hover:text-accent-orange transition-colors">Offer</a>
            <span class="mx-1">/</span> <span class="text-gray-900">{{ $offer->title }}</span>
        </div>

        <!-- Main Content Area -->
        <div class="max-w-4xl mx-auto bg-white rounded-lg shadow-sm border border-gray-50 overflow-hidden">
            <!-- Details Header -->
            <div class="p-6 border-b border-gray-50 flex flex-col md:flex-row justify-between items-center gap-4">
                <div class="flex items-center gap-3">
                    <a href="{{ route('offers.index') }}"
                        class="text-primary-dark hover:text-accent-orange transition-colors text-xl">
                        <i class="fas fa-arrow-left"></i>
                    </a>
                    <h1 class="text-xl font-bold text-primary-dark">Offer Details</h1>
                </div>

                <!-- Countdown Timer -->
                <div class="flex items-center gap-3" id="countdown-timer">
                    <span class="text-[11px] font-bold text-gray-500 uppercase tracking-wider">Offer Ends In:</span>
                    <div class="flex gap-1.5">
                        <div
                            class="bg-accent-orange text-white w-10 h-12 rounded flex flex-col items-center justify-center shadow-sm">
                            <span id="days" class="text-[16px] font-bold leading-none">00</span>
                            <span class="text-[8px] uppercase font-bold">Days</span>
                        </div>
                        <div
                            class="bg-accent-orange text-white w-10 h-12 rounded flex flex-col items-center justify-center shadow-sm">
                            <span id="hours" class="text-[16px] font-bold leading-none">00</span>
                            <span class="text-[8px] uppercase font-bold">Hours</span>
                        </div>
                        <div
                            class="bg-accent-orange text-white w-10 h-12 rounded flex flex-col items-center justify-center shadow-sm">
                            <span id="minutes" class="text-[16px] font-bold leading-none">00</span>
                            <span class="text-[8px] uppercase font-bold">Mins</span>
                        </div>
                        <div
                            class="bg-accent-orange text-white w-10 h-12 rounded flex flex-col items-center justify-center shadow-sm">
                            <span id="seconds" class="text-[16px] font-bold leading-none">00</span>
                            <span class="text-[8px] uppercase font-bold">Secs</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Banner Image -->
            <div class="w-full">
                <img src="{{ asset('storage/' . $offer->image) }}" alt="{{ $offer->title }}" class="w-full h-auto">
            </div>

            <!-- Content Info -->
            <div class="p-6 md:p-8">
                <h2 class="text-2xl md:text-3xl font-bold text-primary-dark mb-4">{{ $offer->title }}</h2>

                <div class="flex flex-wrap items-center gap-6 mb-8 py-4 border-y border-gray-50 text-sm text-gray-600">
                    <div class="flex items-center gap-2">
                        <i class="far fa-calendar-alt text-accent-orange text-lg"></i>
                        <span class="font-bold">{{ $offer->start_date->format('d M Y') }} -
                            {{ $offer->end_date->format('d M Y') }}</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <i class="fas fa-store text-accent-orange text-lg"></i>
                        <span class="font-bold uppercase">{{ $offer->type }}</span>
                    </div>
                </div>

                <div class="prose prose-sm max-w-none text-gray-700 leading-relaxed offer-content">
                    {!! $offer->long_description !!}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        // Countdown Logic
        const endDate = new Date("{{ $offer->end_date->format('Y-m-d') }} 23:59:59").getTime();

        const x = setInterval(function() {
            const now = new Date().getTime();
            const distance = endDate - now;

            const days = Math.floor(distance / (1000 * 60 * 60 * 24));
            const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);

            document.getElementById("days").innerHTML = days < 10 ? '0' + days : days;
            document.getElementById("hours").innerHTML = hours < 10 ? '0' + hours : hours;
            document.getElementById("minutes").innerHTML = minutes < 10 ? '0' + minutes : minutes;
            document.getElementById("seconds").innerHTML = seconds < 10 ? '0' + seconds : seconds;

            if (distance < 0) {
                clearInterval(x);
                document.getElementById("countdown-timer").innerHTML =
                    "<span class='text-red-500 font-bold'>OFFER EXPIRED</span>";
            }
        }, 1000);
    </script>
    <style>
        .offer-content p {
            margin-bottom: 1.5rem;
        }

        .offer-content h2 {
            font-size: 1.5rem;
            font-weight: bold;
            margin: 2rem 0 1rem;
            color: #374151;
        }

        .offer-content ul {
            list-style: disc;
            margin-left: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .offer-content li {
            margin-bottom: 0.5rem;
        }
    </style>
@endsection
