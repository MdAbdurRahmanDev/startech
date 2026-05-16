@extends('layouts.app')

@section('title', 'Saved PC Builds | IOS BD')

@section('styles')
    <style>
        .account-container { padding: 30px 0; }
        .breadcrumb { display: flex; align-items: center; gap: 10px; font-size: 13px; color: #666; margin-bottom: 25px; }
        .breadcrumb a { text-decoration: none; color: #081621; }
        .breadcrumb i { font-size: 10px; color: #ccc; }
        
        .pc-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 25px;
        }
        
        .empty-state {
            text-align: center;
            padding: 100px 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }
        
        .empty-state i { font-size: 60px; color: #eee; margin-bottom: 20px; }
        
        .pc-card {
            background: #fff;
            border-radius: 12px;
            overflow: hidden;
            border: 1px solid #eee;
            transition: all 0.3s ease;
        }
        
        .pc-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.08);
            border-color: #ef4a23;
        }
        
        .pc-header {
            padding: 20px;
            background: #f8f9fa;
            border-bottom: 1px solid #eee;
        }
        
        .pc-title {
            font-weight: bold;
            font-size: 16px;
            color: #081621;
            margin-bottom: 5px;
        }
        
        .pc-date {
            font-size: 12px;
            color: #666;
        }
        
        .pc-body {
            padding: 20px;
        }
        
        .pc-info {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            font-size: 14px;
        }
        
        .info-label { color: #666; }
        .info-value { font-weight: bold; color: #081621; }
        
        .pc-price {
            font-size: 18px;
            font-weight: bold;
            color: #ef4a23;
            text-align: center;
            padding: 15px 0;
            border-top: 1px dashed #eee;
            margin-top: 15px;
        }
        
        .pc-footer {
            padding: 15px 20px;
            background: #fff;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
        }
        
        .btn-action {
            padding: 8px 15px;
            border-radius: 6px;
            font-size: 13px;
            font-weight: bold;
            text-align: center;
            cursor: pointer;
            transition: all 0.2s;
            text-decoration: none;
        }
        
        .btn-view {
            background: #081621;
            color: #fff;
        }
        
        .btn-view:hover { background: #3749bb; }
        
        .btn-delete {
            background: #fff;
            color: #666;
            border: 1px solid #ddd;
        }
        
        .btn-delete:hover {
            background: #fee2e2;
            color: #ef4444;
            border-color: #fca5a5;
        }
    </style>
@endsection

@section('content')
    <div class="container account-container">
        <div class="breadcrumb">
            <a href="{{ url('/') }}"><i class="fas fa-home"></i></a>
            <i class="fas fa-chevron-right"></i>
            <a href="{{ route('user.account') }}">Account</a>
            <i class="fas fa-chevron-right"></i>
            <span>Saved PC Builds</span>
        </div>

        <h1 class="text-2xl font-bold mb-8">My Saved PC Builds</h1>

        @if($savedPcs->count() > 0)
            <div class="pc-grid">
                @foreach($savedPcs as $pc)
                    <div class="pc-card">
                        <div class="pc-header">
                            <div class="pc-title">{{ $pc->name }}</div>
                            <div class="pc-date">{{ $pc->created_at->format('M d, Y h:i A') }}</div>
                        </div>
                        <div class="pc-body">
                            <div class="pc-info">
                                <span class="info-label">Items:</span>
                                <span class="info-value">{{ count($pc->build_data) }} Components</span>
                            </div>
                            <div class="pc-info">
                                <span class="info-label">Status:</span>
                                <span class="info-value text-green-600">Saved</span>
                            </div>
                            <div class="pc-price">
                                {{ number_format($pc->total_price, 0) }}৳
                            </div>
                        </div>
                        <div class="pc-footer">
                            <a href="{{ route('pc-builder.load', $pc->id) }}" class="btn-action btn-view">
                                <i class="fas fa-eye mr-1"></i> View
                            </a>
                            <form action="{{ route('pc-builder.delete', $pc->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this build?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-action btn-delete w-full">
                                    <i class="fas fa-trash-alt mr-1"></i> Delete
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="empty-state">
                <i class="fas fa-desktop"></i>
                <h2 class="text-xl font-bold text-gray-400">No saved PC builds found!</h2>
                <p class="text-gray-400 mt-2">You haven't saved any custom PC configurations yet.</p>
                <a href="{{ route('pc-builder') }}" class="inline-block mt-6 bg-accent-orange text-white px-8 py-3 rounded font-bold hover:bg-opacity-90 transition-all">Build Your PC Now</a>
            </div>
        @endif
    </div>
@endsection
