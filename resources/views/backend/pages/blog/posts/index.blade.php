@extends('layouts.admin')

@section('title', 'Blog Posts')

@section('content')
<div class="p-6">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Blog Posts</h2>
            <p class="text-sm text-gray-500 mt-1">Total: {{ $blogs->total() }} posts</p>
        </div>
        <div class="flex gap-2">
            <a href="{{ route('admin.blog-categories.index') }}" class="bg-gray-100 text-gray-700 px-4 py-2 rounded-lg font-bold hover:bg-gray-200 transition-colors flex items-center gap-2 text-sm">
                <i class="fas fa-tags"></i> Categories
            </a>
            <a href="{{ route('admin.blogs.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg font-bold hover:bg-blue-700 transition-colors flex items-center gap-2">
                <i class="fas fa-plus"></i> New Post
            </a>
        </div>
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
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-16">Thumb</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Category</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Author</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Published</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($blogs as $blog)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-4 py-3">
                        @if($blog->thumbnail)
                        <img src="{{ asset('storage/' . $blog->thumbnail) }}" class="w-12 h-10 object-cover rounded-lg border border-gray-100">
                        @else
                        <div class="w-12 h-10 bg-gradient-to-br from-blue-800 to-indigo-700 rounded-lg flex items-center justify-center">
                            <i class="fas fa-file-alt text-white text-xs"></i>
                        </div>
                        @endif
                    </td>
                    <td class="px-4 py-3">
                        <div class="text-sm font-bold text-gray-900 line-clamp-1">{{ $blog->title }}</div>
                        <div class="text-xs text-gray-400 mt-0.5 line-clamp-1">{{ $blog->excerpt }}</div>
                        @if($blog->featured)
                        <span class="bg-yellow-100 text-yellow-700 text-[10px] font-bold px-1.5 py-0.5 rounded mt-0.5 inline-block">Featured</span>
                        @endif
                    </td>
                    <td class="px-4 py-3">
                        <span class="bg-blue-50 text-blue-700 text-xs font-bold px-2 py-1 rounded">
                            {{ $blog->category->name ?? '—' }}
                        </span>
                    </td>
                    <td class="px-4 py-3 text-xs text-gray-500">{{ $blog->author }}</td>
                    <td class="px-4 py-3 text-xs text-gray-500">{{ $blog->published_at?->format('d M Y') ?? '—' }}</td>
                    <td class="px-4 py-3">
                        <button onclick="toggleStatus({{ $blog->id }})" id="status-btn-{{ $blog->id }}"
                            class="px-3 py-1 rounded-full text-xs font-bold uppercase {{ $blog->status ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ $blog->status ? 'Active' : 'Inactive' }}
                        </button>
                    </td>
                    <td class="px-4 py-3 whitespace-nowrap text-right">
                        <div class="flex justify-end gap-2">
                            <a href="{{ route('blogs.show', $blog->slug) }}" target="_blank" class="text-gray-500 hover:text-gray-900 bg-gray-50 p-2 rounded-lg transition-colors" title="View">
                                <i class="fas fa-eye text-xs"></i>
                            </a>
                            <a href="{{ route('admin.blogs.edit', $blog->id) }}" class="text-blue-600 hover:text-blue-900 bg-blue-50 p-2 rounded-lg transition-colors">
                                <i class="fas fa-edit text-xs"></i>
                            </a>
                            <form action="{{ route('admin.blogs.destroy', $blog->id) }}" method="POST" onsubmit="return confirm('Delete this blog post?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900 bg-red-50 p-2 rounded-lg transition-colors">
                                    <i class="fas fa-trash text-xs"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-6 py-12 text-center text-gray-400 text-sm">
                        <i class="fas fa-newspaper text-3xl mb-3 block opacity-30"></i>
                        No blog posts yet. <a href="{{ route('admin.blogs.create') }}" class="text-blue-600 font-bold">Write the first post.</a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $blogs->links() }}
    </div>
</div>

@push('scripts')
<script>
function toggleStatus(id) {
    fetch(`/admin/blogs/${id}/toggle-status`, {
        method: 'POST',
        headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
    }).then(r => r.json()).then(data => {
        const btn = document.getElementById(`status-btn-${id}`);
        if (data.status) {
            btn.innerText = 'Active';
            btn.className = 'px-3 py-1 rounded-full text-xs font-bold uppercase bg-green-100 text-green-800';
        } else {
            btn.innerText = 'Inactive';
            btn.className = 'px-3 py-1 rounded-full text-xs font-bold uppercase bg-red-100 text-red-800';
        }
    });
}
</script>
@endpush
@endsection
