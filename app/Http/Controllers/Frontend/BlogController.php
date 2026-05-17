<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategory;

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
}
