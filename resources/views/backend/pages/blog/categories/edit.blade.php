@extends('layouts.admin')

@section('title', 'Edit Blog Category')

@section('content')
<div class="p-6 max-w-xl">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Edit Category</h2>
        <a href="{{ route('admin.blog-categories.index') }}" class="text-blue-600 hover:underline text-sm flex items-center gap-1">
            <i class="fas fa-arrow-left text-[10px]"></i> Back to List
        </a>
    </div>

    @if($errors->any())
    <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg mb-4">
        <ul class="list-disc list-inside text-sm space-y-1">
            @foreach($errors->all() as $err)<li>{{ $err }}</li>@endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('admin.blog-categories.update', $blogCategory->id) }}" method="POST" class="bg-white rounded-lg shadow-sm border border-gray-100 p-6 space-y-4">
        @csrf @method('PUT')
        <div>
            <label class="block text-sm font-bold text-gray-700 mb-1">Category Name <span class="text-red-500">*</span></label>
            <input type="text" name="name" value="{{ old('name', $blogCategory->name) }}" required
                   class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>
        <div>
            <label class="block text-sm font-bold text-gray-700 mb-1">Slug <span class="text-gray-400 font-normal">(auto-generated, not editable)</span></label>
            <input type="text" value="{{ $blogCategory->slug }}" disabled class="w-full border border-gray-200 rounded-lg px-4 py-2 bg-gray-50 text-gray-500 text-sm font-mono">
        </div>
        <div>
            <label class="block text-sm font-bold text-gray-700 mb-1">Description</label>
            <textarea name="description" rows="3" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">{{ old('description', $blogCategory->description) }}</textarea>
        </div>
        <div class="flex items-center gap-6">
            <label class="flex items-center gap-2 cursor-pointer">
                <input type="checkbox" name="status" {{ $blogCategory->status ? 'checked' : '' }} class="w-4 h-4 text-blue-600 border-gray-300 rounded">
                <span class="text-sm font-bold text-gray-700">Active</span>
            </label>
            <div class="flex items-center gap-2">
                <span class="text-sm font-bold text-gray-700">Sort Order:</span>
                <input type="number" name="sort_order" value="{{ old('sort_order', $blogCategory->sort_order) }}" class="w-20 border border-gray-300 rounded-lg px-2 py-1 text-sm focus:outline-none">
            </div>
        </div>
        <div class="pt-4 border-t border-gray-100 flex justify-end">
            <button type="submit" class="bg-blue-600 text-white px-8 py-3 rounded-lg font-bold hover:bg-blue-700 transition-colors shadow-lg">
                Update Category
            </button>
        </div>
    </form>
</div>
@endsection
