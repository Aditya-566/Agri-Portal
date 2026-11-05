<x-app-layout>
    <!-- Ambient organic glowing light spots -->
    <div class="absolute top-20 left-10 w-80 h-80 blob-teal rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute bottom-40 right-20 w-96 h-96 blob-orange rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute inset-0 sunlight-ray opacity-40 pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 relative z-10">
        <!-- Dashboard Header -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 mb-10">
            <div>
                <span class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-xl text-xs font-black uppercase tracking-wider bg-primary/10 text-primary border border-primary/20 shadow-sm">
                    <i data-lucide="shopping-bag" class="w-3.5 h-3.5 text-primary"></i> Direct Sourcing Hub
                </span>
                <h1 class="font-heading font-black text-3xl text-charcoal mt-3 flex items-center gap-2">
                    Welcome back, {{ Auth::user()->name }}
                </h1>
                <p class="text-xs text-charcoal/70 mt-1">Source high-quality organic crops directly from Indian farmers, monitor direct supply lines, and manage settlements.</p>
            </div>
            
            <a href="{{ route('products.index') }}" class="px-5 py-3 bg-primary hover:opacity-95 text-white font-black text-xs uppercase tracking-wider rounded-2xl shadow-premium transition-all flex items-center justify-center gap-2 hover:-translate-y-0.5">
                <i data-lucide="search" class="w-4 h-4"></i> Browse Crops Catalog
            </a>
        </div>

        @if(session('success'))
            <div class="mb-8 p-4.5 rounded-2xl bg-primary/5 text-primary text-xs font-semibold border border-primary/15 flex items-center gap-2.5 shadow-sm">
                <i data-lucide="check-circle" class="w-5 h-5 shrink-0 text-primary"></i>
                {{ session('success') }}
            </div>
        @endif

        <!-- Buyer Dashboard Stats -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-8">
            <!-- Orders Placed Card -->
            <div class="glass-teal p-6 rounded-3xl border border-primary/20 shadow-premium flex items-center gap-5 hover:scale-[1.02] transition-all duration-300">
                <div class="p-3.5 bg-primary/15 text-primary rounded-2xl shrink-0">
                    <i data-lucide="file-text" class="w-6 h-6"></i>
                </div>
                <div>
                    <span class="text-[10px] uppercase font-black text-charcoal/50 tracking-wider block">Orders Placed</span>
                    <span class="text-2xl font-black text-charcoal mt-1 block">{{ $ordersCount }} direct orders</span>
                </div>
            </div>

            <!-- Shopping Cart Card -->
            <a href="{{ route('cart.index') }}" class="glass-premium p-6 rounded-3xl border border-white/50 shadow-premium flex items-center gap-5 hover:scale-[1.02] hover:border-primary/30 transition-all duration-300 group">
                <div class="p-3.5 bg-primary/15 text-primary rounded-2xl shrink-0 group-hover:scale-110 transition-transform">
                    <i data-lucide="shopping-cart" class="w-6 h-6"></i>
                </div>
                <div class="flex-grow">
                    <span class="text-[10px] uppercase font-black text-charcoal/50 tracking-wider block">Shopping Cart</span>
                    <span class="text-2xl font-black text-charcoal mt-1 block flex items-center justify-between">
                        {{ $cartCount }} items
                        <i data-lucide="chevron-right" class="w-4 h-4 text-primary opacity-0 group-hover:opacity-100 group-hover:translate-x-1 transition-all"></i>
                    </span>
                </div>
            </a>

            <!-- Wishlist Card -->
            <a href="{{ route('buyer.wishlist') }}" class="glass-premium p-6 rounded-3xl border border-white/50 shadow-premium flex items-center gap-5 hover:scale-[1.02] hover:border-secondary/30 transition-all duration-300 group">
                <div class="p-3.5 bg-secondary/15 text-secondary rounded-2xl shrink-0 group-hover:scale-110 transition-transform">
                    <i data-lucide="heart" class="w-6 h-6"></i>
                </div>
                <div class="flex-grow">
                    <span class="text-[10px] uppercase font-black text-charcoal/50 tracking-wider block">My Saved Crops</span>
                    <span class="text-2xl font-black text-charcoal mt-1 block flex items-center justify-between">
                        {{ $wishlistCount }} varieties
                        <i data-lucide="chevron-right" class="w-4 h-4 text-secondary opacity-0 group-hover:opacity-100 group-hover:translate-x-1 transition-all"></i>
                    </span>
                </div>
            </a>
        </div>

        <!-- Quick navigation links -->
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mb-8">
            <a href="{{ route('market-prices.index') }}" class="p-5 rounded-3xl glass-premium border border-white/40 hover:border-primary/50 hover:bg-white shadow-premium-hover flex flex-col items-center justify-center text-center transition-all group">
                <div class="w-10 h-10 rounded-xl bg-primary/10 text-primary flex items-center justify-center mb-3 group-hover:scale-115 transition-transform">
                    <i data-lucide="line-chart" class="w-5 h-5"></i>
                </div>
                <span class="text-xs font-black text-charcoal uppercase tracking-wider">APMC Market Index</span>
            </a>
            <a href="{{ route('weather.index') }}" class="p-5 rounded-3xl glass-premium border border-white/40 hover:border-primary/50 hover:bg-white shadow-premium-hover flex flex-col items-center justify-center text-center transition-all group">
                <div class="w-10 h-10 rounded-xl bg-secondary/10 text-secondary flex items-center justify-center mb-3 group-hover:scale-115 transition-transform">
                    <i data-lucide="cloud-sun" class="w-5 h-5"></i>
                </div>
                <span class="text-xs font-black text-charcoal uppercase tracking-wider">Agri Weather Radar</span>
            </a>
            <a href="{{ route('chats.index') }}" class="p-5 rounded-3xl glass-premium border border-white/40 hover:border-primary/50 hover:bg-white shadow-premium-hover flex flex-col items-center justify-center text-center transition-all group">
                <div class="w-10 h-10 rounded-xl bg-blue-500/10 text-blue-600 flex items-center justify-center mb-3 group-hover:scale-115 transition-transform">
                    <i data-lucide="message-square" class="w-5 h-5"></i>
                </div>
                <span class="text-xs font-black text-charcoal uppercase tracking-wider">Direct Chat Inbox</span>
            </a>
            <a href="{{ route('ai-recommendations.index') }}" class="p-5 rounded-3xl glass-premium border border-white/40 hover:border-primary/50 hover:bg-white shadow-premium-hover flex flex-col items-center justify-center text-center transition-all group">
                <div class="w-10 h-10 rounded-xl bg-primary/10 text-primary flex items-center justify-center mb-3 group-hover:scale-115 transition-transform">
                    <i data-lucide="cpu" class="w-5 h-5"></i>
                </div>
                <span class="text-xs font-black text-charcoal uppercase tracking-wider">AI Sourcing Advisor</span>
            </a>
        </div>

        <div class="grid lg:grid-cols-3 gap-8">
            <!-- Left 2 Cols: Recent purchases & Sourcing Map -->
            <div class="lg:col-span-2 space-y-8">
                <!-- Recent Direct Purchases -->
                <div class="glass-premium p-6 rounded-3xl border border-white/50 shadow-premium">
                    <div class="flex items-center justify-between border-b border-primary/10 pb-4 mb-4">
                        <div>
                            <h3 class="font-heading font-black text-charcoal text-lg">Recent Direct Sourcing</h3>
                            <p class="text-[10px] text-charcoal/50 mt-0.5">Your peer-to-peer settlement logs with local growers.</p>
                        </div>
                        <a href="{{ route('orders.index') }}" class="inline-flex items-center gap-1 text-xs font-black text-primary hover:underline uppercase tracking-wider">
                            View All Orders <i data-lucide="chevron-right" class="w-3.5 h-3.5"></i>
                        </a>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-xs border-collapse">
                            <thead>
                                <tr class="border-b border-primary/10 text-charcoal/40 font-black uppercase tracking-wider text-[10px]">
                                    <th class="py-3.5 px-4">Order ID</th>
                                    <th class="py-3.5 px-4">Seller/Farmer</th>
                                    <th class="py-3.5 px-4">Items Summary</th>
                                    <th class="py-3.5 px-4">Total Amount</th>
                                    <th class="py-3.5 px-4">Status</th>
                                    <th class="py-3.5 px-4">Date</th>
                                    <th class="py-3.5 px-4 text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-primary/5 font-medium text-charcoal/80">
                                @forelse($recentOrders as $order)
                                    <tr class="hover:bg-primary/5 transition-colors">
                                        <td class="py-3.5 px-4 font-mono font-bold text-primary">#{{ substr($order->id, -6) }}</td>
                                        <td class="py-3.5 px-4">
                                            <span class="font-bold text-charcoal block">{{ $order->farmer?->name ?? 'Direct Farmer' }}</span>
                                            <span class="text-[9px] text-charcoal/50 flex items-center gap-0.5 mt-0.5">
                                                <i data-lucide="map-pin" class="w-2.5 h-2.5 text-charcoal/60"></i> {{ $order->farmer?->location ?? 'India' }}
                                            </span>
                                        </td>
                                        <td class="py-3.5 px-4">
                                            @php
                                                $itemsText = collect($order->items)->map(fn($item) => $item['name'] . ' (' . $item['quantity'] . 'kg)')->join(', ');
                                            @endphp
                                            <span class="truncate max-w-[150px] block font-semibold" title="{{ $itemsText }}">
                                                {{ $itemsText }}
                                            </span>
                                        </td>
                                        <td class="py-3.5 px-4 font-bold text-charcoal">₹{{ number_format($order->total_amount, 2) }}</td>
                                        <td class="py-3.5 px-4">
                                            <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-xl text-[9px] font-black uppercase tracking-wider {{ $order->status === 'completed' ? 'bg-primary/10 text-primary border border-primary/20' : ($order->status === 'pending' ? 'bg-secondary/10 text-secondary border border-secondary/20' : ($order->status === 'accepted' ? 'bg-blue-500/10 text-blue-700 border border-blue-500/20' : 'bg-slate-500/10 text-slate-650 border border-slate-500/20')) }}">
                                                <span class="w-1.5 h-1.5 rounded-full {{ $order->status === 'completed' ? 'bg-primary' : ($order->status === 'pending' ? 'bg-secondary' : ($order->status === 'accepted' ? 'bg-blue-550' : 'bg-slate-400')) }}"></span>
                                                {{ $order->status }}
                                            </span>
                                        </td>
                                        <td class="py-3.5 px-4 text-charcoal/60">{{ $order->created_at->format('M d, Y') }}</td>
                                        <td class="py-3.5 px-4 text-right">
                                            <a href="{{ route('orders.show', $order->id) }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-primary/10 text-primary hover:bg-primary hover:text-white font-bold rounded-xl transition-all shadow-sm">
                                                Details
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="py-12 text-center text-charcoal/40">
                                            <div class="mb-3 text-primary/40"><i data-lucide="receipt-text" class="w-10 h-10 mx-auto"></i></div>
                                            You haven't placed any direct orders yet.
                                            <a href="{{ route('products.index') }}" class="text-primary font-bold hover:underline block mt-1">Start sourcing crops &rarr;</a>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- India Sourcing Map Mockup Widget -->
                <div class="glass-premium p-6 rounded-3xl border border-white/50 shadow-premium">
                    <div class="flex items-center justify-between border-b border-primary/10 pb-4 mb-6">
                        <div>
                            <h3 class="font-heading font-black text-charcoal text-base">Live Sourcing Network</h3>
                            <p class="text-[10px] text-charcoal/50 mt-0.5">Real-time peer-to-peer shipments and price indices across Indian agricultural zones.</p>
                        </div>
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[9px] font-black uppercase bg-secondary/15 text-secondary border border-secondary/20">
                            <span class="w-1.5 h-1.5 rounded-full bg-secondary animate-pulse"></span> LIVE FEED
                        </span>
                    </div>

                    <div class="grid md:grid-cols-3 gap-6 items-center">
                        <!-- Simulated Sourcing SVG Map -->
                        <div class="md:col-span-2 relative bg-primary/5 rounded-2xl p-4 border border-primary/10 flex items-center justify-center min-h-[250px] overflow-hidden">
                            <!-- Grid Overlay Background -->
                            <div class="absolute inset-0 bg-[radial-gradient(#00b894_1px,transparent_1px)] [background-size:16px_16px] opacity-10 rounded-2xl"></div>
                            
                            <svg class="w-full max-w-[280px] h-[240px] text-primary/30" viewBox="0 0 200 240" fill="none" stroke="currentColor" stroke-width="1.5">
                                <!-- Abstract India Coastline / Boundaries -->
                                <path d="M70,20 L100,10 L130,25 L140,55 L160,80 L180,95 L170,110 L150,115 L140,135 L120,150 L110,180 L100,210 L95,230 L80,210 L70,180 L55,160 L45,140 L35,120 L25,100 L40,80 L55,50 Z" />
                                
                                <!-- Sourcing Connections / Animated Paths -->
                                <g class="text-primary" stroke-width="1" stroke-dasharray="3,3">
                                    <!-- Punjab/Haryana to Mumbai -->
                                    <path d="M70,40 Q60,95 62,130" class="animate-dash" />
                                    <!-- Maharashtra to Bangalore -->
                                    <path d="M62,130 Q75,155 85,180" />
                                    <!-- Andhra/Telangana to Chennai -->
                                    <path d="M98,150 Q92,175 92,192" />
                                    <!-- West Bengal to Delhi -->
                                    <path d="M140,95 Q105,75 80,45" />
                                </g>

                                <!-- Pulse nodes for cities/farms -->
                                <g class="text-primary fill-primary">
                                    <!-- Delhi Node -->
                                    <circle cx="80" cy="45" r="3" />
                                    <circle cx="80" cy="45" r="6" class="animate-ping text-primary opacity-60" fill="none" stroke="currentColor" stroke-width="1" />
                                    
                                    <!-- Punjab/Haryana Node (Wheat) -->
                                    <circle cx="70" cy="40" r="3" class="text-secondary fill-secondary" />
                                    
                                    <!-- Mumbai Node -->
                                    <circle cx="62" cy="130" r="3" />
                                    
                                    <!-- Bangalore Node -->
                                    <circle cx="85" cy="180" r="3" />
                                    <circle cx="85" cy="180" r="7" class="animate-ping text-primary opacity-50" fill="none" stroke="currentColor" stroke-width="1" />

                                    <!-- Chennai Node -->
                                    <circle cx="92" cy="192" r="3" />

                                    <!-- West Bengal Node (Rice) -->
                                    <circle cx="140" cy="95" r="3" class="text-secondary fill-secondary" />
                                </g>
                            </svg>

                            <!-- Sourcing Tags floating -->
                            <div class="absolute top-6 left-6 px-2.5 py-1 glass border border-white/40 rounded-lg text-[9px] font-black text-charcoal">
                                Punjab: Wheat Sourced 🌾
                            </div>
                            <div class="absolute bottom-16 right-6 px-2.5 py-1 glass border border-white/40 rounded-lg text-[9px] font-black text-charcoal">
                                AP: Red Chili Dispatched 🌶️
                            </div>
                        </div>

                        <!-- Side legend / Live feed updates -->
                        <div class="space-y-4 text-xs">
                            <h4 class="font-bold text-charcoal uppercase tracking-wider text-[10px]">Supply Milestones</h4>
                            
                            <div class="space-y-3">
                                <div class="flex gap-2.5 items-start">
                                    <div class="w-1.5 h-1.5 rounded-full bg-primary mt-1.5 shrink-0"></div>
                                    <div>
                                        <span class="font-bold text-charcoal block text-[11px]">Direct Transit</span>
                                        <span class="text-[9px] text-charcoal/50 block mt-0.5">500kg Basmati Rice from Punjab to Mumbai Hub.</span>
                                    </div>
                                </div>
                                <div class="flex gap-2.5 items-start">
                                    <div class="w-1.5 h-1.5 rounded-full bg-secondary mt-1.5 shrink-0"></div>
                                    <div>
                                        <span class="font-bold text-charcoal block text-[11px]">Quality Checked</span>
                                        <span class="text-[9px] text-charcoal/50 block mt-0.5">Organic Turmeric verified at Sangli, MH.</span>
                                    </div>
                                </div>
                                <div class="flex gap-2.5 items-start">
                                    <div class="w-1.5 h-1.5 rounded-full bg-clay mt-1.5 shrink-0"></div>
                                    <div>
                                        <span class="font-bold text-charcoal block text-[11px]">Payment Disbursed</span>
                                        <span class="text-[9px] text-charcoal/50 block mt-0.5">₹42,500 settled directly to farmer Ramesh K.</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right 1 Col: Wishlist preview & Sourcing Alerts -->
            <div class="space-y-8">
                <!-- Wishlist Crops Preview -->
                <div class="glass-premium p-6 rounded-3xl border border-white/50 shadow-premium">
                    <div class="flex items-center justify-between border-b border-primary/10 pb-4 mb-4">
                        <div>
                            <h3 class="font-heading font-black text-charcoal text-base">Saved Crops</h3>
                            <p class="text-[10px] text-charcoal/50 mt-0.5">Monitor price changes for your bookmarked items.</p>
                        </div>
                        <a href="{{ route('buyer.wishlist') }}" class="text-xs font-black text-primary hover:underline uppercase tracking-wider">
                            All
                        </a>
                    </div>

                    <div class="space-y-4.5">
                        @forelse($wishlistProducts as $product)
                            <div class="flex items-center gap-3 bg-white/40 p-3.5 rounded-2xl border border-primary/5 hover:border-primary/20 hover:bg-white transition-all duration-300">
                                <div class="w-12 h-12 rounded-xl overflow-hidden shrink-0 bg-cream border border-primary/10">
                                    @if($product->image_path)
                                        <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }}" class="w-full h-full object-cover" />
                                    @else
                                        <div class="w-full h-full flex items-center justify-center text-primary/40">
                                            <i data-lucide="sprout" class="w-5 h-5 text-primary"></i>
                                        </div>
                                    @endif
                                </div>
                                <div class="flex-grow min-w-0">
                                    <h4 class="font-black text-charcoal text-xs truncate">
                                        <a href="{{ route('products.show', $product->id) }}" class="hover:text-primary transition-colors">{{ $product->name }}</a>
                                    </h4>
                                    <span class="text-[10px] font-black text-primary block mt-1">₹{{ number_format($product->price, 2) }} / kg</span>
                                </div>
                                <div class="shrink-0 flex items-center gap-1.5">
                                    @if($product->status === 'available')
                                        <form method="POST" action="{{ route('cart.add') }}" class="inline-block">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                                            <input type="hidden" name="quantity" value="1">
                                            <button type="submit" class="p-2.5 bg-primary hover:opacity-90 text-white rounded-xl transition-all shadow-premium" title="Add to Cart">
                                                <i data-lucide="shopping-cart" class="w-3.5 h-3.5"></i>
                                            </button>
                                        </form>
                                    @else
                                        <span class="px-2 py-1 bg-cream text-charcoal/50 text-[9px] font-black rounded-lg uppercase border border-primary/10">Sold Out</span>
                                    @endif
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-8 text-charcoal/40 text-xs">
                                <div class="mb-3 text-secondary/40"><i data-lucide="heart" class="w-8 h-8 mx-auto animate-pulse"></i></div>
                                Wishlist is empty. 
                            </div>
                        @endforelse
                    </div>
                </div>

                <!-- Seasonal Sourcing Recommender -->
                <div class="glass-premium p-6 rounded-3xl border border-white/50 shadow-premium space-y-4">
                    <div class="flex items-center gap-2.5 border-b border-primary/10 pb-3">
                        <div class="w-8 h-8 rounded-lg bg-primary/10 text-primary flex items-center justify-center">
                            <i data-lucide="sparkles" class="w-4 h-4"></i>
                        </div>
                        <div>
                            <h3 class="font-heading font-black text-charcoal text-xs uppercase tracking-wider">Seasonal Sourcing</h3>
                            <p class="text-[9px] text-charcoal/50">Recommended Indian crops this month</p>
                        </div>
                    </div>

                    <div class="space-y-3.5 text-xs text-charcoal/80">
                        <p class="leading-relaxed">Based on current harvest logs, the following produce categories are seeing high volume and competitive direct pricing:</p>
                        
                        <div class="space-y-2">
                            <div class="flex items-center justify-between p-2.5 rounded-xl bg-primary/5 border border-primary/10">
                                <span class="font-black text-charcoal">Basmati Rice (Kharif)</span>
                                <span class="px-2 py-0.5 rounded-lg bg-primary/15 text-primary text-[9px] font-black uppercase">Punjab Hub</span>
                            </div>
                            <div class="flex items-center justify-between p-2.5 rounded-xl bg-secondary/5 border border-secondary/10">
                                <span class="font-black text-charcoal">Alphonso Mangoes (Spring)</span>
                                <span class="px-2 py-0.5 rounded-lg bg-secondary/15 text-secondary text-[9px] font-black uppercase font-bold">Konkan Belt</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
