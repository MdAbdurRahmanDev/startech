<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InformationController extends Controller
{
    public function affiliate() { return view('frontend.information.page', ['title' => 'Star Tech Ltd. - Affiliate Marketing Program']); }
    public function emi() { return view('frontend.information.page', ['title' => 'EMI Terms']); }
    public function privacy() { return view('frontend.information.page', ['title' => 'Privacy Policy']); }
    public function starPoint() { return view('frontend.information.page', ['title' => 'Star Point Policy']); }
    public function contact() { return view('frontend.pages.contact'); }
    public function about() { return view('frontend.information.page', ['title' => 'About Us']); }
    public function terms() { return view('frontend.information.page', ['title' => 'Terms and Conditions']); }
    public function refund() { return view('frontend.information.page', ['title' => 'Refund and Return Policy']); }
}
