@extends('layouts.app')

@section('title', 'EcoFlow River 3 UPS & Portable Power Station | Star Tech')

@section('styles')
<style>
    body {
        background-color: var(--white) !important;
    }
    
    .product-details-section {
        background-color: var(--white);
        padding: 30px 0;
        margin-top: 20px;
    }

    .breadcrumb {
        padding: 15px 0;
        font-size: 13px;
        color: #666;
    }

    .breadcrumb a {
        color: #333;
        text-decoration: none;
    }

    .breadcrumb a:hover {
        color: var(--accent-orange);
    }

    .product-main {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 50px;
        margin-top: 20px;
    }

    .product-gallery {
        text-align: center;
    }

    .main-image {
        padding: 40px;
        border: 1px solid #f2f4f8;
        border-radius: 8px;
        margin-bottom: 20px;
    }

    .main-image img {
        max-width: 100%;
        height: auto;
    }

    .thumb-images {
        display: flex;
        justify-content: center;
        gap: 15px;
    }

    .thumb-images img {
        width: 60px;
        height: 60px;
        border: 1px solid #ddd;
        padding: 5px;
        border-radius: 4px;
        cursor: pointer;
    }

    .product-info-column h1 {
        font-size: 24px;
        color: var(--accent-blue);
        margin-bottom: 20px;
    }

    .product-meta-tags {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-bottom: 25px;
    }

    .meta-tag {
        background-color: #f2f4f8;
        padding: 5px 15px;
        border-radius: 20px;
        font-size: 13px;
        color: #333;
    }

    .key-features {
        margin-top: 30px;
    }

    .key-features h3 {
        font-size: 18px;
        margin-bottom: 15px;
    }

    .key-features ul {
        list-style: none;
    }

    .key-features li {
        margin-bottom: 10px;
        font-size: 14px;
        color: #333;
    }

    .payment-options {
        margin-top: 40px;
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }

    .payment-card {
        border: 1px solid #ddd;
        padding: 20px;
        border-radius: 8px;
        display: flex;
        align-items: flex-start;
        gap: 15px;
        cursor: pointer;
        transition: border-color 0.2s;
    }

    .payment-card.active {
        border-color: var(--accent-blue);
        background-color: #f0f4f9;
    }

    .price-details h4 {
        font-size: 20px;
        color: #333;
        margin-bottom: 5px;
    }

    .price-details p {
        font-size: 12px;
        color: #666;
    }

    .buy-actions {
        margin-top: 40px;
        display: flex;
        align-items: center;
        gap: 20px;
    }

    .qty-selector {
        display: flex;
        align-items: center;
        border: 1px solid #ddd;
        border-radius: 4px;
    }

    .qty-selector button {
        padding: 10px 15px;
        background: none;
        border: none;
        cursor: pointer;
        font-size: 18px;
    }

    .qty-selector input {
        width: 50px;
        text-align: center;
        border: none;
        border-left: 1px solid #ddd;
        border-right: 1px solid #ddd;
        padding: 10px 0;
    }

    .buy-now-btn {
        background-color: var(--accent-blue);
        color: var(--white);
        padding: 12px 60px;
        border-radius: 4px;
        text-decoration: none;
        font-weight: bold;
        flex-grow: 1;
        text-align: center;
    }

    .product-tabs {
        margin-top: 60px;
        border-top: 1px solid #ddd;
        padding-top: 20px;
    }

    .tabs-nav {
        display: flex;
        gap: 10px;
        margin-bottom: 30px;
    }

    .tab-btn {
        background-color: #f2f4f8;
        padding: 10px 25px;
        border-radius: 4px;
        font-weight: bold;
        font-size: 14px;
        cursor: pointer;
    }

    .tab-btn.active {
        background-color: #ef4a23;
        color: white;
    }

    @media (max-width: 992px) {
        .product-main { grid-template-columns: 1fr; }
        .payment-options { grid-template-columns: 1fr; }
    }
</style>
@endsection

