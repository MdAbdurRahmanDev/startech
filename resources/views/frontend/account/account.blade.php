@extends('layouts.app')

@section('title', 'My Account | IOS BD')

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
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
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

        .account-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
        }

        .action-card {
            background: #fff;
            border-radius: 8px;
            padding: 30px 20px;
            text-align: center;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            transition: all 0.3s;
            text-decoration: none;
            color: #081621;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 15px;
        }

        .action-card:hover {
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
            transform: translateY(-5px);
        }

        .action-icon {
            width: 60px;
            height: 60px;
            background: #f0f2f5;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            color: #3b5998;
        }

        .action-label {
            font-size: 14px;
            font-weight: 600;
        }

        @media (max-width: 992px) {
            .account-grid {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        @media (max-width: 768px) {
            .profile-card {
                flex-direction: column;
                gap: 20px;
                text-align: center;
            }

            .profile-info {
                flex-direction: column;
            }

            .account-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .profile-stats {
                width: 100%;
                justify-content: space-around;
            }
        }
    </style>
@endsection

@section('content')
    <div class="container account-container">
        <div class="breadcrumb">
            <a href="{{ url('/') }}"><i class="fas fa-home"></i></a>
            <i class="fas fa-chevron-right"></i>
            <span>Account</span>
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

        <div class="account-grid">
            <a href="{{ url('/account/order') }}" class="action-card">
                <div class="action-icon"><i class="fas fa-list-alt"></i></div>
                <span class="action-label">Orders</span>
            </a>
            <a href="#" class="action-card">
                <div class="action-icon"><i class="fas fa-file-invoice"></i></div>
                <span class="action-label">Quote</span>
            </a>
            <a href="{{ url('/account/edit') }}" class="action-card">
                <div class="action-icon"><i class="fas fa-user-edit"></i></div>
                <span class="action-label">Edit Profile</span>
            </a>
            <a href="#" class="action-card">
                <div class="action-icon"><i class="fas fa-lock"></i></div>
                <span class="action-label">Change Password</span>
            </a>
            <a href="{{ url('/account/address') }}" class="action-card">
                <div class="action-icon"><i class="fas fa-address-book"></i></div>
                <span class="action-label">Addresses</span>
            </a>
            <a href="#" class="action-card">
                <div class="action-icon"><i class="fas fa-heart"></i></div>
                <span class="action-label">Wish List</span>
            </a>
            <a href="#" class="action-card">
                <div class="action-icon"><i class="fas fa-desktop"></i></div>
                <span class="action-label">Saved PC</span>
            </a>
            <a href="#" class="action-card">
                <div class="action-icon"><i class="fas fa-star"></i></div>
                <span class="action-label">Star Points</span>
            </a>
            <a href="#" class="action-card">
                <div class="action-icon"><i class="fas fa-exchange-alt"></i></div>
                <span class="action-label">Your Transactions</span>
            </a>
        </div>
    </div>
@endsection
