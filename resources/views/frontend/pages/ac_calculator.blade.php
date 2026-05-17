@extends('layouts.app')

@section('title', 'AC BTU Calculator')

@section('content')
<div class="py-12 max-w-2xl mx-auto px-4">
    <!-- Breadcrumb -->
    <nav class="flex mb-6 text-sm text-gray-500" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-3">
            <li class="inline-flex items-center">
                <a href="{{ url('/') }}" class="hover:text-accent-orange inline-flex items-center transition-colors">
                    <i class="fas fa-home mr-2 text-xs"></i>Home
                </a>
            </li>
            <li aria-current="page">
                <div class="flex items-center">
                    <i class="fas fa-chevron-right text-[10px] mx-2 text-gray-400"></i>
                    <span class="text-gray-800 font-medium">AC BTU Calculator</span>
                </div>
            </li>
        </ol>
    </nav>

    <!-- Calculator Card -->
    <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden transition-all duration-300">
        <!-- Card Header with Dynamic and Visual Design -->
        <div class="bg-gradient-to-br from-[#1a2b3c] via-[#243b55] to-[#1a2b3c] px-8 py-8 text-center text-white relative overflow-hidden">
            <!-- Decorative Light Effects -->
            <div class="absolute -top-24 -left-24 w-48 h-48 bg-accent-orange/10 rounded-full blur-3xl pointer-events-none"></div>
            <div class="absolute -bottom-24 -right-24 w-48 h-48 bg-accent-orange/20 rounded-full blur-3xl pointer-events-none"></div>
            
            <!-- Icon Badge -->
            <div class="inline-flex items-center justify-center w-12 h-12 bg-white/10 rounded-xl mb-3 backdrop-blur-md border border-white/20">
                <i class="fas fa-calculator text-accent-orange text-xl"></i>
            </div>
            
            <h1 class="text-2xl md:text-3xl font-extrabold tracking-tight text-white">AC BTU Calculator</h1>
            
            <!-- Beautiful customized Subtitle -->
            <div class="mt-3 flex justify-center">
                <span class="inline-flex items-center gap-1.5 px-4 py-1.5 rounded-full text-xs font-semibold bg-accent-orange/20 text-accent-orange border border-accent-orange/30 backdrop-blur-sm animate-pulse">
                    <i class="fas fa-snowflake text-[10px]"></i>
                    Find the perfect AC capacity for your room instantly
                </span>
            </div>
        </div>

        <div class="p-8">
            <!-- Warning Box -->
            <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded-r-xl mb-8 flex items-start gap-3">
                <i class="fas fa-exclamation-circle text-red-500 text-lg mt-0.5"></i>
                <p class="text-red-700 text-xs md:text-sm font-semibold leading-relaxed">
                    The calculated results are approximate guidelines for selecting residential air conditioners only.
                </p>
            </div>

            <!-- Form Container -->
            <div id="calculator-form-wrapper" class="transition-all duration-500 ease-in-out">
                <form id="btu-calculator-form" class="space-y-6">
                    <!-- Room Size -->
                    <div>
                        <label class="block text-sm font-bold text-gray-800 mb-2 flex items-center gap-2">
                            <i class="fas fa-expand-arrows-alt text-accent-orange text-xs"></i>
                            Room Size <span class="text-red-500">*</span>
                        </label>
                        <select name="room_size" required class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm text-gray-700 focus:outline-none focus:border-accent-orange focus:bg-white transition-all cursor-pointer">
                            <option value="90">0-90 Square Feet</option>
                            <option value="150">91-150 Square Feet</option>
                            <option value="250">151-250 Square Feet</option>
                            <option value="400">251-400 Square Feet</option>
                            <option value="600">401-600 Square Feet</option>
                            <option value="800">601-800 Square Feet</option>
                            <option value="1000">801+ Square Feet</option>
                        </select>
                    </div>

                    <!-- Wall Type -->
                    <div>
                        <label class="block text-sm font-bold text-gray-800 mb-2 flex items-center gap-2">
                            <i class="fas fa-border-all text-accent-orange text-xs"></i>
                            Wall Type <span class="text-red-500">*</span>
                        </label>
                        <select name="wall_type" required class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm text-gray-700 focus:outline-none focus:border-accent-orange focus:bg-white transition-all cursor-pointer">
                            <option value="facebrick">Facebrick</option>
                            <option value="concrete">Concrete / Plaster</option>
                            <option value="insulated">Insulated Cavity</option>
                        </select>
                    </div>

                    <!-- Sunlight Exposed Wall -->
                    <div>
                        <label class="block text-sm font-bold text-gray-800 mb-3 flex items-center gap-2">
                            <i class="fas fa-cloud-sun text-accent-orange text-xs"></i>
                            Sunlight Exposed Wall <span class="text-red-500">*</span>
                        </label>
                        <div class="flex flex-wrap gap-4 items-center">
                            <label class="flex items-center gap-2 text-sm text-gray-700 cursor-pointer">
                                <input type="radio" name="sunlight_walls" value="0" checked class="w-4 h-4 text-accent-orange focus:ring-accent-orange border-gray-300">
                                <span>None</span>
                            </label>
                            <label class="flex items-center gap-2 text-sm text-gray-700 cursor-pointer">
                                <input type="radio" name="sunlight_walls" value="1" class="w-4 h-4 text-accent-orange focus:ring-accent-orange border-gray-300">
                                <span>1</span>
                            </label>
                            <label class="flex items-center gap-2 text-sm text-gray-700 cursor-pointer">
                                <input type="radio" name="sunlight_walls" value="2" class="w-4 h-4 text-accent-orange focus:ring-accent-orange border-gray-300">
                                <span>2</span>
                            </label>
                            <label class="flex items-center gap-2 text-sm text-gray-700 cursor-pointer">
                                <input type="radio" name="sunlight_walls" value="3" class="w-4 h-4 text-accent-orange focus:ring-accent-orange border-gray-300">
                                <span>3</span>
                            </label>
                            <label class="flex items-center gap-2 text-sm text-gray-700 cursor-pointer">
                                <input type="radio" name="sunlight_walls" value="4" class="w-4 h-4 text-accent-orange focus:ring-accent-orange border-gray-300">
                                <span>4</span>
                            </label>
                        </div>
                    </div>

                    <!-- Room Position -->
                    <div>
                        <label class="block text-sm font-bold text-gray-800 mb-3 flex items-center gap-2">
                            <i class="fas fa-building text-accent-orange text-xs"></i>
                            Room Position <span class="text-red-500">*</span>
                        </label>
                        <div class="flex gap-6 items-center">
                            <label class="flex items-center gap-2 text-sm text-gray-700 cursor-pointer">
                                <input type="radio" name="room_position" value="other" checked class="w-4 h-4 text-accent-orange focus:ring-accent-orange border-gray-300">
                                <span>Other Floor</span>
                            </label>
                            <label class="flex items-center gap-2 text-sm text-gray-700 cursor-pointer">
                                <input type="radio" name="room_position" value="top" class="w-4 h-4 text-accent-orange focus:ring-accent-orange border-gray-300">
                                <span>Top Floor</span>
                            </label>
                        </div>
                    </div>

                    <!-- Number of Window -->
                    <div>
                        <label class="block text-sm font-bold text-gray-800 mb-3 flex items-center gap-2">
                            <i class="fas fa-window-maximize text-accent-orange text-xs"></i>
                            Number of Window <span class="text-red-500">*</span>
                        </label>
                        <div class="flex flex-wrap gap-5 items-center">
                            <label class="flex items-center gap-2 text-sm text-gray-700 cursor-pointer">
                                <input type="radio" name="windows" value="1" checked class="w-4 h-4 text-accent-orange focus:ring-accent-orange border-gray-300">
                                <span>1</span>
                            </label>
                            <label class="flex items-center gap-2 text-sm text-gray-700 cursor-pointer">
                                <input type="radio" name="windows" value="2" class="w-4 h-4 text-accent-orange focus:ring-accent-orange border-gray-300">
                                <span>2</span>
                            </label>
                            <label class="flex items-center gap-2 text-sm text-gray-700 cursor-pointer">
                                <input type="radio" name="windows" value="3" class="w-4 h-4 text-accent-orange focus:ring-accent-orange border-gray-300">
                                <span>3</span>
                            </label>
                            <label class="flex items-center gap-2 text-sm text-gray-700 cursor-pointer">
                                <input type="radio" name="windows" value="4" class="w-4 h-4 text-accent-orange focus:ring-accent-orange border-gray-300">
                                <span>4</span>
                            </label>
                        </div>
                    </div>

                    <!-- Number of Door -->
                    <div>
                        <label class="block text-sm font-bold text-gray-800 mb-3 flex items-center gap-2">
                            <i class="fas fa-door-open text-accent-orange text-xs"></i>
                            Number of Door <span class="text-red-500">*</span>
                        </label>
                        <div class="flex gap-6 items-center">
                            <label class="flex items-center gap-2 text-sm text-gray-700 cursor-pointer">
                                <input type="radio" name="doors" value="1" checked class="w-4 h-4 text-accent-orange focus:ring-accent-orange border-gray-300">
                                <span>One</span>
                            </label>
                            <label class="flex items-center gap-2 text-sm text-gray-700 cursor-pointer">
                                <input type="radio" name="doors" value="2" class="w-4 h-4 text-accent-orange focus:ring-accent-orange border-gray-300">
                                <span>Two</span>
                            </label>
                        </div>
                    </div>

                    <!-- Number of People -->
                    <div>
                        <label class="block text-sm font-bold text-gray-800 mb-3 flex items-center gap-2">
                            <i class="fas fa-users text-accent-orange text-xs"></i>
                            Number of People <span class="text-red-500">*</span>
                        </label>
                        <div class="flex flex-wrap gap-5 items-center">
                            <label class="flex items-center gap-2 text-sm text-gray-700 cursor-pointer">
                                <input type="radio" name="people" value="1" class="w-4 h-4 text-accent-orange focus:ring-accent-orange border-gray-300">
                                <span>1</span>
                            </label>
                            <label class="flex items-center gap-2 text-sm text-gray-700 cursor-pointer">
                                <input type="radio" name="people" value="2" checked class="w-4 h-4 text-accent-orange focus:ring-accent-orange border-gray-300">
                                <span>2</span>
                            </label>
                            <label class="flex items-center gap-2 text-sm text-gray-700 cursor-pointer">
                                <input type="radio" name="people" value="3" class="w-4 h-4 text-accent-orange focus:ring-accent-orange border-gray-300">
                                <span>3</span>
                            </label>
                            <label class="flex items-center gap-2 text-sm text-gray-700 cursor-pointer">
                                <input type="radio" name="people" value="4" class="w-4 h-4 text-accent-orange focus:ring-accent-orange border-gray-300">
                                <span>4</span>
                            </label>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="w-full bg-accent-orange text-white font-bold py-3.5 px-6 rounded-xl hover:bg-[#d83d1b] transition-all shadow-lg shadow-orange-500/20 text-center flex items-center justify-center gap-2 text-sm">
                        Calculate
                    </button>
                </form>
            </div>

            <!-- Result Container (Hidden by default) -->
            <div id="calculator-result-wrapper" class="hidden opacity-0 transform translate-y-4 transition-all duration-500 ease-in-out text-center py-6">
                <div class="w-20 h-20 bg-orange-50 text-accent-orange rounded-full flex items-center justify-center mx-auto mb-6 shadow-inner">
                    <i class="fas fa-snowflake text-4xl animate-spin-slow"></i>
                </div>

                <h3 class="text-xl font-bold text-gray-800 mb-2">Calculation Result</h3>
                <p class="text-gray-500 text-sm mb-6">Based on your input, here is the recommended air conditioner capacity.</p>

                <!-- Recommendation Badge -->
                <div class="bg-orange-50 border border-orange-200 rounded-2xl py-6 px-8 max-w-md mx-auto mb-8">
                    <span class="text-gray-600 text-sm block mb-1 font-medium">Recommended AC Capacity</span>
                    <span id="recommended-capacity-text" class="text-2xl md:text-3xl font-extrabold text-accent-orange tracking-tight">
                        0.5 Ton
                    </span>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 justify-center max-w-md mx-auto">
                    <button onclick="resetCalculator()" class="flex-1 bg-gray-100 text-gray-700 font-bold py-3 px-6 rounded-xl hover:bg-gray-200 transition-all flex items-center justify-center gap-2 text-sm">
                        <i class="fas fa-redo"></i> Recalculate
                    </button>
                    <a id="shop-ac-btn" href="{{ url('/category/ac') }}" class="flex-1 bg-accent-orange text-white font-bold py-3 px-6 rounded-xl hover:bg-[#d83d1b] transition-all shadow-lg shadow-orange-500/25 flex items-center justify-center gap-2 text-sm">
                        <i class="fas fa-shopping-bag"></i> Shop ACs
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .animate-spin-slow {
        animation: spin 8s linear infinite;
    }
    @keyframes spin {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }
