@extends('layouts.app')

@section('title', ($product->meta_title ?? $product->name) . ' | Star Tech')

@section('styles')
<style>
    body { background-color: #f8f9fa !important; }

    .product-details-section {
        background-color: #fff;
        padding: 30px;
        border-radius: 8px;
        margin-top: 20px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.04);
    }

    .product-main {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 40px;
    }

    .main-image {
        padding: 30px;
        border: 1px solid #f2f4f8;
        border-radius: 8px;
        margin-bottom: 15px;
        text-align: center;
    }

    .main-image img {
        max-width: 100%;
        max-height: 380px;
        object-fit: contain;
    }

    .thumb-images {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
        justify-content: center;
    }

    .thumb-images img {
        width: 70px;
        height: 70px;
        border: 2px solid #ddd;
        padding: 4px;
        border-radius: 4px;
        cursor: pointer;
        object-fit: contain;
        transition: border-color 0.2s;
    }

    .thumb-images img:hover, .thumb-images img.active {
        border-color: var(--accent-orange);
    }

    .product-info-column h1 {
        font-size: 22px;
        color: var(--accent-blue);
        margin-bottom: 15px;
        line-height: 1.4;
    }

    .meta-tag {
        background-color: #f2f4f8;
        padding: 5px 15px;
        border-radius: 20px;
        font-size: 13px;
        color: #333;
        display: inline-block;
    }

    .key-features ul { list-style: none; }
    .key-features li {
        font-size: 13px;
        color: #555;
        margin-bottom: 8px;
        padding-left: 14px;
        position: relative;
    }
    .key-features li::before {
        content: "•";
        position: absolute;
        left: 0;
        color: var(--accent-orange);
    }

    .payment-options {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 15px;
        margin-top: 25px;
    }

    .payment-card {
        border: 2px solid #ddd;
        padding: 15px;
        border-radius: 8px;
        display: flex;
        align-items: flex-start;
        gap: 12px;
        cursor: pointer;
        transition: border-color 0.2s;
    }

    .payment-card.active { border-color: var(--accent-blue); background-color: #f0f4f9; }
    .price-details h4 { font-size: 18px; color: #333; margin-bottom: 4px; }
    .price-details p { font-size: 12px; color: #666; line-height: 1.5; }

    .buy-actions {
        margin-top: 25px;
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .qty-selector {
        display: flex;
        align-items: center;
        border: 1px solid #ddd;
        border-radius: 4px;
        overflow: hidden;
    }

    .qty-selector button {
        padding: 10px 14px;
        background: #f8f9fa;
        border: none;
        cursor: pointer;
        font-size: 18px;
        line-height: 1;
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
        color: #fff;
        padding: 12px 40px;
        border-radius: 4px;
        text-decoration: none;
        font-weight: bold;
        flex-grow: 1;
        text-align: center;
        display: block;
        transition: background-color 0.2s;
    }
    .buy-now-btn:hover { background-color: var(--accent-orange); color: white; }

    .product-tabs { margin-top: 50px; border-top: 1px solid #ddd; padding-top: 20px; }

    .tabs-nav { display: flex; gap: 8px; margin-bottom: 25px; flex-wrap: wrap; }

    .tab-btn {
        background-color: #f2f4f8;
        padding: 10px 22px;
        border-radius: 4px;
        font-weight: bold;
        font-size: 14px;
        cursor: pointer;
        border: none;
        transition: background-color 0.2s, color 0.2s;
    }

    .tab-btn.active { background-color: var(--accent-orange); color: white; }

    .tab-pane { display: none; }
    .tab-pane.active { display: block; }

    .spec-table { width: 100%; border-collapse: collapse; }
    .spec-table tr:nth-child(even) { background-color: #f8f9fa; }
    .spec-table td { padding: 12px 15px; border-bottom: 1px solid #eee; font-size: 14px; }
    .spec-table td:first-child { color: #666; width: 30%; font-weight: 500; }

    .related-section { margin-top: 50px; border-top: 1px solid #eee; padding-top: 30px; }
    .related-grid {
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        gap: 15px;
        margin-top: 20px;
    }
    .related-card {
        background: #fff;
        border: 1px solid #f2f4f8;
        border-radius: 8px;
        padding: 15px;
        text-align: center;
        transition: box-shadow 0.2s;
    }
    .related-card:hover { box-shadow: 0 4px 15px rgba(0,0,0,0.1); }
    .related-card img { width: 100%; height: 120px; object-fit: contain; margin-bottom: 10px; }
    .related-card h4 { font-size: 12px; color: #333; line-height: 1.4; height: 32px; overflow: hidden; }
    .related-card .price { font-size: 14px; font-weight: bold; color: var(--accent-orange); margin-top: 8px; }

    @media (max-width: 992px) {
        .product-main { grid-template-columns: 1fr; }
        .payment-options { grid-template-columns: 1fr; }
        .related-grid { grid-template-columns: repeat(3, 1fr); }
    }
    @media (max-width: 600px) {
        .related-grid { grid-template-columns: repeat(2, 1fr); }
    }
</style>
@endsection

@section('content')
<div class="container" style="padding-bottom: 60px;">
    <!-- Breadcrumb -->
    <div class="breadcrumb" style="padding: 15px 0; font-size: 13px; color: #666;">
        <a href="{{ url('/') }}" style="color:#333; text-decoration:none;"><i class="fas fa-home"></i></a>
        @foreach($product->categories as $cat)
            / <a href="{{ url('category/' . $cat->slug) }}" style="color:#333; text-decoration:none;">{{ $cat->name }}</a>
        @endforeach
        / <span>{{ Str::limit($product->name, 40) }}</span>
    </div>

    <section class="product-details-section">
        <div class="product-main">
            <!-- Gallery -->
            <div class="product-gallery">
                <div class="main-image">
                    <img id="main-product-image"
                         src="{{ $product->thumbnail ? asset('storage/' . $product->thumbnail) : 'https://placehold.co/400x400/f9fafb/a3a3a3?text=No+Image' }}"
                         alt="{{ $product->name }}">
                </div>
                <div class="thumb-images">
                    <!-- Thumbnail itself as first thumb -->
                    @if($product->thumbnail)
                        <img src="{{ asset('storage/' . $product->thumbnail) }}"
                             alt="{{ $product->name }}"
                             class="active"
                             onclick="switchImage(this, '{{ asset('storage/' . $product->thumbnail) }}')">
                    @endif
                    <!-- Gallery images -->
                    @foreach($product->images as $img)
                        <img src="{{ asset('storage/' . $img->image) }}"
                             alt="{{ $product->name }}"
                             onclick="switchImage(this, '{{ asset('storage/' . $img->image) }}')">
                    @endforeach
                </div>
            </div>

            <!-- Product Info -->
            <div class="product-info-column">
                <h1>{{ $product->name }}</h1>

                <div style="display: flex; flex-wrap: wrap; gap: 10px; margin-bottom: 20px;">
                    <span class="meta-tag">
                        Price:
                        @if($product->discount_price && $product->discount_price < $product->price)
                            <strong style="color: var(--accent-orange);">{{ number_format($product->discount_price, 0) }}৳</strong>
                            <span style="text-decoration: line-through; font-size: 11px; color: #999; margin-left: 4px;">{{ number_format($product->price, 0) }}৳</span>
                        @else
                            <strong style="color: var(--accent-orange);">{{ number_format($product->price, 0) }}৳</strong>
                        @endif
                    </span>
                    <span class="meta-tag">
                        Status: <strong style="color: {{ $product->stock > 0 ? 'green' : '#ef4444' }}">{{ $product->stock > 0 ? 'In Stock' : 'Out of Stock' }}</strong>
                    </span>
                    <span class="meta-tag">Product Code: <strong>#{{ $product->id }}</strong></span>
                    @if($product->categories->count() > 0)
                        <span class="meta-tag">Category: <strong>{{ $product->categories->first()->name }}</strong></span>
                    @endif
                    @if($product->tags)
                        <span class="meta-tag">Tags: <strong>{{ $product->tags }}</strong></span>
                    @endif
                </div>

                @if($product->short_description)
                    <p style="font-size: 13px; color: #555; margin-bottom: 20px; line-height: 1.7;">{{ $product->short_description }}</p>
                @endif

                @if($product->specifications->count() > 0)
                    <div class="key-features">
                        <h3 style="font-size: 16px; margin-bottom: 12px;">Key Features</h3>
                        <ul>
                            @foreach($product->specifications->take(5) as $spec)
                                <li><strong>{{ $spec->name }}:</strong> {{ $spec->value }}</li>
                            @endforeach
                        </ul>
                        @if($product->specifications->count() > 5)
                            <a href="#spec-tab" onclick="switchTab('specification')" style="color: var(--accent-orange); font-size: 13px; text-decoration: none; margin-top: 8px; display: inline-block;">
                                View All Specifications <i class="fas fa-chevron-down" style="font-size: 10px;"></i>
                            </a>
                        @endif
                    </div>
                @endif

                <div class="payment-options">
                    <div class="payment-card active">
                        <input type="radio" checked name="payment" id="cash-payment">
                        <div class="price-details">
                            <h4>{{ number_format($product->discount_price ?? $product->price, 0) }}৳</h4>
                            <p>Cash / Online Price</p>
                            <p>Online / Cash Payment</p>
                        </div>
                    </div>
                    <div class="payment-card">
                        <input type="radio" name="payment" id="emi-payment">
                        <div class="price-details">
                            <h4>{{ number_format(($product->price / 12), 0) }}৳/month</h4>
                            <p>Regular Price: {{ number_format($product->price, 0) }}৳</p>
                            <p>0% EMI up to 12 Months</p>
                        </div>
                    </div>
                </div>

                @if($product->stock > 0)
                    <div class="buy-actions">
                        <div class="qty-selector">
                            <button type="button" onclick="changeQty(-1)">−</button>
                            <input type="number" id="qty" value="1" min="1" max="{{ $product->stock }}">
                            <button type="button" onclick="changeQty(1)">+</button>
                        </div>
                        <a href="#" class="buy-now-btn">
                            <i class="fas fa-shopping-cart" style="margin-right: 8px;"></i>Buy Now
                        </a>
                    </div>
                @else
                    <div style="margin-top: 25px; padding: 15px; background: #fee2e2; border-radius: 8px; color: #b91c1c; font-weight: bold; text-align: center;">
                        <i class="fas fa-times-circle" style="margin-right: 6px;"></i> This product is currently out of stock.
                    </div>
                @endif
            </div>
        </div>

        <!-- Tabs -->
        <div class="product-tabs" id="spec-tab">
            <div class="tabs-nav">
                <button class="tab-btn active" onclick="switchTab('specification')">Specification</button>
                @if($product->description)
                    <button class="tab-btn" onclick="switchTab('description')">Description</button>
                @endif
            </div>

            <!-- Specification Tab -->
            <div id="tab-specification" class="tab-pane active" style="padding: 10px 0;">
                @if($product->specifications->count() > 0)
                    <table class="spec-table">
                        @foreach($product->specifications as $spec)
                            <tr>
                                <td>{{ $spec->name }}</td>
                                <td>{{ $spec->value }}</td>
                            </tr>
                        @endforeach
                    </table>
                @else
                    <p style="color: #999; font-size: 14px;">No specifications available for this product.</p>
                @endif
            </div>

            <!-- Description Tab -->
            @if($product->description)
                <div id="tab-description" class="tab-pane" style="padding: 10px 0; font-size: 14px; line-height: 1.8; color: #444;">
                    {!! $product->description !!}
                </div>
            @endif
        </div>

        <!-- Related Products -->
        @if($relatedProducts->count() > 0)
            <div class="related-section">
                <h2 style="font-size: 18px; font-weight: bold; color: #1e2d52;">Related Products</h2>
                <div class="related-grid">
                    @foreach($relatedProducts as $related)
                        <a href="{{ url('product/' . $related->slug) }}" style="text-decoration: none; color: inherit;">
                            <div class="related-card">
                                <img src="{{ $related->thumbnail ? asset('storage/' . $related->thumbnail) : 'https://placehold.co/228x228/f9fafb/a3a3a3?text=No+Image' }}"
                                     alt="{{ $related->name }}">
                                <h4>{{ $related->name }}</h4>
                                <div class="price">
                                    {{ number_format($related->discount_price ?? $related->price, 0) }}৳
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif
    </section>
</div>

@section('scripts')
<script>
    // Image switcher
    function switchImage(el, src) {
        document.getElementById('main-product-image').src = src;
        document.querySelectorAll('.thumb-images img').forEach(img => img.classList.remove('active'));
        el.classList.add('active');
    }

    // Qty selector
    function changeQty(delta) {
        const input = document.getElementById('qty');
        const max = parseInt(input.max) || 999;
        let val = parseInt(input.value) + delta;
        if (val < 1) val = 1;
        if (val > max) val = max;
        input.value = val;
    }

    // Tab switcher
    function switchTab(name) {
        document.querySelectorAll('.tab-pane').forEach(p => p.classList.remove('active'));
        document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
        const pane = document.getElementById('tab-' + name);
        if (pane) pane.classList.add('active');
        event.target.classList.add('active');
    }

    // Payment card selector
    document.querySelectorAll('.payment-card').forEach(card => {
        card.addEventListener('click', () => {
            document.querySelectorAll('.payment-card').forEach(c => c.classList.remove('active'));
            card.classList.add('active');
            card.querySelector('input[type=radio]').checked = true;
        });
    });
</script>
@endsection
@endsection
