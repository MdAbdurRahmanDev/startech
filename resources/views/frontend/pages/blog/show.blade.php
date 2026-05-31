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
            <img src="{{ $blog->thumbnail_url }}" class="w-full object-cover max-h-96" alt="{{ $blog->title }}">
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

        <!-- Comments Section -->
        <div class="mt-12 pt-8 border-t border-gray-100">
            <h2 class="text-xl font-extrabold text-gray-900 mb-6">Comments</h2>

            @if(session('success'))
            <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg mb-6 flex items-center gap-2">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
            </div>
            @endif

            <!-- Display Comments -->
            @if($blog->comments()->count() > 0)
            <div class="space-y-4 mb-8">
                @foreach($blog->comments as $comment)
                <div class="bg-white border border-gray-100 rounded-lg p-5 shadow-sm">
                    <div class="flex items-start justify-between mb-3">
                        <div>
                            <h4 class="font-bold text-gray-900">{{ $comment->name }}</h4>
                            <p class="text-xs text-gray-400">{{ $comment->created_at?->format('d M Y, h:i A') }}</p>
                        </div>
                    </div>
                    <p class="text-gray-600 text-sm leading-relaxed">{{ $comment->comment }}</p>

                    <!-- Nested Replies -->
                    @if($comment->replies()->count() > 0)
                    <div class="mt-4 pl-4 border-l-2 border-gray-200 space-y-3">
                        @foreach($comment->replies as $reply)
                        <div class="bg-gray-50 rounded p-4">
                            <div class="flex items-start justify-between mb-2">
                                <div>
                                    <h5 class="font-bold text-gray-800 text-sm">{{ $reply->name }}</h5>
                                    <p class="text-xs text-gray-400">{{ $reply->created_at?->format('d M Y, h:i A') }}</p>
                                </div>
                            </div>
                            <p class="text-gray-600 text-sm">{{ $reply->comment }}</p>
                        </div>
                        @endforeach
                    </div>
                    @endif
                </div>
                @endforeach
            </div>
            @else
            <p class="text-gray-500 text-center py-8">There are no comments for this article.</p>
            @endif

            <!-- Comment Form -->
            <div class="bg-white border border-gray-100 rounded-lg p-6 shadow-sm mt-8">
                <h3 class="text-lg font-bold text-gray-900 mb-4">Write a comment</h3>
                <form action="{{ route('blogs.comment.store', $blog->id) }}" method="POST">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div>
                            <label for="name" class="block text-sm font-bold text-gray-700 mb-2">Name <span class="text-red-500">*</span></label>
                            <input type="text" id="name" name="name" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-[#ef4a23] focus:ring-1 focus:ring-[#ef4a23]" placeholder="Your Name" value="{{ old('name') }}">
                            @error('name')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="email" class="block text-sm font-bold text-gray-700 mb-2">Email <span class="text-red-500">*</span></label>
                            <input type="email" id="email" name="email" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-[#ef4a23] focus:ring-1 focus:ring-[#ef4a23]" placeholder="your@email.com" value="{{ old('email') }}">
                            @error('email')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-4">
                        <label for="comment" class="block text-sm font-bold text-gray-700 mb-2">Comment <span class="text-red-500">*</span></label>
                        <textarea id="comment" name="comment" required rows="5" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-[#ef4a23] focus:ring-1 focus:ring-[#ef4a23]" placeholder="Share your thoughts...">{{ old('comment') }}</textarea>
                        @error('comment')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <button type="submit" class="bg-[#ef4a23] text-white font-bold py-3 px-6 rounded-lg hover:bg-orange-600 transition-colors flex items-center gap-2">
                        <i class="fas fa-paper-plane"></i> Submit
                    </button>
                </form>
            </div>
        </div>

        <!-- Back Link -->
        <div class="mt-10 text-center">
            <a href="{{ route('blogs.index') }}" class="inline-flex items-center gap-2 text-sm font-bold text-gray-500 hover:text-[#ef4a23] transition-colors">
                <i class="fas fa-arrow-left text-xs"></i> Back to All Posts
            </a>
        </div>
    </div>
</div>
@endsection
