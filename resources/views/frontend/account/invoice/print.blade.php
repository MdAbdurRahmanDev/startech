<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice #{{ $order->order_number }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');
        body { font-family: 'Inter', sans-serif; }
        @media print {
            .no-print { display: none; }
            body { background: white; }
            .print-shadow-none { shadow: none; border: none; }
        }
    </style>
    <script>
        window.onload = function() {
            window.print();
        }
    </script>
</head>
<body class="bg-gray-50 min-h-screen py-10 print:py-0">

    <div class="max-w-4xl mx-auto bg-white shadow-xl rounded-2xl overflow-hidden print:shadow-none print:rounded-none">
        <!-- Toolbar -->
        <div class="bg-gray-800 p-4 flex justify-between items-center no-print">
            <div class="flex items-center gap-3">
                <a href="{{ url()->previous() }}" class="text-white hover:text-gray-300 transition-colors">
                    <i class="fas fa-arrow-left"></i>
                </a>
                <span class="text-white font-bold">Invoice #{{ $order->order_number }}</span>
            </div>
            <div class="flex gap-3">
                <button onclick="window.print()" class="bg-accent-blue hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-bold text-sm transition-all flex items-center gap-2">
                    <i class="fas fa-print"></i> Print Invoice
                </button>
            </div>
        </div>

        <!-- Invoice Content -->
        <div class="p-10 print:p-0">
            <!-- Header -->
            <div class="flex justify-between items-start mb-12">
                <div>
                    @if($setting && $setting->logo)
                        <img src="{{ asset('storage/' . $setting->logo) }}" alt="{{ $setting->site_name }}" class="h-10 mb-4">
                    @else
                        <img src="{{ asset('frontend/assets/images/logo.png') }}" alt="Star Tech" class="h-10 mb-4">
                    @endif
                    <div class="text-xs text-gray-500 space-y-1">
                        <p>Star Tech & Engineering Ltd</p>
                        <p>Head Office: 28 Kazi Nazrul Islam Avenue,</p>
                        <p>Shahbagh, Dhaka-1000, Bangladesh</p>
                        <p>Phone: 16793, 09678002003</p>
                    </div>
                </div>
                <div class="text-right">
                    <h1 class="text-4xl font-black text-gray-800 uppercase tracking-tighter mb-2">Invoice</h1>
                    <div class="text-sm font-bold text-gray-800">Order ID: #{{ $order->order_number }}</div>
                    <div class="text-xs text-gray-500">Date: {{ $order->created_at->format('d M, Y') }}</div>
                    <div class="mt-4">
                        @php
                            $statusColors = [
                                'pending' => 'bg-yellow-100 text-yellow-700',
                                'on_the_way' => 'bg-blue-100 text-blue-700',
                                'delivered' => 'bg-green-100 text-green-700',
                                'rejected' => 'bg-red-100 text-red-700',
                            ];
                        @endphp
                        <span class="px-3 py-1 rounded-full text-[10px] font-black uppercase {{ $statusColors[$order->status] ?? 'bg-gray-100' }}">
                            {{ str_replace('_', ' ', $order->status) }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Billing Details -->
            <div class="grid grid-cols-2 gap-12 mb-12 border-y border-gray-100 py-8">
                <div>
                    <h4 class="text-[11px] font-bold text-gray-400 uppercase tracking-widest mb-4">Bill To</h4>
                    <div class="text-sm">
                        <p class="font-bold text-gray-800 text-base mb-1">{{ $order->first_name }} {{ $order->last_name }}</p>
                        <p class="text-gray-600 mb-1">{{ $order->address }}</p>
                        <p class="text-gray-600 mb-1">{{ $order->upazila }}, {{ $order->district }}</p>
                        <p class="text-gray-600 mb-3">Phone: {{ $order->phone }}</p>
                        <p class="text-gray-500 italic">Email: {{ $order->email }}</p>
                    </div>
                </div>
                <div class="text-right">
                    <h4 class="text-[11px] font-bold text-gray-400 uppercase tracking-widest mb-4">Payment Method</h4>
                    <p class="text-sm font-bold text-gray-800 uppercase">{{ str_replace('_', ' ', $order->payment_method) }}</p>
                    
                    <h4 class="text-[11px] font-bold text-gray-400 uppercase tracking-widest mt-6 mb-2">Shipping Method</h4>
                    <p class="text-sm text-gray-600">{{ $order->shippingMethod->name ?? 'Standard Shipping' }}</p>
                </div>
            </div>

            <!-- Table -->
            <table class="w-full mb-12">
                <thead>
                    <tr class="border-b-2 border-gray-800">
                        <th class="py-4 text-left text-[11px] font-bold text-gray-400 uppercase tracking-wider">Item Description</th>
                        <th class="py-4 text-center text-[11px] font-bold text-gray-400 uppercase tracking-wider">Price</th>
                        <th class="py-4 text-center text-[11px] font-bold text-gray-400 uppercase tracking-wider">Qty</th>
                        <th class="py-4 text-right text-[11px] font-bold text-gray-400 uppercase tracking-wider">Total</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($order->items as $item)
                        <tr>
                            <td class="py-5">
                                <div class="font-bold text-gray-800">{{ $item->product_name }}</div>
                                <div class="text-[10px] text-gray-400 mt-0.5">Model: {{ $item->product->model ?? 'N/A' }}</div>
                            </td>
                            <td class="py-5 text-center text-sm text-gray-600">{{ number_format($item->price, 0) }}৳</td>
                            <td class="py-5 text-center text-sm text-gray-600">{{ $item->quantity }}</td>
                            <td class="py-5 text-right font-bold text-gray-800">{{ number_format($item->price * $item->quantity, 0) }}৳</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Footer Totals -->
            <div class="flex justify-end">
                <div class="w-full max-w-[250px] space-y-3">
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-500 font-medium">Subtotal</span>
                        <span class="text-gray-800 font-bold">{{ number_format($order->subtotal, 0) }}৳</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-500 font-medium">Shipping Cost</span>
                        <span class="text-gray-800 font-bold">{{ number_format($order->shipping_cost, 0) }}৳</span>
                    </div>
                    <div class="flex justify-between pt-3 border-t-2 border-gray-800">
                        <span class="text-base font-black text-gray-800 uppercase">Grand Total</span>
                        <span class="text-xl font-black text-accent-orange">{{ number_format($order->total, 0) }}৳</span>
                    </div>
                </div>
            </div>

            <!-- Notes -->
            <div class="mt-20 pt-10 border-t border-gray-100 grid grid-cols-2 gap-10">
                <div>
                    <h4 class="text-[11px] font-bold text-gray-400 uppercase tracking-widest mb-2">Terms & Conditions</h4>
                    <p class="text-[10px] text-gray-400 leading-relaxed">
                        1. This invoice is computer generated and does not require signature.<br>
                        2. Warranty is as per manufacturer's policy.<br>
                        3. Goods once sold are not returnable.
                    </p>
                </div>
                <div class="text-right flex flex-col justify-end">
                    <p class="text-[10px] text-gray-400">Thank you for choosing</p>
                    <p class="text-sm font-black text-gray-800 uppercase tracking-tighter">Star Tech & Engineering Ltd</p>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
