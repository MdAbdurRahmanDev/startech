@extends('layouts.app')

@section('title', 'CPU Cooler Price in Bangladesh | Star Tech')

@section('styles')
<style>
    .category-container {
        display: grid;
        grid-template-columns: 280px 1fr;
        gap: 20px;
        margin-top: 20px;
    }

    .filter-sidebar {
        background-color: transparent;
    }

    .filter-card {
        background-color: var(--white);
        border-radius: 8px;
        padding: 20px;
        margin-bottom: 20px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.02);
    }

    .filter-card h3 {
        font-size: 16px;
        margin-bottom: 15px;
        padding-bottom: 10px;
        border-bottom: 1px solid #eee;
    }

    .filter-list {
        list-style: none;
    }

    .filter-list li {
        margin-bottom: 10px;
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 14px;
        color: #444;
    }

    .price-range-slider {
        margin-top: 20px;
    }

    .range-inputs {
        display: flex;
        justify-content: space-between;
        margin-top: 10px;
    }

    .range-inputs input {
        width: 80px;
        padding: 5px;
        border: 1px solid #ddd;
        text-align: center;
        font-size: 13px;
    }

    .category-content-header {
        background-color: var(--white);
        padding: 15px 20px;
        border-radius: 8px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .brand-tags {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-bottom: 30px;
    }

    .brand-tag {
        background-color: var(--white);
        border: 1px solid #ddd;
        padding: 5px 15px;
        border-radius: 20px;
        font-size: 13px;
        cursor: pointer;
    }

    .brand-tag:hover {
        border-color: var(--accent-orange);
        color: var(--accent-orange);
    }

    .product-list-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
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
    }

    .cat-product-card:hover {
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
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
        font-size: 18px;
        font-weight: bold;
        color: var(--accent-orange);
        display: block;
        margin-bottom: 10px;
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

    @media (max-width: 1200px) {
        .product-list-grid { grid-template-columns: repeat(3, 1fr); }
    }

    @media (max-width: 992px) {
        .category-container { grid-template-columns: 1fr; }
        .filter-sidebar { display: none; }
    }
</style>
@endsection

@section('content')
<div class="container">
    <div class="breadcrumb" style="padding: 15px 0; font-size: 13px;">
        <a href="#"><i class="fas fa-home"></i></a> / <a href="#">Component</a> / CPU Cooler
    </div>

    <div class="category-header">
        <h1 style="font-size: 22px; margin-bottom: 10px;">CPU Cooler Price in Bangladesh</h1>
        <p style="font-size: 13px; color: #666; margin-bottom: 25px;">CPU Cooler Price in Bangladesh starts from BDT 300 to BDT 51,500 depending on the brand, model, and features.</p>

        <div class="brand-tags">
            <span class="brand-tag">MSI</span>
            <span class="brand-tag">Antec</span>
            <span class="brand-tag">Gamdias</span>
            <span class="brand-tag">ARCTIC</span>
            <span class="brand-tag">Corsair</span>
            <span class="brand-tag">DeepCool</span>
            <span class="brand-tag">NZXT</span>
            <span class="brand-tag">Cooler Master</span>
        </div>
    </div>

    <div class="category-container">
        <aside class="filter-sidebar">
            <div class="filter-card">
                <h3>Price Range</h3>
                <div class="price-range-slider">
                    <input type="range" style="width: 100%; accent-color: var(--accent-orange);">
                    <div class="range-inputs">
                        <input type="text" value="0">
                        <input type="text" value="51,500">
                    </div>
                </div>
            </div>

            <div class="filter-card">
                <h3>Availability</h3>
                <ul class="filter-list">
                    <li><input type="checkbox"> In Stock</li>
                    <li><input type="checkbox"> Pre Order</li>
                    <li><input type="checkbox"> Up Coming</li>
                </ul>
            </div>

            <div class="filter-card">
                <h3>Brand</h3>
                <ul class="filter-list">
                    <li><input type="checkbox"> Antec</li>
                    <li><input type="checkbox"> Gamdias</li>
                    <li><input type="checkbox"> Corsair</li>
                    <li><input type="checkbox"> MSI</li>
                    <li><input type="checkbox"> DeepCool</li>
                </ul>
            </div>
        </aside>

        <section class="category-content">
            <div class="category-content-header">
                <h2 style="font-size: 16px;">CPU Cooler</h2>
                <div class="sort-options" style="font-size: 13px;">
                    Show: <select><option>20</option></select>
                    Sort By: <select><option>Default</option></select>
                </div>
            </div>

            <div class="product-list-grid">
                <!-- Product 1 -->
                <div class="cat-product-card">
                    <img src="https://www.startech.com.bd/image/cache/catalog/component/cpu-cooler/deepcool/ck-11509/ck-11509-01-228x228.jpg" alt="Cooler">
                    <h3>Deepcool CK-11509 CPU Cooler</h3>
                    <ul class="product-features">
                        <li>Radial aluminum heatsink</li>
                        <li>Fan Dimension: 92X25mm</li>
                        <li>Rated Voltage: 12VDC</li>
                    </ul>
                    <div class="price-box">
                        <span class="cat-price">400৳</span>
                        <button class="buy-btn"><i class="fas fa-shopping-cart"></i> Buy Now</button>
                        <button class="compare-btn"><i class="fas fa-plus"></i> Add to Compare</button>
                    </div>
                </div>
                <!-- Product 2 -->
                <div class="cat-product-card">
                    <img src="https://www.startech.com.bd/image/cache/catalog/component/cpu-cooler/deepcool/alta-9/alta-9-01-228x228.jpg" alt="Cooler">
                    <h3>DeepCool ALTA 9 Air CPU Cooler</h3>
                    <ul class="product-features">
                        <li>Fan Dimension: Ø92X25mm</li>
                        <li>Fan Speed: 2200±10%RPM</li>
                        <li>Bearing Type: Hydro Bearing</li>
                    </ul>
                    <div class="price-box">
                        <span class="cat-price">550৳</span>
                        <button class="buy-btn"><i class="fas fa-shopping-cart"></i> Buy Now</button>
                        <button class="compare-btn"><i class="fas fa-plus"></i> Add to Compare</button>
                    </div>
                </div>
                <!-- Product 3 -->
                <div class="cat-product-card">
                    <img src="https://www.startech.com.bd/image/cache/catalog/component/cpu-cooler/value-top/glacio-x100/glacio-x100-01-228x228.webp" alt="Cooler">
                    <h3>Value-Top GLACIO X100 RGB Air CPU Cooler</h3>
                    <ul class="product-features">
                        <li>Fan speed: 800-2600 RPM ± 10%</li>
                        <li>Max Air Flow: 43 CFM ± 10%</li>
                        <li>Max Noise Level: 31.5 dBA ± 10%</li>
                    </ul>
                    <div class="price-box">
                        <span class="cat-price">800৳</span>
                        <button class="buy-btn"><i class="fas fa-shopping-cart"></i> Buy Now</button>
                        <button class="compare-btn"><i class="fas fa-plus"></i> Add to Compare</button>
                    </div>
                </div>
                <!-- Product 4 -->
                <div class="cat-product-card">
                    <img src="https://www.startech.com.bd/image/cache/catalog/component/cpu-cooler/deepcool/ice-edge-mini-fs-v2/ice-edge-mini-fs-v2-1-228x228.jpg" alt="Cooler">
                    <h3>DeepCool ICE EDGE MINI FS V2.0 CPU Air Cooler</h3>
                    <ul class="product-features">
                        <li>Fan Speed: 2200 RPM±10%</li>
                        <li>Fan Connector: 3-pin</li>
                        <li>Hydro Bearing</li>
                    </ul>
                    <div class="price-box">
                        <span class="cat-price">1,150৳</span>
                        <button class="buy-btn"><i class="fas fa-shopping-cart"></i> Buy Now</button>
                        <button class="compare-btn"><i class="fas fa-plus"></i> Add to Compare</button>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection
