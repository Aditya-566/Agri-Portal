<x-app-layout>
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <!-- Breadcrumbs / Back button -->
        <div class="mb-8">
            <a href="{{ route('farmer.orders.index') }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-emerald-600 dark:text-emerald-400 hover:underline mb-3">
                <i data-lucide="arrow-left" class="w-3.5 h-3.5"></i> Back to Received Orders
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

        @if(session('success'))
            <div class="mb-6 p-4 rounded-xl bg-emerald-50 dark:bg-emerald-950/20 text-emerald-600 dark:text-emerald-400 text-xs font-semibold border border-emerald-100 dark:border-emerald-900/50 flex items-center gap-2">
                <i data-lucide="check-circle" class="w-4.5 h-4.5"></i>
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="mb-6 p-4 rounded-xl bg-rose-50 dark:bg-rose-950/20 text-rose-600 dark:text-rose-455 text-xs font-semibold border border-rose-100 dark:border-rose-900/50 flex items-center gap-2">
                <i data-lucide="alert-triangle" class="w-4.5 h-4.5"></i>
                {{ session('error') }}
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Left Side: Order items list & summary -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Products Table Card -->
                <div class="bg-white dark:bg-slate-800 rounded-3xl border border-slate-100 dark:border-slate-800/80 shadow-sm p-6">
                    <h3 class="font-heading font-bold text-slate-900 dark:text-white text-sm mb-4 pb-2 border-b border-slate-50 dark:border-slate-700/50 flex items-center gap-1.5">
                        <i data-lucide="shopping-cart" class="w-4 h-4 text-emerald-650"></i> Items Ordered
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
                                    <h4 class="font-bold text-slate-900 dark:text-white text-sm truncate">{{ $item['name'] }}</h4>
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
                            <span>Middleman Fees</span>
                            <span class="font-bold text-emerald-600 dark:text-emerald-450">₹0.00 (Fair Direct-Trade)</span>
                        </div>
                        <div class="flex justify-between text-slate-500">
                            <span>Shipping/Delivery</span>
                            <span class="font-semibold text-slate-750 dark:text-slate-200">Included</span>
                        </div>
                        <div class="flex justify-between text-sm font-extrabold text-slate-900 dark:text-white border-t border-slate-50 dark:border-slate-750 pt-3">
                            <span>Total Amount</span>
                            <span class="text-base text-emerald-600 dark:text-emerald-400">₹{{ number_format($order->total_amount, 2) }}</span>
                        </div>
                    </div>
                </div>

                <!-- Transaction Details Card -->
                <div class="bg-white dark:bg-slate-800 rounded-3xl border border-slate-100 dark:border-slate-800/80 shadow-sm p-6">
                    <h3 class="font-heading font-bold text-slate-900 dark:text-white text-sm mb-4 pb-2 border-b border-slate-50 dark:border-slate-700/50 flex items-center gap-1.5">
                        <i data-lucide="credit-card" class="w-4 h-4 text-emerald-650"></i> Payment & Billing
                    </h3>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 text-xs">
                        <div>
                            <span class="text-slate-450 block font-bold uppercase tracking-wider text-[9px] mb-1">Payment Method</span>
                            <span class="font-bold text-slate-850 dark:text-slate-200 capitalize flex items-center gap-1">
                                @if($order->payment?->payment_method === 'card')
                                    <i data-lucide="credit-card" class="w-4 h-4 text-slate-550"></i> Credit/Debit Card
                                @else
                                    <i data-lucide="hand-coins" class="w-4 h-4 text-slate-550"></i> Cash On Delivery
                                @endif
                            </span>
                        </div>
                        <div>
                            <span class="text-slate-450 block font-bold uppercase tracking-wider text-[9px] mb-1">Transaction Ref</span>
                            <span class="font-mono font-bold text-slate-850 dark:text-slate-200">{{ $order->payment?->transaction_reference ?? 'N/A' }}</span>
                        </div>
                        <div>
                            <span class="text-slate-450 block font-bold uppercase tracking-wider text-[9px] mb-1">Payment Status</span>
                            <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full font-bold uppercase tracking-wider text-[9px] {{ ($order->payment_status ?? $order->payment?->status) === 'paid' ? 'bg-emerald-50 text-emerald-600 dark:bg-emerald-950/20 dark:text-emerald-400' : 'bg-amber-50 text-amber-600 dark:bg-amber-950/20 dark:text-amber-450' }}">
                                {{ $order->payment_status ?? $order->payment?->status ?? 'pending' }}
                            </span>
                        </div>
                        <div>
                            <span class="text-slate-450 block font-bold uppercase tracking-wider text-[9px] mb-1">Receipt Status</span>
                            <span class="font-bold text-slate-850 dark:text-slate-200">System Generated Invoice available</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Side: Buyer Profile, Shipping Address, and Order Status Actions -->
            <div class="space-y-6">
                <!-- Order Status Tracker -->
                <div class="bg-white dark:bg-slate-800 rounded-3xl border border-slate-100 dark:border-slate-800/80 shadow-sm p-6">
                    <h3 class="font-heading font-bold text-slate-900 dark:text-white text-sm mb-4 pb-2 border-b border-slate-50 dark:border-slate-700/50">
                        Order Lifecycle Status
                    </h3>

                    <!-- Status Display -->
                    <div class="flex items-center gap-3 mb-6">
                        <span class="p-2.5 rounded-2xl {{ $order->status === 'completed' ? 'bg-emerald-50 dark:bg-emerald-950/20 text-emerald-605' : ($order->status === 'pending' ? 'bg-amber-50 dark:bg-amber-950/20 text-amber-605' : ($order->status === 'accepted' ? 'bg-blue-50 dark:bg-blue-950/20 text-blue-605' : 'bg-rose-50 dark:bg-rose-950/20 text-rose-605')) }}">
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

                    <!-- Update Action Form -->
                    @if(in_array($order->status, ['pending', 'accepted']))
                        <form method="POST" action="{{ route('farmer.orders.status', $order->id) }}" class="space-y-3 pt-2">
                            @csrf
                            <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 uppercase tracking-wider mb-1">
                                Update Lifecycle Status
                            </label>

                            @if($order->status === 'pending')
                                <div class="grid grid-cols-2 gap-2">
                                    <button type="submit" name="status" value="accepted" class="w-full py-2 bg-blue-600 hover:bg-blue-700 text-white font-bold text-xs rounded-xl flex items-center justify-center gap-1 shadow-sm transition-colors">
                                        <i data-lucide="check" class="w-3.5 h-3.5"></i> Accept Order
                                    </button>
                                    <button type="submit" name="status" value="cancelled" onclick="return confirm('Are you sure you want to cancel and reject this order? This will restore listed crop stock quantities.');" class="w-full py-2 bg-rose-50 hover:bg-rose-100 text-rose-605 font-bold text-xs rounded-xl flex items-center justify-center gap-1 border border-rose-100/50 transition-colors">
                                        <i data-lucide="x" class="w-3.5 h-3.5"></i> Reject Order
                                    </button>
                                </div>
                            @elseif($order->status === 'accepted')
                                <button type="submit" name="status" value="completed" class="w-full py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs rounded-xl flex items-center justify-center gap-1.5 shadow-md transition-all">
                                    <i data-lucide="check-circle" class="w-4 h-4"></i> Complete Delivery
                                </button>
                                <button type="submit" name="status" value="cancelled" onclick="return confirm('Are you sure you want to cancel this order? Item stocks will be restored.');" class="w-full mt-2 py-2 bg-rose-50 hover:bg-rose-100 text-rose-605 font-bold text-xs rounded-xl flex items-center justify-center gap-1 border border-rose-100/50 transition-colors">
                                    <i data-lucide="x" class="w-3.5 h-3.5"></i> Cancel Order
                                </button>
                            @endif
                        </form>
                    @else
                        <div class="p-3 bg-slate-50 dark:bg-slate-900 rounded-xl border border-slate-100 dark:border-slate-800 text-center text-xs font-semibold text-slate-500">
                            Order has been finalized ({{ $order->status }}) and is locked from further updates.
                        </div>
                    @endif
                </div>

                <!-- Buyer Profile Card -->
                <div class="bg-white dark:bg-slate-800 rounded-3xl border border-slate-100 dark:border-slate-800/80 shadow-sm p-6">
                    <h3 class="font-heading font-bold text-slate-900 dark:text-white text-sm mb-4 pb-2 border-b border-slate-50 dark:border-slate-700/50 flex items-center gap-1.5">
                        <i data-lucide="user" class="w-4 h-4 text-emerald-650"></i> Buyer Details
                    </h3>

                    <div class="space-y-3.5 text-xs">
                        <div>
                            <span class="text-slate-450 block font-bold uppercase tracking-wider text-[9px]">Buyer Name</span>
                            <span class="font-bold text-slate-850 dark:text-slate-200 block mt-0.5">{{ $order->buyer?->name ?? 'Direct Trade Buyer' }}</span>
                        </div>
                        <div>
                            <span class="text-slate-450 block font-bold uppercase tracking-wider text-[9px]">Email Address</span>
                            <a href="mailto:{{ $order->buyer?->email }}" class="font-bold text-emerald-600 dark:text-emerald-400 block mt-0.5 hover:underline truncate">{{ $order->buyer?->email ?? 'N/A' }}</a>
                        </div>
                        <div>
                            <span class="text-slate-450 block font-bold uppercase tracking-wider text-[9px]">Contact Phone</span>
                            <a href="tel:{{ $order->buyer?->phone }}" class="font-bold text-slate-850 dark:text-slate-200 block mt-0.5 hover:underline">{{ $order->buyer?->phone ?? 'N/A' }}</a>
                        </div>
                        
                        <!-- Dynamic Chat Link -->
                        <div class="pt-2">
                            <a href="{{ route('chats.index', ['buyer_id' => $order->buyer_id]) }}" class="w-full py-2 bg-emerald-50 hover:bg-emerald-100 dark:bg-emerald-950/20 dark:hover:bg-emerald-950/30 text-emerald-700 dark:text-emerald-450 font-bold text-xs rounded-xl flex items-center justify-center gap-1.5 border border-emerald-100/50 dark:border-emerald-900/30 transition-colors">
                                <i data-lucide="message-square" class="w-3.5 h-3.5"></i> Chat with Buyer
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Shipping Address Card -->
                <div class="bg-white dark:bg-slate-800 rounded-3xl border border-slate-100 dark:border-slate-800/80 shadow-sm p-6">
                    <h3 class="font-heading font-bold text-slate-900 dark:text-white text-sm mb-4 pb-2 border-b border-slate-50 dark:border-slate-700/50 flex items-center gap-1.5">
                        <i data-lucide="map-pin" class="w-4 h-4 text-emerald-650"></i> Shipping Address
                    </h3>
                    <p class="text-xs text-slate-700 dark:text-slate-350 leading-relaxed font-semibold">
                        {{ $order->shipping_address ?? 'No shipping address provided.' }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
