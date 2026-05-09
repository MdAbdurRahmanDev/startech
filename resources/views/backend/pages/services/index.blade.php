@extends('layouts.admin')

@section('title', 'Services Management')

@section('content')
<div class="mb-6 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
    <div>
        <h1 class="text-2xl font-bold text-heading">Our Services</h1>
        <p class="text-sm text-body">Manage Web & App Development services</p>
    </div>
    <a href="{{ route('admin.services.create') }}" class="inline-flex items-center justify-center px-5 py-2.5 text-sm font-medium text-white bg-fg-brand rounded-base hover:bg-opacity-90 focus:ring-4 focus:ring-brand-light transition-all">
        <i class="fas fa-plus mr-2"></i> Add New Service
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
                <th scope="col" class="px-6 py-4">Icon/Image</th>
                <th scope="col" class="px-6 py-4">Service Title</th>
                <th scope="col" class="px-6 py-4">Order</th>
                <th scope="col" class="px-6 py-4">Status</th>
                <th scope="col" class="px-6 py-4 text-right">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-default">
            @forelse($services as $service)
                <tr class="hover:bg-neutral-primary-soft transition-colors">
                    <td class="px-6 py-4">
                        @if($service->image)
                            <img src="{{ asset('storage/' . $service->image) }}" class="w-12 h-12 object-cover rounded shadow-sm">
                        @else
                            <div class="w-12 h-12 flex items-center justify-center bg-neutral-tertiary rounded text-fg-brand">
                                <i class="{{ $service->icon ?? 'fas fa-tools' }} text-xl"></i>
                            </div>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        <div class="font-bold text-heading">{{ $service->title }}</div>
                        <div class="text-[11px] text-gray-400 line-clamp-1">{{ $service->short_description }}</div>
                    </td>
                    <td class="px-6 py-4">{{ $service->order }}</td>
                    <td class="px-6 py-4">
                        <form action="{{ route('admin.services.toggle', $service->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="flex items-center">
                                <div class="relative w-11 h-6 bg-gray-200 rounded-full peer peer-focus:ring-4 peer-focus:ring-brand-light transition-all {{ $service->status ? 'bg-green-500' : 'bg-gray-300' }}">
                                    <div class="absolute top-[2px] left-[2px] bg-white border-gray-300 border rounded-full h-5 w-5 transition-all {{ $service->status ? 'translate-x-full border-white' : '' }}"></div>
                                </div>
                                <span class="ms-3 text-xs font-medium {{ $service->status ? 'text-green-600' : 'text-gray-400' }}">
                                    {{ $service->status ? 'Active' : 'Inactive' }}
                                </span>
                            </button>
                        </form>
                    </td>
                    <td class="px-6 py-4 text-right space-x-3">
                        <a href="{{ route('admin.services.edit', $service->id) }}" class="text-blue-600 hover:text-blue-800 font-bold text-xs uppercase">Edit</a>
                        <form action="{{ route('admin.services.destroy', $service->id) }}" method="POST" class="inline" onsubmit="return confirm('Delete this service?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-800 font-bold text-xs uppercase">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="px-6 py-10 text-center text-gray-500">
                        No services listed yet.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-6">
    {{ $services->links() }}
</div>
@endsection