@section('content')
<div class="container">
    <div class="breadcrumb">
        <a href="#"><i class="fas fa-home"></i></a> / <a href="#">Power</a> / <a href="#">Portable Power Station</a> / EcoFlow River 3
    </div>

    <section class="product-details-section">
        <div class="product-main">
            <div class="product-gallery">
                <div class="main-image">
                    <img src="https://www.startech.com.bd/image/cache/catalog/ups/ecoflow/river-3/river-3-01-500x500.webp" alt="EcoFlow River 3">
                </div>
                <div class="thumb-images">
                    <img src="https://www.startech.com.bd/image/cache/catalog/ups/ecoflow/river-3/river-3-01-500x500.webp" alt="Thumb">
                    <img src="https://www.startech.com.bd/image/cache/catalog/ups/ecoflow/river-3/river-3-02-500x500.webp" alt="Thumb">
                </div>
            </div>

            <div class="product-info-column">
                <h1>EcoFlow River 3 UPS & Portable Power Station</h1>
                
                <div class="product-meta-tags">
                    <span class="meta-tag">Price: <strong style="color: var(--accent-orange);">27,250৳</strong> <span style="text-decoration: line-through; font-size: 11px; color: #666;">29,500৳</span></span>
                    <span class="meta-tag">Regular Price: <strong>30,828৳</strong></span>
                    <span class="meta-tag">Status: <strong style="color: green;">In Stock</strong></span>
                    <span class="meta-tag">Product Code: <strong>42548</strong></span>
                    <span class="meta-tag">Brand: <strong>EcoFlow</strong></span>
                </div>

                <div class="key-features">
                    <h3>Key Features</h3>
                    <ul>
                        <li>Model: RIVER 3</li>
                        <li>AC Output: 300W (600W X-Boost)</li>
                        <li>AC Output Voltage: 120V~60Hz</li>
                        <li>Battery Capacity: 245Wh LiFePO4</li>
                        <li>Charging by AC, Solar, Car, Generator</li>
                    </ul>
                    <a href="#" style="color: var(--accent-orange); font-size: 13px; text-decoration: none; margin-top: 10px; display: inline-block;">View More Info</a>
                </div>

                <div class="payment-options">
                    <div class="payment-card active">
                        <input type="radio" checked name="payment">
                        <div class="price-details">
                            <h4>27,250৳</h4>
                            <p>Cash Discount Price</p>
                            <p>Online / Cash Payment</p>
                        </div>
                    </div>
                    <div class="payment-card">
                        <input type="radio" name="payment">
                        <div class="price-details">
                            <h4>2,569৳/month</h4>
                            <p>Regular Price: 30,828৳</p>
                            <p>0% EMI for up to 12 Months***</p>
                        </div>
                    </div>
                </div>

                <div class="buy-actions">
                    <div class="qty-selector">
                        <button>-</button>
                        <input type="text" value="1">
                        <button>+</button>
                    </div>
                    <a href="#" class="buy-now-btn">Buy Now</a>
                </div>
            </div>
        </div>

        <div class="product-tabs">
            <div class="tabs-nav">
                <div class="tab-btn active">Specification</div>
                <div class="tab-btn">Description</div>
                <div class="tab-btn">Questions (2)</div>
                <div class="tab-btn">Reviews (1)</div>
            </div>

            <div class="tab-content" style="padding: 20px;">
                <h3 style="margin-bottom: 20px;">Specification</h3>
                <table style="width: 100%; border-collapse: collapse;">
                    <tr style="border-bottom: 1px solid #eee;">
                        <td style="padding: 10px; width: 30%; color: #666;">Model</td>
                        <td style="padding: 10px;">RIVER 3</td>
                    </tr>
                    <tr style="border-bottom: 1px solid #eee;">
                        <td style="padding: 10px; color: #666;">Capacity</td>
                        <td style="padding: 10px;">245Wh</td>
                    </tr>
                    <!-- More rows... -->
                </table>
            </div>
        </div>
    </section>
</div>
@endsection
