<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::active()->get();
        return view('frontend.pages.services', compact('services'));
    }

    public function homeServices()
    {
        $serviceSliders = \App\Models\Banner::where('type', 'home_services')->where('status', 1)->orderBy('order')->get();
        $homeServicesPage = \App\Models\Page::where('slug', 'home-services')->first();
        $pageData = $homeServicesPage ? json_decode($homeServicesPage->content, true) : null;
        
        $badges = $pageData['badges'] ?? [];
        $categories = $pageData['categories'] ?? [];
        $faqs = $pageData['faqs'] ?? [];

        return view('frontend.pages.home_services', compact('serviceSliders', 'badges', 'categories', 'faqs'));
    }

    public function serviceCenter()
    {
        $serviceSliders = \App\Models\Banner::where('type', 'service_center')->where('status', 1)->orderBy('order')->get();
        $serviceCenterPage = \App\Models\Page::where('slug', 'service-center')->first();
        $pageData = $serviceCenterPage ? json_decode($serviceCenterPage->content, true) : null;
        
        $steps = $pageData['steps'] ?? [];
        $bottomDescription = $pageData['bottom_description'] ?? '';
        
        // Get "Expert" category blogs for service center
        $expertCategory = \App\Models\BlogCategory::where('slug', 'expert')->where('status', 1)->first();
        $expertBlogs = $expertCategory
            ? \App\Models\Blog::with('category')->active()->where('blog_category_id', $expertCategory->id)->orderBy('sort_order')->orderBy('published_at', 'desc')->take(8)->get()
            : collect();
        
        $outlets = \App\Models\Outlet::where('status', 1)->orderBy('sort_order')->get();

        return view('frontend.pages.service_center', compact('serviceSliders', 'steps', 'bottomDescription', 'expertBlogs', 'outlets'));
    }

    public function show($slug)
    {
        $service = Service::where('slug', $slug)->firstOrFail();
        return view('frontend.pages.service_details', compact('service'));
    }

    public function webDevelopment()
    {
        return view('frontend.pages.web_development');
    }

    public function appDevelopment()
    {
        return view('frontend.pages.app_development');
    }

    public function aiAutomation()
    {
        return view('frontend.pages.ai_automation');
    }
}
