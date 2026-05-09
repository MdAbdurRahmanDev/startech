<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function show(Request $request, $slug)
    {
        $category = \App\Models\Category::where('slug', $slug)->firstOrFail();
        
        $query = $category->products()->with(['specifications', 'brand'])->where('status', 1);

        // Price Filter
        if ($request->filled('min_price') && $request->filled('max_price')) {
            $query->whereBetween('price', [$request->min_price, $request->max_price]);
        }

        // Availability Filter
        if ($request->filled('availability')) {
            if (in_array('in_stock', $request->availability)) {
                $query->where('stock', '>', 0);
            }
        }

        // Brand Filter
        if ($request->filled('brands')) {
            $query->whereIn('brand_id', $request->brands);
        }

        if ($request->filled('brand')) {
            $brand = \App\Models\Brand::where('slug', $request->brand)->first();
            if ($brand) {
                $query->where('brand_id', $brand->id);
            }
        }

        // Sort By
        if ($request->filled('sort')) {
            switch ($request->sort) {
                case 'price_low':
                    $query->orderBy('price', 'asc');
                    break;
                case 'price_high':
                    $query->orderBy('price', 'desc');
                    break;
                default:
                    $query->latest();
            }
        } else {
            $query->latest();
        }

        // Per Page
        $perPage = $request->filled('show') ? (int) $request->show : 20;

        $products = $query->paginate($perPage)->appends($request->all());

        // Get brands related to this category for the filter
        $brandIds = $category->products()->where('status', 1)->whereNotNull('brand_id')->pluck('brand_id')->unique();
        $brands = \App\Models\Brand::whereIn('id', $brandIds)->where('status', 1)->get();
        
        return view('frontend.product.category', compact('category', 'products', 'brands'));
    }
}
