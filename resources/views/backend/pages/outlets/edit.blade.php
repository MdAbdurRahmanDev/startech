@extends('layouts.admin')

@section('title', 'Edit Outlet')

@section('content')
<div class="p-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Edit Outlet: {{ $outlet->name }}</h2>
        <a href="{{ route('admin.outlets.index') }}" class="text-blue-600 hover:underline text-sm flex items-center gap-1">
            <i class="fas fa-arrow-left text-[10px]"></i> Back to List
        </a>
    </div>

    <form action="{{ route('admin.outlets.update', $outlet->id) }}" method="POST" class="bg-white rounded-lg shadow-sm border border-gray-100 p-6">
        @csrf
        @method('PUT')
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            {{-- Basic Info --}}
            <div class="space-y-4">
                <h3 class="text-sm font-bold text-gray-400 uppercase tracking-wider border-b pb-2">Basic Information</h3>
                
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1">Outlet Name <span class="text-red-500">*</span></label>
                    <input type="text" name="name" value="{{ $outlet->name }}" placeholder="e.g. Narayanganj Branch" required
                           class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1">Full Address <span class="text-red-500">*</span></label>
                    <textarea name="address" rows="3" placeholder="Branch full address..." required
                              class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">{{ $outlet->address }}</textarea>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1">Timing <span class="text-red-500">*</span></label>
                        <input type="text" name="timing" value="{{ $outlet->timing }}" placeholder="e.g. 9 AM - 7 PM" required
                               class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1">Off Day <span class="text-red-500">*</span></label>
                        <input type="text" name="off_day" value="{{ $outlet->off_day }}" placeholder="e.g. Friday Off" required
                               class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1">Map / Direction Link</label>
                    <input type="url" name="map_link" value="{{ $outlet->map_link }}" placeholder="Google Maps URL..."
                           class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div class="flex items-center gap-6 pt-2">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="status" {{ $outlet->status ? 'checked' : '' }} class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                        <span class="text-sm font-bold text-gray-700">Active</span>
                    </label>
                    <div class="flex items-center gap-2">
                        <span class="text-sm font-bold text-gray-700">Sort Order:</span>
                        <input type="number" name="sort_order" value="{{ $outlet->sort_order }}" class="w-20 border border-gray-300 rounded-lg px-2 py-1 text-sm focus:outline-none">
                    </div>
                </div>
            </div>

            {{-- Phone Numbers --}}
            <div class="space-y-4">
                <h3 class="text-sm font-bold text-gray-400 uppercase tracking-wider border-b pb-2">Phone Numbers</h3>
                
                <div class="grid grid-cols-1 gap-4">
                    @php
                        $phones = $outlet->phones ?? [];
                    @endphp
                    <div>
                        <label class="block text-xs font-bold text-gray-500 mb-1 uppercase">Desktop Phone 1</label>
                        <input type="text" name="phones[desktop_1]" value="{{ $phones['desktop_1'] ?? '' }}" placeholder="Desktop 1 phone number..."
                               class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-500 mb-1 uppercase">Desktop Phone 2</label>
                        <input type="text" name="phones[desktop_2]" value="{{ $phones['desktop_2'] ?? '' }}" placeholder="Desktop 2 phone number..."
                               class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-500 mb-1 uppercase">Laptop Phone</label>
                        <input type="text" name="phones[laptop]" value="{{ $phones['laptop'] ?? '' }}" placeholder="Laptop phone number..."
                               class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-500 mb-1 uppercase">Accessories Phone</label>
                        <input type="text" name="phones[accessories]" value="{{ $phones['accessories'] ?? '' }}" placeholder="Accessories phone number..."
                               class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-500 mb-1 uppercase">Corporate Deal</label>
                        <input type="text" name="phones[corporate]" value="{{ $phones['corporate'] ?? '' }}" placeholder="Corporate deal phone number..."
                               class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-8 pt-6 border-t border-gray-100 flex justify-end">
            <button type="submit" class="bg-blue-600 text-white px-8 py-3 rounded-lg font-bold hover:bg-blue-700 transition-colors shadow-lg">
                Update Outlet
            </button>
        </div>
    </form>
</div>
@endsection
