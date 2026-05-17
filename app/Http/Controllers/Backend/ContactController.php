<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $messages = ContactMessage::latest()->paginate(15);
        return view('backend.pages.contacts.index', compact('messages'));
    }

    public function show(ContactMessage $contact)
    {
        $contact->update(['is_read' => true]);
        return view('backend.pages.contacts.show', compact('contact'));
    }

    public function destroy(ContactMessage $contact)
    {
        $contact->delete();
        return back()->with('success', 'Message deleted successfully');
    }

    public function reply(Request $request, ContactMessage $contact)
    {
        $request->validate([
            'reply' => 'required|string',
        ]);

        $contact->update([
            'reply' => $request->reply,
            'is_replied' => true,
        ]);

        return back()->with('success', 'Reply saved successfully');
    }

    // Frontend Store Method
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => $request->has('is_complain') ? 'required|string|max:20' : 'nullable|string|max:20',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        $data = $request->except('is_complain');
        ContactMessage::create($data);

        $successMsg = $request->has('is_complain') 
            ? 'Your complain & feedback has been submitted successfully. We will review it shortly.' 
            : 'Your message has been sent successfully. We will contact you soon.';

        return back()->with('success', $successMsg);
    }
}
