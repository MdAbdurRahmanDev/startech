@extends('layouts.admin')

@section('title', 'Edit Product | Star Tech')

@section('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
    .ck-editor__editable_inline {
        min-height: 300px;
    }
    .select2-container--default .select2-selection--multiple {
        border-color: #d1d5db;
        border-radius: 0.5rem;
        padding: 0.3rem;
    }
</style>
@endsection

@section('content')
<div class="p-4 bg-white block sm:flex items-center justify-between border-b border-gray-200 lg:mt-1.5">
    <div class="w-full mb-1">
        <div class="mb-4">
            <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl">Edit Product: {{ $product->name }}</h1>
        </div>
    </div>
</div>

<div class="p-4">
    <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')
        
        <!-- Basic Information -->
        <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
            <h2 class="text-lg font-bold mb-4 border-b pb-2">Basic Information</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-6">
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-900">Product Name <span class="text-red-500">*</span></label>
                        <input type="text" name="name" value="{{ old('name', $product->name) }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" required>
                        @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                        <!-- Categories -->
                        <div class="mt-6 mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Categories <span class="text-red-500">*</span></label>
                            <select name="categories[]" id="categories" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 select2" multiple required>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ in_array($category->id, old('categories', $productCategories)) ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('categories')
                                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Brand & Supplier -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Brand</label>
                                <select name="brand_id" id="brand_id" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 select2">
                                    <option value="">Select Brand</option>
                                    @foreach($brands as $brand)
                                        <option value="{{ $brand->id }}" {{ old('brand_id', $product->brand_id) == $brand->id ? 'selected' : '' }}>{{ $brand->name }}</option>
                                    @endforeach
                                </select>
                                @error('brand_id')
                                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Supplier</label>
                                <select name="supplier_id" id="supplier_id" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 select2">
                                    <option value="">Select Supplier</option>
                                    @foreach($suppliers as $supplier)
                                        <option value="{{ $supplier->id }}" {{ old('supplier_id', $product->supplier_id) == $supplier->id ? 'selected' : '' }}>{{ $supplier->name }}</option>
                                    @endforeach
                                </select>
                                @error('supplier_id')
                                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-900">Tags</label>
                        <input type="text" name="tags" value="{{ old('tags', $product->tags) }}" placeholder="Comma separated tags e.g. gaming, laptop, asus" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                        @error('tags') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="space-y-6">
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-900">Thumbnail Image (Main)</label>
                        <div class="flex items-center gap-4 mb-2">
                            @if($product->thumbnail)
                                <img src="{{ asset('storage/' . $product->thumbnail) }}" alt="{{ $product->name }}" class="w-16 h-16 object-cover rounded shadow-sm">
                            @endif
                            <input type="file" name="thumbnail" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none">
                        </div>
                        <p class="text-xs text-gray-500">Leave blank to keep the current image.</p>
                        @error('thumbnail') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-900">Gallery Images (Multiple)</label>
                        @if($product->images && $product->images->count() > 0)
                            <div class="flex flex-wrap gap-2 mb-3">
                                @foreach($product->images as $img)
                                    <div class="relative group">
                                        <img src="{{ asset('storage/' . $img->image) }}" class="w-16 h-16 object-cover rounded shadow-sm border border-gray-200">
                                    </div>
                                @endforeach
                            </div>
                        @endif
                        <input type="file" name="gallery[]" multiple class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none">
                        <p class="text-xs text-gray-500 mt-1">Select additional images to add to the gallery.</p>
                        @error('gallery.*') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-900">Product Video (Optional)</label>
                        <div class="space-y-2">
                            @if($product->video)
                                <div class="flex items-center gap-3 p-2 bg-gray-50 rounded border border-gray-100">
                                    <i class="fas fa-video text-blue-500"></i>
                                    <span class="text-xs text-gray-600 truncate max-w-[200px]">{{ basename($product->video) }}</span>
                                    <a href="{{ asset('storage/' . $product->video) }}" target="_blank" class="text-[10px] bg-blue-100 text-blue-600 px-2 py-0.5 rounded font-bold hover:bg-blue-200 transition-colors">View Current</a>
                                </div>
                            @endif
                            <input type="file" name="video" accept="video/*" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none">
                        </div>
                        <p class="text-[10px] text-gray-400 mt-1">Accepted formats: MP4, MOV, QT. Max size: 20MB. Leave blank to keep current.</p>
                        @error('video') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="flex items-center gap-3 pt-4">
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="is_featured" value="1" class="sr-only peer" {{ old('is_featured', $product->is_featured) ? 'checked' : '' }}>
                            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                            <span class="ml-3 text-sm font-medium text-gray-900">Featured Product</span>
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pricing & Inventory -->
        <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
            <h2 class="text-lg font-bold mb-4 border-b pb-2">Pricing & Inventory</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-900">Buy Price (Cost) <span class="text-red-500">*</span></label>
                    <input type="number" step="0.01" name="buy_price" value="{{ old('buy_price', $product->buy_price) }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" required>
                    @error('buy_price') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-900">Regular Price (Sell) <span class="text-red-500">*</span></label>
                    <input type="number" step="0.01" name="price" value="{{ old('price', $product->price) }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" required>
                    @error('price') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-900">Discount Price</label>
                    <input type="number" step="0.01" name="discount_price" value="{{ old('discount_price', $product->discount_price) }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                    @error('discount_price') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-900">Stock Quantity <span class="text-red-500">*</span></label>
                    <input type="number" name="stock" value="{{ old('stock', $product->stock) }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" required>
                    @error('stock') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>
        </div>

        <!-- Specifications -->
        <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
            <div class="mb-4 border-b pb-2">
                <h2 class="text-lg font-bold">Product Specifications</h2>
                <p class="text-xs text-gray-500 mt-1">Use the editor below to write full product specifications. You can use headings, tables, bold text, and lists.</p>
            </div>
            <textarea name="specifications_text" id="spec-editor">{{ old('specifications_text', $product->specifications_text) }}</textarea>
            @error('specifications_text') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <!-- Description -->
        <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
            <h2 class="text-lg font-bold mb-4 border-b pb-2">Description</h2>
            <div class="space-y-6">
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-900">Short Description</label>
                    <textarea name="short_description" rows="3" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">{{ old('short_description', $product->short_description) }}</textarea>
                    <p class="text-xs text-gray-500 mt-1">A brief summary of the product.</p>
                    @error('short_description') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-900">Full Description</label>
                    <textarea name="description" id="editor" rows="10">{{ old('description', $product->description) }}</textarea>
                    @error('description') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>
        </div>

        <!-- SEO Information -->
        <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
            <h2 class="text-lg font-bold mb-4 border-b pb-2">SEO Settings</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-6">
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-900">Meta Title</label>
                        <input type="text" name="meta_title" value="{{ old('meta_title', $product->meta_title) }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                        @error('meta_title') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-900">Meta Keywords</label>
                        <input type="text" name="meta_keywords" value="{{ old('meta_keywords', $product->meta_keywords) }}" placeholder="Comma separated keywords" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                        @error('meta_keywords') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-900">Meta Image (For Social Sharing)</label>
                        <div class="flex items-center gap-4 mb-2">
                            @if($product->meta_image)
                                <img src="{{ asset('storage/' . $product->meta_image) }}" alt="SEO Image" class="w-16 h-16 object-cover rounded shadow-sm border border-gray-200">
                            @endif
                            <input type="file" name="meta_image" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none">
                        </div>
                        <p class="text-xs text-gray-500">Leave blank to keep current meta image.</p>
                        @error('meta_image') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-900">Meta Description</label>
                    <textarea name="meta_description" rows="5" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">{{ old('meta_description', $product->meta_description) }}</textarea>
                    @error('meta_description') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>
        </div>

        <div class="flex gap-4">
            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-8 py-3 text-center">Update Product</button>
            <a href="{{ route('admin.products.index') }}" class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-8 py-3">Cancel</a>
        </div>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/41.2.0/classic/ckeditor.js"></script>

<script>
    $(document).ready(function() {
        $('#categories').select2({
            placeholder: "Select categories",
            allowClear: true
        });

    ClassicEditor
        .create(document.querySelector('#editor'), {
            toolbar: [ 'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote', 'insertTable', 'undo', 'redo' ]
        })
        .catch(error => { console.error(error); });

    ClassicEditor
        .create(document.querySelector('#spec-editor'), {
            toolbar: [ 'heading', '|', 'bold', 'italic', 'underline', '|', 'bulletedList', 'numberedList', '|', 'insertTable', 'blockQuote', '|', 'undo', 'redo' ]
        })
        .catch(error => { console.error(error); });
</script>
@endsection
