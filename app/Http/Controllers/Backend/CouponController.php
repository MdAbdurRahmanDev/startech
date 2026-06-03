<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function index()
    {
        $coupons = Coupon::latest()->paginate(20);
        return view('backend.pages.coupons.index', compact('coupons'));
    }

    public function create()
    {
        return view('backend.pages.coupons.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'code'         => 'required|string|max:50|unique:coupons,code',
            'type'         => 'required|in:flat,percent',
            'value'        => 'required|numeric|min:1',
            'min_order'    => 'nullable|numeric|min:0',
            'max_discount' => 'nullable|numeric|min:0',
            'max_uses'     => 'nullable|integer|min:1',
            'expires_at'   => 'nullable|date',
        ]);

        Coupon::create([
            'code'         => strtoupper(trim($request->code)),
            'type'         => $request->type,
            'value'        => $request->value,
            'min_order'    => $request->min_order ?? 0,
            'max_discount' => $request->max_discount,
            'max_uses'     => $request->max_uses,
            'expires_at'   => $request->expires_at,
            'status'       => 1,
        ]);

        return redirect()->route('admin.coupons.index')->with('success', 'Coupon created successfully.');
    }

    public function edit(Coupon $coupon)
    {
        return view('backend.pages.coupons.edit', compact('coupon'));
    }

    public function update(Request $request, Coupon $coupon)
    {
        $request->validate([
            'code'         => 'required|string|max:50|unique:coupons,code,' . $coupon->id,
            'type'         => 'required|in:flat,percent',
            'value'        => 'required|numeric|min:1',
            'min_order'    => 'nullable|numeric|min:0',
            'max_discount' => 'nullable|numeric|min:0',
            'max_uses'     => 'nullable|integer|min:1',
            'expires_at'   => 'nullable|date',
        ]);

        $coupon->update([
            'code'         => strtoupper(trim($request->code)),
            'type'         => $request->type,
            'value'        => $request->value,
            'min_order'    => $request->min_order ?? 0,
            'max_discount' => $request->max_discount,
            'max_uses'     => $request->max_uses,
            'expires_at'   => $request->expires_at,
        ]);

        return redirect()->route('admin.coupons.index')->with('success', 'Coupon updated successfully.');
    }

    public function toggleStatus(Coupon $coupon)
    {
        $coupon->update(['status' => !$coupon->status]);
        return back()->with('success', 'Coupon status updated.');
    }

    public function destroy(Coupon $coupon)
    {
        $coupon->delete();
        return back()->with('success', 'Coupon deleted.');
    }
}
