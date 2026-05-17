<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::with('category')->orderBy('sort_order')->orderBy('published_at', 'desc')->paginate(20);
        return view('backend.pages.blog.posts.index', compact('blogs'));
    }

    public function create()
    {
        $categories = BlogCategory::where('status', 1)->orderBy('sort_order')->get();
        return view('backend.pages.blog.posts.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'            => 'required|string|max:255',
            'blog_category_id' => 'required|exists:blog_categories,id',
            'content'          => 'nullable|string',
        ]);

        $slug = Str::slug($request->title);
        $originalSlug = $slug;
        $count = 1;
        while (Blog::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count++;
        }

        $thumbnailPath = null;
        if ($request->hasFile('thumbnail')) {
            $thumbnailPath = $request->file('thumbnail')->store('blogs', 'public');
        }

        Blog::create([
            'blog_category_id' => $request->blog_category_id,
            'title'            => $request->title,
            'slug'             => $slug,
            'excerpt'          => $request->excerpt,
            'content'          => $request->content,
            'thumbnail'        => $thumbnailPath,
            'author'           => $request->author ?? 'Admin',
            'status'           => $request->has('status') ? 1 : 0,
            'featured'         => $request->has('featured') ? 1 : 0,
            'sort_order'       => $request->sort_order ?? 0,
            'published_at'     => $request->published_at ?? now(),
        ]);

        return redirect()->route('admin.blogs.index')->with('success', 'Blog post created successfully!');
    }

    public function edit(Blog $blog)
    {
        $categories = BlogCategory::where('status', 1)->orderBy('sort_order')->get();
        return view('backend.pages.blog.posts.edit', compact('blog', 'categories'));
    }

    public function update(Request $request, Blog $blog)
    {
        $request->validate([
            'title'            => 'required|string|max:255',
            'blog_category_id' => 'required|exists:blog_categories,id',
        ]);

        $thumbnailPath = $blog->thumbnail;
        if ($request->hasFile('thumbnail')) {
            if ($thumbnailPath) {
                Storage::disk('public')->delete($thumbnailPath);
            }
            $thumbnailPath = $request->file('thumbnail')->store('blogs', 'public');
        }

        $blog->update([
            'blog_category_id' => $request->blog_category_id,
            'title'            => $request->title,
            'excerpt'          => $request->excerpt,
            'content'          => $request->content,
            'thumbnail'        => $thumbnailPath,
            'author'           => $request->author ?? 'Admin',
            'status'           => $request->has('status') ? 1 : 0,
            'featured'         => $request->has('featured') ? 1 : 0,
            'sort_order'       => $request->sort_order ?? 0,
            'published_at'     => $request->published_at ?? $blog->published_at,
        ]);

        return redirect()->route('admin.blogs.index')->with('success', 'Blog post updated successfully!');
    }

    public function destroy(Blog $blog)
    {
        if ($blog->thumbnail) {
            Storage::disk('public')->delete($blog->thumbnail);
        }
        $blog->delete();
        return redirect()->route('admin.blogs.index')->with('success', 'Blog post deleted!');
    }

    public function toggleStatus(Blog $blog)
    {
        $blog->update(['status' => !$blog->status]);
        return response()->json(['success' => true, 'status' => $blog->status]);
    }

    public function toggleFeatured(Blog $blog)
    {
        $blog->update(['featured' => !$blog->featured]);
        return response()->json(['success' => true, 'featured' => $blog->featured]);
    }
}
