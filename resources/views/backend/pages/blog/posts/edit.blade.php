@extends('layouts.admin')

@section('title', 'Edit Blog Post')

@section('styles')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
@endsection

@section('content')
<div class="p-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Edit Blog Post</h2>
        <a href="{{ route('admin.blogs.index') }}" class="text-blue-600 hover:underline text-sm flex items-center gap-1">
            <i class="fas fa-arrow-left text-[10px]"></i> Back to Posts
        </a>
    </div>

    @if($errors->any())
    <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg mb-4">
        <ul class="list-disc list-inside text-sm space-y-1">
            @foreach($errors->all() as $err)<li>{{ $err }}</li>@endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('admin.blogs.update', $blog->id) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Main Content -->
            <div class="lg:col-span-2 space-y-5">
                <div class="bg-white rounded-lg shadow-sm border border-gray-100 p-6 space-y-4">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1">Post Title <span class="text-red-500">*</span></label>
                        <input type="text" name="title" value="{{ old('title', $blog->title) }}" required
                               class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-blue-500 text-lg font-bold">
                    </div>
                    <div>
                        <label class="block text-xs text-gray-400 mb-0.5 font-mono">Slug: {{ $blog->slug }}</label>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1">Excerpt</label>
                        <textarea name="excerpt" rows="2" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">{{ old('excerpt', $blog->excerpt) }}</textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Content</label>
                        <textarea name="content" id="blog_content" class="w-full border rounded p-2">{{ old('content', $blog->content) }}</textarea>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="space-y-5">
                <div class="bg-white rounded-lg shadow-sm border border-gray-100 p-5 space-y-4">
                    <h3 class="font-bold text-gray-700 text-sm uppercase tracking-wide border-b pb-2">Publish Settings</h3>
                    <div>
                        <label class="block text-xs font-bold text-gray-600 mb-1">Category <span class="text-red-500">*</span></label>
                        <select name="blog_category_id" required class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">
                            <option value="">Select Category</option>
                            @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ (old('blog_category_id', $blog->blog_category_id) == $cat->id) ? 'selected' : '' }}>{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-600 mb-1">Author</label>
                        <input type="text" name="author" value="{{ old('author', $blog->author) }}" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-600 mb-1">Published Date</label>
                        <input type="datetime-local" name="published_at" value="{{ old('published_at', $blog->published_at?->format('Y-m-d\TH:i')) }}" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-600 mb-1">Sort Order</label>
                        <input type="number" name="sort_order" value="{{ old('sort_order', $blog->sort_order) }}" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none">
                    </div>
                    <div class="flex flex-col gap-2">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" name="status" {{ $blog->status ? 'checked' : '' }} class="w-4 h-4 text-blue-600 border-gray-300 rounded">
                            <span class="text-sm font-bold text-gray-700">Published (Active)</span>
                        </label>
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" name="featured" {{ $blog->featured ? 'checked' : '' }} class="w-4 h-4 text-yellow-500 border-gray-300 rounded">
                            <span class="text-sm font-bold text-gray-700">Featured Post</span>
                        </label>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-sm border border-gray-100 p-5">
                    <h3 class="font-bold text-gray-700 text-sm uppercase tracking-wide border-b pb-2 mb-3">Thumbnail</h3>
                    @if($blog->thumbnail)
                    <img src="{{ asset('storage/' . $blog->thumbnail) }}" class="w-full rounded-lg border border-gray-100 object-cover max-h-40 mb-3">
                    @endif
                    <input type="file" name="thumbnail" accept="image/*" id="thumbnail_input"
                           class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-bold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                    <div id="thumb_preview" class="mt-3 hidden">
                        <img id="thumb_img" class="w-full rounded-lg border border-gray-100 object-cover max-h-40">
                    </div>
                </div>

                <button type="submit" class="w-full bg-blue-600 text-white py-3 rounded-lg font-bold hover:bg-blue-700 transition-colors shadow-lg">
                    <i class="fas fa-save mr-2"></i> Update Post
                </button>
            </div>
        </div>
    </form>
</div>

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
<script>
$(document).ready(function() {
    $('#blog_content').summernote({ height: 400, toolbar: [['style',['style']],['font',['bold','italic','underline','clear']],['color',['color']],['para',['ul','ol','paragraph']],['table',['table']],['insert',['link','picture']],['view',['fullscreen','codeview','help']]] });
});
document.getElementById('thumbnail_input').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = ev => { document.getElementById('thumb_img').src = ev.target.result; document.getElementById('thumb_preview').classList.remove('hidden'); };
        reader.readAsDataURL(file);
    }
});
</script>
@endpush
@endsection
