@extends('layouts.admin')

@section('title', 'CMS Pages')

@section('content')
<div class="mb-6 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
    <div>
        <h1 class="text-2xl font-bold text-heading">CMS Pages</h1>
        <p class="text-sm text-body">Manage dynamic content pages like Privacy Policy, Terms, etc.</p>
    </div>
    <a href="{{ route('admin.cms.create') }}" class="inline-flex items-center justify-center px-5 py-2.5 text-sm font-medium text-white bg-fg-brand rounded-base hover:bg-opacity-90 transition-all">
        <i class="fas fa-plus mr-2"></i> Create New Page
    </a>
</div>

@if(session('success'))
    <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50" role="alert">
        {{ session('success') }}
    </div>
@endif

<div class="bg-white border border-default rounded-lg shadow-sm overflow-hidden">
    <table class="w-full text-sm text-left text-body">
        <thead class="text-xs text-heading uppercase bg-neutral-primary-soft border-b border-default">
            <tr>
                <th scope="col" class="px-6 py-4">Title</th>
                <th scope="col" class="px-6 py-4">Slug</th>
                <th scope="col" class="px-6 py-4">Last Updated</th>
                <th scope="col" class="px-6 py-4 text-right">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-default">
            @forelse($pages as $page)
                <tr class="hover:bg-neutral-primary-soft transition-colors">
                    <td class="px-6 py-4 font-bold text-heading">{{ $page->title }}</td>
                    <td class="px-6 py-4 text-gray-500 text-xs">/{{ $page->slug }}</td>
                    <td class="px-6 py-4 text-xs text-gray-400">{{ $page->updated_at->format('d M Y, h:i A') }}</td>
                    <td class="px-6 py-4 text-right space-x-3">
                        <a href="{{ route('admin.cms.edit', $page->id) }}" class="text-blue-600 hover:text-blue-800 font-bold text-xs uppercase">Edit</a>
                        <form action="{{ route('admin.cms.destroy', $page->id) }}" method="POST" class="inline" onsubmit="return confirm('Delete this page?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-800 font-bold text-xs uppercase">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="px-6 py-10 text-center text-gray-500">
                        No pages created yet.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-6">
    {{ $pages->links() }}
</div>
@endsection
