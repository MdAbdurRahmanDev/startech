<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Outlet;
use Illuminate\Http\Request;

class OutletController extends Controller
{
    public function index()
    {
        $outlets = Outlet::where('status', 1)->orderBy('sort_order', 'asc')->get();
        return view('frontend.pages.outlets', compact('outlets'));
    }
}
