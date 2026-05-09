@extends('layouts.admin')

@section('title', 'Add Stock')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-heading">Add Product Stock</h1>
    <p class="text-sm text-body">Manually increase stock for a specific product</p>
</div>

<div class="max-w-2xl bg-white border border-default rounded-lg shadow-sm">
    <form action="{{ route('admin.stock.store') }}" method="POST" class="p-6">
        @csrf
        
        <div class="grid gap-6 mb-6">
            <!-- Product -->
            <div>
                <label for="product_id" class="block mb-2 text-sm font-bold text-heading">Select Product</label>
                <select id="product_id" name="product_id" required class="bg-neutral-primary-soft border border-default text-heading text-sm rounded-base focus:ring-brand-light focus:border-fg-brand block w-full p-2.5 outline-none transition-all">
                    <option value="">Choose a product</option>
                    @foreach($products as $product)
                        <option value="{{ $product->id }}" {{ request('product_id') == $product->id ? 'selected' : '' }}>
                            {{ $product->name }} (Current Stock: {{ $product->stock }})
                        </option>
                    @endforeach
                </select>
                @error('product_id')
                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- Supplier -->
            <div>
                <label for="supplier_id" class="block mb-2 text-sm font-bold text-heading">Select Supplier</label>
                <select id="supplier_id" name="supplier_id" required class="bg-neutral-primary-soft border border-default text-heading text-sm rounded-base focus:ring-brand-light focus:border-fg-brand block w-full p-2.5 outline-none transition-all">
                    <option value="">Choose a supplier</option>
                    @foreach($suppliers as $supplier)
                        <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                    @endforeach
                </select>
                @error('supplier_id')
                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- Quantity -->
            <div>
                <label for="quantity" class="block mb-2 text-sm font-bold text-heading">Quantity to Add</label>
                <input type="number" id="quantity" name="quantity" min="1" required placeholder="e.g. 50" class="bg-neutral-primary-soft border border-default text-heading text-sm rounded-base focus:ring-brand-light focus:border-fg-brand block w-full p-2.5 outline-none transition-all">
                @error('quantity')
                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- Remarks -->
            <div>
                <label for="remarks" class="block mb-2 text-sm font-bold text-heading">Remarks (Optional)</label>
                <textarea id="remarks" name="remarks" rows="3" placeholder="Notes about this stock entry..." class="bg-neutral-primary-soft border border-default text-heading text-sm rounded-base focus:ring-brand-light focus:border-fg-brand block w-full p-2.5 outline-none transition-all"></textarea>
                @error('remarks')
                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="flex items-center gap-4 pt-4 border-t border-default">
            <button type="submit" class="text-white bg-fg-brand hover:bg-opacity-90 focus:ring-4 focus:ring-brand-light font-bold rounded-base text-sm px-10 py-3 text-center transition-all">
                Save Stock
            </button>
            <a href="{{ route('admin.stock.index') }}" class="text-body bg-white border border-default hover:bg-neutral-primary-soft focus:ring-4 focus:ring-neutral-tertiary font-bold rounded-base text-sm px-10 py-3 text-center transition-all">
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection
