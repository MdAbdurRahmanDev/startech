@extends('layouts.app')

@section('title', 'Custom Web Development Services | IOS BD')

@section('styles')
    <style>
        .hero-section {
            background: linear-gradient(135deg, #0a1520 0%, #1a2b3c 100%);
            position: relative;
            overflow: hidden;
        }

        .hero-shape {
            position: absolute;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(239, 74, 35, 0.1) 0%, transparent 70%);
            border-radius: 50%;
            top: -250px;
            right: -250px;
        }

        .service-card {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .service-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.05);
        }

        .portfolio-item {
            position: relative;
            overflow: hidden;
            border-radius: 12px;
        }

        .portfolio-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, rgba(10, 21, 32, 0.9), transparent);
            opacity: 0;
            transition: opacity 0.3s ease;
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            padding: 20px;
        }

        .portfolio-item:hover .portfolio-overlay {
            opacity: 1;
        }
        
        .gradient-text {
            background: linear-gradient(90deg, #ef4a23, #ff8c00);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
    </style>
@endsection

@section('content')
    <!-- Hero Section -->
    <section class="hero-section text-white py-20 rounded-2xl mb-12">
        <div class="hero-shape"></div>
        <div class="container mx-auto px-6 relative z-10">
            <div class="max-w-3xl">
                <h1 class="text-4xl md:text-6xl font-black mb-6 leading-tight">
                    Premium <span class="gradient-text">Web Development</span> Solutions
                </h1>
                <p class="text-lg text-gray-300 mb-10 leading-relaxed">
                    We build high-performance, scalable, and secure web applications tailored to your business needs. From custom E-commerce platforms to complex enterprise solutions, we deliver excellence.
                </p>
                <div class="flex flex-wrap gap-4">
                    <a href="{{ route('contact') }}" class="bg-accent-orange hover:bg-orange-600 text-white px-8 py-4 rounded-lg font-bold transition-all shadow-lg shadow-orange-600/20">
                        Get a Free Quote
                    </a>
                    <a href="#portfolio" class="bg-white/10 hover:bg-white/20 text-white px-8 py-4 rounded-lg font-bold backdrop-blur-sm transition-all border border-white/10">
                        View Our Work
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Grid -->
    <section class="py-16 mb-12">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-primary-dark mb-4">Our Core Expertise</h2>
            <div class="w-20 h-1 bg-accent-orange mx-auto rounded-full"></div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Service 1 -->
            <div class="service-card bg-white p-8 rounded-2xl border border-gray-100 shadow-sm">
                <div class="w-14 h-14 bg-orange-50 text-accent-orange rounded-xl flex items-center justify-center mb-6 text-2xl">
                    <i class="fas fa-shopping-cart"></i>
                </div>
                <h3 class="text-xl font-bold text-primary-dark mb-4">Custom E-commerce</h3>
                <p class="text-gray-600 leading-relaxed">
                    Bespoke online stores built with scalability and conversion in mind. We specialize in Shopify, WooCommerce, and custom Laravel solutions.
                </p>
            </div>

            <!-- Service 2 -->
            <div class="service-card bg-white p-8 rounded-2xl border border-gray-100 shadow-sm">
                <div class="w-14 h-14 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center mb-6 text-2xl">
                    <i class="fas fa-code"></i>
                </div>
                <h3 class="text-xl font-bold text-primary-dark mb-4">Web Application</h3>
                <p class="text-gray-600 leading-relaxed">
                    Complex SaaS platforms and internal business tools designed to streamline your operations and boost productivity.
                </p>
            </div>

            <!-- Service 3 -->
            <div class="service-card bg-white p-8 rounded-2xl border border-gray-100 shadow-sm">
                <div class="w-14 h-14 bg-green-50 text-green-600 rounded-xl flex items-center justify-center mb-6 text-2xl">
                    <i class="fas fa-search"></i>
                </div>
                <h3 class="text-xl font-bold text-primary-dark mb-4">SEO & Performance</h3>
                <p class="text-gray-600 leading-relaxed">
                    We don't just build sites; we make them visible. Every project is optimized for Core Web Vitals and search engines.
                </p>
            </div>
        </div>
    </section>

    <!-- Portfolio Section -->
    <section id="portfolio" class="py-16 mb-12">
        <div class="flex justify-between items-end mb-12">
            <div>
                <h2 class="text-3xl md:text-4xl font-bold text-primary-dark mb-2">Featured Projects</h2>
                <p class="text-gray-500">A glimpse of our latest web development work</p>
            </div>
            <a href="#" class="text-accent-orange font-bold hover:underline hidden md:block">View All Projects →</a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Project 1 -->
            <div class="portfolio-item group aspect-video bg-gray-100">
                <img src="https://images.unsplash.com/photo-1460925895917-afdab827c52f?auto=format&fit=crop&q=80&w=800" alt="E-commerce Project" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                <div class="portfolio-overlay">
                    <span class="text-accent-orange text-sm font-bold mb-1">E-commerce</span>
                    <h4 class="text-white font-bold text-xl">Modern Fashion Store</h4>
                    <p class="text-gray-300 text-sm mt-2">Laravel & Vue.js Integration</p>
                </div>
            </div>

            <!-- Project 2 -->
            <div class="portfolio-item group aspect-video bg-gray-100">
                <img src="https://images.unsplash.com/photo-1551288049-bbbda5366391?auto=format&fit=crop&q=80&w=800" alt="Dashboard Project" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                <div class="portfolio-overlay">
                    <span class="text-accent-orange text-sm font-bold mb-1">SaaS</span>
                    <h4 class="text-white font-bold text-xl">Inventory Management System</h4>
                    <p class="text-gray-300 text-sm mt-2">Real-time Data Analytics</p>
                </div>
            </div>

            <!-- Project 3 -->
            <div class="portfolio-item group aspect-video bg-gray-100">
                <img src="https://images.unsplash.com/photo-1481487196290-c152efe083f5?auto=format&fit=crop&q=80&w=800" alt="Corporate Project" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                <div class="portfolio-overlay">
                    <span class="text-accent-orange text-sm font-bold mb-1">Corporate</span>
                    <h4 class="text-white font-bold text-xl">Financial Advisor Portal</h4>
                    <p class="text-gray-300 text-sm mt-2">Secure Client Portal</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="py-16 bg-accent-orange rounded-2xl text-white text-center">
        <h2 class="text-3xl font-black mb-6">Ready to Start Your Project?</h2>
        <p class="text-white/90 mb-10 max-w-xl mx-auto">
            Let's discuss how we can help your business grow with our custom web development solutions.
        </p>
        <a href="{{ route('contact') }}" class="inline-block bg-primary-dark text-white px-10 py-4 rounded-lg font-bold hover:bg-black transition-all">
            Contact Us Today
        </a>
    </section>
@endsection
