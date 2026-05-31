<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\BlogComment;
use Illuminate\Http\Request;

class BlogCommentController extends Controller
{
    public function index()
    {
        $pendingComments = BlogComment::with(['blog', 'user'])
            ->where('status', 0)
            ->latest()
            ->paginate(20);

        return view('backend.pages.blog.comments.index', compact('pendingComments'));
    }

    public function approve(BlogComment $blogComment)
    {
        $blogComment->update(['status' => 1]);

        return back()->with('success', 'Comment approved successfully.');
    }

    public function reject(BlogComment $blogComment)
    {
        $blogComment->update(['status' => 0]);

        return back()->with('success', 'Comment set to pending successfully.');
    }

    public function destroy(BlogComment $blogComment)
    {
        $blogComment->delete();

        return back()->with('success', 'Comment deleted successfully.');
    }
}

