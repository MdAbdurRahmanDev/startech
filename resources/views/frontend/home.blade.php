@extends('layouts.app')

@section('title', 'Star Tech | Leading IT Shop in Bangladesh')

@section('styles')
<style>
    /* Hero Section */
    .hero-section {
        margin-top: 25px;
        display: grid;
        grid-template-columns: 2.2fr 1fr;
        gap: 20px;
    }

    .main-slider {
        background-color: var(--white);
        border-radius: 8px;
        overflow: hidden;
        position: relative;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        height: 450px;
    }

    .side-banners {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .banner-card {
        background-color: #fff;
        border-radius: 8px;
        height: 215px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        padding: 0;
        text-align: center;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        background-size: cover;
        background-position: center;
        position: relative;
        overflow: hidden;
    }

    /* Info Bar */
    .info-bar {
        background-color: var(--white);
        margin: 25px 0;
        padding: 10px 30px;
        border-radius: 50px;
        display: block;
        overflow: hidden;
        box-shadow: 0 2px 5px rgba(0,0,0,0.05);
    }

    /* Feature Icons */
    .features-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 20px;
        margin-bottom: 30px;
    }

    .feature-card {
        background-color: var(--white);
        padding: 20px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        gap: 20px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        transition: transform 0.2s;
        cursor: pointer;
    }

    .feature-card:hover {
        transform: translateY(-3px);
    }

    .feature-icon {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        color: var(--white);
    }

    .icon-orange { background-color: var(--accent-orange); }

    .feature-info h4 {
        font-size: 16px;
        font-weight: bold;
    }

    .feature-info p {
        font-size: 13px;
        color: var(--text-muted);
    }

    /* Category Grid */
    .category-grid {
        display: grid;
        grid-template-columns: repeat(8, 1fr);
        gap: 15px;
        margin-top: 20px;
    }

    .category-item {
        background-color: var(--white);
        border-radius: 12px;
        padding: 20px 10px;
        text-align: center;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 15px;
        transition: all 0.3s;
        cursor: pointer;
        box-shadow: 0 2px 5px rgba(0,0,0,0.02);
    }

    .category-item:hover {
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        color: var(--accent-orange);
    }

    .category-item i {
        font-size: 35px;
        color: #444;
    }

    .category-item:hover i {
        color: var(--accent-orange);
    }

    .category-item span {
        font-size: 13px;
        font-weight: 500;
    }

    /* Store Banner */
    .store-banner {
        background: linear-gradient(90deg, #00d2ff 0%, #3a7bd5 50%, #081621 100%);
        border-radius: 10px;
        padding: 30px 40px;
        margin: 50px 0;
        display: flex;
        justify-content: space-between;
        align-items: center;
        color: var(--white);
    }

    .store-info {
        display: flex;
        align-items: center;
        gap: 20px;
    }

    .store-info i.fa-location-dot {
        font-size: 40px;
    }

    .store-text h2 {
        font-size: 24px;
        margin-bottom: 5px;
    }

    .store-text p {
        font-size: 14px;
        opacity: 0.9;
    }

    .find-store-btn {
        background-color: var(--accent-orange);
        color: var(--white);
        padding: 12px 30px;
        border-radius: 30px;
        text-decoration: none;
        font-weight: bold;
        display: flex;
        align-items: center;
        gap: 10px;
        transition: transform 0.2s;
    }

    .find-store-btn:hover {
        transform: scale(1.05);
    }

    /* Product Grid */
    .product-grid {
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        gap: 15px;
        margin-top: 30px;
    }

    .product-card {
        background-color: var(--white);
        border-radius: 8px;
        padding: 15px;
        position: relative;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        transition: box-shadow 0.3s;
        box-shadow: 0 2px 5px rgba(0,0,0,0.02);
        height: 100%;
    }

    .product-card:hover {
        box-shadow: 0 5px 20px rgba(0,0,0,0.1);
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

    .product-image {
        width: 100%;
        height: 200px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 15px;
        padding: 10px;
    }

    .product-image img {
        max-width: 100%;
        max-height: 100%;
        object-fit: contain;
    }

    .product-info h3 {
        font-size: 14px;
        font-weight: 500;
        color: #333;
        margin-bottom: 15px;
        line-height: 1.4;
        height: 40px;
        overflow: hidden;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
    }

    .product-info h3:hover {
        color: var(--accent-orange);
        text-decoration: underline;
    }

    .product-price {
        display: flex;
        flex-direction: column;
        gap: 5px;
    }

    .current-price {
        color: var(--accent-orange);
        font-size: 18px;
        font-weight: bold;
    }

    .old-price {
        color: #666;
        font-size: 13px;
        text-decoration: line-through;
    }

    .load-more-container {
        text-align: center;
        margin: 40px 0 60px;
    }

    .load-more-btn {
        background-color: var(--white);
        color: var(--text-dark);
        border: 1px solid #ddd;
        padding: 10px 40px;
        border-radius: 4px;
        text-decoration: none;
        font-weight: 600;
        font-size: 14px;
        transition: all 0.3s;
    }

    .load-more-btn:hover {
        background-color: var(--accent-orange);
        color: var(--white);
        border-color: var(--accent-orange);
    }

    /* SEO Text Section */
    .seo-section {
        margin-top: 60px;
        padding: 40px 0;
        color: #444;
    }

    .seo-section h1, .seo-section h2 {
        font-size: 18px;
        font-weight: bold;
        margin: 25px 0 15px;
        color: #081621;
    }

    .seo-section p {
        font-size: 13px;
        line-height: 1.8;
        margin-bottom: 15px;
    }

    .seo-section a {
        color: var(--accent-orange);
        text-decoration: none;
    }

    .seo-section a:hover {
        text-decoration: underline;
    }

    @media (max-width: 1200px) {
        .hero-section { grid-template-columns: 1fr; }
        .category-grid { grid-template-columns: repeat(4, 1fr); }
        .product-grid { grid-template-columns: repeat(3, 1fr); }
    }
    @media (max-width: 768px) {
        .category-grid { grid-template-columns: repeat(2, 1fr); }
        .product-grid { grid-template-columns: repeat(2, 1fr); }
        .features-grid { grid-template-columns: repeat(2, 1fr); }
        .store-banner { flex-direction: column; text-align: center; gap: 20px; }
    }
</style>
@endsection

@section('content')
<div class="container">
    <section class="hero-section">
        <div class="main-slider">
            <img src="https://www.startech.com.bd/image/cache/catalog/home/banner/freezer-offer-home-banner-982x500.webp" style="width: 100%; height: 100%; object-fit: cover;" alt="Main Banner">
            <div style="position: absolute; bottom: 15px; left: 50%; transform: translateX(-50%); display: flex; gap: 8px;">
                <span style="width: 15px; height: 15px; background: var(--accent-orange); border-radius: 50%;"></span>
                <span style="width: 15px; height: 15px; background: #ccc; border-radius: 50%;"></span>
                <span style="width: 15px; height: 15px; background: #ccc; border-radius: 50%;"></span>
            </div>
        </div>

        <div class="side-banners">
            <div class="banner-card">
                <img src="https://www.startech.com.bd/image/catalog/home/banner/app-home-banner.webp" style="width: 100%; height: 100%; object-fit: cover; border-radius: 8px;" alt="Mobile App">
            </div>
            <div class="banner-card">
                <img src="https://www.startech.com.bd/image/catalog/home/banner/ac-calculator-home-banner.webp" style="width: 100%; height: 100%; object-fit: cover; border-radius: 8px;" alt="AC Calculator">
            </div>
        </div>
    </section>

    <div class="info-bar">
        <marquee behavior="scroll" direction="left" scrollamount="5" style="font-size: 13px; color: var(--text-muted);">
            Friday, 08 May, All our branches are open except Narayanganj, Mymensingh, Rajshahi, Chattogram Agrabad, Rangpur & Khulna branch. Additionally, our online activities are open and operational.
        </marquee>
    </div>

    <section class="features-grid">
        <div class="feature-card">
            <div class="feature-icon icon-orange">
                <i class="fas fa-laptop"></i>
            </div>
            <div class="feature-info">
                <h4>Laptop Finder</h4>
                <p>Find Your Laptop Easily</p>
            </div>
        </div>
        <div class="feature-card">
            <div class="feature-icon icon-orange">
                <i class="fas fa-comment-dots"></i>
            </div>
            <div class="feature-info">
                <h4>Raise a Complain</h4>
                <p>Share your experience</p>
            </div>
        </div>
        <div class="feature-card">
            <div class="feature-icon icon-orange">
                <i class="fas fa-tools"></i>
            </div>
            <div class="feature-info">
                <h4>Home Service</h4>
                <p>Get expert help.</p>
            </div>
        </div>
        <div class="feature-card">
            <div class="feature-icon icon-orange">
                <i class="fas fa-user-gear"></i>
            </div>
            <div class="feature-info">
                <h4>Servicing Center</h4>
                <p>Repair Your Device</p>
            </div>
        </div>
    </section>

    <div style="text-align: center; margin-top: 50px;">
        <h2 style="font-size: 22px; font-weight: bold;">Featured Category</h2>
        <p style="color: #666; font-size: 14px; margin-top: 5px;">Get Your Desired Product from Featured Category!</p>
    </div>

    <section class="category-grid">
        <div class="category-item">
            <i class="fas fa-satellite"></i>
            <span>Starlink</span>
        </div>
        <div class="category-item">
            <i class="fas fa-charging-station"></i>
            <span>Portable Power Station</span>
        </div>
        <div class="category-item">
            <i class="fas fa-helicopter"></i>
            <span>Drone</span>
        </div>
        <div class="category-item">
            <i class="fas fa-camera-rotate"></i>
            <span>Gimbal</span>
        </div>
        <div class="category-item">
            <i class="fas fa-tablet-screen-button"></i>
            <span>Tablet PC</span>
        </div>
        <div class="category-item">
            <i class="fas fa-tv"></i>
            <span>TV</span>
        </div>
        <div class="category-item">
            <i class="fas fa-mobile-screen-button"></i>
            <span>Mobile Phone</span>
        </div>
        <div class="category-item">
            <i class="fas fa-plug-circle-bolt"></i>
            <span>Mobile Accessories</span>
        </div>
        <div class="category-item">
            <i class="fas fa-hard-drive"></i>
            <span>Portable SSD</span>
        </div>
        <div class="category-item">
            <i class="fas fa-video"></i>
            <span>WiFi Camera</span>
        </div>
        <div class="category-item">
            <i class="fas fa-scissors"></i>
            <span>Trimmer</span>
        </div>
        <div class="category-item">
            <i class="fas fa-clock"></i>
            <span>Smart Watch</span>
        </div>
        <div class="category-item">
            <i class="fas fa-camera"></i>
            <span>Action Camera</span>
        </div>
        <div class="category-item">
            <i class="fas fa-ear-listen"></i>
            <span>Earbuds</span>
        </div>
        <div class="category-item">
            <i class="fas fa-volume-high"></i>
            <span>Bluetooth Speakers</span>
        </div>
        <div class="category-item">
            <i class="fas fa-gamepad"></i>
            <span>Gaming Console</span>
        </div>
    </section>

    <section class="store-banner">
        <div class="store-info">
            <i class="fas fa-location-dot"></i>
            <div class="store-text">
                <h2>20+ Physical Stores</h2>
                <p>Visit Our Store & Get Your Desired IT Product!</p>
            </div>
        </div>
        <a href="#" class="find-store-btn">Find Our Store <i class="fas fa-search"></i></a>
    </section>

    <div style="text-align: center; margin-top: 60px;">
        <h2 style="font-size: 22px; font-weight: bold;">Featured Products</h2>
        <p style="color: #666; font-size: 14px; margin-top: 5px;">Check & Get Your Desired Product!</p>
    </div>

    <section class="product-grid">
        <!-- Product 1 -->
        <a href="{{ url('/product/beko-ac') }}" style="text-decoration: none; color: inherit;">
        <div class="product-card">
            <div class="product-badge">Save: 21,837৳ (-26%)</div>
            <div class="product-image">
                <img src="https://www.startech.com.bd/image/cache/catalog/air-conditioner/beko/bnvha-180-181/bnvha-180-181-01-228x228.webp" alt="Product">
            </div>
            <div class="product-info">
                <h3>Beko 1.5 Ton Inverter AC</h3>
                <div class="product-price">
                    <span class="current-price">62,153৳</span>
                    <span class="old-price">83,990৳</span>
                </div>
            </div>
        </div>
        </a>
        <!-- More products... (I'll keep them simplified for now) -->
        @for($i=0; $i<9; $i++)
        <div class="product-card">
            <div class="product-badge">Hot Deal</div>
            <div class="product-image">
                <img src="https://www.startech.com.bd/image/cache/catalog/ups/ecoflow/river-3/river-3-01-228x228.webp" alt="Product">
            </div>
            <div class="product-info">
                <h3>EcoFlow River 3 UPS & Portable Power Station</h3>
                <div class="product-price">
                    <span class="current-price">27,250৳</span>
                </div>
            </div>
        </div>
        @endfor
    </section>

    <div class="load-more-container">
        <a href="#" class="load-more-btn">Load More</a>
    </div>

    <section class="seo-section">
        <h1>Leading Computer, Laptop & Gaming PC Retail & Online Shop in Bangladesh</h1>
        <p>Technology has become a part of our daily lives, and we depend on tech products daily for a vast portion of our lives. There is hardly a home in Bangladesh without a tech product. This is where we come in. <a href="#">Star Tech Ltd.</a>, started as a Tech Product Shop in March 2007. We focus on giving the best customer service in Bangladesh, following our motto of <strong>"Customer Comes First."</strong> This is why Star Tech is the most <strong>trusted computer shop in Bangladesh</strong> today, capturing the loyalty of a large customer base.</p>

        <h2>Best Laptop Shop in Bangladesh</h2>
        <p>Star Tech is the most popular <a href="#">Laptop Brand Shop in BD</a>. Star Tech <a href="#">Laptop</a> Shop has the perfect device, whether you are a freelancer, officegoer, or student. Gamers love our collection of <a href="#">Gaming Laptops</a> because we always bring the latest laptops in Bangladesh.</p>

        <h2>Best Desktop PC Shop In Bangladesh</h2>
        <p><a href="#">Star Tech</a> has the most comprehensive array of <a href="#">Desktop PCs</a>. We offer top-of-the-line Custom PC, <a href="#">Brand PC</a>, All-in-One PC, and <a href="#">Portable Mini PC</a> at Star Tech outlets.</p>
    </section>
</div>
@endsection
