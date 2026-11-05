<x-app-layout>
    <!-- Ambient sunlight and organic light spots -->
    <div class="absolute top-20 left-10 w-80 h-80 blob-teal rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute bottom-40 right-20 w-96 h-96 blob-orange rounded-full blur-3xl pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 relative z-10">
        <!-- Hero Section -->
        <div class="max-w-4xl mx-auto text-center space-y-6 mb-16">
            <span class="inline-flex items-center gap-1.5 text-[10px] font-black text-[#00B894] bg-[#00B894]/10 border border-[#00B894]/20 px-3.5 py-1.5 rounded-xl uppercase tracking-widest">
                Our Sacred Mission
            </span>
            <h1 class="font-heading font-black text-4xl sm:text-5xl text-[#1E1E1E] leading-tight">
                Empowering Indian <span class="bg-gradient-to-r from-[#00B894] to-[#FF9F1C] bg-clip-text text-transparent">Agri-Communities</span>
            </h1>
            <p class="text-slate-600 text-sm sm:text-base max-w-2xl mx-auto leading-relaxed font-semibold">
                By connecting Indian farmers directly with retail and wholesale buyers across the nation, we completely bypass traditional middlemen, returning honest profits directly back to the soil.
            </p>
        </div>

        <!-- Vision and Stats Grid -->
        <div class="grid md:grid-cols-12 gap-12 items-center mb-20">
            <div class="md:col-span-7 space-y-6">
                <h2 class="font-heading font-black text-2xl sm:text-3xl text-[#1E1E1E] uppercase tracking-wider">
                    Why Direct Agri-Trade Matters
                </h2>
                <p class="text-slate-650 text-xs sm:text-sm leading-relaxed font-semibold">
                    Traditionally, smallholder farmers across India lose up to 40% of their crop value to a long chain of commission agents (arhtiyas), local brokers, and transport middlemen. This artificially inflates consumer prices while leaving the cultivating farmer with minimal margins.
                </p>
                <p class="text-slate-650 text-xs sm:text-sm leading-relaxed font-semibold">
                    Our Fair Trade Agri-Portal replaces this broken system with a clean, technology-driven marketplace. Farmers upload their harvests directly from regions like Punjab, Maharashtra, Karnataka, and Andhra Pradesh, establishing transparent prices. We empower their growth with local weather feeds, APMC market price comparison trackers, and intelligent AI-guided crop insights.
                </p>
                
                <!-- Stat Badges -->
                <div class="flex items-center gap-6 pt-4">
                    <div class="flex flex-col">
                        <span class="text-3xl sm:text-4xl font-black text-[#00B894]">0%</span>
                        <span class="text-[9px] uppercase font-black text-slate-400 tracking-widest mt-1">Intermediary Commission</span>
                    </div>
                    <div class="h-10 w-px bg-[#EFE7DA]"></div>
                    <div class="flex flex-col">
                        <span class="text-3xl sm:text-4xl font-black text-[#FF9F1C]">100%</span>
                        <span class="text-[9px] uppercase font-black text-slate-400 tracking-widest mt-1">Direct Farmer Payouts</span>
                    </div>
                </div>
            </div>
            
            <!-- Core Commitments Card -->
            <div class="md:col-span-5 glass-premium p-8 rounded-3xl border border-white/50 shadow-premium space-y-6">
                <h3 class="font-heading font-black text-lg text-[#1E1E1E] uppercase tracking-wider border-b border-[#EFE7DA] pb-4">
                    Our Core Commitments
                </h3>
                
                <div class="space-y-5">
                    <!-- Commitment 1 -->
                    <div class="flex gap-4">
                        <div class="w-9 h-9 rounded-xl bg-[#00B894]/10 text-[#00B894] flex items-center justify-center shrink-0 border border-[#00B894]/20 shadow-sm">
                            <i data-lucide="shield-check" class="w-5 h-5"></i>
                        </div>
                        <div>
                            <h4 class="text-xs font-black text-[#1E1E1E] uppercase tracking-wider">KYC Verified Farmers</h4>
                            <p class="text-[11px] text-slate-500 font-semibold mt-0.5">We verify land documentation, Aadhaar credentials, and local cultivation histories for absolute safety.</p>
                        </div>
                    </div>

                    <!-- Commitment 2 -->
                    <div class="flex gap-4">
                        <div class="w-9 h-9 rounded-xl bg-[#FF9F1C]/10 text-[#FF9F1C] flex items-center justify-center shrink-0 border border-[#FF9F1C]/20 shadow-sm">
                            <i data-lucide="trending-up" class="w-5 h-5"></i>
                        </div>
                        <div>
                            <h4 class="text-xs font-black text-[#1E1E1E] uppercase tracking-wider">APMC Price Transparency</h4>
                            <p class="text-[11px] text-slate-500 font-semibold mt-0.5">We track and display state-wise APMC market indices daily to ensure prices remain realistic and fair.</p>
                        </div>
                    </div>

                    <!-- Commitment 3 -->
                    <div class="flex gap-4">
                        <div class="w-9 h-9 rounded-xl bg-[#00B894]/10 text-[#00B894] flex items-center justify-center shrink-0 border border-[#00B894]/20 shadow-sm">
                            <i data-lucide="leaf" class="w-5 h-5"></i>
                        </div>
                        <div>
                            <h4 class="text-xs font-black text-[#1E1E1E] uppercase tracking-wider">Organic Soil Support</h4>
                            <p class="text-[11px] text-slate-500 font-semibold mt-0.5">We tag organic certified crops and encourage natural compost-based farming models.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
