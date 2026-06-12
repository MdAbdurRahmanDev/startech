<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\LaptopPurpose;
use Illuminate\Http\Request;

class LaptopPurposeController extends Controller
{
    public function index()
    {
        $purposes = LaptopPurpose::latest()->paginate(10);
        return view('backend.pages.laptop_purposes.index', compact('purposes'));
    }

    public function create()
    {
        return view('backend.pages.laptop_purposes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:laptop_purposes',
            'description' => 'nullable|string',
        ]);

        LaptopPurpose::create([
            'name' => $request->name,
            'description' => $request->description,
            'status' => $request->has('status'),
        ]);

        return redirect()->route('admin.laptop-purposes.index')->with('success', 'Laptop purpose created successfully.');
    }

    public function edit(LaptopPurpose $laptopPurpose)
    {
        return view('backend.pages.laptop_purposes.edit', compact('laptopPurpose'));
    }

    public function update(Request $request, LaptopPurpose $laptopPurpose)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:laptop_purposes,name,' . $laptopPurpose->id,
            'description' => 'nullable|string',
        ]);

        $laptopPurpose->update([
            'name' => $request->name,
            'description' => $request->description,
            'status' => $request->has('status'),
        ]);

        return redirect()->route('admin.laptop-purposes.index')->with('success', 'Laptop purpose updated successfully.');
    }

    public function destroy(LaptopPurpose $laptopPurpose)
    {
        $laptopPurpose->delete();
        return redirect()->route('admin.laptop-purposes.index')->with('success', 'Laptop purpose deleted successfully.');
    }
}
