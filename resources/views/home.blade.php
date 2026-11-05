<x-app-layout>
    <!-- Weather Alerts Banner -->
    @if(count($weatherAlerts) > 0)
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-28">
            <div class="glass border-l-4 border-[#FF9F1C] text-[#1E1E1E] p-5 rounded-3xl shadow-premium flex flex-col sm:flex-row items-center justify-between gap-4 relative overflow-hidden">
                <div class="absolute inset-0 bg-[#FF9F1C]/5 pointer-events-none"></div>
                <div class="flex items-center gap-4 relative z-10">
                    <span class="p-3 rounded-2xl bg-[#FF9F1C]/10 text-[#FF9F1C] flex items-center justify-center animate-bounce">
                        <i data-lucide="cloud-lightning" class="w-6 h-6"></i>
                    </span>
                    <div>
                        <h4 class="font-heading font-black text-sm text-[#1E1E1E]">Agricultural Advisory Alert</h4>
                        <p class="text-xs text-slate-500 font-medium mt-1">
                            {{ implode(' | ', $weatherAlerts->pluck('message')->toArray()) }}
                        </p>
                    </div>
                </div>
                <a href="{{ route('weather.index') }}" class="px-5 py-3 text-xs font-black uppercase tracking-wider bg-[#FF9F1C] hover:bg-[#e08913] text-white rounded-xl shadow-sm hover:shadow transition-all whitespace-nowrap relative z-10">
                    View Climate Advisory &rarr;
                </a>
            </div>
        </div>
    @endif

    <!-- Hero Section -->
    <section class="relative pt-32 pb-16 overflow-hidden z-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid lg:grid-cols-12 gap-16 items-center">
                <!-- Hero Left: Branding & Core Call to Actions -->
                <div class="lg:col-span-7 text-center lg:text-left space-y-8">
                    <span class="inline-flex items-center gap-2 px-4.5 py-2.5 rounded-full text-[10px] font-black uppercase tracking-wider bg-[#00B894]/10 text-[#00B894] border border-[#00B894]/15 shadow-sm">
                        <span class="flex h-2 w-2 relative">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-[#00B894] opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2 w-2 bg-[#00B894]"></span>
                        </span>
                        Indian Farmer First • 0% Middlemen Fees
                    </span>
                    
                    <h1 class="font-heading font-black text-4xl sm:text-5xl lg:text-6.5xl text-[#1E1E1E] leading-[1.1] tracking-tight">
                        The Future of <span class="bg-gradient-to-r from-[#00B894] to-[#4F6F52] bg-clip-text text-transparent">AgriTech Marketplace</span> is here.
                    </h1>
                    
                    <p class="text-slate-500 text-sm sm:text-base max-w-xl mx-auto lg:mx-0 leading-relaxed font-medium">
                        Welcome to Agri-Portal, a next-generation smart ecosystem where Indian growers list organic crops directly at honest prices, powered by real-time AI crop advisory and predictive weather forecasts.
                    </p>
                    
                    <!-- Premium Glass Search Widget -->
                    <div class="max-w-lg mx-auto lg:mx-0">
                        <form action="{{ route('products.index') }}" method="GET" class="glass-premium rounded-2xl p-2.5 flex items-center shadow-premium border border-white/50">
                            <div class="flex items-center flex-grow px-3">
                                <i data-lucide="search" class="w-5 h-5 text-[#00B894]"></i>
                                <input type="text" name="search" placeholder="Search fresh potatoes, organic basmati, onions..." class="w-full bg-transparent border-0 focus:ring-0 focus:outline-none text-xs font-semibold text-[#1E1E1E] placeholder-slate-400 ml-2.5" />
                            </div>
                            <button type="submit" class="px-6 py-3.5 bg-[#00B894] hover:bg-[#02d4ab] text-white font-extrabold text-[10px] uppercase tracking-widest rounded-xl shadow-md transition-all whitespace-nowrap">
                                Find Harvests
                            </button>
                        </form>
                    </div>

                    <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4 pt-2">
                        <a href="{{ route('products.index') }}" class="w-full sm:w-auto text-center px-8 py-4 bg-gradient-to-r from-[#00B894] to-[#02d4ab] hover:from-[#02d4ab] hover:to-[#00B894] text-white font-extrabold text-xs uppercase tracking-widest rounded-xl shadow-lg hover:-translate-y-0.5 transition-all flex items-center justify-center gap-2">
                            <i data-lucide="shopping-bag" class="w-4 h-4"></i> Browse Marketplace
                        </a>
                        <a href="{{ route('register') }}" class="w-full sm:w-auto text-center px-8 py-4 border border-slate-200 text-[#1E1E1E] hover:text-[#00B894] font-extrabold text-xs uppercase tracking-widest rounded-xl bg-white/40 backdrop-blur-sm hover:bg-white hover:-translate-y-0.5 transition-all flex items-center justify-center gap-2">
                            <i data-lucide="user-plus" class="w-4 h-4 text-[#FF9F1C]"></i> Register to Sell
                        </a>
                    </div>
                </div>

                <!-- Hero Right: Immersive Startup Dashboard Interface Previews -->
                <div class="lg:col-span-5 relative flex justify-center">
                    <!-- Sunlight Glow Backdrop -->
                    <div class="absolute inset-0 bg-[#FFF3D6] blur-[100px] rounded-full opacity-60 pointer-events-none"></div>
                    <div class="absolute -top-12 -left-12 w-64 h-64 bg-[#D6F0FF] blur-[80px] rounded-full opacity-40 pointer-events-none"></div>

                    <!-- Complex Floating Widget Stack -->
                    <div class="relative w-full max-w-md space-y-6">
                        
                        <!-- Widget 1: Soil Intelligence Chart -->
                        <div class="glass-premium rounded-3xl p-5 border border-white/50 shadow-premium animate-float-slow transition-transform hover:scale-102">
                            <div class="flex items-center justify-between mb-4">
                                <div class="flex items-center gap-2">
                                    <span class="p-2 rounded-xl bg-[#00B894]/10 text-[#00B894]">
                                        <i data-lucide="leaf" class="w-4 h-4"></i>
                                    </span>
                                    <h4 class="font-heading font-black text-xs text-[#1E1E1E]">Soil Health Index</h4>
                                </div>
                                <span class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Zone A-2</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <div class="space-y-1">
                                    <div class="text-2xl font-black text-[#1E1E1E]">94.2%</div>
                                    <div class="text-[9px] text-[#00B894] font-bold uppercase tracking-wider flex items-center gap-1">
                                        <i data-lucide="sparkles" class="w-3 h-3 text-[#FF9F1C]"></i> Optimal Moisture
                                    </div>
                                </div>
                                <!-- Micro Radial Progress Chart -->
                                <div class="relative w-12 h-12">
                                    <svg class="w-full h-full transform -rotate-90" viewBox="0 0 36 36">
                                        <path class="text-slate-100" stroke-width="3" stroke="currentColor" fill="none" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" />
                                        <path class="text-[#00B894]" stroke-dasharray="94, 100" stroke-width="3.5" stroke-linecap="round" stroke="currentColor" fill="none" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" />
                                    </svg>
                                    <div class="absolute inset-0 flex items-center justify-center text-[9px] font-black">94%</div>
                                </div>
                            </div>
                        </div>

                        <!-- Widget 2: Climate Intelligence Advisory -->
                        <div class="glass-premium rounded-3xl p-5 border border-white/50 shadow-premium animate-float-medium transition-transform hover:scale-102" style="animation-delay: 1.5s">
                            <div class="flex items-center justify-between pb-3 border-b border-slate-100 mb-3.5">
                                <div class="flex items-center gap-2">
                                    <span class="p-2 rounded-xl bg-[#FF9F1C]/10 text-[#FF9F1C]">
                                        <i data-lucide="cloud-sun" class="w-4 h-4 animate-sway"></i>
                                    </span>
                                    <div>
                                        <h4 class="font-heading font-black text-xs text-[#1E1E1E]">Weather Intelligence</h4>
                                        <p class="text-[9px] font-bold text-slate-400 uppercase tracking-widest mt-0.5">APMC Price Warning</p>
                                    </div>
                                </div>
                                <span class="px-2 py-1 bg-[#FF9F1C]/10 text-[#FF9F1C] text-[8px] font-black rounded-lg uppercase tracking-wider">Alert</span>
                            </div>
                            <p class="text-[10px] text-slate-500 font-medium leading-relaxed">
                                Monsoon arrival forecast: expect <span class="text-[#FF9F1C] font-extrabold">₹5/kg increase</span> in tomato values due to transport delays.
                            </p>
                        </div>

                        <!-- Widget 3: Live APMC Market Prices Tracker -->
                        <div class="glass rounded-3xl p-5 border border-white/30 shadow-premium animate-float-fast transition-transform hover:scale-102" style="animation-delay: 3s">
                            <div class="flex items-center justify-between mb-4 border-b border-slate-100/50 pb-3">
                                <div class="flex items-center gap-2">
                                    <span class="p-2 rounded-xl bg-[#00B894]/10 text-[#00B894]">
                                        <i data-lucide="trending-up" class="w-4 h-4"></i>
                                    </span>
                                    <h4 class="font-heading font-black text-xs text-[#1E1E1E]">APMC Live Average</h4>
                                </div>
                                <span class="inline-flex items-center gap-1 text-[8px] font-black uppercase bg-[#00B894]/10 text-[#00B894] px-2 py-0.5 rounded-lg"><span class="w-1.5 h-1.5 bg-[#00B894] rounded-full animate-ping"></span> Live</span>
                            </div>
                            <div class="space-y-2.5">
                                @foreach($trendingPrices->take(2) as $price)
                                    <div class="flex items-center justify-between text-xs">
                                        <div class="font-extrabold text-[#1E1E1E]">{{ $price->crop_name }}</div>
                                        <div class="flex items-center gap-2">
                                            <span class="font-black text-[#1E1E1E]">₹{{ number_format($price->current_price, 2) }}/kg</span>
                                            <span class="text-[9px] font-bold {{ $price->trend === 'up' ? 'text-[#00B894]' : 'text-rose-500' }} uppercase flex items-center">
                                                @if($price->trend === 'up')
                                                    <i data-lucide="arrow-up-right" class="w-2.5 h-2.5"></i>
                                                @else
                                                    <i data-lucide="arrow-down-left" class="w-2.5 h-2.5"></i>
                                                @endif
                                                {{ $price->trend }}
                                            </span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Animated Crop Market Ticker Section -->
    <section class="w-full bg-[#EFE7DA]/50 py-4 border-y border-[#EFE7DA] overflow-hidden relative z-20">
        <div class="flex whitespace-nowrap animate-ticker">
            <!-- First loop of items -->
            <div class="flex items-center gap-12 font-heading font-black text-xs uppercase tracking-widest text-[#1E1E1E]">
                @foreach($trendingPrices as $price)
                    <div class="flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-[#00B894]"></span>
                        <span>{{ $price->crop_name }}</span>
                        <span class="text-slate-500">₹{{ number_format($price->current_price, 2) }}/kg</span>
                        <span class="{{ $price->trend === 'up' ? 'text-[#00B894]' : 'text-rose-500' }} flex items-center text-[10px]">
                            @if($price->trend === 'up') +{{ mt_rand(2, 6) }}% @else -{{ mt_rand(1, 4) }}% @endif
                        </span>
                    </div>
                @endforeach
            </div>
            <!-- Second loop of items to ensure continuous scrolling -->
            <div class="flex items-center gap-12 font-heading font-black text-xs uppercase tracking-widest text-[#1E1E1E] ml-12">
                @foreach($trendingPrices as $price)
                    <div class="flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-[#00B894]"></span>
                        <span>{{ $price->crop_name }}</span>
                        <span class="text-slate-500">₹{{ number_format($price->current_price, 2) }}/kg</span>
                        <span class="{{ $price->trend === 'up' ? 'text-[#00B894]' : 'text-rose-500' }} flex items-center text-[10px]">
                            @if($price->trend === 'up') +{{ mt_rand(2, 6) }}% @else -{{ mt_rand(1, 4) }}% @endif
                        </span>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Platform Stats -->
    <section class="py-20 relative overflow-hidden bg-white/20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center max-w-xl mx-auto mb-12 space-y-2">
                <span class="text-[9px] font-black text-[#00B894] uppercase tracking-widest">Platform Integrity</span>
                <h2 class="font-heading font-black text-2xl sm:text-3xl text-[#1E1E1E]">Direct Trade Metrics</h2>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                <div class="p-6 text-center space-y-3 glass-premium rounded-3xl border border-white/50 shadow-premium shadow-premium-hover">
                    <div class="w-12 h-12 rounded-2xl bg-[#00B894]/10 text-[#00B894] mx-auto flex items-center justify-center">
                        <i data-lucide="users" class="w-6 h-6"></i>
                    </div>
                    <div class="font-heading font-black text-3xl text-[#1E1E1E]">{{ $stats['farmers'] }}</div>
                    <div class="text-[9px] font-black text-slate-500 uppercase tracking-widest">Verified Farmers</div>
                </div>
                <div class="p-6 text-center space-y-3 glass-premium rounded-3xl border border-white/50 shadow-premium shadow-premium-hover">
                    <div class="w-12 h-12 rounded-2xl bg-[#FF9F1C]/10 text-[#FF9F1C] mx-auto flex items-center justify-center">
                        <i data-lucide="shopping-bag" class="w-6 h-6"></i>
                    </div>
                    <div class="font-heading font-black text-3xl text-[#1E1E1E]">{{ $stats['buyers'] }}</div>
                    <div class="text-[9px] font-black text-slate-500 uppercase tracking-widest">Active Buyers</div>
                </div>
                <div class="p-6 text-center space-y-3 glass-premium rounded-3xl border border-white/50 shadow-premium shadow-premium-hover">
                    <div class="w-12 h-12 rounded-2xl bg-[#00B894]/10 text-[#00B894] mx-auto flex items-center justify-center">
                        <i data-lucide="sprout" class="w-6 h-6"></i>
                    </div>
                    <div class="font-heading font-black text-3xl text-[#1E1E1E]">{{ $stats['products'] }}</div>
                    <div class="text-[9px] font-black text-slate-500 uppercase tracking-widest">Total Crop Listings</div>
                </div>
                <div class="p-6 text-center space-y-3 glass-premium rounded-3xl border border-white/50 shadow-premium shadow-premium-hover">
                    <div class="w-12 h-12 rounded-2xl bg-[#C97B63]/10 text-[#C97B63] mx-auto flex items-center justify-center">
                        <i data-lucide="indian-rupee" class="w-6 h-6"></i>
                    </div>
                    <div class="font-heading font-black text-3xl text-[#1E1E1E]">{{ $stats['volume'] }}</div>
                    <div class="text-[9px] font-black text-slate-500 uppercase tracking-widest">Direct Trade Volume</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Seasonal Showcase / Featured Crops -->
    <section class="py-20 relative bg-gradient-to-b from-transparent to-[#EFE7DA]/20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12 relative z-10">
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
                <div class="space-y-3">
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-wider bg-[#00B894]/10 text-[#00B894]">
                        <i data-lucide="leaf" class="w-3.5 h-3.5"></i> Farm Fresh Harvests
                    </span>
                    <h2 class="font-heading font-black text-3xl text-[#1E1E1E]">Seasonal Produce Showcase</h2>
                    <p class="text-slate-500 text-sm max-w-xl font-medium">
                        Locally grown crops listed directly by certified farmers. Check crop ratings, organic verification details, or connect directly.
                    </p>
                </div>
                <a href="{{ route('products.index') }}" class="px-5 py-3 border border-slate-200 bg-white/50 rounded-full text-[#1E1E1E] text-xs font-black uppercase tracking-widest hover:bg-white hover:-translate-y-0.5 transition-all flex items-center gap-2 shadow-sm">
                    Open Marketplace <i data-lucide="arrow-right" class="w-4 h-4 text-[#00B894]"></i>
                </a>
            </div>

            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($featuredProducts as $product)
                    <x-product-card :product="$product" />
                @empty
                    <div class="col-span-3 text-center py-20 glass-premium rounded-3xl border border-white/50 p-8 space-y-4">
                        <div class="w-14 h-14 rounded-full bg-[#00B894]/10 text-[#00B894] flex items-center justify-center mx-auto">
                            <i data-lucide="search" class="w-6 h-6"></i>
                        </div>
                        <h3 class="font-heading font-black text-[#1E1E1E] text-lg">No crops listed currently</h3>
                        <p class="text-slate-500 text-sm max-w-md mx-auto">Our farmers are busy updating harvest sheets. Check back in a few minutes!</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Verified Farmers Section -->
    <section class="py-20 relative overflow-hidden bg-white/45 border-y border-[#EFE7DA]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12 relative z-10">
            <div class="text-center space-y-3 max-w-xl mx-auto">
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-wider bg-[#00B894]/10 text-[#00B894] mx-auto">
                    <i data-lucide="badge-check" class="w-3.5 h-3.5"></i> Trust & Authenticity
                </span>
                <h2 class="font-heading font-black text-3xl text-[#1E1E1E]">Meet Verified Organic Farmers</h2>
                <p class="text-slate-500 text-sm font-medium">
                    We audit credentials and inspect local farms to certify high-quality organic crops, soil health parameters, and sustainable farming methods.
                </p>
            </div>

            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @forelse($featuredFarmers as $farmer)
                    <div class="group p-6 glass-premium rounded-3xl border border-white/50 flex flex-col items-center text-center hover:shadow-premium shadow-premium-hover transition-all duration-300">
                        <div class="relative mb-5">
                            <div class="w-20 h-20 rounded-2xl bg-gradient-to-br from-[#00B894] to-[#4F6F52] text-white flex items-center justify-center text-3xl font-heading font-black border-2 border-white shadow-md">
                                {{ substr($farmer->name, 0, 1) }}
                            </div>
                            <span class="absolute -bottom-1 -right-1 p-1 bg-[#FF9F1C] rounded-lg text-white border border-white shadow-md" title="Verified Gold Grower">
                                <i data-lucide="award" class="w-4 h-4"></i>
                            </span>
                        </div>

                        <h3 class="font-heading font-black text-[#1E1E1E] text-base truncate w-full flex items-center justify-center gap-1">
                            {{ $farmer->name }}
                        </h3>
                        <span class="inline-flex items-center gap-1 text-[9px] font-black text-[#00B894] uppercase tracking-widest mt-1.5 mb-3.5">
                            <span class="w-1.5 h-1.5 bg-[#00B894] rounded-full"></span> Certified Grower
                        </span>
                        
                        <span class="text-[10px] font-bold text-slate-500 flex items-center gap-1 mb-4 bg-slate-100 px-3 py-1 rounded-full">
                            <i data-lucide="map-pin" class="w-3.5 h-3.5 text-[#C97B63]"></i> {{ $farmer->location }}
                        </span>

                        <p class="text-xs text-slate-500 line-clamp-3 mb-5 leading-relaxed h-12 overflow-hidden font-medium">
                            {{ $farmer->bio ?? 'Dedicated crop grower registered on Fair Trade Agri-Portal. Focused on sustainable organic farming methods.' }}
                        </p>

                        @auth
                            <a href="{{ route('chats.index', ['farmer_id' => $farmer->id]) }}" class="mt-auto w-full py-3 bg-[#00B894] hover:bg-[#02d4ab] text-white text-[10px] font-extrabold uppercase tracking-widest rounded-xl shadow hover:shadow-md flex items-center justify-center gap-1.5 transition-all">
                                <i data-lucide="message-circle" class="w-4 h-4"></i> Chat Direct
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="mt-auto w-full py-3 border border-[#00B894]/20 hover:border-[#00B894] hover:text-[#00B894] text-slate-700 text-[10px] font-extrabold uppercase tracking-widest rounded-xl flex items-center justify-center gap-1.5 transition-all bg-white/40">
                                <i data-lucide="message-circle" class="w-4 h-4 text-[#00B894]"></i> Chat Direct
                            </a>
                        @endauth
                    </div>
                @empty
                    <div class="col-span-4 text-center py-8 text-slate-400 text-sm">
                        No certified organic growers listed yet.
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Platform Process Workflow -->
    <section class="py-20 relative bg-white/20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-16 relative z-10">
            <div class="text-center space-y-3 max-w-xl mx-auto">
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-xl text-[10px] font-black uppercase tracking-wider bg-[#00B894]/10 text-[#00B894] mx-auto">
                    <i data-lucide="info" class="w-3.5 h-3.5"></i> Platform Process
                </span>
                <h2 class="font-heading font-black text-3xl text-[#1E1E1E]">How Fair Trade Agri-Portal Works</h2>
                <p class="text-slate-500 text-sm font-medium">
                    Connecting organic farmers directly with institutional and domestic buyers in a secure, digital AgriTech loop.
                </p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <!-- Step 1 -->
                <div class="p-8 glass-premium rounded-3xl border border-white/50 space-y-5 hover:-translate-y-1 transition-all duration-300 shadow-premium">
                    <div class="w-12 h-12 rounded-2xl bg-[#00B894] text-white flex items-center justify-center font-heading font-black text-lg shadow-sm">
                        01
                    </div>
                    <h3 class="font-heading font-black text-lg text-[#1E1E1E]">Grower Lists Crop</h3>
                    <p class="text-xs text-slate-500 leading-relaxed font-medium">
                        Farmers list harvested crops, input volume, select organic category, publish authentic images, and set their price.
                    </p>
                </div>

                <!-- Step 2 -->
                <div class="p-8 glass-premium rounded-3xl border border-white/50 space-y-5 hover:-translate-y-1 transition-all duration-300 shadow-premium">
                    <div class="w-12 h-12 rounded-2xl bg-[#FF9F1C] text-white flex items-center justify-center font-heading font-black text-lg shadow-sm">
                        02
                    </div>
                    <h3 class="font-heading font-black text-lg text-[#1E1E1E]">Negotiate & Purchase</h3>
                    <p class="text-xs text-slate-500 leading-relaxed font-medium">
                        Buyers search crops, inspect soil and regional moisture reports, and chat directly with growers to arrange logistics.
                    </p>
                </div>

                <!-- Step 3 -->
                <div class="p-8 glass-premium rounded-3xl border border-white/50 space-y-5 hover:-translate-y-1 transition-all duration-300 shadow-premium">
                    <div class="w-12 h-12 rounded-2xl bg-[#C97B63] text-white flex items-center justify-center font-heading font-black text-lg shadow-sm">
                        03
                    </div>
                    <h3 class="font-heading font-black text-lg text-[#1E1E1E]">Secure Digital Escrow</h3>
                    <p class="text-xs text-slate-500 leading-relaxed font-medium">
                        Orders are placed, digital payments processed, invoices generated, and direct supply loops established.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to action Newsletter with Cinematic Gradient -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-20 relative z-10">
        <div class="bg-gradient-to-br from-[#4F6F52] via-[#2A3E30] to-[#1E1E1E] text-white rounded-3xl p-8 sm:p-12 relative overflow-hidden border border-white/10 shadow-2xl text-center space-y-8">
            <div class="absolute inset-0 opacity-5 pointer-events-none farming-grid"></div>
            <!-- Sunrise Glow overlay inside banner -->
            <div class="absolute inset-0 bg-gradient-to-t from-transparent to-[#FFF3D6]/10 pointer-events-none"></div>
            
            <div class="space-y-3 relative z-10 max-w-xl mx-auto">
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-xl text-[10px] font-black uppercase tracking-wider bg-[#00B894]/25 text-[#00B894] mx-auto border border-[#00B894]/20">
                    <i data-lucide="mail" class="w-3.5 h-3.5 text-[#FF9F1C]"></i> Stay Updated
                </span>
                <h2 class="font-heading font-black text-3xl text-white">Support Sustainable Agriculture</h2>
                <p class="text-white/70 text-xs font-medium">
                    Subscribe to receive local harvesting advisories, APMC crop drop notices, and weather alerts.
                </p>
            </div>
            
            <form class="max-w-md mx-auto flex flex-col sm:flex-row gap-3 pt-2 relative z-10" onsubmit="event.preventDefault(); Swal.fire('Subscribed!', 'You are on the Agri-Portal list.', 'success');">
                <input type="email" placeholder="Enter your email address" class="flex-grow px-5 py-3.5 bg-white/10 border border-white/20 rounded-xl text-xs focus:outline-none focus:ring-2 focus:ring-[#00B894] focus:bg-white/20 text-white placeholder-slate-400" required />
                <button type="submit" class="px-6 py-3.5 bg-[#00B894] hover:bg-[#02d4ab] text-white font-extrabold text-[10px] uppercase tracking-widest rounded-xl transition-all shadow whitespace-nowrap">
                    Subscribe
                </button>
            </form>
        </div>
    </section>
</x-app-layout>
