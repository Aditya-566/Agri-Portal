<x-app-layout>
    <!-- Ambient sunlight and organic light spots -->
    <div class="absolute top-20 right-10 w-80 h-80 blob-orange rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute bottom-40 left-20 w-96 h-96 blob-teal rounded-full blur-3xl pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 relative z-10">
        <!-- Hero Section -->
        <div class="max-w-4xl mx-auto text-center space-y-6 mb-16">
            <span class="inline-flex items-center gap-1.5 text-[10px] font-black text-[#FF9F1C] bg-[#FF9F1C]/10 border border-[#FF9F1C]/20 px-3.5 py-1.5 rounded-xl uppercase tracking-widest">
                Support & Inquiries
            </span>
            <h1 class="font-heading font-black text-4xl sm:text-5xl text-[#1E1E1E] leading-tight">
                Connect With Our <span class="bg-gradient-to-r from-[#00B894] to-[#FF9F1C] bg-clip-text text-transparent">Agri-Experts</span>
            </h1>
            <p class="text-slate-600 text-sm sm:text-base max-w-2xl mx-auto leading-relaxed font-semibold">
                Have questions regarding crop verification, logistic deliveries, buyer billing, or setting up a verified farmer account? We are here to assist.
            </p>
        </div>

        <div class="grid lg:grid-cols-12 gap-12 items-start">
            <!-- Contact Details (Left side) -->
            <div class="lg:col-span-5 space-y-8">
                <div class="space-y-4">
                    <h2 class="font-heading font-black text-2xl text-[#1E1E1E] uppercase tracking-wider">Contact Information</h2>
                    <p class="text-slate-500 text-xs sm:text-sm font-semibold leading-relaxed">
                        Our specialized customer support desk is active Monday through Saturday, 9:00 AM to 6:00 PM IST to assist farmers and trade partners.
                    </p>
                </div>

                <div class="space-y-6">
                    <!-- Phone Support -->
                    <div class="flex gap-4 items-start">
                        <div class="w-10 h-10 rounded-xl bg-[#00B894]/10 text-[#00B894] flex items-center justify-center shrink-0 border border-[#00B894]/20 shadow-sm">
                            <i data-lucide="phone" class="w-5 h-5"></i>
                        </div>
                        <div>
                            <h4 class="text-xs font-black text-[#1E1E1E] uppercase tracking-wider">National Toll-Free Support</h4>
                            <p class="text-sm font-bold text-[#1E1E1E] mt-0.5">1800-309-4321</p>
                            <p class="text-[10px] text-slate-400 font-semibold">Support in Hindi, Punjabi, Kannada, Telugu & English</p>
                        </div>
                    </div>

                    <!-- Email Support -->
                    <div class="flex gap-4 items-start">
                        <div class="w-10 h-10 rounded-xl bg-[#FF9F1C]/10 text-[#FF9F1C] flex items-center justify-center shrink-0 border border-[#FF9F1C]/20 shadow-sm">
                            <i data-lucide="mail" class="w-5 h-5"></i>
                        </div>
                        <div>
                            <h4 class="text-xs font-black text-[#1E1E1E] uppercase tracking-wider">Digital Desk Email</h4>
                            <p class="text-sm font-bold text-[#1E1E1E] mt-0.5">helpdesk@fairtradeagri.in</p>
                            <p class="text-[10px] text-slate-400 font-semibold">Average response timeline within 12 hours</p>
                        </div>
                    </div>

                    <!-- Address Support -->
                    <div class="flex gap-4 items-start">
                        <div class="w-10 h-10 rounded-xl bg-[#00B894]/10 text-[#00B894] flex items-center justify-center shrink-0 border border-[#00B894]/20 shadow-sm">
                            <i data-lucide="map-pin" class="w-5 h-5"></i>
                        </div>
                        <div>
                            <h4 class="text-xs font-black text-[#1E1E1E] uppercase tracking-wider">Corporate Agri-HQ</h4>
                            <p class="text-sm font-bold text-[#1E1E1E] mt-0.5">AgriTech Innovation Incubator Hub</p>
                            <p class="text-[11px] text-slate-500 font-semibold mt-0.5">Sector 62, Institutional Area, Noida, Uttar Pradesh, 201301</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Card (Right side) -->
            <div class="lg:col-span-7 glass-premium p-6 sm:p-8 rounded-3xl border border-white/50 shadow-premium">
                @if(session('success'))
                    <div class="mb-6 p-4.5 rounded-2xl bg-[#00B894]/10 text-[#00B894] text-xs font-black uppercase tracking-wider border border-[#00B894]/20 flex items-center gap-2.5 shadow-sm">
                        <i data-lucide="check-circle" class="w-5 h-5 shrink-0"></i>
                        {{ session('success') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('contact.submit') }}" class="space-y-5">
                    @csrf
                    <div class="grid sm:grid-cols-2 gap-5">
                        <div>
                            <label for="name" class="block text-[9px] font-black text-slate-400 uppercase tracking-widest mb-2">Your Name</label>
                            <input id="name" type="text" name="name" class="block w-full px-4 py-3 bg-white/50 border border-[#EFE7DA] rounded-xl text-xs font-semibold focus:ring-2 focus:ring-[#00B894] focus:border-[#00B894] text-[#1E1E1E] placeholder-slate-400 shadow-sm" required />
                            @error('name') <span class="text-red-500 text-[10px]">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label for="email" class="block text-[9px] font-black text-slate-400 uppercase tracking-widest mb-2">Your Email</label>
                            <input id="email" type="email" name="email" class="block w-full px-4 py-3 bg-white/50 border border-[#EFE7DA] rounded-xl text-xs font-semibold focus:ring-2 focus:ring-[#00B894] focus:border-[#00B894] text-[#1E1E1E] placeholder-slate-400 shadow-sm" required />
                            @error('email') <span class="text-red-500 text-[10px]">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div>
                        <label for="subject" class="block text-[9px] font-black text-slate-400 uppercase tracking-widest mb-2">Subject</label>
                        <input id="subject" type="text" name="subject" class="block w-full px-4 py-3 bg-white/50 border border-[#EFE7DA] rounded-xl text-xs font-semibold focus:ring-2 focus:ring-[#00B894] focus:border-[#00B894] text-[#1E1E1E] placeholder-slate-400 shadow-sm" required />
                        @error('subject') <span class="text-red-500 text-[10px]">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="message" class="block text-[9px] font-black text-slate-400 uppercase tracking-widest mb-2">Message</label>
                        <textarea id="message" name="message" rows="4" class="block w-full px-4 py-3 bg-white/50 border border-[#EFE7DA] rounded-xl text-xs font-semibold focus:ring-2 focus:ring-[#00B894] focus:border-[#00B894] text-[#1E1E1E] placeholder-slate-400 shadow-sm" required placeholder="Describe your query in detail..."></textarea>
                        @error('message') <span class="text-red-500 text-[10px]">{{ $message }}</span> @enderror
                    </div>

                    <button type="submit" class="w-full py-4 bg-[#00B894] hover:bg-[#02d4ab] text-white font-extrabold text-xs uppercase tracking-widest rounded-xl shadow-md transition-all flex items-center justify-center gap-2 hover:-translate-y-0.5">
                        <i data-lucide="send" class="w-4 h-4"></i> Send Message
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
