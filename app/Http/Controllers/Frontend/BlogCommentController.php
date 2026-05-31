<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogComment;
use Illuminate\Http\Request;

class BlogCommentController extends Controller
{
    public function store(Request $request, $slug)
    {
        $blog = Blog::query()
            ->where('slug', $slug)
            ->firstOrFail();

        $request->validate([
            'name' => 'required|string|max:255',
            'comment' => 'required|string|max:2000',
        ]);

        $user = auth()->user();

        // Save as pending until admin approves
        BlogComment::create([
            'blog_id' => $blog->id,
            'user_id' => $user?->id,
            'name' => $request->input('name'),
            'comment' => $request->input('comment'),
            'status' => 0,
        ]);

        return back()->with('success', 'Your comment has been submitted. Admin approval required before it will be visible.');
    }
}

