@extends('layouts.app')

@section('title', 'Laptop Finder | IOS BD')

@section('content')
    <style>
        .finder-scroll::-webkit-scrollbar {
            width: 4px;
        }
        .finder-scroll::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 4px;
        }
        .finder-scroll::-webkit-scrollbar-thumb {
            background: #3b4c9b;
            border-radius: 4px;
        }
        .finder-scroll::-webkit-scrollbar-thumb:hover {
            background: #2a3673;
        }
    </style>
    <div class="bg-[#f8f9fa] min-h-[75vh] py-10 relative font-sans">
        <div class="container mx-auto px-4 relative z-10">
            <!-- Breadcrumb -->
            <div class="text-[13px] text-gray-500 mb-8 flex items-center gap-2">
                <a href="{{ url('/') }}" class="hover:text-accent-orange"><i class="fas fa-home"></i></a>
                <span>/</span>
                <span class="text-gray-900">Laptop Finder</span>
            </div>

            <div class="max-w-3xl mx-auto relative mt-4">
                
                <form action="{{ route('products.index') }}" method="GET" id="laptopFinderForm">
                    <input type="hidden" name="is_laptop_finder" value="1">
                    
                    <!-- Step 1: Budget -->
                    <div id="step-1" class="step-container text-center transition-opacity duration-300">
                        <h2 class="text-2xl md:text-3xl text-[#1E2B3C] mb-8 font-normal">
                            What's your <span class="text-[#f15a24] font-bold">budget</span> ?
                        </h2>
                        
                        <!-- Progress Lines -->
                        <div class="flex justify-center gap-2 mb-12">
                            <div class="h-1.5 w-8 rounded-full bg-[#3b4c9b]"></div>
                            <div class="h-1.5 w-8 rounded-full bg-gray-200"></div>
                            <div class="h-1.5 w-8 rounded-full bg-gray-200"></div>
                            <div class="h-1.5 w-8 rounded-full bg-gray-200"></div>
                        </div>

                        <div class="space-y-3 max-w-[32rem] mx-auto max-h-[50vh] overflow-y-auto px-2 finder-scroll pr-4">
                            <input type="hidden" name="min_price" id="min_price_input" value="">
                            @php
                                $budgets = [
                                    ['min' => 30000, 'max' => 40000, 'label' => 'Up to 40,000৳'],
                                    ['min' => 38000, 'max' => 50000, 'label' => 'Up to 50,000৳'],
                                    ['min' => 48000, 'max' => 60000, 'label' => 'Up to 60,000৳'],
                                    ['min' => 58000, 'max' => 80000, 'label' => 'Up to 80,000৳'],
                                    ['min' => 78000, 'max' => 100000, 'label' => 'Up to 100,000৳'],
                                    ['min' => 98000, 'max' => 150000, 'label' => 'Up to 150,000৳'],
                                    ['min' => 148000, 'max' => 200000, 'label' => 'Up to 200,000৳'],
                                    ['min' => 198000, 'max' => 300000, 'label' => 'Up to 300,000৳'],
                                ];
                            @endphp
                            
                            @foreach($budgets as $budget)
                                <label class="cursor-pointer block">
                                    <div class="bg-white rounded-lg p-4 flex items-center gap-4 shadow-[0_2px_8px_rgba(0,0,0,0.04)] border border-transparent hover:border-gray-200 transition-colors">
                                        <input type="radio" name="max_price" value="{{ $budget['max'] }}" data-min="{{ $budget['min'] }}" class="w-4 h-4 text-[#3b4c9b] border-gray-300 focus:ring-[#3b4c9b]" onchange="handleBudgetSelect(this)">
                                        <span class="text-[15px] text-gray-700">{{ $budget['label'] }}</span>
                                    </div>
                                </label>
                            @endforeach
                        </div>

                        <div class="mt-10 max-w-[32rem] mx-auto">
                            <button type="submit" id="submitBtn1" class="w-full bg-[#ef4a23] text-white py-4 rounded font-bold text-[15px] hover:bg-[#d83d1b] transition-colors shadow-md">
                                Show Matched Laptops
                            </button>
                        </div>
                    </div>

                    <!-- Step 2: Purpose -->
                    <div id="step-2" class="step-container text-center hidden transition-opacity duration-300">
                        <h2 class="text-2xl md:text-3xl text-[#1E2B3C] mb-8 font-normal">
                            What is the primary <span class="text-[#f15a24] font-bold">purpose</span> of your laptop?
                        </h2>
                        
                        <!-- Progress Lines -->
                        <div class="flex justify-center gap-2 mb-12">
                            <div class="h-1.5 w-8 rounded-full bg-[#3b4c9b]"></div>
                            <div class="h-1.5 w-8 rounded-full bg-[#3b4c9b]"></div>
                            <div class="h-1.5 w-8 rounded-full bg-gray-200"></div>
                            <div class="h-1.5 w-8 rounded-full bg-gray-200"></div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3 max-w-[32rem] mx-auto max-h-[50vh] overflow-y-auto px-2 finder-scroll pr-4">
                            @foreach($laptopPurposes as $purpose)
                                <label class="cursor-pointer block">
                                    <div class="bg-white rounded-lg p-4 flex items-center gap-4 shadow-[0_2px_8px_rgba(0,0,0,0.04)] border border-transparent hover:border-gray-200 transition-colors">
                                        <input type="radio" name="laptop_purpose_id" value="{{ $purpose->id }}" class="w-4 h-4 text-[#3b4c9b] border-gray-300 focus:ring-[#3b4c9b]" onchange="handlePurposeSelect()">
                                        <span class="text-[15px] text-gray-700">{{ $purpose->name }}</span>
                                    </div>
                                </label>
                            @endforeach
                        </div>

                        <div class="mt-10 max-w-[32rem] mx-auto">
                            <button type="submit" id="submitBtn2" class="w-full bg-[#ef4a23] text-white py-4 rounded font-bold text-[15px] hover:bg-[#d83d1b] transition-colors shadow-md">
                                Show Matched Laptops
                            </button>
                        </div>
                    </div>
                </form>

                <!-- Navigation Controls -->
                <button type="button" onclick="prevStep()" id="prevBtn" class="absolute left-0 md:left-[-120px] top-[40%] bg-white px-4 py-4 rounded-lg shadow-[0_4px_12px_rgba(0,0,0,0.05)] border border-gray-50 hidden flex-col items-center justify-center hover:bg-gray-50 transition-colors text-[#f15a24] font-bold text-[13px] z-20 h-24 w-20">
                    <i class="fas fa-chevron-left text-lg mb-2"></i>
                    Prev
                </button>

                <button type="button" onclick="nextStep()" id="nextBtn" class="absolute right-0 md:right-[-120px] top-[40%] bg-white px-4 py-4 rounded-lg shadow-[0_4px_12px_rgba(0,0,0,0.05)] border border-gray-50 flex flex-col items-center justify-center hover:bg-gray-50 transition-colors text-[#f15a24] font-bold text-[13px] z-20 h-24 w-20">
                    <i class="fas fa-chevron-right text-lg mb-2"></i>
                    Next
                </button>

            </div>
        </div>
    </div>

