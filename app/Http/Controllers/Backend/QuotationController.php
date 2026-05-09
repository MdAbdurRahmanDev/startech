<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Quotation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class QuotationController extends Controller
{
    public function index()
    {
        $quotations = Quotation::latest()->paginate(15);
        return view('backend.pages.quotations.index', compact('quotations'));
    }

    public function show(Quotation $quotation)
    {
        $quote = $quotation;
        return view('backend.pages.quotations.show', compact('quote'));
    }

    public function updateStatus(Request $request, Quotation $quotation)
    {
        $request->validate(['status' => 'required|in:pending,reviewed,contacted,completed']);
        $quotation->update(['status' => $request->status]);
        return back()->with('success', 'Status updated successfully');
    }

    public function destroy(Quotation $quotation)
    {
        if ($quotation->attachment) {
            Storage::disk('public')->delete($quotation->attachment);
        }
        $quotation->delete();
        return back()->with('success', 'Quotation deleted successfully');
    }

    // Frontend Store Method
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'project_type' => 'required|string',
            'project_description' => 'required|string',
            'attachment' => 'nullable|file|mimes:pdf,doc,docx,zip,jpg,png|max:5120', // 5MB max
        ]);

        $data = $request->all();

        if ($request->hasFile('attachment')) {
            $data['attachment'] = $request->file('attachment')->store('quotations', 'public');
        }

        Quotation::create($data);

        return back()->with('success', 'Your quotation request has been submitted successfully. Our experts will review it and contact you soon.');
    }
}
