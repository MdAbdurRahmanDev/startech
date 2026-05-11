@extends('layouts.admin')

@section('title', 'Products | IOS BD')

@section('content')
    <div class="p-4 bg-white border-b border-gray-200 lg:mt-1.5">
        <div class="flex flex-col md:flex-row items-center justify-between mb-4">
            <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl">Products</h1>
            <a href="{{ route('admin.products.create') }}"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 focus:outline-none">
                Add new product
            </a>
        </div>

        <!-- Filter Form -->
        <form action="{{ route('admin.products.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-6 gap-4">
            <!-- Search Filter -->
            <div>
                <input type="text" name="search" value="{{ request('search') }}"
                    class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5"
                    placeholder="Search by name...">
            </div>

            <!-- Stock Filter -->
            <div>
                <select name="stock_status"
                    class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">
                    <option value="">All Stock Status</option>
                    <option value="low" {{ request('stock_status') == 'low' ? 'selected' : '' }}>Low Stock (<
                            50)</option>
                </select>
            </div>

            <!-- Category Filter -->
            <div>
                <select name="category_id"
                    class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">
                    <option value="">All Categories</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Brand Filter -->
            <div>
                <select name="brand_id"
                    class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">
                    <option value="">All Brands</option>
                    @foreach ($brands as $brand)
                        <option value="{{ $brand->id }}" {{ request('brand_id') == $brand->id ? 'selected' : '' }}>
                            {{ $brand->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Supplier Filter -->
            <div>
                <select name="supplier_id"
                    class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">
                    <option value="">All Suppliers</option>
                    @foreach ($suppliers as $supplier)
                        <option value="{{ $supplier->id }}"
                            {{ request('supplier_id') == $supplier->id ? 'selected' : '' }}>{{ $supplier->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="flex space-x-2">
                <button type="submit"
                    class="text-white bg-green-600 hover:bg-green-700 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 w-full">
                    Filter
                </button>
                <a href="{{ route('admin.products.index') }}"
                    class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center w-full">
                    Clear
                </a>
            </div>
        </form>
    </div>

    <div class="flex flex-col">
        <div class="overflow-x-auto">
            <div class="inline-block min-w-full align-middle">
                <div class="overflow-hidden shadow">
                    <table class="min-w-full divide-y divide-gray-200 table-fixed">
                        <thead class="bg-gray-100">
                            <tr>
                                <th scope="col" class="p-4 text-xs font-medium text-left text-gray-500 uppercase">Image
                                </th>
                                <th scope="col" class="p-4 text-xs font-medium text-left text-gray-500 uppercase">Product
                                    Name</th>
                                <th scope="col" class="p-4 text-xs font-medium text-left text-gray-500 uppercase">
                                    Categories</th>
                                <th scope="col" class="p-4 text-xs font-medium text-left text-gray-500 uppercase">Price
                                </th>
                                <th scope="col" class="p-4 text-xs font-medium text-left text-gray-500 uppercase">Stock
                                </th>
                                <th scope="col" class="p-4 text-xs font-medium text-left text-gray-500 uppercase">
                                    Featured</th>
                                <th scope="col" class="p-4 text-xs font-medium text-left text-gray-500 uppercase">Status
                                </th>
                                <th scope="col" class="p-4 text-xs font-medium text-left text-gray-500 uppercase">Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($products as $product)
                                <tr class="hover:bg-gray-100">
                                    <td class="p-4 text-sm font-normal text-gray-500">
                                        @if ($product->thumbnail)
                                            <img src="{{ asset('storage/' . $product->thumbnail) }}"
                                                alt="{{ $product->name }}" class="w-10 h-10 object-cover rounded">
                                        @else
                                            <div class="w-10 h-10 bg-gray-200 rounded flex items-center justify-center">
                                                <i class="fas fa-box text-gray-400"></i>
                                            </div>
                                        @endif
                                    </td>
                                    <td class="p-4 text-base font-medium text-gray-900">{{ $product->name }}</td>
                                    <td class="p-4 text-sm font-normal text-gray-500">
                                        @foreach ($product->categories as $category)
                                            <span
                                                class="bg-blue-100 text-blue-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded">{{ $category->name }}</span>
                                        @endforeach
                                    </td>
                                    <td class="p-4 text-sm font-normal text-gray-500">
                                        @if ($product->discount_price)
                                            <span
                                                class="line-through text-red-500">{{ number_format($product->price, 2) }}</span><br>
                                            <span
                                                class="text-green-600 font-bold">{{ number_format($product->discount_price, 2) }}</span>
                                        @else
                                            <span class="font-bold">{{ number_format($product->price, 2) }}</span>
                                        @endif
                                    </td>
                                    <td class="p-4 text-sm font-normal">
                                        @if ($product->stock < 50)
                                            <div class="flex items-center text-red-600 font-bold animate-pulse">
                                                <i class="fas fa-exclamation-triangle mr-1.5"></i>
                                                {{ $product->stock }}
                                            </div>
                                        @else
                                            <span class="text-gray-500">{{ $product->stock }}</span>
                                        @endif
                                    </td>
                                    <td class="p-4 text-base font-medium text-gray-900">
                                        <form action="{{ route('admin.products.featured', $product->id) }}" method="POST">
                                            @csrf
                                            <button type="submit"
                                                class="{{ $product->is_featured ? 'text-green-500' : 'text-gray-400' }}">
                                                <i class="fas fa-star text-xl"></i>
                                            </button>
                                        </form>
                                    </td>
                                    <td class="p-4 text-base font-medium text-gray-900">
                                        <form action="{{ route('admin.products.toggle', $product->id) }}" method="POST">
                                            @csrf
                                            <button type="submit"
                                                class="{{ $product->status ? 'text-green-500' : 'text-red-500' }}">
                                                <i
                                                    class="fas fa-toggle-{{ $product->status ? 'on' : 'off' }} text-2xl"></i>
                                            </button>
                                        </form>
                                    </td>
                                    <td class="p-4 space-x-2">
                                        <a href="{{ route('admin.stock.create', ['product_id' => $product->id]) }}"
                                            class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-green-600 hover:bg-green-700 focus:ring-4 focus:ring-green-300">
                                            <i class="fas fa-plus-circle mr-2"></i> Stock
                                        </a>
                                        <a href="{{ route('admin.products.edit', $product->id) }}"
                                            class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300">
                                            <i class="fas fa-edit mr-2"></i> Edit
                                        </a>
                                        <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST"
                                            class="inline-block" onsubmit="return confirm('Are you sure?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-red-600 rounded-lg hover:bg-red-800 focus:ring-4 focus:ring-red-300">
                                                <i class="fas fa-trash mr-2"></i> Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="mt-4 p-4">
        {{ $products->links() }}
    </div>
@endsection
