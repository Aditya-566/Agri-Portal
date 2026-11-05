<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <!-- Header -->
        <div class="mb-8">
            <a href="{{ route('cart.index') }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-emerald-600 dark:text-emerald-400 hover:underline mb-3">
                <i data-lucide="arrow-left" class="w-3.5 h-3.5"></i> Back to Shopping Cart
            </a>
            <h1 class="font-heading font-extrabold text-2xl text-slate-900 dark:text-white flex items-center gap-2">
                <span class="p-1.5 bg-emerald-100 text-emerald-700 dark:bg-emerald-950/30 dark:text-emerald-400 rounded-xl">
                    <i data-lucide="shield-check" class="w-5.5 h-5.5"></i>
                </span>
                Direct Checkout
            </h1>
            <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">Specify your delivery details and choose your direct-to-farmer payment method.</p>
        </div>

        <form method="POST" action="{{ route('orders.store') }}" class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            @csrf

            <!-- Left 2 Cols: Form details -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Shipping Address Card -->
                <div class="bg-white dark:bg-slate-800 rounded-3xl border border-slate-100 dark:border-slate-800/80 shadow-sm p-6">
                    <h3 class="font-heading font-bold text-slate-900 dark:text-white text-sm mb-4 pb-2 border-b border-slate-50 dark:border-slate-700/50 flex items-center gap-1.5">
                        <i data-lucide="map-pin" class="w-4 h-4 text-emerald-650"></i> Shipping & Delivery Address
                    </h3>
                    
                    <div>
                        <label for="shipping_address" class="block text-xs font-bold text-slate-600 dark:text-slate-400 uppercase tracking-wider mb-2">Delivery Location Details</label>
                        <textarea name="shipping_address" id="shipping_address" rows="4" placeholder="House Number, Street Name, Landmark, City, State, ZIP Code" 
                            class="w-full px-4 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50/50 dark:bg-slate-900 text-slate-900 dark:text-white text-xs font-medium focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all @error('shipping_address') border-rose-500 @enderror" required>{{ old('shipping_address') ?? auth()->user()->location }}</textarea>
                        @error('shipping_address')
                            <span class="text-rose-500 text-[10px] mt-1 font-bold block">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Payment Method Card -->
                <div class="bg-white dark:bg-slate-800 rounded-3xl border border-slate-100 dark:border-slate-800/80 shadow-sm p-6">
                    <h3 class="font-heading font-bold text-slate-900 dark:text-white text-sm mb-4 pb-2 border-b border-slate-50 dark:border-slate-700/50 flex items-center gap-1.5">
                        <i data-lucide="credit-card" class="w-4 h-4 text-emerald-650"></i> Choose Payment Method
                    </h3>

                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4" x-data="{ method: 'cod' }">
                        <!-- COD -->
                        <label class="relative flex flex-col p-4 rounded-2xl border border-slate-200 dark:border-slate-700 hover:border-emerald-500 bg-slate-50/20 dark:bg-slate-900/10 cursor-pointer select-none transition-all"
                            :class="method === 'cod' ? 'ring-2 ring-emerald-500 border-emerald-500 bg-emerald-50/10 dark:bg-emerald-950/5' : ''">
                            <input type="radio" name="payment_method" value="cod" class="sr-only" x-model="method">
                            <span class="p-2 bg-emerald-500/10 text-emerald-600 rounded-xl w-10 h-10 flex items-center justify-center mb-3">
                                <i data-lucide="banknote" class="w-5 h-5"></i>
                            </span>
                            <span class="font-bold text-slate-900 dark:text-white text-xs">Cash on Delivery</span>
                            <span class="text-[10px] text-slate-400 mt-1">Pay direct to farmer during crop dropoff.</span>
                        </label>

                        <!-- Card -->
                        <label class="relative flex flex-col p-4 rounded-2xl border border-slate-200 dark:border-slate-700 hover:border-emerald-500 bg-slate-50/20 dark:bg-slate-900/10 cursor-pointer select-none transition-all"
                            :class="method === 'card' ? 'ring-2 ring-emerald-500 border-emerald-500 bg-emerald-50/10 dark:bg-emerald-950/5' : ''">
                            <input type="radio" name="payment_method" value="card" class="sr-only" x-model="method">
                            <span class="p-2 bg-blue-500/10 text-blue-600 rounded-xl w-10 h-10 flex items-center justify-center mb-3">
                                <i data-lucide="credit-card" class="w-5 h-5"></i>
                            </span>
                            <span class="font-bold text-slate-900 dark:text-white text-xs">Debit / Credit Card</span>
                            <span class="text-[10px] text-slate-400 mt-1">Direct card gateway checkout simulator.</span>
                        </label>

                        <!-- Bank Transfer -->
                        <label class="relative flex flex-col p-4 rounded-2xl border border-slate-200 dark:border-slate-700 hover:border-emerald-500 bg-slate-50/20 dark:bg-slate-900/10 cursor-pointer select-none transition-all"
                            :class="method === 'bank_transfer' ? 'ring-2 ring-emerald-500 border-emerald-500 bg-emerald-50/10 dark:bg-emerald-950/5' : ''">
                            <input type="radio" name="payment_method" value="bank_transfer" class="sr-only" x-model="method">
                            <span class="p-2 bg-amber-500/10 text-amber-600 rounded-xl w-10 h-10 flex items-center justify-center mb-3">
                                <i data-lucide="landmark" class="w-5 h-5"></i>
                            </span>
                            <span class="font-bold text-slate-900 dark:text-white text-xs">Direct Wire Transfer</span>
                            <span class="text-[10px] text-slate-400 mt-1">Direct account routing with farmer.</span>
                        </label>
                    </div>
                </div>
            </div>

            <!-- Right 1 Col: Orders overview grouped by farmer -->
            <div class="space-y-6">
                <div class="bg-white dark:bg-slate-800 rounded-3xl border border-slate-100 dark:border-slate-800/80 shadow-md p-6">
                    <h3 class="font-heading font-bold text-slate-900 dark:text-white text-sm mb-4 pb-2 border-b border-slate-50 dark:border-slate-700/50 flex items-center gap-1.5">
                        <i data-lucide="receipt-text" class="w-4 h-4 text-emerald-650"></i> Items Summary
                    </h3>

                    <div class="space-y-6 max-h-[300px] overflow-y-auto pr-1">
                        @php $grandTotal = 0; @endphp
                        @foreach($groupedItems as $farmerId => $items)
                            @php
                                $farmer = $farmers[$farmerId] ?? null;
                            @endphp
                            <div class="space-y-2">
                                <div class="flex items-center gap-1.5 text-[11px] font-bold text-emerald-600 dark:text-emerald-400 uppercase tracking-wider">
                                    <i data-lucide="user" class="w-3.5 h-3.5"></i> Farmer: {{ $farmer?->name ?? 'Direct Farmer' }}
                                </div>
                                <div class="space-y-1.5 pl-3">
                                    @foreach($items as $item)
                                        @php $grandTotal += $item['item_total']; @endphp
                                        <div class="flex items-center justify-between text-xs">
                                            <span class="text-slate-650 dark:text-slate-300 font-medium truncate max-w-[150px]">{{ $item['name'] }}</span>
                                            <span class="text-slate-400 font-semibold shrink-0">{{ $item['quantity'] }} kg</span>
                                            <span class="text-slate-900 dark:text-white font-bold shrink-0">₹{{ number_format($item['item_total'], 2) }}</span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Invoice Calculation details -->
                    <div class="border-t border-slate-100 dark:border-slate-750 mt-6 pt-4 space-y-2.5 text-xs">
                        <div class="flex justify-between text-slate-500">
                            <span>Direct Order Subtotal</span>
                            <span class="font-semibold text-slate-750 dark:text-slate-205">₹{{ number_format($grandTotal, 2) }}</span>
                        </div>
                        <div class="flex justify-between text-slate-500">
                            <span>Direct Shipping</span>
                            <span class="font-semibold text-slate-750 dark:text-slate-205">Included (FREE)</span>
                        </div>
                        <div class="flex justify-between text-slate-800 dark:text-white font-extrabold text-sm border-t border-slate-105 dark:border-slate-750 pt-4">
                            <span>Direct Pay Total</span>
                            <span class="text-base text-emerald-600 dark:text-emerald-400">₹{{ number_format($grandTotal, 2) }}</span>
                        </div>
                    </div>

                    <!-- Final Submission -->
                    <div class="mt-6 pt-2">
                        <button type="submit" class="w-full py-3 bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs rounded-xl shadow-md transition-all flex items-center justify-center gap-1.5 hover:-translate-y-0.5">
                            <i data-lucide="check" class="w-4 h-4"></i> Place Direct Order
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</x-app-layout>
