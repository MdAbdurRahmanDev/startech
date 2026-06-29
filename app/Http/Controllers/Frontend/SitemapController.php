<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Offer;
use App\Models\Page;
use App\Models\Product;
use App\Models\Service;
use Illuminate\Http\Request;

class SitemapController extends Controller
{
    public function index()
    {
        $urls = [];

        // Base URLs
        $urls[] = [
            'loc' => url('/'),
            'lastmod' => now()->tz('UTC')->toAtomString(),
            'changefreq' => 'daily',
            'priority' => '1.0',
        ];

        $staticRoutes = [
            'products' => 'daily',
            'offers' => 'daily',
            'services' => 'weekly',
            'pc-builder' => 'weekly',
            'ac-calculator' => 'weekly',
            'compare' => 'weekly',
            'blog' => 'weekly',
            'contact' => 'monthly',
        ];

        foreach ($staticRoutes as $route => $freq) {
            $urls[] = [
                'loc' => url('/' . $route),
                'lastmod' => now()->tz('UTC')->toAtomString(),
                'changefreq' => $freq,
                'priority' => '0.8',
            ];
        }

        // Categories
        $categories = Category::where('status', 1)->get();
        foreach ($categories as $category) {
            $urls[] = [
                'loc' => route('category.show', $category->slug),
                'lastmod' => $category->updated_at->tz('UTC')->toAtomString(),
                'changefreq' => 'daily',
                'priority' => '0.9',
            ];
        }

        // Products
        $products = Product::where('status', 1)->get();
        foreach ($products as $product) {
            $urls[] = [
                'loc' => route('product.single', $product->slug),
                'lastmod' => $product->updated_at->tz('UTC')->toAtomString(),
                'changefreq' => 'daily',
                'priority' => '0.8',
            ];
        }

        // Offers
        $offers = Offer::where('status', 1)->get();
        foreach ($offers as $offer) {
            $urls[] = [
                'loc' => route('offers.show', $offer->slug),
                'lastmod' => $offer->updated_at->tz('UTC')->toAtomString(),
                'changefreq' => 'weekly',
                'priority' => '0.7',
            ];
        }

        // Services
        $services = Service::where('status', 1)->get();
        foreach ($services as $service) {
            $urls[] = [
                'loc' => route('services.show', $service->slug),
                'lastmod' => $service->updated_at->tz('UTC')->toAtomString(),
                'changefreq' => 'monthly',
                'priority' => '0.7',
            ];
        }

        // Blogs
        $blogs = Blog::where('status', 1)->get();
        foreach ($blogs as $blog) {
            $urls[] = [
                'loc' => route('blogs.show', $blog->slug),
                'lastmod' => $blog->updated_at->tz('UTC')->toAtomString(),
                'changefreq' => 'weekly',
                'priority' => '0.6',
            ];
        }

        // Dynamic Pages (Info)
        $pages = Page::all();
        foreach ($pages as $page) {
            $urls[] = [
                'loc' => route('info.show', $page->slug),
                'lastmod' => $page->updated_at->tz('UTC')->toAtomString(),
                'changefreq' => 'monthly',
                'priority' => '0.5',
            ];
        }

        return response()->view('sitemap', compact('urls'))->header('Content-Type', 'text/xml');
    }
}
