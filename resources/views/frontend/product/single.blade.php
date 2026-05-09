@extends('layouts.app')

@section('title', ($product->meta_title ?? $product->name) . ' | Star Tech')

@section('content')
<div class="container pb-14">
    <!-- Breadcrumb -->
    <div class="py-4 text-[13px] text-gray-600">
        <a href="{{ url('/') }}" class="text-gray-800 no-underline hover:text-accent-orange transition-colors"><i class="fas fa-home"></i></a>
        @foreach($product->categories as $cat)
            / <a href="{{ url('category/' . $cat->slug) }}" class="text-gray-800 no-underline hover:text-accent-orange transition-colors">{{ $cat->name }}</a>
        @endforeach
        / <span class="text-gray-500">{{ Str::limit($product->name, 40) }}</span>
    </div>

    <section class="bg-white p-5 md:p-[30px] rounded-lg mt-5 shadow-sm">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">
            <!-- Gallery -->
            <div>
                <div class="p-5 md:p-[30px] border border-[#f2f4f8] rounded-lg mb-[15px] text-center">
                    <img id="main-product-image"
                         src="{{ $product->thumbnail ? asset('storage/' . $product->thumbnail) : 'https://placehold.co/400x400/f9fafb/a3a3a3?text=No+Image' }}"
                         alt="{{ $product->name }}" class="max-w-full max-h-[380px] object-contain mx-auto transition-all duration-300">
                </div>
                <div class="flex gap-2.5 flex-wrap justify-center thumb-images">
                    <!-- Thumbnail itself as first thumb -->
                    @if($product->thumbnail)
                        <img src="{{ asset('storage/' . $product->thumbnail) }}"
                             alt="{{ $product->name }}"
                             class="w-[70px] h-[70px] border-2 border-gray-200 p-1 rounded cursor-pointer object-contain transition-colors hover:border-accent-orange [&.active]:border-accent-orange active"
                             onclick="switchImage(this, '{{ asset('storage/' . $product->thumbnail) }}')">
                    @endif
                    <!-- Gallery images -->
                    @foreach($product->images as $img)
                        <img src="{{ asset('storage/' . $img->image) }}"
                             alt="{{ $product->name }}"
                             class="w-[70px] h-[70px] border-2 border-gray-200 p-1 rounded cursor-pointer object-contain transition-colors hover:border-accent-orange [&.active]:border-accent-orange"
                             onclick="switchImage(this, '{{ asset('storage/' . $img->image) }}')">
                    @endforeach
                </div>
            </div>

            <!-- Product Info -->
            <div>
                <h1 class="text-[22px] text-accent-blue mb-[15px] leading-snug font-bold">{{ $product->name }}</h1>

                <div class="flex flex-wrap gap-2.5 mb-5">
                    <span class="bg-[#f2f4f8] py-1 px-3.5 rounded-full text-[13px] text-gray-800 inline-block">
                        Price:
                        @if($product->discount_price && $product->discount_price < $product->price)
                            <strong class="text-accent-orange">{{ number_format($product->discount_price, 0) }}৳</strong>
                            <span class="line-through text-[11px] text-gray-400 ml-1">{{ number_format($product->price, 0) }}৳</span>
                        @else
                            <strong class="text-accent-orange">{{ number_format($product->price, 0) }}৳</strong>
                        @endif
                    </span>
                    <span class="bg-[#f2f4f8] py-1 px-3.5 rounded-full text-[13px] text-gray-800 inline-block">
                        Status: <strong class="{{ $product->stock > 0 ? 'text-green-600' : 'text-red-500' }}">{{ $product->stock > 0 ? 'In Stock' : 'Out of Stock' }}</strong>
                    </span>
                    <span class="bg-[#f2f4f8] py-1 px-3.5 rounded-full text-[13px] text-gray-800 inline-block">Product Code: <strong>#{{ $product->id }}</strong></span>
                    @if($product->categories->count() > 0)
                        <span class="bg-[#f2f4f8] py-1 px-3.5 rounded-full text-[13px] text-gray-800 inline-block">Category: <strong>{{ $product->categories->first()->name }}</strong></span>
                    @endif
                    @if($product->tags)
                        <span class="bg-[#f2f4f8] py-1 px-3.5 rounded-full text-[13px] text-gray-800 inline-block">Tags: <strong>{{ $product->tags }}</strong></span>
                    @endif
                </div>

                @if($product->short_description)
                    <p class="text-[13px] text-gray-600 mb-5 leading-relaxed">{{ $product->short_description }}</p>
                @endif

                @if($product->specifications->count() > 0)
                    <div class="mb-5">
                        <h3 class="text-[16px] mb-3 font-bold text-gray-800">Key Features</h3>
                        <ul class="list-none space-y-2">
                            @foreach($product->specifications->take(5) as $spec)
                                <li class="text-[13px] text-gray-600 pl-3.5 relative before:content-['•'] before:absolute before:left-0 before:text-accent-orange"><strong>{{ $spec->name }}:</strong> {{ $spec->value }}</li>
                            @endforeach
                        </ul>
                        @if($product->specifications->count() > 5)
                            <a href="#specification" class="text-accent-orange text-[13px] no-underline mt-2 inline-block transition-colors hover:text-orange-700">
                                View All Specifications <i class="fas fa-chevron-down text-[10px] ml-1"></i>
                            </a>
                        @endif
                    </div>
                @endif

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-6">
                    <div class="payment-card active border-2 border-accent-blue bg-[#f0f4f9] p-4 rounded-lg flex items-start gap-3 cursor-pointer transition-colors">
                        <input type="radio" checked name="payment" id="cash-payment" class="mt-1 accent-accent-blue">
                        <div>
                            <h4 class="text-[18px] text-gray-800 mb-1 font-bold">{{ number_format($product->discount_price ?? $product->price, 0) }}৳</h4>
                            <p class="text-[12px] text-gray-600 leading-relaxed">Cash / Online Price</p>
                            <p class="text-[12px] text-gray-600 leading-relaxed">Online / Cash Payment</p>
                        </div>
                    </div>
                    <div class="payment-card border-2 border-gray-200 p-4 rounded-lg flex items-start gap-3 cursor-pointer transition-colors hover:border-accent-blue">
                        <input type="radio" name="payment" id="emi-payment" class="mt-1 accent-accent-blue">
                        <div>
                            <h4 class="text-[18px] text-gray-800 mb-1 font-bold">{{ number_format(($product->price / 12), 0) }}৳/month</h4>
                            <p class="text-[12px] text-gray-600 leading-relaxed">Regular Price: {{ number_format($product->price, 0) }}৳</p>
                            <p class="text-[12px] text-gray-600 leading-relaxed">0% EMI up to 12 Months</p>
                        </div>
                    </div>
                </div>

                @if($product->stock > 0)
                    <div class="mt-6 flex flex-col gap-4">
                        <div class="flex flex-wrap items-center gap-4">
                            <div class="flex items-center border border-gray-300 rounded overflow-hidden">
                                <button type="button" onclick="changeQty(-1)" class="px-3.5 py-2 bg-gray-50 hover:bg-gray-100 transition-colors cursor-pointer text-[18px] leading-none text-gray-700">−</button>
                                <input type="number" id="qty" value="1" min="1" max="{{ $product->stock }}" class="w-[50px] text-center border-x border-gray-300 py-2.5 outline-none text-[15px] font-semibold text-gray-800 appearance-none m-0">
                                <button type="button" onclick="changeQty(1)" class="px-3.5 py-2 bg-gray-50 hover:bg-gray-100 transition-colors cursor-pointer text-[18px] leading-none text-gray-700">+</button>
                            </div>
                            <button onclick="buyNow({{ $product->id }})" class="bg-accent-blue text-white py-3 px-8 rounded font-bold flex-grow text-center transition-colors hover:bg-accent-orange shadow-sm flex items-center justify-center gap-2">
                                <i class="fas fa-shopping-cart"></i> Buy Now
                            </button>
                            <button onclick="addToCart({{ $product->id }})" class="bg-gray-800 text-white py-3 px-8 rounded font-bold flex-grow text-center transition-colors hover:bg-accent-orange shadow-sm flex items-center justify-center gap-2">
                                <i class="fas fa-cart-plus"></i> Add to Cart
                            </button>
                        </div>
                        <a href="#" onclick="toggleQuotationModal(event)" class="bg-white border-2 border-accent-blue text-accent-blue py-3 px-10 rounded font-bold w-full text-center transition-colors hover:bg-accent-orange hover:border-accent-orange hover:text-white shadow-sm flex items-center justify-center gap-2">
                            <i class="fas fa-file-invoice-dollar"></i> Request for Quotation
                        </a>
                    </div>
                @else
                    <div class="mt-6 p-4 bg-red-50 rounded-lg text-red-600 font-bold text-center border border-red-100">
                        <i class="fas fa-times-circle mr-1.5"></i> This product is currently out of stock.
                    </div>
                @endif
            </div>
        </div>
    </section>

    <!-- New Scroll-Spy Layout -->
    <div class="mt-10">
        <nav class="section-nav flex gap-2.5 mb-5 flex-wrap">
            <a href="#specification" class="active bg-white text-gray-800 py-2.5 px-5 rounded text-[14px] font-semibold shadow-[0_1px_3px_rgba(0,0,0,0.05)] transition-colors hover:bg-accent-orange hover:text-white [&.active]:bg-accent-orange [&.active]:text-white">Specification</a>
                @if($product->description)
                <a href="#description" class="bg-white text-gray-800 py-2.5 px-5 rounded text-[14px] font-semibold shadow-[0_1px_3px_rgba(0,0,0,0.05)] transition-colors hover:bg-accent-orange hover:text-white [&.active]:bg-accent-orange [&.active]:text-white">Description</a>
                @endif
                <a href="#questions" class="bg-white text-gray-800 py-2.5 px-5 rounded text-[14px] font-semibold shadow-[0_1px_3px_rgba(0,0,0,0.05)] transition-colors hover:bg-accent-orange hover:text-white [&.active]:bg-accent-orange [&.active]:text-white">Questions (1)</a>
                <a href="#reviews" class="bg-white text-gray-800 py-2.5 px-5 rounded text-[14px] font-semibold shadow-[0_1px_3px_rgba(0,0,0,0.05)] transition-colors hover:bg-accent-orange hover:text-white [&.active]:bg-accent-orange [&.active]:text-white">Reviews (1)</a>
            </nav>

            <div class="grid grid-cols-1 lg:grid-cols-[1fr_300px] gap-5 items-start">
                <!-- Main Left Column -->
                <div>
                    
                    <!-- Specification -->
                    <div id="specification" class="content-card bg-white rounded-lg shadow-sm p-6 mb-5">
                        <h2 class="text-[18px] font-bold text-gray-800 mb-4">Specification</h2>
                        @if($product->specifications->count() > 0)
                            <table class="w-full border-collapse">
                                <thead>
                                    <tr><th colspan="2" class="bg-[#f2f4f8] text-accent-orange text-[14px] font-semibold py-3 px-4 text-left rounded-t">Key Features</th></tr>
                                </thead>
                                <tbody>
                                @foreach($product->specifications as $spec)
                                    <tr class="group hover:bg-[#fcfcfc] transition-colors">
                                        <td class="text-gray-600 w-[30%] py-3 px-4 border-b border-gray-100 text-[14px] align-top">{{ $spec->name }}</td>
                                        <td class="py-3 px-4 border-b border-gray-100 text-[14px] align-top text-gray-800">{{ $spec->value }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @else
                            <p class="text-gray-400 text-[14px] italic">No specifications available for this product.</p>
                        @endif
                    </div>

                    <!-- Description -->
                    @if($product->description)
                    <div id="description" class="content-card bg-white rounded-lg shadow-sm p-6 mb-5 text-[14px] leading-relaxed text-gray-700 [&>h3]:text-[16px] [&>h3]:my-4 [&>h3]:text-gray-800 [&>p]:mb-4 last:[&>p]:mb-0">
                        <h2 class="text-[18px] font-bold text-gray-800 mb-4 border-b border-gray-100 pb-3">Description</h2>
                        <h3 class="font-bold">{{ $product->name }}</h3>
                        {!! $product->description !!}
                    </div>
                    @endif

                    <!-- Price FAQ -->
                    <div class="content-card bg-white rounded-lg shadow-sm p-6 mb-5">
                        <h2 class="text-[18px] font-bold text-gray-800 mb-4">What is the price of {{ $product->name }} in Bangladesh?</h2>
                        <p class="text-[14px] text-gray-600 leading-relaxed">
                            The latest price of {{ $product->name }} in Bangladesh is {{ number_format($product->discount_price ?? $product->price, 0) }}৳. You can buy the {{ $product->name }} at best price from our website or visit any of our showrooms.
                        </p>
                    </div>

                    <!-- Questions -->
                    <div id="questions" class="content-card bg-white rounded-lg shadow-sm p-6 mb-5">
                        <div class="flex flex-col sm:flex-row justify-between items-start border-b border-gray-100 pb-4 mb-4 gap-4">
                            <div>
                                <h2 class="text-[18px] font-bold text-gray-800 mb-1">Questions ({{ $product->questions->where('status', 1)->count() }})</h2>
                                <p class="text-[13px] text-gray-500">Have question about this product? Get specific details about this product from expert.</p>
                            </div>
                            <button onclick="toggleQuestionModal()" class="shrink-0 border border-gray-800 text-gray-800 py-2 px-4 rounded text-[13px] font-semibold transition-colors hover:bg-gray-800 hover:text-white">Ask Question</button>
                        </div>
                        
                        @forelse($product->questions->where('status', 1) as $question)
                            <div class="py-4 border-b border-[#f2f4f8] last:border-b-0">
                                <div class="text-[12px] text-gray-400 mb-2.5">{{ $question->name }} on {{ $question->created_at->format('d M Y') }}</div>
                                <div class="text-[14px] font-bold text-gray-800 mb-1.5">Q: {{ $question->question }}</div>
                                <div class="text-[14px] text-gray-600">A: {{ $question->answer ?? 'Pending expert response...' }}</div>
                            </div>
                        @empty
                            <div class="py-10 text-center text-gray-400 italic">
                                <i class="far fa-comments text-4xl mb-3 block"></i>
                                No questions yet. Be the first to ask!
                            </div>
                        @endforelse
                    </div>

                    <!-- Question Submission Modal -->
                    <div id="questionModal" class="fixed inset-0 z-[9999] hidden items-center justify-center bg-black/40 backdrop-blur-sm transition-opacity">
                        <div class="bg-white rounded-xl shadow-2xl w-full max-w-[500px] overflow-hidden relative mx-4 animate-scale-up">
                            <button onclick="toggleQuestionModal()" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 focus:outline-none z-10 transition-colors">
                                <i class="fas fa-times text-xl"></i>
                            </button>
                            <div class="bg-primary-dark text-white p-6">
                                <h3 class="text-xl font-bold">Ask a Question</h3>
                                <p class="text-xs text-gray-400 mt-1">{{ $product->name }}</p>
                            </div>
                            <div class="p-8">
                                <form action="{{ route('product.question.store') }}" method="POST" class="space-y-6">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    
                                    @guest
                                    <div>
                                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-widest mb-2">Your Name</label>
                                        <input type="text" name="name" required placeholder="John Doe" class="w-full bg-gray-50 border border-gray-200 rounded-lg py-3 px-4 focus:ring-2 focus:ring-accent-blue outline-none transition-all text-sm">
                                    </div>
                                    @endguest

                                    <div>
                                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-widest mb-2">Your Question</label>
                                        <textarea name="question" rows="4" required placeholder="Type your question here..." class="w-full bg-gray-50 border border-gray-200 rounded-lg py-3 px-4 focus:ring-2 focus:ring-accent-blue outline-none transition-all text-sm"></textarea>
                                    </div>

                                    <button type="submit" class="w-full bg-accent-orange text-white py-3.5 rounded-lg font-bold text-sm hover:shadow-lg transition-all flex items-center justify-center gap-2">
                                        <i class="fas fa-paper-plane"></i> Submit Question
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Reviews -->
                    <!-- Reviews -->
                    <div id="reviews" class="content-card bg-white rounded-lg shadow-sm p-6 mb-5">
                        <div class="flex flex-col sm:flex-row justify-between items-start border-b border-gray-100 pb-4 mb-4 gap-4">
                            <div>
                                <h2 class="text-[18px] font-bold text-gray-800 mb-1">Reviews ({{ $product->reviews->where('status', 1)->count() }})</h2>
                                <p class="text-[13px] text-gray-500">Get specific details about this product from customers who own it.</p>
                                @if($product->reviews->where('status', 1)->count() > 0)
                                    @php
                                        $avgRating = round($product->reviews->where('status', 1)->avg('rating'), 1);
                                    @endphp
                                    <div class="text-[#f59e0b] text-[14px] mt-2 mb-1 flex items-center gap-1">
                                        @for($i=1; $i<=5; $i++)
                                            <i class="{{ $i <= $avgRating ? 'fas' : 'far' }} fa-star"></i>
                                        @endfor
                                        <span class="text-gray-800 font-bold text-[14px] ml-1.5">{{ $avgRating }} out of 5</span>
                                    </div>
                                @endif
                            </div>
                            @auth
                                @php
                                    $hasPurchased = \App\Models\Order::where('user_id', auth()->id())
                                        ->where('status', 'delivered')
                                        ->whereHas('items', function($query) use ($product) {
                                            $query->where('product_id', $product->id);
                                        })->exists();
                                    $alreadyReviewed = \App\Models\ProductReview::where('user_id', auth()->id())
                                        ->where('product_id', $product->id)
                                        ->exists();
                                @endphp

                                @if($hasPurchased && !$alreadyReviewed)
                                    <button onclick="toggleReviewModal()" class="shrink-0 border border-gray-800 text-gray-800 py-2 px-4 rounded text-[13px] font-semibold transition-colors hover:bg-gray-800 hover:text-white">Write a Review</button>
                                @elseif($alreadyReviewed)
                                    <span class="text-xs font-bold text-green-600 bg-green-50 px-3 py-1 rounded-full"><i class="fas fa-check-circle mr-1"></i> You reviewed this</span>
                                @else
                                    <p class="text-[11px] text-gray-400 italic">Only verified buyers can review</p>
                                @endif
                            @else
                                <a href="{{ route('login') }}" class="shrink-0 border border-gray-800 text-gray-800 py-2 px-4 rounded text-[13px] font-semibold transition-colors hover:bg-gray-800 hover:text-white">Login to Review</a>
                            @endauth
                        </div>
                        
                        @forelse($product->reviews->where('status', 1) as $review)
                            <div class="py-4 border-b border-[#f2f4f8] last:border-b-0">
                                <div class="text-[#f59e0b] text-[13px] mb-2.5 flex gap-1">
                                    @for($i=1; $i<=5; $i++)
                                        <i class="{{ $i <= $review->rating ? 'fas' : 'far' }} fa-star"></i>
                                    @endfor
                                </div>
                                <div class="text-[14px] text-gray-700 mb-2.5 leading-relaxed">{{ $review->review }}</div>
                                <div class="text-[12px] text-gray-400 font-medium">By {{ $review->user->name }} on {{ $review->created_at->format('d M Y') }}</div>
                            </div>
                        @empty
                            <div class="py-10 text-center text-gray-400 italic">
                                <i class="far fa-star text-4xl mb-3 block"></i>
                                No reviews yet.
                            </div>
                        @endforelse
                    </div>

                    <!-- Review Submission Modal -->
                    <div id="reviewModal" class="fixed inset-0 z-[9999] hidden items-center justify-center bg-black/40 backdrop-blur-sm transition-opacity">
                        <div class="bg-white rounded-xl shadow-2xl w-full max-w-[500px] overflow-hidden relative mx-4 animate-scale-up">
                            <button onclick="toggleReviewModal()" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 focus:outline-none z-10 transition-colors">
                                <i class="fas fa-times text-xl"></i>
                            </button>
                            <div class="bg-primary-dark text-white p-6">
                                <h3 class="text-xl font-bold">Write a Review</h3>
                                <p class="text-xs text-gray-400 mt-1">{{ $product->name }}</p>
                            </div>
                            <div class="p-8">
                                <form action="{{ route('product.review.store') }}" method="POST" class="space-y-6">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    
                                    <div>
                                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-widest mb-3 text-center">Your Rating</label>
                                        <div class="flex justify-center gap-3 text-3xl text-gray-300">
                                            <input type="hidden" name="rating" id="selectedRating" value="5">
                                            @for($i=1; $i<=5; $i++)
                                                <i class="fas fa-star cursor-pointer hover:text-accent-orange transition-colors star-rating-btn text-accent-orange" data-rating="{{ $i }}" onclick="setRating({{ $i }})"></i>
                                            @endfor
                                        </div>
                                    </div>

                                    <div>
                                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-widest mb-2">Your Experience</label>
                                        <textarea name="review" rows="4" required placeholder="What did you like or dislike? How was the performance?" class="w-full bg-gray-50 border border-gray-200 rounded-lg py-3 px-4 focus:ring-2 focus:ring-accent-blue outline-none transition-all text-sm"></textarea>
                                    </div>

                                    <button type="submit" class="w-full bg-accent-orange text-white py-3.5 rounded-lg font-bold text-sm hover:shadow-lg transition-all flex items-center justify-center gap-2">
                                        <i class="fas fa-check-circle"></i> Submit Review
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Right Sidebar -->
                <aside>
                    @if($relatedProducts->count() > 0)
                        <div class="bg-white rounded-lg shadow-sm p-5">
                            <h3 class="text-[16px] font-bold text-gray-800 mb-5 text-center">Similar Product</h3>
                            <div>
                                @foreach($relatedProducts as $related)
                                    <div class="flex gap-4 items-center text-left pb-4 mb-4 border-b border-gray-100 last:border-b-0 last:mb-0 last:pb-0 group">
                                        <img src="{{ $related->thumbnail ? asset('storage/' . $related->thumbnail) : 'https://placehold.co/100x100/f9fafb/a3a3a3?text=No+Image' }}" alt="{{ $related->name }}" class="w-[70px] h-[70px] object-contain shrink-0 group-hover:scale-105 transition-transform duration-300">
                                        <div>
                                            <h4 class="text-[13px] text-gray-800 leading-snug mb-1.5"><a href="{{ url('product/' . $related->slug) }}" class="no-underline text-gray-800 transition-colors hover:text-accent-orange">{{ Str::limit($related->name, 40) }}</a></h4>
                                            <div class="text-[14px] font-bold text-accent-orange mb-2">
                                                @if($related->discount_price && $related->discount_price < $related->price)
                                                    {{ number_format($related->discount_price, 0) }}৳ <span class="line-through text-gray-400 font-normal text-[11px] ml-1">{{ number_format($related->price, 0) }}৳</span>
                                                @else
                                                    {{ number_format($related->price, 0) }}৳
                                                @endif
                                            </div>
                                            <a href="#" class="text-[12px] text-gray-500 no-underline inline-flex items-center gap-1.5 transition-colors hover:text-accent-orange"><i class="fas fa-plus-square"></i> Add to Compare</a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </aside>
        </div>
        </div>
    </div>

    <!-- Quotation Modal -->
    <div id="quotationModal" class="fixed inset-0 z-[9999] hidden items-center justify-center bg-black/40 backdrop-blur-sm transition-opacity">
        <div class="bg-white rounded shadow-xl w-full max-w-[800px] overflow-hidden relative mx-4 relative">
            <button onclick="toggleQuotationModal()" class="absolute top-2 right-2 text-white hover:text-gray-300 focus:outline-none z-10 bg-black rounded-full w-5 h-5 flex items-center justify-center text-[10px]">
                <i class="fas fa-times"></i>
            </button>
            <div class="bg-blue-900 text-white text-center py-2 text-[14px] font-semibold relative">
                Request For Quotation
            </div>
            <div class="p-6">
                <h3 class="text-[14px] font-bold text-gray-800 mb-4">{{ $product->name }}</h3>
                <form action="{{ route('quotation.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="project_type" value="Product Quotation">
                    <input type="hidden" name="budget_range" value="N/A">
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-4 gap-y-3 mb-4">
                        <div class="md:col-span-2">
                            <input type="text" name="name" required placeholder="Enter your Name" class="border border-gray-200 rounded-sm px-3 py-2 text-[13px] w-full focus:outline-none focus:border-accent-blue placeholder-gray-400">
                        </div>
                        <input type="text" name="phone" required placeholder="Contact No" class="border border-gray-200 rounded-sm px-3 py-2 text-[13px] w-full focus:outline-none focus:border-accent-blue placeholder-gray-400">
                        <input type="text" name="company_name" placeholder="Company Name" class="border border-gray-200 rounded-sm px-3 py-2 text-[13px] w-full focus:outline-none focus:border-accent-blue placeholder-gray-400">
                        <div class="md:col-span-2">
                            <input type="email" name="email" required placeholder="Enter your E-Mail" class="border border-gray-200 rounded-sm px-3 py-2 text-[13px] w-full focus:outline-none focus:border-accent-blue placeholder-gray-400">
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <textarea name="project_description" required rows="4" class="border border-gray-200 rounded-sm px-3 py-2 text-[13px] w-full focus:outline-none focus:border-accent-blue placeholder-gray-400" placeholder="Product: {{ $product->name }}&#10;Enter your message here...">Product: {{ $product->name }}&#10;</textarea>
                    </div>
                    
                    <div class="mb-6 text-center">
                        <label class="block text-[12px] text-gray-500 mb-2">Upload Your Document (Optional)</label>
                        <input type="file" name="attachment" class="text-[13px] text-gray-600 file:mr-2 file:py-1 file:px-2 file:rounded-sm file:border file:border-gray-300 file:bg-gray-100 file:text-gray-700 hover:file:bg-gray-200 w-full md:w-auto">
                    </div>
                    
                    <div class="flex justify-center gap-4 border-t border-gray-100 pt-5">
                        <button type="submit" class="bg-blue-900 text-white px-8 py-2 rounded-sm text-[13px] font-bold hover:bg-blue-950 transition-colors">Submit Request</button>
                        <button type="button" onclick="toggleQuotationModal()" class="bg-gray-400 text-white px-8 py-2 rounded-sm text-[13px] font-bold hover:bg-gray-500 transition-colors">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@section('scripts')
<script>
    // Image switcher
    function switchImage(el, src) {
        document.getElementById('main-product-image').src = src;
        document.querySelectorAll('.thumb-images img').forEach(img => img.classList.remove('active', 'border-accent-orange'));
        el.classList.add('active', 'border-accent-orange');
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

    // Section Navigation (Scroll-Spy)
    document.querySelectorAll('.section-nav a').forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const targetId = this.getAttribute('href').substring(1);
            const targetSection = document.getElementById(targetId);
            
            if (targetSection) {
                window.scrollTo({
                    top: targetSection.offsetTop - 80, // Adjust for sticky headers if any
                    behavior: 'smooth'
                });
            }

            // Update active class
            document.querySelectorAll('.section-nav a').forEach(l => l.classList.remove('active', 'bg-accent-orange', 'text-white'));
            this.classList.add('active', 'bg-accent-orange', 'text-white');
        });
    });

    // Simple Scroll-spy observer
    const sections = document.querySelectorAll('.content-card[id]');
    window.addEventListener('scroll', () => {
        let current = '';
        sections.forEach(section => {
            const sectionTop = section.offsetTop;
            if (scrollY >= sectionTop - 150) {
                current = section.getAttribute('id');
            }
        });

        if (current) {
            document.querySelectorAll('.section-nav a').forEach(a => {
                a.classList.remove('active', 'bg-accent-orange', 'text-white');
                if (a.getAttribute('href') === '#' + current) {
                    a.classList.add('active', 'bg-accent-orange', 'text-white');
                }
            });
        }
    });

    // Payment card selector
    document.querySelectorAll('.payment-card').forEach(card => {
        card.addEventListener('click', () => {
            document.querySelectorAll('.payment-card').forEach(c => {
                c.classList.remove('active', 'border-accent-blue', 'bg-[#f0f4f9]');
                c.classList.add('border-gray-200');
            });
            card.classList.remove('border-gray-200');
            card.classList.add('active', 'border-accent-blue', 'bg-[#f0f4f9]');
            card.querySelector('input[type=radio]').checked = true;
        });
    });

    // Quotation Modal Toggle
    function toggleQuotationModal(e) {
        if (e) e.preventDefault();
        const modal = document.getElementById('quotationModal');
        if (modal.classList.contains('hidden')) {
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            document.body.style.overflow = 'hidden';
        } else {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
            document.body.style.overflow = 'auto';
        }
    }

    // Question Modal Toggle
    function toggleQuestionModal() {
        const modal = document.getElementById('questionModal');
        if (modal.classList.contains('hidden')) {
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            document.body.style.overflow = 'hidden';
        } else {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
            document.body.style.overflow = 'auto';
        }
    }

    // Review Modal Toggle
    function toggleReviewModal() {
        const modal = document.getElementById('reviewModal');
        if (modal.classList.contains('hidden')) {
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            document.body.style.overflow = 'hidden';
        } else {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
            document.body.style.overflow = 'auto';
        }
    }

    // Star Rating Logic
    function setRating(rating) {
        document.getElementById('selectedRating').value = rating;
        const stars = document.querySelectorAll('.star-rating-btn');
        stars.forEach((star, index) => {
            if (index < rating) {
                star.classList.add('text-accent-orange');
                star.classList.remove('text-gray-300');
            } else {
                star.classList.remove('text-accent-orange');
                star.classList.add('text-gray-300');
            }
        });
    }