</style>
@endsection

@section('scripts')
<script>
    document.getElementById('btu-calculator-form').addEventListener('submit', function(e) {
        e.preventDefault();

        // 1. Get Values
        const roomSize = parseInt(this.room_size.value);
        const wallType = this.wall_type.value;
        const sunlightWalls = parseInt(this.querySelector('input[name="sunlight_walls"]:checked').value);
        const roomPosition = this.querySelector('input[name="room_position"]:checked').value;
        const windows = parseInt(this.querySelector('input[name="windows"]:checked').value);
        const doors = parseInt(this.querySelector('input[name="doors"]:checked').value);
        const people = parseInt(this.querySelector('input[name="people"]:checked').value);

        // 2. Base BTU Calculation based on Room Size
        let baseBtu = 6000;
        if (roomSize <= 90) baseBtu = 6000;
        else if (roomSize <= 150) baseBtu = 9000;
        else if (roomSize <= 250) baseBtu = 12000;
        else if (roomSize <= 400) baseBtu = 18000;
        else if (roomSize <= 600) baseBtu = 24000;
        else if (roomSize <= 800) baseBtu = 30000;
        else baseBtu = 36000;

        // 3. Multipliers & Additions
        let calculatedBtu = baseBtu;

        // Wall type
        if (wallType === 'facebrick') {
            calculatedBtu += 500;
        } else if (wallType === 'insulated') {
            calculatedBtu -= 500;
        }

        // Sunlight Exposed Wall (+10% for each wall)
        if (sunlightWalls > 0) {
            calculatedBtu += baseBtu * (sunlightWalls * 0.1);
        }

        // Room Position Top Floor (+15%)
        if (roomPosition === 'top') {
            calculatedBtu += baseBtu * 0.15;
        }

        // Windows (+500 BTU per window)
        calculatedBtu += (windows * 500);

        // Doors (+500 BTU per door)
        calculatedBtu += (doors * 500);

        // People (+600 BTU per person above 2)
        if (people > 2) {
            calculatedBtu += ((people - 2) * 600);
        }

        // 4. Map BTU to Ton Rating
        let recommendation = "0.5 Ton";
        if (calculatedBtu < 8500) recommendation = "0.5 Ton";
        else if (calculatedBtu < 11500) recommendation = "0.75 Ton";
        else if (calculatedBtu < 15500) recommendation = "1.0 Ton";
        else if (calculatedBtu < 21500) recommendation = "1.5 Ton";
        else if (calculatedBtu < 27500) recommendation = "2.0 Ton";
        else if (calculatedBtu < 33500) recommendation = "2.5 Ton";
        else recommendation = "3.0 Ton";

        // 5. Update Recommendation Link dynamically based on Recommended Ton
        const shopAcBtn = document.getElementById('shop-ac-btn');
        let searchQuery = "";
        if (recommendation.includes("0.5")) searchQuery = "?q=0.5+ton+ac";
        else if (recommendation.includes("0.75")) searchQuery = "?q=0.75+ton+ac";
        else if (recommendation.includes("1.0")) searchQuery = "?q=1+ton+ac";
        else if (recommendation.includes("1.5")) searchQuery = "?q=1.5+ton+ac";
        else if (recommendation.includes("2.0")) searchQuery = "?q=2+ton+ac";
        else if (recommendation.includes("2.5")) searchQuery = "?q=2.5+ton+ac";
        else if (recommendation.includes("3.0")) searchQuery = "?q=3+ton+ac";

        shopAcBtn.href = "{{ url('search') }}" + searchQuery;

        // 6. Smooth Animation Transition
        const formWrapper = document.getElementById('calculator-form-wrapper');
        const resultWrapper = document.getElementById('calculator-result-wrapper');
        const recommendedText = document.getElementById('recommended-capacity-text');

        // Fade out form
        formWrapper.style.opacity = '0';
        formWrapper.style.transform = 'translateY(-10px)';

        setTimeout(() => {
            formWrapper.classList.add('hidden');
            
            // Set values
            recommendedText.innerText = "Recommended AC Capacity : " + recommendation;
            
            // Fade in result
            resultWrapper.classList.remove('hidden');
            setTimeout(() => {
                resultWrapper.style.opacity = '1';
                resultWrapper.style.transform = 'translateY(0)';
            }, 50);
        }, 300);
    });

    function resetCalculator() {
        const formWrapper = document.getElementById('calculator-form-wrapper');
        const resultWrapper = document.getElementById('calculator-result-wrapper');

        // Fade out result
        resultWrapper.style.opacity = '0';
        resultWrapper.style.transform = 'translateY(10px)';

        setTimeout(() => {
            resultWrapper.classList.add('hidden');
            
            // Fade in form
            formWrapper.classList.remove('hidden');
            setTimeout(() => {
                formWrapper.style.opacity = '1';
                formWrapper.style.transform = 'translateY(0)';
            }, 50);
        }, 300);
    }
</script>
@endsection
