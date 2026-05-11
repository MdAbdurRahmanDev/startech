@extends('layouts.app')

@section('title', 'Contact Us | IOS BD')

@section('content')
    <div class="container mx-auto px-2 md:px-4 mb-10">
        <!-- Breadcrumb -->
        <div class="py-4 text-[13px] text-gray-500">
            <a href="{{ url('/') }}" class="text-gray-700 hover:text-accent-orange transition-colors"><i
                    class="fas fa-home"></i></a>
            <span class="mx-1">/</span> <span class="text-gray-900">Contact Us</span>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-[1fr_400px] gap-8">
            <!-- Contact Form Section -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 md:p-10">
                <h1 class="text-2xl md:text-3xl font-bold text-primary-dark mb-2">Send Us a Message</h1>
                <p class="text-gray-500 mb-8">Have a question or need assistance? Fill out the form below and our team will
                    get back to you shortly.</p>

                @if (session('success'))
                    <div class="p-4 mb-6 text-sm text-green-800 rounded-lg bg-green-50" role="alert">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('contact.store') }}" method="POST" class="space-y-6">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Your Name <span
                                    class="text-accent-orange">*</span></label>
                            <input type="text" name="name" required placeholder="John Doe"
                                class="w-full bg-gray-50 border border-gray-200 rounded-lg py-3 px-4 focus:ring-2 focus:ring-accent-blue focus:border-accent-blue outline-none transition-all">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Email Address <span
                                    class="text-accent-orange">*</span></label>
                            <input type="email" name="email" required placeholder="john@example.com"
                                class="w-full bg-gray-50 border border-gray-200 rounded-lg py-3 px-4 focus:ring-2 focus:ring-accent-blue focus:border-accent-blue outline-none transition-all">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Phone Number</label>
                            <input type="text" name="phone" placeholder="+880 1XXX XXXXXX"
                                class="w-full bg-gray-50 border border-gray-200 rounded-lg py-3 px-4 focus:ring-2 focus:ring-accent-blue focus:border-accent-blue outline-none transition-all">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Subject <span
                                    class="text-accent-orange">*</span></label>
                            <select name="subject" required
                                class="w-full bg-gray-50 border border-gray-200 rounded-lg py-3 px-4 focus:ring-2 focus:ring-accent-blue focus:border-accent-blue outline-none transition-all">
                                <option value="General Inquiry">General Inquiry</option>
                                <option value="Technical Support">Technical Support</option>
                                <option value="Web Development">Web Development</option>
                                <option value="App Development">App Development</option>
                                <option value="Bulk Order">Bulk Order</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Your Message <span
                                class="text-accent-orange">*</span></label>
                        <textarea name="message" rows="6" required placeholder="How can we help you?"
                            class="w-full bg-gray-50 border border-gray-200 rounded-lg py-3 px-4 focus:ring-2 focus:ring-accent-blue focus:border-accent-blue outline-none transition-all"></textarea>
                    </div>

                    <button type="submit"
                        class="bg-accent-blue text-white px-10 py-4 rounded-xl font-bold text-lg hover:bg-opacity-90 transition-all shadow-xl flex items-center justify-center gap-3">
                        <i class="fas fa-paper-plane"></i> Send Message
                    </button>
                </form>
            </div>

            <!-- Contact Sidebar Info -->
            <div class="space-y-6">
                <!-- Info Cards -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
                    <h3 class="text-xl font-bold text-primary-dark mb-8 pb-4 border-b border-gray-50">Contact Information
                    </h3>

                    <div class="space-y-8">
                        <div class="flex gap-4">
                            <div class="w-12 h-12 bg-blue-50 rounded-xl flex items-center justify-center shrink-0">
                                <i class="fas fa-phone-alt text-accent-blue text-xl"></i>
                            </div>
                            <div>
                                <p class="text-sm font-bold text-gray-400 uppercase tracking-widest mb-1">Call Us</p>
                                <p class="text-lg font-bold text-primary-dark">{{ $setting->phone_number ?? '16793' }}</p>
                                <p class="text-xs text-gray-500 mt-1">9 AM - 8 PM (Everyday)</p>
                            </div>
                        </div>

                        <div class="flex gap-4">
                            <div class="w-12 h-12 bg-orange-50 rounded-xl flex items-center justify-center shrink-0">
                                <i class="fas fa-envelope text-accent-orange text-xl"></i>
                            </div>
                            <div>
                                <p class="text-sm font-bold text-gray-400 uppercase tracking-widest mb-1">Email Us</p>
                                <a href="mailto:{{ $setting->contact_email ?? 'info@startech.com.bd' }}"
                                    class="text-base font-bold text-primary-dark hover:text-accent-orange transition-colors">{{ $setting->contact_email ?? 'info@startech.com.bd' }}</a>
                                <p class="text-xs text-gray-500 mt-1">Support response within 24h</p>
                            </div>
                        </div>

                        <div class="flex gap-4">
                            <div class="w-12 h-12 bg-green-50 rounded-xl flex items-center justify-center shrink-0">
                                <i class="fas fa-map-marker-alt text-green-500 text-xl"></i>
                            </div>
                            <div>
                                <p class="text-sm font-bold text-gray-400 uppercase tracking-widest mb-1">Visit Us</p>
                                <p class="text-sm font-bold text-primary-dark leading-relaxed">
                                    {!! nl2br(e($setting->address ?? "Head Office: 28 Kazi Nazrul Islam\nAve, Dhaka 1000")) !!}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Social Media -->
                <div class="bg-primary-dark rounded-2xl p-8 text-white">
                    <h3 class="text-lg font-bold mb-6">Connect with us</h3>
                    <div class="flex gap-4">
                        @if ($setting && $setting->facebook_url)
                            <a href="{{ $setting->facebook_url }}"
                                class="w-10 h-10 bg-white bg-opacity-10 rounded-lg flex items-center justify-center hover:bg-accent-blue transition-all"><i
                                    class="fab fa-facebook-f"></i></a>
                        @endif
                        @if ($setting && $setting->youtube_url)
                            <a href="{{ $setting->youtube_url }}"
                                class="w-10 h-10 bg-white bg-opacity-10 rounded-lg flex items-center justify-center hover:bg-red-600 transition-all"><i
                                    class="fab fa-youtube"></i></a>
                        @endif
                        @if ($setting && $setting->instagram_url)
                            <a href="{{ $setting->instagram_url }}"
                                class="w-10 h-10 bg-white bg-opacity-10 rounded-lg flex items-center justify-center hover:bg-pink-600 transition-all"><i
                                    class="fab fa-instagram"></i></a>
                        @endif
                        @if ($setting && $setting->whatsapp_number)
                            <a href="https://wa.me/{{ $setting->whatsapp_number }}"
                                class="w-10 h-10 bg-white bg-opacity-10 rounded-lg flex items-center justify-center hover:bg-green-600 transition-all"><i
                                    class="fab fa-whatsapp"></i></a>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Map Section -->
        <div class="mt-12 bg-white rounded-2xl p-4 shadow-sm border border-gray-100 h-[400px] overflow-hidden">
            <iframe
                src="{{ $setting->map_url ?? 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3651.90224748135!2d90.3905051759495!3d23.750862088764026!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755b8bd09689f41%3A0xe54d929424847e30!2sStar%20Tech%20%26%20Engineering%20Ltd!5e0!3m2!1sen!2sbd!4v1715243123456!5m2!1sen!2sbd' }}"
                width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </div>
@endsection
