@extends('layouts.admin')

@section('title', 'Manage Banners | Iosbd')

@section('content')
    <div class="max-w-6xl mx-auto py-8">
        <div class="mb-8 flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Banner Management</h1>
                <p class="text-gray-600">Add, delete, or manage your sliders and promotional banners.</p>
            </div>
            <button onclick="document.getElementById('addBannerModal').classList.remove('hidden')"
                class="bg-primary-dark text-white px-6 py-2.5 rounded-lg font-bold hover:bg-opacity-90 transition-all flex items-center gap-2 shadow-sm">
                <i class="fas fa-plus"></i>
                Add New Banner
            </button>
        </div>

        @if ($errors->any())
            <div class="bg-red-50 text-red-700 p-4 rounded-lg mb-6 border border-red-100 shadow-sm">
                <ul class="list-disc list-inside text-sm font-medium">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('success'))
            <div
                class="bg-green-50 text-green-700 p-4 rounded-lg mb-6 flex items-center gap-3 border border-green-100 shadow-sm">
                <i class="fas fa-check-circle"></i>
                {{ session('success') }}
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($banners as $banner)
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden group">
                    <div class="relative h-40 bg-gray-100 overflow-hidden">
                        <img src="{{ asset('storage/' . $banner->image) }}" alt="Banner"
                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        <div class="absolute top-2 right-2 flex gap-2">
                            <span
                                class="px-2.5 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider {{ $banner->type == 'slider' ? 'bg-blue-100 text-blue-600' : 'bg-purple-100 text-purple-600' }}">
                                {{ $banner->type }}
                            </span>
                            <span
                                class="px-2.5 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider {{ $banner->status ? 'bg-green-100 text-green-600' : 'bg-red-100 text-red-600' }}">
                                {{ $banner->status ? 'Active' : 'Inactive' }}
                            </span>
                        </div>
                    </div>
                    <div class="p-4 flex justify-between items-center bg-white">
                        <div class="text-xs text-gray-400">
                            <i class="fas fa-link mr-1"></i> {{ $banner->link ? 'Linked' : 'No link' }}
                        </div>
                        <div class="flex gap-2">
                            <form action="{{ route('admin.banners.toggle', $banner) }}" method="POST">
                                @csrf
                                <button type="submit"
                                    class="w-9 h-9 rounded-lg border border-gray-100 flex items-center justify-center hover:bg-gray-50 transition-all shadow-sm"
                                    title="Toggle Status">
                                    <i
                                        class="fas fa-power-off text-sm {{ $banner->status ? 'text-green-500' : 'text-gray-400' }}"></i>
                                </button>
                            </form>
                            <form action="{{ route('admin.banners.destroy', $banner) }}" method="POST"
                                onsubmit="return confirm('Are you sure you want to delete this banner?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="w-9 h-9 rounded-lg border border-red-50 flex items-center justify-center text-red-400 hover:bg-red-500 hover:text-white transition-all shadow-sm"
                                    title="Delete Banner">
                                    <i class="fas fa-trash-alt text-sm"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-12 text-center bg-white rounded-xl border border-dashed border-gray-300">
                    <i class="fas fa-image text-4xl text-gray-200 mb-4"></i>
                    <p class="text-gray-400">No banners found. Start by adding one!</p>
                </div>
            @endforelse
        </div>
    </div>

    <!-- Modal -->
    <div id="addBannerModal"
        class="fixed inset-0 bg-black bg-opacity-50 z-[100] hidden flex items-center justify-center p-4">
        <div class="bg-white w-full max-w-md rounded-xl shadow-2xl overflow-hidden animate-fade-in">
            <div class="p-6 border-b border-gray-100 flex justify-between items-center">
                <h3 class="text-lg font-bold text-gray-800">Add New Banner</h3>
                <button onclick="document.getElementById('addBannerModal').classList.add('hidden')"
                    class="text-gray-400 hover:text-gray-600">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <form action="{{ route('admin.banners.store') }}" method="POST" enctype="multipart/form-data"
                class="p-6 space-y-5">
                @csrf
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Banner Image</label>
                    <input type="file" name="image" required
                        class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-orange-50 file:text-accent-orange hover:file:bg-orange-100">
                    <p class="text-[11px] text-gray-400 mt-2 italic">Recommended for slider: 982x500px. Side: 400x240px.</p>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Banner Type</label>
                    <select name="type"
                        class="w-full bg-gray-50 border border-gray-200 rounded-lg px-4 py-2.5 outline-none focus:border-accent-orange transition-all">
                        <option value="slider">Main Hero Slider</option>
                        <option value="side">Side Promotional Banner</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Target Link (Optional)</label>
                    <input type="text" name="link"
                        class="w-full bg-gray-50 border border-gray-200 rounded-lg px-4 py-2.5 outline-none focus:border-accent-orange transition-all"
                        placeholder="https://example.com/product">
                </div>

                <div class="pt-4 flex gap-3">
                    <button type="button" onclick="document.getElementById('addBannerModal').classList.add('hidden')"
                        class="flex-1 px-4 py-2.5 rounded-lg font-bold text-gray-500 border border-gray-200 hover:bg-gray-50 transition-all">Cancel</button>
                    <button type="submit"
                        class="flex-1 bg-accent-orange text-white px-4 py-2.5 rounded-lg font-bold hover:bg-opacity-90 shadow-md transition-all">Save
                        Banner</button>
                </div>
            </form>
        </div>
    </div>

    <style>
        @keyframes fade-in {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in {
            animation: fade-in 0.3s ease-out;
        }
    </style>
@endsection
