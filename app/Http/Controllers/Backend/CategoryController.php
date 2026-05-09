<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::with('children.children')
            ->whereNull('parent_id')
            ->orderBy('order')
            ->get();

        $allCategories = Category::orderBy('name')->get();

        return view('backend.pages.categories.index', compact('categories', 'allCategories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:categories,id',
            'icon' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'order' => 'nullable|integer',
            'is_featured' => 'nullable|boolean',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('categories', 'public');
        }

        Category::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name) . '-' . rand(1000, 9999),
            'parent_id' => $request->parent_id,
            'icon' => $request->icon,
            'image' => $imagePath,
            'is_featured' => $request->has('is_featured'),
            'order' => $request->order ?? 0,
        ]);

        return back()->with('success', 'Category created successfully.');
    }

    public function destroy(Category $category)
    {
        if ($category->image) {
            Storage::disk('public')->delete($category->image);
        }
        $category->delete();
        return back()->with('success', 'Category deleted successfully.');
    }

    public function toggleStatus(Category $category)
    {
        $category->update(['status' => !$category->status]);
        return back()->with('success', 'Status updated.');
    }

    public function toggleFeatured(Category $category)
    {
        $category->update(['is_featured' => !$category->is_featured]);
        return back()->with('success', 'Featured status updated.');
    }
}
