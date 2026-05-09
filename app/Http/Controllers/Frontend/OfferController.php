<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Offer;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    public function index()
    {
        $offers = Offer::active()->latest()->get();
        return view('frontend.pages.offers', compact('offers'));
    }

    public function show($slug)
    {
        $offer = Offer::where('slug', $slug)->firstOrFail();
        return view('frontend.pages.offer_details', compact('offer'));
    }
}
