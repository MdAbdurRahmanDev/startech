<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogCategoryController extends Controller
{
    public function index()
    {
        $categories = BlogCategory::withCount('blogs')->orderBy('sort_order')->get();
        return view('backend.pages.blog.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('backend.pages.blog.categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $slug = Str::slug($request->name);
        $originalSlug = $slug;
        $count = 1;
        while (BlogCategory::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count++;
        }

        BlogCategory::create([
            'name'        => $request->name,
            'slug'        => $slug,
            'description' => $request->description,
            'status'      => $request->has('status') ? 1 : 0,
            'sort_order'  => $request->sort_order ?? 0,
        ]);

        return redirect()->route('admin.blog-categories.index')->with('success', 'Category created successfully!');
    }

    public function edit(BlogCategory $blogCategory)
    {
        return view('backend.pages.blog.categories.edit', compact('blogCategory'));
    }

    public function update(Request $request, BlogCategory $blogCategory)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $blogCategory->update([
            'name'        => $request->name,
            'description' => $request->description,
            'status'      => $request->has('status') ? 1 : 0,
            'sort_order'  => $request->sort_order ?? 0,
        ]);

        return redirect()->route('admin.blog-categories.index')->with('success', 'Category updated successfully!');
    }

    public function destroy(BlogCategory $blogCategory)
    {
        $blogCategory->delete();
        return redirect()->route('admin.blog-categories.index')->with('success', 'Category deleted!');
    }
}