@section('scripts')
<script>
    let currentStep = 1;

    function handleBudgetSelect(radio) {
        if(radio && radio.dataset.min) {
            document.getElementById('min_price_input').value = radio.dataset.min;
        }
        document.getElementById('submitBtn1').classList.remove('hidden');
    }

    function handlePurposeSelect() {
        document.getElementById('submitBtn2').classList.add('ring-4', 'ring-blue-300');
        setTimeout(() => {
            document.getElementById('submitBtn2').classList.remove('ring-4', 'ring-blue-300');
        }, 300);
    }

    function updateUI() {
        const step1 = document.getElementById('step-1');
        const step2 = document.getElementById('step-2');
        const prevBtn = document.getElementById('prevBtn');
        const nextBtn = document.getElementById('nextBtn');
        
        if (currentStep === 1) {
            step1.classList.remove('hidden');
            setTimeout(() => step1.classList.remove('opacity-0'), 50);
            
            step2.classList.add('hidden', 'opacity-0');
            
            prevBtn.classList.remove('flex');
            prevBtn.classList.add('hidden');
            
            nextBtn.classList.remove('hidden');
            nextBtn.classList.add('flex');
        } else if (currentStep === 2) {
            step1.classList.add('hidden', 'opacity-0');
            
            step2.classList.remove('hidden');
            setTimeout(() => step2.classList.remove('opacity-0'), 50);
            
            prevBtn.classList.remove('hidden');
            prevBtn.classList.add('flex');
            
            nextBtn.classList.remove('flex');
            nextBtn.classList.add('hidden');
        }
    }

    function nextStep() {
        currentStep = 2;
        updateUI();
    }

    function prevStep() {
        currentStep = 1;
        updateUI();
    }
</script>
@endsection
@endsection
