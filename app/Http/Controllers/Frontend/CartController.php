<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ShippingMethod;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function show()
    {
        $cart = session()->get('cart', []);
        $total = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);
        return view('frontend.cart.index', compact('cart', 'total'));
    }

    public function checkout()
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) return redirect()->route('cart.show')->with('error', 'Your cart is empty.');
        
        $total = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);
        $shipping_methods = ShippingMethod::where('status', 1)->get();
        
        return view('frontend.cart.checkout', compact('cart', 'total', 'shipping_methods'));
    }

    public function placeOrder(Request $request)
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) return redirect()->route('cart.show')->with('error', 'Your cart is empty.');

        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'email'      => 'required|email|max:255',
            'phone'      => 'required|string|max:20',
            'address'    => 'required|string',
            'delivery_method' => 'required|exists:shipping_methods,id',
        ]);

        $shipping_method = ShippingMethod::findOrFail($request->delivery_method);
        $subtotal = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);
        $total = $subtotal + $shipping_method->cost;

        try {
            DB::beginTransaction();

            $order = Order::create([
                'user_id'            => auth()->id(),
                'order_number'       => 'ST' . strtoupper(Str::random(8)),
                'first_name'         => $request->first_name,
                'last_name'          => $request->last_name,
                'email'              => $request->email,
                'phone'              => $request->phone,
                'address'            => $request->address,
                'upazila'            => $request->upazila,
                'district'           => $request->district,
                'note'               => $request->note,
                'shipping_method_id' => $shipping_method->id,
                'shipping_cost'      => $shipping_method->cost,
                'subtotal'           => $subtotal,
                'total'              => $total,
                'status'             => 'pending',
            ]);

            foreach ($cart as $item) {
                OrderItem::create([
                    'order_id'     => $order->id,
                    'product_id'   => $item['id'],
                    'product_name' => $item['name'],
                    'price'        => $item['price'],
                    'quantity'     => $item['quantity'],
                ]);
            }

            DB::commit();
            session()->forget('cart');

            return redirect()->route('order.success', $order->order_number)->with('success', 'Your order has been placed successfully!');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Something went wrong. Please try again.')->withInput();
        }
    }

    public function orderSuccess($order_number)
    {
        $order = Order::where('order_number', $order_number)->firstOrFail();
        return view('frontend.cart.success', compact('order'));
    }

    public function addToCart(Request $request)
    {
        $request->validate([
            'product_id' => 'required|integer|exists:products,id',
            'quantity'   => 'required|integer|min:1',
        ]);

        $product = Product::findOrFail($request->product_id);

        if ($product->status != 1) {
            return response()->json(['success' => false, 'message' => 'Product is not available.'], 422);
        }

        $qty = $request->quantity;

        if ($product->stock < $qty) {
            return response()->json(['success' => false, 'message' => 'Not enough stock available.'], 422);
        }

        $price = $product->discount_price && $product->discount_price < $product->price
            ? $product->discount_price
            : $product->price;

        $cart = session()->get('cart', []);

        if (isset($cart[$product->id])) {
            $newQty = $cart[$product->id]['quantity'] + $qty;
            if ($newQty > $product->stock) {
                $newQty = $product->stock;
            }
            $cart[$product->id]['quantity'] = $newQty;
        } else {
            $cart[$product->id] = [
                'id'        => $product->id,
                'name'      => $product->name,
                'slug'      => $product->slug,
                'thumbnail' => $product->thumbnail,
                'price'     => $price,
                'quantity'  => $qty,
            ];
        }

        session()->put('cart', $cart);

        $cartCount = collect($cart)->sum('quantity');

        return response()->json([
            'success'    => true,
            'message'    => '"' . $product->name . '" has been added to your cart!',
            'cart_count' => $cartCount,
        ]);
    }

    public function getCount()
    {
        $cart = session()->get('cart', []);
        $cartCount = collect($cart)->sum('quantity');
        return response()->json(['cart_count' => $cartCount]);
    }

    public function remove(Request $request)
    {
        $request->validate(['product_id' => 'required|integer']);
        $cart = session()->get('cart', []);
        unset($cart[$request->product_id]);
        session()->put('cart', $cart);

        $cartCount = collect($cart)->sum('quantity');
        return response()->json(['success' => true, 'cart_count' => $cartCount]);
    }

    public function buyNow(Request $request)
    {
        $request->validate([
            'product_id' => 'required|integer|exists:products,id',
            'quantity'   => 'nullable|integer|min:1',
        ]);

        $product = Product::findOrFail($request->product_id);
        if ($product->status != 1) {
            return back()->with('error', 'Product is not available.');
        }

        $qty = $request->quantity ?? 1;

        if ($product->stock < $qty) {
            return back()->with('error', 'Not enough stock available.');
        }

        $price = $product->discount_price && $product->discount_price < $product->price
            ? $product->discount_price
            : $product->price;

        $cart = session()->get('cart', []);

        // Just overwrite or update
        $cart[$product->id] = [
            'id'        => $product->id,
            'name'      => $product->name,
            'slug'      => $product->slug,
            'thumbnail' => $product->thumbnail,
            'price'     => $price,
            'quantity'  => $qty,
        ];

        session()->put('cart', $cart);

        return redirect()->route('cart.show');
    }
}