</script>

<script>
    const CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    // Update all cart counter badges on the page
    function updateCartCounters(count) {
        document.querySelectorAll('#cart-count-float, #cart-count-mobile').forEach(el => {
            el.textContent = count;
        });
    }

    // Show a toast notification
    function showToast(message, type = 'success') {
        const container = document.getElementById('toast-container');
        if (!container) return;
        const bgClass = type === 'success' ? 'bg-green-600' : 'bg-red-500';
        const icon = type === 'success' ? 'fa-check-circle' : 'fa-times-circle';
        const toast = document.createElement('div');
        toast.className = `toast ${bgClass} text-white px-6 py-3 rounded-lg shadow-2xl flex items-center gap-3 animate-slide-in`;
        toast.innerHTML = `<i class="fas ${icon} text-lg"></i><span>${message}</span>`;
        container.appendChild(toast);
        setTimeout(() => toast.remove(), 4000);
    }

    // Core cart fetch function
    async function cartFetch(productId, quantity) {
        const response = await fetch('{{ route("cart.add") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': CSRF_TOKEN,
                'Accept': 'application/json',
            },
            body: JSON.stringify({ product_id: productId, quantity: quantity }),
        });
        return response.json();
    }

    // Add to cart – shows toast and updates counter
    async function addToCart(productId) {
        const qty = parseInt(document.getElementById('qty').value) || 1;
        try {
            const data = await cartFetch(productId, qty);
            if (data.success) {
                showToast(data.message, 'success');
                updateCartCounters(data.cart_count);
            } else {
                showToast(data.message, 'error');
            }
        } catch (e) {
            showToast('Something went wrong. Please try again.', 'error');
        }
    }

    // Buy now – adds to cart then redirects directly to checkout
    function buyNow(productId) {
        const qty = parseInt(document.getElementById('qty').value) || 1;
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = '{{ route("cart.buy-now") }}';
        
        const csrfInput = document.createElement('input');
        csrfInput.type = 'hidden';
        csrfInput.name = '_token';
        csrfInput.value = CSRF_TOKEN;
        
        const idInput = document.createElement('input');
        idInput.type = 'hidden';
        idInput.name = 'product_id';
        idInput.value = productId;

        const qtyInput = document.createElement('input');
        qtyInput.type = 'hidden';
        qtyInput.name = 'quantity';
        qtyInput.value = qty;

        form.appendChild(csrfInput);
        form.appendChild(idInput);
        form.appendChild(qtyInput);
        document.body.appendChild(form);
        form.submit();
    }
</script>
@endsection
@endsection
