@extends('layouts.app')

@section('title', 'Register Account | IOS BD')

@section('content')
    <div class="bg-gray-50 min-h-[80vh] flex items-center justify-center py-12 px-4">
        <div class="w-full max-w-[600px]">
            <!-- Register Card -->
            <div class="bg-white p-8 md:p-12 rounded-2xl shadow-xl border border-gray-100 animate-fade-in">
                <div class="text-center mb-10">
                    <h1 class="text-2xl font-bold text-primary-dark">Register Account</h1>
                    <p class="text-sm text-gray-500 mt-2">Create your account to enjoy all our features</p>
                </div>

                <form action="{{ route('user.register.store') }}" method="POST" class="space-y-6">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">First Name <span
                                    class="text-accent-orange">*</span></label>
                            <input type="text" name="first_name" value="{{ old('first_name') }}" placeholder="First Name"
                                class="w-full bg-gray-50 border @error('first_name') border-red-500 @else border-gray-200 @enderror rounded-xl px-5 py-3.5 outline-none focus:border-accent-orange focus:ring-4 focus:ring-orange-50 transition-all text-sm shadow-sm"
                                required>
                            @error('first_name')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Last Name <span
                                    class="text-accent-orange">*</span></label>
                            <input type="text" name="last_name" value="{{ old('last_name') }}" placeholder="Last Name"
                                class="w-full bg-gray-50 border @error('last_name') border-red-500 @else border-gray-200 @enderror rounded-xl px-5 py-3.5 outline-none focus:border-accent-orange focus:ring-4 focus:ring-orange-50 transition-all text-sm shadow-sm"
                                required>
                            @error('last_name')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">E-Mail <span
                                    class="text-accent-orange">*</span></label>
                            <input type="email" name="email" value="{{ old('email') }}" placeholder="E-Mail"
                                class="w-full bg-gray-50 border @error('email') border-red-500 @else border-gray-200 @enderror rounded-xl px-5 py-3.5 outline-none focus:border-accent-orange focus:ring-4 focus:ring-orange-50 transition-all text-sm shadow-sm"
                                required>
                            @error('email')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Telephone <span
                                    class="text-accent-orange">*</span></label>
                            <input type="text" name="telephone" value="{{ old('telephone') }}" placeholder="Telephone"
                                class="w-full bg-gray-50 border @error('telephone') border-red-500 @else border-gray-200 @enderror rounded-xl px-5 py-3.5 outline-none focus:border-accent-orange focus:ring-4 focus:ring-orange-50 transition-all text-sm shadow-sm"
                                required>
                            @error('telephone')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Password <span
                                    class="text-accent-orange">*</span></label>
                            <input type="password" name="password" placeholder="Password"
                                class="w-full bg-gray-50 border @error('password') border-red-500 @else border-gray-200 @enderror rounded-xl px-5 py-3.5 outline-none focus:border-accent-orange focus:ring-4 focus:ring-orange-50 transition-all text-sm shadow-sm"
                                required>
                            @error('password')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Confirm Password <span
                                    class="text-accent-orange">*</span></label>
                            <input type="password" name="password_confirmation" placeholder="Confirm Password"
                                class="w-full bg-gray-50 border border-gray-200 rounded-xl px-5 py-3.5 outline-none focus:border-accent-orange focus:ring-4 focus:ring-orange-50 transition-all text-sm shadow-sm"
                                required>
                        </div>
                    </div>

                    <div class="bg-gray-50 p-4 rounded-xl border border-gray-100">
                        <div class="flex items-start gap-3">
                            <input type="checkbox" name="policy" id="policy"
                                class="mt-1 w-4 h-4 text-accent-orange border-gray-300 rounded focus:ring-accent-orange"
                                required>
                            <label for="policy" class="text-xs md:text-sm text-gray-600 leading-relaxed">
                                I have read and agree to the <a href="#"
                                    class="text-accent-orange font-semibold hover:underline">Privacy Policy</a>, <a
                                    href="#" class="text-accent-orange font-semibold hover:underline">Terms &
                                    Conditions</a> and <a href="#"
                                    class="text-accent-orange font-semibold hover:underline">Refund Policy</a>.
                            </label>
                        </div>
                    </div>

                    <button type="submit"
                        class="w-full bg-primary-dark text-white py-4 rounded-xl font-bold hover:bg-opacity-90 transition-all shadow-lg flex items-center justify-center gap-2 group">
                        <span>Continue</span>
                        <i class="fas fa-user-plus text-xs group-hover:scale-110 transition-transform"></i>
                    </button>
                </form>

                <div class="mt-10 pt-8 border-t border-gray-100 text-center">
                    <p class="text-sm text-gray-600 mb-4">Already have an account?</p>
                    <a href="{{ url('/account/login') }}"
                        class="inline-block text-accent-blue font-bold hover:text-primary-dark transition-colors border-b-2 border-accent-blue/30 hover:border-accent-blue pb-0.5">
                        Login Now
                    </a>
                </div>
            </div>
        </div>
    </div>

    <style>
        @keyframes fade-in {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in {
            animation: fade-in 0.6s ease-out;
        }
    </style>
@endsection
