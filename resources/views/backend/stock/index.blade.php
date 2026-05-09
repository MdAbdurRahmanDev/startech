@extends('layouts.admin')

@section('title', 'Stock History')

@section('content')
<div class="mb-6 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
    <div>
        <h1 class="text-2xl font-bold text-heading">Stock Management</h1>
        <p class="text-sm text-body">View and manage product stock history</p>
    </div>
    <a href="{{ route('admin.stock.create') }}" class="inline-flex items-center justify-center px-5 py-2.5 text-sm font-medium text-white bg-fg-brand rounded-base hover:bg-opacity-90 focus:ring-4 focus:ring-brand-light transition-all">
        <i class="fas fa-plus mr-2"></i> Add New Stock
    </a>
</div>

@if(session('success'))
    <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50" role="alert">
        {{ session('success') }}
    </div>
@endif

<div class="relative overflow-x-auto shadow-sm border border-default rounded-lg">
    <table class="w-full text-sm text-left text-body">
        <thead class="text-xs text-heading uppercase bg-neutral-primary-soft border-b border-default">
            <tr>
                <th scope="col" class="px-6 py-4">Date</th>
                <th scope="col" class="px-6 py-4">Product</th>
                <th scope="col" class="px-6 py-4">Supplier</th>
                <th scope="col" class="px-6 py-4">Qty Added</th>
                <th scope="col" class="px-6 py-4">Remarks</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-default">
            @forelse($histories as $history)
                <tr class="bg-white hover:bg-neutral-primary-soft transition-colors">
                    <td class="px-6 py-4 whitespace-nowrap">
                        {{ $history->created_at->format('d M Y, h:i A') }}
                    </td>
                    <td class="px-6 py-4 font-medium text-heading">
                        <div class="flex items-center">
                            @if($history->product->thumbnail)
                                <img src="{{ asset('storage/' . $history->product->thumbnail) }}" class="w-8 h-8 rounded mr-3 object-contain">
                            @endif
                            <span>{{ $history->product->name }}</span>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        {{ $history->supplier->name ?? 'N/A' }}
                    </td>
                    <td class="px-6 py-4">
                        <span class="px-2.5 py-0.5 rounded-full text-xs font-bold bg-green-100 text-green-800">
                            +{{ $history->quantity }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-xs">
                        {{ $history->remarks ?? '-' }}
                    </td>
                </tr>
            @empty
                <tr class="bg-white">
                    <td colspan="5" class="px-6 py-10 text-center text-gray-500">
                        <i class="fas fa-history text-4xl mb-4 block"></i>
                        No stock history found.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-6">
    {{ $histories->links() }}
</div>
@endsection
