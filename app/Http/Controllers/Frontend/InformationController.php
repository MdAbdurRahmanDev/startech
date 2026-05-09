<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Page;

class InformationController extends Controller
{
    public function showPageBySlug($slug)
    {
        $page = Page::where('slug', $slug)->firstOrFail();
        return view('frontend.pages.dynamic_page', [
            'page' => $page,
            'title' => $page->title
        ]);
    }

    public function contact() { return view('frontend.pages.contact'); }
    public function quotation() { return view('frontend.pages.quotation'); }
}
