@extends('layouts.admin')

@section('title', 'Blog Categories')

@section('content')
<div class="p-6">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Blog Categories</h2>
            <p class="text-sm text-gray-500 mt-1">Manage blog categories. "Expert" category blogs will appear on the Service Center page.</p>
        </div>
        <a href="{{ route('admin.blog-categories.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg font-bold hover:bg-blue-700 transition-colors flex items-center gap-2">
            <i class="fas fa-plus"></i> Add Category
        </a>
    </div>

    @if(session('success'))
    <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg mb-4 flex items-center gap-2">
        <i class="fas fa-check-circle"></i> {{ session('success') }}
    </div>
    @endif

    <div class="bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Sort</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Category Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Slug</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Posts</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($categories as $cat)
                <tr>
                    <td class="px-6 py-4 text-sm text-gray-500">{{ $cat->sort_order }}</td>
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-2">
                            <span class="text-sm font-bold text-gray-900">{{ $cat->name }}</span>
                            @if(strtolower($cat->slug) === 'expert')
                            <span class="bg-orange-100 text-orange-600 text-[10px] font-bold px-2 py-0.5 rounded-full uppercase">Service Center</span>
                            @endif
                        </div>
                        @if($cat->description)
                        <div class="text-xs text-gray-400 mt-0.5">{{ Str::limit($cat->description, 60) }}</div>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-xs text-gray-500 font-mono">{{ $cat->slug }}</td>
                    <td class="px-6 py-4">
                        <span class="bg-blue-50 text-blue-700 text-xs font-bold px-2 py-1 rounded">{{ $cat->blogs_count }} posts</span>
                    </td>
                    <td class="px-6 py-4">
                        <span class="px-3 py-1 rounded-full text-xs font-bold uppercase {{ $cat->status ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ $cat->status ? 'Active' : 'Inactive' }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right">
                        <div class="flex justify-end gap-2">
                            <a href="{{ route('admin.blog-categories.edit', $cat->id) }}" class="text-blue-600 hover:text-blue-900 bg-blue-50 p-2 rounded-lg transition-colors">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.blog-categories.destroy', $cat->id) }}" method="POST" onsubmit="return confirm('Delete this category? All blogs in it will also be deleted!')">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900 bg-red-50 p-2 rounded-lg transition-colors">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-12 text-center text-gray-400 text-sm">
                        <i class="fas fa-folder-open text-3xl mb-3 block opacity-30"></i>
                        No categories yet. <a href="{{ route('admin.blog-categories.create') }}" class="text-blue-600 font-bold">Add the first one.</a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
