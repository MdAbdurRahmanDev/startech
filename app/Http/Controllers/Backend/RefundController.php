<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RefundRequest;

class RefundController extends Controller
{
    public function index()
    {
        $refunds = RefundRequest::with(['order', 'user'])->latest()->paginate(15);
        return view('backend.pages.refunds.index', compact('refunds'));
    }

    public function show($id)
    {
        $refund = RefundRequest::with(['order.items', 'user'])->findOrFail($id);
        return view('backend.pages.refunds.show', compact('refund'));
    }

    public function updateStatus(Request $request, $id)
    {
        $refund = RefundRequest::findOrFail($id);
        
        $request->validate([
            'status' => 'required|in:pending,approved,rejected',
            'admin_note' => 'nullable|string',
        ]);

        $refund->update([
            'status' => $request->status,
            'admin_note' => $request->admin_note,
        ]);

        return back()->with('success', 'Refund status updated successfully.');
    }
}
