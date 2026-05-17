@extends('layouts.app')

@section('title', isset($category) ? $category->name . ' — Blog | StarTech' : 'Blog & Tips | StarTech')

@section('styles')
<style>
    .blog-card { transition: all 0.3s cubic-bezier(0.4,0,0.2,1); }
    .blog-card:hover { transform: translateY(-4px); box-shadow: 0 16px 40px rgba(0,0,0,0.08); }
    .blog-card:hover .blog-thumb { transform: scale(1.05); }
    .blog-thumb { transition: transform 0.4s ease; }
    .cat-pill.active { background: #ef4a23; color: #fff; }
    .line-clamp-2 { display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }
    .line-clamp-3 { display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden; }
</style>
@endsection

@section('content')
<div class="container mx-auto px-4 py-8 mb-12">

    <!-- Page Header -->
    <div class="text-center mb-10">
        <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">StarTech Blog</span>
        <h1 class="text-3xl md:text-4xl font-extrabold text-gray-900 mt-1">
            {{ isset($category) ? $category->name : 'Expert Tips & Tech Insights' }}
        </h1>
        <p class="text-gray-500 mt-2 text-sm max-w-xl mx-auto">
            {{ isset($category) && $category->description ? $category->description : 'Stay updated with the latest tech tips, servicing guides and expert suggestions.' }}
        </p>
        <div class="w-16 h-1 bg-[#ef4a23] mx-auto mt-4 rounded-full"></div>
    </div>

    <!-- Category Filter Pills -->
    @if($categories->count() > 0)
    <div class="flex flex-wrap items-center gap-2 justify-center mb-10">
        <a href="{{ route('blogs.index') }}"
           class="cat-pill text-xs font-bold px-4 py-2 rounded-full border border-gray-200 transition-all hover:border-[#ef4a23] hover:text-[#ef4a23] {{ !isset($category) ? 'active border-[#ef4a23]' : 'text-gray-600 bg-white' }}">
            All Posts
        </a>
        @foreach($categories as $cat)
        <a href="{{ route('blogs.category', $cat->slug) }}"
           class="cat-pill text-xs font-bold px-4 py-2 rounded-full border border-gray-200 transition-all hover:border-[#ef4a23] hover:text-[#ef4a23] {{ (isset($category) && $category->id === $cat->id) ? 'active border-[#ef4a23]' : 'text-gray-600 bg-white' }}">
            {{ $cat->name }}
            <span class="ml-1 text-[10px] opacity-60">({{ $cat->blogs_count }})</span>
        </a>
        @endforeach
    </div>
    @endif

    <!-- Featured Post (only on all posts page) -->
    @if(isset($featuredBlog) && !isset($category))
    <div class="mb-10">
        <a href="{{ route('blogs.show', $featuredBlog->slug) }}" class="block group">
            <div class="relative rounded-2xl overflow-hidden shadow-lg border border-gray-100 bg-white flex flex-col md:flex-row">
                <div class="md:w-1/2 relative overflow-hidden h-52 md:h-auto">
                    @if($featuredBlog->thumbnail)
                    <img src="{{ asset('storage/' . $featuredBlog->thumbnail) }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" alt="{{ $featuredBlog->title }}">
                    @else
                    <div class="w-full h-full bg-gradient-to-br from-blue-900 to-indigo-700 flex items-center justify-center min-h-52">
                        <i class="fas fa-newspaper text-white/30 text-6xl"></i>
                    </div>
                    @endif
                    <span class="absolute top-3 left-3 bg-[#ef4a23] text-white text-[10px] font-bold px-2 py-1 rounded">Featured</span>
                </div>
                <div class="md:w-1/2 p-8 flex flex-col justify-center">
                    <span class="text-xs font-bold text-[#ef4a23] uppercase tracking-wider mb-2">{{ $featuredBlog->category->name ?? '' }}</span>
                    <h2 class="text-2xl font-extrabold text-gray-900 mb-3 leading-snug group-hover:text-[#ef4a23] transition-colors">{{ $featuredBlog->title }}</h2>
                    <p class="text-gray-500 text-sm mb-4 line-clamp-3">{{ $featuredBlog->excerpt }}</p>
                    <div class="flex items-center gap-3 text-xs text-gray-400">
                        <span><i class="fas fa-user mr-1"></i>{{ $featuredBlog->author }}</span>
                        <span><i class="fas fa-calendar mr-1"></i>{{ $featuredBlog->published_at?->format('d M Y') }}</span>
                        <span><i class="fas fa-clock mr-1"></i>{{ $featuredBlog->read_time }}</span>
                    </div>
                </div>
            </div>
        </a>
    </div>
    @endif

    <!-- Blog Grid -->
    @if($blogs->count() > 0)
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        @foreach($blogs as $blog)
        <a href="{{ route('blogs.show', $blog->slug) }}" class="blog-card bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden flex flex-col">
            <div class="relative overflow-hidden h-44 bg-gradient-to-br from-blue-900 to-indigo-700">
                @if($blog->thumbnail)
                <img src="{{ asset('storage/' . $blog->thumbnail) }}" class="blog-thumb w-full h-full object-cover" alt="{{ $blog->title }}">
                @else
                <div class="w-full h-full flex items-center justify-center">
                    <i class="fas fa-file-alt text-white/20 text-4xl"></i>
                </div>
                @endif
                <span class="absolute top-2 left-2 bg-white/90 text-[10px] font-bold text-gray-700 px-2 py-0.5 rounded-full">
                    {{ $blog->category->name ?? '' }}
                </span>
                @if($blog->featured)
                <span class="absolute top-2 right-2 bg-[#ef4a23] text-white text-[9px] font-bold px-2 py-0.5 rounded-full">⭐ Featured</span>
                @endif
            </div>
            <div class="p-4 flex flex-col flex-1">
                <h3 class="text-sm font-extrabold text-gray-900 mb-2 line-clamp-2 leading-snug">{{ $blog->title }}</h3>
                <p class="text-xs text-gray-500 mb-3 line-clamp-3 flex-1">{{ $blog->excerpt }}</p>
                <div class="flex items-center justify-between text-[10px] text-gray-400 pt-3 border-t border-gray-50">
                    <span><i class="fas fa-user mr-1"></i>{{ $blog->author }}</span>
                    <span><i class="fas fa-clock mr-1"></i>{{ $blog->read_time }}</span>
                    <span><i class="fas fa-calendar mr-1"></i>{{ $blog->published_at?->format('d M Y') }}</span>
                </div>
            </div>
        </a>
        @endforeach
    </div>

    <!-- Pagination -->
    <div class="mt-10">
        {{ $blogs->links() }}
    </div>
    @else
    <div class="text-center py-20">
        <i class="fas fa-newspaper text-5xl text-gray-200 mb-4 block"></i>
        <p class="text-gray-400 font-semibold">No blog posts found in this category.</p>
        <a href="{{ route('blogs.index') }}" class="text-[#ef4a23] font-bold text-sm mt-2 inline-block">← View All Posts</a>
    </div>
    @endif

</div>
@endsection
