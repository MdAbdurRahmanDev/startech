@extends('layouts.app')

@section('title', 'AI Automation & AI Services | IOS BD')

@section('styles')
    <style>
        .ai-hero {
            background: radial-gradient(circle at top right, #1e1b4b, #0f172a);
            position: relative;
            overflow: hidden;
        }

        .ai-glow {
            position: absolute;
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(99, 102, 241, 0.15) 0%, transparent 70%);
            border-radius: 50%;
            top: -300px;
            left: -300px;
        }

        .feature-card:hover {
            transform: translateY(-5px);
            border-color: rgba(99, 102, 241, 0.3);
        }

        .gradient-text {
            background: linear-gradient(90deg, #818cf8, #c084fc);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
    </style>
@endsection

@section('content')
    <!-- Hero Section -->
    <section class="ai-hero text-white py-20 rounded-3xl mb-12 relative">
        <div class="ai-glow"></div>
        <div class="container mx-auto px-6 relative z-10 text-center">
            <span class="inline-block bg-indigo-500/10 text-indigo-400 px-4 py-1.5 rounded-full text-xs font-bold tracking-widest uppercase mb-6 border border-indigo-500/20">
                The Future is Here
            </span>
            <h1 class="text-4xl md:text-6xl font-black mb-8 leading-tight">
                Empower Your Business with <span class="gradient-text">AI Automation</span>
            </h1>
            <p class="text-lg text-gray-400 mb-12 max-w-3xl mx-auto leading-relaxed">
                Scale faster and work smarter. We integrate cutting-edge Artificial Intelligence into your existing workflows to automate repetitive tasks and unlock data-driven insights.
            </p>
            <div class="flex justify-center gap-6">
                <a href="{{ route('contact') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-10 py-4 rounded-xl font-bold transition-all shadow-xl shadow-indigo-600/20">
                    Get Started with AI
                </a>
            </div>
        </div>
    </section>

    <!-- Expertise Section -->
    <section class="py-16 mb-12">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Our AI Capabilities</h2>
            <p class="text-gray-500">Transforming industries through intelligent automation</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="feature-card bg-white p-8 rounded-2xl border border-gray-100 shadow-sm transition-all text-center">
                <div class="w-16 h-16 bg-indigo-50 text-indigo-600 rounded-2xl flex items-center justify-center mx-auto mb-6 text-2xl">
                    <i class="fas fa-robot"></i>
                </div>
                <h3 class="text-lg font-bold text-gray-900 mb-3">Intelligent Chatbots</h3>
                <p class="text-gray-600 text-sm">24/7 customer support with NLP-powered conversational AI.</p>
            </div>

            <div class="feature-card bg-white p-8 rounded-2xl border border-gray-100 shadow-sm transition-all text-center">
                <div class="w-16 h-16 bg-purple-50 text-purple-600 rounded-2xl flex items-center justify-center mx-auto mb-6 text-2xl">
                    <i class="fas fa-brain"></i>
                </div>
                <h3 class="text-lg font-bold text-gray-900 mb-3">Machine Learning</h3>
                <p class="text-gray-600 text-sm">Predictive analytics and data modeling for better decisions.</p>
            </div>

            <div class="feature-card bg-white p-8 rounded-2xl border border-gray-100 shadow-sm transition-all text-center">
                <div class="w-16 h-16 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center mx-auto mb-6 text-2xl">
                    <i class="fas fa-file-invoice"></i>
                </div>
                <h3 class="text-lg font-bold text-gray-900 mb-3">Process Automation</h3>
                <p class="text-gray-600 text-sm">Automate document processing and data entry workflows.</p>
            </div>

            <div class="feature-card bg-white p-8 rounded-2xl border border-gray-100 shadow-sm transition-all text-center">
                <div class="w-16 h-16 bg-pink-50 text-pink-600 rounded-2xl flex items-center justify-center mx-auto mb-6 text-2xl">
                    <i class="fas fa-eye"></i>
                </div>
                <h3 class="text-lg font-bold text-gray-900 mb-3">Computer Vision</h3>
                <p class="text-gray-600 text-sm">Advanced image and video analysis for security and QA.</p>
            </div>
        </div>
    </section>

    <!-- Portfolio Section -->
    <section class="py-16 mb-12">
        <h2 class="text-3xl font-bold text-gray-900 mb-12 text-center md:text-left">AI Implementation Success Stories</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- AI Case 1 -->
            <div class="flex flex-col md:flex-row bg-white rounded-3xl overflow-hidden shadow-lg border border-gray-100">
                <div class="md:w-1/2 aspect-square md:aspect-auto">
                    <img src="https://images.unsplash.com/photo-1677442136019-21780ecad995?auto=format&fit=crop&q=80&w=800" alt="AI Analytics" class="w-full h-full object-cover">
                </div>
                <div class="md:w-1/2 p-8 flex flex-col justify-center">
                    <span class="text-indigo-600 text-xs font-bold uppercase tracking-widest mb-2">E-commerce</span>
                    <h4 class="text-xl font-bold text-gray-900 mb-4">Smart Inventory AI</h4>
                    <p class="text-gray-600 text-sm leading-relaxed mb-6">
                        An AI system that reduced stockouts by 40% using historical data to predict future demand trends.
                    </p>
                    <a href="#" class="text-indigo-600 font-bold text-sm hover:underline">Read Case Study →</a>
                </div>
            </div>

            <!-- AI Case 2 -->
            <div class="flex flex-col md:flex-row bg-white rounded-3xl overflow-hidden shadow-lg border border-gray-100">
                <div class="md:w-1/2 aspect-square md:aspect-auto">
                    <img src="https://images.unsplash.com/photo-1531746790731-6c087fecd05a?auto=format&fit=crop&q=80&w=800" alt="Customer AI" class="w-full h-full object-cover">
                </div>
                <div class="md:w-1/2 p-8 flex flex-col justify-center">
                    <span class="text-indigo-600 text-xs font-bold uppercase tracking-widest mb-2">Customer Service</span>
                    <h4 class="text-xl font-bold text-gray-900 mb-4">Support Bot 2.0</h4>
                    <p class="text-gray-600 text-sm leading-relaxed mb-6">
                        Custom NLP chatbot that resolved 70% of customer queries without human intervention.
                    </p>
                    <a href="#" class="text-indigo-600 font-bold text-sm hover:underline">Read Case Study →</a>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 rounded-3xl text-center text-white" style="background: linear-gradient(135deg, #1e1b4b 0%, #0f172a 100%);">
        <h2 class="text-3xl font-black mb-6">Ready to Automate?</h2>
        <p class="text-indigo-200 mb-10 max-w-xl mx-auto leading-relaxed">
            Take the first step towards an intelligent future. Our experts will analyze your business and suggest the best AI implementation strategies.
        </p>
        <a href="{{ route('contact') }}" class="inline-block bg-accent-orange text-white px-12 py-4 rounded-xl font-bold hover:scale-105 transition-all shadow-xl shadow-orange-600/20">
            Book an AI Consultation
        </a>
    </section>
@endsection
