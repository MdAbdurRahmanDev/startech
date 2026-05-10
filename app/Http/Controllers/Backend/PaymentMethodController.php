<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\PaymentMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PaymentMethodController extends Controller
{
    public function index()
    {
        $paymentMethods = PaymentMethod::latest()->get();
        return view('backend.pages.payment_methods.index', compact('paymentMethods'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'nullable|image|max:2048',
            'type' => 'required|in:merchant,personal,agent',
            'number' => 'required|string|max:20',
            'notes' => 'nullable|string',
        ]);

        $logoPath = null;
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('payment_methods', 'public');
        }

        PaymentMethod::create([
            'name' => $request->name,
            'logo' => $logoPath,
            'type' => $request->type,
            'number' => $request->number,
            'notes' => $request->notes,
        ]);

        return back()->with('success', 'Payment method added successfully.');
    }

    public function update(Request $request, PaymentMethod $paymentMethod)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'nullable|image|max:2048',
            'type' => 'required|in:merchant,personal,agent',
            'number' => 'required|string|max:20',
            'notes' => 'nullable|string',
        ]);

        if ($request->hasFile('logo')) {
            if ($paymentMethod->logo) {
                Storage::disk('public')->delete($paymentMethod->logo);
            }
            $paymentMethod->logo = $request->file('logo')->store('payment_methods', 'public');
        }

        $paymentMethod->update([
            'name' => $request->name,
            'type' => $request->type,
            'number' => $request->number,
            'notes' => $request->notes,
            'logo' => $paymentMethod->logo,
        ]);

        return back()->with('success', 'Payment method updated successfully.');
    }

    public function destroy(PaymentMethod $paymentMethod)
    {
        if ($paymentMethod->logo) {
            Storage::disk('public')->delete($paymentMethod->logo);
        }
        $paymentMethod->delete();
        return back()->with('success', 'Payment method deleted successfully.');
    }

    public function toggleStatus(PaymentMethod $paymentMethod)
    {
        $paymentMethod->update(['status' => !$paymentMethod->status]);
        return back()->with('success', 'Status updated successfully.');
    }
}
