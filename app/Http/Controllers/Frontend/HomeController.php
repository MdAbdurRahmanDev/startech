<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $sliders = Banner::where('type', 'slider')->where('status', 1)->orderBy('order')->get();
        $sideBanners = Banner::where('type', 'side')->where('status', 1)->orderBy('order')->take(2)->get();
        $featuredCategories = \App\Models\Category::where('is_featured', 1)->where('status', 1)->orderByRaw('`order` = 0, `order` ASC')->get();
        $featuredProducts = \App\Models\Product::with(['categories', 'specifications'])->where('is_featured', 1)->where('status', 1)->latest()->take(10)->get();
        $outletCount = \App\Models\Outlet::where('status', 1)->count();
        
        return view('frontend.home', compact('sliders', 'sideBanners', 'featuredCategories', 'featuredProducts', 'outletCount'));
    }
}
