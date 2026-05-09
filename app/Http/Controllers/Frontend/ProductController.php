<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function show($slug)
    {
        $product = Product::with(['categories', 'images', 'specifications'])
            ->where('slug', $slug)
            ->where('status', 1)
            ->firstOrFail();

        // Get related products from the same categories
        $categoryIds = $product->categories->pluck('id');
        $relatedProducts = Product::with('specifications')
            ->whereHas('categories', fn($q) => $q->whereIn('categories.id', $categoryIds))
            ->where('id', '!=', $product->id)
            ->where('status', 1)
            ->take(5)
            ->get();

        return view('frontend.product.single', compact('product', 'relatedProducts'));
    }
}
