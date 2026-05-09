@extends('layouts.app')

@section('title', $title . ' | Star Tech')

@section('content')
<div class="container mx-auto px-2 md:px-4 mb-10">
    <!-- Breadcrumb -->
    <div class="py-4 text-[13px] text-gray-500">
        <a href="{{ url('/') }}" class="text-gray-700 hover:text-accent-orange transition-colors"><i class="fas fa-home"></i></a> 
        <span class="mx-1">/</span> <span class="text-gray-900">{{ $title }}</span>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 md:p-12 mb-10 min-h-[500px]">
        @if($page)
            <h1 class="text-3xl font-bold text-primary-dark mb-8 pb-6 border-b border-gray-50">{{ $page->title }}</h1>
            <div class="prose prose-lg prose-blue max-w-none dynamic-content">
                {!! $page->content !!}
            </div>
        @else
            <div class="flex flex-col items-center justify-center py-20 text-center">
                <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mb-6 text-gray-200">
                    <i class="fas fa-file-alt text-4xl"></i>
                </div>
                <h2 class="text-2xl font-bold text-primary-dark mb-2">{{ $title }}</h2>
                <p class="text-gray-500 max-w-md">Content for this page is currently being prepared. Please check back later.</p>
                <a href="{{ url('/') }}" class="mt-8 bg-accent-blue text-white px-8 py-3 rounded-lg font-bold hover:bg-opacity-90 transition-all shadow-md">Back to Home</a>
            </div>
        @endif
    </div>
</div>

<style>
    .dynamic-content p { margin-bottom: 1.5rem; line-height: 1.8; color: #4B5563; }
    .dynamic-content h2 { font-size: 1.875rem; font-weight: bold; margin: 2.5rem 0 1.25rem; color: #111827; }
    .dynamic-content h3 { font-size: 1.5rem; font-weight: bold; margin: 2rem 0 1rem; color: #1F2937; }
    .dynamic-content ul { list-style: disc; margin-left: 1.5rem; margin-bottom: 1.5rem; }
    .dynamic-content ol { list-style: decimal; margin-left: 1.5rem; margin-bottom: 1.5rem; }
    .dynamic-content li { margin-bottom: 0.75rem; color: #4B5563; }
    .dynamic-content strong { color: #111827; font-weight: 600; }
    .dynamic-content table { width: 100%; border-collapse: collapse; margin: 2rem 0; }
    .dynamic-content th, .dynamic-content td { border: 1px solid #E5E7EB; padding: 0.75rem 1rem; text-align: left; }
    .dynamic-content th { background-color: #F9FAFB; font-weight: bold; }
</style>
@endsection
