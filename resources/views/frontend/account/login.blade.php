@extends('layouts.app')

@section('title', 'Account Login | IOS BD')

@section('content')
    <div class="bg-gray-50 min-h-[80vh] flex items-center justify-center py-12 px-4">
        <div class="w-full max-w-[450px]">
            <!-- Login Card -->
            <div class="bg-white p-8 md:p-10 rounded-2xl shadow-xl border border-gray-100 animate-fade-in">
                <div class="text-center mb-8">
                    <h1 class="text-2xl font-bold text-primary-dark">Account Login</h1>
                    <p class="text-sm text-gray-500 mt-2">Login to your account for better experience</p>
                </div>

                <form action="{{ route('user.login.store') }}" method="POST" class="space-y-6">
                    @csrf
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Phone / E-Mail</label>
                        <input type="text" name="login_identity" value="{{ old('login_identity') }}"
                            placeholder="Phone / E-Mail"
                            class="w-full bg-gray-50 border @error('login_identity') border-red-500 @else border-gray-200 @enderror rounded-xl px-5 py-3.5 outline-none focus:border-accent-orange focus:ring-4 focus:ring-orange-50 transition-all text-sm shadow-sm"
                            required autofocus>
                        @error('login_identity')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <div class="flex justify-between items-center mb-2">
                            <label class="block text-sm font-bold text-gray-700">Password</label>
                            <a href="#" class="text-xs text-accent-orange font-semibold hover:underline">Forgotten
                                Password?</a>
                        </div>
                        <input type="password" name="password" placeholder="Password"
                            class="w-full bg-gray-50 border @error('password') border-red-500 @else border-gray-200 @enderror rounded-xl px-5 py-3.5 outline-none focus:border-accent-orange focus:ring-4 focus:ring-orange-50 transition-all text-sm shadow-sm"
                            required>
                        @error('password')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center gap-2">
                        <input type="checkbox" name="remember" id="remember"
                            class="w-4 h-4 text-accent-orange border-gray-300 rounded focus:ring-accent-orange">
                        <label for="remember" class="text-sm text-gray-600">Remember Me</label>
                    </div>

                    <button type="submit"
                        class="w-full bg-primary-dark text-white py-4 rounded-xl font-bold hover:bg-opacity-90 transition-all shadow-lg flex items-center justify-center gap-2 group">
                        <span>Login</span>
                        <i class="fas fa-arrow-right text-xs group-hover:translate-x-1 transition-transform"></i>
                    </button>
                </form>

                <div class="mt-8 pt-8 border-t border-gray-100 text-center">
                    <p class="text-sm text-gray-600 mb-4">Don't have an account?</p>
                    <a href="{{ url('/account/register') }}"
                        class="inline-block text-accent-blue font-bold hover:text-primary-dark transition-colors border-b-2 border-accent-blue/30 hover:border-accent-blue pb-0.5">
                        Create Your Account
                    </a>
                </div>
            </div>

            <!-- Extra Links -->
            <div class="mt-8 flex justify-center gap-6 text-xs text-gray-400">
                <a href="#" class="hover:text-gray-600">Privacy Policy</a>
                <a href="#" class="hover:text-gray-600">Terms & Conditions</a>
                <a href="#" class="hover:text-gray-600">Contact Us</a>
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
            animation: fade-in 0.5s ease-out;
        }
    </style>
@endsection
