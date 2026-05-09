@extends('layouts.admin')

@section('title', 'Manage Categories | Star Tech')

@section('content')
<div class="max-w-6xl mx-auto py-8 px-4">
    <div class="mb-8 flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Category Management</h1>
            <p class="text-gray-600">Create and manage multi-level categories (Main, Sub, Sub-Sub).</p>
        </div>
        <button onclick="document.getElementById('addCategoryModal').classList.remove('hidden')" class="bg-primary-dark text-white px-6 py-2.5 rounded-lg font-bold hover:bg-opacity-90 transition-all flex items-center gap-2 shadow-sm">
            <i class="fas fa-plus"></i>
            Add New Category
        </button>
    </div>

    @if(session('success'))
        <div class="bg-green-50 text-green-700 p-4 rounded-lg mb-6 flex items-center gap-3 border border-green-100 shadow-sm">
            <i class="fas fa-check-circle"></i>
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-gray-50 border-b border-gray-100">
                    <tr>
                        <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider">Name & Icon</th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider">Level</th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider">Featured</th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider">Order</th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($categories as $category)
                        <!-- Main Category -->
                        <tr class="hover:bg-gray-50 transition-colors bg-white">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded bg-orange-50 flex items-center justify-center text-accent-orange overflow-hidden">
                                        @if($category->image)
                                            <img src="{{ asset('storage/' . $category->image) }}" class="w-full h-full object-cover">
                                        @else
                                            <i class="{{ $category->icon ?? 'fas fa-folder' }}"></i>
                                        @endif
                                    </div>
                                    <span class="font-bold text-gray-800">{{ $category->name }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4"><span class="px-2 py-1 rounded-full text-[10px] font-bold uppercase bg-blue-100 text-blue-600">Main</span></td>
                            <td class="px-6 py-4">
                                </form>
                            </td>
                            <td class="px-6 py-4">
                                <form action="{{ route('admin.categories.featured', $category) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="flex items-center gap-1 {{ $category->is_featured ? 'text-orange-500' : 'text-gray-300' }}">
                                        <i class="fas fa-star"></i>
                                        <span class="text-xs font-medium">{{ $category->is_featured ? 'Yes' : 'No' }}</span>
                                    </button>
                                </form>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500">{{ $category->order }}</td>
                            <td class="px-6 py-4">
                                <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" onsubmit="return confirm('Delete this category and all its children?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-red-400 hover:text-red-600 transition-colors"><i class="fas fa-trash-alt"></i></button>
                                </form>
                            </td>
                        </tr>

                        <!-- Sub Categories -->
                        @foreach($category->children as $sub)
                            <tr class="hover:bg-gray-50 transition-colors bg-gray-50/30">
                                <td class="px-6 py-3 pl-14">
                                    <div class="flex items-center gap-3">
                                        <i class="fas fa-chevron-right text-[10px] text-gray-300"></i>
                                        <div class="w-7 h-7 rounded bg-blue-50 flex items-center justify-center text-blue-500 overflow-hidden">
                                            @if($sub->image)
                                                <img src="{{ asset('storage/' . $sub->image) }}" class="w-full h-full object-cover">
                                            @else
                                                <i class="{{ $sub->icon ?? 'fas fa-folder-open' }}"></i>
                                            @endif
                                        </div>
                                        <span class="font-semibold text-gray-700">{{ $sub->name }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-3"><span class="px-2 py-1 rounded-full text-[10px] font-bold uppercase bg-purple-100 text-purple-600">Sub</span></td>
                                <td class="px-6 py-3">
                                    <form action="{{ route('admin.categories.toggle', $sub) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="flex items-center gap-1 {{ $sub->status ? 'text-green-600' : 'text-red-400' }}">
                                            <i class="fas fa-toggle-{{ $sub->status ? 'on' : 'off' }}"></i>
                                            <span class="text-xs font-medium">{{ $sub->status ? 'Active' : 'Inactive' }}</span>
                                        </button>
                                    </form>
                                </td>
                                <td class="px-6 py-3">
                                    <form action="{{ route('admin.categories.featured', $sub) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="flex items-center gap-1 {{ $sub->is_featured ? 'text-orange-500' : 'text-gray-300' }}">
                                            <i class="fas fa-star text-[10px]"></i>
                                            <span class="text-[10px] font-medium">{{ $sub->is_featured ? 'Yes' : 'No' }}</span>
                                        </button>
                                    </form>
                                </td>
                                <td class="px-6 py-3 text-sm text-gray-500">{{ $sub->order }}</td>
                                <td class="px-6 py-3">
                                    <form action="{{ route('admin.categories.destroy', $sub) }}" method="POST" onsubmit="return confirm('Delete this sub-category?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-red-400 hover:text-red-600 transition-colors"><i class="fas fa-trash-alt"></i></button>
                                    </form>
                                </td>
                            </tr>

                            <!-- Sub-Sub Categories -->
                            @foreach($sub->children as $subSub)
                                <tr class="hover:bg-gray-50 transition-colors bg-white">
                                    <td class="px-6 py-2 pl-24">
                                        <div class="flex items-center gap-3">
                                            <i class="fas fa-chevron-right text-[10px] text-gray-200"></i>
                                            @if($subSub->image)
                                                <img src="{{ asset('storage/' . $subSub->image) }}" class="w-4 h-4 object-cover rounded-sm">
                                            @endif
                                            <span class="text-gray-600 text-sm">{{ $subSub->name }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-2"><span class="px-2 py-1 rounded-full text-[10px] font-bold uppercase bg-gray-100 text-gray-500">Sub-Sub</span></td>
                                    <td class="px-6 py-2">
                                        <form action="{{ route('admin.categories.toggle', $subSub) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="flex items-center gap-1 {{ $subSub->status ? 'text-green-600' : 'text-red-400' }}">
                                                <i class="fas fa-toggle-{{ $subSub->status ? 'on' : 'off' }}"></i>
                                            </button>
                                        </form>
                                    </td>
                                    <td class="px-6 py-2">
                                        <form action="{{ route('admin.categories.featured', $subSub) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="flex items-center gap-1 {{ $subSub->is_featured ? 'text-orange-500' : 'text-gray-300' }}">
                                                <i class="fas fa-star text-[10px]"></i>
                                            </button>
                                        </form>
                                    </td>
                                    <td class="px-6 py-2 text-xs text-gray-400">{{ $subSub->order }}</td>
                                    <td class="px-6 py-2">
                                        <form action="{{ route('admin.categories.destroy', $subSub) }}" method="POST">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="text-gray-300 hover:text-red-500 transition-colors"><i class="fas fa-trash-alt"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @endforeach
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-gray-400">No categories found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal -->
<div id="addCategoryModal" class="fixed inset-0 bg-black bg-opacity-50 z-[100] hidden flex items-center justify-center p-4">
    <div class="bg-white w-full max-w-md rounded-xl shadow-2xl overflow-hidden animate-fade-in">
        <div class="p-6 border-b border-gray-100 flex justify-between items-center">
            <h3 class="text-lg font-bold text-gray-800">Add New Category</h3>
            <button onclick="document.getElementById('addCategoryModal').classList.add('hidden')" class="text-gray-400 hover:text-gray-600">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-5">
            @csrf
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Category Name</label>
                <input type="text" name="name" required class="w-full bg-gray-50 border border-gray-200 rounded-lg px-4 py-2.5 outline-none focus:border-accent-orange transition-all" placeholder="e.g. Laptop, Graphics Card">
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Parent Category (Optional)</label>
                <select name="parent_id" class="w-full bg-gray-50 border border-gray-200 rounded-lg px-4 py-2.5 outline-none focus:border-accent-orange transition-all">
                    <option value="">None (Main Category)</option>
                    @foreach($allCategories as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                    @endforeach
                </select>
                <p class="text-[11px] text-gray-400 mt-2 italic">Select a parent to create a Sub or Sub-Sub category.</p>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Icon (FA Class)</label>
                    <input type="text" name="icon" class="w-full bg-gray-50 border border-gray-200 rounded-lg px-4 py-2.5 outline-none focus:border-accent-orange transition-all" placeholder="fas fa-laptop">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Sort Order</label>
                    <input type="number" name="order" value="0" class="w-full bg-gray-50 border border-gray-200 rounded-lg px-4 py-2.5 outline-none focus:border-accent-orange transition-all">
                </div>
            </div>

            <div class="flex items-center gap-2">
                <input type="checkbox" name="is_featured" id="is_featured" value="1" class="w-4 h-4 text-accent-orange border-gray-300 rounded focus:ring-accent-orange">
                <label for="is_featured" class="text-sm font-semibold text-gray-700">Feature this category on home page</label>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Upload Icon Image (Optional)</label>
                <input type="file" name="image" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-orange-50 file:text-accent-orange hover:file:bg-orange-100">
            </div>

            <div class="pt-4 flex gap-3">
                <button type="button" onclick="document.getElementById('addCategoryModal').classList.add('hidden')" class="flex-1 px-4 py-2.5 rounded-lg font-bold text-gray-500 border border-gray-200 hover:bg-gray-50 transition-all">Cancel</button>
                <button type="submit" class="flex-1 bg-primary-dark text-white px-4 py-2.5 rounded-lg font-bold hover:bg-opacity-90 shadow-md transition-all">Create Category</button>
            </div>
        </form>
    </div>
</div>

<style>
@keyframes fade-in {
    from { opacity: 0; transform: translateY(-20px); }
    to { opacity: 1; transform: translateY(0); }
}
.animate-fade-in { animation: fade-in 0.3s ease-out; }
</style>
@endsection
