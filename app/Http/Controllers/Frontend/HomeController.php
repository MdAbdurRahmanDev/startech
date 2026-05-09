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
        
        return view('frontend.home', compact('sliders', 'sideBanners'));
    }
}
