@extends('layouts.admin')

@section('title', 'Manage Outlets')

@section('content')
<div class="p-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Sales Outlets</h2>
        <a href="{{ route('admin.outlets.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg font-bold hover:bg-blue-700 transition-colors flex items-center gap-2">
            <i class="fas fa-plus"></i> Add New Outlet
        </a>
    </div>

    <div class="bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Sort</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Outlet Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Address</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Phones</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($outlets as $outlet)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        {{ $outlet->sort_order }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-bold text-gray-900">{{ $outlet->name }}</div>
                        <div class="text-xs text-gray-500">{{ $outlet->timing }} | {{ $outlet->off_day }}</div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="text-xs text-gray-600 line-clamp-2 max-w-xs">{{ $outlet->address }}</div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex flex-wrap gap-1">
                            @if($outlet->phones)
                                @foreach($outlet->phones as $key => $value)
                                    @if($value)
                                    <span class="bg-gray-100 text-[10px] px-1.5 py-0.5 rounded border border-gray-200">
                                        <span class="font-bold text-gray-500">{{ ucfirst(str_replace('_', ' ', $key)) }}:</span> {{ $value }}
                                    </span>
                                    @endif
                                @endforeach
                            @endif
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <button onclick="toggleStatus({{ $outlet->id }})" id="status-btn-{{ $outlet->id }}" class="px-3 py-1 rounded-full text-xs font-bold uppercase {{ $outlet->status ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ $outlet->status ? 'Active' : 'Inactive' }}
                        </button>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <div class="flex justify-end gap-2">
                            <a href="{{ route('admin.outlets.edit', $outlet->id) }}" class="text-blue-600 hover:text-blue-900 bg-blue-50 p-2 rounded-lg transition-colors">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.outlets.destroy', $outlet->id) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900 bg-red-50 p-2 rounded-lg transition-colors">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@push('scripts')
<script>
    function toggleStatus(id) {
        fetch(`/admin/outlets/toggle-status/${id}`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        }).then(res => res.json())
        .then(data => {
            if(data.success) {
                const btn = document.getElementById(`status-btn-${id}`);
                if(btn.innerText === 'Active') {
                    btn.innerText = 'Inactive';
                    btn.className = 'px-3 py-1 rounded-full text-xs font-bold uppercase bg-red-100 text-red-800';
                } else {
                    btn.innerText = 'Active';
                    btn.className = 'px-3 py-1 rounded-full text-xs font-bold uppercase bg-green-100 text-green-800';
                }
            }
        });
    }
</script>
@endpush

@endsection
