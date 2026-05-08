@extends('layouts.app')

@section('styles')
<style>
    .account-container {
        padding: 30px 0;
    }

    .breadcrumb {
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 13px;
        color: #666;
        margin-bottom: 25px;
    }

    .breadcrumb a {
        text-decoration: none;
        color: #081621;
    }

    .breadcrumb i {
        font-size: 10px;
        color: #ccc;
    }

    .profile-card {
        background: #fff;
        border-radius: 8px;
        padding: 30px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .profile-info {
        display: flex;
        align-items: center;
        gap: 20px;
    }

    .avatar {
        width: 80px;
        height: 80px;
        background: #e5e7eb;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 40px;
        color: #9ca3af;
    }

    .user-text .hello {
        font-size: 14px;
        color: #666;
    }

    .user-text .name {
        font-size: 22px;
        font-weight: bold;
        color: #081621;
    }

    .profile-stats {
        display: flex;
        gap: 40px;
    }

    .stat-item {
        text-align: center;
        position: relative;
    }

    .stat-item:not(:last-child):after {
        content: '';
        position: absolute;
        right: -20px;
        top: 10%;
        height: 80%;
        width: 1px;
        background: #eee;
    }

    .stat-label {
        font-size: 12px;
        color: #666;
        margin-bottom: 5px;
        display: block;
    }

    .stat-value {
        font-size: 24px;
        font-weight: bold;
        color: var(--accent-orange);
    }

    .account-nav {
        background: #fff;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        margin-bottom: 30px;
        overflow-x: auto;
    }

    .account-nav-list {
        display: flex;
        list-style: none;
        padding: 0;
        margin: 0;
        white-space: nowrap;
    }

    .account-nav-list li a {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 15px 20px;
        text-decoration: none;
        color: #666;
        font-size: 14px;
        font-weight: 500;
        border-bottom: 2px solid transparent;
        transition: all 0.3s;
    }

    .account-nav-list li a i {
        font-size: 16px;
    }

    .account-nav-list li a:hover, .account-nav-list li a.active {
        color: var(--accent-orange);
        border-bottom-color: var(--accent-orange);
        background: #fafafa;
    }

    .account-content {
        background: #fff;
        border-radius: 8px;
        padding: 30px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    }

    .account-content h2 {
        font-size: 18px;
        font-weight: bold;
        color: #3b5998;
        margin-bottom: 25px;
        border-bottom: 1px solid #eee;
        padding-bottom: 15px;
    }

    /* Form Styles */
    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        font-size: 13px;
        font-weight: 600;
        margin-bottom: 8px;
    }

    .form-group label .required {
        color: var(--accent-orange);
    }

    .form-control {
        width: 100%;
        padding: 10px 15px;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 14px;
        outline: none;
        transition: border-color 0.3s;
    }

    .form-control:focus {
        border-color: var(--accent-orange);
    }

    .btn-continue {
        background: #3b5998;
        color: #fff;
        border: none;
        padding: 10px 30px;
        border-radius: 4px;
        font-weight: bold;
        cursor: pointer;
        transition: background 0.3s;
    }

    .btn-continue:hover {
        background: #2d4373;
    }

    /* Table Styles */
    .account-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 14px;
    }

    .account-table th {
        text-align: left;
        background: #f8f9fa;
        padding: 12px 15px;
        border-bottom: 2px solid #eee;
    }

    .account-table td {
        padding: 15px;
        border-bottom: 1px solid #eee;
    }

    @media (max-width: 768px) {
        .profile-card {
            flex-direction: column;
            text-align: center;
        }
        .profile-info {
            flex-direction: column;
        }
        .profile-stats {
            width: 100%;
            justify-content: space-around;
        }
    }
</style>
@yield('account_styles')
@endsection

@section('content')
<div class="container account-container">
    <div class="breadcrumb">
        <a href="{{ url('/') }}"><i class="fas fa-home"></i></a>
        <i class="fas fa-chevron-right"></i>
        <a href="{{ url('/account/account') }}">Account</a>
        @yield('breadcrumb_extra')
    </div>

    <div class="profile-card">
        <div class="profile-info">
            <div class="avatar">
                <i class="fas fa-user"></i>
            </div>
            <div class="user-text">
                <span class="hello">Hello,</span>
                <div class="name">Rahman Miah</div>
            </div>
        </div>
        <div class="profile-stats">
            <div class="stat-item">
                <span class="stat-label">Star Points</span>
                <span class="stat-value">0</span>
            </div>
            <div class="stat-item">
                <span class="stat-label">Store Credit</span>
                <span class="stat-value">0</span>
            </div>
        </div>
    </div>

    <nav class="account-nav">
        <ul class="account-nav-list">
            <li><a href="{{ url('/account/order') }}" class="{{ Request::is('account/order') ? 'active' : '' }}"><i class="fas fa-list-alt"></i> Orders</a></li>
            <li><a href="#"><i class="fas fa-file-invoice"></i> Quotes</a></li>
            <li><a href="{{ url('/account/edit') }}" class="{{ Request::is('account/edit') ? 'active' : '' }}"><i class="fas fa-user-edit"></i> Edit Account</a></li>
            <li><a href="#"><i class="fas fa-lock"></i> Password</a></li>
            <li><a href="{{ url('/account/address') }}" class="{{ Request::is('account/address') ? 'active' : '' }}"><i class="fas fa-address-book"></i> Addresses</a></li>
            <li><a href="#"><i class="fas fa-heart"></i> Saved List</a></li>
            <li><a href="#"><i class="fas fa-desktop"></i> Saved PC</a></li>
            <li><a href="#"><i class="fas fa-star"></i> Star Points</a></li>
            <li><a href="#"><i class="fas fa-exchange-alt"></i> Store Credit</a></li>
        </ul>
    </nav>

    <div class="account-content-wrapper">
        @yield('account_content')
    </div>
</div>
@endsection
