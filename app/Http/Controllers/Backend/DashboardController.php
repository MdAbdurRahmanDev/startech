<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard(){
        $totalUsers = \App\Models\User::count();
        $totalCategories = \App\Models\Category::count();
        $recentUsers = \App\Models\User::latest()->take(10)->get();

        return view("backend.dashboard", compact('totalUsers', 'totalCategories', 'recentUsers'));
    }
}
