@extends('layouts.admin')

@section('title', 'Quotation Details')

@section('content')
<div class="mb-6 flex items-center justify-between">
    <div>
        <h1 class="text-2xl font-bold text-heading">Quotation Details</h1>
        <p class="text-sm text-body">Reviewing request from: {{ $quote->name }}</p>
    </div>
    <a href="{{ route('admin.quotations.index') }}" class="text-body bg-white border border-default hover:bg-neutral-primary-soft font-bold rounded-base text-xs px-4 py-2 transition-all">
        <i class="fas fa-arrow-left mr-2"></i> Back to List
    </a>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <!-- Left: Client & Project Info -->
    <div class="lg:col-span-2 space-y-6">
        <div class="bg-white border border-default rounded-lg p-8 shadow-sm">
            <h3 class="text-lg font-bold text-heading mb-6 border-b border-default pb-4">Project Information</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                <div>
                    <span class="block text-[11px] font-bold text-gray-400 uppercase tracking-widest mb-1">Project Type</span>
                    <span class="text-lg font-bold text-fg-brand">{{ $quote->project_type }}</span>
                </div>
                <div>
                    <span class="block text-[11px] font-bold text-gray-400 uppercase tracking-widest mb-1">Budget Range</span>
                    <span class="text-lg font-bold text-gray-700">{{ $quote->budget_range ?? 'Not Specified' }}</span>
                </div>
            </div>

            <div>
                <span class="block text-[11px] font-bold text-gray-400 uppercase tracking-widest mb-2">Project Requirements</span>
                <div class="bg-neutral-primary-soft p-6 rounded-lg text-body leading-relaxed whitespace-pre-wrap border border-default">
                    {{ $quote->project_description }}
                </div>
            </div>

            @if($quote->attachment)
                <div class="mt-8 pt-6 border-t border-default">
                    <span class="block text-[11px] font-bold text-gray-400 uppercase tracking-widest mb-3">Supporting Document</span>
                    <a href="{{ asset('storage/' . $quote->attachment) }}" target="_blank" class="inline-flex items-center gap-3 bg-blue-50 text-blue-700 px-5 py-3 rounded-lg border border-blue-100 hover:bg-blue-100 transition-all font-bold text-sm">
                        <i class="fas fa-file-download text-lg"></i>
                        View Requirements File
                    </a>
                </div>
            @endif
        </div>

        <div class="bg-white border border-default rounded-lg p-8 shadow-sm">
            <h3 class="text-lg font-bold text-heading mb-6 border-b border-default pb-4">Client Contact Details</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div>
                    <span class="block text-[11px] font-bold text-gray-400 uppercase tracking-widest mb-1">Full Name</span>
                    <p class="text-heading font-medium">{{ $quote->name }}</p>
                </div>
                <div>
                    <span class="block text-[11px] font-bold text-gray-400 uppercase tracking-widest mb-1">Company</span>
                    <p class="text-heading font-medium">{{ $quote->company_name ?? 'N/A' }}</p>
                </div>
                <div>
                    <span class="block text-[11px] font-bold text-gray-400 uppercase tracking-widest mb-1">Email Address</span>
                    <a href="mailto:{{ $quote->email }}" class="text-blue-600 hover:underline">{{ $quote->email }}</a>
                </div>
                <div>
                    <span class="block text-[11px] font-bold text-gray-400 uppercase tracking-widest mb-1">Phone Number</span>
                    <a href="tel:{{ $quote->phone }}" class="text-fg-brand hover:underline">{{ $quote->phone }}</a>
                </div>
            </div>
            <div class="mt-8 flex gap-4">
                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $quote->phone) }}" target="_blank" class="bg-green-500 text-white px-6 py-2.5 rounded-lg font-bold text-sm flex items-center gap-2 hover:bg-opacity-90">
                    <i class="fab fa-whatsapp text-lg"></i> WhatsApp Client
                </a>
                <a href="mailto:{{ $quote->email }}" class="bg-primary-dark text-white px-6 py-2.5 rounded-lg font-bold text-sm flex items-center gap-2 hover:bg-opacity-90">
                    <i class="fas fa-envelope text-lg"></i> Send Email
                </a>
            </div>
        </div>
    </div>

    <!-- Right: Status Management -->
    <div class="space-y-6">
        <div class="bg-white border border-default rounded-lg p-6 shadow-sm sticky top-24">
            <h3 class="text-sm font-bold text-heading mb-4 uppercase tracking-wider">Update Status</h3>
            <form action="{{ route('admin.quotations.update-status', $quote->id) }}" method="POST">
                @csrf
                <select name="status" class="w-full bg-neutral-primary-soft border border-default rounded-lg p-3 text-sm mb-4 outline-none focus:border-fg-brand">
                    <option value="pending" {{ $quote->status == 'pending' ? 'selected' : '' }}>Pending Review</option>
                    <option value="reviewed" {{ $quote->status == 'reviewed' ? 'selected' : '' }}>Reviewed</option>
                    <option value="contacted" {{ $quote->status == 'contacted' ? 'selected' : '' }}>Contacted Client</option>
                    <option value="completed" {{ $quote->status == 'completed' ? 'selected' : '' }}>Quote Sent / Completed</option>
                </select>
                <button type="submit" class="w-full bg-fg-brand text-white font-bold py-3 rounded-lg text-sm hover:shadow-lg transition-all">
                    Update Workflow Status
                </button>
            </form>
            
            <div class="mt-8 pt-6 border-t border-default">
                <p class="text-[11px] text-gray-400 italic">Request received: {{ $quote->created_at->format('d M Y, h:i A') }}</p>
                <p class="text-[11px] text-gray-400 italic mt-1">Last activity: {{ $quote->updated_at->diffForHumans() }}</p>
            </div>
        </div>
    </div>
</div>
@endsection
