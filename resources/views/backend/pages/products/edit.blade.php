@extends('layouts.admin')

@section('title', 'Edit Product | IOS BD')

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
        <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data"
            class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Layout Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                
                <!-- Left Column (Main Info) -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Basic Information -->
                    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
                        <h2 class="text-lg font-bold mb-4 border-b pb-2">Basic Information</h2>
                        
                        <div class="mb-4">
                            <label class="block mb-2 text-sm font-medium text-gray-900">Product Name <span class="text-red-500">*</span></label>
                            <input type="text" name="name" value="{{ old('name', $product->name) }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                required>
                            @error('name')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Categories <span class="text-red-500">*</span></label>
                            <select name="categories[]" id="categories"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 select2"
                                multiple required>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ in_array($category->id, old('categories', $productCategories)) ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('categories')
                                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Brand</label>
                                <select name="brand_id" id="brand_id"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 select2">
                                    <option value="">Select Brand</option>
                                    @foreach ($brands as $brand)
                                        <option value="{{ $brand->id }}"
                                            {{ old('brand_id', $product->brand_id) == $brand->id ? 'selected' : '' }}>
                                            {{ $brand->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Supplier</label>
                                <select name="supplier_id" id="supplier_id"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 select2">
                                    <option value="">Select Supplier</option>
                                    @foreach ($suppliers as $supplier)
                                        <option value="{{ $supplier->id }}"
                                            {{ old('supplier_id', $product->supplier_id) == $supplier->id ? 'selected' : '' }}>
                                            {{ $supplier->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-900">Tags</label>
                                <input type="text" name="tags" value="{{ old('tags', $product->tags) }}"
                                    placeholder="e.g. gaming, laptop, asus"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Laptop Purpose</label>
                                <select name="laptop_purpose_id" id="laptop_purpose_id"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 select2">
                                    <option value="">Select Purpose (Optional)</option>
                                    @foreach ($laptopPurposes as $purpose)
                                        <option value="{{ $purpose->id }}"
                                            {{ old('laptop_purpose_id', $product->laptop_purpose_id) == $purpose->id ? 'selected' : '' }}>
                                            {{ $purpose->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Pricing & Inventory -->
                    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
                        <h2 class="text-lg font-bold mb-4 border-b pb-2">Pricing & Inventory</h2>
                        <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4">
                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-900">Buy Price</label>
                                <input type="number" step="0.01" name="buy_price" value="{{ old('buy_price', $product->buy_price) }}"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                            </div>
                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-900">Regular Price</label>
                                <input type="number" step="0.01" name="price" value="{{ old('price', $product->price) }}"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                            </div>
                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-900">Discount Price</label>
                                <input type="number" step="0.01" name="discount_price" value="{{ old('discount_price', $product->discount_price) }}"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                            </div>
                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-900">Stock Quantity</label>
                                <input type="number" name="stock" value="{{ old('stock', $product->stock) }}"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                            </div>
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
                        <h2 class="text-lg font-bold mb-4 border-b pb-2">Description</h2>
                        <div class="space-y-4">
                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-900">Short Description</label>
                                <textarea name="short_description" rows="3"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">{{ old('short_description', $product->short_description) }}</textarea>
                            </div>
                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-900">Full Description</label>
                                <textarea name="description" id="editor" rows="10">{{ old('description', $product->description) }}</textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Specifications -->
                    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
                        <h2 class="text-lg font-bold mb-4 border-b pb-2">Product Specifications</h2>
                        <textarea name="specifications_text" id="spec-editor">{{ old('specifications_text', $product->specifications_text) }}</textarea>
                    </div>

                    <!-- SEO Information -->
                    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
                        <h2 class="text-lg font-bold mb-4 border-b pb-2">SEO Settings</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-4">
                                <div>
                                    <label class="block mb-2 text-sm font-medium text-gray-900">Meta Title</label>
                                    <textarea name="meta_title" rows="2"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">{{ old('meta_title', $product->meta_title) }}</textarea>
                                </div>
                                <div>
                                    <label class="block mb-2 text-sm font-medium text-gray-900">Meta Keywords</label>
                                    <textarea name="meta_keywords" rows="3"
                                        placeholder="Comma separated keywords"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">{{ old('meta_keywords', $product->meta_keywords) }}</textarea>
                                </div>
                                <div>
                                    <label class="block mb-2 text-sm font-medium text-gray-900">Meta Image</label>
                                    <div class="flex items-center gap-4 mb-2">
                                        @if ($product->meta_image)
                                            <img src="{{ asset('storage/' . $product->meta_image) }}" alt="SEO Image"
                                                class="w-16 h-16 object-cover rounded shadow-sm border border-gray-200">
                                        @endif
                                        <input type="file" name="meta_image"
                                            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none p-1">
                                    </div>
                                    <p class="text-xs text-gray-500">Leave blank to keep current image.</p>
                                </div>
                            </div>
                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-900">Meta Description</label>
                                <textarea name="meta_description" rows="8"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">{{ old('meta_description', $product->meta_description) }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column (Media & Flags) -->
                <div class="space-y-6">
                    <!-- Media Section -->
                    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
                        <h2 class="text-lg font-bold mb-4 border-b pb-2">Product Media</h2>
                        
                        <div class="mb-6">
                            <label class="block mb-2 text-sm font-medium text-gray-900">Thumbnail Image (Main)</label>
                            <div class="mb-4">
                                <div id="thumbnail-preview" class="relative w-32 h-32 rounded-lg border border-gray-200 flex items-center justify-center overflow-hidden bg-gray-50">
                                    @if ($product->thumbnail)
                                        <img id="thumb-img" src="{{ asset('storage/' . $product->thumbnail) }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                                        <i id="thumb-placeholder" class="hidden fas fa-image text-3xl text-gray-300"></i>
                                    @else
                                        <img id="thumb-img" src="#" alt="Thumbnail" class="hidden w-full h-full object-cover">
                                        <i id="thumb-placeholder" class="fas fa-image text-3xl text-gray-300"></i>
                                    @endif
                                    <button type="button" onclick="removeThumbnail()" class="absolute top-1 right-1 bg-red-500 text-white rounded-full w-5 h-5 flex items-center justify-center text-[10px] hover:bg-red-600 shadow-sm">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <input type="file" name="thumbnail" id="thumbnail-input" onchange="previewThumbnail(this)"
                                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none p-1">
                            <p class="text-[10px] text-gray-400 mt-1 italic">Leave blank to keep current thumbnail.</p>
                        </div>

                        <div class="mb-6">
                            <label class="block mb-2 text-sm font-medium text-gray-900">Gallery Images</label>
                            <div class="space-y-4 mb-3">
                                @if ($product->images && $product->images->count() > 0)
                                    <div>
                                        <p class="text-[10px] font-bold text-gray-400 uppercase mb-2">Current Gallery</p>
                                        <div class="flex flex-wrap gap-2">
                                            @foreach ($product->images as $img)
                                                <div class="relative group w-12 h-12 rounded border border-gray-200 overflow-hidden shadow-sm">
                                                    <img src="{{ asset('storage/' . $img->image) }}" class="w-full h-full object-cover">
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                                <div>
                                    <p class="text-[10px] font-bold text-gray-400 uppercase mb-2">New Images</p>
                                    <div id="gallery-preview" class="flex flex-wrap gap-2">
                                        <p class="text-[10px] text-gray-400 italic">No new images</p>
                                    </div>
                                </div>
                            </div>
                            <input type="file" name="gallery[]" id="gallery-input" multiple onchange="previewGallery(this)"
                                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none p-1">
                        </div>

                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-900">Product Video (Optional)</label>
                            <div class="space-y-2">
                                @if ($product->video)
                                    <div class="flex items-center gap-3 p-2 bg-gray-50 rounded border border-gray-100 mb-2">
                                        <i class="fas fa-video text-blue-500"></i>
                                        <span class="text-xs text-gray-600 truncate max-w-[120px]">{{ basename($product->video) }}</span>
                                        <a href="{{ asset('storage/' . $product->video) }}" target="_blank"
                                            class="text-[10px] bg-blue-100 text-blue-600 px-2 py-0.5 rounded font-bold hover:bg-blue-200 transition-colors ml-auto">View</a>
                                    </div>
                                @endif
                                <input type="file" name="video" accept="video/*"
                                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none p-1">
                                <p class="text-[10px] text-gray-400 mt-1">Max: 20MB. Leave blank to keep current.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Product Status/Badges -->
                    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
                        <h2 class="text-lg font-bold mb-4 border-b pb-2">Product Badges & Status</h2>
                        <div class="space-y-4">
                            <label class="relative flex items-center justify-between cursor-pointer p-3 rounded-lg border border-gray-100 hover:bg-gray-50 transition-colors">
                                <span class="text-sm font-medium text-gray-900">Featured Product</span>
                                <input type="checkbox" name="is_featured" value="1" class="sr-only peer" {{ old('is_featured', $product->is_featured) ? 'checked' : '' }}>
                                <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:right-[22px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600 peer-checked:after:right-[2px]"></div>
                            </label>

                            <label class="relative flex items-center justify-between cursor-pointer p-3 rounded-lg border border-gray-100 hover:bg-gray-50 transition-colors">
                                <span class="text-sm font-medium text-gray-900">Coming Soon</span>
                                <input type="checkbox" name="is_coming_soon" value="1" class="sr-only peer" {{ old('is_coming_soon', $product->is_coming_soon) ? 'checked' : '' }}>
                                <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:right-[22px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600 peer-checked:after:right-[2px]"></div>
                            </label>

                            <label class="relative flex items-center justify-between cursor-pointer p-3 rounded-lg border border-gray-100 hover:bg-gray-50 transition-colors">
                                <span class="text-sm font-medium text-gray-900">To Be Announced (TBA)</span>
                                <input type="checkbox" name="is_tba" value="1" class="sr-only peer" {{ old('is_tba', $product->is_tba) ? 'checked' : '' }}>
                                <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:right-[22px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600 peer-checked:after:right-[2px]"></div>
                            </label>

                            <label class="relative flex items-center justify-between cursor-pointer p-3 rounded-lg border border-gray-100 hover:bg-gray-50 transition-colors">
                                <span class="text-sm font-medium text-gray-900">Call for Price</span>
                                <input type="checkbox" name="is_call_for_price" value="1" class="sr-only peer" {{ old('is_call_for_price', $product->is_call_for_price) ? 'checked' : '' }}>
                                <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:right-[22px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600 peer-checked:after:right-[2px]"></div>
                            </label>

                            <label class="relative flex items-center justify-between cursor-pointer p-3 rounded-lg border border-red-50 hover:bg-red-50 transition-colors">
                                <span class="text-sm font-medium text-red-700">Out of Stock (Manual)</span>
                                <input type="checkbox" name="is_out_of_stock" value="1" class="sr-only peer" {{ old('is_out_of_stock', $product->is_out_of_stock) ? 'checked' : '' }}>
                                <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-red-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:right-[22px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-red-600 peer-checked:after:right-[2px]"></div>
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Old duplicated sections removed -->

            <!-- Remove previous SEO box here as it's now inside the grid -->

            <div class="flex gap-4">
                <button type="submit"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-8 py-3 text-center">Update
                    Product</button>
                <a href="{{ route('admin.products.index') }}"
                    class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-8 py-3">Cancel</a>
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
                            toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList',
                                'blockQuote', 'insertTable', 'undo', 'redo'
                            ]
                        })
                        .catch(error => {
                            console.error(error);
                        });

                ClassicEditor
                    .create(document.querySelector('#spec-editor'), {
                        toolbar: ['heading', '|', 'bold', 'italic', 'underline', '|', 'bulletedList',
                            'numberedList', '|', 'insertTable', 'blockQuote', '|', 'undo', 'redo'
                        ]
                    })
                    .catch(error => {
                        console.error(error);
                    });
            });

        // Image Preview Functions
        function previewThumbnail(input) {
            const img = document.getElementById('thumb-img');
            const placeholder = document.getElementById('thumb-placeholder');
            
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    img.src = e.target.result;
                    img.classList.remove('hidden');
                    if(placeholder) placeholder.classList.add('hidden');
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        function removeThumbnail() {
            const input = document.getElementById('thumbnail-input');
            const img = document.getElementById('thumb-img');
            const placeholder = document.getElementById('thumb-placeholder');
            const originalThumb = "{{ $product->thumbnail ? asset('storage/' . $product->thumbnail) : '#' }}";
            
            input.value = '';
            if (originalThumb !== '#') {
                img.src = originalThumb;
                img.classList.remove('hidden');
                if(placeholder) placeholder.classList.add('hidden');
            } else {
                img.src = '#';
                img.classList.add('hidden');
                if(placeholder) placeholder.classList.remove('hidden');
            }
        }

        function previewGallery(input) {
            const preview = document.getElementById('gallery-preview');
            preview.innerHTML = '';
            
            if (input.files && input.files.length > 0) {
                Array.from(input.files).forEach((file, index) => {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const div = document.createElement('div');
                        div.className = 'relative w-16 h-16 rounded border border-gray-200 overflow-hidden shadow-sm group';
                        div.innerHTML = `
                            <img src="${e.target.result}" class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-black bg-opacity-40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                                <span class="text-white text-[8px] font-bold">NEW</span>
                            </div>
                        `;
                        preview.appendChild(div);
                    }
                    reader.readAsDataURL(file);
                });
            } else {
                preview.innerHTML = '<p class="text-xs text-gray-400 italic">No new images selected</p>';
            }
        }
    </script>
@endsection
