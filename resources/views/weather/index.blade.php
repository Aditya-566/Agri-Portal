<x-app-layout>
    <!-- Ambient organic glowing light spots -->
    <div class="absolute top-20 left-10 w-80 h-80 blob-teal rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute bottom-40 right-20 w-96 h-96 blob-orange rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute inset-0 sunlight-ray opacity-45 pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 relative z-10">
        <!-- Dashboard Header -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 mb-10">
            <div>
                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl text-xs font-black uppercase tracking-wider bg-primary/10 text-primary border border-primary/20 shadow-sm">
                    <i data-lucide="cloud-sun" class="w-3.5 h-3.5 text-primary"></i> Meteorological Service
                </span>
                <h1 class="font-heading font-black text-3xl text-charcoal mt-3 flex items-center gap-2">
                    Agri-Weather Service
                </h1>
                <p class="text-xs text-charcoal/70 mt-1">
                    Hyper-local agricultural forecasts. Access real-time warnings, crop-water parameters, and immediate cultivation precautions.
                </p>
            </div>
            
            <!-- Region Search form -->
            <div class="w-full md:w-80">
                <form method="GET" action="{{ route('weather.index') }}" class="flex gap-2">
                    <div class="relative flex-grow">
                        <input type="text" name="region" value="{{ request('region', $weather->region) }}" placeholder="Search region (e.g. Punjab)..."
                            class="w-full pl-9 pr-4 py-2.5 bg-white/40 text-charcoal border border-primary/20 rounded-xl text-xs focus:ring-2 focus:ring-primary focus:border-primary font-bold shadow-sm">
                        <span class="absolute left-3.5 top-3.5 text-charcoal/40">
                            <i data-lucide="search" class="w-4 h-4"></i>
                        </span>
                    </div>
                    <button type="submit" class="px-4.5 py-2.5 bg-primary hover:opacity-90 text-white font-black text-xs uppercase tracking-wider rounded-xl shadow-premium transition-colors">
                        Check
                    </button>
                </form>
            </div>
        </div>

        <!-- Alerts Section -->
        @if(!empty($weather->alerts))
            <div class="mb-8 space-y-4">
                @foreach($weather->alerts as $alert)
                    @php
                        $isDanger = ($alert['severity'] ?? 'warning') === 'danger';
                    @endphp
                    <div class="p-5 rounded-3xl border flex items-start gap-4 {{ $isDanger ? 'bg-clay/5 border-clay/20 text-clay' : 'bg-secondary/5 border-secondary/20 text-secondary' }}">
                        <div class="p-2.5 rounded-2xl shrink-0 {{ $isDanger ? 'bg-clay/10 text-clay' : 'bg-secondary/10 text-secondary' }}">
                            <i data-lucide="alert-triangle" class="w-6 h-6"></i>
                        </div>
                        <div class="space-y-1">
                            <span class="text-[9px] font-black uppercase tracking-wider block font-heading {{ $isDanger ? 'text-clay' : 'text-secondary' }}">
                                {{ $alert['type'] ? str_replace('_', ' ', $alert['type']) : 'Weather Alert' }} ({{ $alert['severity'] }})
                            </span>
                            <p class="text-xs font-semibold leading-relaxed">{{ $alert['message'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        <div class="grid lg:grid-cols-3 gap-8">
            <!-- Left 2 Cols: Current weather display -->
            <div class="lg:col-span-2 space-y-8">
                <!-- Current weather card -->
                <div class="bg-gradient-to-br from-primary via-forest to-charcoal text-white rounded-3xl p-8 shadow-premium relative overflow-hidden group border border-primary/20">
                    <!-- Decorative graphics -->
                    <div class="absolute right-0 bottom-0 opacity-10 pointer-events-none translate-x-12 translate-y-12 transition-transform duration-700 group-hover:scale-110">
                        <i data-lucide="cloud-sun" class="w-72 h-72"></i>
                    </div>

                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-6 relative z-10">
                        <div class="space-y-4">
                            <div>
                                <span class="text-[10px] font-black uppercase tracking-widest text-white/80">CURRENT WEATHER</span>
                                <h2 class="text-3xl font-black font-heading mt-1">{{ $weather->region }}</h2>
                            </div>

                            <div class="flex items-center gap-4">
                                <span class="text-6xl sm:text-7xl font-black tracking-tighter">{{ number_format($weather->temperature, 1) }}°C</span>
                                <div class="p-3 bg-white/10 backdrop-blur-md rounded-2xl border border-white/10 shadow-premium">
                                    @php
                                        // Pick main condition icon
                                        $condition = 'Sunny';
                                        $rainProb = 0;
                                        if(!empty($weather->forecast)) {
                                            $condition = $weather->forecast[0]['condition'] ?? 'Sunny';
                                            $rainProb = $weather->forecast[0]['rain_prob'] ?? 0;
                                        }
                                        
                                        $icon = 'sun';
                                        if(str_contains(strtolower($condition), 'cloud')) { $icon = 'cloud'; }
                                        if(str_contains(strtolower($condition), 'showers') || str_contains(strtolower($condition), 'rain')) { $icon = 'cloud-rain'; }
                                        if(str_contains(strtolower($condition), 'thunderstorm')) { $icon = 'cloud-lightning'; }
                                    @endphp
                                    <i data-lucide="{{ $icon }}" class="w-10 h-10 text-secondary"></i>
                                </div>
                            </div>
                            <span class="inline-block text-xs font-bold bg-white/10 px-3.5 py-1.5 rounded-xl backdrop-blur-sm border border-white/5">
                                {{ $condition }} • {{ $rainProb }}% Precipitation
                            </span>
                        </div>

                        <!-- Stats grid -->
                        <div class="grid grid-cols-2 gap-4 sm:w-64 shrink-0 bg-white/5 backdrop-blur-sm p-4.5 rounded-2xl border border-white/10">
                            <!-- Humidity -->
                            <div class="space-y-1">
                                <span class="text-[9px] uppercase font-black tracking-wider text-white/70 block">Humidity</span>
                                <div class="flex items-center gap-1.5">
                                    <i data-lucide="droplet" class="w-4 h-4 text-primary"></i>
                                    <span class="text-sm font-extrabold">{{ $weather->humidity }}%</span>
                                </div>
                            </div>

                            <!-- Precipitation -->
                            <div class="space-y-1">
                                <span class="text-[9px] uppercase font-black tracking-wider text-white/70 block">Rainfall</span>
                                <div class="flex items-center gap-1.5">
                                    <i data-lucide="umbrella" class="w-4 h-4 text-primary"></i>
                                    <span class="text-sm font-extrabold">{{ $weather->rainfall }} mm</span>
                                </div>
                            </div>

                            <!-- Wind -->
                            <div class="space-y-1">
                                <span class="text-[9px] uppercase font-black tracking-wider text-white/70 block">Wind Speed</span>
                                <div class="flex items-center gap-1.5">
                                    <i data-lucide="wind" class="w-4 h-4 text-primary"></i>
                                    <span class="text-sm font-extrabold">12 km/h</span>
                                </div>
                            </div>

                            <!-- UV Index -->
                            <div class="space-y-1">
                                <span class="text-[9px] uppercase font-black tracking-wider text-white/70 block">UV Radiation</span>
                                <div class="flex items-center gap-1.5">
                                    <i data-lucide="sun" class="w-4 h-4 text-primary"></i>
                                    <span class="text-sm font-extrabold">High (6)</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 5-Day forecast cards -->
                <div class="glass-premium rounded-3xl border border-white/50 shadow-premium p-6 space-y-5">
                    <h3 class="font-heading font-black text-charcoal text-base">5-Day Agricultural Forecast</h3>
                    
                    <div class="grid grid-cols-2 sm:grid-cols-5 gap-4">
                        @foreach($weather->forecast ?? [] as $dayForecast)
                            @php
                                $dayIcon = 'sun';
                                $cond = strtolower($dayForecast['condition'] ?? '');
                                if(str_contains($cond, 'cloud')) { $dayIcon = 'cloud'; }
                                if(str_contains($cond, 'shower') || str_contains($cond, 'rain')) { $dayIcon = 'cloud-rain'; }
                                if(str_contains($cond, 'thunderstorm')) { $dayIcon = 'cloud-lightning'; }
                            @endphp
                            <div class="p-4 rounded-2xl bg-white/40 border border-primary/5 hover:border-primary/20 text-center space-y-3.5 flex flex-col items-center justify-between transition-all duration-300 group">
                                <span class="text-[10px] font-black text-charcoal/40 uppercase block">{{ $dayForecast['day'] }}</span>
                                <div class="p-2.5 bg-white rounded-xl shadow-sm text-primary border border-primary/10 group-hover:scale-110 transition-transform">
                                    <i data-lucide="{{ $dayIcon }}" class="w-5 h-5"></i>
                                </div>
                                <div>
                                    <span class="block text-sm font-black text-charcoal">{{ $dayForecast['temp'] }}°C</span>
                                    <span class="text-[9px] text-charcoal/50 block font-semibold truncate max-w-[80px]" title="{{ $dayForecast['condition'] }}">{{ $dayForecast['condition'] }}</span>
                                </div>
                                <span class="text-[9px] font-black text-charcoal/40 uppercase flex items-center gap-0.5 mt-1">
                                    <i data-lucide="umbrella" class="w-3 h-3 text-blue-500"></i>
                                    {{ $dayForecast['rain_prob'] }}%
                                </span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Right 1 Col: Dynamic agricultural advisories -->
            <div class="lg:col-span-1 space-y-6">
                <div class="glass-premium rounded-3xl border border-white/50 shadow-premium p-6 space-y-6">
                    <h3 class="font-heading font-black text-charcoal text-base pb-3 border-b border-primary/10 flex items-center gap-2">
                        <i data-lucide="check-square" class="w-5 h-5 text-primary"></i>
                        Agronomic Advisory
                    </h3>

                    <!-- Interactive advisories depending on metrics -->
                    <div class="space-y-4 text-xs font-semibold text-charcoal/80">
                        @if($weather->temperature >= 35)
                            <!-- Heat Advice -->
                            <div class="p-4.5 rounded-2xl bg-secondary/5 border border-secondary/15 space-y-2">
                                <span class="font-black text-secondary block uppercase tracking-wider text-[9px]">Irrigation Timing</span>
                                <p class="leading-relaxed font-semibold">High evaporation: Irrigate early morning or late evening. Ensure crop roots are adequately mulched to preserve soil moisture.</p>
                            </div>
                        @elseif($weather->temperature < 15)
                            <!-- Frost Advice -->
                            <div class="p-4.5 rounded-2xl bg-blue-500/5 border border-blue-500/15 space-y-2">
                                <span class="font-black text-blue-700 block uppercase tracking-wider text-[9px]">Frost Protection</span>
                                <p class="leading-relaxed font-semibold">Low temperature warnings: Keep sensitive seed beds covered. Slight sprinkling helps stabilize heat capacity.</p>
                            </div>
                        @endif

                        @if($weather->rainfall > 20 || $rainProb > 70)
                            <!-- Heavy Rain Advice -->
                            <div class="p-4.5 rounded-2xl bg-clay/5 border border-clay/15 text-clay space-y-2">
                                <span class="font-black text-clay block uppercase tracking-wider text-[9px]">Chemical Applications</span>
                                <p class="leading-relaxed font-semibold">Precipitation expected: Avoid applying fertilizers or pesticide sprays as runoff risks are extremely high.</p>
                            </div>
                            <div class="p-4.5 rounded-2xl bg-clay/5 border border-clay/15 text-clay space-y-2">
                                <span class="font-black text-clay block uppercase tracking-wider text-[9px]">Drainage Systems</span>
                                <p class="leading-relaxed font-semibold">Clear drainage paths immediately. Waterlogging inside clay soils can cause root asphyxiation.</p>
                            </div>
                        @else
                            <!-- Dry weather Advice -->
                            <div class="p-4.5 rounded-2xl bg-primary/5 border border-primary/15 space-y-2">
                                <span class="font-black text-primary block uppercase tracking-wider text-[9px]">Field Aeration</span>
                                <p class="leading-relaxed font-semibold">Optimal moisture indices: Suitable window for adding organic matter, weeding, and mechanical tilling.</p>
                            </div>
                            <div class="p-4.5 rounded-2xl bg-primary/5 border border-primary/15 space-y-2">
                                <span class="font-black text-primary block uppercase tracking-wider text-[9px]">Harvesting Cycle</span>
                                <p class="leading-relaxed font-semibold">Favorable dry weather for harvesting grains or picking fruits to avoid moisture-related mold growth during storage.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
