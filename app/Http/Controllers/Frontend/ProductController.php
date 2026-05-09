<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with(['specifications'])->where('status', 1);

        // Sorting
        if ($request->sort == 'price_low') {
            $query->orderBy('price', 'asc');
        } elseif ($request->sort == 'price_high') {
            $query->orderBy('price', 'desc');
        } else {
            $query->latest();
        }

        // Filtering
        if ($request->min_price) {
            $query->where('price', '>=', $request->min_price);
        }
        if ($request->max_price) {
            $query->where('price', '<=', $request->max_price);
        }
        if ($request->availability && in_array('in_stock', $request->availability)) {
            $query->where('stock', '>', 0);
        }
        if ($request->brands) {
            $query->whereIn('brand_id', $request->brands);
        }

        $show = $request->show ?? 20;
        $products = $query->paginate($show)->withQueryString();
        $brands = \App\Models\Brand::where('status', 1)->get();

        // Pass a dummy category for the view to work
        $category = (object)[
            'name' => 'All Products',
            'slug' => 'all-products'
        ];

        return view('frontend.product.category', compact('products', 'brands', 'category'));
    }

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
