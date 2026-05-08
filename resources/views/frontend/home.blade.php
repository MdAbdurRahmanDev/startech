<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Star Tech | Leading IT Shop in Bangladesh</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-dark: #081621;
            --accent-orange: #ef4a23;
            --accent-blue: #2c64b0;
            --bg-gray: #f2f4f8;
            --text-dark: #081621;
            --text-muted: #666;
            --white: #ffffff;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: var(--bg-gray);
            color: var(--text-dark);
        }

        /* Header Styles */
        header {
            background-color: var(--primary-dark);
            padding: 15px 0;
            color: var(--white);
        }

        .container {
            max-width: 1320px;
            margin: 0 auto;
            padding: 0 15px;
        }

        .header-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
        }

        .logo img {
            height: 50px;
        }

        .search-bar {
            flex-grow: 1;
            max-width: 700px;
            position: relative;
            margin: 0 20px;
        }

        .search-bar input {
            width: 100%;
            padding: 10px 40px 10px 15px;
            border-radius: 4px;
            border: none;
            outline: none;
        }

        .search-bar i {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-dark);
        }

        .header-actions {
            display: flex;
            align-items: center;
            gap: 25px;
        }

        .action-item {
            display: flex;
            align-items: center;
            gap: 10px;
            cursor: pointer;
        }

        .action-item i {
            color: var(--accent-orange);
            font-size: 20px;
        }

        .action-text {
            display: flex;
            flex-direction: column;
        }

        .action-text .label {
            font-size: 15px;
            font-weight: bold;
        }

        .action-text .sub-label {
            font-size: 12px;
            color: #ccc;
        }

        .pc-builder-btn {
            background-color: var(--accent-blue);
            color: var(--white);
            padding: 12px 25px;
            border-radius: 4px;
            text-decoration: none;
            font-weight: bold;
            font-size: 15px;
            transition: background 0.3s;
        }

        .pc-builder-btn:hover {
            background-color: #1e4d8c;
        }

        /* Nav Styles */
        nav {
            background-color: var(--white);
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .nav-list {
            display: flex;
            list-style: none;
            justify-content: space-between;
            padding: 0;
        }

        .nav-list > li {
            position: relative;
            padding: 15px 0;
        }

        .nav-list li a {
            text-decoration: none;
            color: var(--text-dark);
            font-size: 14px;
            font-weight: 600;
            transition: color 0.2s;
        }

        .nav-list li a:hover {
            color: var(--accent-orange);
        }

        /* Dropdown Styles */
        .dropdown {
            position: absolute;
            top: 100%;
            left: 0;
            background-color: var(--white);
            min-width: 200px;
            box-shadow: 0 8px 16px rgba(0,0,0,0.1);
            display: none;
            z-index: 1002;
            list-style: none;
            padding: 10px 0;
            border-top: 2px solid var(--accent-orange);
        }

        .nav-list > li:hover > .dropdown {
            display: block;
        }

        .dropdown li {
            position: relative;
        }

        .dropdown li a {
            padding: 10px 20px;
            display: block;
            font-weight: 500;
            color: #333;
            font-size: 13px;
        }

        .dropdown li a:hover {
            background-color: #f8f9fa;
            color: var(--accent-orange);
        }

        /* Sub-dropdown */
        .sub-dropdown {
            position: absolute;
            top: 0;
            left: 100%;
            background-color: var(--white);
            min-width: 200px;
            box-shadow: 0 8px 16px rgba(0,0,0,0.1);
            display: none;
            list-style: none;
            padding: 10px 0;
        }

        .dropdown li:hover > .sub-dropdown {
            display: block;
        }

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

        .slider-content {
            height: 450px;
            display: flex;
            align-items: center;
            padding: 40px;
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        }

        .slider-text h2 {
            font-size: 32px;
            margin-bottom: 15px;
            color: var(--accent-blue);
        }

        .slider-text p {
            font-size: 18px;
            margin-bottom: 25px;
            color: var(--text-muted);
        }

        .slider-image img {
            max-width: 100%;
            height: auto;
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

        .banner-card.mobile-app {
            background-color: #fcece8;
        }

        .banner-card.calculator {
            background-color: #e3f2fd;
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

        .info-bar span {
            font-size: 13px;
            color: var(--text-muted);
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

        /* Floating Buttons */
        .floating-actions {
            position: fixed;
            right: 0;
            top: 70%;
            display: flex;
            flex-direction: column;
            gap: 5px;
            z-index: 1001;
        }

        .float-btn {
            background-color: var(--primary-dark);
            color: var(--white);
            width: 60px;
            height: 60px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            border-radius: 5px 0 0 5px;
            cursor: pointer;
            position: relative;
        }

        .float-btn i {
            font-size: 20px;
            margin-bottom: 3px;
        }

        .float-btn span {
            font-size: 9px;
            text-transform: uppercase;
            font-weight: bold;
        }

        .badge {
            position: absolute;
            top: 5px;
            right: 5px;
            background-color: var(--accent-orange);
            color: var(--white);
            font-size: 10px;
            width: 18px;
            height: 18px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
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

        @media (max-width: 1200px) {
            .category-grid { grid-template-columns: repeat(4, 1fr); }
        }
        @media (max-width: 768px) {
            .category-grid { grid-template-columns: repeat(2, 1fr); }
            .store-banner { flex-direction: column; text-align: center; gap: 20px; }
        }
    </style>
</head>
<body>

<header>
    <div class="container header-top">
        <div class="logo">
            <img src="https://www.startech.com.bd/image/catalog/logo.png" alt="Star Tech">
        </div>
        
        <div class="search-bar">
            <input type="text" placeholder="Search">
            <i class="fas fa-search"></i>
        </div>

        <div class="header-actions">
            <div class="action-item">
                <i class="fas fa-gift"></i>
                <div class="action-text">
                    <span class="label">Offers</span>
                    <span class="sub-label">Latest Offers</span>
                </div>
            </div>
            <div class="action-item">
                <i class="fas fa-bolt"></i>
                <div class="action-text">
                    <span class="label">Happy Hour</span>
                    <span class="sub-label">Special Deals</span>
                </div>
            </div>
            <div class="action-item">
                <i class="fas fa-user"></i>
                <div class="action-text">
                    <span class="label">Account</span>
                    <span class="sub-label">Register or Login</span>
                </div>
            </div>
            <a href="#" class="pc-builder-btn">PC Builder</a>
        </div>
    </div>
</header>

<nav>
    <div class="container">
        <ul class="nav-list">
            <li><a href="#">Desktop</a></li>
            <li>
                <a href="#">Laptop</a>
                <ul class="dropdown">
                    <li><a href="#">All Laptop</a></li>
                    <li><a href="#">Gaming Laptop</a></li>
                    <li><a href="#">Premium Ultrabook</a></li>
                    <li><a href="#">Laptop Bag</a></li>
                    <li><a href="#">Laptop Accessories</a></li>
                    <li><a href="#">Laptop Finder</a></li>
                    <li>
                        <a href="#">Laptop Brands <i class="fas fa-chevron-right" style="font-size: 10px; float: right; margin-top: 4px;"></i></a>
                        <ul class="sub-dropdown">
                            <li><a href="#">Lenovo</a></li>
                            <li><a href="#">HP</a></li>
                            <li><a href="#">Asus</a></li>
                            <li><a href="#">MSI</a></li>
                            <li><a href="#">Gigabyte</a></li>
                            <li><a href="#">Acer</a></li>
                            <li><a href="#">Dell</a></li>
                            <li><a href="#">Apple</a></li>
                            <li><a href="#">Surface</a></li>
                            <li><a href="#">Razer</a></li>
                            <li><a href="#">Huawei</a></li>
                            <li><a href="#">Chuwi</a></li>
                            <li><a href="#">Microsoft</a></li>
                            <li><a href="#">Avita</a></li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li><a href="#">Component</a></li>
            <li><a href="#">Monitor</a></li>
            <li><a href="#">Power</a></li>
            <li><a href="#">Phone</a></li>
            <li><a href="#">Tablet</a></li>
            <li><a href="#">Office Equipment</a></li>
            <li><a href="#">Camera</a></li>
            <li><a href="#">Security</a></li>
            <li><a href="#">Networking</a></li>
            <li><a href="#">Software</a></li>
            <li><a href="#">Server & Storage</a></li>
            <li><a href="#">Accessories</a></li>
            <li><a href="#">Gadget</a></li>
            <li><a href="#">Gaming</a></li>
            <li><a href="#">TV</a></li>
            <li><a href="#">Appliance</a></li>
        </ul>
    </div>
</nav>

<main class="container">
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
</main>

<div class="floating-actions">
    <div class="float-btn">
        <div class="badge">0</div>
        <i class="fas fa-shuffle"></i>
        <span>Compare</span>
    </div>
    <div class="float-btn">
        <div class="badge">0</div>
        <i class="fas fa-shopping-basket"></i>
        <span>Cart</span>
    </div>
</div>

</body>
</html>
