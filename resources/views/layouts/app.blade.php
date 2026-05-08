<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Star Tech | Leading IT Shop in Bangladesh')</title>
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

        .container {
            max-width: 1320px;
            margin: 0 auto;
            padding: 0 15px;
        }

        /* Header Styles */
        header {
            background-color: var(--primary-dark);
            padding: 15px 0;
            color: var(--white);
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

        /* Header Icons & Toggle */
        .menu-toggle {
            display: none;
            font-size: 24px;
            cursor: pointer;
            color: var(--white);
        }

        .header-right-icons {
            display: none;
            gap: 20px;
            align-items: center;
        }

        .header-icon {
            position: relative;
            font-size: 20px;
            cursor: pointer;
            color: var(--white);
        }

        .header-icon .badge {
            top: -8px;
            right: -8px;
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

        /* Footer Styles */
        footer {
            background-color: #081621;
            color: var(--white);
            padding: 60px 0 20px;
            margin-top: 50px;
        }

        .footer-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 40px;
        }

        .footer-col h3 {
            font-size: 16px;
            font-weight: bold;
            text-transform: uppercase;
            margin-bottom: 25px;
            letter-spacing: 1px;
        }

        .footer-col ul {
            list-style: none;
        }

        .footer-col ul li {
            margin-bottom: 12px;
        }

        .footer-col ul li a {
            color: #8c9296;
            text-decoration: none;
            font-size: 13px;
            transition: color 0.2s;
        }

        .footer-col ul li a:hover {
            color: var(--accent-orange);
            text-decoration: underline;
        }

        .contact-item {
            display: flex;
            align-items: center;
            gap: 15px;
            background-color: #11212d;
            padding: 15px 20px;
            border-radius: 50px;
            margin-bottom: 15px;
            border: 1px solid #1e2e3a;
        }

        .contact-item i {
            color: var(--accent-orange);
            font-size: 20px;
        }

        .contact-text .label {
            font-size: 11px;
            color: #8c9296;
            display: block;
        }

        .contact-text .value {
            font-size: 18px;
            font-weight: bold;
            color: var(--accent-orange);
        }

        .footer-bottom {
            margin-top: 60px;
            padding-top: 20px;
            border-top: 1px solid #1e2e3a;
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: #8c9296;
            font-size: 12px;
        }

        .social-icons {
            display: flex;
            gap: 15px;
        }

        .social-icons a {
            color: var(--white);
            font-size: 18px;
            opacity: 0.7;
            transition: opacity 0.2s;
        }

        .social-icons a:hover {
            opacity: 1;
            color: var(--accent-orange);
        }

        .app-buttons {
            display: flex;
            gap: 15px;
        }

        .app-btn img {
            height: 35px;
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

        @media (max-width: 992px) {
            header {
                padding: 10px 0;
            }
            .header-top {
                display: flex;
                justify-content: space-between;
                align-items: center;
                gap: 15px;
            }
            .menu-toggle {
                display: block;
            }
            .header-right-icons {
                display: flex;
            }
            .header-actions, .search-bar.desktop-search {
                display: none;
            }
            .logo img {
                height: 35px;
            }
            .nav-list {
                display: none;
            }
            .footer-grid { grid-template-columns: repeat(2, 1fr); }
            .footer-bottom { flex-direction: column; gap: 20px; text-align: center; }
        }

        /* Off-canvas Menu */
        .off-canvas-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
            z-index: 3000;
            display: none;
            opacity: 0;
            transition: opacity 0.3s;
        }

        .off-canvas-sidebar {
            position: fixed;
            top: 0;
            left: -280px;
            width: 280px;
            height: 100%;
            background: var(--white);
            z-index: 3001;
            transition: left 0.3s ease-in-out;
            padding: 20px;
            box-shadow: 2px 0 10px rgba(0,0,0,0.1);
        }

        .off-canvas-menu.active .off-canvas-overlay {
            display: block;
            opacity: 1;
        }

        .off-canvas-menu.active .off-canvas-sidebar {
            left: 0;
        }

        .off-canvas-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            padding-bottom: 15px;
            border-bottom: 1px solid #eee;
        }

        .close-menu {
            font-size: 20px;
            cursor: pointer;
            color: var(--text-dark);
        }

        .off-canvas-list {
            list-style: none;
        }

        .off-canvas-list li {
            margin-bottom: 15px;
        }

        .off-canvas-list li a {
            text-decoration: none;
            color: var(--text-dark);
            font-size: 15px;
            font-weight: 500;
            display: block;
            padding: 8px 0;
        }

        @media (max-width: 768px) {
            .header-top {
                padding: 10px 15px;
            }
            .logo img {
                height: 35px;
            }
            .footer-grid {
                grid-template-columns: 1fr;
            }
            .floating-actions {
                bottom: 80px; /* Shift up for bottom nav */
                top: auto;
            }
        }

        /* Mobile Bottom Nav */
        .mobile-bottom-nav {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            background-color: var(--primary-dark);
            display: none;
            justify-content: space-around;
            padding: 10px 0;
            z-index: 2000;
            box-shadow: 0 -2px 10px rgba(0,0,0,0.2);
        }

        @media (max-width: 992px) {
            .mobile-bottom-nav {
                display: flex;
            }
            body {
                padding-bottom: 70px; /* Space for bottom nav */
            }
        }

        .mobile-nav-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            color: var(--white);
            text-decoration: none;
            font-size: 10px;
            gap: 5px;
            opacity: 0.8;
            transition: opacity 0.2s;
        }

        .mobile-nav-item:hover, .mobile-nav-item.active {
            opacity: 1;
            color: var(--accent-orange);
        }

        .mobile-nav-item i {
            font-size: 18px;
        }
    </style>
    @yield('styles')
