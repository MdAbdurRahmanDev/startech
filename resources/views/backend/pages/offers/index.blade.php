@extends('layouts.admin')

@section('title', 'Offers Management')

@section('content')
<div class="mb-6 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
    <div>
        <h1 class="text-2xl font-bold text-heading">Promotional Offers</h1>
        <p class="text-sm text-body">Create and manage store campaigns</p>
    </div>
    <a href="{{ route('admin.offers.create') }}" class="inline-flex items-center justify-center px-5 py-2.5 text-sm font-medium text-white bg-fg-brand rounded-base hover:bg-opacity-90 focus:ring-4 focus:ring-brand-light transition-all">
        <i class="fas fa-plus mr-2"></i> Create New Offer
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
                <th scope="col" class="px-6 py-4">Image</th>
                <th scope="col" class="px-6 py-4">Title</th>
                <th scope="col" class="px-6 py-4">Validity</th>
                <th scope="col" class="px-6 py-4">Type</th>
                <th scope="col" class="px-6 py-4">Status</th>
                <th scope="col" class="px-6 py-4 text-right">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-default">
            @forelse($offers as $offer)
                <tr class="hover:bg-neutral-primary-soft transition-colors">
                    <td class="px-6 py-4">
                        <img src="{{ asset('storage/' . $offer->image) }}" class="w-16 h-12 object-cover rounded shadow-sm border border-default">
                    </td>
                    <td class="px-6 py-4">
                        <div class="font-bold text-heading">{{ $offer->title }}</div>
                        <div class="text-[11px] text-gray-500 line-clamp-1">{{ $offer->short_description }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-xs">
                            <span class="text-gray-400">From:</span> {{ $offer->start_date->format('d M Y') }}<br>
                            <span class="text-gray-400">To:</span> {{ $offer->end_date->format('d M Y') }}
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <span class="px-2 py-0.5 rounded text-[10px] font-bold uppercase bg-neutral-tertiary text-heading">
                            {{ $offer->type }}
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        <form action="{{ route('admin.offers.toggle', $offer->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="flex items-center">
                                <div class="relative w-11 h-6 bg-gray-200 rounded-full peer peer-focus:ring-4 peer-focus:ring-brand-light transition-all {{ $offer->status ? 'bg-green-500' : 'bg-gray-300' }}">
                                    <div class="absolute top-[2px] left-[2px] bg-white border-gray-300 border rounded-full h-5 w-5 transition-all {{ $offer->status ? 'translate-x-full border-white' : '' }}"></div>
                                </div>
                                <span class="ms-3 text-xs font-medium {{ $offer->status ? 'text-green-600' : 'text-gray-400' }}">
                                    {{ $offer->status ? 'Active' : 'Inactive' }}
                                </span>
                            </button>
                        </form>
                    </td>
                    <td class="px-6 py-4 text-right space-x-3">
                        <a href="{{ route('admin.offers.edit', $offer->id) }}" class="text-blue-600 hover:text-blue-800 font-bold text-xs uppercase">Edit</a>
                        <form action="{{ route('admin.offers.destroy', $offer->id) }}" method="POST" class="inline" onsubmit="return confirm('Delete this offer?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-800 font-bold text-xs uppercase">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="px-6 py-10 text-center text-gray-500">
                        No promotional offers found.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-6">
    {{ $offers->links() }}
</div>
@endsection
