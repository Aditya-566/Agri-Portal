<nav x-data="{ open: false, profileOpen: false, scrolled: false }" 
     @scroll.window="scrolled = (window.pageYOffset > 10)"
     :class="scrolled ? 'top-2 bg-white/75 shadow-lg border-white/30 py-1' : 'top-4 bg-white/55 border-white/20 py-2'"
     class="fixed inset-x-4 max-w-7xl mx-auto z-50 rounded-full glass border transition-all duration-300 px-4 md:px-8 shadow-premium">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto">
        <div class="flex justify-between h-16 items-center">
            <div class="flex items-center gap-8">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center gap-2 group">
                        <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-[#00B894] to-[#FF9F1C] text-white flex items-center justify-center shadow-md group-hover:scale-105 transition-all duration-300">
                            <i data-lucide="sprout" class="w-5 h-5 animate-sway"></i>
                        </div>
                        <span class="font-heading font-black text-xl tracking-tight text-[#1E1E1E]">
                            AGRI<span class="text-[#00B894]">PORTAL</span>
                        </span>
                    </a>
                </div>

                <!-- Left Navigation Links (Desktop) -->
                <div class="hidden space-x-1 md:flex items-center">
                    <a href="{{ route('home') }}" class="relative px-3.5 py-1.5 rounded-full text-xs font-black uppercase tracking-wider transition-all duration-300 {{ request()->routeIs('home') ? 'text-white bg-[#00B894] shadow-sm' : 'text-[#1E1E1E]/70 hover:text-[#00B894] hover:bg-[#00B894]/5' }}">
                        Home
                    </a>
                    <a href="{{ route('products.index') }}" class="relative px-3.5 py-1.5 rounded-full text-xs font-black uppercase tracking-wider transition-all duration-300 {{ request()->routeIs('products.*') ? 'text-white bg-[#00B894] shadow-sm' : 'text-[#1E1E1E]/70 hover:text-[#00B894] hover:bg-[#00B894]/5' }}">
                        Marketplace
                    </a>
                    <a href="{{ route('market-prices.index') }}" class="relative px-3.5 py-1.5 rounded-full text-xs font-black uppercase tracking-wider transition-all duration-300 {{ request()->routeIs('market-prices.*') ? 'text-white bg-[#00B894] shadow-sm' : 'text-[#1E1E1E]/70 hover:text-[#00B894] hover:bg-[#00B894]/5' }}">
                        Market Prices
                    </a>
                    <a href="{{ route('weather.index') }}" class="relative px-3.5 py-1.5 rounded-full text-xs font-black uppercase tracking-wider transition-all duration-300 {{ request()->routeIs('weather.*') ? 'text-white bg-[#00B894] shadow-sm' : 'text-[#1E1E1E]/70 hover:text-[#00B894] hover:bg-[#00B894]/5' }}">
                        Weather
                    </a>
                    <a href="{{ route('ai-recommendations.index') }}" class="relative px-3.5 py-1.5 rounded-full text-xs font-black uppercase tracking-wider transition-all duration-300 {{ request()->routeIs('ai-recommendations.*') ? 'text-white bg-[#00B894] shadow-sm' : 'text-[#1E1E1E]/70 hover:text-[#00B894] hover:bg-[#00B894]/5' }}">
                        AI Advisor
                    </a>
                </div>
            </div>

            <!-- Right Navigation Links (Desktop) -->
            <div class="hidden md:flex items-center gap-3">
                @auth
                    <!-- Role-Specific Action Buttons -->
                    @if(auth()->user()->isFarmer())
                        <a href="{{ route('farmer.products.create') }}" class="flex items-center gap-1.5 px-4.5 py-2.5 bg-gradient-to-r from-[#00B894] to-[#02d4ab] hover:from-[#02d4ab] hover:to-[#00B894] text-white font-extrabold text-[10px] uppercase tracking-widest rounded-full shadow-sm hover:shadow hover:-translate-y-0.5 transition-all duration-200">
                            <i data-lucide="plus-circle" class="w-3.5 h-3.5"></i> Add Crop
                        </a>
                    @elseif(auth()->user()->isBuyer())
                        <!-- Cart Widget -->
                        <a href="{{ route('cart.index') }}" class="relative p-2.5 rounded-full bg-white border border-slate-100 text-[#1E1E1E] hover:text-[#00B894] hover:scale-105 hover:bg-slate-50 transition-all duration-200">
                            <i data-lucide="shopping-cart" class="w-4 h-4"></i>
                            @php
                                $cartCount = \App\Models\Cart::where('user_id', auth()->id())->first()?->items ?? [];
                                $count = count($cartCount);
                            @endphp
                            @if($count > 0)
                                <span class="absolute -top-1 -right-1 w-4.5 h-4.5 bg-[#FF9F1C] text-white text-[9px] font-black rounded-full flex items-center justify-center border border-white shadow">
                                    {{ $count }}
                                </span>
                            @endif
                        </a>
                        <!-- Wishlist Widget -->
                        <a href="{{ route('buyer.wishlist') }}" class="p-2.5 rounded-full bg-white border border-slate-100 text-[#1E1E1E] hover:text-[#00B894] hover:scale-105 hover:bg-slate-50 transition-all duration-200">
                            <i data-lucide="heart" class="w-4 h-4"></i>
                        </a>
                    @endif

                    <!-- Chat Widget -->
                    <a href="{{ route('chats.index') }}" class="relative p-2.5 rounded-full bg-white border border-slate-100 text-[#1E1E1E] hover:text-[#00B894] hover:scale-105 hover:bg-slate-50 transition-all duration-200">
                        <i data-lucide="message-square" class="w-4 h-4"></i>
                    </a>

                    <!-- User Dashboard Redirect Button -->
                    <a href="{{ route('dashboard') }}" class="px-4 py-2 border border-[#00B894]/20 hover:border-[#00B894] rounded-full text-xs font-black uppercase tracking-wider text-[#00B894] hover:bg-[#00B894]/5 hover:-translate-y-0.5 transition-all duration-200 flex items-center gap-1.5">
                        <i data-lucide="layout-dashboard" class="w-3.5 h-3.5"></i> Dashboard
                    </a>

                    <!-- Profile Dropdown -->
                    <div class="relative" x-cloak>
                        <button @click="profileOpen = !profileOpen" @click.away="profileOpen = false" class="flex items-center gap-1.5 focus:outline-none group">
                            <div class="w-8 h-8 rounded-full bg-gradient-to-br from-[#00B894]/15 to-[#FF9F1C]/15 text-[#00B894] border border-[#00B894]/10 group-hover:border-[#00B894] transition-all flex items-center justify-center">
                                <i data-lucide="user" class="w-3.5 h-3.5"></i>
                            </div>
                            <span class="text-xs font-extrabold text-[#1E1E1E] group-hover:text-[#00B894] transition-colors">
                                {{ Auth::user()->name }}
                            </span>
                            <i data-lucide="chevron-down" class="w-3.5 h-3.5 text-slate-400 group-hover:text-[#1E1E1E] transition-colors"></i>
                        </button>

                        <!-- Dropdown Menu -->
                        <div x-show="profileOpen" 
                             x-transition:enter="transition ease-out duration-150"
                             x-transition:enter-start="transform opacity-0 scale-95 y-[-10px]"
                             x-transition:enter-end="transform opacity-100 scale-100 y-0"
                             x-transition:leave="transition ease-in duration-100"
                             x-transition:leave-start="transform opacity-100 scale-100"
                             x-transition:leave-end="transform opacity-0 scale-95"
                             class="absolute right-0 mt-3 w-52 rounded-2xl bg-white shadow-xl border border-slate-100 py-1.5 z-50">
                            
                            <div class="px-4 py-2 border-b border-slate-100">
                                <span class="block text-[9px] font-black text-slate-400 uppercase tracking-widest">Signed in as</span>
                                <span class="block text-xs font-black text-[#00B894] mt-0.5 capitalize">{{ Auth::user()->role }}</span>
                            </div>

                            <a href="{{ route('profile.edit') }}" class="flex items-center gap-2.5 px-4 py-3 text-xs font-extrabold text-[#1E1E1E] hover:bg-[#00B894]/5 transition-colors">
                                <i data-lucide="settings" class="w-4 h-4 text-slate-400"></i> Settings
                            </a>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full flex items-center gap-2.5 px-4 py-3 text-xs font-black text-rose-600 hover:bg-rose-50 transition-colors text-left">
                                    <i data-lucide="log-out" class="w-4 h-4"></i> Log Out
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="text-xs font-black uppercase tracking-wider text-[#1E1E1E]/80 hover:text-[#00B894] transition-colors px-3 py-2">
                        Log in
                    </a>
                    <a href="{{ route('register') }}" class="px-5 py-2.5 bg-gradient-to-r from-[#00B894] to-[#02d4ab] hover:from-[#02d4ab] hover:to-[#00B894] text-white font-extrabold text-[10px] uppercase tracking-widest rounded-full shadow-sm hover:shadow transition-all duration-200">
                        Register
                    </a>
                @endauth
            </div>

            <!-- Hamburger Button (Mobile) -->
            <div class="-me-2 flex items-center md:hidden">
                <button @click="open = !open" class="inline-flex items-center justify-center p-2.5 rounded-full text-[#1E1E1E]/80 hover:text-[#00B894] hover:bg-[#00B894]/5 focus:outline-none transition-colors border border-transparent">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': !open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div x-show="open" class="md:hidden border-t border-slate-100 bg-white/95 backdrop-blur-md rounded-3xl mt-2 p-4 shadow-xl" x-cloak>
        <div class="space-y-1.5">
            <a href="{{ route('home') }}" class="block px-4 py-2.5 rounded-xl text-sm font-bold text-[#1E1E1E] hover:bg-[#00B894]/5">Home</a>
            <a href="{{ route('products.index') }}" class="block px-4 py-2.5 rounded-xl text-sm font-bold text-[#1E1E1E] hover:bg-[#00B894]/5">Marketplace</a>
            <a href="{{ route('market-prices.index') }}" class="block px-4 py-2.5 rounded-xl text-sm font-bold text-[#1E1E1E] hover:bg-[#00B894]/5">Market Prices</a>
            <a href="{{ route('weather.index') }}" class="block px-4 py-2.5 rounded-xl text-sm font-bold text-[#1E1E1E] hover:bg-[#00B894]/5">Weather</a>
            <a href="{{ route('ai-recommendations.index') }}" class="block px-4 py-2.5 rounded-xl text-sm font-bold text-[#1E1E1E] hover:bg-[#00B894]/5">AI Advisor</a>
        </div>

        <!-- Mobile User Info / Auth -->
        <div class="pt-4 pb-2 border-t border-slate-100 mt-4">
            @auth
                <div class="px-4 py-2.5 mb-2 bg-[#F8F5F0] rounded-2xl">
                    <div class="font-extrabold text-sm text-[#1E1E1E]">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-xs text-slate-500">{{ Auth::user()->email }}</div>
                    <div class="mt-1 text-[9px] font-black text-[#00B894] uppercase tracking-wider">Role: {{ Auth::user()->role }}</div>
                </div>

                <div class="space-y-1">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-2.5 px-4 py-2.5 rounded-xl text-sm font-bold text-[#1E1E1E] hover:bg-[#00B894]/5">
                        <i data-lucide="layout-dashboard" class="w-4 h-4 text-[#00B894]"></i> Dashboard
                    </a>
                    
                    @if(auth()->user()->isFarmer())
                        <a href="{{ route('farmer.products.create') }}" class="flex items-center gap-2.5 px-4 py-2.5 rounded-xl text-sm font-bold text-[#1E1E1E] hover:bg-[#00B894]/5">
                            <i data-lucide="plus-circle" class="w-4 h-4 text-[#00B894]"></i> Add Crop
                        </a>
                    @elseif(auth()->user()->isBuyer())
                        <a href="{{ route('cart.index') }}" class="flex items-center gap-2.5 px-4 py-2.5 rounded-xl text-sm font-bold text-[#1E1E1E] hover:bg-[#00B894]/5">
                            <i data-lucide="shopping-cart" class="w-4 h-4 text-[#00B894]"></i> Shopping Cart
                        </a>
                        <a href="{{ route('buyer.wishlist') }}" class="flex items-center gap-2.5 px-4 py-2.5 rounded-xl text-sm font-bold text-[#1E1E1E] hover:bg-[#00B894]/5">
                            <i data-lucide="heart" class="w-4 h-4 text-[#00B894]"></i> Wishlist
                        </a>
                    @endif

                    <a href="{{ route('chats.index') }}" class="flex items-center gap-2.5 px-4 py-2.5 rounded-xl text-sm font-bold text-[#1E1E1E] hover:bg-[#00B894]/5">
                        <i data-lucide="message-square" class="w-4 h-4 text-[#00B894]"></i> Chats
                    </a>
                    
                    <a href="{{ route('profile.edit') }}" class="flex items-center gap-2.5 px-4 py-2.5 rounded-xl text-sm font-bold text-[#1E1E1E] hover:bg-[#00B894]/5">
                        <i data-lucide="settings" class="w-4 h-4 text-slate-400"></i> Settings
                    </a>

                    <form method="POST" action="{{ route('logout') }}" class="mt-2">
                        @csrf
                        <button type="submit" class="w-full flex items-center gap-2.5 px-4 py-2.5 rounded-xl text-sm font-bold text-rose-600 hover:bg-rose-50 text-left">
                            <i data-lucide="log-out" class="w-4 h-4"></i> Log Out
                        </button>
                    </form>
                </div>
            @else
                <div class="space-y-2 pt-2">
                    <a href="{{ route('login') }}" class="block w-full text-center px-4 py-2.5 border border-[#00B894]/20 rounded-xl text-sm font-bold text-[#1E1E1E] hover:bg-[#00B894]/5">
                        Log in
                    </a>
                    <a href="{{ route('register') }}" class="block w-full text-center px-4 py-2.5 bg-[#00B894] hover:bg-[#02d4ab] text-white rounded-xl text-sm font-extrabold shadow-sm">
                        Register
                    </a>
                </div>
            @endauth
        </div>
    </div>
</nav>
