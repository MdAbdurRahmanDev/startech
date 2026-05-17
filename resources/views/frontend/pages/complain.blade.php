@extends('layouts.app')

@section('title', 'Complain & Feedback | IOS BD')

@section('content')
    <div class="container mx-auto px-4 py-12 mb-10 flex justify-center">
        <!-- Main Form Card -->
        <div class="bg-white w-full max-w-3xl rounded-3xl shadow-xl border border-gray-100 p-8 md:p-14 animate-fade-in">
            
            <!-- Header Section -->
            <div class="text-center mb-8">
                <h1 class="text-3xl md:text-4xl font-extrabold tracking-tight complain-text-color">Complain & Feedback</h1>
                <p class="text-gray-500 text-sm md:text-base mt-3">Please fill out the following form with details</p>
                <p class="text-gray-500 text-sm md:text-base">We will review your request and follow up with you as soon as possible.</p>
                <hr class="mt-8 border-gray-200">
            </div>

            <!-- Success/Error Alerts -->
            @if (session('success'))
                <div class="p-4 mb-6 text-sm text-green-800 rounded-xl bg-green-50 border border-green-100 shadow-sm flex items-center gap-2" role="alert">
                    <i class="fas fa-check-circle text-green-600 text-base"></i>
                    <span class="font-medium">{{ session('success') }}</span>
                </div>
            @endif

            @if ($errors->any())
                <div class="p-4 mb-6 text-sm text-red-800 rounded-xl bg-red-50 border border-red-100 shadow-sm" role="alert">
                    <ul class="list-disc pl-5 space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Form -->
            <form action="{{ route('complain.store') }}" method="POST" class="space-y-8 mt-6">
                @csrf
                <input type="hidden" name="is_complain" value="1">

                <!-- Row 1: Full Name & Phone No. -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="relative">
                        <label class="block text-sm font-bold text-gray-800 mb-1">Full Name<span class="text-red-500 ml-0.5">*</span></label>
                        <input type="text" name="name" required value="{{ old('name') }}" placeholder="Type Your Full Name."
                            class="w-full bg-transparent border-b border-gray-300 py-2 outline-none transition-colors placeholder-gray-300 text-gray-800 complain-input">
                    </div>
                    <div class="relative">
                        <label class="block text-sm font-bold text-gray-800 mb-1">Phone No.<span class="text-red-500 ml-0.5">*</span></label>
                        <input type="text" name="phone" required value="{{ old('phone') }}" placeholder="Type Your Mobile No."
                            class="w-full bg-transparent border-b border-gray-300 py-2 outline-none transition-colors placeholder-gray-300 text-gray-800 complain-input">
                    </div>
                </div>

                <!-- Row 2: Email Address -->
                <div class="relative">
                    <label class="block text-sm font-bold text-gray-800 mb-1">Email Address</label>
                    <input type="email" name="email" value="{{ old('email') }}" placeholder="Type Your Email Address."
                        class="w-full bg-transparent border-b border-gray-300 py-2 outline-none transition-colors placeholder-gray-300 text-gray-800 complain-input">
                </div>

                <!-- Row 3: Subject -->
                <div class="relative">
                    <label class="block text-sm font-bold text-gray-800 mb-1">Subject<span class="text-red-500 ml-0.5">*</span></label>
                    <input type="text" name="subject" required value="{{ old('subject') }}" placeholder="Type Your Problem Subject"
                        class="w-full bg-transparent border-b border-gray-300 py-2 outline-none transition-colors placeholder-gray-300 text-gray-800 complain-input">
                </div>

                <!-- Row 4: Details (Message) -->
                <div class="relative">
                    <label class="block text-sm font-bold text-gray-800 mb-1">Details<span class="text-red-500 ml-0.5">*</span></label>
                    <textarea name="message" rows="4" required placeholder="Write Your Problem In Details."
                        class="w-full bg-transparent border-b border-gray-300 py-2 outline-none transition-colors placeholder-gray-300 text-gray-800 resize-none complain-input">{{ old('message') }}</textarea>
                </div>

                <!-- Submit Button -->
                <div class="pt-4">
                    <button type="submit"
                        class="w-full text-white py-4 rounded-xl font-bold text-base transition-all shadow-md hover:shadow-lg flex items-center justify-center gap-2 transform active:scale-[0.98] complain-btn">
                        Submit Your Request
                    </button>
                </div>
            </form>

        </div>
    </div>

    <!-- Highly robust CSS styles -->
    <style>
        @keyframes fade-in {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in {
            animation: fade-in 0.5s ease-out forwards;
        }
        .complain-text-color {
            color: #30a7d7 !important;
        }
        .complain-btn {
            background-color: #ef4a23 !important;
            border: none !important;
            cursor: pointer !important;
        }
        .complain-btn:hover {
            background-color: #d83a15 !important;
        }
        .complain-input {
            border-bottom: 1px solid #d1d5db !important;
        }
        .complain-input:focus {
            border-color: #ef4a23 !important;
            outline: none !important;
            box-shadow: none !important;
        }
    </style>
@endsection