</head>
<body>

<header>
    <div class="container header-top">
        <div class="menu-toggle" id="menuToggle">
            <i class="fas fa-bars"></i>
        </div>
        <div class="logo">
            <a href="{{ url('/') }}"><img src="https://www.startech.com.bd/image/catalog/logo.png" alt="Star Tech"></a>
        </div>
        
        <div class="search-bar desktop-search">
            <input type="text" placeholder="Search">
            <i class="fas fa-search"></i>
        </div>

        <div class="header-right-icons">
            <div class="header-icon mobile-search-toggle">
                <i class="fas fa-search"></i>
            </div>
            <div class="header-icon header-cart">
                <i class="fas fa-shopping-basket"></i>
                <span class="badge">0</span>
            </div>
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

<main>
    @yield('content')
</main>

<footer>
    <div class="container">
        <div class="footer-grid">
            <div class="footer-col">
                <h3>Support</h3>
                <div class="contact-item">
                    <i class="fas fa-phone"></i>
                    <div class="contact-text">
                        <span class="label">9 AM - 8 PM</span>
                        <span class="value">16793</span>
                    </div>
                </div>
                <div class="contact-item">
                    <i class="fas fa-location-dot"></i>
                    <div class="contact-text">
                        <span class="label">Store Locator</span>
                        <span class="value">Find Our Stores</span>
                    </div>
                </div>
            </div>
            <div class="footer-col">
                <h3>About Us</h3>
                <ul>
                    <li><a href="#">EMI Terms</a></li>
                    <li><a href="#">Privacy Policy</a></li>
                    <li><a href="#">Star Point Policy</a></li>
                    <li><a href="#">Brands</a></li>
                    <li><a href="#">About Us</a></li>
                    <li><a href="#">Terms and Conditions</a></li>
                    <li><a href="#">Blog</a></li>
                    <li><a href="#">Contact Us</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h3>Stay Connected</h3>
                <p style="font-size: 13px; color: #8c9296; line-height: 1.6; margin-bottom: 15px;">
                    <strong>Star Tech Ltd</strong><br>
                    Head Office: 28 Kazi Nazrul Islam<br>
                    Ave, Navana Zohura Square, Dhaka 1000
                </p>
                <p style="font-size: 13px; color: #8c9296;">
                    Email:<br>
                    <a href="mailto:webteam@startechbd.com" style="color: var(--accent-orange); text-decoration: none;">webteam@startechbd.com</a>
                </p>
            </div>
            <div class="footer-col">
                <div class="app-buttons" style="margin-top: 40px;">
                    <a href="#" class="app-btn"><img src="https://www.startech.com.bd/catalog/view/theme/starship/images/google-play.png" alt="Google Play"></a>
                    <a href="#" class="app-btn"><img src="https://www.startech.com.bd/catalog/view/theme/starship/images/app-store.png" alt="App Store"></a>
                </div>
                <div class="social-icons" style="margin-top: 30px;">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-youtube"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <p>© 2026 Star Tech Ltd | All rights reserved</p>
            <p>Powered By: Star Tech</p>
        </div>
    </div>
</footer>

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

<div class="mobile-bottom-nav">
    <a href="{{ url('/') }}" class="mobile-nav-item {{ Request::is('/') ? 'active' : '' }}">
        <i class="fas fa-home"></i>
        <span>Home</span>
    </a>
    <a href="{{ url('/offers') }}" class="mobile-nav-item {{ Request::is('offers') ? 'active' : '' }}">
        <i class="fas fa-gift"></i>
        <span>Offers</span>
    </a>
    <a href="#" class="mobile-nav-item">
        <i class="fas fa-tools"></i>
        <span>PC Builder</span>
    </a>
    <a href="#" class="mobile-nav-item">
        <i class="fas fa-shuffle"></i>
        <span>Compare (0)</span>
    </a>
    <a href="{{ url('/account/account') }}" class="mobile-nav-item {{ Request::is('account/*') ? 'active' : '' }}">
        <i class="fas fa-user"></i>
        <span>Account</span>
    </a>
</div>

<div class="off-canvas-menu" id="offCanvasMenu">
    <div class="off-canvas-overlay" id="menuOverlay"></div>
    <div class="off-canvas-sidebar">
        <div class="off-canvas-header">
            <img src="https://www.startech.com.bd/image/catalog/logo.png" alt="Star Tech" style="height: 30px;">
            <div class="close-menu" id="closeMenu">
                <i class="fas fa-times"></i>
            </div>
        </div>
        <ul class="off-canvas-list">
            <li><a href="#">Desktop</a></li>
            <li><a href="#">Laptop</a></li>
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
        </ul>
    </div>
</div>

<script>
    const menuToggle = document.getElementById('menuToggle');
    const offCanvasMenu = document.getElementById('offCanvasMenu');
    const menuOverlay = document.getElementById('menuOverlay');
    const closeMenu = document.getElementById('closeMenu');

    function toggleMenu() {
        offCanvasMenu.classList.toggle('active');
        document.body.style.overflow = offCanvasMenu.classList.contains('active') ? 'hidden' : '';
    }

    menuToggle.addEventListener('click', toggleMenu);
    menuOverlay.addEventListener('click', toggleMenu);
    closeMenu.addEventListener('click', toggleMenu);
</script>

@yield('scripts')

</body>
</html>
