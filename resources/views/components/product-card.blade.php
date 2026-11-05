@props(['product'])

@php
    $farmer = $product->farmer;
    $category = $product->category;
    $rating = $product->average_rating;
    $isBuyer = auth()->check() && auth()->user()->isBuyer();
@endphp

<div class="group relative flex flex-col overflow-hidden rounded-3xl glass-premium border border-white/50 shadow-premium shadow-premium-hover">
    <!-- Image Header -->
    <div class="relative aspect-video w-full overflow-hidden bg-slate-100">
        @if($product->is_organic)
            <span class="absolute top-3 left-3 z-10 inline-flex items-center gap-1 px-3 py-1 rounded-full text-[9px] font-black uppercase tracking-wider bg-[#00B894] text-white shadow-sm">
                <i data-lucide="leaf" class="w-3 h-3"></i> Organic
            </span>
        @endif
        
        <span class="absolute top-3 right-3 z-10 inline-flex items-center gap-1 px-3 py-1 rounded-full text-[9px] font-black uppercase tracking-wider {{ $product->status === 'available' ? 'bg-[#00B894]/10 text-[#00B894] border border-[#00B894]/20 backdrop-blur-sm' : 'bg-[#C97B63]/10 text-[#C97B63] border border-[#C97B63]/20 backdrop-blur-sm' }}">
            <span class="w-1.5 h-1.5 rounded-full {{ $product->status === 'available' ? 'bg-[#00B894]' : 'bg-[#C97B63]' }}"></span>
            {{ $product->status === 'available' ? 'In Stock' : 'Sold Out' }}
        </span>

        @if($product->image_path)
            <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }}" class="h-full w-full object-cover object-center group-hover:scale-105 transition-transform duration-500" />
        @else
            <div class="w-full h-full flex flex-col items-center justify-center text-slate-400 bg-gradient-to-br from-[#00B894]/5 to-[#FF9F1C]/5 p-4">
                <i data-lucide="sprout" class="w-8 h-8 mb-2 text-[#00B894]/60"></i>
                <span class="text-[9px] font-black uppercase tracking-wider">Fresh Harvest</span>
            </div>
        @endif
        
        <!-- Quick stats overlay -->
        <div class="absolute inset-x-0 bottom-0 bg-gradient-to-t from-slate-950/60 to-transparent p-3 pt-8 flex items-center justify-between text-white">
            <span class="text-[9px] font-extrabold uppercase tracking-wider bg-black/40 backdrop-blur-sm px-2.5 py-1 rounded-xl flex items-center gap-1 border border-white/5">
                <i data-lucide="calendar" class="w-3 h-3 text-[#FF9F1C]"></i> {{ $product->harvest_date ? $product->harvest_date->format('M Y') : 'Fresh' }}
            </span>
            <span class="text-[9px] font-extrabold uppercase tracking-wider bg-black/40 backdrop-blur-sm px-2.5 py-1 rounded-xl flex items-center gap-1 border border-white/5">
                <i data-lucide="scale" class="w-3 h-3 text-[#FF9F1C]"></i> {{ $product->quantity }} kg
            </span>
        </div>
    </div>

    <!-- Product Info Body -->
    <div class="flex flex-1 flex-col p-5">
        <!-- Category & Rating Row -->
        <div class="flex items-center justify-between gap-2 mb-2">
            <span class="inline-flex items-center gap-1 text-[9px] font-black text-[#4F6F52] uppercase tracking-wider">
                <i data-lucide="{{ $category?->icon ?? 'tag' }}" class="w-3 h-3"></i> {{ $category?->name ?? 'Agri Crop' }}
            </span>
            @if(count($product->reviews) > 0)
                <div class="flex items-center gap-1 text-[#FF9F1C] text-xs">
                    <i data-lucide="star" class="w-3.5 h-3.5 fill-current"></i>
                    <span class="font-black text-[#1E1E1E]">{{ number_format($rating, 1) }}</span>
                </div>
            @endif
        </div>

        <!-- Title -->
        <h3 class="font-heading font-black text-base text-[#1E1E1E] line-clamp-1 mb-2 hover:text-[#00B894] transition-colors">
            <a href="{{ route('products.show', $product->id) }}">{{ $product->name }}</a>
        </h3>

        <!-- Farmer Profile Row -->
        @if($farmer)
            <div class="flex items-center gap-2.5 mb-3.5">
                <div class="w-7 h-7 rounded-full bg-gradient-to-br from-[#00B894]/15 to-[#FF9F1C]/15 text-[#00B894] flex items-center justify-center text-[10px] font-black border border-[#00B894]/10">
                    {{ substr($farmer->name, 0, 1) }}
                </div>
                <div class="flex flex-col min-w-0">
                    <span class="text-[11px] font-black text-[#1E1E1E] truncate flex items-center gap-1 leading-none">
                        {{ $farmer->name }}
                        @if($farmer->is_verified)
                            <span class="text-[#FF9F1C]" title="Verified Gold Farmer">
                                <i data-lucide="award" class="w-3.5 h-3.5 fill-[#FF9F1C]/10"></i>
                            </span>
                        @endif
                    </span>
                    <span class="text-[9px] text-slate-455 truncate flex items-center gap-0.5 mt-0.5 leading-none">
                        <i data-lucide="map-pin" class="w-2.5 h-2.5 text-[#C97B63]"></i> {{ $product->location }}
                    </span>
                </div>
            </div>
        @endif

        <p class="text-xs text-slate-500 line-clamp-2 mb-4 leading-relaxed font-medium">
            {{ $product->description }}
        </p>

        <!-- Price & Action Footer -->
        <div class="mt-auto pt-4 border-t border-slate-100 flex items-center justify-between">
            <div class="flex flex-col">
                <span class="text-[9px] font-black uppercase tracking-wider text-slate-400 leading-none">Direct Price</span>
                <span class="text-base font-black text-[#1E1E1E] mt-1 leading-none">
                    ₹{{ number_format($product->price, 2) }} <span class="text-[10px] font-semibold text-slate-400">/ kg</span>
                </span>
            </div>

            <div class="flex items-center gap-1.5">
                @if($isBuyer && $product->status === 'available')
                    <!-- Add to Cart Quick Action -->
                    <form method="POST" action="{{ route('cart.add') }}" class="inline-block">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <input type="hidden" name="quantity" value="1">
                        <button type="submit" class="p-2.5 bg-[#00B894] hover:bg-[#02d4ab] text-white rounded-xl shadow-sm transition-all hover:scale-105" title="Add to Cart">
                            <i data-lucide="shopping-cart" class="w-4 h-4"></i>
                        </button>
                    </form>
                    
                    <!-- Wishlist Toggle -->
                    <form method="POST" action="{{ route('buyer.wishlist.toggle') }}" class="inline-block">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <button type="submit" class="p-2.5 border border-slate-100 text-slate-500 hover:text-rose-500 hover:border-rose-500/30 rounded-xl transition-all" title="Toggle Wishlist">
                            <i data-lucide="heart" class="w-4 h-4 {{ auth()->user()->wishlist && in_array($product->id, auth()->user()->wishlist) ? 'fill-rose-500 text-rose-500' : '' }}"></i>
                        </button>
                    </form>
                @else
                    <a href="{{ route('products.show', $product->id) }}" class="flex items-center gap-1 px-3 py-2 bg-[#00B894]/10 text-[#00B894] hover:bg-[#00B894] hover:text-white text-[10px] font-black uppercase tracking-wider rounded-xl transition-all">
                        Details <i data-lucide="chevron-right" class="w-3.5 h-3.5"></i>
                    </a>
                @endif
            </div>
        </div>
    </div>
</div>
