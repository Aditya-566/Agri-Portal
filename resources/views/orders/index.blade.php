<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <!-- Toast Alerts -->
        @if(session('success'))
            <div class="mb-6 p-4 rounded-xl bg-emerald-50 dark:bg-emerald-950/20 text-emerald-600 dark:text-emerald-400 text-xs font-semibold border border-emerald-100 dark:border-emerald-900/50 flex items-center gap-2">
                <i data-lucide="check-circle" class="w-4.5 h-4.5 shrink-0"></i>
                {{ session('success') }}
            </div>
        @endif

        <div class="mb-8">
            <a href="{{ route('buyer.dashboard') }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-emerald-600 dark:text-emerald-400 hover:underline mb-3">
                <i data-lucide="arrow-left" class="w-3.5 h-3.5"></i> Back to Dashboard
            </a>
            <h1 class="font-heading font-extrabold text-2xl text-slate-900 dark:text-white flex items-center gap-2">
                <span class="p-1.5 bg-emerald-100 text-emerald-700 dark:bg-emerald-950/30 dark:text-emerald-400 rounded-xl">
                    <i data-lucide="package" class="w-5.5 h-5.5"></i>
                </span>
                My Direct Purchases
            </h1>
            <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">Track the order status of fresh crops you bought directly from regional farmers.</p>
        </div>

        <div class="bg-white dark:bg-slate-800 rounded-3xl border border-slate-100 dark:border-slate-800/80 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs border-collapse">
                    <thead>
                        <tr class="border-b border-slate-100 dark:border-slate-750 bg-slate-50/50 dark:bg-slate-900/30 text-slate-400 font-bold uppercase tracking-wider text-[10px]">
                            <th class="py-4 px-6">Order ID</th>
                            <th class="py-4 px-4">Farmer / Seller</th>
                            <th class="py-4 px-4">Items Summary</th>
                            <th class="py-4 px-4">Total Amount</th>
                            <th class="py-4 px-4">Payment Method</th>
                            <th class="py-4 px-4">Order Status</th>
                            <th class="py-4 px-4">Purchase Date</th>
                            <th class="py-4 px-6 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 dark:divide-slate-750 font-medium text-slate-650 dark:text-slate-300">
                        @forelse($orders as $order)
                            <tr class="hover:bg-slate-50/30 dark:hover:bg-slate-900/30 transition-colors">
                                <!-- Order ID -->
                                <td class="py-4 px-6 font-mono font-bold text-slate-900 dark:text-white">
                                    #{{ substr($order->id, -6) }}
                                </td>
                                
                                <!-- Farmer Name -->
                                <td class="py-4 px-4 font-bold text-slate-800 dark:text-slate-205">
                                    {{ $order->farmer?->name ?? 'Direct Farmer' }}
                                </td>
                                
                                <!-- Items Summary -->
                                <td class="py-4 px-4">
                                    @php
                                        $itemsText = collect($order->items)->map(fn($item) => $item['name'] . ' (' . $item['quantity'] . 'kg)')->join(', ');
                                    @endphp
                                    <span class="truncate max-w-[220px] block" title="{{ $itemsText }}">
                                        {{ $itemsText }}
                                    </span>
                                </td>
                                
                                <!-- Total Amount -->
                                <td class="py-4 px-4 font-extrabold text-slate-900 dark:text-white text-sm">
                                    ₹{{ number_format($order->total_amount, 2) }}
                                </td>

                                <!-- Payment Method -->
                                <td class="py-4 px-4 capitalize">
                                    {{ $order->payment?->payment_method ?? 'COD' }}
                                </td>
                                
                                <!-- Order Status -->
                                <td class="py-4 px-4">
                                    <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wider {{ $order->status === 'completed' ? 'bg-emerald-50 text-emerald-600 dark:bg-emerald-950/20 dark:text-emerald-400' : ($order->status === 'pending' ? 'bg-amber-50 text-amber-600 dark:bg-amber-950/20 dark:text-amber-450' : ($order->status === 'accepted' ? 'bg-blue-50 text-blue-600 dark:bg-blue-950/20 dark:text-blue-405' : 'bg-rose-50 text-rose-600 dark:bg-rose-950/20 dark:text-rose-455')) }}">
                                        {{ $order->status }}
                                    </span>
                                </td>
                                
                                <!-- Purchase Date -->
                                <td class="py-4 px-4 text-slate-500 dark:text-slate-400 text-[11px]">
                                    {{ $order->created_at->format('M d, Y H:i') }}
                                </td>
                                
                                <!-- Actions -->
                                <td class="py-4 px-6 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="{{ route('orders.show', $order->id) }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-slate-100 hover:bg-slate-200 dark:bg-slate-700 dark:hover:bg-slate-600 text-slate-750 dark:text-slate-200 font-bold rounded-xl transition-all">
                                            View Order <i data-lucide="chevron-right" class="w-3.5 h-3.5"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="py-16 text-center text-slate-400 dark:text-slate-655 p-8 space-y-3">
                                    <div class="w-12 h-12 rounded-full bg-slate-50 dark:bg-slate-900 flex items-center justify-center mx-auto text-slate-400 border border-slate-100 dark:border-slate-800">
                                        <i data-lucide="receipt-text" class="w-6 h-6 text-slate-400"></i>
                                    </div>
                                    <div class="font-bold text-slate-700 dark:text-slate-300">No Orders Placed Yet</div>
                                    <p class="text-xs text-slate-400 max-w-xs mx-auto">Support local farmers by searching products and making your first direct trade purchase today.</p>
                                    <div class="pt-2">
                                        <a href="{{ route('products.index') }}" class="px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs rounded-xl transition-colors inline-block">
                                            Browse Products
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            @if($orders->hasPages())
                <div class="p-4 border-t border-slate-100 dark:border-slate-750">
                    {{ $orders->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
