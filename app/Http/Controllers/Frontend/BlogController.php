<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\BlogComment;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $categories   = BlogCategory::where('status', 1)->withCount(['blogs' => fn($q) => $q->where('status', 1)])->orderBy('sort_order')->get();
        $blogs        = Blog::with('category')->active()->orderBy('sort_order')->orderBy('published_at', 'desc')->paginate(12);
        $featuredBlog = Blog::with('category')->active()->featured()->latest('published_at')->first();
        return view('frontend.pages.blog.index', compact('categories', 'blogs', 'featuredBlog'));
    }

    public function category($slug)
    {
        $category   = BlogCategory::where('slug', $slug)->where('status', 1)->firstOrFail();
        $categories = BlogCategory::where('status', 1)->withCount(['blogs' => fn($q) => $q->where('status', 1)])->orderBy('sort_order')->get();
        $blogs      = Blog::with('category')->active()->where('blog_category_id', $category->id)->orderBy('sort_order')->orderBy('published_at', 'desc')->paginate(12);
        return view('frontend.pages.blog.index', compact('categories', 'blogs', 'category'));
    }

    public function show($slug)
    {
        $blog       = Blog::with('category')->active()->where('slug', $slug)->firstOrFail();
        $related    = Blog::with('category')->active()->where('blog_category_id', $blog->blog_category_id)->where('id', '!=', $blog->id)->latest('published_at')->take(3)->get();
        $categories = BlogCategory::where('status', 1)->withCount(['blogs' => fn($q) => $q->where('status', 1)])->orderBy('sort_order')->get();
        return view('frontend.pages.blog.show', compact('blog', 'related', 'categories'));
    }

    public function storeComment(Request $request, Blog $blog)
    {
        $request->validate([
            'name'    => 'required|string|max:100',
            'email'   => 'required|email|max:100',
            'comment' => 'required|string|min:3|max:1000',
        ]);

        BlogComment::create([
            'blog_id' => $blog->id,
            'name'    => $request->name,
            'email'   => $request->email,
            'comment' => $request->comment,
            'status'  => false, // Requires admin approval by default
        ]);

        return redirect()->route('blogs.show', $blog->slug)->with('success', 'Comment submitted successfully! It will appear after admin approval.');
    }
}
