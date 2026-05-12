@extends('layouts.app')

@section('title', 'My Wishlist | IOS BD')

@section('styles')
    <style>
        .account-container { padding: 30px 0; }
        .breadcrumb { display: flex; align-items: center; gap: 10px; font-size: 13px; color: #666; margin-bottom: 25px; }
        .breadcrumb a { text-decoration: none; color: #081621; }
        .breadcrumb i { font-size: 10px; color: #ccc; }
        
        .wishlist-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
            gap: 20px;
        }
        
        .empty-wishlist {
            text-align: center;
            padding: 100px 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }
        
        .empty-wishlist i { font-size: 60px; color: #eee; margin-bottom: 20px; }
    </style>
@endsection

@section('content')
    <div class="container account-container">
        <div class="breadcrumb">
            <a href="{{ url('/') }}"><i class="fas fa-home"></i></a>
            <i class="fas fa-chevron-right"></i>
            <a href="{{ route('user.account') }}">Account</a>
            <i class="fas fa-chevron-right"></i>
            <span>Wishlist</span>
        </div>

        <h1 class="text-2xl font-bold mb-8">My Wishlist</h1>

        @if($wishlists->count() > 0)
            <div class="wishlist-grid">
                @foreach($wishlists as $item)
                    @php $product = $item->product; @endphp
                    @if($product)
                    <div class="bg-white rounded-lg shadow-sm border border-gray-50 overflow-hidden group hover:shadow-xl transition-all flex flex-col h-full relative">
                        <button onclick="toggleWishlist({{ $product->id }}, this)" 
                                class="absolute top-2 right-2 w-8 h-8 rounded-full bg-white shadow-md flex items-center justify-center text-accent-orange z-20 hover:scale-110 transition-transform">
                            <i class="fas fa-heart"></i>
                        </button>
                        
                        <a href="{{ url('product/' . $product->slug) }}" class="p-4 aspect-square overflow-hidden bg-gray-50 flex items-center justify-center block">
                            <img src="{{ $product->thumbnail ? asset('storage/' . $product->thumbnail) : 'https://placehold.co/228x228/f9fafb/a3a3a3?text=No+Image' }}"
                                alt="{{ $product->name }}" class="w-full h-full object-contain group-hover:scale-110 transition-transform duration-500">
                        </a>
                        
                        <div class="p-4 flex flex-col flex-grow">
                            <h3 class="text-sm font-bold text-primary-dark hover:text-accent-orange line-clamp-2 leading-snug h-10">
                                <a href="{{ url('product/' . $product->slug) }}">{{ $product->name }}</a>
                            </h3>
                            
                            <div class="mt-4 pt-4 border-t border-gray-100 flex flex-col gap-3">
                                <div class="flex items-center gap-2">
                                    @if ($product->discount_price && $product->discount_price < $product->price)
                                        <span class="text-accent-orange font-bold text-base">{{ number_format($product->discount_price, 0) }}৳</span>
                                        <span class="text-gray-400 line-through text-xs">{{ number_format($product->price, 0) }}৳</span>
                                    @else
                                        <span class="text-accent-orange font-bold text-base">{{ number_format($product->price, 0) }}৳</span>
                                    @endif
                                </div>
                                <button onclick="buyNow({{ $product->id }})" class="w-full bg-primary-dark text-white text-sm font-bold py-2 rounded hover:bg-accent-orange transition-all flex items-center justify-center gap-2">
                                    <i class="fas fa-shopping-cart text-xs"></i> Buy Now
                                </button>
                            </div>
                        </div>
                    </div>
                    @endif
                @endforeach
            </div>
        @else
            <div class="empty-wishlist">
                <i class="fas fa-heart"></i>
                <h2 class="text-xl font-bold text-gray-400">Your wishlist is empty!</h2>
                <p class="text-gray-400 mt-2">Add products to your wishlist to save them for later.</p>
                <a href="{{ url('/') }}" class="inline-block mt-6 bg-accent-orange text-white px-8 py-3 rounded font-bold hover:bg-opacity-90 transition-all">Start Shopping</a>
            </div>
        @endif
    </div>
@endsection

@section('scripts')
<script>
    function toggleWishlist(productId, element) {
        fetch('{{ route('wishlist.toggle') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ product_id: productId })
        })
        .then(response => {
            if (response.status === 401) {
                window.location.href = '{{ route('login') }}';
                return;
            }
            return response.json();
        })
        .then(data => {
            if (data && data.status === 'removed') {
                // If we are on the wishlist page, we might want to remove the card
                if (window.location.pathname.includes('/account/wishlist')) {
                    element.closest('.group').remove();
                    if (document.querySelectorAll('.wishlist-grid .group').length === 0) {
                        location.reload();
                    }
                } else {
                    const icon = element.querySelector('i');
                    icon.classList.remove('fas');
                    icon.classList.add('far');
                }
            } else if (data && data.status === 'added') {
                const icon = element.querySelector('i');
                icon.classList.remove('far');
                icon.classList.add('fas');
            }
        });
    }
</script>
@endsection
