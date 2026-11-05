<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <!-- Toast Alerts -->
        @if(session('success'))
            <div class="mb-6 p-4 rounded-xl bg-emerald-50 dark:bg-emerald-950/20 text-emerald-600 dark:text-emerald-400 text-xs font-semibold border border-emerald-100 dark:border-emerald-900/50 flex items-center gap-2 animate-fade-in">
                <i data-lucide="check-circle" class="w-4.5 h-4.5 shrink-0"></i>
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="mb-6 p-4 rounded-xl bg-rose-50 dark:bg-rose-950/20 text-rose-600 dark:text-rose-455 text-xs font-semibold border border-rose-100 dark:border-rose-900/50 flex items-center gap-2 animate-fade-in">
                <i data-lucide="alert-triangle" class="w-4.5 h-4.5 shrink-0"></i>
                {{ session('error') }}
            </div>
        @endif

        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
            <div>
                <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-emerald-600 dark:text-emerald-400 hover:underline mb-3">
                    <i data-lucide="arrow-left" class="w-3.5 h-3.5"></i> Back to Dashboard
                </a>
                <h1 class="font-heading font-extrabold text-2xl text-slate-900 dark:text-white flex items-center gap-2">
                    <span class="p-1.5 bg-emerald-100 text-emerald-700 dark:bg-emerald-950/30 dark:text-emerald-400 rounded-xl">
                        <i data-lucide="alert-octagon" class="w-5.5 h-5.5"></i>
                    </span>
                    Listing Moderation
                </h1>
                <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">Review active crop offers, remove policy-violating products, and ensure price compliance.</p>
            </div>
        </div>

        <!-- Search / Filter bar -->
        <div class="bg-white dark:bg-slate-800 rounded-2xl border border-slate-100 dark:border-slate-800/80 shadow-sm p-4 mb-8">
            <form method="GET" action="{{ route('admin.products.index') }}" class="flex flex-col sm:flex-row gap-4">
                <div class="flex-grow">
                    <div class="relative">
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by crop name..."
                            class="w-full pl-10 pr-4 py-2 bg-slate-50 dark:bg-slate-900 text-slate-850 dark:text-white border border-slate-205 dark:border-slate-700 rounded-xl text-xs focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 font-medium">
                        <span class="absolute left-3.5 top-2.5 text-slate-400">
                            <i data-lucide="search" class="w-4 h-4"></i>
                        </span>
                    </div>
                </div>
                
                <div class="w-full sm:w-48">
                    <select name="category" class="w-full py-2 bg-slate-50 dark:bg-slate-900 text-slate-850 dark:text-white border border-slate-205 dark:border-slate-700 rounded-xl text-xs focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 font-medium">
                        <option value="">All Categories</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="flex gap-2">
                    <button type="submit" class="px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs rounded-xl shadow-sm transition-colors">
                        Apply Filters
                    </button>
                    <a href="{{ route('admin.products.index') }}" class="px-4 py-2 bg-slate-100 hover:bg-slate-200 dark:bg-slate-700 dark:hover:bg-slate-655 text-slate-700 dark:text-slate-200 font-bold text-xs rounded-xl transition-colors text-center flex items-center justify-center">
                        Reset
                    </a>
                </div>
            </form>
        </div>

        <!-- Products Table -->
        <div class="bg-white dark:bg-slate-800 rounded-3xl border border-slate-100 dark:border-slate-800/80 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs border-collapse">
                    <thead>
                        <tr class="border-b border-slate-100 dark:border-slate-750 bg-slate-50/50 dark:bg-slate-900/30 text-slate-400 font-bold uppercase tracking-wider text-[10px]">
                            <th class="py-4 px-6">Crop / Product</th>
                            <th class="py-4 px-4">Category</th>
                            <th class="py-4 px-4">Farmer</th>
                            <th class="py-4 px-4">Price</th>
                            <th class="py-4 px-4">Stock Quantity</th>
                            <th class="py-4 px-4">Type</th>
                            <th class="py-4 px-4">Status</th>
                            <th class="py-4 px-4">Harvest Date</th>
                            <th class="py-4 px-6 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 dark:divide-slate-750 font-medium text-slate-650 dark:text-slate-300">
                        @forelse($products as $product)
                            <tr class="hover:bg-slate-50/30 dark:hover:bg-slate-900/30 transition-colors">
                                <!-- Crop Info -->
                                <td class="py-4 px-6 font-bold text-slate-900 dark:text-white">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-xl overflow-hidden bg-slate-100 dark:bg-slate-750 shrink-0 border border-slate-100 dark:border-slate-700">
                                            @if($product->image_path)
                                                <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                                            @else
                                                <div class="w-full h-full flex items-center justify-center bg-emerald-50 dark:bg-emerald-950/20 text-emerald-600">
                                                    <i data-lucide="sprout" class="w-5 h-5"></i>
                                                </div>
                                            @endif
                                        </div>
                                        <div>
                                            <span class="block text-slate-900 dark:text-white font-extrabold text-sm">{{ $product->name }}</span>
                                            <span class="block text-[10px] text-slate-400 font-medium mt-0.5"><i data-lucide="map-pin" class="w-3 h-3 inline pb-0.5"></i> {{ $product->location }}</span>
                                        </div>
                                    </div>
                                </td>

                                <!-- Category -->
                                <td class="py-4 px-4 text-slate-700 dark:text-slate-305">
                                    <span class="inline-flex items-center gap-1.5 px-2 py-1 bg-slate-100 dark:bg-slate-750 text-slate-700 dark:text-slate-300 rounded-lg text-[10px] font-bold">
                                        @if($product->category?->icon)
                                            <i data-lucide="{{ $product->category->icon }}" class="w-3.5 h-3.5"></i>
                                        @endif
                                        {{ $product->category?->name ?? 'Uncategorized' }}
                                    </span>
                                </td>

                                <!-- Farmer -->
                                <td class="py-4 px-4">
                                    <div class="flex flex-col">
                                        <span class="text-slate-800 dark:text-white font-semibold">{{ $product->farmer?->name ?? 'Unknown Farmer' }}</span>
                                        @if($product->farmer?->is_verified)
                                            <span class="inline-flex items-center gap-0.5 text-[9px] font-extrabold text-emerald-605 mt-0.5">
                                                <i data-lucide="badge-check" class="w-3 h-3 fill-emerald-500/10"></i> Verified Seller
                                            </span>
                                        @endif
                                    </div>
                                </td>

                                <!-- Price -->
                                <td class="py-4 px-4 text-slate-900 dark:text-white font-extrabold text-xs">
                                    ₹{{ number_format($product->price, 2) }} <span class="text-slate-400 font-medium text-[9px]">/ kg</span>
                                </td>

                                <!-- Quantity -->
                                <td class="py-4 px-4 text-slate-700 dark:text-slate-305">
                                    {{ $product->quantity }} kg
                                </td>

                                <!-- Organic / Inorganic type -->
                                <td class="py-4 px-4">
                                    @if($product->is_organic)
                                        <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-emerald-100 text-emerald-700 dark:bg-emerald-950/40 dark:text-emerald-450">
                                            <i data-lucide="leaf" class="w-3 h-3"></i> Organic
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-slate-100 text-slate-600 dark:bg-slate-800 dark:text-slate-400">
                                            Standard
                                        </span>
                                    @endif
                                </td>

                                <!-- Status -->
                                <td class="py-4 px-4">
                                    @if($product->status === 'available')
                                        <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-emerald-50 text-emerald-605 dark:bg-emerald-950/20 dark:text-emerald-400">
                                            Available
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-rose-50 text-rose-605 dark:bg-rose-950/20 dark:text-rose-400">
                                            Sold Out
                                        </span>
                                    @endif
                                </td>

                                <!-- Harvest Date -->
                                <td class="py-4 px-4 text-slate-505 dark:text-slate-400 text-[10px] font-medium">
                                    {{ $product->harvest_date ? $product->harvest_date->format('M d, Y') : 'N/A' }}
                                </td>

                                <!-- Actions -->
                                <td class="py-4 px-6 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="{{ route('products.show', $product->id) }}" target="_blank" class="p-1.5 bg-slate-100 hover:bg-slate-200 dark:bg-slate-700 dark:hover:bg-slate-655 text-slate-705 dark:text-slate-200 rounded-lg transition-all" title="Preview Listing">
                                            <i data-lucide="eye" class="w-3.5 h-3.5"></i>
                                        </a>
                                        
                                        <form method="POST" action="{{ route('admin.products.destroy', $product->id) }}" class="inline-block" onsubmit="return confirm('Are you sure you want to remove this crop listing from the platform?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-1.5 bg-rose-50 hover:bg-rose-100 dark:bg-rose-950/15 text-rose-600 dark:text-rose-400 border border-rose-100/50 rounded-lg transition-all" title="Remove Listing">
                                                <i data-lucide="trash-2" class="w-3.5 h-3.5"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="py-16 text-center text-slate-400 dark:text-slate-655 p-8">
                                    <div class="w-12 h-12 rounded-full bg-slate-50 dark:bg-slate-900 flex items-center justify-center mx-auto text-slate-400 mb-3 border border-slate-100 dark:border-slate-800">
                                        <i data-lucide="sprout" class="w-6 h-6"></i>
                                    </div>
                                    <div class="font-bold text-slate-700 dark:text-slate-350">No crops found</div>
                                    <p class="text-xs text-slate-450 mt-1 max-w-xs mx-auto">No crop listings matched your current filters or search query.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($products->hasPages())
                <div class="p-4 border-t border-slate-100 dark:border-slate-750">
                    {{ $products->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
