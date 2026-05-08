<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function login()
    {
        return view('frontend.account.login');
    }

    public function register()
    {
        return view('frontend.account.register');
    }

    public function account()
    {
        return view('frontend.account.account');
    }

    public function edit()
    {
        return view('frontend.account.edit');
    }

    public function order()
    {
        return view('frontend.account.order');
    }

    public function address()
    {
        return view('frontend.account.address');
    }
}
