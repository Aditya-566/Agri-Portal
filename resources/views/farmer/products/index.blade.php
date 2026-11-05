<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <!-- Toast Alerts -->
        @if(session('success'))
            <div class="mb-6 p-4 rounded-xl bg-emerald-50 dark:bg-emerald-950/20 text-emerald-600 dark:text-emerald-400 text-xs font-semibold border border-emerald-100 dark:border-emerald-900/50 flex items-center gap-2 animate-fade-in">
                <i data-lucide="check-circle" class="w-4.5 h-4.5 shrink-0"></i>
                {{ session('success') }}
            </div>
        @endif

        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
            <div>
                <h1 class="font-heading font-extrabold text-2xl text-slate-900 dark:text-white flex items-center gap-2">
                    <span class="p-1.5 bg-emerald-100 text-emerald-700 dark:bg-emerald-950/30 dark:text-emerald-400 rounded-xl">
                        <i data-lucide="package" class="w-5.5 h-5.5"></i>
                    </span>
                    My Crop Listings
                </h1>
                <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">Manage your active crop inventory, toggle organic flags, and update prices for direct trade.</p>
            </div>
            
            <a href="{{ route('farmer.products.create') }}" class="px-5 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs rounded-xl shadow-md transition-all flex items-center justify-center gap-1.5 self-start sm:self-auto hover:-translate-y-0.5">
                <i data-lucide="plus-circle" class="w-4 h-4"></i> Add Crop Listing
            </a>
        </div>

        <div class="bg-white dark:bg-slate-800 rounded-3xl border border-slate-100 dark:border-slate-800/80 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs border-collapse">
                    <thead>
                        <tr class="border-b border-slate-100 dark:border-slate-750 bg-slate-50/50 dark:bg-slate-900/30 text-slate-400 font-bold uppercase tracking-wider text-[10px]">
                            <th class="py-4 px-6">Crop Name</th>
                            <th class="py-4 px-4">Category</th>
                            <th class="py-4 px-4">Price / kg</th>
                            <th class="py-4 px-4">Available Stock</th>
                            <th class="py-4 px-4">Organic</th>
                            <th class="py-4 px-4">Harvest Date</th>
                            <th class="py-4 px-4">Status</th>
                            <th class="py-4 px-6 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 dark:divide-slate-750 font-medium text-slate-650 dark:text-slate-300">
                        @forelse($products as $product)
                            <tr class="hover:bg-slate-50/30 dark:hover:bg-slate-900/30 transition-colors">
                                <!-- Name and image -->
                                <td class="py-4 px-6">
                                    <div class="flex items-center gap-3">
                                        <div class="w-12 h-12 rounded-xl overflow-hidden shrink-0 bg-slate-100 dark:bg-slate-900 border border-slate-100 dark:border-slate-850">
                                            @if($product->image_path)
                                                <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }}" class="w-full h-full object-cover" />
                                            @else
                                                <div class="w-full h-full flex items-center justify-center text-slate-400 bg-emerald-50/10">
                                                    <i data-lucide="sprout" class="w-5 h-5 text-emerald-600"></i>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="flex flex-col min-w-0">
                                            <a href="{{ route('products.show', $product->id) }}" class="font-bold text-slate-900 dark:text-white text-sm hover:text-emerald-600 dark:hover:text-emerald-400 truncate">{{ $product->name }}</a>
                                            <span class="text-[10px] text-slate-400 truncate flex items-center gap-0.5 mt-0.5">
                                                <i data-lucide="map-pin" class="w-3 h-3"></i> {{ $product->location }}
                                            </span>
                                        </div>
                                    </div>
                                </td>
                                
                                <td class="py-4 px-4 font-semibold text-slate-800 dark:text-slate-200">
                                    {{ $product->category?->name ?? 'Uncategorized' }}
                                </td>
                                
                                <td class="py-4 px-4 font-bold text-slate-900 dark:text-white">
                                    ₹{{ number_format($product->price, 2) }}
                                </td>
                                
                                <td class="py-4 px-4 font-semibold">
                                    {{ $product->quantity }} kg
                                </td>
                                
                                <td class="py-4 px-4">
                                    @if($product->is_organic)
                                        <span class="inline-flex items-center gap-0.5 px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-50 text-emerald-600 dark:bg-emerald-950/20 dark:text-emerald-400">
                                            <i data-lucide="leaf" class="w-3 h-3"></i> Yes
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-0.5 px-2 py-0.5 rounded-full text-[10px] font-bold bg-slate-50 text-slate-400 dark:bg-slate-900 dark:text-slate-500">
                                            No
                                        </span>
                                    @endif
                                </td>
                                
                                <td class="py-4 px-4">
                                    {{ $product->harvest_date ? $product->harvest_date->format('M d, Y') : '-' }}
                                </td>
                                
                                <td class="py-4 px-4">
                                    <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wider {{ $product->status === 'available' ? 'bg-emerald-50 text-emerald-600 dark:bg-emerald-950/20 dark:text-emerald-400' : 'bg-rose-50 text-rose-600 dark:bg-rose-950/20 dark:text-rose-450' }}">
                                        {{ $product->status === 'available' ? 'In Stock' : 'Sold Out' }}
                                    </span>
                                </td>
                                
                                <td class="py-4 px-6 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="{{ route('farmer.products.edit', $product->id) }}" class="p-2 bg-slate-50 hover:bg-slate-100 dark:bg-slate-900 dark:hover:bg-slate-800 text-slate-600 dark:text-slate-350 border border-slate-200 dark:border-slate-700 rounded-lg transition-all" title="Edit Listing">
                                            <i data-lucide="pencil" class="w-3.5 h-3.5"></i>
                                        </a>
                                        
                                        <form method="POST" action="{{ route('farmer.products.destroy', $product->id) }}" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this crop listing? This action cannot be undone.');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-2 bg-rose-50 hover:bg-rose-100 dark:bg-rose-950/10 dark:hover:bg-rose-950/20 text-rose-600 dark:text-rose-400 border border-rose-100/50 dark:border-rose-900/50 rounded-lg transition-all" title="Delete Listing">
                                                <i data-lucide="trash-2" class="w-3.5 h-3.5"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="py-12 text-center text-slate-400 dark:text-slate-600 p-8 space-y-3">
                                    <div class="w-10 h-10 rounded-full bg-slate-50 dark:bg-slate-900 flex items-center justify-center mx-auto text-slate-400">
                                        <i data-lucide="package-open" class="w-5 h-5"></i>
                                    </div>
                                    <div class="font-bold text-slate-700 dark:text-slate-300">No crops listed yet</div>
                                    <p class="text-xs text-slate-400 max-w-xs mx-auto">Get started by listing your first crop for direct trade with wholesale or retail buyers.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination links -->
            @if($products->hasPages())
                <div class="p-4 border-t border-slate-100 dark:border-slate-750">
                    {{ $products->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
