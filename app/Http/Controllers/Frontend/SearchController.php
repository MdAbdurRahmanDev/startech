<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->input('q');

        if ($q) {
            $ignoreWords = ['iosbd',  'bd', 'in bangladesh', 'price'];
            $q = trim(str_ireplace($ignoreWords, '', $q));
            // Replace multiple spaces with single space
            $q = preg_replace('/\s+/', ' ', $q);
        }

        $query = Product::with(['specifications'])->where('status', 1);

        if ($q) {
            $words = array_filter(explode(' ', $q));

            $query->where(function ($qBuilder) use ($words) {
                foreach ($words as $word) {
                    $qBuilder->where(function ($q2) use ($word) {
                        $q2->where('name', 'LIKE', "%{$word}%")
                            ->orWhere('short_description', 'LIKE', "%{$word}%")
                            ->orWhere('tags', 'LIKE', "%{$word}%");
                    });
                }
            });
        }

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
        $brands = Brand::where('status', 1)->get();

        // Get suggested categories based on search term
        $suggestedCategories = [];
        if ($q) {
            $suggestedCategories = Category::where('name', 'LIKE', "%{$q}%")
                ->where('status', 1)
                ->whereNotNull('parent_id') // Focus on subcategories
                ->take(10)
                ->get();
        }

        // Pass a dummy category for the view to work
        $category = (object) [
            'name' => 'Search - '.($q ?? 'All'),
            'slug' => 'search',
        ];

        return view('frontend.product.search', compact('products', 'brands', 'category', 'q', 'suggestedCategories'));
    }
}
