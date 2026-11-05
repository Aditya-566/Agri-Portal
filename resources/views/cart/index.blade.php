<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <!-- Header -->
        <div class="mb-8">
            <a href="{{ route('products.index') }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-emerald-600 dark:text-emerald-400 hover:underline mb-3">
                <i data-lucide="arrow-left" class="w-3.5 h-3.5"></i> Continue Shopping
            </a>
            <h1 class="font-heading font-extrabold text-2xl text-slate-900 dark:text-white flex items-center gap-2">
                <span class="p-1.5 bg-emerald-100 text-emerald-700 dark:bg-emerald-950/30 dark:text-emerald-400 rounded-xl">
                    <i data-lucide="shopping-cart" class="w-5.5 h-5.5"></i>
                </span>
                My Shopping Cart
            </h1>
            <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">Review the agricultural items you've added from direct farmers before checking out.</p>
        </div>

        <!-- Alert messages -->
        @if(session('success'))
            <div class="mb-6 p-4 rounded-xl bg-emerald-50 dark:bg-emerald-950/20 text-emerald-600 dark:text-emerald-400 text-xs font-semibold border border-emerald-100 dark:border-emerald-900/50 flex items-center gap-2">
                <i data-lucide="check-circle" class="w-4.5 h-4.5 shrink-0"></i>
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="mb-6 p-4 rounded-xl bg-rose-50 dark:bg-rose-950/20 text-rose-600 dark:text-rose-455 text-xs font-semibold border border-rose-100 dark:border-rose-900/50 flex items-center gap-2">
                <i data-lucide="alert-triangle" class="w-4.5 h-4.5 shrink-0"></i>
                {{ session('error') }}
            </div>
        @endif

        @if(count($cartItems) > 0)
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Cart items list (2 columns) -->
                <div class="lg:col-span-2 space-y-4">
                    <div class="bg-white dark:bg-slate-800 rounded-3xl border border-slate-100 dark:border-slate-800/80 shadow-sm overflow-hidden">
                        <div class="overflow-x-auto">
                            <table class="w-full text-left text-xs border-collapse">
                                <thead>
                                    <tr class="border-b border-slate-100 dark:border-slate-750 bg-slate-50/50 dark:bg-slate-900/30 text-slate-400 font-bold uppercase tracking-wider text-[10px]">
                                        <th class="py-4 px-6">Crop / Product</th>
                                        <th class="py-4 px-4">Price / kg</th>
                                        <th class="py-4 px-4">Quantity (kg)</th>
                                        <th class="py-4 px-4">Subtotal</th>
                                        <th class="py-4 px-6 text-right">Remove</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-100 dark:divide-slate-750 font-medium text-slate-650 dark:text-slate-300">
                                    @foreach($cartItems as $item)
                                        <tr class="hover:bg-slate-50/30 dark:hover:bg-slate-900/30 transition-colors">
                                            <!-- Product Details -->
                                            <td class="py-4 px-6">
                                                <div class="flex items-center gap-3">
                                                    <div class="w-12 h-12 rounded-xl overflow-hidden shrink-0 bg-slate-100 dark:bg-slate-900 border border-slate-100 dark:border-slate-750">
                                                        @if($item['image_path'])
                                                            <img src="{{ asset('storage/' . $item['image_path']) }}" alt="{{ $item['name'] }}" class="w-full h-full object-cover" />
                                                        @else
                                                            <div class="w-full h-full flex items-center justify-center text-slate-400 bg-emerald-50/10">
                                                                <i data-lucide="sprout" class="w-5 h-5 text-emerald-600"></i>
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <div class="flex flex-col min-w-0">
                                                        <a href="{{ route('products.show', $item['product_id']) }}" class="font-bold text-slate-900 dark:text-white text-sm hover:text-emerald-650 truncate">{{ $item['name'] }}</a>
                                                        <span class="text-[10px] text-slate-400 mt-0.5 truncate">
                                                            Farmer: <span class="font-bold text-slate-500 dark:text-slate-300">{{ $item['farmer_name'] }}</span>
                                                        </span>
                                                    </div>
                                                </div>
                                            </td>

                                            <!-- Price -->
                                            <td class="py-4 px-4 font-bold text-slate-900 dark:text-white">
                                                ₹{{ number_format($item['price'], 2) }}
                                            </td>

                                            <!-- Quantity Update Form -->
                                            <td class="py-4 px-4">
                                                <form method="POST" action="{{ route('cart.update') }}" class="flex items-center gap-1.5">
                                                    @csrf
                                                    <input type="hidden" name="product_id" value="{{ $item['product_id'] }}">
                                                    <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="0.1" step="0.1" max="{{ $item['available_quantity'] }}"
                                                        class="w-16 px-2 py-1 text-center bg-slate-50 dark:bg-slate-900 text-slate-800 dark:text-white border border-slate-200 dark:border-slate-700 rounded-lg text-xs font-bold focus:ring-1 focus:ring-emerald-500 focus:border-emerald-500">
                                                    <button type="submit" class="p-1.5 bg-emerald-50 hover:bg-emerald-100 dark:bg-emerald-950/20 dark:hover:bg-emerald-950/30 text-emerald-700 dark:text-emerald-400 rounded-lg transition-colors" title="Update Quantity">
                                                        <i data-lucide="refresh-cw" class="w-3.5 h-3.5"></i>
                                                    </button>
                                                </form>
                                                <span class="text-[9px] text-slate-400 mt-0.5 block">Max: {{ $item['available_quantity'] }} kg</span>
                                            </td>

                                            <!-- Subtotal -->
                                            <td class="py-4 px-4 font-extrabold text-slate-900 dark:text-white">
                                                ₹{{ number_format($item['total'], 2) }}
                                            </td>

                                            <!-- Remove action -->
                                            <td class="py-4 px-6 text-right">
                                                <form method="POST" action="{{ route('cart.remove', $item['product_id']) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="p-2 bg-rose-50 hover:bg-rose-100 dark:bg-rose-950/10 dark:hover:bg-rose-950/20 text-rose-600 dark:text-rose-405 border border-rose-100/50 dark:border-rose-900/30 rounded-lg transition-colors" title="Remove Crop">
                                                        <i data-lucide="trash-2" class="w-3.5 h-3.5"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Order summary pane (1 column) -->
                <div class="space-y-6">
                    <div class="bg-white dark:bg-slate-800 rounded-3xl border border-slate-100 dark:border-slate-800/80 shadow-md p-6">
                        <h3 class="font-heading font-bold text-slate-900 dark:text-white text-base mb-4 pb-2 border-b border-slate-50 dark:border-slate-700/50">
                            Order Summary
                        </h3>

                        <div class="space-y-3.5 text-xs text-slate-550 dark:text-slate-400 font-semibold mb-6">
                            <div class="flex justify-between">
                                <span>Cart Subtotal</span>
                                <span class="font-bold text-slate-800 dark:text-slate-205">₹{{ number_format($total, 2) }}</span>
                            </div>
                            <div class="flex justify-between text-emerald-600 dark:text-emerald-450">
                                <span>Middleman Surcharge</span>
                                <span class="font-extrabold">₹0.00 (Save 100%)</span>
                            </div>
                            <div class="flex justify-between">
                                <span>Direct Delivery Fee</span>
                                <span class="font-bold text-slate-800 dark:text-slate-205">FREE</span>
                            </div>
                            <div class="flex justify-between text-slate-800 dark:text-white font-extrabold text-sm border-t border-slate-105 dark:border-slate-750 pt-4">
                                <span>Direct Pay Total</span>
                                <span class="text-base text-emerald-600 dark:text-emerald-400">₹{{ number_format($total, 2) }}</span>
                            </div>
                        </div>

                        <!-- Direct checkout action -->
                        <div class="space-y-3">
                            <a href="{{ route('orders.checkout') }}" class="w-full py-3 bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs rounded-xl shadow-md transition-all flex items-center justify-center gap-1.5 hover:-translate-y-0.5">
                                Proceed to Checkout <i data-lucide="arrow-right" class="w-4 h-4"></i>
                            </a>
                            <div class="p-3 bg-emerald-50/50 dark:bg-emerald-950/10 border border-emerald-100/50 dark:border-emerald-900/30 rounded-xl text-[10px] text-emerald-800 dark:text-emerald-350 text-center leading-relaxed">
                                <i data-lucide="shield-check" class="w-4 h-4 inline-block align-middle mr-1"></i>
                                Secure platform guarantees funds remain escrowed until successful delivery.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <!-- Empty state -->
            <div class="bg-white dark:bg-slate-800 rounded-3xl border border-slate-100 dark:border-slate-800/80 shadow-sm p-16 text-center max-w-xl mx-auto space-y-4">
                <div class="w-16 h-16 rounded-full bg-slate-50 dark:bg-slate-900 flex items-center justify-center mx-auto text-slate-400 border border-slate-150 dark:border-slate-850">
                    <i data-lucide="shopping-cart" class="w-8 h-8 text-slate-400"></i>
                </div>
                <h3 class="font-heading font-bold text-slate-800 dark:text-white text-base">Your Cart is Empty</h3>
                <p class="text-xs text-slate-500 dark:text-slate-400 leading-relaxed max-w-xs mx-auto">
                    You haven't added any crops to your shopping cart yet. Browse available listings to support local farmers.
                </p>
                <div class="pt-2">
                    <a href="{{ route('products.index') }}" class="px-5 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs rounded-xl shadow-md transition-all inline-flex items-center gap-1.5 hover:-translate-y-0.5">
                        <i data-lucide="search" class="w-4 h-4"></i> Explore Fresh Produce
                    </a>
                </div>
            </div>
        @endif
    </div>
</x-app-layout>
