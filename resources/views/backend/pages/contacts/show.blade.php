@extends('layouts.admin')

@section('title', 'View Message')

@section('content')
<div class="mb-6 flex items-center justify-between">
    <div>
        <h1 class="text-2xl font-bold text-heading">View Message</h1>
        <p class="text-sm text-body">Inquiry from {{ $contact->name }}</p>
    </div>
    <a href="{{ route('admin.contacts.index') }}" class="text-body bg-white border border-default hover:bg-neutral-primary-soft font-bold rounded-base text-xs px-4 py-2 transition-all flex items-center gap-2">
        <i class="fas fa-arrow-left"></i> Back to Messages
    </a>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Message Content -->
    <div class="lg:col-span-2">
        <div class="bg-white border border-default rounded-lg p-6 shadow-sm">
            <div class="mb-6 pb-6 border-b border-default">
                <h2 class="text-xl font-bold text-heading mb-2">{{ $contact->subject }}</h2>
                <div class="flex items-center gap-2 text-xs text-gray-500">
                    <i class="far fa-clock"></i>
                    <span>Received on {{ $contact->created_at->format('d M Y, h:i A') }}</span>
                </div>
            </div>

            <div class="text-body leading-relaxed whitespace-pre-wrap">
                {{ $contact->message }}
            </div>

            <div class="mt-10 pt-6 border-t border-default flex gap-4">
                <a href="mailto:{{ $contact->email }}?subject=Re: {{ $contact->subject }}" class="inline-flex items-center justify-center px-6 py-2.5 text-sm font-bold text-white bg-blue-600 rounded-base hover:bg-opacity-90 transition-all gap-2">
                    <i class="fas fa-reply"></i> Reply via Email
                </a>
                <form action="{{ route('admin.contacts.destroy', $contact->id) }}" method="POST" onsubmit="return confirm('Delete this message?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="inline-flex items-center justify-center px-6 py-2.5 text-sm font-bold text-red-600 bg-white border border-red-200 rounded-base hover:bg-red-50 transition-all gap-2">
                        <i class="fas fa-trash-alt"></i> Delete Message
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Sender Details -->
    <div class="space-y-6">
        <div class="bg-white border border-default rounded-lg p-6 shadow-sm">
            <h3 class="text-sm font-bold text-heading uppercase tracking-wider mb-6 pb-4 border-b border-default">Sender Information</h3>
            
            <div class="space-y-4">
                <div>
                    <label class="text-[10px] font-bold text-gray-400 uppercase">Full Name</label>
                    <p class="text-sm font-bold text-heading">{{ $contact->name }}</p>
                </div>
                <div>
                    <label class="text-[10px] font-bold text-gray-400 uppercase">Email Address</label>
                    <p class="text-sm font-bold text-blue-600">
                        <a href="mailto:{{ $contact->email }}">{{ $contact->email }}</a>
                    </p>
                </div>
                <div>
                    <label class="text-[10px] font-bold text-gray-400 uppercase">Phone Number</label>
                    <p class="text-sm font-bold text-heading">{{ $contact->phone ?? 'N/A' }}</p>
                </div>
            </div>
        </div>

        <div class="bg-neutral-primary-soft rounded-lg p-6 border border-default">
            <h3 class="text-xs font-bold text-heading mb-4">Quick Actions</h3>
            <ul class="space-y-3 text-xs">
                <li>
                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $contact->phone) }}" target="_blank" class="flex items-center gap-2 text-green-600 hover:underline">
                        <i class="fab fa-whatsapp"></i> Chat on WhatsApp
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
@endsection
