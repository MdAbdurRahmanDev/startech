@extends('layouts.admin')

@section('title', 'Manage Payment Methods | Star Tech')

@section('content')
<div class="max-w-6xl mx-auto py-8 px-4">
    <div class="mb-8 flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Payment Methods</h1>
            <p class="text-gray-600">Add and manage payment methods like Bkash, Nagad, Rocket etc.</p>
        </div>
        <button onclick="document.getElementById('addPaymentMethodModal').classList.remove('hidden')" class="bg-accent-blue text-white px-6 py-2.5 rounded-lg font-bold hover:bg-blue-700 transition-all flex items-center gap-2 shadow-lg shadow-blue-100">
            <i class="fas fa-plus"></i>
            Add New Method
        </button>
    </div>

    @if(session('success'))
        <div class="bg-green-50 text-green-700 p-4 rounded-lg mb-6 flex items-center gap-3 border border-green-100 shadow-sm">
            <i class="fas fa-check-circle"></i>
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-gray-50 border-b border-gray-100">
                    <tr>
                        <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider">Logo & Name</th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider">Type</th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider">Number</th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($paymentMethods as $method)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-lg bg-gray-50 border border-gray-100 flex items-center justify-center overflow-hidden p-1">
                                        @if($method->logo)
                                            <img src="{{ asset('storage/' . $method->logo) }}" class="w-full h-full object-contain">
                                        @else
                                            <i class="fas fa-money-bill-wave text-gray-400"></i>
                                        @endif
                                    </div>
                                    <span class="font-bold text-gray-800">{{ $method->name }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 rounded-full text-[10px] font-bold uppercase {{ $method->type == 'merchant' ? 'bg-purple-100 text-purple-600' : ($method->type == 'agent' ? 'bg-blue-100 text-blue-600' : 'bg-gray-100 text-gray-600') }}">
                                    {{ $method->type }}
                                </span>
                            </td>
                            <td class="px-6 py-4 font-mono text-sm text-gray-600">{{ $method->number }}</td>
                            <td class="px-6 py-4">
                                <form action="{{ route('admin.payment-methods.toggle', $method) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="flex items-center gap-1 {{ $method->status ? 'text-green-600' : 'text-red-400' }}">
                                        <i class="fas fa-toggle-{{ $method->status ? 'on' : 'off' }} text-lg"></i>
                                        <span class="text-xs font-medium">{{ $method->status ? 'Active' : 'Inactive' }}</span>
                                    </button>
                                </form>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <button onclick="openEditModal({{ $method->id }}, '{{ addslashes($method->name) }}', '{{ $method->type }}', '{{ $method->number }}', '{{ addslashes($method->notes ?? '') }}')" class="text-blue-400 hover:text-blue-600 transition-colors">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <form action="{{ route('admin.payment-methods.destroy', $method) }}" method="POST" onsubmit="return confirm('Delete this payment method?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-red-400 hover:text-red-600 transition-colors">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-gray-400">No payment methods found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Add Modal -->
<div id="addPaymentMethodModal" class="fixed inset-0 bg-gray-900/10 backdrop-blur-[2px] z-[100] hidden flex items-center justify-center p-4">
    <div class="bg-white w-full max-w-md rounded-xl shadow-2xl overflow-hidden animate-fade-in">
        <div class="p-6 border-b border-gray-100 flex justify-between items-center">
            <h3 class="text-lg font-bold text-gray-800">Add New Payment Method</h3>
            <button onclick="document.getElementById('addPaymentMethodModal').classList.add('hidden')" class="text-gray-400 hover:text-gray-600">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <form action="{{ route('admin.payment-methods.store') }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-5">
            @csrf
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Method Name (e.g. Bkash)</label>
                <input type="text" name="name" required class="w-full bg-gray-50 border border-gray-200 rounded-lg px-4 py-2.5 outline-none focus:border-accent-orange transition-all" placeholder="Bkash">
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Type</label>
                <select name="type" required class="w-full bg-gray-50 border border-gray-200 rounded-lg px-4 py-2.5 outline-none focus:border-accent-orange transition-all">
                    <option value="personal">Personal</option>
                    <option value="merchant">Merchant</option>
                    <option value="agent">Agent</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Number</label>
                <input type="text" name="number" required class="w-full bg-gray-50 border border-gray-200 rounded-lg px-4 py-2.5 outline-none focus:border-accent-orange transition-all" placeholder="017xxxxxxxx">
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Logo (Optional)</label>
                <input type="file" name="logo" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-orange-50 file:text-accent-orange hover:file:bg-orange-100">
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Notes (Optional)</label>
                <textarea name="notes" rows="3" class="w-full bg-gray-50 border border-gray-200 rounded-lg px-4 py-2.5 outline-none focus:border-accent-orange transition-all" placeholder="Any extra instructions..."></textarea>
            </div>

            <div class="pt-4 flex gap-3">
                <button type="button" onclick="document.getElementById('addPaymentMethodModal').classList.add('hidden')" class="flex-1 px-4 py-2.5 rounded-lg font-bold text-gray-500 border border-gray-200 hover:bg-gray-50 transition-all">Cancel</button>
                <button type="submit" class="flex-1 bg-accent-blue text-white px-4 py-2.5 rounded-lg font-bold hover:bg-blue-700 shadow-md transition-all">Add Method</button>
            </div>
        </form>
    </div>
</div>

<!-- Edit Modal -->
<div id="editPaymentMethodModal" class="fixed inset-0 bg-gray-900/10 backdrop-blur-[2px] z-[100] hidden flex items-center justify-center p-4">
    <div class="bg-white w-full max-w-md rounded-xl shadow-2xl overflow-hidden animate-fade-in">
        <div class="p-6 border-b border-gray-100 flex justify-between items-center">
            <h3 class="text-lg font-bold text-gray-800">Edit Payment Method</h3>
            <button onclick="document.getElementById('editPaymentMethodModal').classList.add('hidden')" class="text-gray-400 hover:text-gray-600">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <form id="editPaymentMethodForm" method="POST" enctype="multipart/form-data" class="p-6 space-y-5">
            @csrf
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Method Name</label>
                <input type="text" name="name" id="edit_name" required class="w-full bg-gray-50 border border-gray-200 rounded-lg px-4 py-2.5 outline-none focus:border-accent-orange transition-all">
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Type</label>
                <select name="type" id="edit_type" required class="w-full bg-gray-50 border border-gray-200 rounded-lg px-4 py-2.5 outline-none focus:border-accent-orange transition-all">
                    <option value="personal">Personal</option>
                    <option value="merchant">Merchant</option>
                    <option value="agent">Agent</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Number</label>
                <input type="text" name="number" id="edit_number" required class="w-full bg-gray-50 border border-gray-200 rounded-lg px-4 py-2.5 outline-none focus:border-accent-orange transition-all">
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Replace Logo (Optional)</label>
                <input type="file" name="logo" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-orange-50 file:text-accent-orange hover:file:bg-orange-100">
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Notes (Optional)</label>
                <textarea name="notes" id="edit_notes" rows="3" class="w-full bg-gray-50 border border-gray-200 rounded-lg px-4 py-2.5 outline-none focus:border-accent-orange transition-all"></textarea>
            </div>

            <div class="pt-4 flex gap-3">
                <button type="button" onclick="document.getElementById('editPaymentMethodModal').classList.add('hidden')" class="flex-1 px-4 py-2.5 rounded-lg font-bold text-gray-500 border border-gray-200 hover:bg-gray-50 transition-all">Cancel</button>
                <button type="submit" class="flex-1 bg-accent-blue text-white px-4 py-2.5 rounded-lg font-bold hover:bg-blue-700 shadow-md transition-all">Update Method</button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    function openEditModal(id, name, type, number, notes) {
        // Set form action
        document.getElementById('editPaymentMethodForm').action = '/admin/payment-methods/' + id + '/update';

        // Fill fields
        document.getElementById('edit_name').value = name;
        document.getElementById('edit_type').value = type;
        document.getElementById('edit_number').value = number;
        document.getElementById('edit_notes').value = notes;

        // Show modal
        document.getElementById('editPaymentMethodModal').classList.remove('hidden');
    }
</script>
@endpush

<style>
@keyframes fade-in {
    from { opacity: 0; transform: translateY(-20px); }
    to { opacity: 1; transform: translateY(0); }
}
.animate-fade-in { animation: fade-in 0.3s ease-out; }
</style>
@endsection
