@extends('layouts.app')

@section('title', $blog->title . ' | StarTech Blog')

@section('styles')
<style>
    .blog-content img { max-width: 100%; border-radius: 0.75rem; margin: 1.5rem 0; }
    .blog-content h2 { font-size: 1.5rem; font-weight: 800; color: #1a202c; margin: 2rem 0 1rem; }
    .blog-content h3 { font-size: 1.2rem; font-weight: 700; color: #2d3748; margin: 1.5rem 0 0.75rem; }
    .blog-content p { color: #4a5568; line-height: 1.85; margin-bottom: 1rem; }
    .blog-content ul, .blog-content ol { margin: 1rem 0 1rem 1.5rem; color: #4a5568; }
    .blog-content li { margin-bottom: 0.4rem; }
    .blog-content a { color: #ef4a23; text-decoration: underline; }
    .blog-content blockquote { border-left: 4px solid #ef4a23; padding: 0.75rem 1.25rem; background: #fff7f5; margin: 1.5rem 0; border-radius: 0 0.5rem 0.5rem 0; color: #6b7280; font-style: italic; }
    .related-card { transition: all 0.3s ease; }
    .related-card:hover { transform: translateY(-3px); box-shadow: 0 10px 25px rgba(0,0,0,0.08); }
</style>
@endsection

@section('content')
<div class="container mx-auto px-4 py-8 mb-12">
    <div class="max-w-4xl mx-auto">

        <!-- Breadcrumb -->
        <div class="flex items-center gap-2 text-xs text-gray-400 mb-6">
            <a href="{{ route('blogs.index') }}" class="hover:text-[#ef4a23] transition-colors">Blog</a>
            <i class="fas fa-chevron-right text-[8px]"></i>
            @if($blog->category)
            <a href="{{ route('blogs.category', $blog->category->slug) }}" class="hover:text-[#ef4a23] transition-colors">{{ $blog->category->name }}</a>
            <i class="fas fa-chevron-right text-[8px]"></i>
            @endif
            <span class="text-gray-600 font-semibold">{{ Str::limit($blog->title, 40) }}</span>
        </div>

        <!-- Post Header -->
        <div class="mb-8">
            @if($blog->category)
            <span class="text-xs font-bold text-[#ef4a23] uppercase tracking-wider bg-orange-50 px-3 py-1 rounded-full">{{ $blog->category->name }}</span>
            @endif
            <h1 class="text-2xl md:text-4xl font-extrabold text-gray-900 mt-4 mb-4 leading-tight">{{ $blog->title }}</h1>
            <div class="flex items-center gap-4 text-xs text-gray-400">
                <span class="flex items-center gap-1"><i class="fas fa-user"></i> {{ $blog->author }}</span>
                <span class="flex items-center gap-1"><i class="fas fa-calendar"></i> {{ $blog->published_at?->format('d M, Y') }}</span>
                <span class="flex items-center gap-1"><i class="fas fa-clock"></i> {{ $blog->read_time }}</span>
            </div>
            @if($blog->excerpt)
            <p class="mt-4 text-base text-gray-600 font-medium bg-gray-50 p-4 rounded-xl border-l-4 border-[#ef4a23]">{{ $blog->excerpt }}</p>
            @endif
        </div>

        <!-- Thumbnail -->
        @if($blog->thumbnail)
        <div class="mb-8 rounded-2xl overflow-hidden shadow-md border border-gray-100">
            <img src="{{ asset('storage/' . $blog->thumbnail) }}" class="w-full object-cover max-h-96" alt="{{ $blog->title }}">
        </div>
        @endif

        <!-- Content -->
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 md:p-10 mb-10">
            <div class="blog-content prose max-w-none">
                {!! $blog->content !!}
            </div>
        </div>

        <!-- Tags / Category -->
        <div class="flex items-center gap-3 mb-10">
            <span class="text-xs text-gray-400 font-bold uppercase">Category:</span>
            @if($blog->category)
            <a href="{{ route('blogs.category', $blog->category->slug) }}" class="bg-orange-50 text-[#ef4a23] text-xs font-bold px-3 py-1 rounded-full hover:bg-orange-100 transition-colors">
                {{ $blog->category->name }}
            </a>
            @endif
        </div>

        <!-- Related Posts -->
        @if($related->count() > 0)
        <div>
            <h2 class="text-xl font-extrabold text-gray-900 mb-5">Related Posts</h2>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
                @foreach($related as $rel)
                <a href="{{ route('blogs.show', $rel->slug) }}" class="related-card bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden flex flex-col">
                    <div class="h-36 overflow-hidden bg-gradient-to-br from-blue-900 to-indigo-700">
                        @if($rel->thumbnail)
                        <img src="{{ asset('storage/' . $rel->thumbnail) }}" class="w-full h-full object-cover" alt="{{ $rel->title }}">
                        @else
                        <div class="w-full h-full flex items-center justify-center"><i class="fas fa-file-alt text-white/20 text-3xl"></i></div>
                        @endif
                    </div>
                    <div class="p-4">
                        <h3 class="text-sm font-bold text-gray-800 leading-snug line-clamp-2 mb-2">{{ $rel->title }}</h3>
                        <div class="text-[10px] text-gray-400 flex items-center gap-2">
                            <span><i class="fas fa-clock mr-1"></i>{{ $rel->read_time }}</span>
                            <span><i class="fas fa-calendar mr-1"></i>{{ $rel->published_at?->format('d M Y') }}</span>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
        @endif

        <!-- Back Link -->
        <div class="mt-10 text-center">
            <a href="{{ route('blogs.index') }}" class="inline-flex items-center gap-2 text-sm font-bold text-gray-500 hover:text-[#ef4a23] transition-colors">
                <i class="fas fa-arrow-left text-xs"></i> Back to All Posts
            </a>
        </div>
    </div>
</div>
@endsection
