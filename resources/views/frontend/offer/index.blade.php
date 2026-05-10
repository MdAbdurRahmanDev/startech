@extends('layouts.app')

@section('title', 'Special Offers | Iosbd')

@section('styles')
    <style>
        .offer-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 25px;
            margin-top: 30px;
            margin-bottom: 60px;
        }

        .offer-card {
            background-color: var(--white);
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            display: flex;
            flex-direction: column;
            transition: transform 0.3s;
        }

        .offer-card:hover {
            transform: translateY(-5px);
        }

        .offer-banner {
            width: 100%;
            height: 350px;
            overflow: hidden;
        }

        .offer-banner img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .offer-info {
            padding: 20px;
            text-align: center;
        }

        .offer-meta {
            display: flex;
            justify-content: space-between;
            padding: 10px 20px;
            border-bottom: 1px solid #eee;
            font-size: 12px;
            color: #666;
        }

        .offer-meta div {
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .offer-title {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 10px;
            color: #333;
        }

        .offer-desc {
            font-size: 13px;
            color: #666;
            margin-bottom: 20px;
            line-height: 1.5;
        }

        .view-details-btn {
            background-color: var(--accent-blue);
            color: var(--white);
            padding: 10px 25px;
            border-radius: 4px;
            text-decoration: none;
            font-weight: bold;
            font-size: 14px;
            display: inline-block;
            transition: background 0.3s;
        }

        .view-details-btn:hover {
            background-color: #1e4d8c;
        }

        @media (max-width: 992px) {
            .offer-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 600px) {
            .offer-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <div class="breadcrumb" style="padding: 15px 0; font-size: 13px;">
            <a href="#"><i class="fas fa-home"></i></a> / Offer
        </div>

        <div class="offer-grid">
            <!-- Offer 1 -->
            <div class="offer-card">
                <div class="offer-banner">
                    <img src="https://www.startech.com.bd/image/catalog/offer/2026/fan-deal/fan-offer-thumb.webp"
                        alt="Ceiling Fan Deal">
                </div>
                <div class="offer-meta">
                    <div><i class="far fa-calendar-alt"></i> 06 May 2026 - 31 May 2026</div>
                    <div><i class="fas fa-globe"></i> Online</div>
                </div>
                <div class="offer-info">
                    <h2 class="offer-title">Ceiling Fan Deal</h2>
                    <p class="offer-desc">Buy Your Ceiling Fan & Get Exciting Discounts!</p>
                    <a href="#" class="view-details-btn">View Details</a>
                </div>
            </div>

            <!-- Offer 2 -->
            <div class="offer-card">
                <div class="offer-banner">
                    <img src="https://www.startech.com.bd/image/catalog/offer/2026/ac-offer/ac-deal-thumb.webp"
                        alt="AC Deal">
                </div>
                <div class="offer-meta">
                    <div><i class="far fa-calendar-alt"></i> 15 Apr 2026 - 31 May 2026</div>
                    <div><i class="fas fa-store"></i> All Outlet</div>
                </div>
                <div class="offer-info">
                    <h2 class="offer-title">Air Conditioner Deal</h2>
                    <p class="offer-desc">Buy AC & Enjoy Exciting Discount with Free Delivery!</p>
                    <a href="#" class="view-details-btn">View Details</a>
                </div>
            </div>

            <!-- Offer 3 -->
            <div class="offer-card">
                <div class="offer-banner">
                    <img src="https://www.startech.com.bd/image/catalog/offer/2026/home-appliances-deal/home-appliances-deal-thumb.webp"
                        alt="Home Appliances">
                </div>
                <div class="offer-meta">
                    <div><i class="far fa-calendar-alt"></i> 06 May 2026 - 31 May 2026</div>
                    <div><i class="fas fa-store"></i> All Outlet</div>
                </div>
                <div class="offer-info">
                    <h2 class="offer-title">Home Appliances Deal</h2>
                    <p class="offer-desc">Buy Home Appliances & Get Exciting Discount!</p>
                    <a href="#" class="view-details-btn">View Details</a>
                </div>
            </div>

            <!-- Offer 4 -->
            <div class="offer-card">
                <div class="offer-banner">
                    <img src="https://www.startech.com.bd/image/catalog/offer/2026/mobile-offer/mobile-offer-thumb.webp"
                        alt="Mobile Offer">
                </div>
                <div class="offer-meta">
                    <div><i class="far fa-calendar-alt"></i> 01 May 2026 - 31 May 2026</div>
                    <div><i class="fas fa-store"></i> All Outlet</div>
                </div>
                <div class="offer-info">
                    <h2 class="offer-title">Summer Mobile Deal</h2>
                    <p class="offer-desc">Get special discounts on latest smartphones!</p>
                    <a href="#" class="view-details-btn">View Details</a>
                </div>
            </div>
        </div>
    </div>
@endsection
