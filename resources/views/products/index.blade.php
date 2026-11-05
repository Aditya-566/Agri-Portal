<x-app-layout>
    <!-- Page Header Banner with premium sunlit gradient -->
    <div class="relative overflow-hidden bg-gradient-to-br from-[#FFF3D6]/70 via-[#F8F5F0] to-[#D6F0FF]/40 border-b border-[#EFE7DA] py-20 pt-28">
        <!-- Ambient Blur spots -->
        <div class="absolute -top-12 right-1/4 w-80 h-80 bg-[#00B894]/5 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-10 -right-10 w-64 h-64 bg-[#FF9F1C]/10 rounded-full blur-2xl pointer-events-none"></div>
        <div class="absolute top-1/2 left-10 w-48 h-48 bg-[#D6F0FF] rounded-full blur-2xl opacity-50 pointer-events-none"></div>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center space-y-5">
            <span class="inline-flex items-center gap-1.5 px-4.5 py-2.5 rounded-full text-[10px] font-black uppercase tracking-wider bg-[#00B894]/10 text-[#00B894] border border-[#00B894]/15 shadow-sm">
                <i data-lucide="sprout" class="w-3.5 h-3.5 animate-sway"></i> 100% Peer-to-Peer Sourcing
            </span>
            <h1 class="font-heading font-black text-4xl sm:text-5xl text-[#1E1E1E] tracking-tight">Direct Crop <span class="bg-gradient-to-r from-[#00B894] to-[#4F6F52] bg-clip-text text-transparent">Marketplace</span></h1>
            <p class="text-slate-500 text-xs sm:text-sm max-w-xl mx-auto leading-relaxed font-semibold">
                Skip the middlemen. Purchase freshly harvested grains, fruits, and vegetables directly from verified local growers at transparent regional rates.
            </p>
        </div>
    </div>

    <!-- Search & Filter Layout -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 relative z-10">
        <div class="grid lg:grid-cols-4 gap-8">
            
            <!-- Filters Sidebar -->
            <div class="lg:col-span-1">
                <form method="GET" action="{{ route('products.index') }}" class="glass-premium p-6 rounded-3xl border border-white/50 shadow-premium space-y-6">
                    <div class="flex items-center justify-between border-b border-[#EFE7DA] pb-4">
                        <h3 class="font-heading font-black text-[#1E1E1E] flex items-center gap-2 text-xs uppercase tracking-widest">
                            <i data-lucide="sliders-horizontal" class="w-4 h-4 text-[#00B894]"></i> Search Filters
                        </h3>
                        <a href="{{ route('products.index') }}" class="text-[10px] font-black text-slate-400 hover:text-[#FF9F1C] uppercase tracking-widest transition-colors">Clear All</a>
                    </div>

                    <!-- Search Input -->
                    <div class="space-y-2">
                        <label for="search" class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Search Crops</label>
                        <div class="relative">
                            <input type="text" id="search" name="search" value="{{ request('search') }}" placeholder="Wheat, Rice, Tomato..." class="w-full pl-10 pr-4 py-3 bg-white/50 border border-[#EFE7DA] rounded-xl text-xs font-semibold focus:ring-2 focus:ring-[#00B894] focus:border-[#00B894] text-[#1E1E1E] placeholder-slate-400 shadow-sm" />
                            <i data-lucide="search" class="absolute left-3.5 top-3.5 w-4 h-4 text-slate-400"></i>
                        </div>
                    </div>

                    <!-- Category Select -->
                    <div class="space-y-2">
                        <label for="category" class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Category</label>
                        <select id="category" name="category" class="w-full px-4 py-3 bg-white/50 border border-[#EFE7DA] rounded-xl text-xs font-semibold focus:ring-2 focus:ring-[#00B894] focus:border-[#00B894] text-[#1E1E1E] shadow-sm">
                            <option value="">All Categories</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Location Input -->
                    <div class="space-y-2">
                        <label for="location" class="text-[9px] font-black text-slate-400 uppercase tracking-widest">State / Region</label>
                        <div class="relative">
                            <input type="text" id="location" name="location" value="{{ request('location') }}" placeholder="Punjab, Maharashtra..." class="w-full pl-10 pr-4 py-3 bg-white/50 border border-[#EFE7DA] rounded-xl text-xs font-semibold focus:ring-2 focus:ring-[#00B894] focus:border-[#00B894] text-[#1E1E1E] placeholder-slate-400 shadow-sm" />
                            <i data-lucide="map-pin" class="absolute left-3.5 top-3.5 w-4 h-4 text-slate-400"></i>
                        </div>
                    </div>

                    <!-- Organic Toggle -->
                    <div class="flex items-center justify-between p-4.5 rounded-2xl bg-[#00B894]/5 border border-[#00B894]/10">
                        <div class="flex flex-col">
                            <span class="text-xs font-black text-[#1E1E1E]">Organic Only</span>
                            <span class="text-[9px] text-slate-400 font-medium mt-0.5">Chemical-free produce</span>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="organic" value="1" {{ request('organic') ? 'checked' : '' }} class="sr-only peer" onchange="this.form.submit()">
                            <div class="w-9 h-5 bg-[#EFE7DA] peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-[#00B894]"></div>
                        </label>
                    </div>

                    <!-- Price Range -->
                    <div class="space-y-2">
                        <label class="text-[9px] font-black text-slate-400 uppercase tracking-widest block">Price Limits (₹/kg)</label>
                        <div class="grid grid-cols-2 gap-3">
                            <input type="number" step="0.01" name="min_price" value="{{ request('min_price') }}" placeholder="Min" class="w-full px-4 py-3 bg-white/50 border border-[#EFE7DA] rounded-xl text-xs font-semibold focus:ring-2 focus:ring-[#00B894] focus:border-[#00B894] text-[#1E1E1E] placeholder-slate-400 shadow-sm" />
                            <input type="number" step="0.01" name="max_price" value="{{ request('max_price') }}" placeholder="Max" class="w-full px-4 py-3 bg-white/50 border border-[#EFE7DA] rounded-xl text-xs font-semibold focus:ring-2 focus:ring-[#00B894] focus:border-[#00B894] text-[#1E1E1E] placeholder-slate-400 shadow-sm" />
                        </div>
                    </div>

                    <button type="submit" class="w-full py-4 bg-[#00B894] hover:bg-[#02d4ab] text-white font-extrabold text-xs uppercase tracking-widest rounded-xl shadow-md hover:-translate-y-0.5 transition-all flex items-center justify-center gap-1.5">
                        <i data-lucide="filter" class="w-4 h-4"></i> Apply Filters
                    </button>
                </form>
            </div>

            <!-- Products Grid Section -->
            <div class="lg:col-span-3 space-y-6">
                <!-- Search count and info bar -->
                <div class="flex items-center justify-between text-xs text-slate-500 bg-white/40 border border-[#EFE7DA] p-4.5 rounded-2xl shadow-sm backdrop-blur-sm">
                    <div>
                        Showing <span class="font-black text-[#00B894]">{{ $products->firstItem() ?? 0 }}-{{ $products->lastItem() ?? 0 }}</span> of <span class="font-black text-slate-600">{{ $products->total() }}</span> direct listings
                    </div>
                </div>

                <!-- Products Grid -->
                <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @forelse($products as $product)
                        <x-product-card :product="$product" />
                    @empty
                        <div class="col-span-3 text-center py-24 glass-premium rounded-3xl border border-white/50 p-8 space-y-5">
                            <div class="w-14 h-14 rounded-full bg-[#00B894]/10 text-[#00B894] flex items-center justify-center mx-auto">
                                <i data-lucide="search-x" class="w-7 h-7"></i>
                            </div>
                            <h3 class="font-heading font-black text-[#1E1E1E] text-lg">No crops match your search</h3>
                            <p class="text-slate-500 text-xs font-semibold max-w-sm mx-auto leading-relaxed">Try modifying keywords, expanding locations, or clearing price limits.</p>
                            <a href="{{ route('products.index') }}" class="inline-flex items-center gap-1.5 px-6 py-3.5 bg-[#00B894] hover:bg-[#02d4ab] text-white font-extrabold text-xs uppercase tracking-widest rounded-xl transition-all shadow-md">Reset Search</a>
                        </div>
                    @endforelse
                </div>

                <!-- Pagination -->
                @if($products->hasPages())
                    <div class="mt-12 pt-6 border-t border-[#EFE7DA]">
                        {{ $products->links() }}
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>
