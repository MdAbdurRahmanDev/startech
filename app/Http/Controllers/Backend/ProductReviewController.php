<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ProductReview;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductReviewController extends Controller
{
    // Frontend: Store review
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'required|string|max:2000',
        ]);

        // Check if user has purchased the product and it's delivered
        $hasPurchased = Order::where('user_id', Auth::id())
            ->where('status', 'delivered')
            ->whereHas('items', function($query) use ($request) {
                $query->where('product_id', $request->product_id);
            })->exists();

        if (!$hasPurchased) {
            return back()->with('error', 'You can only review products you have purchased and received.');
        }

        // Check if already reviewed
        $alreadyReviewed = ProductReview::where('user_id', Auth::id())
            ->where('product_id', $request->product_id)
            ->exists();

        if ($alreadyReviewed) {
            return back()->with('error', 'You have already reviewed this product.');
        }

        ProductReview::create([
            'product_id' => $request->product_id,
            'user_id' => Auth::id(),
            'rating' => $request->rating,
            'review' => $request->review,
            'status' => 1 // Auto visible for now
        ]);

        return back()->with('success', 'Thank you for your review!');
    }

    // Admin: List reviews
    public function index()
    {
        $reviews = ProductReview::with(['product', 'user'])->latest()->paginate(20);
        return view('backend.pages.reviews.index', compact('reviews'));
    }

    // Admin: Delete review
    public function destroy(ProductReview $review)
    {
        $review->delete();
        return back()->with('success', 'Review deleted successfully.');
    }
}
