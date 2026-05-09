<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function show($slug)
    {
        $category = \App\Models\Category::where('slug', $slug)->firstOrFail();
        $products = $category->products()->with('specifications')->where('status', 1)->paginate(20);
        
        return view('frontend.product.category', compact('category', 'products'));
    }
}
