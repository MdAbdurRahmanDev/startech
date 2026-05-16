@extends('layouts.app')

@section('title', 'Apps Development Services | IOS BD')

@section('styles')
    <style>
        .hero-section {
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
            position: relative;
            overflow: hidden;
        }

        .service-card:hover {
            transform: translateY(-10px);
        }

        .gradient-text {
            background: linear-gradient(90deg, #3b82f6, #8b5cf6);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
    </style>
@endsection

@section('content')
    <!-- Hero Section -->
    <section class="hero-section text-white py-20 rounded-2xl mb-12">
        <div class="container mx-auto px-6 relative z-10 text-center">
            <h1 class="text-4xl md:text-6xl font-black mb-6 leading-tight">
                Innovative <span class="gradient-text">Mobile Apps</span>
            </h1>
            <p class="text-lg text-gray-300 mb-10 leading-relaxed max-w-2xl mx-auto">
                Transform your ideas into powerful mobile experiences. We develop high-quality iOS and Android applications using Flutter and React Native.
            </p>
            <div class="flex justify-center gap-4">
                <a href="{{ route('contact') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-4 rounded-lg font-bold transition-all shadow-lg shadow-blue-600/20">
                    Discuss Your App
                </a>
            </div>
        </div>
    </section>

    <!-- Services Grid -->
    <section class="py-16 mb-12">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Specialized App Solutions</h2>
            <div class="w-20 h-1 bg-blue-600 mx-auto rounded-full"></div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Service 1 -->
            <div class="service-card bg-white p-8 rounded-2xl border border-gray-100 shadow-sm hover:shadow-xl transition-all">
                <div class="w-14 h-14 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center mb-6 text-2xl">
                    <i class="fab fa-apple"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-4">Native iOS</h3>
                <p class="text-gray-600 leading-relaxed">
                    High-performance Swift and Objective-C apps designed specifically for the Apple ecosystem.
                </p>
            </div>

            <!-- Service 2 -->
            <div class="service-card bg-white p-8 rounded-2xl border border-gray-100 shadow-sm hover:shadow-xl transition-all">
                <div class="w-14 h-14 bg-green-50 text-green-600 rounded-xl flex items-center justify-center mb-6 text-2xl">
                    <i class="fab fa-android"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-4">Native Android</h3>
                <p class="text-gray-600 leading-relaxed">
                    Robust Kotlin and Java applications that leverage the full potential of Android devices.
                </p>
            </div>

            <!-- Service 3 -->
            <div class="service-card bg-white p-8 rounded-2xl border border-gray-100 shadow-sm hover:shadow-xl transition-all">
                <div class="w-14 h-14 bg-purple-50 text-purple-600 rounded-xl flex items-center justify-center mb-6 text-2xl">
                    <i class="fas fa-mobile-alt"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-4">Cross-Platform</h3>
                <p class="text-gray-600 leading-relaxed">
                    Efficient Flutter and React Native apps that deliver a consistent experience on both platforms.
                </p>
            </div>
        </div>
    </section>

    <!-- Portfolio Section -->
    <section id="portfolio" class="py-16 mb-12">
        <div class="flex justify-between items-end mb-12">
            <div>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-2">Mobile Case Studies</h2>
                <p class="text-gray-500">Transforming ideas into digital reality</p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- App Project 1 -->
            <div class="bg-white rounded-3xl overflow-hidden shadow-lg border border-gray-100 group">
                <div class="aspect-[4/5] overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1512941937669-90a1b58e7e9c?auto=format&fit=crop&q=80&w=800" alt="Food Delivery App" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                </div>
                <div class="p-6">
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <span class="text-xs font-bold text-blue-600 uppercase tracking-wider">iOS & Android</span>
                            <h4 class="text-xl font-bold text-gray-900 mt-1">QuickBite Delivery</h4>
                        </div>
                        <div class="bg-gray-100 px-3 py-1 rounded-full text-xs font-bold text-gray-500">Flutter</div>
                    </div>
                    <p class="text-gray-600 text-sm leading-relaxed">
                        A real-time food delivery application with live tracking, secure payments, and vendor management.
                    </p>
                </div>
            </div>

            <!-- App Project 2 -->
            <div class="bg-white rounded-3xl overflow-hidden shadow-lg border border-gray-100 group">
                <div class="aspect-[4/5] overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1526628953301-3e589a6a8b74?auto=format&fit=crop&q=80&w=800" alt="Fintech App" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                </div>
                <div class="p-6">
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <span class="text-xs font-bold text-blue-600 uppercase tracking-wider">Fintech</span>
                            <h4 class="text-xl font-bold text-gray-900 mt-1">WealthWise</h4>
                        </div>
                        <div class="bg-gray-100 px-3 py-1 rounded-full text-xs font-bold text-gray-500">React Native</div>
                    </div>
                    <p class="text-gray-600 text-sm leading-relaxed">
                        Comprehensive investment tracking app with AI-powered financial insights and stock market integration.
                    </p>
                </div>
            </div>

            <!-- App Project 3 -->
            <div class="bg-white rounded-3xl overflow-hidden shadow-lg border border-gray-100 group">
                <div class="aspect-[4/5] overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1576091160550-2173dba999ef?auto=format&fit=crop&q=80&w=800" alt="Healthcare App" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                </div>
                <div class="p-6">
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <span class="text-xs font-bold text-blue-600 uppercase tracking-wider">Healthcare</span>
                            <h4 class="text-xl font-bold text-gray-900 mt-1">TeleHealth Plus</h4>
                        </div>
                        <div class="bg-gray-100 px-3 py-1 rounded-full text-xs font-bold text-gray-500">Native Android</div>
                    </div>
                    <p class="text-gray-600 text-sm leading-relaxed">
                        A telemedicine platform connecting patients with doctors via high-quality video consultation.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="py-16 bg-blue-600 rounded-3xl text-white text-center mb-12">
        <h2 class="text-3xl font-black mb-6">Have a Revolutionary App Idea?</h2>
        <p class="text-white/90 mb-10 max-w-xl mx-auto">
            Let's turn your vision into a top-rated mobile application. Get in touch for a consultation.
        </p>
        <a href="{{ route('contact') }}" class="inline-block bg-white text-blue-600 px-10 py-4 rounded-lg font-bold hover:bg-gray-100 transition-all">
            Get Started
        </a>
    </section>
@endsection
