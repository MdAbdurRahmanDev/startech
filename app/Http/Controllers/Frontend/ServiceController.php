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
