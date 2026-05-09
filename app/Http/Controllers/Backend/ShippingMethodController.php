<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ShippingMethod;
use Illuminate\Http\Request;

class ShippingMethodController extends Controller
{
    public function index()
    {
        $methods = ShippingMethod::latest()->get();
        return view('backend.pages.shipping.index', compact('methods'));
    }

    public function create()
    {
        return view('backend.pages.shipping.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'cost' => 'required|numeric|min:0',
            'status' => 'required|boolean',
        ]);

        ShippingMethod::create($request->all());

        return redirect()->route('admin.shipping.index')->with('success', 'Shipping method created successfully.');
    }

    public function edit(ShippingMethod $shipping)
    {
        return view('backend.pages.shipping.edit', compact('shipping'));
    }

    public function update(Request $request, ShippingMethod $shipping)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'cost' => 'required|numeric|min:0',
            'status' => 'required|boolean',
        ]);

        $shipping->update($request->all());

        return redirect()->route('admin.shipping.index')->with('success', 'Shipping method updated successfully.');
    }

    public function destroy(ShippingMethod $shipping)
    {
        $shipping->delete();
        return redirect()->route('admin.shipping.index')->with('success', 'Shipping method deleted successfully.');
    }
}
