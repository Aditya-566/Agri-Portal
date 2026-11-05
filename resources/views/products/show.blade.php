<x-app-layout>
    <!-- Ambient sunlight and organic light spots -->
    <div class="absolute top-20 left-10 w-80 h-80 blob-teal rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute bottom-40 right-20 w-96 h-96 blob-orange rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute top-40 right-1/4 w-80 h-80 blob-sky rounded-full blur-3xl pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 relative z-10">
        <!-- Toast Alerts -->
        @if(session('success'))
            <div class="mb-8 p-4.5 rounded-2xl bg-[#00B894]/10 text-[#00B894] text-xs font-black uppercase tracking-wider border border-[#00B894]/20 flex items-center gap-2.5 shadow-sm">
                <i data-lucide="check-circle" class="w-5 h-5 shrink-0"></i>
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="mb-8 p-4.5 rounded-2xl bg-[#C97B63]/10 text-[#C97B63] text-xs font-black uppercase tracking-wider border border-[#C97B63]/20 flex items-center gap-2.5 shadow-sm">
                <i data-lucide="alert-circle" class="w-5 h-5 shrink-0"></i>
                {{ session('error') }}
            </div>
        @endif

        <!-- Product Grid -->
        <div class="grid lg:grid-cols-12 gap-8 items-start">
            
            <!-- Left Panel: Gallery, Farmer, Supply Chain Timeline, Reviews -->
            <div class="lg:col-span-7 space-y-8">
                <!-- Image Wrapper -->
                <div class="relative overflow-hidden rounded-3xl bg-white/50 border border-[#EFE7DA] shadow-premium">
                    @if($product->is_organic)
                        <span class="absolute top-4 left-4 z-10 inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-xl text-[10px] font-black uppercase tracking-wider bg-[#00B894] text-white shadow-md shadow-[#00B894]/20">
                            <i data-lucide="leaf" class="w-4 h-4"></i> Organic Certified
                        </span>
                    @endif
                    
                    @if($product->image_path)
                        <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }}" class="w-full object-cover max-h-[440px] hover:scale-102 transition-transform duration-550" />
                    @else
                        <div class="w-full h-80 flex flex-col items-center justify-center text-slate-455 bg-gradient-to-br from-[#00B894]/5 to-[#FF9F1C]/5 p-6">
                            <i data-lucide="sprout" class="w-14 h-14 mb-4 text-[#00B894]/40"></i>
                            <span class="text-[10px] font-black uppercase tracking-widest">No photo uploaded by the farmer</span>
                        </div>
                    @endif
                </div>

                <!-- Farm-to-Market Supply Chain Timeline -->
                <div class="glass-premium p-6.5 rounded-3xl border border-white/50 shadow-premium">
                    <h3 class="font-heading font-black text-[#1E1E1E] text-base mb-6 uppercase tracking-wider">Farm-To-Market Supply Path</h3>
                    
                    <div class="relative">
                        <!-- Connecting Line -->
                        <div class="absolute left-4 top-2 bottom-2 w-0.5 bg-[#EFE7DA]"></div>
                        
                        <!-- Timeline Nodes -->
                        <div class="space-y-6">
                            <!-- Node 1 -->
                            <div class="flex gap-4 relative">
                                <div class="w-8 h-8 rounded-full bg-[#00B894] text-white flex items-center justify-center z-10 shrink-0 shadow-md shadow-[#00B894]/20 animate-float-slow">
                                    <i data-lucide="sprout" class="w-4 h-4"></i>
                                </div>
                                <div class="pt-0.5">
                                    <h4 class="text-xs font-black text-[#1E1E1E] uppercase tracking-wider">Harvested on Farm</h4>
                                    <p class="text-[11px] text-slate-500 font-semibold mt-1">Grown locally using natural agricultural practices, harvested on {{ $product->harvest_date ? $product->harvest_date->format('M d, Y') : 'recent weeks' }}.</p>
                                </div>
                            </div>
                            <!-- Node 2 -->
                            <div class="flex gap-4 relative">
                                <div class="w-8 h-8 rounded-full bg-[#00B894] text-white flex items-center justify-center z-10 shrink-0 shadow-md shadow-[#00B894]/20 animate-float-medium">
                                    <i data-lucide="clipboard-check" class="w-4 h-4"></i>
                                </div>
                                <div class="pt-0.5">
                                    <h4 class="text-xs font-black text-[#1E1E1E] uppercase tracking-wider">Quality Checked & Packaged</h4>
                                    <p class="text-[11px] text-slate-500 font-semibold mt-1">Manually inspected for purity, freshness, size, and sorted into environment-friendly packaging bags.</p>
                                </div>
                            </div>
                            <!-- Node 3 -->
                            <div class="flex gap-4 relative">
                                <div class="w-8 h-8 rounded-full bg-[#00B894] text-white flex items-center justify-center z-10 shrink-0 shadow-md shadow-[#00B894]/20 animate-float-fast">
                                    <i data-lucide="badge-check" class="w-4 h-4"></i>
                                </div>
                                <div class="pt-0.5">
                                    <h4 class="text-xs font-black text-[#1E1E1E] uppercase tracking-wider">Portal Verification & Listing</h4>
                                    <p class="text-[11px] text-slate-500 font-semibold mt-1">Listed under verified farmer account with direct regional pricing guidelines to ensure fair trade parameters.</p>
                                </div>
                            </div>
                            <!-- Node 4 -->
                            <div class="flex gap-4 relative">
                                <div class="w-8 h-8 rounded-full bg-[#FF9F1C] text-white flex items-center justify-center z-10 shrink-0 shadow-md shadow-[#FF9F1C]/20">
                                    <i data-lucide="truck" class="w-4 h-4"></i>
                                </div>
                                <div class="pt-0.5">
                                    <h4 class="text-xs font-black text-[#1E1E1E] uppercase tracking-wider">Transport & Direct Settlement Ready</h4>
                                    <p class="text-[11px] text-slate-500 font-semibold mt-1">Instantly dispatched directly from the farming site upon order settlement. Zero intermediate warehousing.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Farmer Card & Bio -->
                <div class="glass-premium p-6.5 rounded-3xl border border-white/50 shadow-premium space-y-5">
                    <h3 class="font-heading font-black text-[#1E1E1E] text-base uppercase tracking-wider">Farmer Specifications</h3>
                    
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 border-b border-[#EFE7DA] pb-4">
                        <div class="flex items-center gap-3.5">
                            <div class="w-12 h-12 rounded-full bg-gradient-to-br from-[#00B894]/20 to-[#FF9F1C]/25 text-[#00B894] flex items-center justify-center text-xl font-black border border-[#00B894]/10">
                                {{ substr($product->farmer->name, 0, 1) }}
                            </div>
                            <div>
                                <div class="font-heading font-black text-[#1E1E1E] flex items-center gap-1.5 text-sm">
                                    {{ $product->farmer->name }}
                                    @if($product->farmer->is_verified)
                                        <span class="text-[#FF9F1C]" title="Verified Gold Farmer Credentials">
                                            <i data-lucide="award" class="w-4.5 h-4.5 fill-[#FF9F1C]/10"></i>
                                        </span>
                                    @endif
                                </div>
                                <div class="text-[11px] font-semibold text-slate-400 flex items-center gap-1 mt-0.5">
                                    <i data-lucide="map-pin" class="w-3.5 h-3.5 text-[#C97B63]"></i> {{ $product->location }}
                                </div>
                            </div>
                        </div>

                        <!-- Direct Chat Trigger -->
                        @auth
                            @if(auth()->id() !== $product->farmer_id)
                                <a href="{{ route('chats.index', ['farmer_id' => $product->farmer_id]) }}" class="px-5 py-3 bg-[#00B894]/10 hover:bg-[#00B894] text-[#00B894] hover:text-white font-extrabold text-xs uppercase tracking-widest rounded-xl transition-all flex items-center justify-center gap-1.5 self-start sm:self-auto border border-[#00B894]/15 shadow-sm">
                                    <i data-lucide="message-square" class="w-4 h-4"></i> Chat with Farmer
                                </a>
                            @endif
                        @else
                            <a href="{{ route('login') }}" class="px-5 py-3 border border-slate-200 hover:border-[#00B894] hover:text-[#00B894] text-[#1E1E1E] font-extrabold text-xs uppercase tracking-widest rounded-xl flex items-center justify-center gap-1.5 self-start sm:self-auto shadow-sm transition-colors">
                                <i data-lucide="message-square" class="w-4 h-4"></i> Login to Chat
                            </a>
                        @endauth
                    </div>

                    <p class="text-xs text-slate-500 leading-relaxed font-semibold">
                        {{ $product->farmer->bio ?? 'A verified farmer dedicated to producing high-quality agricultural products on local land. Fully committed to transparent trading without intermediaries.' }}
                    </p>
                </div>

                <!-- Reviews Log -->
                <div class="glass-premium p-6.5 rounded-3xl border border-white/50 shadow-premium space-y-6">
                    <h3 class="font-heading font-black text-[#1E1E1E] text-base flex items-center gap-2 uppercase tracking-wider">
                        <i data-lucide="star" class="w-4.5 h-4.5 text-[#FF9F1C] fill-current animate-pulse"></i> 
                        Reviews & Ratings ({{ count($product->reviews) }})
                    </h3>

                    <div class="space-y-4">
                        @forelse($product->reviews as $review)
                            <div class="p-5 rounded-2xl bg-white/40 border border-[#EFE7DA]/60 hover:border-[#00B894]/20 transition-all space-y-2">
                                <div class="flex items-center justify-between gap-4">
                                    <div class="text-xs font-black text-[#1E1E1E]">
                                        {{ $review->buyer?->name ?? 'Anonymous Buyer' }}
                                    </div>
                                    <div class="flex items-center gap-0.5 text-[#FF9F1C]">
                                        @for($i = 1; $i <= 5; $i++)
                                            <i data-lucide="star" class="w-3.5 h-3.5 {{ $i <= $review->rating ? 'fill-current' : 'text-slate-200' }}"></i>
                                        @endfor
                                    </div>
                                </div>
                                <p class="text-xs text-slate-500 leading-relaxed font-semibold">
                                    {{ $review->comment }}
                                </p>
                            </div>
                        @empty
                            <div class="text-center py-10 text-slate-400 text-xs font-semibold">
                                No reviews posted for this crop yet.
                            </div>
                        @endforelse
                    </div>

                    <!-- Add Review Form (Only for buyers who are not the farmer) -->
                    @auth
                        @if(auth()->user()->isBuyer())
                            <form method="POST" action="{{ route('products.review', $product->id) }}" class="border-t border-[#EFE7DA] pt-6 space-y-5">
                                @csrf
                                <h4 class="font-heading font-black text-[#1E1E1E] text-sm uppercase tracking-wider">Submit Crop Review</h4>
                                
                                <div>
                                    <label class="block text-[9px] font-black text-slate-400 uppercase tracking-widest mb-2">Select Rating</label>
                                    <div class="flex items-center gap-1.5" x-data="{ rating: 5 }">
                                        <input type="hidden" name="rating" :value="rating" />
                                        @for($i = 1; $i <= 5; $i++)
                                            <button type="button" @click="rating = {{ $i }}" class="text-[#FF9F1C] focus:outline-none transition-transform hover:scale-115">
                                                <svg class="w-7 h-7" :class="rating >= {{ $i }} ? 'fill-current' : 'text-slate-200'" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                                            </button>
                                        @endfor
                                    </div>
                                    @error('rating') <span class="text-red-500 text-[10px]">{{ $message }}</span> @enderror
                                </div>

                                <div>
                                    <label for="comment" class="block text-[9px] font-black text-slate-400 uppercase tracking-widest mb-2">Review Comments</label>
                                    <textarea id="comment" name="comment" rows="3" class="block w-full px-4 py-3 bg-white/50 border border-[#EFE7DA] rounded-xl text-xs font-semibold focus:ring-2 focus:ring-[#00B894] focus:border-[#00B894] text-[#1E1E1E] placeholder-slate-400 shadow-sm" required placeholder="Describe crop quality, freshness, harvest parameters..."></textarea>
                                    @error('comment') <span class="text-red-500 text-[10px]">{{ $message }}</span> @enderror
                                </div>

                                <button type="submit" class="px-6 py-3.5 bg-[#00B894] hover:bg-[#02d4ab] text-white font-extrabold text-xs uppercase tracking-widest rounded-xl shadow-md transition-all">
                                    Submit Review
                                </button>
                            </form>
                        @endif
                    @else
                        <div class="p-5 rounded-2xl bg-white/40 border border-[#EFE7DA] text-center text-xs font-semibold text-slate-500">
                            Please <a href="{{ route('login') }}" class="font-black text-[#00B894] hover:underline">login</a> as a buyer to write a review.
                        </div>
                    @endauth
                </div>
            </div>

            <!-- Right Panel: Crop Info, Purchase Card, AI Advisor -->
            <div class="lg:col-span-5 space-y-8">
                <!-- Main details purchase card -->
                <div class="glass-premium p-6 rounded-3xl border border-white/50 shadow-premium space-y-6">
                    <div>
                        <span class="inline-flex items-center gap-1.5 text-[9px] font-black text-[#00B894] bg-[#00B894]/10 border border-[#00B894]/20 px-2.5 py-1 rounded-lg uppercase tracking-widest">
                            <i data-lucide="{{ $product->category?->icon ?? 'tag' }}" class="w-3.5 h-3.5"></i> {{ $product->category?->name ?? 'Agri Crop' }}
                        </span>
                        <h1 class="font-heading font-black text-2xl sm:text-3xl text-[#1E1E1E] mt-3">
                            {{ $product->name }}
                        </h1>
                    </div>

                    <!-- Price -->
                    <div class="flex items-baseline gap-1.5 bg-[#00B894]/5 p-5 rounded-2xl border border-[#00B894]/10">
                        <span class="text-3xl font-black text-[#1E1E1E]">₹{{ number_format($product->price, 2) }}</span>
                        <span class="text-xs font-semibold text-slate-500">/ per kg (Direct trade rate)</span>
                    </div>

                    <!-- Spec list grid -->
                    <div class="grid grid-cols-2 gap-4 text-xs">
                        <div class="p-4 bg-white/40 rounded-2xl border border-[#EFE7DA]">
                            <span class="text-slate-400 uppercase font-black tracking-widest text-[9px] block">Availability</span>
                            <span class="font-bold text-[#1E1E1E] mt-1.5 block capitalize">{{ $product->status }}</span>
                        </div>
                        <div class="p-4 bg-white/40 rounded-2xl border border-[#EFE7DA]">
                            <span class="text-slate-400 uppercase font-black tracking-widest text-[9px] block">Total Stock</span>
                            <span class="font-bold text-[#1E1E1E] mt-1.5 block">{{ $product->quantity }} kg available</span>
                        </div>
                        <div class="p-4 bg-white/40 rounded-2xl border border-[#EFE7DA]">
                            <span class="text-slate-400 uppercase font-black tracking-widest text-[9px] block">Harvest Location</span>
                            <span class="font-bold text-[#1E1E1E] mt-1.5 block truncate">{{ $product->location }}</span>
                        </div>
                        <div class="p-4 bg-white/40 rounded-2xl border border-[#EFE7DA]">
                            <span class="text-slate-400 uppercase font-black tracking-widest text-[9px] block">Harvest Date</span>
                            <span class="font-bold text-[#1E1E1E] mt-1.5 block">{{ $product->harvest_date ? $product->harvest_date->format('d M Y') : 'Freshly Harvested' }}</span>
                        </div>
                    </div>

                    <p class="text-xs text-slate-500 leading-relaxed font-semibold">
                        {{ $product->description }}
                    </p>

                    <!-- Purchase Actions -->
                    @auth
                        @if(auth()->user()->isBuyer())
                            @if($product->status === 'available')
                                <form method="POST" action="{{ route('cart.add') }}" class="border-t border-[#EFE7DA] pt-6 space-y-5">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    
                                    <div class="flex items-center gap-4">
                                        <div class="w-32" x-data="{ qty: 1, maxQty: {{ $product->quantity }} }">
                                            <label class="block text-[9px] font-black text-slate-400 uppercase tracking-widest mb-2">Quantity (kg)</label>
                                            <div class="flex items-center border border-[#EFE7DA] rounded-xl overflow-hidden bg-white/50">
                                                <button type="button" @click="if(qty > 1) qty--" class="px-3 py-2.5 text-slate-500 hover:bg-[#00B894]/10 focus:outline-none font-bold">&minus;</button>
                                                <input type="number" name="quantity" x-model="qty" :min="1" :max="maxQty" readonly class="w-full text-center border-none bg-transparent text-sm font-bold focus:outline-none text-[#1E1E1E]" />
                                                <button type="button" @click="if(qty < maxQty) qty++" class="px-3 py-2.5 text-slate-500 hover:bg-[#00B894]/10 focus:outline-none font-bold">&plus;</button>
                                            </div>
                                        </div>

                                        <div class="flex-grow pt-5">
                                            <button type="submit" class="w-full py-4 bg-[#00B894] hover:bg-[#02d4ab] text-white font-extrabold text-xs uppercase tracking-widest rounded-xl shadow-md hover:-translate-y-0.5 transition-all flex items-center justify-center gap-2">
                                                <i data-lucide="shopping-cart" class="w-4.5 h-4.5"></i> Add to Cart
                                            </button>
                                        </div>
                                    </div>
                                </form>

                                <form method="POST" action="{{ route('buyer.wishlist.toggle') }}" class="pt-2">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <button type="submit" class="w-full py-3.5 border border-[#EFE7DA] hover:border-rose-500 hover:text-rose-500 text-slate-650 font-bold text-xs rounded-xl transition-colors flex items-center justify-center gap-1.5 shadow-sm">
                                        <i data-lucide="heart" class="w-4 h-4 {{ auth()->user()->wishlist && in_array($product->id, auth()->user()->wishlist) ? 'fill-rose-500 text-rose-500' : '' }}"></i> 
                                        {{ auth()->user()->wishlist && in_array($product->id, auth()->user()->wishlist) ? 'Remove from Wishlist' : 'Add to Wishlist' }}
                                    </button>
                                </form>
                            @else
                                <div class="p-4.5 bg-[#C97B63]/10 text-[#C97B63] border border-[#C97B63]/20 rounded-2xl text-center font-black text-xs uppercase tracking-wider">
                                    This crop listing is currently sold out.
                                </div>
                            @endif
                        @else
                            <div class="p-4.5 bg-[#00B894]/5 border border-[#00B894]/10 rounded-2xl text-center text-xs font-bold text-slate-500">
                                This is your crop listing dashboard. You can edit it from your Farmer portal.
                            </div>
                        @endif
                    @else
                        <div class="border-t border-[#EFE7DA] pt-6 text-center">
                            <a href="{{ route('login') }}" class="w-full inline-block py-4 bg-[#00B894] hover:bg-[#02d4ab] text-white font-extrabold text-xs uppercase tracking-widest rounded-xl shadow-md hover:-translate-y-0.5 transition-all">
                                Login to Add to Cart
                            </a>
                        </div>
                    @endauth
                </div>

                <!-- AI Advisor Agronomic Insight -->
                <div class="p-6 bg-gradient-to-tr from-[#1E1E1E] to-[#4F6F52] text-white rounded-3xl border border-white/10 shadow-xl space-y-4.5 relative overflow-hidden">
                    <div class="absolute -top-10 -right-10 w-32 h-32 bg-[#00B894]/10 rounded-full blur-xl pointer-events-none"></div>
                    <div class="flex items-center gap-3 border-b border-white/10 pb-4 relative z-10">
                        <div class="w-8 h-8 rounded-lg bg-[#00B894]/20 text-[#00B894] flex items-center justify-center shrink-0">
                            <i data-lucide="cpu" class="w-4.5 h-4.5 animate-pulse"></i>
                        </div>
                        <div>
                            <h3 class="font-heading font-black text-sm uppercase tracking-wider">AI Agronomic Advisor</h3>
                            <p class="text-[9px] text-[#00B894] font-black uppercase tracking-wider">Dynamic Harvest Insights</p>
                        </div>
                    </div>

                    @php
                        // Dynamically mock specific agricultural advice based on the crop category
                        $catName = strtolower($product->category?->name ?? 'general');
                        $demand = 78;
                        $soil = 'Loamy & Sandy Silt';
                        $tips = 'Requires well-drained soil. Keep temperature around 15-24°C.';
                        if(str_contains($catName, 'grain') || str_contains($catName, 'rice') || str_contains($catName, 'wheat')) {
                            $demand = 92;
                            $soil = 'Clayey Loam / Rich Alluvial';
                            $tips = 'Optimal rainfall 100-150cm. Monitor for stem borer and rust pests during late stages.';
                        } elseif(str_contains($catName, 'fruit')) {
                            $demand = 85;
                            $soil = 'Deep Sandy Loam, pH 6.0-7.0';
                            $tips = 'Ensure proper canopy pruning. Sensitive to direct ground frost during blossoming.';
                        } elseif(str_contains($catName, 'vegetable') || str_contains($catName, 'tomato')) {
                            $demand = 89;
                            $soil = 'Sandy Loam with organic compost';
                            $tips = 'Avoid waterlogging to prevent root rot. Provide stake support for heavy foliage crops.';
                        }
                    @endphp

                    <div class="space-y-3.5 text-xs relative z-10">
                        <div class="flex items-center justify-between">
                            <span class="text-slate-350 font-medium">Market Demand Index:</span>
                            <span class="font-black text-[#00B894]">{{ $demand }}% (Very High)</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-slate-350 font-medium">Ideal Soil Compatibility:</span>
                            <span class="font-black truncate max-w-[180px] text-white">{{ $soil }}</span>
                        </div>
                        <div class="space-y-1.5">
                            <span class="text-slate-350 font-medium block">Cultivation Advisory:</span>
                            <p class="text-slate-200 leading-relaxed text-[11px] font-semibold">
                                {{ $tips }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- Related Products Section -->
        @if(count($relatedProducts) > 0)
            <div class="mt-20 border-t border-[#EFE7DA] pt-12 space-y-8">
                <h3 class="font-heading font-black text-2xl text-[#1E1E1E] uppercase tracking-wider text-center">Related Fresh Crops</h3>
                <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($relatedProducts as $related)
                        <x-product-card :product="$related" />
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</x-app-layout>
