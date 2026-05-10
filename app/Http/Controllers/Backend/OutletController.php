<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Outlet;
use Illuminate\Http\Request;

class OutletController extends Controller
{
    public function index()
    {
        $outlets = Outlet::orderBy('sort_order', 'asc')->get();
        return view('backend.pages.outlets.index', compact('outlets'));
    }

    public function create()
    {
        return view('backend.pages.outlets.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'timing' => 'required|string',
            'off_day' => 'required|string',
        ]);

        Outlet::create([
            'name' => $request->name,
            'address' => $request->address,
            'timing' => $request->timing,
            'off_day' => $request->off_day,
            'map_link' => $request->map_link,
            'status' => $request->status ? 1 : 0,
            'sort_order' => $request->sort_order ?? 0,
            'phones' => $request->phones, // This will be cast to array automatically
        ]);

        return redirect()->route('admin.outlets.index')->with('success', 'Outlet created successfully!');
    }

    public function edit(Outlet $outlet)
    {
        return view('backend.pages.outlets.edit', compact('outlet'));
    }

    public function update(Request $request, Outlet $outlet)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'timing' => 'required|string',
            'off_day' => 'required|string',
        ]);

        $outlet->update([
            'name' => $request->name,
            'address' => $request->address,
            'timing' => $request->timing,
            'off_day' => $request->off_day,
            'map_link' => $request->map_link,
            'status' => $request->status ? 1 : 0,
            'sort_order' => $request->sort_order ?? 0,
            'phones' => $request->phones,
        ]);

        return redirect()->route('admin.outlets.index')->with('success', 'Outlet updated successfully!');
    }

    public function destroy(Outlet $outlet)
    {
        $outlet->delete();
        return redirect()->route('admin.outlets.index')->with('success', 'Outlet deleted successfully!');
    }

    public function toggleStatus(Outlet $outlet)
    {
        $outlet->update(['status' => !$outlet->status]);
        return response()->json(['success' => true]);
    }
}
