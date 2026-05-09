<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Offer;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class OfferController extends Controller
{
    public function index()
    {
        $offers = Offer::latest()->paginate(10);
        return view('backend.pages.offers.index', compact('offers'));
    }

    public function create()
    {
        return view('backend.pages.offers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'type' => 'required|string',
            'short_description' => 'nullable|string',
            'long_description' => 'nullable|string',
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->title) . '-' . time();
        
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('offers', 'public');
        }

        Offer::create($data);

        return redirect()->route('admin.offers.index')->with('success', 'Offer created successfully');
    }

    public function edit(Offer $offer)
    {
        return view('backend.pages.offers.edit', compact('offer'));
    }

    public function update(Request $request, Offer $offer)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'type' => 'required|string',
            'short_description' => 'nullable|string',
            'long_description' => 'nullable|string',
        ]);

        $data = $request->all();
        
        if ($request->hasFile('image')) {
            if ($offer->image) {
                Storage::disk('public')->delete($offer->image);
            }
            $data['image'] = $request->file('image')->store('offers', 'public');
        }

        $offer->update($data);

        return redirect()->route('admin.offers.index')->with('success', 'Offer updated successfully');
    }

    public function destroy(Offer $offer)
    {
        if ($offer->image) {
            Storage::disk('public')->delete($offer->image);
        }
        $offer->delete();
        return back()->with('success', 'Offer deleted successfully');
    }

    public function toggleStatus(Offer $offer)
    {
        $offer->update(['status' => !$offer->status]);
        return back()->with('success', 'Status updated successfully');
    }
}
