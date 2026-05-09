@extends('layouts.admin')

@section('title', 'Project Quotations')

@section('content')
<div class="mb-6 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
    <div>
        <h1 class="text-2xl font-bold text-heading">Project Quotations</h1>
        <p class="text-sm text-body">Review and manage incoming project estimate requests from clients.</p>
    </div>
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
                <th scope="col" class="px-6 py-4">Client</th>
                <th scope="col" class="px-6 py-4">Project Type</th>
                <th scope="col" class="px-6 py-4">Budget</th>
                <th scope="col" class="px-6 py-4">Status</th>
                <th scope="col" class="px-6 py-4">Submitted</th>
                <th scope="col" class="px-6 py-4 text-right">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-default">
            @forelse($quotations as $quote)
                <tr class="hover:bg-neutral-primary-soft transition-colors">
                    <td class="px-6 py-4">
                        <div class="font-bold text-heading">{{ $quote->name }}</div>
                        <div class="text-[11px] text-gray-400 italic">{{ $quote->email }}</div>
                    </td>
                    <td class="px-6 py-4">
                        <span class="bg-blue-50 text-blue-700 px-2 py-1 rounded text-[10px] font-bold">{{ $quote->project_type }}</span>
                    </td>
                    <td class="px-6 py-4 font-medium text-gray-600">{{ $quote->budget_range }}</td>
                    <td class="px-6 py-4">
                        @php
                            $statusClasses = [
                                'pending' => 'bg-yellow-100 text-yellow-700',
                                'reviewed' => 'bg-blue-100 text-blue-700',
                                'contacted' => 'bg-purple-100 text-purple-700',
                                'completed' => 'bg-green-100 text-green-700',
                            ];
                        @endphp
                        <span class="{{ $statusClasses[$quote->status] }} px-2.5 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider">
                            {{ $quote->status }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-xs text-gray-400">{{ $quote->created_at->diffForHumans() }}</td>
                    <td class="px-6 py-4 text-right space-x-3">
                        <a href="{{ route('admin.quotations.show', $quote->id) }}" class="text-fg-brand hover:underline font-bold text-xs uppercase tracking-wider">View Details</a>
                        <form action="{{ route('admin.quotations.destroy', $quote->id) }}" method="POST" class="inline" onsubmit="return confirm('Delete this quotation request?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-700"><i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="px-6 py-10 text-center text-gray-500">
                        No quotation requests found.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-6">
    {{ $quotations->links() }}
</div>
@endsection
