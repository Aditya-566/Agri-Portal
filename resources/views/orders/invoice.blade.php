<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice #{{ substr($order->id, -6) }} - Fair Trade Agri-Portal</title>
    <!-- Google Fonts: Inter and Outfit -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Outfit:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                        heading: ['Outfit', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <style>
        @media print {
            .no-print {
                display: none !important;
            }
            body {
                background: white;
                color: black;
            }
        }
    </style>
</head>
<body class="bg-slate-50 text-slate-800 font-sans p-6 sm:p-12 min-h-screen flex flex-col justify-between">

    <div class="max-w-4xl mx-auto bg-white p-8 sm:p-12 rounded-3xl border border-slate-100 shadow-sm w-full">
        <!-- Print / Close Controls (no-print) -->
        <div class="no-print flex items-center justify-between gap-4 mb-8 pb-6 border-b border-slate-100">
            <a href="javascript:window.history.back();" class="inline-flex items-center gap-1.5 text-xs font-bold text-emerald-600 hover:underline">
                <i data-lucide="arrow-left" class="w-4 h-4"></i> Back to Order Details
            </a>
            
            <button onclick="window.print();" class="px-5 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs rounded-xl shadow-md transition-all flex items-center gap-1.5 hover:-translate-y-0.5">
                <i data-lucide="printer" class="w-4.5 h-4.5"></i> Print Invoice / Save PDF
            </button>
        </div>

        <!-- Invoice Title / Branding Header -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-6 mb-12">
            <div>
                <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-emerald-50 text-emerald-700 text-xs font-extrabold rounded-full mb-3">
                    <i data-lucide="sprout" class="w-3.5 h-3.5"></i> Fair Trade Agri-Portal
                </span>
                <h1 class="font-heading font-extrabold text-3xl text-slate-900 tracking-tight">TAX INVOICE</h1>
                <p class="text-xs text-slate-400 mt-1">Direct Trade Settlement Slip</p>
            </div>
            <div class="text-left sm:text-right text-xs space-y-1">
                <div><span class="text-slate-400">Invoice ID:</span> <span class="font-mono font-bold text-slate-900">#INV-{{ substr($order->id, -8) }}</span></div>
                <div><span class="text-slate-400">Order ID:</span> <span class="font-mono font-bold text-slate-900">#{{ substr($order->id, -6) }}</span></div>
                <div><span class="text-slate-400">Settlement Date:</span> <span class="font-bold text-slate-900">{{ $order->created_at->format('M d, Y') }}</span></div>
                <div><span class="text-slate-400">Payment Status:</span> <span class="font-bold text-emerald-600 uppercase">{{ $order->payment_status ?? $order->payment?->status ?? 'pending' }}</span></div>
            </div>
        </div>

        <!-- Billing Addresses Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-12 text-xs">
            <!-- Farmer / Seller Info -->
            <div class="bg-slate-50/50 p-6 rounded-2xl border border-slate-100">
                <h3 class="font-bold text-slate-400 uppercase tracking-wider text-[9px] mb-3">Seller (Farmer) Information</h3>
                <div class="space-y-1.5">
                    <div class="font-bold text-slate-900 text-sm flex items-center gap-1">
                        {{ $order->farmer?->name ?? 'Direct Farmer' }}
                        @if($order->farmer?->is_verified)
                            <span class="text-emerald-500" title="Verified Seller">
                                <i data-lucide="badge-check" class="w-4 h-4 fill-emerald-500/10"></i>
                            </span>
                        @endif
                    </div>
                    <div><span class="text-slate-450">Location:</span> <span class="font-semibold text-slate-700">{{ $order->farmer?->location ?? 'N/A' }}</span></div>
                    @if($order->farmer?->phone)
                        <div><span class="text-slate-450">Phone:</span> <span class="font-semibold text-slate-700">{{ $order->farmer->phone }}</span></div>
                    @endif
                    <div><span class="text-slate-450">Email:</span> <span class="font-semibold text-slate-700">{{ $order->farmer?->email ?? 'N/A' }}</span></div>
                </div>
            </div>

            <!-- Buyer / Purchaser Info -->
            <div class="bg-slate-50/50 p-6 rounded-2xl border border-slate-100">
                <h3 class="font-bold text-slate-400 uppercase tracking-wider text-[9px] mb-3">Buyer (Purchaser) Information</h3>
                <div class="space-y-1.5">
                    <div class="font-bold text-slate-900 text-sm">{{ $order->buyer?->name ?? 'Direct Trade Buyer' }}</div>
                    <div><span class="text-slate-450">Shipping Destination:</span> <span class="font-semibold text-slate-700">{{ $order->shipping_address ?? 'N/A' }}</span></div>
                    @if($order->buyer?->phone)
                        <div><span class="text-slate-450">Phone:</span> <span class="font-semibold text-slate-700">{{ $order->buyer->phone }}</span></div>
                    @endif
                    <div><span class="text-slate-450">Email:</span> <span class="font-semibold text-slate-700">{{ $order->buyer?->email ?? 'N/A' }}</span></div>
                </div>
            </div>
        </div>

        <!-- Line Items Table -->
        <div class="border border-slate-150 rounded-2xl overflow-hidden mb-8 text-xs">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-150 text-slate-450 font-bold uppercase tracking-wider text-[9px]">
                        <th class="py-3 px-6">Produce Details</th>
                        <th class="py-3 px-4">Direct Unit Price</th>
                        <th class="py-3 px-4">Quantity Ordered</th>
                        <th class="py-3 px-6 text-right">Line Total</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 font-medium text-slate-700">
                    @foreach($order->items as $item)
                        <tr>
                            <td class="py-4 px-6">
                                <span class="font-bold text-slate-900 block text-sm">{{ $item['name'] }}</span>
                                <span class="text-[10px] text-slate-400">Direct trade produce clearance</span>
                            </td>
                            <td class="py-4 px-4 font-bold text-slate-900">
                                ₹{{ number_format($item['price'], 2) }} / kg
                            </td>
                            <td class="py-4 px-4 font-semibold text-slate-700">
                                {{ $item['quantity'] }} kg
                            </td>
                            <td class="py-4 px-6 text-right font-bold text-slate-900 text-sm">
                                ₹{{ number_format($item['price'] * $item['quantity'], 2) }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Invoice Calculation summary -->
        <div class="flex justify-end mb-12 text-xs">
            <div class="w-full sm:w-80 space-y-2.5">
                <div class="flex justify-between text-slate-500 font-medium">
                    <span>Direct Trade Subtotal:</span>
                    <span class="font-bold text-slate-900">₹{{ number_format($order->total_amount, 2) }}</span>
                </div>
                <div class="flex justify-between text-emerald-650 font-bold">
                    <span>Middleman Commission:</span>
                    <span>₹0.00 (Direct Saving)</span>
                </div>
                <div class="flex justify-between text-slate-500 font-medium">
                    <span>Logistics / Handling:</span>
                    <span class="font-bold text-slate-900">Included</span>
                </div>
                <div class="flex justify-between text-sm font-extrabold text-slate-900 border-t border-slate-150 pt-3">
                    <span>Net Settled Amount:</span>
                    <span class="text-base text-emerald-600 font-extrabold">₹{{ number_format($order->total_amount, 2) }}</span>
                </div>
            </div>
        </div>

        <!-- Payment Settlement Verification -->
        <div class="p-4 bg-emerald-50/50 rounded-2xl border border-emerald-100/50 text-[10px] text-emerald-800 leading-relaxed">
            <div class="font-bold flex items-center gap-1 mb-1 text-xs">
                <i data-lucide="shield-check" class="w-4 h-4"></i> Direct trade escrow verified settlement
            </div>
            This transaction log certifies direct trade between buyer and grower. Funding coordinates are released to the farmer under escrow delivery protocols. Settled via method: <span class="font-bold uppercase">{{ $order->payment?->payment_method ?? 'COD' }}</span>. Reference Ref: <span class="font-mono font-bold">{{ $order->payment?->transaction_reference ?? 'N/A' }}</span>.
        </div>
    </div>

    <!-- Page Footer -->
    <div class="text-center text-[10px] text-slate-400 py-8 no-print">
        <p>&copy; {{ date('Y') }} Fair Trade Agri-Portal. Generated automatically via browser-compatible print engine.</p>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            lucide.createIcons();
        });
    </script>
</body>
</html>
