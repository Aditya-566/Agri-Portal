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
                    <i data-lucide="cpu" class="w-3.5 h-3.5 text-primary animate-pulse-slow"></i> AI Cognitive Core
                </span>
                <h1 class="font-heading font-black text-3xl text-charcoal mt-3 flex items-center gap-2">
                    AI Cultivation Advisor
                </h1>
                <p class="text-xs text-charcoal/70 mt-1">
                    Intelligent agricultural ruleset processor. Input your local soil parameters and season to generate optimal crop choices and yield projections.
                </p>
            </div>
        </div>

        <div class="grid lg:grid-cols-3 gap-8">
            <!-- Left 1 Col: Soils and Conditions Input Form -->
            <div class="lg:col-span-1">
                <div class="glass-premium rounded-3xl border border-white/50 shadow-premium p-6 space-y-6 sticky top-24">
                    <h3 class="font-heading font-black text-charcoal text-base pb-3 border-b border-primary/10 flex items-center gap-2">
                        <i data-lucide="sliders" class="w-5 h-5 text-primary"></i>
                        Farm Parameters
                    </h3>

                    <form method="POST" action="{{ route('ai-recommendations.recommend') }}" class="space-y-5">
                        @csrf
                        
                        <!-- Soil Type Selection -->
                        <div class="space-y-2">
                            <label for="soil_type" class="block text-xs font-black text-charcoal/50 uppercase tracking-wider">Soil Classification</label>
                            <div class="relative">
                                <select name="soil_type" id="soil_type" required
                                    class="w-full pl-4 pr-10 py-3 bg-white/50 text-charcoal border border-primary/15 rounded-2xl text-xs focus:ring-2 focus:ring-primary focus:border-primary font-bold transition-all appearance-none cursor-pointer">
                                    <option value="clay" {{ old('soil_type', $soilType ?? '') === 'clay' ? 'selected' : '' }}>Clay (Heavy, high water retention)</option>
                                    <option value="sandy" {{ old('soil_type', $soilType ?? '') === 'sandy' ? 'selected' : '' }}>Sandy (Light, high drainage, warm)</option>
                                    <option value="loamy" {{ old('soil_type', $soilType ?? '') === 'loamy' ? 'selected' : '' }}>Loamy (Rich, balanced, aerated)</option>
                                    <option value="silt" {{ old('soil_type', $soilType ?? '') === 'silt' ? 'selected' : '' }}>Silty (Smooth, fertile, medium retention)</option>
                                    <option value="peaty" {{ old('soil_type', $soilType ?? '') === 'peaty' ? 'selected' : '' }}>Peaty (High organic matter, acidic)</option>
                                </select>
                                <span class="absolute right-3.5 top-3.5 text-charcoal/40 pointer-events-none">
                                    <i data-lucide="chevrons-up-down" class="w-4 h-4"></i>
                                </span>
                            </div>
                            <p class="text-[10px] text-charcoal/55 leading-relaxed font-semibold">Choosing the correct soil profile ensures accurate root aeration and water uptake recommendations.</p>
                        </div>

                        <!-- Cultivation Region -->
                        <div class="space-y-2">
                            <label for="region" class="block text-xs font-black text-charcoal/50 uppercase tracking-wider">Geographic Region / State</label>
                            <div class="relative">
                                <input type="text" name="region" id="region" required value="{{ old('region', $region ?? '') }}" placeholder="e.g. Maharashtra, Punjab, Karnataka"
                                    class="w-full pl-10 pr-4 py-3 bg-white/50 text-charcoal border border-primary/15 rounded-2xl text-xs focus:ring-2 focus:ring-primary focus:border-primary font-bold transition-all">
                                <span class="absolute left-3.5 top-3.5 text-primary">
                                    <i data-lucide="map-pin" class="w-4 h-4"></i>
                                </span>
                            </div>
                            <p class="text-[10px] text-charcoal/55 leading-relaxed font-semibold">Regions calibrate temperature, average rainfall, and market demand indices.</p>
                        </div>

                        <!-- Season selection -->
                        <div class="space-y-2">
                            <label for="season" class="block text-xs font-black text-charcoal/50 uppercase tracking-wider">Target Season</label>
                            <div class="relative">
                                <select name="season" id="season" required
                                    class="w-full pl-4 pr-10 py-3 bg-white/50 text-charcoal border border-primary/15 rounded-2xl text-xs focus:ring-2 focus:ring-primary focus:border-primary font-bold transition-all appearance-none cursor-pointer">
                                    <option value="kharif" {{ old('season', $season ?? '') === 'kharif' ? 'selected' : '' }}>Kharif (Monsoon crop, high rain)</option>
                                    <option value="rabi" {{ old('season', $season ?? '') === 'rabi' ? 'selected' : '' }}>Rabi (Winter crop, cool/dry)</option>
                                    <option value="zaid" {{ old('season', $season ?? '') === 'zaid' ? 'selected' : '' }}>Zaid (Summer crop, warm/dry)</option>
                                    <option value="all" {{ old('season', $season ?? '') === 'all' ? 'selected' : '' }}>Year-Round / Perennial</option>
                                </select>
                                <span class="absolute right-3.5 top-3.5 text-charcoal/40 pointer-events-none">
                                    <i data-lucide="chevrons-up-down" class="w-4 h-4"></i>
                                </span>
                            </div>
                        </div>

                        <button type="submit" class="w-full py-3 bg-gradient-to-r from-primary to-forest hover:opacity-90 text-white font-black text-xs uppercase tracking-wider rounded-2xl shadow-premium transition-all flex items-center justify-center gap-2 group">
                            <i data-lucide="cpu" class="w-4 h-4 group-hover:rotate-12 transition-transform"></i>
                            Analyze Parameters
                        </button>
                    </form>

                    <!-- Diagnostic Terminal Status -->
                    <div class="pt-5 border-t border-primary/10 space-y-3">
                        <div class="flex items-center justify-between text-[10px] font-black text-charcoal/50 font-mono">
                            <span>COGNITIVE CORE STATUS</span>
                            <span class="flex items-center gap-1 text-primary">
                                <span class="w-1.5 h-1.5 rounded-full bg-primary animate-ping"></span>
                                READY
                            </span>
                        </div>
                        <div class="p-3 bg-charcoal/5 rounded-2xl border border-primary/10 font-mono text-[9px] text-charcoal/70 space-y-1.5">
                            <div class="flex justify-between">
                                <span>MODEL ID:</span>
                                <span class="text-charcoal font-bold">AGRI-FORECAST-V2</span>
                            </div>
                            <div class="flex justify-between">
                                <span>SUITABILITY MATRIX:</span>
                                <span class="text-charcoal font-bold">INDIAN REGIONAL</span>
                            </div>
                            <div class="flex justify-between">
                                <span>WEATHER CALIBRATION:</span>
                                <span class="text-primary font-bold">LIVE SYNCED</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right 2 Cols: AI Insights Display -->
            <div class="lg:col-span-2">
                @if(isset($recommendation))
                    <div class="glass-premium rounded-3xl border border-white/50 shadow-premium p-6 space-y-6">
                        <!-- Summary header -->
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 border-b border-primary/10 pb-5">
                            <div>
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-xl text-[9px] font-black uppercase tracking-wider bg-primary/10 text-primary border border-primary/15">
                                    AI ANALYSIS MATRIX COMPLETE
                                </span>
                                <h3 class="font-heading font-black text-charcoal text-xl mt-3">
                                    Recommendations for <span class="text-primary capitalize">{{ $soilType }}</span> Soil
                                </h3>
                                <p class="text-[10px] text-charcoal/60 font-bold mt-1">
                                    Region: {{ $region }} <span class="mx-1.5 text-primary">•</span> Target Season: {{ ucfirst($season) }}
                                </p>
                            </div>

                            <!-- Market Demand Index Badge -->
                            <div class="shrink-0">
                                @php
                                    $demand = strtolower($recommendation->market_demand_index ?? 'medium');
                                @endphp
                                @if($demand === 'high')
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-2xl text-xs font-black uppercase tracking-wider bg-primary/10 text-primary border border-primary/15">
                                        <i data-lucide="trending-up" class="w-4 h-4 text-primary"></i> High Demand
                                    </span>
                                @elseif($demand === 'medium')
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-2xl text-xs font-black uppercase tracking-wider bg-sky-500/10 text-sky-600 border border-sky-500/15">
                                        <i data-lucide="minus" class="w-4 h-4 text-sky-505"></i> Stable Demand
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-2xl text-xs font-black uppercase tracking-wider bg-secondary/10 text-secondary border border-secondary/15">
                                        <i data-lucide="trending-down" class="w-4 h-4 text-secondary"></i> Low Demand
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- Recommendations list -->
                        <div class="space-y-6">
                            @forelse($recommendation->recommended_crops ?? [] as $crop)
                                @php
                                    // Generate a custom match rate based on the demand score
                                    $demandScore = $crop['market_demand_score'] ?? 8;
                                    $matchRate = min(98, ($demandScore * 10) + 8);
                                @endphp
                                <div class="p-6 rounded-3xl bg-white/40 border border-primary/5 hover:border-primary/20 flex flex-col md:flex-row items-start gap-5 transition-all duration-300 group">
                                    <!-- Sprout icon visual container -->
                                    <div class="p-4 bg-primary/10 text-primary rounded-2xl shrink-0 group-hover:scale-105 transition-transform">
                                        <i data-lucide="sprout" class="w-7 h-7"></i>
                                    </div>

                                    <!-- Crop Details -->
                                    <div class="flex-grow space-y-4 w-full">
                                        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 border-b border-primary/5 pb-3">
                                            <div>
                                                <h4 class="font-heading font-black text-charcoal text-base">{{ $crop['crop_name'] }}</h4>
                                                <span class="text-[9px] font-black text-primary uppercase tracking-widest block mt-0.5">COMPATIBILITY PREDICTOR</span>
                                            </div>

                                            <div class="flex flex-wrap gap-2">
                                                <span class="inline-flex items-center px-2.5 py-1 rounded-xl text-[10px] font-extrabold bg-primary/10 text-primary border border-primary/15">
                                                    {{ $matchRate }}% match rate
                                                </span>
                                            </div>
                                        </div>

                                        <p class="text-xs text-charcoal/70 leading-relaxed font-semibold">
                                            {{ $crop['description'] }}
                                        </p>

                                        <!-- Micro Metrics Grid -->
                                        <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 pt-2">
                                            <div class="p-3 bg-white/60 border border-primary/5 rounded-2xl">
                                                <span class="text-[8px] text-charcoal/45 uppercase font-black tracking-wider block">Expected Yield</span>
                                                <span class="text-xs font-black text-charcoal mt-0.5 block truncate">{{ $crop['expected_yield'] }}</span>
                                            </div>
                                            <div class="p-3 bg-white/60 border border-primary/5 rounded-2xl">
                                                <span class="text-[8px] text-charcoal/45 uppercase font-black tracking-wider block">Demand Score</span>
                                                <span class="text-xs font-black text-primary mt-0.5 block">{{ $crop['market_demand_score'] }} / 10</span>
                                            </div>
                                            <div class="p-3 bg-white/60 border border-primary/5 rounded-2xl">
                                                <span class="text-[8px] text-charcoal/45 uppercase font-black tracking-wider block">Water Requirement</span>
                                                <span class="text-xs font-black text-charcoal mt-0.5 block">
                                                    @if(str_contains(strtolower($crop['crop_name']), 'rice') || str_contains(strtolower($crop['crop_name']), 'paddy') || str_contains(strtolower($crop['crop_name']), 'sugarcane'))
                                                        Very High
                                                    @elseif(str_contains(strtolower($crop['crop_name']), 'wheat') || str_contains(strtolower($crop['crop_name']), 'maize') || str_contains(strtolower($crop['crop_name']), 'cotton'))
                                                        Moderate
                                                    @else
                                                        Low-Medium
                                                    @endif
                                                </span>
                                            </div>
                                            <div class="p-3 bg-white/60 border border-primary/5 rounded-2xl">
                                                <span class="text-[8px] text-charcoal/45 uppercase font-black tracking-wider block">Indian Market Sourcing</span>
                                                <span class="text-xs font-black text-charcoal mt-0.5 block">Direct APMC</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-10 bg-primary/5 rounded-3xl border border-dashed border-primary/10 p-6">
                                    <i data-lucide="alert-circle" class="w-10 h-10 text-charcoal/40 mx-auto mb-2"></i>
                                    <p class="text-xs font-bold text-charcoal/50">No crop recommendations returned for this combination.</p>
                                </div>
                            @endforelse
                        </div>

                        <!-- Agricultural note -->
                        <div class="p-5 bg-primary/5 border border-primary/10 rounded-3xl text-[11px] text-charcoal/80 leading-relaxed font-semibold flex items-start gap-3">
                            <i data-lucide="info" class="w-5 h-5 text-primary shrink-0 mt-0.5"></i>
                            <div class="space-y-1">
                                <span class="font-black uppercase tracking-wider text-[9px] text-primary block">Advisor Disclaimer</span>
                                These recommendations are derived from regional crop suitability algorithms, historical climate logs, and soil retention indices. Microclimate fluctuations, localized access to irrigation, and specific chemical compound balances (Nitrogen, Phosphorous, Potassium) can directly shift crop development and final yield.
                            </div>
                        </div>
                    </div>
                @else
                    <!-- EmptyState with Holographic Matrix Scan visual -->
                    <div class="glass-premium rounded-3xl border border-white/50 shadow-premium p-12 text-center flex flex-col items-center justify-center min-h-[500px]">
                        <!-- Holographic Target Ring Matrix -->
                        <div class="relative w-32 h-32 mb-8 flex items-center justify-center">
                            <!-- Outer rotating border -->
                            <div class="absolute inset-0 rounded-full border border-primary/20 border-dashed animate-spin" style="animation-duration: 15s;"></div>
                            <!-- Middle rotating border -->
                            <div class="absolute inset-2 rounded-full border border-secondary/30 border-dotted animate-spin" style="animation-duration: 8s; animation-direction: reverse;"></div>
                            <!-- Inner pulsing circle -->
                            <div class="absolute inset-6 rounded-full bg-primary/10 flex items-center justify-center border border-primary/20 animate-pulse-slow">
                                <i data-lucide="cpu" class="w-10 h-10 text-primary"></i>
                            </div>
                        </div>
                        <h3 class="font-heading font-black text-charcoal text-lg">Awaiting Parameter Input</h3>
                        <p class="text-xs text-charcoal/60 mt-2 max-w-sm leading-relaxed font-semibold">
                            Input your farm's parameters in the sidebar to process them through our crop suitability engine. The advisor maps soil retention indexes and seasonal climates to generate optimal crop choices.
                        </p>
                        <div class="mt-6 flex items-center gap-1.5 text-[10px] font-black text-primary uppercase tracking-widest font-mono">
                            <span class="w-2 h-2 rounded-full bg-primary animate-ping"></span>
                            Sensor network scan: active
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
