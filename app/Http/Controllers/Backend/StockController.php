<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\StockHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StockController extends Controller
{
    public function index()
    {
        $histories = StockHistory::with(['product', 'supplier'])->latest()->paginate(20);
        return view('backend.stock.index', compact('histories'));
    }

    public function create()
    {
        $products = Product::where('status', 1)->orderBy('name')->get();
        $suppliers = Supplier::where('status', 1)->orderBy('name')->get();
        return view('backend.stock.create', compact('products', 'suppliers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'supplier_id' => 'required|exists:suppliers,id',
            'quantity' => 'required|integer|min:1',
            'remarks' => 'nullable|string|max:255',
        ]);

        try {
            DB::beginTransaction();

            // Create history record
            StockHistory::create([
                'product_id' => $request->product_id,
                'supplier_id' => $request->supplier_id,
                'quantity' => $request->quantity,
                'remarks' => $request->remarks,
            ]);

            // Update product stock
            $product = Product::findOrFail($request->product_id);
            $product->increment('stock', $request->quantity);

            DB::commit();

            return redirect()->route('admin.stock.index')->with('success', 'Stock added successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }
}
