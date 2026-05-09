@extends('layouts.admin')

@section('title', 'Messages')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-heading">Customer Messages</h1>
    <p class="text-sm text-body">Manage and respond to customer inquiries</p>
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
                <th scope="col" class="px-6 py-4">Status</th>
                <th scope="col" class="px-6 py-4">From</th>
                <th scope="col" class="px-6 py-4">Subject</th>
                <th scope="col" class="px-6 py-4">Date</th>
                <th scope="col" class="px-6 py-4 text-right">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-default">
            @forelse($messages as $msg)
                <tr class="hover:bg-neutral-primary-soft transition-colors {{ !$msg->is_read ? 'bg-blue-50/30' : '' }}">
                    <td class="px-6 py-4">
                        @if(!$msg->is_read)
                            <span class="flex h-2.5 w-2.5 bg-blue-600 rounded-full"></span>
                        @else
                            <span class="flex h-2.5 w-2.5 bg-gray-300 rounded-full"></span>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        <div class="font-bold text-heading">{{ $msg->name }}</div>
                        <div class="text-[11px] text-gray-500">{{ $msg->email }}</div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="font-medium {{ !$msg->is_read ? 'text-heading font-bold' : 'text-body' }}">{{ $msg->subject }}</div>
                        <div class="text-[11px] text-gray-400 line-clamp-1">{{ $msg->message }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-xs">
                        {{ $msg->created_at->format('d M Y') }}<br>
                        <span class="text-gray-400">{{ $msg->created_at->format('h:i A') }}</span>
                    </td>
                    <td class="px-6 py-4 text-right space-x-3">
                        <a href="{{ route('admin.contacts.show', $msg->id) }}" class="text-blue-600 hover:text-blue-800 font-bold text-xs uppercase">View</a>
                        <form action="{{ route('admin.contacts.destroy', $msg->id) }}" method="POST" class="inline" onsubmit="return confirm('Delete this message?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-800 font-bold text-xs uppercase">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="px-6 py-10 text-center text-gray-500">
                        No messages found.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-6">
    {{ $messages->links() }}
</div>
@endsection
