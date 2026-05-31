@extends('layouts.admin')

@section('title', 'Blog Comments')

@section('content')
<div class="p-6">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Blog Comments (Pending Approval)</h2>
            <p class="text-sm text-gray-500 mt-1">Total: {{ $pendingComments->total() }}</p>
        </div>
    </div>

    @if(session('success'))
        <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg mb-4 flex items-center gap-2">
            <i class="fas fa-check-circle"></i>
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Blog</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Comment</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Submitted</th>
                    <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($pendingComments as $comment)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-4 py-3">
                            <a href="{{ route('blogs.show', $comment->blog->slug) }}" target="_blank" class="text-blue-600 hover:underline font-bold">
                                {{ $comment->blog->title }}
                            </a>
                        </td>
                        <td class="px-4 py-3 text-sm text-gray-700 font-bold">{{ $comment->user->name ?? $comment->name }}</td>
                        <td class="px-4 py-3">
                            <div class="text-sm text-gray-600 max-w-md line-clamp-4">{{ $comment->comment }}</div>
                        </td>
                        <td class="px-4 py-3 text-sm text-gray-500">{{ $comment->created_at->format('d M Y, H:i') }}</td>
                        <td class="px-4 py-3 whitespace-nowrap text-right">
                            <div class="flex justify-end gap-2">
                                <form action="{{ route('admin.blog-comments.approve', $comment->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="bg-green-600 text-white px-3 py-2 rounded-lg text-xs font-bold hover:bg-green-700">
                                        <i class="fas fa-check"></i> Approve
                                    </button>
                                </form>

                                <form action="{{ route('admin.blog-comments.reject', $comment->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="bg-yellow-50 text-yellow-700 border border-yellow-200 px-3 py-2 rounded-lg text-xs font-bold hover:bg-yellow-100">
                                        <i class="fas fa-clock"></i> Pending
                                    </button>
                                </form>

                                <form action="{{ route('admin.blog-comments.destroy', $comment->id) }}" method="POST" onsubmit="return confirm('Delete this comment?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-50 text-red-700 border border-red-100 px-3 py-2 rounded-lg text-xs font-bold hover:bg-red-100">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center text-gray-400">
                            <i class="fas fa-comment-dots text-3xl mb-3 block opacity-30"></i>
                            No pending blog comments.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $pendingComments->links() }}
    </div>
</div>
@endsection

