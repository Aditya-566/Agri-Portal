<x-app-layout>
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <!-- Header -->
        <div class="mb-8">
            <a href="{{ route('orders.index') }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-emerald-600 dark:text-emerald-400 hover:underline mb-3">
                <i data-lucide="arrow-left" class="w-3.5 h-3.5"></i> Back to My Direct Purchases
            </a>
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div>
                    <h1 class="font-heading font-extrabold text-2xl text-slate-900 dark:text-white flex items-center gap-2">
                        Order #{{ substr($order->id, -6) }}
                    </h1>
                    <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">Placed on {{ $order->created_at->format('M d, Y \a\t H:i A') }}</p>
                </div>
                
                <!-- Print Invoice Button -->
                <a href="{{ route('orders.invoice', $order->id) }}" target="_blank" class="px-4 py-2 bg-slate-100 hover:bg-slate-200 dark:bg-slate-700 dark:hover:bg-slate-600 text-slate-750 dark:text-slate-250 font-bold text-xs rounded-xl flex items-center gap-1.5 border border-slate-250 dark:border-slate-600 transition-colors self-start sm:self-auto">
                    <i data-lucide="printer" class="w-4 h-4"></i> Print Invoice / PDF
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Left Side: Order items list & summary -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Products Table Card -->
                <div class="bg-white dark:bg-slate-800 rounded-3xl border border-slate-100 dark:border-slate-800/80 shadow-sm p-6">
                    <h3 class="font-heading font-bold text-slate-900 dark:text-white text-sm mb-4 pb-2 border-b border-slate-50 dark:border-slate-700/50 flex items-center gap-1.5">
                        <i data-lucide="shopping-cart" class="w-4 h-4 text-emerald-650"></i> Items Purchased
                    </h3>

                    <div class="divide-y divide-slate-100 dark:divide-slate-750">
                        @foreach($order->items as $item)
                            <div class="py-4 flex items-center gap-4 first:pt-0 last:pb-0">
                                <div class="w-14 h-14 rounded-xl overflow-hidden shrink-0 bg-slate-50 dark:bg-slate-900 border border-slate-100 dark:border-slate-750">
                                    @if(!empty($item['image_path']))
                                        <img src="{{ asset('storage/' . $item['image_path']) }}" alt="{{ $item['name'] }}" class="w-full h-full object-cover" />
                                    @else
                                        <div class="w-full h-full flex items-center justify-center text-slate-400">
                                            <i data-lucide="sprout" class="w-5 h-5 text-emerald-605"></i>
                                        </div>
                                    @endif
                                </div>
                                <div class="flex-grow min-w-0">
                                    <h4 class="font-bold text-slate-900 dark:text-white text-sm truncate hover:text-emerald-600 transition-colors">
                                        <a href="{{ route('products.show', $item['product_id']) }}">{{ $item['name'] }}</a>
                                    </h4>
                                    <p class="text-xs text-slate-400 mt-0.5">₹{{ number_format($item['price'], 2) }} per kg</p>
                                </div>
                                <div class="text-right shrink-0">
                                    <span class="font-semibold text-slate-700 dark:text-slate-300 text-xs block">{{ $item['quantity'] }} kg</span>
                                    <span class="font-bold text-slate-900 dark:text-white text-sm block mt-0.5">₹{{ number_format($item['price'] * $item['quantity'], 2) }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Totals Block -->
                    <div class="border-t border-slate-100 dark:border-slate-750 mt-6 pt-4 space-y-2.5 text-xs">
                        <div class="flex justify-between text-slate-500">
                            <span>Subtotal</span>
                            <span class="font-semibold text-slate-700 dark:text-slate-350">₹{{ number_format($order->total_amount, 2) }}</span>
                        </div>
                        <div class="flex justify-between text-slate-500">
                            <span>Middleman Surcharges</span>
                            <span class="font-bold text-emerald-650 dark:text-emerald-450">₹0.00 (Fair Direct Trade)</span>
                        </div>
                        <div class="flex justify-between text-slate-500">
                            <span>Direct Shipping / Courier</span>
                            <span class="font-semibold text-slate-750 dark:text-slate-200">Included</span>
                        </div>
                        <div class="flex justify-between text-sm font-extrabold text-slate-900 dark:text-white border-t border-slate-50 dark:border-slate-750 pt-3">
                            <span>Total Pay</span>
                            <span class="text-base text-emerald-650 dark:text-emerald-400">₹{{ number_format($order->total_amount, 2) }}</span>
                        </div>
                    </div>
                </div>

                <!-- Transaction Details Card -->
                <div class="bg-white dark:bg-slate-800 rounded-3xl border border-slate-100 dark:border-slate-800/80 shadow-sm p-6">
                    <h3 class="font-heading font-bold text-slate-900 dark:text-white text-sm mb-4 pb-2 border-b border-slate-50 dark:border-slate-700/50 flex items-center gap-1.5">
                        <i data-lucide="credit-card" class="w-4 h-4 text-emerald-650"></i> Payment & Billing Details
                    </h3>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 text-xs">
                        <div>
                            <span class="text-slate-450 block font-bold uppercase tracking-wider text-[9px] mb-1">Chosen Payment Method</span>
                            <span class="font-bold text-slate-850 dark:text-slate-205 capitalize flex items-center gap-1">
                                @if($order->payment?->payment_method === 'card')
                                    <i data-lucide="credit-card" class="w-4 h-4 text-slate-550"></i> Credit/Debit Card
                                @else
                                    <i data-lucide="hand-coins" class="w-4 h-4 text-slate-550"></i> Cash On Delivery
                                @endif
                            </span>
                        </div>
                        <div>
                            <span class="text-slate-450 block font-bold uppercase tracking-wider text-[9px] mb-1">Transaction Ref ID</span>
                            <span class="font-mono font-bold text-slate-850 dark:text-slate-205">{{ $order->payment?->transaction_reference ?? 'N/A' }}</span>
                        </div>
                        <div>
                            <span class="text-slate-450 block font-bold uppercase tracking-wider text-[9px] mb-1">Payment Status</span>
                            <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full font-bold uppercase tracking-wider text-[9px] {{ ($order->payment_status ?? $order->payment?->status) === 'paid' ? 'bg-emerald-50 text-emerald-650 dark:bg-emerald-950/20 dark:text-emerald-400' : 'bg-amber-50 text-amber-650 dark:bg-amber-950/20 dark:text-amber-450' }}">
                                {{ $order->payment_status ?? $order->payment?->status ?? 'pending' }}
                            </span>
                        </div>
                        <div>
                            <span class="text-slate-450 block font-bold uppercase tracking-wider text-[9px] mb-1">Escrow Status</span>
                            <span class="font-bold text-slate-850 dark:text-slate-205 flex items-center gap-0.5">
                                <i data-lucide="shield-check" class="w-3.5 h-3.5 text-emerald-650"></i> Covered by AgriEscrow
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Side: Farmer Profile, Shipping Address, and Order Status Actions -->
            <div class="space-y-6">
                <!-- Order Status Tracker -->
                <div class="bg-white dark:bg-slate-800 rounded-3xl border border-slate-100 dark:border-slate-800/80 shadow-sm p-6">
                    <h3 class="font-heading font-bold text-slate-900 dark:text-white text-sm mb-4 pb-2 border-b border-slate-50 dark:border-slate-700/50">
                        Order Lifecycle Status
                    </h3>

                    <!-- Status Display -->
                    <div class="flex items-center gap-3 mb-4">
                        <span class="p-2.5 rounded-2xl {{ $order->status === 'completed' ? 'bg-emerald-50 dark:bg-emerald-950/20 text-emerald-600' : ($order->status === 'pending' ? 'bg-amber-50 dark:bg-amber-950/20 text-amber-600' : ($order->status === 'accepted' ? 'bg-blue-50 dark:bg-blue-950/20 text-blue-600' : 'bg-rose-50 dark:bg-rose-950/20 text-rose-600')) }}">
                            @if($order->status === 'completed')
                                <i data-lucide="check-circle" class="w-6 h-6"></i>
                            @elseif($order->status === 'pending')
                                <i data-lucide="clock" class="w-6 h-6 animate-pulse"></i>
                            @elseif($order->status === 'accepted')
                                <i data-lucide="truck" class="w-6 h-6"></i>
                            @else
                                <i data-lucide="x-circle" class="w-6 h-6"></i>
                            @endif
                        </span>
                        <div>
                            <span class="text-[10px] uppercase font-bold text-slate-400 block">Current Status</span>
                            <span class="text-sm font-extrabold text-slate-900 dark:text-white capitalize block mt-0.5">{{ $order->status }}</span>
                        </div>
                    </div>

                    <!-- Visual status message -->
                    <p class="text-xs text-slate-500 dark:text-slate-400 leading-relaxed font-semibold">
                        @if($order->status === 'pending')
                            The farmer is reviewing your purchase request. Once accepted, crop packing and dispatch will start.
                        @elseif($order->status === 'accepted')
                            The farmer has accepted the order and is packing or dispatching the crops directly to your location.
                        @elseif($order->status === 'completed')
                            This order was successfully delivered. Funds have been released to the seller.
                        @else
                            This order has been cancelled. If any online payment was made, simulated refund credits are returning to your account.
                        @endif
                    </p>
                </div>

                <!-- Farmer Profile Card -->
                <div class="bg-white dark:bg-slate-800 rounded-3xl border border-slate-100 dark:border-slate-800/80 shadow-sm p-6">
                    <h3 class="font-heading font-bold text-slate-900 dark:text-white text-sm mb-4 pb-2 border-b border-slate-50 dark:border-slate-700/50 flex items-center gap-1.5">
                        <i data-lucide="user" class="w-4 h-4 text-emerald-650"></i> Farmer / Seller Details
                    </h3>

                    <div class="space-y-3.5 text-xs">
                        <div>
                            <span class="text-slate-450 block font-bold uppercase tracking-wider text-[9px]">Farmer Name</span>
                            <span class="font-bold text-slate-850 dark:text-slate-200 block mt-0.5 flex items-center gap-1">
                                {{ $order->farmer?->name ?? 'Direct Farmer' }}
                                @if($order->farmer?->is_verified)
                                    <span class="text-emerald-500" title="Verified Farmer Badge">
                                        <i data-lucide="badge-check" class="w-4 h-4 fill-emerald-500/10"></i>
                                    </span>
                                @endif
                            </span>
                        </div>
                        <div>
                            <span class="text-slate-450 block font-bold uppercase tracking-wider text-[9px]">Email Address</span>
                            <a href="mailto:{{ $order->farmer?->email }}" class="font-bold text-emerald-650 dark:text-emerald-400 block mt-0.5 hover:underline truncate">{{ $order->farmer?->email ?? 'N/A' }}</a>
                        </div>
                        <div>
                            <span class="text-slate-450 block font-bold uppercase tracking-wider text-[9px]">Contact Phone</span>
                            <a href="tel:{{ $order->farmer?->phone }}" class="font-bold text-slate-850 dark:text-slate-202 block mt-0.5 hover:underline">{{ $order->farmer?->phone ?? 'N/A' }}</a>
                        </div>
                        
                        <!-- Dynamic Chat Link -->
                        <div class="pt-2">
                            <a href="{{ route('chats.index', ['farmer_id' => $order->farmer_id]) }}" class="w-full py-2 bg-emerald-50 hover:bg-emerald-100 dark:bg-emerald-950/20 dark:hover:bg-emerald-950/30 text-emerald-700 dark:text-emerald-450 font-bold text-xs rounded-xl flex items-center justify-center gap-1.5 border border-emerald-100/50 dark:border-emerald-900/30 transition-colors">
                                <i data-lucide="message-square" class="w-3.5 h-3.5"></i> Chat with Seller
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Shipping Address Card -->
                <div class="bg-white dark:bg-slate-800 rounded-3xl border border-slate-100 dark:border-slate-800/80 shadow-sm p-6">
                    <h3 class="font-heading font-bold text-slate-900 dark:text-white text-sm mb-4 pb-2 border-b border-slate-50 dark:border-slate-700/50 flex items-center gap-1.5">
                        <i data-lucide="map-pin" class="w-4 h-4 text-emerald-655"></i> Shipping Address
                    </h3>
                    <p class="text-xs text-slate-700 dark:text-slate-350 leading-relaxed font-semibold">
                        {{ $order->shipping_address ?? 'No shipping address provided.' }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
