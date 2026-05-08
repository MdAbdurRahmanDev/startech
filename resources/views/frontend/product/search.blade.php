@extends('layouts.app')

@section('title', 'Search - ' . $query . ' | Star Tech')

@section('styles')
<style>
    .search-header {
        margin-top: 20px;
    }

    .search-tags {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-bottom: 30px;
    }

    .search-tag {
        background-color: var(--white);
        border: 1px solid #ddd;
        padding: 5px 15px;
        border-radius: 20px;
        font-size: 13px;
        cursor: pointer;
    }

    .search-tag:hover {
        border-color: var(--accent-orange);
        color: var(--accent-orange);
    }

    .search-results-container {
        background-color: var(--white);
        padding: 15px 20px;
        border-radius: 8px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .product-list-grid {
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        gap: 15px;
    }

    .cat-product-card {
        background-color: var(--white);
        border-radius: 8px;
        padding: 15px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        box-shadow: 0 2px 5px rgba(0,0,0,0.02);
        transition: box-shadow 0.3s;
        position: relative;
    }

    .cat-product-card:hover {
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }

    .product-badge {
        position: absolute;
        top: 0;
        left: 0;
        background-color: #6e2594;
        color: white;
        padding: 4px 10px;
        border-radius: 8px 0 8px 0;
        font-size: 11px;
        font-weight: bold;
        z-index: 1;
    }

    .cat-product-card img {
        width: 100%;
        height: 180px;
        object-fit: contain;
        margin-bottom: 15px;
    }

    .cat-product-card h3 {
        font-size: 14px;
        height: 40px;
        overflow: hidden;
        margin-bottom: 10px;
        color: #333;
    }

    .product-features {
        list-style: none;
        margin-bottom: 15px;
    }

    .product-features li {
        font-size: 12px;
        color: #666;
        margin-bottom: 5px;
        padding-left: 10px;
        position: relative;
    }

    .product-features li::before {
        content: "•";
        position: absolute;
        left: 0;
        color: #ccc;
    }

    .price-box {
        border-top: 1px solid #eee;
        padding-top: 15px;
        text-align: center;
    }

    .cat-price {
        font-size: 16px;
        font-weight: bold;
        color: var(--accent-orange);
        display: block;
        margin-bottom: 10px;
    }

    .old-price {
        font-size: 11px;
        color: #666;
        text-decoration: line-through;
        margin-left: 5px;
    }

    .buy-btn {
        background: none;
        border: 1px solid #ddd;
        padding: 8px;
        width: 100%;
        border-radius: 4px;
        font-size: 13px;
        font-weight: bold;
        color: var(--accent-blue);
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 5px;
        margin-bottom: 8px;
    }

    .buy-btn:hover {
        background-color: var(--accent-blue);
        color: white;
    }

    .compare-btn {
        background: none;
        border: none;
        color: #666;
        font-size: 11px;
        cursor: pointer;
    }

    @media (max-width: 1400px) {
        .product-list-grid { grid-template-columns: repeat(4, 1fr); }
    }
    @media (max-width: 1100px) {
        .product-list-grid { grid-template-columns: repeat(3, 1fr); }
    }
    @media (max-width: 768px) {
        .product-list-grid { grid-template-columns: repeat(2, 1fr); }
    }
</style>
@endsection

@section('content')
<div class="container">
    <div class="breadcrumb" style="padding: 15px 0; font-size: 13px;">
        <a href="#"><i class="fas fa-home"></i></a> / Search
    </div>

    <div class="search-header">
        <div class="search-tags">
            <span class="search-tag">Google Earbuds</span>
            <span class="search-tag">Google Tablet</span>
            <span class="search-tag">Google Pixel Mobile Phone</span>
            <span class="search-tag">Google Smart Watch</span>
        </div>
    </div>

    <div class="search-results-container">
        <h1 style="font-size: 16px;">Search - {{ $query }}</h1>
        <div class="sort-options" style="font-size: 13px;">
            Show: <select><option>20</option></select>
        </div>
    </div>

    <section class="product-list-grid">
        <!-- Product 1 -->
        <div class="cat-product-card">
            <div class="product-image">
                <img src="https://www.startech.com.bd/image/cache/catalog/cable/google/google-30w-type-c-to-type-c-cable/google-30w-type-c-to-type-c-cable-01-228x228.webp" alt="Cable">
            </div>
            <h3>Google 30W Type C to Type C Cable</h3>
            <ul class="product-features">
                <li>Connector: Type-C to Type-C</li>
                <li>Material: TPE</li>
                <li>Cable Length: 1.0 meter</li>
            </ul>
            <div class="price-box">
                <span class="cat-price">820৳</span>
                <button class="buy-btn"><i class="fas fa-shopping-cart"></i> Buy Now</button>
                <button class="compare-btn"><i class="fas fa-plus"></i> Add to Compare</button>
            </div>
        </div>
        <!-- Product 2 -->
        <div class="cat-product-card">
            <div class="product-badge">Save: 200৳</div>
            <div class="product-image">
                <img src="https://www.startech.com.bd/image/cache/catalog/adapter/google/30w-usb-c-power-adapter/30w-usb-c-power-adapter-01-228x228.webp" alt="Adapter">
            </div>
            <h3>Google 30W Type C Charger Adapter (2 Pin)</h3>
            <ul class="product-features">
                <li>Interface: Type-C</li>
                <li>Input: 100-240V, 50/60 Hz</li>
                <li>Output: PD: 5V/3A, 15V/3A...</li>
            </ul>
            <div class="price-box">
                <span class="cat-price">2,450৳ <span class="old-price">2,650৳</span></span>
                <button class="buy-btn"><i class="fas fa-shopping-cart"></i> Buy Now</button>
                <button class="compare-btn"><i class="fas fa-plus"></i> Add to Compare</button>
            </div>
        </div>
        <!-- Product 3 -->
        <div class="cat-product-card">
            <div class="product-badge">Save: 245৳</div>
            <div class="product-image">
                <img src="https://www.startech.com.bd/image/cache/catalog/adapter/google/45w-usb-c-power-adapter/45w-usb-c-power-adapter-01-228x228.webp" alt="Adapter">
            </div>
            <h3>Google 45W Type C Charger Adapter (2 Pin)</h3>
            <ul class="product-features">
                <li>Interface: Type-C</li>
                <li>Input: 100-240V, 50/60 Hz</li>
                <li>Output: PD: 5V/3A, 9V/3A...</li>
            </ul>
            <div class="price-box">
                <span class="cat-price">2,550৳ <span class="old-price">2,795৳</span></span>
                <button class="buy-btn"><i class="fas fa-shopping-cart"></i> Buy Now</button>
                <button class="compare-btn"><i class="fas fa-plus"></i> Add to Compare</button>
            </div>
        </div>
        <!-- Product 4 -->
        <div class="cat-product-card">
            <div class="product-badge">Save: 2,499৳</div>
            <div class="product-image">
                <img src="https://www.startech.com.bd/image/cache/catalog/smart-watch/google/pixel-watch-3/pixel-watch-3-matte-black-01-228x228.webp" alt="Watch">
            </div>
            <h3>Google Pixel Watch 3</h3>
            <ul class="product-features">
                <li>45mm Actua Display (AMOLED)</li>
                <li>Protection: 3D Gorilla Glass 5</li>
                <li>5 ATM/IP68 Water Resistance</li>
            </ul>
            <div class="price-box">
                <span class="cat-price">42,500৳ <span class="old-price">44,999৳</span></span>
                <button class="buy-btn"><i class="fas fa-shopping-cart"></i> Buy Now</button>
                <button class="compare-btn"><i class="fas fa-plus"></i> Add to Compare</button>
            </div>
        </div>
        <!-- Product 5 -->
        <div class="cat-product-card">
            <div class="product-badge">Save: 3,249৳</div>
            <div class="product-image">
                <img src="https://www.startech.com.bd/image/cache/catalog/mobile/google/pixel-7-pro/pixel-7-pro-01-228x228.jpg" alt="Phone">
            </div>
            <h3>Google Pixel 7 Pro</h3>
            <ul class="product-features">
                <li>Display: 6.7-inch QHD+ OLED</li>
                <li>Processor: Google Tensor G2</li>
                <li>Camera: Triple 50 + 48 + 12MP</li>
            </ul>
            <div class="price-box">
                <span class="cat-price">56,750৳ <span class="old-price">59,999৳</span></span>
                <button class="buy-btn"><i class="fas fa-shopping-cart"></i> Buy Now</button>
                <button class="compare-btn"><i class="fas fa-plus"></i> Add to Compare</button>
            </div>
        </div>
    </section>
</div>
@endsection
