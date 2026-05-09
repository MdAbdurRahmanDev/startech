<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('categories')->latest()->paginate(10);
        return view('backend.pages.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('backend.pages.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'categories' => 'required|array',
            'categories.*' => 'exists:categories,id',
            'short_description' => 'nullable|string',
            'description' => 'nullable|string',
            'tags' => 'nullable|string',
            'buy_price' => 'required|numeric|min:0',
            'price' => 'required|numeric|min:0',
            'discount_price' => 'nullable|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'is_featured' => 'nullable|boolean',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string|max:255',
            'meta_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'gallery.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'specifications' => 'nullable|array',
            'specifications.*.name' => 'required_with:specifications|string|max:255',
            'specifications.*.value' => 'required_with:specifications|string',
        ]);

        $data = $request->except(['categories', 'thumbnail', 'meta_image', 'gallery', 'specifications']);
        $data['slug'] = Str::slug($request->name) . '-' . time();
        $data['is_featured'] = $request->has('is_featured');
        $data['status'] = true;

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('products/thumbnails', 'public');
        }

        if ($request->hasFile('meta_image')) {
            $data['meta_image'] = $request->file('meta_image')->store('products/seo', 'public');
        }

        $product = Product::create($data);
        $product->categories()->attach($request->categories);

        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $image) {
                $path = $image->store('products/gallery', 'public');
                $product->images()->create(['image' => $path]);
            }
        }

        // Handle specifications
        if ($request->has('specifications')) {
            foreach ($request->specifications as $spec) {
                if (!empty($spec['name']) && !empty($spec['value'])) {
                    $product->specifications()->create([
                        'name' => $spec['name'],
                        'value' => $spec['value']
                    ]);
                }
            }
        }

        return redirect()->route('admin.products.index')->with('success', 'Product created successfully.');
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        $productCategories = $product->categories->pluck('id')->toArray();
        return view('backend.pages.products.edit', compact('product', 'categories', 'productCategories'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'categories' => 'required|array',
            'categories.*' => 'exists:categories,id',
            'short_description' => 'nullable|string',
            'description' => 'nullable|string',
            'tags' => 'nullable|string',
            'buy_price' => 'required|numeric|min:0',
            'price' => 'required|numeric|min:0',
            'discount_price' => 'nullable|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'is_featured' => 'nullable|boolean',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string|max:255',
            'meta_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'gallery.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'specifications' => 'nullable|array',
            'specifications.*.name' => 'required_with:specifications|string|max:255',
            'specifications.*.value' => 'required_with:specifications|string',
        ]);

        $data = $request->except(['categories', 'thumbnail', 'meta_image', 'gallery', 'specifications']);
        if ($request->name !== $product->name) {
            $data['slug'] = Str::slug($request->name) . '-' . time();
        }
        $data['is_featured'] = $request->has('is_featured');

        if ($request->hasFile('thumbnail')) {
            if ($product->thumbnail) {
                Storage::disk('public')->delete($product->thumbnail);
            }
            $data['thumbnail'] = $request->file('thumbnail')->store('products/thumbnails', 'public');
        }

        if ($request->hasFile('meta_image')) {
            if ($product->meta_image) {
                Storage::disk('public')->delete($product->meta_image);
            }
            $data['meta_image'] = $request->file('meta_image')->store('products/seo', 'public');
        }

        $product->update($data);
        $product->categories()->sync($request->categories);

        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $image) {
                $path = $image->store('products/gallery', 'public');
                $product->images()->create(['image' => $path]);
            }
        }

        // Handle specifications
        if ($request->has('specifications')) {
            $product->specifications()->delete(); // Clear existing to prevent duplicates/orphans
            foreach ($request->specifications as $spec) {
                if (!empty($spec['name']) && !empty($spec['value'])) {
                    $product->specifications()->create([
                        'name' => $spec['name'],
                        'value' => $spec['value']
                    ]);
                }
            }
        } else {
             $product->specifications()->delete(); // Clear if empty
        }

        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        if ($product->thumbnail) {
            Storage::disk('public')->delete($product->thumbnail);
        }
        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully.');
    }

    public function toggleStatus(Product $product)
    {
        $product->update(['status' => !$product->status]);
        return back()->with('success', 'Product status updated.');
    }

    public function toggleFeatured(Product $product)
    {
        $product->update(['is_featured' => !$product->is_featured]);
        return back()->with('success', 'Product featured status updated.');
    }
}
