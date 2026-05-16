<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $sliders = Banner::where('type', 'slider')->where('status', 1)->orderBy('order')->get();
        $sideBanners = Banner::where('type', 'side')->where('status', 1)->orderBy('order')->take(2)->get();
        $featuredCategories = \App\Models\Category::where('is_featured', 1)->where('status', 1)->orderByRaw('`order` = 0, `order` ASC')->get();
        $featuredProducts = \App\Models\Product::with(['categories', 'specifications'])->where('is_featured', 1)->where('status', 1)->latest()->take(10)->get();
        $outletCount = \App\Models\Outlet::where('status', 1)->count();
        
        return view('frontend.home', compact('sliders', 'sideBanners', 'featuredCategories', 'featuredProducts', 'outletCount'));
    }

    public function pcBuilder()
    {
        $allCategories = \App\Models\Category::all();
        $categories = [];
        
        foreach ($allCategories as $cat) {
            $name = strtolower($cat->name);
            $categories[$name] = $cat->slug;
            // Also store with hyphens replaced by spaces and vice versa
            $categories[str_replace('-', ' ', $name)] = $cat->slug;
            $categories[str_replace(' ', '-', $name)] = $cat->slug;
        }
        
        $build = session()->get('pc_build', []);
        $selectedProducts = [];
        
        if (!empty($build)) {
            $productIds = array_values($build);
            $products = \App\Models\Product::whereIn('id', $productIds)->get()->keyBy('id');
            
            foreach ($build as $component => $productId) {
                if (isset($products[$productId])) {
                    $selectedProducts[$component] = $products[$productId];
                }
            }
        }
        
        return view('frontend.pages.pc_builder', compact('categories', 'selectedProducts'));
    }

    public function addToBuilder(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'component' => 'required|string'
        ]);

        $build = session()->get('pc_build', []);
        $build[$request->component] = $request->product_id;
        session()->put('pc_build', $build);

        return redirect()->route('pc-builder');
    }

    public function removeFromBuilder(Request $request)
    {
        $request->validate([
            'component' => 'required|string'
        ]);

        $build = session()->get('pc_build', []);
        unset($build[$request->component]);
        session()->put('pc_build', $build);

        return redirect()->route('pc-builder');
    }

    public function addAllToCart()
    {
        $build = session()->get('pc_build', []);
        if (empty($build)) {
            return redirect()->route('pc-builder')->with('error', 'Your PC build is empty.');
        }

        $productIds = array_values($build);
        $products = \App\Models\Product::whereIn('id', $productIds)->where('status', 1)->get();
        
        $cart = session()->get('cart', []);
        
        foreach ($products as $product) {
            $price = $product->discount_price && $product->discount_price < $product->price
                ? $product->discount_price
                : $product->price;

            if (isset($cart[$product->id])) {
                $cart[$product->id]['quantity'] += 1;
            } else {
                $cart[$product->id] = [
                    'id'        => $product->id,
                    'name'      => $product->name,
                    'slug'      => $product->slug,
                    'thumbnail' => $product->thumbnail,
                    'price'     => $price,
                    'quantity'  => 1,
                ];
            }
        }

        session()->put('cart', $cart);
        // Optional: clear builder after adding to cart?
        // session()->forget('pc_build');

        return redirect()->route('cart.show')->with('success', 'PC Build added to cart successfully!');
    }

    public function savePc()
    {
        if (!auth()->check()) {
            return redirect()->route('login')->with('info', 'Please login to save your PC build.');
        }

        $build = session()->get('pc_build', []);
        if (empty($build)) {
            return redirect()->route('pc-builder')->with('error', 'Your PC build is empty.');
        }

        $productIds = array_values($build);
        $products = \App\Models\Product::whereIn('id', $productIds)->get();
        $totalPrice = 0;
        foreach ($products as $product) {
            $totalPrice += ($product->discount_price && $product->discount_price < $product->price) ? $product->discount_price : $product->price;
        }

        $savedPcId = session()->get('pc_build_id');
        
        if ($savedPcId) {
            $savedPc = \App\Models\SavedPc::where('user_id', auth()->id())->find($savedPcId);
            if ($savedPc) {
                $savedPc->update([
                    'build_data' => $build,
                    'total_price' => $totalPrice
                ]);
                return redirect()->route('user.saved-pcs')->with('success', 'PC build updated successfully!');
            }
        }

        $savedPc = \App\Models\SavedPc::create([
            'user_id' => auth()->id(),
            'name' => 'PC Build ' . now()->format('Y-m-d H:i'),
            'build_data' => $build,
            'total_price' => $totalPrice
        ]);
        
        session()->put('pc_build_id', $savedPc->id);

        return redirect()->route('user.saved-pcs')->with('success', 'PC build saved successfully!');
    }

    public function loadSavedPc($id)
    {
        $savedPc = \App\Models\SavedPc::where('user_id', auth()->id())->findOrFail($id);
        
        session()->put('pc_build', $savedPc->build_data);
        session()->put('pc_build_id', $savedPc->id);
        
        return redirect()->route('pc-builder')->with('success', 'Build loaded successfully!');
    }

    public function deleteSavedPc($id)
    {
        $savedPc = \App\Models\SavedPc::where('user_id', auth()->id())->findOrFail($id);
        $savedPc->delete();
        
        return redirect()->route('user.saved-pcs')->with('success', 'Build deleted successfully!');
    }
}
