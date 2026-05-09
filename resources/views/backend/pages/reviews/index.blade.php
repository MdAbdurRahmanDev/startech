@extends('layouts.admin')

@section('title', 'Product Reviews')

@section('content')
<div class="mb-6 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
    <div>
        <h1 class="text-2xl font-bold text-heading">Product Reviews</h1>
        <p class="text-sm text-body">Manage customer feedback and star ratings.</p>
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
                <th scope="col" class="px-6 py-4">Product</th>
                <th scope="col" class="px-6 py-4">Customer</th>
                <th scope="col" class="px-6 py-4 text-center">Rating</th>
                <th scope="col" class="px-6 py-4">Review</th>
                <th scope="col" class="px-6 py-4">Date</th>
                <th scope="col" class="px-6 py-4 text-right">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-default">
            @forelse($reviews as $review)
                <tr class="hover:bg-neutral-primary-soft transition-colors">
                    <td class="px-6 py-4">
                        <div class="font-bold text-heading truncate max-w-[180px]">{{ $review->product->name }}</div>
                        <div class="text-[10px] text-gray-400">#{{ $review->product->id }}</div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="font-bold text-heading">{{ $review->user->name }}</div>
                        <div class="text-[10px] text-gray-400">{{ $review->user->email }}</div>
                    </td>
                    <td class="px-6 py-4 text-center">
                        <div class="flex items-center justify-center text-yellow-500 text-xs">
                            @for($i=1; $i<=5; $i++)
                                <i class="{{ $i <= $review->rating ? 'fas' : 'far' }} fa-star"></i>
                            @endfor
                        </div>
                        <div class="text-[10px] font-bold mt-1 text-gray-500">{{ $review->rating }}/5</div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="text-body max-w-[300px] whitespace-normal line-clamp-2 italic" title="{{ $review->review }}">
                            "{{ $review->review }}"
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-[11px] text-gray-500">
                        {{ $review->created_at->format('d M Y') }}<br>
                        {{ $review->created_at->diffForHumans() }}
                    </td>
                    <td class="px-6 py-4 text-right">
                        <form action="{{ route('admin.reviews.destroy', $review->id) }}" method="POST" class="inline" onsubmit="return confirm('Delete this review?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-800 font-bold text-xs uppercase tracking-wider">
                                <i class="fas fa-trash-alt mr-1"></i> Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                        <div class="flex flex-col items-center gap-2">
                            <i class="far fa-star text-4xl text-gray-300"></i>
                            <p>No product reviews found yet.</p>
                        </div>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-6">
    {{ $reviews->links() }}
</div>
@endsection
