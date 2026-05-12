<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    public function index()
    {
        $banners = Banner::orderBy('order')->get();

        return view('backend.pages.banners.index', compact('banners'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|max:12288',
            'type' => 'required|in:slider,side',
            'link' => 'nullable',
        ]);

        try {
            $file = $request->file('image');
            $filename = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('storage/banners'), $filename);
            $imagePath = 'banners/'.$filename;

            Banner::create([
                'image' => $imagePath,
                'type' => $request->type,
                'link' => $request->link,
            ]);

            return back()->with('success', 'Banner added successfully.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Upload failed: '.$e->getMessage()]);
        }
    }

    public function update(Request $request, Banner $banner)
    {
        $request->validate([
            'image' => 'nullable|image|max:12288',
            'type' => 'required|in:slider,side',
            'link' => 'nullable',
        ]);

        try {
            if ($request->hasFile('image')) {
                // Delete old image
                if (file_exists(public_path('storage/'.$banner->image))) {
                    unlink(public_path('storage/'.$banner->image));
                }

                $file = $request->file('image');
                $filename = time().'_'.$file->getClientOriginalName();
                $file->move(public_path('storage/banners'), $filename);
                $banner->image = 'banners/'.$filename;
            }

            $banner->type = $request->type;
            $banner->link = $request->link;
            $banner->save();

            return back()->with('success', 'Banner updated successfully.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Update failed: '.$e->getMessage()]);
        }
    }

    public function destroy(Banner $banner)
    {
        if (file_exists(public_path('storage/'.$banner->image))) {
            unlink(public_path('storage/'.$banner->image));
        }
        $banner->delete();

        return back()->with('success', 'Banner deleted successfully.');
    }

    public function toggleStatus(Banner $banner)
    {
        $banner->update(['status' => ! $banner->status]);

        return back()->with('success', 'Status updated.');
    }
}
