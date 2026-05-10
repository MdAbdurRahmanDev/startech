@extends('layouts.app')

@section('title', 'Request for Quotation | Iosbd')

@section('content')
    <div class="container mx-auto px-2 md:px-4 mb-10">
        <!-- Breadcrumb -->
        <div class="py-4 text-[13px] text-gray-500">
            <a href="{{ url('/') }}" class="text-gray-700 hover:text-accent-orange transition-colors"><i
                    class="fas fa-home"></i></a>
            <span class="mx-1">/</span> <span class="text-gray-900">Request for Quotation</span>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="grid grid-cols-1 lg:grid-cols-2">
                <!-- Left: Info & Branding -->
                <div class="bg-primary-dark p-8 md:p-16 text-white flex flex-col justify-center">
                    <div
                        class="inline-flex items-center gap-2 bg-accent-orange bg-opacity-20 text-accent-orange px-4 py-1.5 rounded-full text-xs font-bold uppercase mb-8 tracking-widest">
                        <i class="fas fa-file-invoice text-[10px]"></i> Project Estimate
                    </div>
                    <h1 class="text-3xl md:text-5xl font-bold mb-6 leading-tight">Get a Custom Quote for Your Project</h1>
                    <p class="text-lg text-gray-400 mb-10 leading-relaxed">Fill out the form to help us understand your
                        requirements. Our expert team will review your project details and get back to you with a
                        professional estimate within 24-48 hours.</p>

                    <div class="space-y-6">
                        <div class="flex items-center gap-4">
                            <div
                                class="w-10 h-10 bg-white bg-opacity-10 rounded-lg flex items-center justify-center text-accent-orange">
                                <i class="fas fa-check"></i>
                            </div>
                            <span class="text-sm font-medium">Detailed Project Analysis</span>
                        </div>
                        <div class="flex items-center gap-4">
                            <div
                                class="w-10 h-10 bg-white bg-opacity-10 rounded-lg flex items-center justify-center text-accent-orange">
                                <i class="fas fa-check"></i>
                            </div>
                            <span class="text-sm font-medium">Competitive Market Pricing</span>
                        </div>
                        <div class="flex items-center gap-4">
                            <div
                                class="w-10 h-10 bg-white bg-opacity-10 rounded-lg flex items-center justify-center text-accent-orange">
                                <i class="fas fa-check"></i>
                            </div>
                            <span class="text-sm font-medium">Professional Consultation</span>
                        </div>
                    </div>
                </div>

                <!-- Right: Quotation Form -->
                <div class="p-8 md:p-12">
                    @if (session('success'))
                        <div class="p-4 mb-8 text-sm text-green-800 rounded-lg bg-green-50 flex items-center gap-3 border border-green-100 animate-fade-in"
                            role="alert">
                            <i class="fas fa-check-circle text-lg"></i>
                            <span class="font-medium">{{ session('success') }}</span>
                        </div>
                    @endif

                    <form action="{{ route('quotation.store') }}" method="POST" enctype="multipart/form-data"
                        class="space-y-6">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-xs font-bold text-gray-500 uppercase tracking-widest mb-2">Full
                                    Name *</label>
                                <input type="text" name="name" required placeholder="John Doe"
                                    class="w-full bg-gray-50 border border-gray-200 rounded-lg py-3 px-4 focus:ring-2 focus:ring-accent-blue outline-none transition-all">
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-gray-500 uppercase tracking-widest mb-2">Email
                                    Address *</label>
                                <input type="email" name="email" required placeholder="john@company.com"
                                    class="w-full bg-gray-50 border border-gray-200 rounded-lg py-3 px-4 focus:ring-2 focus:ring-accent-blue outline-none transition-all">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-xs font-bold text-gray-500 uppercase tracking-widest mb-2">Phone
                                    Number *</label>
                                <input type="text" name="phone" required placeholder="+880 1XXX XXXXXX"
                                    class="w-full bg-gray-50 border border-gray-200 rounded-lg py-3 px-4 focus:ring-2 focus:ring-accent-blue outline-none transition-all">
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-gray-500 uppercase tracking-widest mb-2">Company
                                    Name (Optional)</label>
                                <input type="text" name="company_name" placeholder="Your Agency Ltd."
                                    class="w-full bg-gray-50 border border-gray-200 rounded-lg py-3 px-4 focus:ring-2 focus:ring-accent-blue outline-none transition-all">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-xs font-bold text-gray-500 uppercase tracking-widest mb-2">Project
                                    Type *</label>
                                <select name="project_type" required
                                    class="w-full bg-gray-50 border border-gray-200 rounded-lg py-3 px-4 focus:ring-2 focus:ring-accent-blue outline-none transition-all">
                                    <option value="Web Development">Web Development</option>
                                    <option value="Mobile App Development">Mobile App Development</option>
                                    <option value="UI/UX Design">UI/UX Design</option>
                                    <option value="E-Commerce Solution">E-Commerce Solution</option>
                                    <option value="Custom Software">Custom Software</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-gray-500 uppercase tracking-widest mb-2">Budget
                                    Range</label>
                                <select name="budget_range"
                                    class="w-full bg-gray-50 border border-gray-200 rounded-lg py-3 px-4 focus:ring-2 focus:ring-accent-blue outline-none transition-all">
                                    <option value="Below 50k BDT">Below 50k BDT</option>
                                    <option value="50k - 100k BDT">50k - 100k BDT</option>
                                    <option value="100k - 300k BDT">100k - 300k BDT</option>
                                    <option value="300k+ BDT">300k+ BDT</option>
                                </select>
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase tracking-widest mb-2">Project
                                Description *</label>
                            <textarea name="project_description" rows="5" required
                                placeholder="Tell us about your project requirements, goals, and any specific features you need..."
                                class="w-full bg-gray-50 border border-gray-200 rounded-lg py-3 px-4 focus:ring-2 focus:ring-accent-blue outline-none transition-all"></textarea>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase tracking-widest mb-2">Attachment
                                (Requirements PDF/Image)</label>
                            <div class="relative">
                                <input type="file" name="attachment"
                                    class="block w-full text-sm text-gray-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-bold file:bg-accent-blue file:text-white hover:file:bg-opacity-90" />
                            </div>
                            <p class="text-[10px] text-gray-400 mt-2">Accepted formats: PDF, DOCX, JPG, PNG, ZIP. Max size:
                                5MB.</p>
                        </div>

                        <button type="submit"
                            class="w-full bg-accent-orange text-white py-4 rounded-xl font-bold text-lg hover:shadow-xl transition-all flex items-center justify-center gap-3">
                            <i class="fas fa-paper-plane"></i> Submit Request
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
